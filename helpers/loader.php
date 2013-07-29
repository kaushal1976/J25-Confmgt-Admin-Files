<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Contents
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
defined( '_JEXEC' ) or die( 'Restricted access' );

// Some usefull constants
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
if(!defined('BR')) define("BR", "<br />");
if(!defined('LN')) define("LN", "\n");

//Joomla 1.6 only
if (!defined('JPATH_PLATFORM')) define('JPATH_PLATFORM', JPATH_SITE .DS. 'libraries');

// Main component aliases
if (!defined('COM_CONFMGT')) define('COM_CONFMGT', 'com_confmgt');
if (!defined('CONFMGT_CLASS')) define('CONFMGT_CLASS', 'Confmgt');

// Component paths constants
if (!defined('JPATH_ADMIN_CONFMGT')) define('JPATH_ADMIN_CONFMGT', JPATH_ADMINISTRATOR . DS . 'components' . DS . COM_CONFMGT);
if (!defined('JPATH_SITE_CONFMGT')) define('JPATH_SITE_CONFMGT', JPATH_SITE . DS . 'components' . DS . COM_CONFMGT);

// JQuery use
if(!defined('JQUERY_VERSION')) define('JQUERY_VERSION', '1.8.2');


$app = JFactory::getApplication();
jimport('joomla.version');
$version = new JVersion();

if (!class_exists('CkJLoader'))
{
	// Joomla! 1.6 - 1.7
	if (version_compare($version->RELEASE, '2.5', '<'))
	{
		// Load the missing class file
		require_once(JPATH_ADMIN_CONFMGT .DS. 'legacy' .DS. 'loader.php');
				
		// Register the autoloader functions.
		CkJLoader::setup();
	}
	
	
	//Joomla! 2.5 and later
	else
	{	
		class CkJLoader extends JLoader{}
	}
}

// Automatically find the class files (Platform 12.1)
CkJLoader::registerPrefix('ConfmgtClass', JPATH_ADMIN_CONFMGT .DS.'classes');
CkJLoader::registerPrefix('ConfmgtHelper', JPATH_ADMIN_CONFMGT .DS.'helpers');

// Find Legacy Files (class files missing in previous versions)
CkJLoader::registerPrefix('ConfmgtLegacy', JPATH_ADMIN_CONFMGT .DS.'legacy');

CkJLoader::discover('ConfmgtClass', JPATH_ADMIN_CONFMGT .DS.'classes');
CkJLoader::discover('ConfmgtHelper', JPATH_ADMIN_CONFMGT .DS.'helpers');

// Register JDom
CkJLoader::register('JDom', JPATH_ADMIN_CONFMGT .DS.'dom' .DS.'dom.php', true);

