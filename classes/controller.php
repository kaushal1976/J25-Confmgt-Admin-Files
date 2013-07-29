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
* Confmgt  Controller
*
* @package	Confmgt
* @subpackage	
*/
class ConfmgtCkClassController extends CkJController
{
	/**
	* Call the parent display function. Trick for forking overrides.
	*
	* @access	protected
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected function _parentDisplay()
	{
		//Add the fork views path (LILO) instead of FIFO
		array_push($this->paths['view'], JPATH_COMPONENT . DS. 'fork' .DS. 'views');

		parent::display();
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtClassController', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'classes' .DS. 'controller.php');
JLoader::load('ConfmgtClassController');
// Fallback if no fork has been found
if (!class_exists('ConfmgtClassController')){ class ConfmgtClassController extends ConfmgtCkClassController{} }

