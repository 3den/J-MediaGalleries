<?php
/**
 * @version		$Id: edit_ftp.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @package		Joomla.Administrator
 * @subpackage	com_templates
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
?>
<fieldset title="<?php echo JText::_('COM_TEMPLATES_FTP_TITLE'); ?>">
	<legend><?php echo JText::_('COM_TEMPLATES_FTP_TITLE'); ?></legend>

	<?php echo JText::_('COM_TEMPLATES_FTP_DESC'); ?>

	<?php if (JError::isError($this->ftp)): ?>
		<p class="error"><?php echo JText::_($this->ftp->message); ?></p>
	<?php endif; ?>

	<table class="adminform">
		<tbody>
			<tr>
				<td width="120">
					<label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
				</td>
				<td>
					<input type="text" id="username" name="username" class="inputbox" size="70" value="" />
				</td>
			</tr>
			<tr>
				<td width="120">
					<label for="password"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
				</td>
				<td>
					<input type="password" id="password" name="password" class="inputbox" size="70" value="" />
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>


