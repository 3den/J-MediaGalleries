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
 * @subpackage	com_media
 * @since		1.6
 */

class MediaControllerMedia extends JControllerForm
{
	 protected $view_list = 'galleries';
	 protected $view_item = 'media';
	 
	 
	 	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param	string	The model name. Optional.
	 * @param	string	The class prefix. Optional.
	 * @param	array	Configuration array for model. Optional.
	 *
	 * @return	object	The model.
	 * @since	1.5
	 */
	public function &getModel($name = 'media', $prefix = '', $config = array())
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
	/**
	 * Save the record
	 */
	public function save()
	{
		parent::save();
	}
	/**
	 * Method to cancel an edit
	 *
	 * Checks the item in, sets item ID in the session to null, and then redirects to the list page.
	 *
	 * @access	public
	 * @return	void
	 */
	public function cancel()
	{
		parent::cancel();
	}
	 
	
}
