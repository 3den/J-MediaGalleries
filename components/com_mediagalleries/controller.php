<?php
/**
 * @version		$Id: controller.php 10094 2008-03-02 04:35:10Z instance $
 * @package		Joomla
 * @subpackage	JMultimedia
 * @copyright	Copyright (C) 2007 - 2008 3DEN Open Software. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

/**
 * Mediagalleries front end component controller
 *
 * @static
 */
class MediagalleriesController extends JController {
	
	protected $default_view="galleries";


	function display()
	{
		
		$cachable = true;
		// Get the document object.
		// Set the default view name and format from the Request.
		$vName		= JRequest::getWord('view', 'galleries');
		JRequest::setVar('view', $vName);

		if (($_SERVER['REQUEST_METHOD'] == 'POST' && $vName = 'categories')) {
			$cachable = false;
		}
		$safeurlparams = array('id'=>'INT','limit'=>'INT','limitstart'=>'INT','filter_order'=>'CMD','filter_order_Dir'=>'CMD','lang'=>'CMD');

		parent::display($cachable,$safeurlparams);
	}


}