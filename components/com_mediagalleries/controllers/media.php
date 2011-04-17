<?php
/**
 * @version		$Id: media.php 16403 2010-04-24 00:35:09Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Mediagallery controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_mediagalleries
 * @since		1.6
 */
class MediagalleriesControllerMedia extends JControllerForm
{
	 protected $view_list = 'gallery';
	 protected $view_item = 'media';

}
