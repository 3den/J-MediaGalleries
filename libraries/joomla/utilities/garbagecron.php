<?php
/**
 * @version		$Id: garbagecron.php 17118 2010-05-17 02:18:15Z eddieajau $
 * @package		Joomla.Framework
 * @subpackage	Utilities
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// BEFORE USING RENAME THIS FILE TO SOMETHING UNIQUE !!!

// Initialize Joomla framework
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);
define('JPATH_BASE', dirname(__FILE__).'/../../..');

/* Required Files */
require_once JPATH_BASE.'/includes/defines.php';
require_once JPATH_BASE.'/includes/framework.php';

// Instantiate the application.
$app = JFactory::getApplication('site');

$cache = JFactory::getCache();
$cache->gc();