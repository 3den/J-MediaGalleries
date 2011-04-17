<?php
/**
 * @version		$Id: default_phpinfo.php 19205 2010-10-22 19:50:48Z 3dentech $
 * @package		Joomla.Administrator
 * @subpackage	com_admin
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<fieldset class="adminform">
	<legend><?php echo JText::_('COM_ADMIN_PHP_INFORMATION'); ?></legend>
	<?php echo $this->php_info;?>
</fieldset>