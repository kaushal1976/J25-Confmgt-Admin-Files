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


class JDomHtmlToolbarButton extends JDomHtmlToolbar
{
	var $fallback = 'standard';

	var $item;

	var $name;
	var $text;
	var $task;
	var $message;
	var $list;

	var $align;
	
	protected $alertConfirm;

	/*
	 * Constuctor
	 * 	@namespace 	: Requested class
	 *  @options	: Parameters
	 *  //@bar		: Joomla Toolbar
	 *
	 *
	 *  @item		: Joomla Toolbar Item arguments (array)  (Overwrite $bar parameter)
	 *	@align		: Item alignement  (float)
	 *  @alertConfirm : Alert a Confirm box
	 * 
	 */
	function __construct($args)
	{
		parent::__construct($args);
		$this->arg('item'	, 2, $args);
		$this->arg('align'	, 3, $args);

	}

	protected function parseVars($vars)
	{
		switch($this->align)
		{
			case 'left':
			case 'right':
				$alignStyle = "float: " . $this->align . ";";
				break;

			case 'center':
				$alignStyle = "display: inline-block;";
				break;
		}
		
		return parent::parseVars(array_merge(array(
			'LI_STYLE' 		=> "list-style:none; " . $alignStyle,
			'LI_ID' 		=> 'toolbar-' . $this->task,
			'BUTTON_STYLE' 	=> 'cursor:pointer',
			'COMMAND' 		=> $this->jsCommand(),
			'ICON_CLASS' 	=> 'icon-16 ' . $this->name,
			'TEXT' 			=> $this->JText($this->text)	
		), $vars));
	}
	
	function getTaskExec($ctrl = false)
	{

		//Get the task behind the controller alias (Joomla 2.5)
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

}