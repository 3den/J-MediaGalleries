<?php
/**
 * @version		$Id: view.html.php 19024 2010-10-02 18:53:34Z 3dentech $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * @package		Joomla.Administrator
 * @subpackage	com_users
 */
class UsersViewUser extends JView
{
	protected $form;
	protected $item;
	protected $grouplist;
	protected $groups;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->form			= $this->get('Form');
		$this->item			= $this->get('Item');
		$this->grouplist	= $this->get('Groups');
		$this->groups		= $this->get('AssignedGroups');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->form->setValue('password',		null);
		$this->form->setValue('password2',	null);

		parent::display($tpl);
		$this->addToolbar();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', 1);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$canDo		= UsersHelper::getActions();
		
		
		$isNew	= ($this->item->id == 0);
		JToolBarHelper::title(JText::_($isNew ? 'COM_USERS_VIEW_NEW_USER_TITLE' : 'COM_USERS_VIEW_EDIT_USER_TITLE'), 'user-add');
		if ($canDo->get('core.edit')||$canDo->get('core.create')) {
			JToolBarHelper::apply('user.apply','JTOOLBAR_APPLY');
			JToolBarHelper::save('user.save','JTOOLBAR_SAVE');
		}
		if ($canDo->get('core.create')) {			
			JToolBarHelper::custom('user.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('user.cancel','JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::cancel('user.cancel', 'JTOOLBAR_CLOSE');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_USERS_USER_MANAGER_EDIT');
	}
}