<?php
/**
 * @version		$Id: edit_params.php 17112 2010-05-16 22:59:32Z severdia $
 * @package		Joomla.Administrator
 * @subpackage	com_media
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$fieldSets = $this->form->getFieldsets('params');
foreach ($fieldSets as $name => $fieldSet) :
	echo JHtml::_('sliders.panel',JText::_($fieldSet->label), $name.'-params');
	if (isset($fieldSet->description) && trim($fieldSet->description)) :
		echo '<p class="tip">'.$this->escape(JText::_($fieldSet->description)).'</p>';
	endif;
	?>
	<fieldset class="panelform">
		<ul class="adminformlist">
		<?php foreach ($this->form->getFieldset($name) as $field) : ?>
			<li><?php echo $field->label; ?>
			<?php echo $field->input; ?></li>
		<?php endforeach; ?>
		</ul>
	</fieldset>
<?php endforeach; ?>