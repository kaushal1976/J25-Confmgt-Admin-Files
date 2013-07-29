<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <     JDom Class - Cook Self Service library    |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Cook Self Service
* @subpackage	JDom
* @license		GNU General Public License
* @author		100% Vitamin - Jocelyn HUARD
*
*	-> You can reuse this framework for all purposes. Keep this signature. <-
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


jimport('joomla.version');
$version = new JVersion();


// Joomla! 1.0 - 1.5
if (version_compare($version->RELEASE, '1.6', '<'))
{
	exit('Not Supported');	
}




// Joomla! 1.6 - 1.7 - 2.5
else if (version_compare($version->RELEASE, '3.0', '<'))
{
	
	// Joomla 1.6
	if (version_compare($version->RELEASE, '1.6', '='))
	{
		if (!class_exists('JInput'))
			CkJLoader::register('JInput', JPATH_ADMIN_CONFMGT .DS.'legacy' .DS. 'input' .DS. 'input.php');
		

	}
	// Joomla 1.7
	else if (version_compare($version->RELEASE, '2.5', '<'))
	{
		jimport('joomla.application.input');	
	}
	
	// Instance JInput in application when missing
	if (!$app->input)
		$app->input = new JInput;

	// MVC
	if (!class_exists('CkJController'))
	{
		jimport('joomla.application.component.controller');
		jimport('joomla.application.component.model');
		jimport('joomla.application.component.view');
		
		class CkJController extends JController{}	
		class CkJModel extends JModel{}
		class CkJView extends JView{}
	}

	if (!class_exists('CkJSession'))
	{
		class CkJSession extends JSession
		{
			public static function checkToken($method = 'post')
			{
				return JRequest::checkToken($method);
			}	
		}
	}
	
}




//Joomla! 3.0 and later
else if ($version->isCompatible('3.0'))
{
	if (!class_exists('CkJController'))
	{
		jimport('legacy.controller.legacy');
		jimport('legacy.model.legacy');
		jimport('legacy.view.legacy');
		
		class CkJController extends JControllerLegacy{}
		class CkJModel extends JModelLegacy{}
		class CkJView extends JViewLegacy{}
		class CkJSession extends JSession{}
	}
}


//Additional legacy classes
if (!class_exists('CkJToolbarHelper')){
	if ($version->isCompatible('1.7')){
		class CkJToolbarHelper extends JToolbarHelper{}		
	}
	else{
		//Some toolbar buttons are missing in 1.6
		class CkJToolbarHelper extends ConfmgtLegacyHtmlToolbar{}	
	}
}

//JDatabase::quoteName does not exist in 1.6
if (!function_exists('qn'))
{
	if ($version->isCompatible('1.7')){
		function qn($db, $s){return $db->quoteName($s);}
	}
	else{
		//1.6
		function qn($db, $s){return $db->nameQuote($s);}	
	}
}