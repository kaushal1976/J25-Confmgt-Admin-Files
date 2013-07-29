<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Contents
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



/**
* Confmgt Helper functions.
*
* @package	Confmgt
* @subpackage	Helper
*/
class ConfmgtCkHelper
{
	/**
	* Cache for ACL actions
	*
	* @var object
	*/
	protected static $acl = null;

	/**
	* Call a JS file. Manage fork files.
	*
	* @access	protected static
	* @param	JDocument	$doc	Document.
	* @param	string	$base	Component base from site root.
	* @param	string	$file	Component file.
	* @param	boolean	$replace	Replace the file or override. (Default : Replace)
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected static function addScript($doc, $base, $file, $replace = true)
	{
		$url = JURI::root(true) . '/' . $base . '/' . $file;
		$url = str_replace(DS, '/', $url);
		
		$urlFork = null;
		if (file_exists(JPATH_SITE .DS. $base .DS. 'fork' .DS. $file))
		{
			$urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
			$urlFork = str_replace(DS, '/', $urlFork);
		}

		if ($replace && $urlFork)
			$url = $urlFork;

		$doc->addScript($url);

		if (!$replace && $urlFork)
			$doc->addScript($urlFork);
	}

	/**
	* Call a CSS file. Manage fork files.
	*
	* @access	protected static
	* @param	JDocument	$doc	Document.
	* @param	string	$base	Component base from site root.
	* @param	string	$file	Component file.
	* @param	boolean	$replace	Replace the file or override. (Default : Override)
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected static function addStyleSheet($doc, $base, $file, $replace = false)
	{
		$url = JURI::root(true) . '/' . $base . '/' . $file;
		$url = str_replace(DS, '/', $url);

		$urlFork = null;
		if (file_exists(JPATH_SITE .DS. $base .DS. 'fork' .DS. $file))
		{
			$urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
			$urlFork = str_replace(DS, '/', $urlFork);
		}

		if ($replace && $urlFork)
			$url = $urlFork;

		$doc->addStyleSheet($url);

		if (!$replace && $urlFork)
			$doc->addStyleSheet($urlFork);
	}

	/**
	* Configure the Linkbar.
	*
	* @access	public static
	* @param	varchar	$view	The name of the active view.
	* @param	varchar	$layout	The name of the active layout.
	* @param	varchar	$alias	The name of the menu. Default : 'menu'
	* @return	void
	*
	* @since	1.6
	*/
	public static function addSubmenu($view, $layout, $alias = 'menu')
	{
		$items = self::getMenuItems();

		// Will be handled in XML in future (or/and with the Joomla native menus)
		// -> give your opinion on j-cook.pro/forum

		
		$client = 'admin';
		if (JFactory::getApplication()->isSite())
			$client = 'site';
	
		$links = array();
		switch($client)
		{
			case 'admin':
				switch($alias)
				{
					case 'cpanel':
					case 'menu':
					default:
						$links = array(
							'admin.tracs.default',
							'admin.themes.default',
							'admin.authors.default',
							'admin.authors.authorsorder',
							'admin.main.default',
							'admin.revrs.default',
							'admin.revs.default',
							'admin.revspapers.default',
							'admin.camera.default',
							'admin.presentation.default',
							'admin.fullpapers.default',
							'admin.revoutcomes.default',
							'admin.authpapers.default'
						);
								
						if ($alias != 'cpanel')
							array_unshift($links, 'admin.cpanel');
					
						break;
				}
				break;
		
			case 'site':
				switch($alias)
				{
					case 'cpanel':
					case 'menu':
					default:
						$links = array(
							'site.authors.default',
							'site.authors.authorsorder',
							'site.main',
							'site.revrs',
							'site.revs',
							'site.revspapers',
							'site.camera',
							'site.presentation',
							'site.fullpapers',
							'site.revoutcomes',
							'site.authpapers'
						);
								
						if ($alias != 'cpanel')
							array_unshift($links, 'site.cpanel');
					
						break;
				}
				break;
		}


		//Compile with selected items in the right order
		$menu = array();
		foreach($links as $link)
		{
			if (!isset($items[$link]))
				continue;	// Not found
		
			$item = $items[$link];
	
			// Menu link
			$extension = 'com_confmgt';
			if (isset($item['extension']))
				$extension = $item['extension'];
	
			$url = 'index.php?option=' . $extension;
			if (isset($item['view']))
				$url .= '&view=' . $item['view'];
			if (isset($item['layout']))
				$url .= '&layout=' . $item['layout'];
	
			// Is active
			$active = ($item['view'] == $view);
			if (isset($item['layout']))
				$active = $active && ($item['layout'] == $layout);
	
			// Reconstruct it the Joomla format
			$menu[] = array(JText::_($item['label']), $url, $active, $item['icon']);

		}

		$version = new JVersion();
		//Create the submenu in the old fashion way
		if (version_compare($version->RELEASE, '3.0', '<'))
		{
			$html = "";	
			// Prepare the submenu module
			foreach ($menu as $entry )
				JSubMenuHelper::addEntry($entry[0], $entry[1], $entry[2]);
		}

		return $menu;
	}

