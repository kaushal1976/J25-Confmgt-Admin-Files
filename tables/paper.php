<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Main
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
* Confmgt Table class
*
* @package	Confmgt
* @subpackage	Paper
*/
class ConfmgtCkTablePaper extends ConfmgtClassTable
{
	/**
	* Constructor
	*
	* @access	public
	* @param	object	&$db	Database connector object
	* @param	string	$tbl	Table name
	* @param	string	$key	Primary key
	* @return	void
	*/
	public function __construct(&$db, $tbl = '#__confmgt_main', $key = 'id')
	{
		parent::__construct($tbl, $key, $db);
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtTablePaper', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'tables' .DS. 'paper.php');
JLoader::load('ConfmgtTablePaper');
// Fallback if no fork has been found
if (!class_exists('ConfmgtTablePaper')){ class ConfmgtTablePaper extends ConfmgtCkTablePaper{} }

