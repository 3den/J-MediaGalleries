<?php
/**
 * @version		$Id: default.php 18338 2010-08-05 21:29:01Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	mod_footer
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="footer1<?php echo $params->get('moduleclass_sfx') ?>"><?php echo $lineone; ?></div>
<div class="footer2<?php echo $params->get('moduleclass_sfx') ?>"><?php echo JText::_('MOD_FOOTER_LINE2'); ?></div>