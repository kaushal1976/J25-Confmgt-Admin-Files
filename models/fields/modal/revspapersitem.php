<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Revspapers
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

if (!class_exists('ConfmgtClassFormField'))
	require_once(JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR. 'components' .DIRECTORY_SEPARATOR. 'com_confmgt' .DIRECTORY_SEPARATOR. 'helpers' .DIRECTORY_SEPARATOR. 'loader.php');


/**
* Form field for Confmgt.
*
* @package	Confmgt
* @subpackage	Form
*/
class ConfmgtCkJFormFieldModal_Revspapersitem extends ConfmgtClassFormFieldModal
{
	/**
	* Default label for the picker.
	*
	* @var string
	*/
	protected $_nullLabel = CONFMGT_DATA_PICKER_SELECT_REVS_PAPERS_ITEM;

	/**
	* Option in URL
	*
	* @var string
	*/
	protected $_option = 'com_confmgt';

	/**
	* Modal Title
	*
	* @var string
	*/
	protected $_title;

	/**
	* View in URL
	*
	* @var string
	*/
	protected $_view = 'revspapers';

	/**
	* Field type
	*
	* @var string
	*/
	protected $type = 'modal_revspapersitem';

	/**
	* Method to get the field input markup.
	*
	* @access	protected
	*
	* @return	string	The field input markup.
	*
	* @since	11.1
	*/
	protected function getInput()
	{
		$db	= JFactory::getDBO();
		$db->setQuery(
			'SELECT `paper`' .
			' FROM #__confmgt_revspapers' .
			' WHERE id = '.(int) $this->value
		);
		$this->_title = $db->loadResult();

		if ($error = $db->getErrorMsg()) {
			JError::raiseWarning(500, $error);
		}


		return parent::getInput();
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormFieldModal_Revspapersitem', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'models' .DS. 'fields' .DS. 'modal' .DS. 'revspapersitem.php');
JLoader::load('JFormFieldModal_Revspapersitem');
// Fallback if no fork has been found
if (!class_exists('JFormFieldModal_Revspapersitem')){ class JFormFieldModal_Revspapersitem extends ConfmgtCkJFormFieldModal_Revspapersitem{} }

