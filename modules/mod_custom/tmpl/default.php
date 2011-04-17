<?php
/**
 * @version		$Id: default.php 18338 2010-08-05 21:29:01Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="custom<?php echo $params->get('moduleclass_sfx') ?>">
	<?php echo $module->content;?>
</div>