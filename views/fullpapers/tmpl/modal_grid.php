<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Fullpapers
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
<div class="grid_wrapper">
	<table  class='table' id='grid-fullpapers'>
		<thead>
			<tr>
				<th>
					<?php echo JText::_("CONFMGT_FIELD_FULL_PAPER"); ?>
				</th>

				<th width="10px">
					<?php echo JText::_("CONFMGT_FIELD_ID"); ?>
				</th>
			</tr>
		</thead>
	
		<tbody>
			<?php
		//Get the name of the field to populate on return
		$modalObject = JFactory::getApplication()->input->get('object', null, 'cmd');

		$k = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++):
			$row = &$this->items[$i];
			?>
			<?php
			//Group results on : Paper ID > Paper ID
			if (!isset($group_paper_id) || ($row->paper_id != $group_paper_id)):?>
			<tr>
				<th colspan="4" class='grid-group grid-group-1'>
					<span>
						<?php echo JDom::_('html.fly', array(
							'dataKey' => '_paper_id_paper_id',
							'dataObject' => $row
						));?>
					</span>
				</th>
			</tr>
			<?php
			$group_paper_id = $row->paper_id;
			$k = 0;
			endif; ?>
	
			<?php
			//Pickable rows
			//Receive the callback function
			$input = JFactory::getApplication()->input;
			$function	= $input->get('function', 'jSelectItem');
			//Prepare the params to send to the callback
			$pickValue = $row->id;
			$pickLabel = $this->escape(addslashes($row->full_paper));
			$jsPick = "if (window.parent) window.parent.$function('$pickValue', '$pickLabel', '$modalObject');"
			?>
	
			<tr class="<?php echo "row$k"; ?> pickable-row"
				style="cursor:pointer"
				onclick="<?php echo $jsPick; ?>">

				<td>
					<?php echo JDom::_('html.fly.file', array(
						'attrs' => array('format:png'),
						'dataKey' => 'full_paper',
						'dataObject' => $row,
						'height' => 'auto',
						'indirect' => true,
						'root' => '[DIR_FULLPAPERS_FULL_PAPER]',
						'width' => 'auto'
					));?>
				</td>

				<td width="10px">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'id',
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
