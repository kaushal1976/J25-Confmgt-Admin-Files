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

@define("DS", DIRECTORY_SEPARATOR);


/**
* Script file of Confmgt component
*
* @package	Confmgt
* @subpackage	Installer
*/
class com_confmgtInstallerScript
{
	/**
	* Method to install the component
	*
	* @access	public
	* @param	JInstallerComponent	$parent	Installer Component Adapter.
	* @return	void
	*
	* @since	1.6
	*/
	public function install($parent)
	{
		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_confmgt');

		$installer = $parent->getParent();

		$pathSource = $installer->getPath('source');
		$pathSite = $installer->getPath('extension_site');
		$pathAdmin = $installer->getPath('extension_administrator');

		// Copy the fork empty files (only if fresh install)
		// Admin files
		if (file_exists($pathSource .DS. 'admin' .DS. 'fork')
		&& !file_exists($pathAdmin .DS. 'fork'))
			if (JFolder::copy($pathSource .DS. 'admin' .DS. 'fork', $pathAdmin .DS. 'fork'))
				echo('Empty fork files has been succesfully installed in administrator');
			else
				echo('Error when trying to install empty fork files');
		
		// Site files
		if (file_exists($pathSource .DS. 'site' .DS. 'fork')
		&& !file_exists($pathSite .DS. 'fork'))
			if (JFolder::copy($pathSource .DS. 'site' .DS. 'fork', $pathSite .DS. 'fork'))
				echo('Empty fork files has been succesfully installed in site');
			else
				echo('Error when trying to install empty fork files');
	}

	/**
	* Method to run after an install/update/uninstall method
	*
	* @access	public
	* @param	string	$type	Type.
	* @param	JInstallerComponent	$parent	Installer Component Adapter
	* @return	void
	*
	* @since	1.6
	*/
	public function postflight($type, $parent)
	{
		//TODO : WRITE HERE YOUR CODE
		echo '';
	}

	/**
	* method to run before an install/update/uninstall method
	*
	* @access	public
	* @param	string	$type	Type.
	* @param	JInstallerComponent	$parent	Installer Component Adapter.
	* @return	void
	*
	* @since	1.6
	*/
	public function preflight($type, $parent)
	{
		//TODO : WRITE HERE YOUR CODE
		echo '';
	}

	/**
	* Method to uninstall the component
	*
	* @access	public
	* @param	JInstallerComponent	$parent	Installer Component Adapter.
	* @return	void
	*
	* @since	1.6
	*/
	public function uninstall($parent)
	{
		//TODO : WRITE HERE YOUR CODE
		echo '';
	}

	/**
	* Method to update the component
	*
	* @access	public
	* @param	JInstallerComponent	$parent	Installer Component Adapter.
	* @return	void
	*
	* @since	1.6
	*/
	public function update($parent)
	{
		//TODO : WRITE HERE YOUR CODE
		echo '';
	}


}



