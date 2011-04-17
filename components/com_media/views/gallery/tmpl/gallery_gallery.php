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
<form action="<?php echo JFilterOutput::ampReplace(JFactory::getURI()->toString()); ?>" method="post" name="adminForm">

	<table class="category" border="1">
	<tbody>

			<?php foreach ($this->items as $i => &$media) : ?>
			<tr class="cat-list-row<?php echo $i % 2; ?>">

				<?php if (in_array($media->access, $this->user->authorisedLevels())) : ?>
					<?php $media->thumb=plgContentMedia::getThumb($media->url);
					?>
					<td class="list-title">
						<a href="index.php?option=com_mediagalleries&view=media&layout=modal&tmpl=component&id=<?php echo $media->id; ?>" class="modal"  >
						<img src="<?php echo $media->thumb; ?>" height="<?php echo $this->params->get('thumb_height'); ?>" width="<?php echo $this->params->get('thumb_width'); ?>"  rel="{handler: 'iframe', size: {x:<?php echo $this->params->get('width'); ?>   , y: 500 }}" /></a>
					</td>

					<?php if ($this->params->get('list_show_date')) : ?>
					<td class="list-date">
						<?php echo JHTML::_('date',$media->displayDate, $this->escape(
						$this->params->get('date_format', JText::_('DATE_FORMAT_LC3')))); ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('list_show_author',1)) : ?>
					<td class="list-author">
						<?php echo $this->params->get('link_author', 0) ? JHTML::_('link',JRoute::_('index.php?option=com_users&view=profile&member_id='.$media->created_by),$media->created_by) : $media->created_by; ?>
					</td>
					<?php endif;
					?>

					<?php if ($this->params->get('list_show_hits',1)) : ?>
					<td class="list-hits">
						<?php echo $media->hits; ?>
					</td>
					<?php endif; ?>

				<?php else : ?>
				<td>
					<?php
						echo $this->escape($media->title).' : ';
						$menu		= JFactory::getApplication()->getMenu();
						$active		= $menu->getActive();
						$itemId		= $active->id;
						$link = JRoute::_('index.php?option=com_users&view=login&Itemid='.$itemId);
						//$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug));
						$fullURL = new JURI($link);
						$fullURL->setVar('return', base64_encode($returnURL));
					?>
					<a href="<?php echo $fullURL; ?>" class="register">
						<?php echo JText::_( 'COM_CONTENT_REGISTER_TO_READ_MORE' ); ?></a>
				</td>
				<?php endif; ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		 	<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>

	<div>
		<!-- @TODO add hidden inputs -->
		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
	</div>
</form>
<?php endif; ?>