// Some helpers
CkJLoader::register('JToolBarHelper', JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php", true);
CkJLoader::register('JSubMenuHelper', JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php", true);

// Register all Models because of unsolved random JLoader issue.
// Cook offers 3 months subscribtion for the person who solve this issue.
JLoader::register('ConfmgtModelTracs', JPATH_COMPONENT .DS. 'models' .DS. 'tracs.php');
JLoader::register('ConfmgtModelTrack', JPATH_COMPONENT .DS. 'models' .DS. 'track.php');
JLoader::register('ConfmgtModelThemes', JPATH_COMPONENT .DS. 'models' .DS. 'themes.php');
JLoader::register('ConfmgtModelTheme', JPATH_COMPONENT .DS. 'models' .DS. 'theme.php');
JLoader::register('ConfmgtModelAuthors', JPATH_COMPONENT .DS. 'models' .DS. 'authors.php');
JLoader::register('ConfmgtModelAuthorsitem', JPATH_COMPONENT .DS. 'models' .DS. 'authorsitem.php');
JLoader::register('ConfmgtModelMain', JPATH_COMPONENT .DS. 'models' .DS. 'main.php');
JLoader::register('ConfmgtModelPaper', JPATH_COMPONENT .DS. 'models' .DS. 'paper.php');
JLoader::register('ConfmgtModelRevrs', JPATH_COMPONENT .DS. 'models' .DS. 'revrs.php');
JLoader::register('ConfmgtModelRevrsitem', JPATH_COMPONENT .DS. 'models' .DS. 'revrsitem.php');
JLoader::register('ConfmgtModelRevs', JPATH_COMPONENT .DS. 'models' .DS. 'revs.php');
JLoader::register('ConfmgtModelRevsitem', JPATH_COMPONENT .DS. 'models' .DS. 'revsitem.php');
JLoader::register('ConfmgtModelRevspapers', JPATH_COMPONENT .DS. 'models' .DS. 'revspapers.php');
JLoader::register('ConfmgtModelRevspapersitem', JPATH_COMPONENT .DS. 'models' .DS. 'revspapersitem.php');
JLoader::register('ConfmgtModelCamera', JPATH_COMPONENT .DS. 'models' .DS. 'camera.php');
JLoader::register('ConfmgtModelCamerareadyitem', JPATH_COMPONENT .DS. 'models' .DS. 'camerareadyitem.php');
JLoader::register('ConfmgtModelPresentation', JPATH_COMPONENT .DS. 'models' .DS. 'presentation.php');
JLoader::register('ConfmgtModelPresentationitem', JPATH_COMPONENT .DS. 'models' .DS. 'presentationitem.php');
JLoader::register('ConfmgtModelFullpapers', JPATH_COMPONENT .DS. 'models' .DS. 'fullpapers.php');
JLoader::register('ConfmgtModelFullpaper', JPATH_COMPONENT .DS. 'models' .DS. 'fullpaper.php');
JLoader::register('ConfmgtModelRevoutcomes', JPATH_COMPONENT .DS. 'models' .DS. 'revoutcomes.php');
JLoader::register('ConfmgtModelReviewoutcome', JPATH_COMPONENT .DS. 'models' .DS. 'reviewoutcome.php');
JLoader::register('ConfmgtModelAuthpapers', JPATH_COMPONENT .DS. 'models' .DS. 'authpapers.php');
JLoader::register('ConfmgtModelAuthpaper', JPATH_COMPONENT .DS. 'models' .DS. 'authpaper.php');
JLoader::register('ConfmgtModelCpanel', JPATH_COMPONENT .DS. 'models' .DS. 'cpanel.php');
JLoader::register('ConfmgtModelCpanelbutton', JPATH_COMPONENT .DS. 'models' .DS. 'cpanelbutton.php');
JLoader::register('ConfmgtModelThirdusers', JPATH_COMPONENT .DS. 'models' .DS. 'thirdusers.php');
JLoader::register('ConfmgtModelThirduser', JPATH_COMPONENT .DS. 'models' .DS. 'thirduser.php');
JLoader::register('ConfmgtModelThirdviewlevels', JPATH_COMPONENT .DS. 'models' .DS. 'thirdviewlevels.php');
JLoader::register('ConfmgtModelThirdviewlevel', JPATH_COMPONENT .DS. 'models' .DS. 'thirdviewlevel.php');
JLoader::register('ConfmgtModelThirdusergroups', JPATH_COMPONENT .DS. 'models' .DS. 'thirdusergroups.php');
JLoader::register('ConfmgtModelThirdusergroup', JPATH_COMPONENT .DS. 'models' .DS. 'thirdusergroup.php');
JLoader::register('ConfmgtModelThirdcategories', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcategories.php');
JLoader::register('ConfmgtModelThirdcategory', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcategory.php');
JLoader::register('ConfmgtModelThirdcontents', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcontents.php');
JLoader::register('ConfmgtModelThirdcontent', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcontent.php');

// Handle cross compatibilities
require_once(dirname(__FILE__) .DS. 'mvc.php');

// Load the component Dependencies
require_once(dirname(__FILE__) .DS. 'helper.php');

// Always use the Javascript framework for UI
JHTML::_("behavior.framework");


// Set the models directory
if ($app->isSite())
	CkJController::addModelPath(JPATH_SITE_CONFMGT .DS.'models');
else
	CkJController::addModelPath(JPATH_ADMIN_CONFMGT .DS.'models');

// Set the table directory
JTable::addIncludePath(JPATH_ADMIN_CONFMGT . DS . 'tables');

//Instance JDom in Application (for performance)
if (!isset($app->dom))
	JDom::getInstance();