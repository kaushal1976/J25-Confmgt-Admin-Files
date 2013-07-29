<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Revoutcomes
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
	<legend><?php echo JText::_('CONFMGT_FIELDSET_REVIEW_OUTCOME_VIEW') ?></legend>

	<div class="control-group">
    	<div class="control-label">
			<label for="paper_id">
				<?php echo JText::_( "CONFMGT_FIELD_PAPER_ID" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'paper_id',
											'dataObject' => $this->item,
											'route' => array('view' => 'paper','layout' => 'abstractview','cid[]' => $this->item->paper_id)
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="mode">
				<?php echo JText::_( "CONFMGT_FIELD_MODE" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'mode',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['revoutcomes.mode'],
											'listKey' => 'value',
											'labelKey' => 'text'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="review_comment">
				<?php echo JText::_( "CONFMGT_FIELD_REVIEW_COMMENT" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'review_comment',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="review_outcome">
				<?php echo JText::_( "CONFMGT_FIELD_REVIEW_OUTCOME" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'review_outcome',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['revoutcomes.review_outcome'],
											'listKey' => 'value',
											'labelKey' => 'text'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="attachment">
				<?php echo JText::_( "CONFMGT_FIELD_ATTACHMENT" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.file.default', array(
											'dataKey' => 'attachment',
											'dataObject' => $this->item,
											'attrs' => array('format:png'),
											'height' => 'auto',
											'indirect' => true,
											'root' => '[DIR_REVOUTCOMES_ATTACHMENT]',
											'width' => 'auto'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="creation_date">
				<?php echo JText::_( "CONFMGT_FIELD_CREATION_DATE" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'creation_date',
											'dataObject' => $this->item,
											'dateFormat' => "Y-m-d"
											));

			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="modification_date">
				<?php echo JText::_( "CONFMGT_FIELD_MODIFICATION_DATE" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'modification_date',
											'dataObject' => $this->item,
											'dateFormat' => "Y-m-d"
											));

			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="published">
				<?php echo JText::_( "CONFMGT_FIELD_PUBLISHED" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'published',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>

</fieldset>
