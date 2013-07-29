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
* Confmgt List Model
*
* @package	Confmgt
* @subpackage	Classes
*/
class ConfmgtCkModelRevs extends ConfmgtClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'revsitem';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	* @return	void
	*/
	public function __construct($config = array())
	{
		//Define the sortables fields (in lists)
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'mode', 'a.mode',
				'_reviewer_name', '_reviewer_.name',
				'recommondation', 'a.recommondation',
				'rating', 'a.rating',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search_1' => 'string',
			'search_2' => 'string'
				));


		parent::__construct($config);
		
	}

	/**
	* Method to get a list of items.
	*
	* @access	public
	*
	* @return	mixed	An array of data items on success, false on failure.
	*
	* @since	11.1
	*/
	public function getItems()
	{

		$items	= parent::getItems();
		$app	= JFactory::getApplication();


		$this->populateParams($items);

		//Create linked objects
		$this->populateObjects($items);

		return $items;
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
		return $jinput->get('layout', 'default', 'STRING');
	}

	/**
	* Method to get a store id based on model configuration state.
	* 
	* This is necessary because the model is used by the component and different
	* modules that might need different sets of data or differen ordering
	* requirements.
	*
	* @access	protected
	* @param	string	$id	A prefix for the store id.
	* @return	void
	*
	* @since	1.6
	*/
	protected function getStoreId($id = '')
	{
		// Compile the store id.





		return parent::getStoreId($id);
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
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = ConfmgtHelper::getActions();

		parent::populateState('a.mode', 'asc');
	}

	/**
	* Preparation of the list query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	* @return	void
	*/
	protected function prepareQuery(&$query)
	{

		$acl = ConfmgtHelper::getActions();

		//FROM : Main table
		$query->from('#__confmgt_revs AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id');


		switch($this->getState('context'))
		{
			case 'revs.default':

				//BASE FIELDS
				$this->addSelect(	'a.attachment,'
								.	'a.comments_to_author,'
								.	'a.comments_to_coordinator,'
								.	'a.mode,'
								.	'a.paper_id,'
								.	'a.rating,'
								.	'a.recommondation,'
								.	'a.reviewer');

				//SELECT
				$this->addSelect('_paper_id_.paper_id AS `_paper_id_paper_id`');
				$this->addSelect('_reviewer_.name AS `_reviewer_name`');

				//JOIN
				$this->addJoin('`#__confmgt_main` AS _paper_id_ ON _paper_id_.id = a.paper_id', 'LEFT');
				$this->addJoin('`#__users` AS _reviewer_ ON _reviewer_.id = a.reviewer', 'LEFT');

				//GROUP BY (PRIMARY ORDER)
				$this->addGroupOrder('a.paper_id');

				break;

			case 'revs.modal':

				//BASE FIELDS
				$this->addSelect(	'a.mode,'
								.	'a.paper_id');

				//SELECT
				$this->addSelect('_paper_id_.paper_id AS `_paper_id_paper_id`');

				//JOIN
				$this->addJoin('`#__confmgt_main` AS _paper_id_ ON _paper_id_.id = a.paper_id', 'LEFT');

				//GROUP BY (PRIMARY ORDER)
				$this->addGroupOrder('a.paper_id');

				break;
			default:
				//SELECT : raw complete query without joins
				$this->addSelect('a.*');

				// Disable the pagination
				$this->setState('list.limit', null);
				$this->setState('list.start', null);
				break;
		}

		//WHERE - SEARCH : search_search_1 : search on Paper ID + Recommondation + Rating + Comments to Authors + Comments to the Coordinator 	 + Reviewer > Name
		$search_search_1 = $this->getState('search.search_1');
		$this->addSearch('search_1', 'a.paper_id', 'like');
		$this->addSearch('search_1', 'a.recommondation', 'like');
		$this->addSearch('search_1', 'a.rating', 'like');
		$this->addSearch('search_1', 'a.comments_to_author', 'like');
		$this->addSearch('search_1', 'a.comments_to_coordinator', 'like');
		$this->addSearch('search_1', '_reviewer_.name', 'like');
		if (($search_search_1 != '') && ($search_search_1_val = $this->buildSearch('search_1', $search_search_1)))
			$this->addWhere($search_search_1_val);

		//WHERE - SEARCH : search_search_2 : search on Paper ID + Recommondation + Rating + Comments to Authors + Comments to the Coordinator 	 + Reviewer > Name
		$search_search_2 = $this->getState('search.search_2');
		$this->addSearch('search_2', 'a.paper_id', 'like');
		$this->addSearch('search_2', 'a.recommondation', 'like');
		$this->addSearch('search_2', 'a.rating', 'like');
		$this->addSearch('search_2', 'a.comments_to_author', 'like');
		$this->addSearch('search_2', 'a.comments_to_coordinator', 'like');
		$this->addSearch('search_2', '_reviewer_.name', 'like');
		if (($search_search_2 != '') && ($search_search_2_val = $this->buildSearch('search_2', $search_search_2)))
			$this->addWhere($search_search_2_val);

		//Populate only uniques strings to the query
		//SELECT
		foreach($this->getState('query.select', array()) as $select)
			$query->select($select);

		//JOIN
		foreach($this->getState('query.join.left', array()) as $join)
			$query->join('LEFT', $join);

		//WHERE
		foreach($this->getState('query.where', array()) as $where)
			$query->where($where);

		//GROUP ORDER : Prioritary order for groups in lists
		foreach($this->getState('query.groupOrder', array()) as $groupOrder)
			$query->order($groupOrder);

		//ORDER
		foreach($this->getState('query.order', array()) as $order)
			$query->order($order);

		//ORDER
		$orderCol = $this->getState('list.ordering');
		$orderDir = $this->getState('list.direction', 'asc');

		if ($orderCol)
			$query->order($orderCol . ' ' . $orderDir);
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtModelRevs', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'models' .DS. 'revs.php');
JLoader::load('ConfmgtModelRevs');
// Fallback if no fork has been found
if (!class_exists('ConfmgtModelRevs')){ class ConfmgtModelRevs extends ConfmgtCkModelRevs{} }

