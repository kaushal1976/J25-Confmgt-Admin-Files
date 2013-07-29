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
* @subpackage	Reviewoutcome
*/
class ConfmgtCkViewReviewoutcome extends ConfmgtClassView
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
		if (in_array($layout, array('revoutcome', 'revoutcomeview')))
		{
			$fct = "display" . ucfirst($layout);

			$this->addForkTemplatePath();
			$this->$fct($tpl);			
		}
		$this->_parentDisplay($tpl);
	}

	/**
	* Execute and display a template : Review outcome
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayRevoutcome($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("CONFMGT_LAYOUT_REVIEW_OUTCOME");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'reviewoutcome.revoutcome');
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
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_REVIEW_OUTCOME'), 'confmgt_revoutcomes');
		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			CkJToolBarHelper::save('reviewoutcome.save', "CONFMGT_JTOOLBAR_SAVE_CLOSE");
		// Cancel
		CkJToolBarHelper::cancel('reviewoutcome.cancel', "CONFMGT_JTOOLBAR_CANCEL");
		$lists['enum']['revoutcomes.mode'] = ConfmgtHelper::enumList('revoutcomes', 'mode');

		$lists['enum']['revoutcomes.review_outcome'] = ConfmgtHelper::enumList('revoutcomes', 'review_outcome');

		//Mode
		$lists['select']['mode'] = new stdClass();
		$lists['select']['mode']->list = $lists['enum']['revoutcomes.mode'];
		$lists['select']['mode']->value = $item->mode;

		//Review outcome
		$lists['select']['review_outcome'] = new stdClass();
		$lists['select']['review_outcome']->list = $lists['enum']['revoutcomes.review_outcome'];
		$lists['select']['review_outcome']->value = $item->review_outcome;
	}

	/**
	* Execute and display a template : Review outcome view
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayRevoutcomeview($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("CONFMGT_LAYOUT_REVIEW_OUTCOME_VIEW");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'reviewoutcome.revoutcomeview');
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
		JToolBarHelper::title(JText::_('CONFMGT_LAYOUT_REVIEW_OUTCOME_VIEW'), 'confmgt_revoutcomes');
		// Cancel
		CkJToolBarHelper::cancel('reviewoutcome.cancel', "CONFMGT_JTOOLBAR_CANCEL");
		$lists['enum']['revoutcomes.mode'] = ConfmgtHelper::enumList('revoutcomes', 'mode');

		$lists['enum']['revoutcomes.review_outcome'] = ConfmgtHelper::enumList('revoutcomes', 'review_outcome');


	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtViewReviewoutcome', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'views' .DS. 'reviewoutcome' .DS. 'view.html.php');
JLoader::load('ConfmgtViewReviewoutcome');
// Fallback if no fork has been found
if (!class_exists('ConfmgtViewReviewoutcome')){ class ConfmgtViewReviewoutcome extends ConfmgtCkViewReviewoutcome{} }

