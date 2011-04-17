<?php
/**
 * mediagalleries View for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license        GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

/**
 * mediagalleries View
 *
 * @package    Joomla.Administrator
 * @subpackage Components
 */
class MediagalleriesViewGalleries extends JView
{
	
	protected $user;
	protected $lists;
	protected $items;
	protected $pagination;
	protected $state;
    /**
     * display method for the galleries view
     * @return void
     **/
    function display($tpl = null)
    {
    	// Vars		
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->user			= JFactory::getUser();
		
    	// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		
		// Display
		self::addToolBar();
		parent::display($tpl);
    }
    
    
	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'mediagalleries.php';

		$state	= $this->get('State');
		$canDo	= MediagalleriesHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_MEDIAGALLERIES_MANAGER_MEDIAS'), 'media');
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('media.add','JTOOLBAR_NEW');
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('media.edit','JTOOLBAR_EDIT');
		}
		JToolBarHelper::divider();
		if ($canDo->get('core.edit.state')) {

			JToolBarHelper::divider();
			JToolBarHelper::custom('galleries.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			JToolBarHelper::custom('galleries.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);

			if ($state->get('filter.state') != -1 ) {
				JToolBarHelper::divider();
				if ($state->get('filter.state') != 2) {
					JToolBarHelper::archiveList('galleries.archive','JTOOLBAR_ARCHIVE');
				}
				else if ($state->get('filter.state') == 2) {
					JToolBarHelper::unarchiveList('galleries.publish', 'JTOOLBAR_UNARCHIVE');
				}
			}
		}
		if(JFactory::getUser()->authorise('core.manage','com_checkin')) {
			JToolBarHelper::custom('galleries.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
		}
		if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'galleries.delete','JTOOLBAR_EMPTY_TRASH');
		} else if ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('galleries.trash','JTOOLBAR_TRASH');
		}
		if ($canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_mediagalleries');
		}
	}
 }