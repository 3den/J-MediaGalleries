<?php
/**
 * @version		$Id: view.html.php 19024 2010-10-02 18:53:34Z 3dentech $
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');
jimport('joomla.html.html');

/**
 * The HTML Joomla Core Filesystem Configuration View
 *
 * @package		Joomla.Installation
 * @since		1.6
 */
class JInstallationViewFilesystem extends JView
{
	/**
	 * Display the view
	 *
	 * @access	public
	 */
	function display($tpl = null)
	{
		$state = $this->get('State');
		$form  = $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->assignRef('state', $state);
		$this->assignRef('form', $form);

		JText::script('INSTL_FTP_SETTINGS_CORRECT');
		parent::display($tpl);
	}
}