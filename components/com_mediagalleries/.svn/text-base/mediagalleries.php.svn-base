<?php
/**
 * @package		Joomla
 * @subpackage	Mediagalleries
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.controller');

// Try to Import Media Plugin
$mediapath = JPATH_SITE.DS.'plugins'.DS.'content'.DS.'media'.DS.'media.php';
if (!file_exists($mediapath)){
	return JError::raiseWarning(404, JText::_('MEDIA_PLUGIN_NOT_INSTALLED')); 
}
if(!JPluginHelper::isEnabled('content','media')){
	return JError::raiseWarning(404,JText::_('MEDIA_PLUGIN_NOT_ENABLED'));
}

// Define paths
define('URI_ASSETS', JPATH_COMPONENT.DS.'assets'.DS );
define('PATH_HELPERS', JPATH_COMPONENT.DS.'helpers'.DS ); 
require_once $mediapath;
require_once PATH_HELPERS.'player.php' ;
require_once PATH_HELPERS.'query.php' ;
// For generating the thumbnails
require_once PATH_HELPERS.'files.php' ;
// For Youtube
require_once PATH_HELPERS.'youtube.php' ;

$controller	= JController::getInstance('Mediagalleries');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();