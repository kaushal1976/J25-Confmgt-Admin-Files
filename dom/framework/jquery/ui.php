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


class JDomFrameworkJqueryUi extends JDomFrameworkJquery
{
	var $level = 3;				//Namespace position
	var $last = true;

	protected $hostedSources = array(
		'core' => 'http://code.jquery.com/ui/1.8.23/jquery-ui.min.js',
	);
	
	//In the latest Joomla release
	protected $joomlaHandled = array('core', 'sortable');

	//Handled in JDom
	protected $jDomHandled = array('core', 'sortable');


	protected $lib;	

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *
	 *  @lib		: jQuery UI library to load
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
		$this->arg('lib', 		null, $args, 'core');

	}
	
	function build()
	{	
		//jQuery ui is already in the core since Joomla 3.0. Load it with the native class.
		if ($this->jVersion('3.0'))
		{
			if (in_array($this->lib, $this->joomlaHandled))
			{
				JHtml::_('jquery.ui.' . $this->lib);
				return;
			}
		}

		//Requires jQuery
		JDom::_('framework.jquery');
		
		
		if (!in_array($this->lib, $this->jDomHandled))
			return;
		
		$jsFile = 'jquery.ui.' . $this->lib .'.min.js';
		$assetFile = $this->assetFilePath('js', $jsFile);
			
		if (file_exists($assetFile))
			$this->attachJs[] = $jsFile;
	
		else
			$this->addScript($this->hostedSources[$this->lib]);
			
		
	}



}