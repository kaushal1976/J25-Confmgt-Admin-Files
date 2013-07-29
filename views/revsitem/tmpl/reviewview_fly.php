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



?>
<fieldset class="fieldsfly fly-horizontal">
	<legend><?php echo JText::_('CONFMGT_FIELDSET_REVIEW_DETAILS') ?></legend>

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
			<label for="mode">
				<?php echo JText::_( "CONFMGT_FIELD_MODE" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'mode',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['revs.mode'],
											'listKey' => 'value',
											'labelKey' => 'text'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="reviewer">
				<?php echo JText::_( "CONFMGT_FIELD_REVIEWER" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'reviewer',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="comments_on_title">
				<?php echo JText::_( "CONFMGT_FIELD_COMMENTS_ON_THE_TITLE" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comments_on_title',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="comments_on_originality">
				<?php echo JText::_( "CONFMGT_FIELD_COMMENTS_ON_ORIGINALITY" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comments_on_originality',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="comments_on_methodology">
				<?php echo JText::_( "CONFMGT_FIELD_COMMENTS_ON_METHODOLOGY" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comments_on_methodology',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="comments_on_formatting">
				<?php echo JText::_( "CONFMGT_FIELD_COMMENTS_ON_FORMATTING" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comments_on_formatting',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="comments_on_language">
				<?php echo JText::_( "CONFMGT_FIELD_COMMENTS_ON_THE_LANGUAGE" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comments_on_language',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="comments_to_author">
				<?php echo JText::_( "CONFMGT_FIELD_COMMENTS_TO_AUTHORS" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comments_to_author',
											'dataObject' => $this->item
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
											'root' => '[DIR_REVS_ATTACHMENT]',
											'width' => 'auto'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="recommondation">
				<?php echo JText::_( "CONFMGT_FIELD_RECOMMONDATION" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'recommondation',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['revs.recommondation'],
											'listKey' => 'value',
											'labelKey' => 'text'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="rating">
				<?php echo JText::_( "CONFMGT_FIELD_RATING" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'rating',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="comments_to_coordinator">
				<?php echo JText::_( "CONFMGT_FIELD_COMMENTS_TO_THE_COORDINATOR_1" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comments_to_coordinator',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>

</fieldset>
