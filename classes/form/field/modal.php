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



/**
* Form field for Confmgt.
*
* @package	Confmgt
* @subpackage	Form
*/
class ConfmgtCkClassFormFieldModal extends JFormField
{
	/**
	* The modal height in pixels
	*
	* @var integer
	*/
	protected $height = 450;

	/**
	* The modal width in pixels
	*
	* @var integer
	*/
	protected $width = 400;

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
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal');

		//Instance vars
		$labelKey = $this->_labelKey;
		$table = $this->_table;
		$label = JText::_($this->_nullLabel);


		// Build the script.
		$script = array();
		$script[] = '	function jSelectItem(id, title, object) {';
		//$script[] = '	function jSelectItem_'.$this->id.'(id, title, catid, object) {';
		$script[] = '		document.id("'.$this->id.'_id").value = id;';
		$script[] = '		document.id("'.$this->id.'_name").value = title;';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));


		$link 	= 'index.php?option=' . $this->_option . '&amp;view=' . $this->_view . '&amp;layout=modal&amp;tmpl=component';

		$title = $this->_title;
		if (empty($title)) {
			$title = $label;
		}
		$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

		// The current item display field.
		$html	= array();
		$html[] = '<div class="fltlft">';
		$html[] = '  <input type="text" id="'.$this->id.'_name" value="'.$title.'" disabled="disabled" size="25" />';
		$html[] = '</div>';

		// The item select button.
		$html[] = '<div class="button2-left">';
		$html[] = '  <div class="blank">';
		$html[] = '	<a class="modal" title="'.$label.'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: ' . $this->width . ', y: ' . $this->height . '}}">'.JText::_('Select').'</a>';
		$html[] = '  </div>';
		$html[] = '</div>';

		// The active item id field.
		if (0 == (int)$this->value) {
			$value = '';
		} else {
			$value = (int)$this->value;
		}

		// class='required' for client side validation
		$class = '';
		if ($this->required) {
			$class = ' class="required modal-value"';
		}

		$html[] = '<input type="hidden" id="'.$this->id.'_id"'.$class.' name="'.$this->name.'" value="'.$value.'" />';

		return implode("\n", $html);
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtClassFormFieldModal', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'classes' .DS. 'form' .DS. 'field' .DS. 'modal.php');
JLoader::load('ConfmgtClassFormFieldModal');
// Fallback if no fork has been found
if (!class_exists('ConfmgtClassFormFieldModal')){ class ConfmgtClassFormFieldModal extends ConfmgtCkClassFormFieldModal{} }

