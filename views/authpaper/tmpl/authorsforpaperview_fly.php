<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.5.6   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.3.1.2
* @package		Confmgt
* @subpackage	Authpapers
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

	<div class="control-group">
    	<div class="control-label">
			<label for="author_id">
				<?php echo JText::_( "CONFMGT_FIELD_AUTHOR_ID" ); ?> :
			</label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'author_id',
											'dataObject' => $this->item
											));
			?>
		</div>
    </div>
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

</fieldset>
