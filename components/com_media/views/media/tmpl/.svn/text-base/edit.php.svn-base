<?php
/**
 * @version		$Id: edit.php 17133 2010-05-17 06:30:14Z severdia $
 * @package		Joomla.Administrator
 * @subpackage	com_mediagalleries
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>

<div class="<?php echo $this->params->get('pageclass_sfx'); ?>">
	<?php if ($this->params->def('show_page_heading', 1)) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
	
	<form action="<?php JRoute::_('index.php?option=com_mediagalleries'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	
		<div class="formelm_buttons">
			<button type="button" onclick="submitbutton('media.save')">
				<?php echo JText::_('JSAVE') ?>
			</button>
			<button type="button" onclick="submitbutton('media.cancel')">
				<?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
		
		
		<fieldset>
			<legend><?php echo JText::_('JGLOBAL_DESCRIPTION'); ?></legend>
								
			<div class="formelm">
				<?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?>
			</div>
			
			<div class="formelm">
				<?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?>
			</div>

			<div class="formelm">
				<?php echo $this->form->getLabel('url'); ?>
				<?php echo $this->form->getInput('url'); ?>
			</div>
			<?php echo $this->form->getInput('description'); ?>
		</fieldset>
				
		<fieldset>
			<legend><?php echo JText::_('JDETAILS'); ?></legend>
		
			<div class="formelm">
				<?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?>
			</div>
			
			<div class="formelm">
				<?php echo $this->form->getLabel('access'); ?>
				<?php echo $this->form->getInput('access'); ?>
			</div>
			
			<div class="formelm">
				<?php echo $this->form->getLabel('language'); ?>
				<?php echo $this->form->getInput('language'); ?>
			</div>
		</fieldset>	
					
		<div class="formelm_buttons">
			<button type="button" onclick="submitbutton('media.save')">
				<?php echo JText::_('JSAVE') ?>
			</button>
			<button type="button" onclick="submitbutton('media.cancel')">
				<?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
					
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>