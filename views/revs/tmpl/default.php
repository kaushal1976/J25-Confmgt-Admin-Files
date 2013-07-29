<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Revs
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


ConfmgtHelper::headerDeclarations();
?>
<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">
	<?php
	$compat = '1.6';
	$version = new JVersion();
	if ($version->isCompatible('3.0'))
		$compat = '3.0';
	?>

	<?php if ($compat == '3.0'): ?>
	<div class="row-fluid">
		<div id="sidebar" class="span2">
			<div class="sidebar-nav">
				<div>

					<!-- BRICK : menu -->
					<?php echo JDom::_('html.menu.submenu', array(
						'list' => $this->menu
					)); ?>
				</div>
				<div>

					<!-- BRICK : filters -->
					<hr class="hr-condensed">
					<div class="filter-select hidden-phone">
						<h4 class="page-header"><?php echo JText::_('JSEARCH_FILTER_LABEL');?></h4>

					</div>
				</div>
			</div>
		</div>
		<div id="contents" class="span10">
			<div>

				<!-- BRICK : filters -->
				<div class="pull-left">
					<?php echo $this->filters['search_search_1']->input;?>
				</div>
				<div class="pull-right">
					<?php echo $this->filters['limit']->input;?>
				</div>
				<div class="pull-right">
					<?php echo $this->filters['directionTable']->input;?>
				</div>
				<div class="pull-right">
					<?php echo $this->filters['sortTable']->input;?>
				</div>
				<div class="clearfix"></div>

			</div>
			<div>

				<!-- BRICK : grid -->
				<?php echo $this->loadTemplate('grid'); ?>
			</div>
			<div>

				<!-- BRICK : pagination -->
				<?php echo $this->pagination->getListFooter(); ?>
			</div>
		</div>
	</div>
	<?php elseif ($compat == '1.6'): ?>
	<div>
		<div>

			<!-- BRICK : filters -->
			<div class="pull-right">
				<?php echo $this->filters['limit']->input;?>
			</div>
			<div class="pull-right">
				<?php echo $this->filters['directionTable']->input;?>
			</div>
			<div class="pull-right">
				<?php echo $this->filters['sortTable']->input;?>
			</div>
			<div class="clearfix"></div>
			<div class="pull-right">
				<?php echo $this->filters['search_search_1']->input;?>
			</div>

		</div>
		<div>

			<!-- BRICK : grid -->
			<?php echo $this->loadTemplate('grid'); ?>
		</div>
		<div>

			<!-- BRICK : pagination -->
			<?php echo $this->pagination->getListFooter(); ?>
		</div>
	</div>
	<?php endif; ?>


	<?php 
		$jinput = JFactory::getApplication()->input;
		echo JDom::_('html.form.footer', array(
		'values' => array(
					'view' => $jinput->get('view', 'revs'),
					'layout' => $jinput->get('layout', 'default'),
					'boxchecked' => '0',
					'filter_order' => $this->escape($this->state->get('list.ordering')),
					'filter_order_Dir' => $this->escape($this->state->get('list.direction'))
				)));
	?>
</form>
