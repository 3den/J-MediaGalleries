<?php

/**
 * @version		$Id: default_items.php 18338 2010-08-05 21:29:01Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	com_newsfeeds
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$class = ' class="first"';
if (count($this->items[$this->parent->id]) > 0 && $this->maxLevel != 0) :?>
<ul>
<?php foreach($this->items[$this->parent->id] as $id => $item) : ?>
	<?php
	
	if(!isset($this->items[$this->parent->id][$id + 1]))
	{
		$class = ' class="last"';
	}
	?>
	<li<?php echo $class; ?>>
	<?php $class = ''; ?>
		<span class="jitem-title"><a href="index.php?option=com_mediagalleries&view=gallery&layout=gallery&id=<?php echo $item->id; ?>">
			<?php echo $this->escape($item->title); ?></a>
		</span>
		<?php if ($this->params->get('show_subcat_desc',1) == 1) :?>
		<?php if ($item->description) : ?>
			<div class="category-desc">
				<?php echo JHtml::_('content.prepare', $item->description); ?>
			</div>
		<?php endif; ?>
        <?php endif; ?>
		<?php if ($this->params->get('show_cat_num_links') == 1) :?>
			<dl class="weblink-count"><dt>
				<?php echo JText::_('COM_WEBLINKS_NUM'); ?></dt>
				<dd><?php echo $item->numitems; ?></dd>
			</dl>
		<?php endif; ?>

		<?php if(count($item->getChildren()) > 0) :
			$this->items[$item->id] = $item->getChildren();
			$this->parent = $item;
			$this->maxLevel--;
			echo $this->loadTemplate('items');
			$this->parent = $item->getParent();
			$this->maxLevel++;
		endif; ?>

	</li>
	
<?php endforeach; ?>
</ul>
<?php  endif; ?>