<?php
/**
 * @version		$Id: default.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	mod_syndicate
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<a href="<?php echo $link ?>" class="syndicate-module<?php echo $params->get('moduleclass_sfx') ?>">
	<?php echo JHTML::_('image','system/livemarks.png', 'feed-image', NULL, true); ?> <span><?php echo $params->get('text') ?></span></a>
