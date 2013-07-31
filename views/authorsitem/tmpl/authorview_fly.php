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



?>
<fieldset class="fieldsfly fly-horizontal">
	<legend><?php echo JText::_('CONFMGT_FIELDSET_AUTHOR_DETAILS') ?></legend>

	<div class="control-group">
    	<div class="control-label">
			<label for="added_by">
				<?php echo JText::_( "CONFMGT_FIELD_ADDED_BY" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'added_by',
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
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'title',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['authors.title'],
											'listKey' => 'value',
											'labelKey' => 'text'
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="first_name">
				<?php echo JText::_( "CONFMGT_FIELD_FIRST_NAME" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'first_name',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="surname">
				<?php echo JText::_( "CONFMGT_FIELD_SURNAME" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'surname',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="email">
				<?php echo JText::_( "CONFMGT_FIELD_EMAIL" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'email',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="affiliation">
				<?php echo JText::_( "CONFMGT_FIELD_AFFILIATION" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'affiliation',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="attending_the_conference">
				<?php echo JText::_( "CONFMGT_FIELD_ATTENDING" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
											'dataKey' => 'attending_the_conference',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="_user_username">
				<?php echo JText::_( "CONFMGT_FIELD_USERNAME" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_user_username',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="paid_and_registered">
				<?php echo JText::_( "CONFMGT_FIELD_PAID_AND_REGISTERED_1" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
											'dataKey' => 'paid_and_registered',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
	<div class="control-group">
    	<div class="control-label">
			<label for="country">
				<?php echo JText::_( "CONFMGT_FIELD_COUNTRY" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'country',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>

</fieldset>
