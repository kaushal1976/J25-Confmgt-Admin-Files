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


class JDomHtmlFormInputAjax extends JDomHtmlFormInput
{
	var $fallback = 'load';


	var $ajaxContext;		//REQUIRED
	var $ajaxWrapper;
	var $ajaxVars;
	var $onReady;

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 * 	@domID		: HTML id (DOM)  default=dataKey
	 *
	 *
	 * 	@ajaxContext: Ajax context (extension.view.layout.render) extension without 'com_'
	 * 	@ajaxWrapper: Ajax Dom div wich will be filled with the result
	 * 	@ajaxVars	: Extends of override the ajax query
	 *  @onReady	: Javascript to execute when Ajax succeed and DOM is ready
	 *
	 */
	function __construct($args)
	{

		parent::__construct($args);
		$this->arg('ajaxContext'	, null, $args, '');

		$this->ajaxContext = explode(".", $this->ajaxContext);

		$this->arg('ajaxWrapper'	, null, $args, (count($this->ajaxContext) >= 4?"_ajax_" . $this->ajaxContext[1] . "_" . $this->ajaxContext[3]:rand(1111111111, 8888888888)));
		$this->arg('ajaxVars'	, null, $args);
		
		$this->arg('onReady'	, null, $args);

	}


	function buildJs()
	{
		if ($this->onReady)
			$this->addScriptInline($this->onReady, true);
	}

}