<?php
/**
 * @version		$Id: route.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @package		Joomla
 * @subpackage	Weblinks
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Component Helper
jimport('joomla.application.component.helper');
jimport('joomla.application.categories');

/**
 * Weblinks Component Route Helper
 *
 * @static
 * @package		Joomla
 * @subpackage	Weblinks
 * @since 1.5
 */
abstract class MediaHelperRoute
{
	protected static $lookup;
	/**
	 * @param	int	The route of the weblink
	 */
	public static function getMediaRoute($id, $catid)
	{
		$needles = array(
			'media'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_media&view=media&id='. $id;
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('Media');
			$category = $categories->get($catid);
			if($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = WeblinksHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		};

		return $link;
	}

	public static function getCategoryRoute($catid)
	{
		$categories = JCategories::getInstance('Media');
		$category = $categories->get((int)$catid);
		$catids = array_reverse($category->getPath());
		$needles = array(
			'category' => $catids,
			'categories' => $catids
		);
		//Create the link
		$link = 'index.php?option=com_media&view=gallery&id='.(int)$catid;

		if ($item = MediagalleriesHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		};

		return $link;
	}

	protected static function _findItem($needles)
	{
		// Prepare the reverse lookup array.
		if (self::$lookup === null)
		{
			self::$lookup = array();

			$component	= JComponentHelper::getComponent('com_media');
			$menus		= JApplication::getMenu('site');
			$items		= $menus->getItems('component_id', $component->id);
			foreach ($items as $item)
			{
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];
					if (!isset(self::$lookup[$view])) {
						self::$lookup[$view] = array();
					}
					if (isset($item->query['id'])) {
						self::$lookup[$view][$item->query['id']] = $item->id;
					}
				}
			}
		}
		foreach ($needles as $view => $ids)
		{
			if (isset(self::$lookup[$view]))
			{
				//return array_shift(array_intersect_key(self::$lookup[$view], $ids));
				foreach($ids as $id)
				{
					if (isset(self::$lookup[$view][(int)$id])) {
						return self::$lookup[$view][(int)$id];
					}
				}
			}
		}

		return null;
	}
}