	/**
	* Prepare the enumeration static lists.
	*
	* @access	public static
	* @param	string	$ctrl	The model in wich to find the list.
	* @param	string	$fieldName	The field reference for this list.
	*
	* @return	array	Prepared arrays to fill lists.
	*/
	public static function enumList($ctrl, $fieldName)
	{
		$lists = array();

		$lists["authors"]["title"] = array();
		$lists["authors"]["title"]["prof"] = array("value" => "prof", "text" => JText::_("CONFMGT_ENUM_AUTHORS_TITLE_PROF"));
		$lists["authors"]["title"]["dr"] = array("value" => "dr", "text" => JText::_("CONFMGT_ENUM_AUTHORS_TITLE_DR"));
		$lists["authors"]["title"]["mr"] = array("value" => "mr", "text" => JText::_("CONFMGT_ENUM_AUTHORS_TITLE_MR"));
		$lists["authors"]["title"]["mrs"] = array("value" => "mrs", "text" => JText::_("CONFMGT_ENUM_AUTHORS_TITLE_MRS"));
		$lists["authors"]["title"]["ms"] = array("value" => "ms", "text" => JText::_("CONFMGT_ENUM_AUTHORS_TITLE_MS"));
		$lists["authors"]["title"]["other"] = array("value" => "other", "text" => JText::_("CONFMGT_ENUM_AUTHORS_TITLE_OTHER"));


		$lists["revrs"]["title"] = array();
		$lists["revrs"]["title"]["prof"] = array("value" => "prof", "text" => JText::_("CONFMGT_ENUM_REVRS_TITLE_PROFESSOR"));
		$lists["revrs"]["title"]["dr"] = array("value" => "dr", "text" => JText::_("CONFMGT_ENUM_REVRS_TITLE_DR"));
		$lists["revrs"]["title"]["mr"] = array("value" => "mr", "text" => JText::_("CONFMGT_ENUM_REVRS_TITLE_MR"));
		$lists["revrs"]["title"]["mrs"] = array("value" => "mrs", "text" => JText::_("CONFMGT_ENUM_REVRS_TITLE_MRS"));
		$lists["revrs"]["title"]["ms"] = array("value" => "ms", "text" => JText::_("CONFMGT_ENUM_REVRS_TITLE_MS"));
		$lists["revrs"]["title"]["other"] = array("value" => "other", "text" => JText::_("CONFMGT_ENUM_REVRS_TITLE_OTHER"));


		$lists["revs"]["mode"] = array();
		$lists["revs"]["mode"]["abs"] = array("value" => "abs", "text" => JText::_("CONFMGT_ENUM_REVS_MODE_ABSTRACT"));
		$lists["revs"]["mode"]["full"] = array("value" => "full", "text" => JText::_("CONFMGT_ENUM_REVS_MODE_FULL_PAPER"));


		$lists["revs"]["recommondation"] = array();
		$lists["revs"]["recommondation"]["1"] = array("value" => "1", "text" => JText::_("CONFMGT_ENUM_REVS_RECOMMONDATION_ACCEPTS_AS_IT_IS"));
		$lists["revs"]["recommondation"]["2"] = array("value" => "2", "text" => JText::_("CONFMGT_ENUM_REVS_RECOMMONDATION_ACCEPT_SUBJECTED_MINOR_AMENDMENTS"));
		$lists["revs"]["recommondation"]["3"] = array("value" => "3", "text" => JText::_("CONFMGT_ENUM_REVS_RECOMMONDATION_MAJOR_CHANGES_REQUIRED"));
		$lists["revs"]["recommondation"]["4"] = array("value" => "4", "text" => JText::_("CONFMGT_ENUM_REVS_RECOMMONDATION_REJECT"));


		$lists["revoutcomes"]["mode"] = array();
		$lists["revoutcomes"]["mode"]["abstract"] = array("value" => "abstract", "text" => JText::_("CONFMGT_ENUM_REVOUTCOMES_MODE_ABSTRACT"));
		$lists["revoutcomes"]["mode"]["full"] = array("value" => "full", "text" => JText::_("CONFMGT_ENUM_REVOUTCOMES_MODE_FULL"));


		$lists["revoutcomes"]["review_outcome"] = array();
		$lists["revoutcomes"]["review_outcome"]["0"] = array("value" => "0", "text" => JText::_("CONFMGT_ENUM_REVOUTCOMES_REVIEW_OUTCOME_NOT_AVAILABLE"));
		$lists["revoutcomes"]["review_outcome"]["1"] = array("value" => "1", "text" => JText::_("CONFMGT_ENUM_REVOUTCOMES_REVIEW_OUTCOME_ACCEPT_AS_IT_IS"));
		$lists["revoutcomes"]["review_outcome"]["2"] = array("value" => "2", "text" => JText::_("CONFMGT_ENUM_REVOUTCOMES_REVIEW_OUTCOME_ACCEPT_SUBJECT_TO_MINOR_CHANGES"));
		$lists["revoutcomes"]["review_outcome"]["3"] = array("value" => "3", "text" => JText::_("CONFMGT_ENUM_REVOUTCOMES_REVIEW_OUTCOME_MAJOR_CHANGES_REQUIRED"));




		return $lists[$ctrl][$fieldName];
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	*
	* @return	JObject	An ACL object containing authorizations
	*
	* @deprecated	Cook 2.0
	*/
	public static function getAcl()
	{
		return self::getActions();
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	* @param	integer	$itemId	The item ID.
	*
	* @return	JObject	An ACL object containing authorizations
	*
	* @since	1.6
	*/
	public static function getActions($itemId = 0)
	{
		if (isset(self::$acl))
			return self::$acl;

		$user	= JFactory::getUser();
		$result	= new JObject;

		$actions = array(
			'core.admin',
			'core.manage',
			'core.create',
			'core.edit',
			'core.edit.state',
			'core.edit.own',
			'core.delete',
			'core.delete.own',
			'core.view.own',
		);

		foreach ($actions as $action)
			$result->set($action, $user->authorise($action, COM_CONFMGT));

		self::$acl = $result;

		return $result;
	}

	/**
	* Load all menu items.
	*
	* @access	public static
	* @return	void
	*
	* @since	Cook 2.0
	*/
	public static function getMenuItems()
	{
		// Will be handled in XML in future (or/and with the Joomla native menus)
		// -> give your opinion on j-cook.pro/forum

		$items = array();

		$items['admin.tracs.default'] = array(
			'label' => 'CONFMGT_LAYOUT_TRACKS',
			'view' => 'tracs',
			'layout' => 'default',
			'icon' => 'confmgt_tracs'
		);

		$items['admin.themes.default'] = array(
			'label' => 'CONFMGT_LAYOUT_THEMES',
			'view' => 'themes',
			'layout' => 'default',
			'icon' => 'confmgt_themes'
		);

		$items['admin.authors.default'] = array(
			'label' => 'CONFMGT_LAYOUT_AUTHORS',
			'view' => 'authors',
			'layout' => 'default',
			'icon' => 'confmgt_authors'
		);

		$items['admin.authors.authorsorder'] = array(
			'label' => 'CONFMGT_LAYOUT_AUTHORS_ORDER',
			'view' => 'authors',
			'layout' => 'authorsorder',
			'icon' => 'confmgt_authors'
		);

		$items['admin.main.default'] = array(
			'label' => 'CONFMGT_LAYOUT_PAPERS',
			'view' => 'main',
			'layout' => 'default',
			'icon' => 'confmgt_main'
		);

		$items['admin.revrs.default'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEWERS',
			'view' => 'revrs',
			'layout' => 'default',
			'icon' => 'confmgt_revrs'
		);

		$items['admin.revs.default'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEWS',
			'view' => 'revs',
			'layout' => 'default',
			'icon' => 'confmgt_revs'
		);

		$items['admin.revspapers.default'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEWERS_FOR_PAPERS',
			'view' => 'revspapers',
			'layout' => 'default',
			'icon' => 'confmgt_revspapers'
		);

		$items['admin.camera.default'] = array(
			'label' => 'CONFMGT_LAYOUT_CAMERA_READY',
			'view' => 'camera',
			'layout' => 'default',
			'icon' => 'confmgt_camera'
		);

		$items['admin.presentation.default'] = array(
			'label' => 'CONFMGT_LAYOUT_PRESENTATIONS',
			'view' => 'presentation',
			'layout' => 'default',
			'icon' => 'confmgt_presentation'
		);

		$items['admin.fullpapers.default'] = array(
			'label' => 'CONFMGT_LAYOUT_FULL_PAPERS',
			'view' => 'fullpapers',
			'layout' => 'default',
			'icon' => 'confmgt_fullpapers'
		);

		$items['admin.revoutcomes.default'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEW_OUTCOMES',
			'view' => 'revoutcomes',
			'layout' => 'default',
			'icon' => 'confmgt_revoutcomes'
		);

		$items['admin.authpapers.default'] = array(
			'label' => 'CONFMGT_LAYOUT_AUTHORS_FOR_PAPERS',
			'view' => 'authpapers',
			'layout' => 'default',
			'icon' => 'confmgt_authpapers'
		);

		$items['admin.cpanel'] = array(
			'label' => 'CONFMGT_LAYOUT_CONFMGT',
			'view' => 'cpanel',
			'icon' => 'confmgt_cpanel'
		);

		$items['site.authors.default'] = array(
			'label' => 'CONFMGT_LAYOUT_AUTHORS',
			'view' => 'authors',
			'layout' => 'default',
			'icon' => 'confmgt_authors'
		);

		$items['site.authors.authorsorder'] = array(
			'label' => 'CONFMGT_LAYOUT_AUTHORS_ORDER',
			'view' => 'authors',
			'layout' => 'authorsorder',
			'icon' => 'confmgt_authors'
		);

		$items['site.main'] = array(
			'label' => 'CONFMGT_LAYOUT_PAPERS',
			'view' => 'main',
			'icon' => 'confmgt_main'
		);

		$items['site.revrs'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEWERS',
			'view' => 'revrs',
			'icon' => 'confmgt_revrs'
		);

		$items['site.revs'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEWS',
			'view' => 'revs',
			'icon' => 'confmgt_revs'
		);

		$items['site.revspapers'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEWERS_FOR_PAPERS',
			'view' => 'revspapers',
			'icon' => 'confmgt_revspapers'
		);

		$items['site.camera'] = array(
			'label' => 'CONFMGT_LAYOUT_CAMERA_READY',
			'view' => 'camera',
			'icon' => 'confmgt_camera'
		);

		$items['site.presentation'] = array(
			'label' => 'CONFMGT_LAYOUT_PRESENTATIONS',
			'view' => 'presentation',
			'icon' => 'confmgt_presentation'
		);

		$items['site.fullpapers'] = array(
			'label' => 'CONFMGT_LAYOUT_FULL_PAPERS',
			'view' => 'fullpapers',
			'icon' => 'confmgt_fullpapers'
		);

		$items['site.revoutcomes'] = array(
			'label' => 'CONFMGT_LAYOUT_REVIEW_OUTCOMES',
			'view' => 'revoutcomes',
			'icon' => 'confmgt_revoutcomes'
		);

		$items['site.authpapers'] = array(
			'label' => 'CONFMGT_LAYOUT_AUTHORS_FOR_PAPERS',
			'view' => 'authpapers',
			'icon' => 'confmgt_authpapers'
		);

		$items['site.cpanel'] = array(
			'label' => 'CONFMGT_LAYOUT_CONFMGT',
			'view' => 'cpanel',
			'icon' => 'confmgt_cpanel'
		);

		return $items;
	}

	/**
	* Defines the headers of your template.
	*
	* @access	public static
	*
	* @return	void	
	* @return	void
	*/
	public static function headerDeclarations()
	{
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();

		$siteUrl = JURI::root(true);

		$baseSite = 'components' .DS. COM_CONFMGT;
		$baseAdmin = 'administrator' .DS. 'components' .DS. COM_CONFMGT;

		$componentUrl = $siteUrl . '/' . str_replace(DS, '/', $baseSite);
		$componentUrlAdmin = $siteUrl . '/' . str_replace(DS, '/', $baseAdmin);

		//Javascript
		//jQuery Loading : Abstraction to handle cross versions of Joomla
		JDom::_('framework.jquery');
		JDom::_('framework.jquery.chosen');
		JDom::_('framework.bootstrap');

		$doc->addScript($siteUrl . '/media/system/js/core.js');

		//Load the jQuery-Validation-Engine (MIT License, Copyright(c) 2011 Cedric Dugas http://www.position-absolute.com)
		self::addScript($doc, $baseAdmin, 'js' .DS. 'jquery.validationEngine.js');
		self::addStyleSheet($doc, $baseAdmin, 'css' .DS. 'validationEngine.jquery.css');
		ConfmgtHelperHtmlValidator::loadLanguageScript();



		//CSS
		if ($app->isAdmin())
		{
			// Blue stork override
			$styles = "fieldset td.key label{display: block;}fieldset input, fieldset textarea, fieldset select, fieldset img, fieldset button{float: none;}fieldset label, fieldset span.faux-label{float: none;display: inline;min-width: inherit;}";
			$doc->addStyleDeclaration($styles);

			self::addStyleSheet($doc, $baseAdmin, 'css' .DS. 'confmgt.css');
			self::addStyleSheet($doc, $baseAdmin, 'css' .DS. 'toolbar.css');

		}
		else if ($app->isSite())
		{
			self::addStyleSheet($doc, $baseSite, 'css' .DS. 'confmgt.css');
			self::addStyleSheet($doc, $baseSite, 'css' .DS. 'toolbar.css');

		}

		$doc->addStyleSheet('http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css');
	}

	/**
	* Recreate the URL with a redirect in order to : -> keep an good SEF ->
	* always kill the post -> precisely control the request
	*
	* @access	public static
	* @param	array	$vars	The array to override the current request.
	*
	* @return	string	Routed URL.
	*/
	public static function urlRequest($vars = array())
	{
		$parts = array();

		// Authorisated followers
		$authorizedInUrl = array(
					'option' => null, 
					'view' => null, 
					'layout' => null, 
					'Itemid' => null, 
					'tmpl' => null, 
					'lang' => null);

		$jinput = JFactory::getApplication()->input;

		$request = $jinput->getArray($authorizedInUrl);

		foreach($request as $key => $value)
			if (!empty($value))
				$parts[] = $key . '=' . $value;

		$cid = $jinput->get('cid', array(), 'ARRAY');
		if (!empty($cid))
		{
			$cidVals = implode(",", $cid);
			if ($cidVals != '0')
				$parts[] = 'cid[]=' . $cidVals;
		}

		if (count($vars))
		foreach($vars as $key => $value)
			$parts[] = $key . '=' . $value;

		return JRoute::_("index.php?" . implode("&", $parts), false);
	}


}

// Search for a fork to be able to override this class
JLoader::register('ConfmgtHelper', JPATH_ADMIN_CONFMGT .DS. 'fork' .DS. 'helpers' .DS. 'helper.php');
JLoader::load('ConfmgtHelper');
// Fallback if no fork has been found
if (!class_exists('ConfmgtHelper')){ class ConfmgtHelper extends ConfmgtCkHelper{} }

