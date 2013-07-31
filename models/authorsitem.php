<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Authors
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
class ConfmgtCkModelAuthorsitem extends ConfmgtClassModelItem
{
	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_item = 'authorsitem';

	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_list = 'authors';

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
		return $jinput->get('layout', 'authorview', 'STRING');
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
	public function getTable($type = 'authorsitem', $prefix = 'ConfmgtTable', $config = array())
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
		$data = JFactory::getApplication()->getUserState('com_confmgt.edit.authorsitem.data', array());

		if (empty($data)) {
			//Default values shown in the form for new item creation
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('authorsitem.id') == 0)
			{
				$jinput = JFactory::getApplication()->input;

				$data->id = 0;
				$data->added_by = $jinput->get('filter_added_by', $this->getState('filter.added_by'), 'INT');
				$data->title = $jinput->get('filter_title', $this->getState('filter.title'), 'STRING');
				$data->first_name = null;
				$data->surname = null;
				$data->email = null;
				$data->affiliation = null;
				$data->country = null;
				$data->attending_the_conference = null;
				$data->user = $jinput->get('filter_user', $this->getState('filter.user'), 'INT');
				$data->paid_and_registered = null;
				$data->ordering = null;
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
	* @param	integer	$pk	The primary id key of the authorsitem
	* @return	void
	*/
	protected function prepareQuery(&$query, $pk)
	{

		$acl = ConfmgtHelper::getActions();

		//FROM : Main table
		$query->from('#__confmgt_authors AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id');


		switch($this->getState('context'))
		{
			case 'authorsitem.author':

				//BASE FIELDS
				$this->addSelect(	'a.added_by,'
								.	'a.affiliation,'
								.	'a.attending_the_conference,'
								.	'a.country,'
								.	'a.email,'
								.	'a.first_name,'
								.	'a.surname,'
								.	'a.title');

				break;

			case 'authorsitem.authorview':

				//BASE FIELDS
				$this->addSelect(	'a.added_by,'
								.	'a.affiliation,'
								.	'a.attending_the_conference,'
								.	'a.country,'
								.	'a.email,'
								.	'a.first_name,'
								.	'a.paid_and_registered,'
								.	'a.surname,'
								.	'a.title,'
								.	'a.user');

				//SELECT
				$this->addSelect('_user_.username AS `_user_username`');

				//JOIN
				$this->addJoin('`#__users` AS _user_ ON _user_.id = a.user', 'LEFT');

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
			// Set ordering to the last item if not set
			$conditions = $this->getReorderConditions($table);
			$conditions = (count($conditions)?implode(" AND ", $conditions):'');
			$table->ordering = $table->getNextOrder($conditions);

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
JLoader::register('ConfmgtModelAuthorsitem', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'models' .DS. 'authorsitem.php');
JLoader::load('ConfmgtModelAuthorsitem');
// Fallback if no fork has been found
if (!class_exists('ConfmgtModelAuthorsitem')){ class ConfmgtModelAuthorsitem extends ConfmgtCkModelAuthorsitem{} }

