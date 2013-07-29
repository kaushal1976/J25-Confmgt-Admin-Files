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

if (!class_exists('JFormRule'))
	jimport('joomla.form.formrule');


/**
* Form validator rule for Confmgt.
*
* @package	Confmgt
* @subpackage	Form
*/
class ConfmgtCkClassFormRule extends JFormRule
{
	/**
	* Proxy to access protected methods.
	*
	* @access	public
	* @param	string	$var	The name of the property.
	*
	* @return	mixed	The value of the property. Null if not in the list.
	*/
	public function __get($var)
	{
		if (in_array($var, array('regex', 'regexJs', 'modifiers', 'handler')))
			if (isset($this->$var))
				return $this->$var;
	}

	/**
	* Use this function to customize your own javascript rule.
	* $this->regex must be null if you want to customize here.
	*
	* @access	public
	* @param	JXMLElement	$fieldNode	The JXMLElement object representing the <field /> tag for the form field object.
	*
	* @return	string	A JSON string representing the javascript rules validation.
	*/
	public function getJsonRule($fieldNode)
	{
		/* 	TODO : Fill the associative array below, or create a JSON string manually
		* 	Note : $this->regex must be null
		*/

		$values = array();

		$json = ConfmgtHelperHtmlValidator::jsonFromArray($values);
		return "{" . LN . $json . LN . "}";
	}

	/**
	* Method to test all common rules (Required, Unique).
	*
	* @access	public static
	* @param	JXMLElement	&$element	The JXMLElement object representing the <field /> tag for the form field object.
	* @param	mixed	$value	The form field value to validate.
	* @param	string	$group	The field name group control value. This acts as as an array container for the field.
	* @param	JRegistry	&$input	An optional JRegistry object with the entire data set to validate against the entire form.
	* @param	object	&$form	The form object for which the field is being tested.
	*
	* @return	boolean	True if the value is valid, false otherwise.
	*
	* @since	Cook V2.0
	*/
	public static function testDefaults(&$element, $value, $group = null, &$input = null, &$form = null)
	{
		// If the field is empty and not required, the field is valid.
		$required = ((string) $element['required'] == 'true' || (string) $element['required'] == 'required');
		if ($required && empty($value))
		{
			return false;
		}

		// Check if we should test for uniqueness.
		$unique = ((string) $element['unique'] == 'true' || (string) $element['unique'] == 'unique');
		if ($unique)
		{
			$jinput = JFactory::getApplication()->input;

			$parts = explode(".", $form->getName());
			$extension = preg_replace("/com_/", "", $parts[0]);
			$table = JTable::getInstance($parts[1], $extension . 'Table', array());

			// Get the database object and a new query object.
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$id =  $jinput->get('cid', 0, 'array');
			if (count($id))
				$id = $id[0];

			if (in_array($jinput->get('task'), array('save2copy')))
				$id = 0;

			// Build the query.
			$query->select('COUNT(*)');
			$query->from($table->getTableName());
			$query->where(qn($db, (string)$element['name']) . ' = ' . $db->quote($value));
			$query->where(qn($db, 'id') . '<>' . (int)$id);

			// Set and query the database.
			$db->setQuery($query);
			$duplicate = (bool) $db->loadResult();

			// Check for a database error.
			if ($db->getErrorNum())
			{
				JError::raiseWarning(500, $db->getErrorMsg());
				return false;
			}

			if ($duplicate)
			{
				JError::raiseWarning(1201, JText::sprintf("DEMO120_MODEL_DUPLICATE_ENTRY_FOR", JText::_($element['label'])));
				return false;
			}
		}

		return true;
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtClassFormRule', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'classes' .DS. 'form' .DS. 'rule.php');
JLoader::load('ConfmgtClassFormRule');
// Fallback if no fork has been found
if (!class_exists('ConfmgtClassFormRule')){ class ConfmgtClassFormRule extends ConfmgtCkClassFormRule{} }

