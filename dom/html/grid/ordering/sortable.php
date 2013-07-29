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


class JDomHtmlGridOrderingSortable extends JDomHtmlGridOrdering
{
	protected $canChange;	
	protected $showInput;
	
	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 * 	@num		: Num position in list
	 *	@task		: Task to execute.
	 * 
	 * 	@tableId	: Table id to make sortable
	 * 	@formId		: Form id. (default: adminForm)
	 * 	@listOrder	: Current list ordering
	 * 	@listDirn	: Current list ordering direction
	 *  @nestedList	: True when the list is nested
	 * 	@proceedSaveOrderButton : Load the Ajax JS caller
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
		
		$this->arg('showInput'	, null, $args, false);
				
	}


	function build()
	{
		
		$html = '';
	
		$disableClassName = '';
		$disabledLabel	  = '';

		$handlerClass = 'inactive';
		if ($this->canChange)
		{
			$handlerClass = 'sortable-handler hasTooltip';
		}
		
		if (!$this->enabled)
		{
			$disabledLabel    = JText::_('JDOM_ORDERING_DISABLED');
			$disableClassName = 'inactive tip-top';	
		}
		
		$htmlIcon = JDom::_('html.icon', array(
			'icon' => ($this->jVersion('3.0')?'menu':'move')
		));
		
		
		$html .= JDom::_('html.fly', array(
			'markup' => 'span',
			'domClass' => $handlerClass . ' ' . $disableClassName,
			'selectors' => array(
				'title' => $disabledLabel
				
			),
			
			'dataValue' => $htmlIcon
		
		));
		
		if ($this->enabled)
		{			
			//TEXT INPUT
			$html .= $this->buildInput($this->showInput);
		}
		
		return $html;
	}
	
}