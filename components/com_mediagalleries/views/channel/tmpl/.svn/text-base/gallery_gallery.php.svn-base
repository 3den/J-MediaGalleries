<?php
/**
 * @version		$Id: default_gallery.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
JHtml::_('behavior.tooltip');
JHtml::core();

$n = count($this->items);
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
?>

<?php if (empty($this->items)) : ?>
	<p><?php echo JText::_('COM_MEDIAGALLERIES_NO_ITEMS'); ?></p>
<?php else : ?>
			<?php foreach ($this->items as $i => &$media) : ?>
		

				<?php if (in_array($media->access, $this->user->authorisedLevels())) : ?>
					<?php $media->thumb=plgContentMedia::getThumb($media->url);
					?>
				
						<a href="index.php?option=com_mediagalleries&view=media&layout=modal&tmpl=component&id=<?php echo $media->id; ?>" class="modal"  >
						<img src="<?php echo $media->thumb; ?>" height="<?php echo $this->params->get('thumb_height'); ?>" width="<?php echo $this->params->get('thumb_width'); ?>"  rel="{handler: 'iframe', size: {x:<?php echo $this->params->get('width'); ?>   , y: 500 }}" /></a>
				<?php endif; ?>

			<?php endforeach; ?>
	
<?php endif;?>
