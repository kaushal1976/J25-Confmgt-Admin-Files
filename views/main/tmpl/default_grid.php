<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Main
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
?>
<div class="clearfix"></div>
<div class="">
	<table class='table' id='grid-main'>
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
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_ID", 'a.id', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center">
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_PAPER_ID", 'a.paper_id', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center">
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_SUBMITTED_BY", '_user_.name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("CONFMGT_FIELD_TITLE"); ?>
				</th>

				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_STUDENT_PAPER", 'a.student_paper', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("CONFMGT_FIELD_FULL_PAPER"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("CONFMGT_FIELD_CAMERA_READY_PAPER_1"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("CONFMGT_FIELD_PRESENTATION"); ?>
				</th>

				<?php if ($this->canDo->get('core.edit.state') || $this->canDo->get('core.view.own')): ?>
				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_PUBLISH", 'a.publish', $listDirn, $listOrder ); ?>
				</th>
				<?php endif; ?>

				<th>
					<?php echo JHTML::_('grid.sort',  "CONFMGT_FIELD_CREATION_DATE", 'a.creation_date', $listDirn, $listOrder ); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++):
			$row = &$this->items[$i];
			?>
			<?php
			//Group results on : User > Name
			if (!isset($group_user) || ($row->user != $group_user)):?>
			<tr>
				<th colspan="12" class='grid-group grid-group-1'>
					<span>
						<?php echo JDom::_('html.fly', array(
							'dataKey' => '_user_name',
							'dataObject' => $row
						));?>
					</span>
				</th>
			</tr>
			<?php
			$group_user = $row->user;
			$k = 0;
			endif; ?>
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
						'route' => array('view' => 'paper','layout' => 'abstractview','cid[]' => $row->id)
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'paper_id',
						'dataObject' => $row,
						'route' => array('view' => 'paper','layout' => 'abstractview','cid[]' => $row->id)
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_user_name',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'title',
						'dataObject' => $row
					));?>
				</td>

				<td>
					<?php echo JDom::_('html.fly.bool', array(
						'dataKey' => 'student_paper',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.file', array(
						'dataKey' => '_full_paper_full_paper',
						'dataObject' => $row,
						'height' => 'auto',
						'indirect' => true,
						'root' => '[DIR_FULLPAPERS_FULL_PAPER]',
						'route' => array('view' => 'fullpaper','layout' => 'fullpaperview','cid[]' => $row->full_paper),
						'target' => 'modal',
						'width' => 'auto'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.file', array(
						'dataKey' => '_camera_ready_paper_camera_ready_paper',
						'dataObject' => $row,
						'height' => 'auto',
						'indirect' => true,
						'root' => '[DIR_CAMERA_CAMERA_READY_PAPER]',
						'route' => array('view' => 'camerareadyitem','layout' => 'camerareadyitemview','cid[]' => $row->camera_ready_paper),
						'target' => 'modal',
						'width' => 'auto'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.file', array(
						'dataKey' => '_presentation_presentation',
						'dataObject' => $row,
						'height' => 'auto',
						'indirect' => true,
						'root' => '[DIR_PRESENTATION_PRESENTATION]',
						'route' => array('view' => 'presentationitem','layout' => 'presentationitemview','cid[]' => $row->presentation),
						'target' => 'modal',
						'width' => 'auto'
					));?>
				</td>

				<?php if ($this->canDo->get('core.edit.state') || $this->canDo->get('core.view.own')): ?>
				<td>
					<?php echo JDom::_('html.grid.publish', array(
						'commandAcl' => array('core.edit.own', 'core.edit'),
						'ctrl' => 'main',
						'dataKey' => 'publish',
						'dataObject' => $row,
						'num' => $i,
						'togglable' => true
					));?>
				</td>
				<?php endif; ?>

				<td>
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'creation_date',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d'
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
