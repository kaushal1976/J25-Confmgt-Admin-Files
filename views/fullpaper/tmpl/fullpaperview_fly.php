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



?>
<fieldset class="fieldsfly fly-horizontal">
	<legend><?php echo JText::_('CONFMGT_FIELDSET_FULL_PAPER_DETAILS') ?></legend>

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
			<label for="_paper_id_title">
				<?php echo JText::_( "CONFMGT_FIELD_PAPER_TITLE_1" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_paper_id_title',
											'dataObject' => $this->item,
											'route' => array('view' => 'paper','layout' => 'abstractview','cid[]' => $this->item->paper_id)
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="full_paper">
				<?php echo JText::_( "CONFMGT_FIELD_FULL_PAPER" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.file.default', array(
											'dataKey' => 'full_paper',
											'dataObject' => $this->item,
											'height' => 'auto',
											'indirect' => true,
											'root' => '[DIR_FULLPAPERS_FULL_PAPER]',
											'target' => 'download',
											'width' => 'auto'
											));
			?>
		</div>
    </div>

</fieldset>
