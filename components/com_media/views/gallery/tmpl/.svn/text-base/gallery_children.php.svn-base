<?php
/**
 * @version		$Id: default_children.php 17017 2010-05-13 10:48:48Z eddieajau $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$class = ' class="first"';
?>

<?php if (count($this->children) > 0) : ?>
	<ul>
	<?php foreach($this->children as $child) : ?>
		

		<li<?php echo $class; ?>>
			<?php $class = ''; ?>
			<span class="jitem-title"><a href="<?php echo "index.php?option=com_mediagalleries&id=".$child->id;?>">
				<?php echo $this->escape($child->title); ?></a>
			</span>

			<?php if ($child->description) : ?>
				<div class="category-desc">
					<?php echo JHtml::_('content.prepare', $child->description); ?>
				</div>
			<?php endif; ?>

			<?php if ( $this->params->get('show_cat_num_articles',0)) : ?>
			<dl>
				<dt>
					<?php echo JText::_('COM_MEDIAGALLERIES_NUM_ITEMS') ; ?>
				</dt>
				<dd>
					<?php echo $child->getNumItems(true); ?>
				</dd>
			</dl>
			<?php endif ; ?>

			
			</li>
	
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
