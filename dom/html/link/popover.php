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

class JDomHtmlLinkPopover extends JDomHtmlLink
{

	var $allowWrapLink = false;	//To avoid infinite recursivity
	
	protected $popoverOptions;
	protected $popover; //Target

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *	@href		: Link
	 *	@link_js			: Javascript for the link
	 *	@content	: Content of the link
	 *	@link_title		: Title of the link (default : @content)
	 *	@target		: Target of the link  (added to natives targets : 'modal')
	 *	@domClass	: CSS class of the link
	 *	@modal_width	: Modal width
	 *	@modal_height	: Modal height
	 *
	 * 
	 *  @target		: Target for the popover
	 *	
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
		$this->arg('popover'		, null, $args);
		$this->arg('popoverOptions'		, null, $args, array());
				
	}
	
	function build()
	{
		$this->href = '#';
		$this->link_title = "first tooltipee";
		
		$this->addSelector('data-toggle', 'tooltip');
	
	
		$this->addStyle('cursor', 'pointer');
		
		$html = "<a<%ID%><%CLASS%><%STYLE%><%TITLE%><%HREF%><%JS%><%TARGET%><%SELECTORS%>>"
			.	$this->content
			.	"</a>";

		return $html;	
	}
	
	function buildJs()
	{
		$js = "jQuery('" . $this->popover . "').popover(" . json_encode($this->popoverOptions). ")";
		$this->addScriptInline($js, true);
	}

}