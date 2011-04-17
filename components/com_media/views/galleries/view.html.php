<?php
/**
 * @version		$Id: view.html.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * Content categories view.
 *
 * @package		Joomla.Site
 * @subpackage	com_weblinks
 * @since 1.5
 */
class MediaViewGalleries extends JView
{
	protected $state = null;
	protected $item = null;
	protected $items = null;

	/**
	 * Display the view
	 *
	 * @return	mixed	False on error, null otherwise.
	 */
	function display($tpl = null)
	{
		// Initialise variables
		
		$state		= $this->get('State');
		$items		= $this->get('Items');
		$parent		= $this->get('Parent');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		if($items === false)
		{
			JError::raiseWarning(500, "No Gallery");
			return false;
		}

		if($parent == false)
		{
			//TODO Raise error for missing parent category here
		}

		$params = &$state->params;

        $items = array($parent->id => $items);

		$this->maxLevel=$params->get('maxLevel', -1);
		$this->params=$params;
		$this->parent=$parent;
		$this->items=$items;

		parent::display($tpl);
	}

	
}
