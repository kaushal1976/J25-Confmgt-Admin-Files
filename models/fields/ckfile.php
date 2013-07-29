<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	
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
class ConfmgtCkFormFieldCkfile extends ConfmgtClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'ckfile';

	/**
	* Method to get the field input markup.
	*
	* @access	public
	*
	* @return	string	The field input markup.
	*
	* @since	11.1
	*/
	public function getInput()
	{

		$this->input = JDom::_('html.form.input.file', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'dataValue' => $this->value,
				'formControl' => $this->formControl,
				'height' => $this->getOption('height'),
				'indirect' => $this->getOption('indirect', null, 'bool'),
				'responsive' => $this->getOption('responsive'),
				'root' => $this->getOption('root'),
				'ruleInstance' => $this->getOption('ruleInstance'),
				'view' => $this->getOption('view'),
				'width' => $this->getOption('width')
			), $this->jdomOptions));

		return parent::getInput();
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormFieldCkfile', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'models' .DS. 'fields' .DS. 'ckfile.php');
JLoader::load('JFormFieldCkfile');
// Fallback if no fork has been found
if (!class_exists('JFormFieldCkfile')){ class JFormFieldCkfile extends ConfmgtCkFormFieldCkfile{} }

