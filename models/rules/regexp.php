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
* Form validator rule for Confmgt.
*
* @package	Confmgt
* @subpackage	Form
*/
class ConfmgtCkFormRuleRegexp extends ConfmgtClassFormRule
{
	/**
	* Indicates that this class contains special methods (ie: get()).
	*
	* @var boolean
	*/
	public $extended = true;

	/**
	* Unique name for this rule.
	*
	* @var string
	*/
	protected $handler = 'regexp';

	/**
	* Method to test the field.
	*
	* @access	public
	* @param	SimpleXMLElement	$element	The JXMLElement object representing the <field /> tag for the form field object.
	* @param	mixed	$value	The form field value to validate.
	* @param	string	$group	The field name group control value. This acts as as an array container for the field.
	* @param	JRegistry	$input	An optional JRegistry object with the entire data set to validate against the entire form.
	* @param	JForm	$form	The form object for which the field is being tested.
	*
	* @return	boolean	True if the value is valid, false otherwise.
	*
	* @since	11.1
	*/
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
		// Common test : Required, Unique
		if (!self::testDefaults($element, $value, $group, $input, $form))
			return false;
		// If the regexp is empty, the field is valid.
		if (empty($element['regexp']))
			return true;

		$this->regex = $element['regexp'];

		if (!empty($element['regexpModifiers']))
			$this->modifiers = $element['regexpModifiers'];

		$invert = false;
		if (!empty($element['regexpInvert']))
			$invert = $element['regexpInvert'];

		// Test the value against the regular expression.
		$test = parent::test($element, $value, $group, $input, $form);

		if ($invert?$test:!$test)
			return false;

		return true;
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormRuleRegexp', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'models' .DS. 'rules' .DS. 'regexp.php');
JLoader::load('JFormRuleRegexp');
// Fallback if no fork has been found
if (!class_exists('JFormRuleRegexp')){ class JFormRuleRegexp extends ConfmgtCkFormRuleRegexp{} }

