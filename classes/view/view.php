<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	
* @copyright	Copyright 2013, All rights reserved
* @author		Dr Kaushal Keraminiyage - www.confmgt.com - admin@confmgt.com
* @license		GNU/GPL
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
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');


/**
* HTML View class for the Confmgt component
*
* @package	Confmgt
* @subpackage	Class
*/
class ConfmgtCkClassView extends CkJView
{
	/**
	* Call the parent display function. Trick for forking overrides.
	*
	* @access	protected
	* @param	string	$tpl	Template.
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected function _parentDisplay($tpl)
	{
		parent::display($tpl);
	}

	/**
	* Manage a template override in the fork directory
	*
	* @access	protected
	*
	* @return	void	
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected function addForkTemplatePath()
	{
		$this->addTemplatePath(JPATH_COMPONENT .DS. 'fork' .DS. 'views' .DS. $this->getName() .DS. 'tmpl');
	}

	/**
	* Renders the error stack and returns the results as a string
	*
	* @access	public
	* @param	boolean	$raw	Only stack of string. rendered HTML instead.
	*
	* @return	string	Rendered messages.
	*
	* @since	Cook 2.0
	*/
	public function renderMessages($raw = true)
	{
		// Initialise variables.
		$buffer = null;
		$lists = null;

		// Get the message queue
		$messages = JFactory::getApplication()->getMessageQueue();

		$rawMessages = array();
		// Build the sorted message list
		if (is_array($messages) && !empty($messages))
		{
			foreach ($messages as $msg)
			{
				if (isset($msg['type']) && isset($msg['message']))
				{
					$lists[$msg['type']][] = $msg['message'];
					$rawMessages[] = $msg['message'];
				}
			}
		}

		if ($raw)
			return implode("\n", $rawMessages );

		// Build the return string
		$buffer .= "\n<div id=\"system-message-container\">";

		// If messages exist render them
		if (is_array($lists))
		{
			$buffer .= "\n<dl id=\"system-message\">";
			foreach ($lists as $type => $msgs)
			{
				if (count($msgs))
				{
					$buffer .= "\n<dt class=\"" . strtolower($type) . "\">" . JText::_($type) . "</dt>";
					$buffer .= "\n<dd class=\"" . strtolower($type) . " message\">";
					$buffer .= "\n\t<ul>";
					foreach ($msgs as $msg)
					{
						$buffer .= "\n\t\t<li>" . $msg . "</li>";
					}
					$buffer .= "\n\t</ul>";
					$buffer .= "\n</dd>";
				}
			}
			$buffer .= "\n</dl>";
		}

		$buffer .= "\n</div>";
		return $buffer;
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtClassView', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'classes' .DS. 'view' .DS. 'view.php');
JLoader::load('ConfmgtClassView');
// Fallback if no fork has been found
if (!class_exists('ConfmgtClassView')){ class ConfmgtClassView extends ConfmgtCkClassView{} }

