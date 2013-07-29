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


class JDomHtmlFormInputAjaxChain extends JDomHtmlFormInputAjax
{
	var $ajaxToken;

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 * 	@domID		: HTML id (DOM)  default=dataKey
	 *	@ajaxContext: Ajax context (extension.view.layout.render) extension without 'com_'
	 * 	@ajaxWrapper: Ajax Dom div wich will be filled with the result
	 * 	@ajaxVars	: Extends of override the ajax query
	 *
	 *	@ajaxToken	: Only used to be able to raise an event when the AJAX dom is ready
	 */
	function __construct($args)
	{
		parent::__construct($args);
		$this->arg('ajaxToken'	, null, $args);

		$this->values = (isset($this->ajaxVars) && isset($this->ajaxVars['values']))?$this->ajaxVars['values']:null;
	}

	function build()
	{
		return '';
	}
	
	function buildJs()
	{
		if (!$this->ajaxVars)
			return;

		if (!isset($this->ajaxVars['values']) || !is_array($this->ajaxVars['values']))
			return;
		
		$selected = array_pop($this->ajaxVars['values']);
		if (isset($selected) && ($selected || $selected != ''))
		{
			$js = 'jQuery("#' . $this->ajaxWrapper . '").jdomAjax({
				"namespace":"' . implode(".", $this->ajaxContext) . '",
				"vars":' . json_encode($this->ajaxVars) . '
			});';
		
			$this->addScriptInline($js);
		}	
	}

}