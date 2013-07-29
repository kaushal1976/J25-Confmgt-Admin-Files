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

class JDomHtmlLinkMenuSubmenu extends JDomHtmlLinkMenu
{
	var $level = 4;				//Namespace position
	var $last = true;
	
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
		
		if ($this->active)
			$this->addClass('active');	
	}
	
	function build()
	{
		$html = '<li<%CLASS%>>' 
			.	 $this->buildLink()
			. 	'</li>';
		
		return $html;
	}

	//Override to make it simplier
	function buildLink()
	{
		$this->addStyle('cursor', 'pointer');
		
		$html = "<a<%STYLE%><%TITLE%><%HREF%><%SELECTORS%>>"
			.	$this->content
			.	"</a>";

		return $html;
	}

}