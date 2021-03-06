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


class JDomHtmlGridTaskTask extends JDomHtmlGridTask
{
	var $level = 4;			//Namespace position
	var $last = true;		//This class is last call


	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 * 	@num		: Num position in list
	 *	@task		: Task name (used also for the icon class)
	 *	@label		: Button title, Label text if display='text'
	 *	@view		: View mode (icon/text/both) default: icon
	 *	@iconSize	: Icon size in px (square) default:16px
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
	}

	function build()
	{
		$html = $this->buildHtml();
		
		$html = JDom::_('html.link', array_merge($this->options, array(
			'content' => $html
		)));

		return $html;
	}
}