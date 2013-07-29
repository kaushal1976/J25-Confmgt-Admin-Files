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
* HTML View class for the Confmgt component
*
* @package	Confmgt
* @subpackage	Revsitem
*/
class ConfmgtCkViewRevsitem extends ConfmgtClassView
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
		if (in_array($layout, array('rev', 'reviewview')))
		{
			$fct = "display" . ucfirst($layout);

			$this->addForkTemplatePath();
			$this->$fct($tpl);			
		}
		$this->_parentDisplay($tpl);
	}

	/**
	* Execute and display a template : Review
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayRev($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("CONFMGT_LAYOUT_REVIEW");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'revsitem.rev');
		$this->item		= $item		= $this->get('Item');
		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ConfmgtHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the form (prevent from direct access)
		if (!$model->canEdit($item, true))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		$jinput = JFactory::getApplication()->input;

		//Hide the component menu in item layout
		$jinput->set('hidemainmenu', true);

		//Toolbar initialization
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_REVIEW'), 'confmgt_revs');
		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			CkJToolBarHelper::save('revsitem.save', "CONFMGT_JTOOLBAR_SAVE_CLOSE");
		// Cancel
		CkJToolBarHelper::cancel('revsitem.cancel', "CONFMGT_JTOOLBAR_CANCEL");
		$lists['enum']['revs.mode'] = ConfmgtHelper::enumList('revs', 'mode');

		$lists['enum']['revs.recommondation'] = ConfmgtHelper::enumList('revs', 'recommondation');

		$model_paper_id = CkJModel::getInstance('Main', 'ConfmgtModel');
		$model_paper_id->addGroupOrder("a.title");
		$lists['fk']['paper_id'] = $model_paper_id->getItems();

		//Mode
		$lists['select']['mode'] = new stdClass();
		$lists['select']['mode']->list = $lists['enum']['revs.mode'];
		$lists['select']['mode']->value = $item->mode;

		$model_reviewer = CkJModel::getInstance('ThirdUsers', 'ConfmgtModel');
		$model_reviewer->addGroupOrder("a.name");
		$lists['fk']['reviewer'] = $model_reviewer->getItems();

		//Recommondation
		$lists['select']['recommondation'] = new stdClass();
		$lists['select']['recommondation']->list = $lists['enum']['revs.recommondation'];
		$lists['select']['recommondation']->value = $item->recommondation;
	}

	/**
	* Execute and display a template : Review view
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayReviewview($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("CONFMGT_LAYOUT_REVIEW_VIEW");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'revsitem.reviewview');
		$this->item		= $item		= $this->get('Item');
		$this->canDo	= $canDo	= ConfmgtHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the view (prevent from direct access)
		if (!$model->canAccess($item))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		$jinput = JFactory::getApplication()->input;

		//Hide the component menu in item layout
		$jinput->set('hidemainmenu', true);

		//Toolbar initialization
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_REVIEW_VIEW'), 'confmgt_revs');
		// Cancel
		CkJToolBarHelper::cancel('revsitem.cancel', "CONFMGT_JTOOLBAR_CANCEL");
		$lists['enum']['revs.mode'] = ConfmgtHelper::enumList('revs', 'mode');

		$lists['enum']['revs.recommondation'] = ConfmgtHelper::enumList('revs', 'recommondation');


	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtViewRevsitem', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'views' .DS. 'revsitem' .DS. 'view.html.php');
JLoader::load('ConfmgtViewRevsitem');
// Fallback if no fork has been found
if (!class_exists('ConfmgtViewRevsitem')){ class ConfmgtViewRevsitem extends ConfmgtCkViewRevsitem{} }

