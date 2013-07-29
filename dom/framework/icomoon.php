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
defined( '_JEXEC' ) or die( 'Restricted access' );

class JDomFrameworkIcomoon extends JDomFramework
{
	var $assetName = 'icomoon';
	
	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *
	 *  @jdn		: Load from the jdn
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
	}

	function build()
	{
		
	}

	function buildCss()
	{
		//Chosen should not be used
		if (!$this->useFramework('icomoon'))
			return;
		
		if ($this->jVersion('3.0'))
			return;
	
	
		$this->attachCss = array(
			'icomoon.css'
		);
	
		//Little trick because '.icon-' is already in use before J!3.0	
		$this->attachCss[] = 'icomoon-legacy.css';
	}
}