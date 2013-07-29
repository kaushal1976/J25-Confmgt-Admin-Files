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


class JDomHtmlFormInputSelectDirection extends JDomHtmlFormInputSelect
{
	var $assetName = 'joomla';

	var $attachJs = array(
		'joomla.js'
	);
	
	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 * 	@domID		: HTML id (DOM)  default=dataKey
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
	}

	function build()
	{
		$html = JDom::_('html.form.input.select.combo', array_merge($this->options, array(
			'domClass' => 'input-medium ' . $this->options['domClass'],
			'selectors' => array(
				'onchange' => 'Joomla.orderTable();'
			),
			'list' => array(
				'asc' => JText::_('JGLOBAL_ORDER_ASCENDING'),
				'desc' => JText::_('JGLOBAL_ORDER_DESCENDING')
			)
		
		)));
		return $html;
	}
}