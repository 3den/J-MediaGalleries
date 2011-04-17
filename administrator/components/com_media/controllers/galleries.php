<?php
/**
 * @version		$Id: galleries.php 16093 2010-04-15 06:32:42Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * mediagalleries list controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_media
 * @since		1.6
 */
class MediaControllerGalleries extends JControllerAdmin
{	
	protected $view_list="galleries" ;
	
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Media', $prefix = 'MediaModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

}