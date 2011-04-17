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
 * Mediagalleries Channels View
 *
 * @package		Joomla.Site
 * @subpackage	com_medigalleries
 * @since 1.5
 */
class MediagalleriesViewChannels extends JView
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
		$app=&JFactory::getApplication();
		// Initialise variables
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$user		=& JFactory::getUser();
		$document	= &JFactory::getDocument();
		$uri 		= &JFactory::getURI();
		$pathway	= &$app->getPathway();	
		$this->params=& $app->getParams();
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		if($this->items === false)
		{
			JError::raiseWarning(404, JText::_("COM_MEDIAGALLERIES_NO_CHANNEL"));
			return false;
		}

		/*
		$params = &$state->params;

        $items = array($parent->id => $items);

		$this->maxLevel=$params->get('maxLevel', -1);
		$this->params=$params;
		$this->parent=$parent;
		$this->items=$items;
		`*/
		parent::display($tpl);
	}

	
}
