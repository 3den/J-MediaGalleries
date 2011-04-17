<?php
/**
 * @version		$Id: mediagalleries.php 17267 2010-05-25 19:16:30Z chdemko $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Mediagallery helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_projects
 * @since		1.6
 */
class MediagalleriesHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 * @since	1.6
	 */
	public static function addSubmenu($vName = 'mediagalleries')
	{
		JSubMenuHelper::addEntry( 
			JText::_('COM_MEDIAGALLERIES_MEDIAS'),
			'index.php?option=com_mediagalleries&view=galleries',
			$vName == 'galleries'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_MEDIAGALLERIES_CATEGORIES'),
			'index.php?option=com_categories&extension=com_mediagalleries',
			$vName == 'categories'
		);		
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId)) {
			$assetName = 'com_mediagalleries';
		} else {
			$assetName = 'com_mediagalleries.category.'.(int) $categoryId;
		}

		$actions = array(
			'core.admin', 
			'core.manage', 
			'core.create', 
			'core.edit', 
			'core.edit.state', 
			'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
}


/**
 * Simple debug function
 * @param $data
 */
function dump($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
