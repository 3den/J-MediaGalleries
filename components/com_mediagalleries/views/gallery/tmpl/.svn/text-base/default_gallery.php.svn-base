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
JHtml::_('behavior.modal');

JHtmlBehavior::modal();
JHtml::core();

$n = count($this->items);
$preview_width= $this->params->get('preview_width',512);
$preview_height= $this->params->get('preview_height',384);
$thumbs= $this->params->get('thumbs_per_row',3);
$thumbWidth= $this->params->get('thumb_width',100);
$thumbHeight= $this->params->get('thumb_height',75);
?>

<?php if (empty($this->items)) : ?>
	<p><?php echo JText::_('COM_MEDIAGALLERIES_NO_ITEMS'); ?></p>
<?php else : ?>

	<?php foreach ($this->items as $i => &$media) : ?>
			
				<?php if (in_array($media->access, $this->user->authorisedLevels())) : ?>
					<a href="index.php?option=com_mediagalleries&view=media&layout=modal&tmpl=component&id=<?php echo $media->id; ?>" class="modal" ><img src="<?php echo plgContentMedia::getThumb($media->url); ?>" width="<?php echo $this->params->get('thumb_width',100);?>" height="<?php echo $this->params->get('thumb_height',75); ?>" /></a>
				<?php endif; ?>
	
	<?php endforeach; ?>

	<?php endif;?>