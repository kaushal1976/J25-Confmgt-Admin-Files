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


class JDomHtmlGridAccesslevel extends JDomHtmlGrid
{
	var $list;

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 * 	@num		: Num position in list
	 *
	 *	@list		: Accesslevels list -> Don't use of Joomla native class to optimize SQL calls
	 */
	function __construct($args)
	{
		parent::__construct($args);
		$this->arg('labelKey', null);

		$this->arg('list', null);	//DEPRECATED

	}

	function build()
	{
		$dataKey = $this->dataKey;
		$row = $this->dataObject;

		$html = JText::_( $this->viewLevelName() );

		return $html;
	}

	function viewLevelName()
	{
		if (isset($this->labelKey) && $this->labelKey !== null)
		{
			$labelKey = $this->labelKey;
			return $this->dataObject->$labelKey;
		}


		$accesslevel = (int)$this->dataValue;

		foreach($this->list as $viewlevels)
		{
			if ($viewlevels->id == $accesslevel)
				return $viewlevels->title;
		}


	}

}