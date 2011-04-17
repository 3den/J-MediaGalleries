<?php
/**
 * @version		$Id: default.php 16720 2010-05-04 01:28:24Z eddieajau $
 * @package		Joomla.Site
 * @subpackage	mod_banners
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;


?>
<div>
<b><?php

echo "MEDIA URL : ".$media;
echo "<br/>Width:".$width;
echo "<br/>Height:".$height;
echo "<br/>And autostart is ";
echo $autostart==0? "OFF":  "ON";
?></b>
</div>
