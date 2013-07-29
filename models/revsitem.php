<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Revs
* @copyright	Copyright 2013, All rights reserved
* @author		Dr Kaushal Keraminiyage - www.confmgt.com - admin@confmgt.com
* @license		GNU/GPL
*
* /!\  Joomla! is free software.
* This version may have been modified pursuant to the GNU General Public License,
* and as distributed it includes or is derivative of works licensed under the
* GNU General Public License or other free or open source software licenses.
*
*             .oooO  Oooo.     See COPYRIGHT.php for copyright notices and details.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');



/**
* Confmgt Item Model
*
* @package	Confmgt
* @subpackage	Classes
*/
class ConfmgtCkModelRevsitem extends ConfmgtClassModelItem
{
	/**
	* List of all fields files indexes
	*
	* @var array
	*/
	protected $fileFields = array('attachment');

	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_item = 'revsitem';

	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_list = 'revs';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	* @return	void
	*/
	public function __construct($config = array())
	{
		parent::__construct();
	}

	/**
	* Method to delete item(s).
	*
	* @access	public
	* @param	array	&$pks	Ids of the items to delete.
	*
	* @return	boolean	True on success.
	*/
	public function delete(&$pks)
	{
		if (!count( $pks ))
			return true;


		if (!parent::delete($pks))
			return false;



		return true;
	}

	/**
	* Method to get the layout (including default).
	*
	* @access	public
	*
	* @return	string	The layout alias.
	*/
	public function getLayout()
	{
		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'reviewview', 'STRING');
	}

	/**
	* Returns a Table object, always creating it.
	*
	* @access	public
	* @param	string	$type	The table type to instantiate.
	* @param	string	$prefix	A prefix for the table class name. Optional.
	* @param	array	$config	Configuration array for model. Optional.
	*
	* @return	JTable	A database object
	*
	* @since	1.6
	*/
	public function getTable($type = 'revsitem', $prefix = 'ConfmgtTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	* Method to get the data that should be injected in the form.
	*
	* @access	protected
	*
	* @return	mixed	The data for the form.
	*/
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_confmgt.edit.revsitem.data', array());

		if (empty($data)) {
			//Default values shown in the form for new item creation
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('revsitem.id') == 0)
			{
				$jinput = JFactory::getApplication()->input;

				$data->id = 0;
				$data->paper_id = $jinput->get('filter_paper_id', $this->getState('filter.paper_id'), 'INT');
				$data->mode = $jinput->get('filter_mode', $this->getState('filter.mode','abs'), 'STRING');
				$data->reviewer = $jinput->get('filter_reviewer', $this->getState('filter.reviewer'), 'INT');
				$data->comments_to_author = null;
				$data->comments_to_coordinator = null;
				$data->comments_on_title = null;
				$data->comments_on_originality = null;
				$data->comments_on_methodology = null;
				$data->comments_on_formatting = null;
				$data->comments_on_language = null;
				$data->attachment = null;
				$data->recommondation = $jinput->get('filter_recommondation', $this->getState('filter.recommondation'), 'STRING');
				$data->rating = null;
				$data->post = 1;
				$data->modification_date = null;
				$data->creation_date = null;

			}
		}
		return $data;
	}

	/**
	* Method to auto-populate the model state.
	* 
	* This method should only be called once per instantiation and is designed to
	* be called on the first call to the getState() method unless the model
	* configuration flag to ignore the request is set.
	* 
	* Note. Calling getState in this method will result in recursion.
	*
	* @access	public
	* @param	string	$ordering	
	* @param	string	$direction	
	* @return	void
	*
	* @since	11.1
	*/
	public function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = ConfmgtHelper::getActions();



		parent::populateState($ordering, $direction);
	}

	/**
	* Preparation of the query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	* @param	integer	$pk	The primary id key of the revsitem
	* @return	void
	*/
	protected function prepareQuery(&$query, $pk)
	{

		$acl = ConfmgtHelper::getActions();

		//FROM : Main table
		$query->from('#__confmgt_revs AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id');


		switch($this->getState('context'))
		{
			case 'revsitem.rev':

				//BASE FIELDS
				$this->addSelect(	'a.attachment,'
								.	'a.comments_on_formatting,'
								.	'a.comments_on_language,'
								.	'a.comments_on_methodology,'
								.	'a.comments_on_originality,'
								.	'a.comments_on_title,'
								.	'a.comments_to_author,'
								.	'a.comments_to_coordinator,'
								.	'a.mode,'
								.	'a.paper_id,'
								.	'a.post,'
								.	'a.rating,'
								.	'a.recommondation,'
								.	'a.reviewer');

				//SELECT
				$this->addSelect('_paper_id_.title AS `_paper_id_title`');
				$this->addSelect('_reviewer_.name AS `_reviewer_name`');

				//JOIN
				$this->addJoin('`#__confmgt_main` AS _paper_id_ ON _paper_id_.id = a.paper_id', 'LEFT');
				$this->addJoin('`#__users` AS _reviewer_ ON _reviewer_.id = a.reviewer', 'LEFT');

				break;

			case 'revsitem.reviewview':

				//BASE FIELDS
				$this->addSelect(	'a.attachment,'
								.	'a.comments_on_formatting,'
								.	'a.comments_on_language,'
								.	'a.comments_on_methodology,'
								.	'a.comments_on_originality,'
								.	'a.comments_on_title,'
								.	'a.comments_to_author,'
								.	'a.comments_to_coordinator,'
								.	'a.mode,'
								.	'a.paper_id,'
								.	'a.rating,'
								.	'a.recommondation,'
								.	'a.reviewer');

				break;
			default:
				//SELECT : raw complete query without joins
				$query->select('a.*');
				break;
		}

		//SELECT : Instance Add-ons
		foreach($this->getState('query.select', array()) as $select)
			$query->select($select);

		//JOIN : Instance Add-ons
		foreach($this->getState('query.join.left', array()) as $join)
			$query->join('LEFT', $join);

		//WHERE : Item layout (based on $pk)
		$query->where('a.id = ' . (int) $pk);		//TABLE KEY


	}

	/**
	* Prepare and sanitise the table prior to saving.
	*
	* @access	protected
	* @param	JTable	$table	A JTable object.
	*
	* @return	void	
	* @return	void
	*
	* @since	1.6
	*/
	protected function prepareTable($table)
	{
		$date = JFactory::getDate();


		if (empty($table->id))
		{
			//Creation date
			if (empty($table->creation_date))
				$table->creation_date = ConfmgtHelperDates::toSql($date);
		}
		else
		{
			//Modification date
			$table->modification_date = ConfmgtHelperDates::toSql($date);
		}

	}

	/**
	* Save an item.
	*
	* @access	public
	* @param	array	$data	The post values.
	*
	* @return	boolean	True on success.
	*/
	public function save($data)
	{


		if (parent::save($data)) {
			return true;
		}
		return false;


	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtModelRevsitem', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'models' .DS. 'revsitem.php');
JLoader::load('ConfmgtModelRevsitem');
// Fallback if no fork has been found
if (!class_exists('ConfmgtModelRevsitem')){ class ConfmgtModelRevsitem extends ConfmgtCkModelRevsitem{} }

