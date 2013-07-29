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
* Confmgt Controller.
*
* @package	Confmgt
* @subpackage	Controller.
*/
class ConfmgtCkController extends ConfmgtClassController
{
	/**
	* The default view.
	*
	* @var string
	*/
	protected $default_view = 'cpanel';

	/**
	* Method to display a view.
	*
	* @access	public
	* @param	boolean	$cachable	If true, the view output will be cached.
	* @param	array	$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}..
	* @return	void
	*
	* @since	Cook 1.0
	*/
	public function display($cachable = false, $urlparams = false)
	{
		$jinput = JFactory::getApplication()->input;

		$this->_parentDisplay();

		//If page is called through POST, reconstruct the url
		if ($jinput->getMethod(null, null) == 'POST')
		{
			//Kill the post and rebuild the url
			$this->setRedirect(ConfmgtHelper::urlRequest());
			return;
		}

		return $this;
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtController', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'controller.php');
JLoader::load('ConfmgtController');
// Fallback if no fork has been found
if (!class_exists('ConfmgtController')){ class ConfmgtController extends ConfmgtCkController{} }

