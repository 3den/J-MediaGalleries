<?php
/**
 * Media Controller for mediagalleries Component
 * 
 * @package  			Joomla
 * @subpackage 	mediagalleries Suite
 * @link 				http://3den.org
 * @license		GNU/GPL
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_mediagalleries')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//  Check Media Plugin, made platform independent
$mediapath = JPATH_SITE.DS.'plugins'.DS.'content'.DS.'media'.DS.'media.php';
if (!file_exists($mediapath)){
	return JError::raiseWarning(404, JText::_('MEDIA_PLUGIN_NOT_INSTALLED')); 
}
//This is important to give user warning if the Media Plugin Is Not ENABLED
if(!JPluginHelper::isEnabled('content','media')){
	return JError::raiseWarning(404,JText::_('MEDIA_PLUGIN_NOT_ENABLED'));
}

// Include dependancies
jimport('joomla.application.component.controller');
require_once $mediapath;
require_once JPATH_COMPONENT.DS.'helpers'.DS.'mediagalleries.php';

// Define paths
define('URI_ASSETS', JURI::base().'../components/com_mediagalleries/assets/' );
define('PATH_HELPERS', JPATH_COMPONENT_SITE.DS.'helpers'.DS );

// Load Action Controller
$controller	= JController::getInstance('Mediagalleries');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();