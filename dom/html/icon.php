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


class JDomHtmlIcon extends JDomHtml
{
	var $level = 2;			//Namespace position
	var $last = true;

	protected $icon;
	
	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 *
	 *	@icon		: Icon name see : http://icomoon.io/#preview-free
	 */
	function __construct($args)
	{
		parent::__construct($args);

		$this->arg('icon', null, $args);
	}

	function build()
	{
		//Requires Icomoon	
		JDom::_('framework.icomoon');
		
		//Use '.icon-*' and '._icon-*' (for legacy 1.6)
		$html = '<i class="icon-' . $this->icon . ' _icon-' . $this->icon . '"></i>';

		return $html;
	}


}