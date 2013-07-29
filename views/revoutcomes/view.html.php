<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Revoutcomes
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
* @subpackage	Revoutcomes
*/
class ConfmgtCkViewRevoutcomes extends ConfmgtClassView
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
	* Execute and display a template : Review outcomes
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
		$this->title = JText::_("CONFMGT_LAYOUT_REVIEW_OUTCOMES");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'revoutcomes.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ConfmgtHelper::getActions();
		$this->pagination	= $this->get('Pagination');

		$this->menu = ConfmgtHelper::addSubmenu('revoutcomes', 'default');
		$lists = array();
		$this->lists = &$lists;

		
		$lists['enum']['revoutcomes.mode'] = ConfmgtHelper::enumList('revoutcomes', 'mode');
		$lists['enum']['revoutcomes.review_outcome'] = ConfmgtHelper::enumList('revoutcomes', 'review_outcome');


		//Toolbar initialization
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_REVIEW_OUTCOMES'), 'confmgt_revoutcomes');
		// New
		if ($model->canCreate())
			CkJToolBarHelper::addNew('reviewoutcome.add', "CONFMGT_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			CkJToolBarHelper::editList('reviewoutcome.edit', "CONFMGT_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			CkJToolBarHelper::deleteList(JText::_('CONFMGT_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'reviewoutcome.delete', "CONFMGT_JTOOLBAR_DELETE");

		// Config
		if ($model->canAdmin())
			CkJToolBarHelper::preferences('com_confmgt');
	}

	/**
	* Execute and display a template : Review outcomes
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
		$this->title = JText::_("CONFMGT_LAYOUT_REVIEW_OUTCOMES");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'revoutcomes.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ConfmgtHelper::getActions();
		$this->pagination	= $this->get('Pagination');

		$this->menu = ConfmgtHelper::addSubmenu('revoutcomes', 'modal');
		$lists = array();
		$this->lists = &$lists;

		
		$lists['enum']['revoutcomes.mode'] = ConfmgtHelper::enumList('revoutcomes', 'mode');
		$lists['enum']['revoutcomes.review_outcome'] = ConfmgtHelper::enumList('revoutcomes', 'review_outcome');


		//Toolbar initialization
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_REVIEW_OUTCOMES'), 'confmgt_revoutcomes');

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
			'a.paper_id' => JText::_('CONFMGT_FIELD_PAPER_ID')
		);
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtViewRevoutcomes', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'views' .DS. 'revoutcomes' .DS. 'view.html.php');
JLoader::load('ConfmgtViewRevoutcomes');
// Fallback if no fork has been found
if (!class_exists('ConfmgtViewRevoutcomes')){ class ConfmgtViewRevoutcomes extends ConfmgtCkViewRevoutcomes{} }

