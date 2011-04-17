<?php
/**
 * Controller for mediagalleries Component
 * 
 * @package  			mediagalleries Suite
 * @subpackage 	Components
 * @link 				http://3den.org
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/** TODO
 * mediagalleries Controller
 *
 * @package		Joomla
 * @subpackage	mediagalleries
 * @since 1.5
 */
class MediagalleriesController extends JController
{
	protected $default_view = 'galleries';
	
	/**
	 * Method to display a view.
	 *
	 * @since	1.6
	 */
	function display()
	{
		parent::display();

		// Load the submenu.
		MediagalleriesHelper::addSubmenu(JRequest::getWord('view', $this->default_view));
	}
}