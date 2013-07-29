<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Presentation
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
	<legend><?php echo JText::_('CONFMGT_FIELDSET_PRESENTATION_DETAILS') ?></legend>

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
			<label for="_paper_id_title">
				<?php echo JText::_( "CONFMGT_FIELD_PAPER_TITLE" ); ?> :
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
			<label for="_presenter_surname">
				<?php echo JText::_( "CONFMGT_FIELD_PRESENTER" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_presenter_surname',
											'dataObject' => $this->item,
											'route' => array('view' => 'authorsitem','layout' => 'author','cid[]' => $this->item->presenter)
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="biography">
				<?php echo JText::_( "CONFMGT_FIELD_BIOGRAPHY" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'biography',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="presentation">
				<?php echo JText::_( "CONFMGT_FIELD_PRESENTATION" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.file.default', array(
											'dataKey' => 'presentation',
											'dataObject' => $this->item,
											'height' => 'auto',
											'indirect' => true,
											'root' => '[DIR_PRESENTATION_PRESENTATION]',
											'target' => 'download',
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
			<label for="_presenter_paid_and_registered">
				<?php echo JText::_( "CONFMGT_FIELD_PAID_AND_REGISTERED_1" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
											'dataKey' => '_presenter_paid_and_registered',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>

</fieldset>
