<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Camera
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



?>
<fieldset class="fieldsfly fly-horizontal">
	<legend><?php echo JText::_('CONFMGT_FIELDSET_CAMERA_READY_PAPER_DETAILS') ?></legend>

	<div class="control-group">
    	<div class="control-label">
			<label for="paper_id">
				<?php echo JText::_( "CONFMGT_FIELD_PAPER_ID" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'paper_id',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="title">
				<?php echo JText::_( "CONFMGT_FIELD_TITLE" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'title',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="abstract">
				<?php echo JText::_( "CONFMGT_FIELD_ABSTRACT" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'abstract',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="camera_ready_paper">
				<?php echo JText::_( "CONFMGT_FIELD_CAMERA_READY_PAPER" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.file.default', array(
											'dataKey' => 'camera_ready_paper',
											'dataObject' => $this->item,
											'height' => 'auto',
											'indirect' => true,
											'root' => '[DIR_CAMERA_CAMERA_READY_PAPER]',
											'target' => 'download',
											'width' => 'auto'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="copyright_transfer">
				<?php echo JText::_( "CONFMGT_FIELD_COPYRIGHT_TRANSFER" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
											'dataKey' => 'copyright_transfer',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>

</fieldset>
