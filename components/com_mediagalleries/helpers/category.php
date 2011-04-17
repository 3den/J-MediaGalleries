<?php
/**
 * @version		$Id: category.php 14276 2010-01-18 14:20:28Z louis $
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
 * Mediagalleries Component Category Tree
 *
 * @static
 * @package		Joomla
 * @subpackage	Weblinks
 * @since 1.6
 */
class MediagalleriesCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__mediagalleries';
		$options['extension'] = 'com_mediagalleries';
		parent::__construct($options);
	}
}