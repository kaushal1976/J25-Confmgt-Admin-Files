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


class JDomHtmlLinkButtonToolbarPopup extends JDomHtmlLinkButtonToolbar
{
	var $level = 5;
	var $last = true;		//This class is last call


	/*
	 * Constuctor
	 * 	@namespace 	: Requested class
	 *  @options	: Parameters
	 *  @item		: Joomla Toolbar Item arguments (array)
	 *
	 */

	 function __construct($args)
	{
		parent::__construct($args);

		//Dispatch arguments
		$this->name 	= $this->item[1];
		$this->text 	= $this->item[2];

		//Class
		if (isset($this->item[3]))
			$this->addClass($this->item[3]);


	}

	function build()
	{

		$html =		'<span class="<%ICON_CLASS%>"></span>' .LN
				.	'<span class="text" style="white-space:nowrap"><%TEXT%></span>' .LN;


		$html = JDom::_('html.link', array_merge($this->options, array(
			'target' => 'modal',
			'href' => $this->item[3],
			'content' => $html,
			'domClass' => 'task'
		
		)));

		$this->addClass('button');
		
		
		$html =		'<li<%CLASS%> style="<%LI_STYLE%>" id="<%LI_ID%>" >'.LN
				.	$html
				.	'</li>' .LN;

		return $html;
				
		
	}


}