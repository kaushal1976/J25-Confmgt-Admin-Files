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

class JDomHtml extends JDom
{
	var $fallback = 'view';
	
	var $canEmbed = true;		//For links and Ajax

	var $classes = array();
	var $styles = array();
	var $selectors = array();

	var $submitEventName;

	protected $domClass;
	protected $domId;
	protected $route;
	
	protected $href;
	protected $task;
	protected $num;
	protected $link_title;
	protected $target;
	protected $handler;
	protected $popover;
	protected $popoverOptions;
	
	
	protected $responsive;
	


	var $allowWrapLink = true;	// Allow embedding for links (default: true)


	/*
	 * Constuctor
	 *
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 
	 *  @domClass	: CSS Class
	 *  @domId		: Markup ID
	 * 	@selectors	: Markup selectors
	 * 	@route		: array of URL params
	 * 	@phone		: Phone behaviors (only adding CSS class for the moment (Bootstrap))
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);

		$this->arg('styles', 		null, $args);
		$this->arg('domClass', 		null, $args);
		$this->arg('domId', 		null, $args);
		$this->arg('selectors', 	null, $args);
		$this->arg('linkSelectors', null, $args);
		$this->arg('route', 		null, $args);
		$this->arg('submitEventName', 	null, $args);
		$this->arg('responsive',		null, $args);


		$this->arg('popover',		 	null, $args);
		$this->arg('popoverOptions', 	null, $args);
		
		
		if ($this->submitEventName)
			$this->addSelector($this->submitEventName, $this->getSubmitAction());

		if ($this->responsive)
			$this->addClass($this->getResponsiveClass());
	}

	protected function parseVars($vars)
	{
		$responsive = $this->getResponsiveClass();
		
		return parent::parseVars(array_merge(array(
			'RESPONSIVE'	=> ($responsive?' ' . $responsive:'')	
		), $vars));
	}

	public function addStyle($property, $value)
	{
		$this->styles[$property] = $value;
	}

	public function getStyles()
	{
		$styleStr = "";

		foreach($this->styles as $property => $value)
			$styleStr .= $property . ':' . $value . ';';

		return $styleStr;
	}

	public function addSelector($key, $value)
	{
		$value = htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
		
		if (!isset($this->selectors))
			$this->selectors = array();

		if (!in_array($key, array_keys($this->selectors)))
			$this->selectors[$key] = "";

		$this->selectors[$key] .= $value;
	}

	protected function buildDomStyles()
	{
		$styleStr = $this->getStyles();
		if (trim($styleStr) == "")
			return '';

		return ' style="' . $styleStr . '"';
	}

	public function addClass($class)
	{
		if (!in_array($class, $this->classes))
			$this->classes[] = $class;
	}

	protected function getDomClass()
	{
		$domClass = $this->domClass;
		
		if (!is_array($domClass))
		{
			//Trim spaces
			$domClass = preg_replace("/\s+/", " ", $domClass);
			$domClass = explode(' ', $domClass);
		}

		if (is_array($domClass))
			$this->classes = array_merge($this->classes, $domClass);
		

		return implode(' ', $this->classes);
	}

	protected function buildDomClass()
	{
		$class = $this->getDomClass();
		if (!$class)
			return '';

		return ' class="' . $class . '"';
	}


	protected function buildSelectors($selectors = null)
	{

		if (!$selectors && isset($this->selectors))
			$selectors = $this->selectors;
		else
			return;

		if (is_string($selectors))
			return ' ' . $selectors;

		$html = "";

		if ($selectors)
			foreach($selectors as $key => $value)
			{
				$html .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
			}

		return $html;
	}

	protected function getTaskExec()
	{
		return '';
	}
	
	protected function getSubmitAction()
	{
		$jinput = $this->app->input;
		
		$cmd = "Joomla.";
		
		//Check if opened in modal
		if ($jinput->get('tmpl') == 'component')
			$cmd .= "submitformAjax()";
		else
			$cmd .= "submitform()";
		
		$cmd = "return " . $cmd;
		
		return $cmd;	
	}

	protected function jsCommand()
	{
		//When a static link is set : No JS execution
		if (!empty($this->route))
			return;
		
		$cmd = '';
		$version = new JVersion;
		
		if ($this->jVersion('2.5'))
			$jinput = JFactory::getApplication()->input;		
		else		
			$jinput = new JInput;
		
		$task = $this->getTaskExec();
		
		$checkList = false;
		//Grid task
		if (is_numeric($this->num))
		{
			$cmd = "listItemTask('cb" . (int)$this->num . "', '" . $this->getTaskExec(true) . "')";
		
			//Embed in a test to check if an item is checked
			if (isset($this->list) && $this->list)
				$checkList = true;
		}
		
		//Toolbar task button
		else if (!empty($task))
		{
			$taskCtrl = $this->getTaskExec(true);
			
			$cmd = "Joomla.";
			
			//Check if opened in modal
			if ($jinput->get('tmpl') == 'component')
				$cmd .= "submitformAjax";
			else
				$cmd .= "submitform";
			
				
			$cmd = "return " . $cmd . "('" . $taskCtrl . "');";
			
			
			//Because there is no other place for it...
			switch($task)
			{
				case 'delete':
					$this->alertConfirm = JText::_('JDOM_ALERT_ASK_BEFORE_REMOVE');
					break;
	
				case 'trash':
					$this->alertConfirm = JText::_('JDOM_ALERT_ASK_BEFORE_TRASH');
					break;
			}
			
		}
		
		if (empty($cmd))
			return;
		
		//Embed in a confirmation alert box
		if (isset($this->alertConfirm) && $this->alertConfirm)
		{
			$cmd = "if (window.confirm('" . addslashes($this->JText($this->alertConfirm)) . "')){"
					. 		$cmd
					. 	"}";
		}
		
		//Embed in a test to check if an item is checked
		if ($checkList)
		{
			$msgList = JText::sprintf('JLIB_HTML_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST', $task);
			
			$cmd = 	"if (document.adminForm.boxchecked.value==0){"
				.		"alert('" . addslashes($msgList)  ."');"
				.	"}else{"
				. 		$cmd
				. 	"}";
		}
		
		$this->link_js = $cmd;
	}

	protected function createRoute()
	{
		if (!isset($this->route))
			return;
		
		$target = null;
		if (isset($this->target))
			$target = $this->target;
		
		$this->href = $this->getRoute($this->route, $target);
	}
	
	protected function embedLink($html)
	{
		if (!$this->allowWrapLink)
			return $html;

/* TO FINISH
		if ($this->popover)
		{
			
			$html = JDom::_("html.link.popover", array(
			
				'content' => $html,
				'popover' => $this->popover,
				'popoverOptions' => $this->popoverOptions,
			));
			
			//Ends here
			return $html;
		}
*/

