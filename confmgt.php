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
defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);

//Copy this line to be able to call the application from outside (Module, Plugin, Third component, ...)
require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_confmgt'.DS.'helpers'.DS.'loader.php');

//Document title
$document	= JFactory::getDocument();
$document->titlePrefix = "Confmgt - ";
$document->titleSuffix = "";

if (defined('JDEBUG') && count($_POST))
	$_SESSION['Confmgt']['$_POST'] = $_POST;

$jinput = JFactory::getApplication()->input;
// When this component is called to return a file
// TODO : A better practice is to call it through the View Class
if ($jinput->get('task', null, 'CMD') == 'file')
	ConfmgtClassFile::returnFile();

$controller = CkJController::getInstance('Confmgt');
$controller->execute($jinput->get('task', null, 'CMD'));
$controller->redirect();
