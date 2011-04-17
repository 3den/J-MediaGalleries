<?php
/**
 * @version		$Id: view.html.php 17726 2010-06-17 14:39:49Z 3dentech $
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');
jimport('joomla.html.html');

/**
 * The HTML Joomla Core Pre-Install View
 *
 * @package		Joomla.Installation
 * @since		1.6
 */
class JInstallationViewPreinstall extends JView
{
	/**
	 * Display the view
	 *
	 * @param	string
	 *
	 * @return	void
	 * @since	1.6
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->settings		= $this->get('PhpSettings');
		$this->options		= $this->get('PhpOptions');
		$this->sufficient	= $this->get('PhpOptionsSufficient');
		$this->version		= new JVersion;

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		parent::display($tpl);
	}
}