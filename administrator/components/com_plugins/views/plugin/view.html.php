<?php
/**
 * @version		$Id: view.html.php 19205 2010-10-22 19:50:48Z 3dentech $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit a plugin.
 *
 * @package		Joomla.Administrator
 * @subpackage	Plugins
 * @since		1.5
 */
class PluginsViewPlugin extends JView
{
	protected $item;
	protected $form;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$canDo		= PluginsHelper::getActions();

		JToolBarHelper::title(JText::sprintf('COM_PLUGINS_MANAGER_PLUGIN', JText::_($this->item->name)), 'plugin');

		// If not checked out, can save the item.
		if ($canDo->get('core.edit')) {
			JToolBarHelper::apply('plugin.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('plugin.save', 'JTOOLBAR_SAVE');
		}
		JToolBarHelper::cancel('plugin.cancel', 'JTOOLBAR_CLOSE');
		JToolBarHelper::divider();
		// Get the help information for the plugin item.

		$lang = JFactory::getLanguage();

		$help = $this->get('Help');
		JToolBarHelper::help($help->key, false, $lang->hasKey($help->url) ? JText::_($help->url) : null);
	}
}
