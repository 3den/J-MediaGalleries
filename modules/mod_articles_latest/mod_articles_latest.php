<?php
/**
 * @version		$Id: mod_articles_latest.php 14276 2010-01-18 14:20:28Z louis $
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).DS.'helper.php';

$list = modArticlesLatestHelper::getList($params);
require JModuleHelper::getLayoutPath('mod_articles_latest', $params->get('layout', 'default'));