<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Authors
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


JHtml::addIncludePath(JPATH_ADMIN_CONFMGT.'/helpers/html');
JHtml::_('behavior.tooltip');
//JHtml::_('behavior.multiselect');

$model		= $this->model;
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering' && $listDirn != 'desc';
JDom::_('framework.sortablelist', array(
	'domId' => 'grid-authors',
	'listOrder' => $listOrder,
	'listDirn' => $listDirn,
	'formId' => 'adminForm',
	'ctrl' => 'authors',
	'proceedSaveOrderButton' => true,
));
?>
<div class="clearfix"></div>
<div class="">
	<table class='table' id='grid-authors'>
		<thead>
			<tr>
				<th width="5">
					<?php echo JText::_( 'NUM' ); ?>
				</th>
	
				<?php if ($model->canEdit()): ?>
	            <th width="20">
	            	<?php echo JDom::_('html.form.input.checkbox', array(
						'dataKey' => 'checkall-toggle',
						'title' => JText::_('JGLOBAL_CHECK_ALL'),
						'selectors' => array(
							'onclick' => 'Joomla.checkAll(this);'
						)
					)); ?>
				</th>
				<?php endif; ?>
				<th style="text-align:center">
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_AUTHOR_ID", 'a.id', $listDirn, $listOrder ); ?>
				</th>

				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_TITLE", 'a.title', $listDirn, $listOrder ); ?>
				</th>

				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_FIRST_NAME", 'a.first_name', $listDirn, $listOrder ); ?>
				</th>

				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_SURNAME", 'a.surname', $listDirn, $listOrder ); ?>
				</th>

				<th>
					<?php echo JText::_("CONFMGT_FIELD_EMAIL"); ?>
				</th>

				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_AFFILIATION", 'a.affiliation', $listDirn, $listOrder ); ?>
				</th>

				<th>
					<?php echo JText::_("CONFMGT_FIELD_COUNTRY"); ?>
				</th>

				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_ATTENDING_THE_CONFERENCE", 'a.attending_the_conference', $listDirn, $listOrder ); ?>
				</th>

				<?php if ($this->canDo->get('core.edit.state')): ?>
				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_HEADING_ORDERING", 'a.ordering', $listDirn, $listOrder ); ?>
				</th>
				<?php endif; ?>

				<th>
					<?php echo JText::_("CONFMGT_FIELD_ADDED_BY"); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++):
			$row = &$this->items[$i];
			?>

			<tr class="<?php echo "row$k"; ?>">

				<td class='row_id'>
					<?php echo $this->pagination->getRowOffset( $i ); ?>
		        </td>

				<?php if ($model->canEdit()): ?>
				<td>
					<?php if ($row->params->get('access-edit') || $row->params->get('tag-checkedout')): ?>
						<?php echo JDom::_('html.grid.checkedout', array(
													'dataObject' => $row,
													'num' => $i
														));
						?>
					<?php endif; ?>

				</td>
				<?php endif; ?>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'id',
						'dataObject' => $row,
						'route' => array('view' => 'authorsitem','layout' => 'authorview','cid[]' => $row->id),
						'target' => 'modal'
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly.enum', array(
						'dataKey' => 'title',
						'dataObject' => $row,
						'labelKey' => 'text',
						'list' => ConfmgtHelper::enumList('authors', 'title'),
						'listKey' => 'value'
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'first_name',
						'dataObject' => $row
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'surname',
						'dataObject' => $row
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'email',
						'dataObject' => $row
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'affiliation',
						'dataObject' => $row
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'country',
						'dataObject' => $row
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly.bool', array(
						'commandAcl' => array('core.edit.own', 'core.edit'),
						'dataKey' => 'attending_the_conference',
						'dataObject' => $row,
						'num' => $i,
						'task' => 'authorsitem.toggle_attending_the_conference'
					));?>
				</td>

				<?php if ($this->canDo->get('core.edit.state')): ?>
				<td>
					<?php echo JDom::_('html.grid.ordering', array(
						'aclAccess' => 'core.edit.state',
						'dataKey' => 'ordering',
						'dataObject' => $row,
						'enabled' => $saveOrder
					));?>
				</td>
				<?php endif; ?>

				<td>
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'added_by',
						'dataObject' => $row
					));?>
				</td>

			</tr>
			<?php
			$k = 1 - $k;

		endfor;
		?>
		</tbody>
	</table>
</div>
