<?php
/**
 * @version		$Id: mod_dencode.php 0.15
 * @package		Joomla 1.5, denCode 0.15
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

$gallery['mode']=$params->get('mode','auto');
$gallery['layout']=$params->get('layout','compact');
$gallery['count']=$params->get('count',5);
$gallery['filter_category']=$params->get('filter_category',1);


// Display
//$layout =  $params->get('layout', 'default' );
include( JModuleHelper::getLayoutPath('mod_mediagalleries', 'default') );