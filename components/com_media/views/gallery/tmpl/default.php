<?php
/**
 * @version		$Id: default.php 17726 2010-06-17 14:39:49Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
jimport('joomla.html.html.behavior');

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

$pageClass = $this->params->get('pageclass_sfx');
//Loading Mootools

JHtml::script("media/mediagalleries/js/script.js",true);
//JHtml::stylesheet("media/mediagalleries/css/gallery.css");



?>
<div class="category-list <?php echo $pageClass;?>">

	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1>
		<?php echo $this->escape($this->title); ?>
	</h1>
	<?php endif; ?>

	
	
	<?php
	//Review the following condition
	 if (is_array($this->children) && count($this->children) > 0 )  : ?>
	<div class="jcat-children">
		<h3>
			<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
		</h3>

		<?php echo $this->loadTemplate('children'); ?>

	</div>
	<?php endif; ?>
		<div class="cat-items">
		<?php echo $this->loadTemplate('gallery'); ?>
	</div>

	</div>
	

</div>