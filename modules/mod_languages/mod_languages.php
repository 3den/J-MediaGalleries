<?php
/**
 * @version		$Id: mod_languages.php 17726 2010-06-17 14:39:49Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	mod_languages
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).DS.'helper.php';

$headerText	= JString::trim($params->get('header_text'));
$footerText	= JString::trim($params->get('footer_text'));

$list 	= modLanguagesHelper::getList($params);
require JModuleHelper::getLayoutPath('mod_languages', $params->get('layout', 'default'));
