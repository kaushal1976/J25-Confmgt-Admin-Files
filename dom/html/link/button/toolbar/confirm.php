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


class JDomHtmlLinkButtonToolbarConfirm extends JDomHtmlLinkButtonToolbar
{
	var $level = 5;
	var $last = true;		//This class is last call

	/*
	 * Constuctor
	 * 	@namespace 	: Requested class
	 *  @options	: Parameters
	 *  @item		: Joomla Toolbar Item arguments (array)
	 *
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);

		//Dispatch arguments
		$this->message 	= $this->item[1];
		$this->name 	= $this->item[2];
		$this->text 	= $this->item[3];
		$this->task 	= $this->item[4];
		$this->list 	= $this->item[5];

		//Class
		if (isset($this->item[6]))
			$this->addClass($this->item[6]);


	}

	function build()
	{

		$this->addClass('button');
		
		$html =		'<li<%CLASS%> style="<%LI_STYLE%>" id="<%LI_ID%>" >'.LN
				.	'	<div class="task" style="<%BUTTON_STYLE%>" onclick="<%COMMAND%>">'.LN
				.	'		<span class="<%ICON_CLASS%>"></span>' .LN
				.	'		<span class="text" style="white-space:nowrap"><%TEXT%></span>' .LN
				.	'	</div>'
				.	'</li>' .LN;

		return $html;
	}


}