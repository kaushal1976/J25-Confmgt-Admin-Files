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


class JDomHtmlLink extends JDomHtml
{
	var $level = 2;				//Namespace position
	var $fallback = 'default';	//Used for default


	protected $href;
	protected $task;
	protected $num;
	protected $link_js;
	protected $content;
	protected $link_title;
	protected $target; // Can be also 'modal'
	protected $handler; // Can be 'iframe'
	protected $modal_width;
	protected $modal_height;
	protected $alertConfirm;


	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *
	 *	@href		: Link
	 *	@task		: Task
	 *	@num		: Row num (for grid tasks)
	 *	@link_js	: Javascript for the link
	 *	@content	: Content of the link
	 *	@link_title	: Title of the link (default : @content)
	 *	@target		: Target of the link  (added to natives targets : 'modal')
	 *	@handler	: Modal handler type (ex:iframe)
	 *	@domClass	: CSS class of the link
	 *	@modal_width	: Modal width
	 *	@modal_height	: Modal height
	 *  @alertConfirm	: will prompt an alert box message to confirm 
	 *
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);

		$this->arg('href'			, null, $args);
		$this->arg('task'			, null, $args);
		$this->arg('num'			, null, $args);
		$this->arg('link_js'		, null, $args); //Deprecated
		$this->arg('content'		, null, $args);
		$this->arg('link_title'		, null, $args);
		$this->arg('target'			, null, $args);
		$this->arg('handler'		, null, $args, 'iframe');
		$this->arg('domClass'		, null, $args);
		$this->arg('modal_width'	, null, $args);
		$this->arg('modal_height'	, null, $args);
		$this->arg('alertConfirm'	, null, $args);

	}

	function buildLink()
	{
		$this->createRoute();
			
		if ($this->target == 'modal')
			$this->modalLink();

		if ($this->task || isset($this->submit))
			$this->jsCommand();
		
		$this->addStyle('cursor', 'pointer');
		
		$html = "<a<%ID%><%CLASS%><%STYLE%><%TITLE%><%HREF%><%JS%><%TARGET%><%SELECTORS%>>"
			.	$this->content
			.	"</a>";

		return $html;
	}


	

	function getTaskExec($ctrl = false)
	{

		//Get the task behind the controller alias (since Joomla 2.5)
		if (!$task = $this->task)
			return;

		$ctrlName = "";

		$parts = explode(".", $task);
		$len = count($parts);
		$taskName = $parts[$len - 1]; //Last
		if ($len > 1)
			$ctrlName = $parts[0];


		if ($ctrl)
			return $ctrlName . "." . $taskName;

		return $taskName;
	}

	function modalLink()
	{
		JHTML::_('behavior.modal');
		
		$this->addClass('modal');
		
		$rel = "{";
		$rel.= "handler: '" . ($this->handler?$this->handler:'') . "'";

		if ($this->modal_width && $this->modal_height)
		{
			$rel .=	", size: {x: " . ((int)$this->modal_width?(int)$this->modal_width:"null")
						. 	", y: " . ((int)$this->modal_height?(int)$this->modal_height:"null")
						. "}";
		}
		$rel.=	"}";
		
		$this->addSelector('rel', $rel);

	}

	protected function parseVars($vars)
	{
		return parent::parseVars(array_merge(array(
			'TITLE' 	=> ($this->link_title?" title=\"".htmlspecialchars($this->link_title)."\"":""),
			'HREF' 		=> ($this->href?" href=\"" .htmlspecialchars($this->href) . "\"":""),
			'JS' 		=> ($this->link_js?" onclick=\"" .htmlspecialchars($this->link_js) . "\"":""),
			'TARGET' 	=> ($this->target?" target='" . $this->target . "'":""),
			'SELECTORS'	=> $this->buildSelectors(),
			'CLASS'		=> $this->buildDomClass(),
			'STYLE'		=> $this->buildDomStyles(),
			'ID'		=> (isset($this->domId)?" id=\"" . $this->domId . "\"":'')
		), $vars));
	}
	
}