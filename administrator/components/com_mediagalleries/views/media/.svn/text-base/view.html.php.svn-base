<?php
/**
 * Media View for mediagalleries Component
 * 
 * @package    		Joomla
 * @subpackage 	mediagalleries
 * @link 			http://3den.org/joom/
 * @license	GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

/**
 * Media View
 *
 * @package    		Joomla
 * @subpackage	mediagalleries Suite
 */
class MediagalleriesViewMedia extends JView
{
	// new way
	protected $item;
	protected $folder;
	protected $user;
	protected $form;
	protected $state;
	
	/**
	 * display method of Media view
	 * 
	 * @return void
	 */
	public function display($tpl = null)
	{
		$app		=& JFactory::getApplication();
		$document	=& JFactory::getDocument();
		$db			=& JFactory::getDBO();
		$uri 		=& JFactory::getURI();
		$model		=& $this->getModel();
		
		//get the data
		$this->params	=& JComponentHelper::getParams('com_mediagalleries');
		$this->user 	=& JFactory::getUser();
		$this->item		=& $this->get('Item');
		$this->form		=& $this->get('Form');
		$this->state	=& $this->get('State');
		
		// Is new?
		if( !empty($this->item->id) ){
			// Load the plugin!!!
			JPluginHelper::importPlugin('content', 'media');
			$dispatcher =& JDispatcher::getInstance();
			$this->params->set('width', 350);
			$this->params->set('height', 300);
			$results = $dispatcher->trigger('onLoadMedia', array ( &$this->item, &$this->params));
		}
		
		// Add the toolbar
		$this->addToolbar();
		
		//Display
		parent::display($tpl);
	}
		
	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar(){
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);		
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= MediagalleriesHelper::getActions($this->state->get('filter.category_id'), $this->item->id);

		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit'))
		{
			JToolBarHelper::apply('media.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('media.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::addNew('media.save2new', 'JTOOLBAR_SAVE_AND_NEW');
		}
			// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::custom('media.save2copy', 'copy.png', 'copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('media.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('media.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
	}	
}
