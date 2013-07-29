<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Fullpapers
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
* HTML View class for the Confmgt component
*
* @package	Confmgt
* @subpackage	Fullpapers
*/
class ConfmgtCkViewFullpapers extends ConfmgtClassView
{
	/**
	* Execute and display a template script.
	*
	* @access	public
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	public function display($tpl = null)
	{
		$layout = $this->getLayout();
		if (in_array($layout, array('default', 'modal')))
		{
			$fct = "display" . ucfirst($layout);

			$this->addForkTemplatePath();
			$this->$fct($tpl);			
		}
		$this->_parentDisplay($tpl);
	}

	/**
	* Execute and display a template : Full papers
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayDefault($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("CONFMGT_LAYOUT_FULL_PAPERS");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'fullpapers.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ConfmgtHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ConfmgtHelper::addSubmenu('fullpapers', 'default');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters
		// Paper ID > Title + Paper ID > Abstract + Paper ID > Key words
		$filters['search_search_1']->jdomOptions = array(
			'dataValue' => $state->get('search.search')
		);

		// Sort Table By:
		$filters['sortTable']->jdomOptions = array(
			'dataValue' => $state->get('list.ordering'),
			'list' => $this->getSortFields('default')
		);

		// Ordering of the article within the category
		$filters['directionTable']->jdomOptions = array(
			'dataValue' => $state->get('list.direction')
		);

		// JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		//Toolbar initialization
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_FULL_PAPERS'), 'confmgt_fullpapers');
		// New
		if ($model->canCreate())
			CkJToolBarHelper::addNew('fullpaper.add', "CONFMGT_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			CkJToolBarHelper::editList('fullpaper.edit', "CONFMGT_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			CkJToolBarHelper::deleteList(JText::_('CONFMGT_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'fullpaper.delete', "CONFMGT_JTOOLBAR_DELETE");

		// Config
		if ($model->canAdmin())
			CkJToolBarHelper::preferences('com_confmgt');
	}

	/**
	* Execute and display a template : Full papers
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayModal($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("CONFMGT_LAYOUT_FULL_PAPERS");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'fullpapers.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ConfmgtHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('modal.filters');
		$this->menu = ConfmgtHelper::addSubmenu('fullpapers', 'modal');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters
		// Paper ID > Title + Paper ID > Abstract + Paper ID > Key words
		$filters['search_search_2']->jdomOptions = array(
			'dataValue' => $state->get('search.search')
		);

		// JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		//Toolbar initialization
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_FULL_PAPERS'), 'confmgt_fullpapers');

	}

	/**
	* Returns an array of fields the table can be sorted by.
	*
	* @access	protected
	* @param	string	$layout	The name of the called layout. Not used yet
	*
	* @return	array	Array containing the field name to sort by as the key and display text as value.
	*
	* @since	3.0
	*/
	protected function getSortFields($layout = null)
	{
		return array(
			'a.id' => JText::_('CONFMGT_FIELD_'),
			'a.paper_id' => JText::_('CONFMGT_FIELD_PAPER_ID'),
			'a.creation_date' => JText::_('CONFMGT_FIELD_CREATION_DATE'),
			'a.publish' => JText::_('CONFMGT_FIELD_PUBLISH')
		);
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtViewFullpapers', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'views' .DS. 'fullpapers' .DS. 'view.html.php');
JLoader::load('ConfmgtViewFullpapers');
// Fallback if no fork has been found
if (!class_exists('ConfmgtViewFullpapers')){ class ConfmgtViewFullpapers extends ConfmgtCkViewFullpapers{} }