		$this->createRoute();


		//Automaticaly create the title
		if (isset($this->titleKey) && isset($this->dataObject) && $this->dataObject)
			$this->link_title = $this->parseKeys($this->dataObject, $this->titleKey);
		

		if ((isset($this->href) || isset($this->target) ||  isset($this->task)) && (isset($this->dataValue)) && (basename($this->dataValue) != ""))
		{
			$html = JDom::_("html.link", array(
				'href' => (isset($this->href)?$this->href:null),
				'task' => (isset($this->task)?$this->task:null),
				'num' => (isset($this->num)?$this->num:null),
				'link_title' => (isset($this->link_title)?$this->link_title:null),
				'selectors' => (isset($this->linkSelectors)?$this->linkSelectors:null),
				'content' => $html,
				'target' => (isset($this->target)?$this->target:null),
				'handler' => (isset($this->handler)?$this->handler:null),
			));
		}

		return $html;
	}

	protected function getResponsiveClass($responsive = null)
	{
		if (!$responsive)
			$responsive = $this->responsive;

		// Only use bootstrap		
		if (in_array($responsive, array(
			'visible-desktop', 'hidden-desktop',
			'visible-tablet', 'hidden-tablet',
			'visible-phone', 'hidden-phone',
		)))
			return $responsive;
	
		return '';	
	}
}