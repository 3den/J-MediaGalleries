<?php
/**
 * @version		$Id: complete.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;


JHtml::_('behavior.mootools');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>
<div class="reset-complete<?php echo $this->params->get('pageclass_sfx')?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.complete'); ?>" method="post" class="form-validate">

		<?php foreach ($this->form->getFieldsets() as $fieldset): ?>
		<p><?php echo JText::_($fieldset->label); ?></p>		<fieldset>
			<dl>
			<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field): ?>
				<dt><?php echo $field->label; ?></dt>
				<dd><?php echo $field->input; ?></dd>
			<?php endforeach; ?>
			</dl>
		</fieldset>
		<?php endforeach; ?>

		<button type="submit"><?php echo JText::_('JSUBMIT'); ?></button>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>