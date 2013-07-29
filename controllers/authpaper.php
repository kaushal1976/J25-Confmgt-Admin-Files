<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Authpapers
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
* Confmgt Authpaper Controller
*
* @package	Confmgt
* @subpackage	Authpaper
*/
class ConfmgtCkControllerAuthpaper extends ConfmgtClassControllerItem
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'authpaper';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'authpaper';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'authpapers';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	* @return	void
	*/
	public function __construct($config = array())
	{
		parent::__construct($config);
		$app = JFactory::getApplication();



	}

	/**
	* Method to add an element.
	*
	* @access	public
	* @return	void
	*/
	public function add()
	{
		CkJSession::checkToken() or CkJSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::add();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpaper.authorsforpaper'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpaper.authorsforpaper'
				));
				break;
		}
	}

	/**
	* Method to cancel an element.
	*
	* @access	public
	* @return	void
	*/
	public function cancel()
	{
		$this->_result = $result = parent::cancel();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'authorsforpaper.cancel':
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpapers.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'authorsforpaperview.cancel':
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpapers.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpapers.default'
				));
				break;
		}
	}

	/**
	* Method to delete an element.
	*
	* @access	public
	* @return	void
	*/
	public function delete()
	{
		CkJSession::checkToken() or CkJSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::delete();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpapers.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpapers.default'
				));
				break;
		}
	}

	/**
	* Method to edit an element.
	*
	* @access	public
	* @return	void
	*/
	public function edit()
	{
		CkJSession::checkToken() or CkJSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::edit();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpaper.authorsforpaper'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpaper.authorsforpaper'
				));
				break;
		}
	}

	/**
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default === 'edit')
			return 'authorsforpaper';

		if ($default)
			return 'authorsforpaper';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'authorsforpaper', 'CMD');
	}

	/**
	* Method to save an element.
	*
	* @access	public
	* @return	void
	*/
	public function save()
	{
		CkJSession::checkToken() or CkJSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		//Check the ACLs
		$model = $this->getModel();
		$item = $model->getItem();
		$result = false;
		if ($model->canEdit($item, true))
		{
			$result = parent::save();
			//Get the model through postSaveHook()
			if ($this->model)
			{
				$model = $this->model;
				$item = $model->getItem();	
			}
		}
		else
			JError::raiseWarning( 403, JText::sprintf('ACL_UNAUTORIZED_TASK', JText::_('CONFMGT_JTOOLBAR_SAVE')) );

		$this->_result = $result;

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'authorsforpaper.save':
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpapers.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'authorsforpaper.apply':
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpaper.authorsforpaper'
				), array(
					'cid[]' => $model->getState('authpaper.id')
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_confmgt.authpapers.default'
				));
				break;
		}
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtControllerAuthpaper', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'controllers' .DS. 'authpaper.php');
JLoader::load('ConfmgtControllerAuthpaper');
// Fallback if no fork has been found
if (!class_exists('ConfmgtControllerAuthpaper')){ class ConfmgtControllerAuthpaper extends ConfmgtCkControllerAuthpaper{} }

