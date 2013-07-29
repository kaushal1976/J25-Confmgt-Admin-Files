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


class JDomFrameworkBootstrapCore extends JDomFrameworkBootstrap
{	
	protected $loadCss;
	protected $loadJs;
	
	protected $cssRtl;
	
	
	protected $hostedSource = '';

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
	}
	
	function build()
	{
		//Bootstrap should not be used
		if (!$this->useFramework('bootstrap'))
			return;
		
		//Bootstrap is already in the core since Joomla 3.0. And already loaded.
		if ($this->jVersion('3.0'))
			return;
		
		$jsFile = 'bootstrap.min.js';
		$assetFile = $this->assetFilePath('js', $jsFile);
		
		if (file_exists($assetFile))
			$this->attachJs[] = $jsFile;
		
		//Fallback
		else
			$this->addScript($this->hostedSource);
	}
	
	function buildCss()
	{
		//Bootstrap should not be used
		if (!$this->useFramework('bootstrap'))
			return;

		//Bootstrap is already in the core since Joomla 3.0. And already loaded.
		if (!$this->jVersion('3.0'))
		{		
			$this->attachCss[] = 'bootstrap.min.css';
			$this->attachCss[] = 'bootstrap-responsive.min.css';
			$this->attachCss[] = 'bootstrap-extended.css';
		}
		
		$this->attachCss[] = 'bootstrap-legacy.css';	

		//Some icons are missing even in Joomla 3.0
		$this->attachCss[] = 'bootstrap-icons.css';

	}

}