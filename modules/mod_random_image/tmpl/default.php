<?php
/**
 * @version		$Id: default.php 19024 2010-10-02 18:53:34Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	mod_random_image
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="random-image<?php echo $params->get('moduleclass_sfx') ?>">
<?php if ($link) : ?>
<a href="<?php echo $link; ?>">
<?php endif; ?>
	<?php echo JHTML::_('image',$image->folder.'/'.$image->name, $image->name, array('width' => $image->width, 'height' => $image->height)); ?>
<?php if ($link) : ?>
</a>
<?php endif; ?>
</div>