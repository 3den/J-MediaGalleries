<?php
/**
 * @version		$Id: default.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @package		Joomla.Administrator
 * @subpackage	com_login
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Get the login modules
$modules = JModuleHelper::getModules('login');

foreach ($modules as $module)
// Render the login modules
	echo JModuleHelper::renderModule($module, array('style' => 'rounded', 'id' => 'section-box'));

