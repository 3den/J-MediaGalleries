<?php
/**
 * @version		$Id: helper.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @package		Joomla.Site
 * @subpackage	mod_syndicate
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modSyndicateHelper
{
	function getLink(&$params)
	{
		$document = JFactory::getDocument();

		foreach($document->_links as $link)
		{
			if (strpos($link, 'application/'.$params->get('format').'+xml')) {
				preg_match("#href=\"(.*?)\"#s", $link, $matches);
				return $matches[1];
			}
		}

	}
}