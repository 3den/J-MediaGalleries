<?php
/**
 * @version		$Id: view.html.php 10206 2008-04-17 02:52:39Z instance $
 * @package		Joomla
 * @subpackage	Weblinks
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * View for Gallery
 *
 * @static
 * @package		Joomla
 * @subpackage	Mediagalleries
 * @since 1.0
 */
class MediagalleriesViewGallery extends JView
{
	
    /**
     * Hellos view display method
     * @return void
     **/
    function display($tpl = null)   
    {		
		$app=&JFactory::getApplication();
					
		// Initialize some variables
		$user		=& JFactory::getUser();
		$document	= &JFactory::getDocument();
		$uri 		= &JFactory::getURI();
		$pathway	= &$app->getPathway();
		$this->params=& $app->getParams();
		$model =& $this->getModel('gallery');
		
    	// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
    	
    	
		//Access Check
		$user	= &JFactory::getUser();
		$groups	= $user->authorisedLevels();
		
     	// Get some data from the model
		
		//$total		=& $this->get('total');
		
		$this->pagination=& $model->getPagination();
		$this->category  =& $model->getCategory();
		$this->items	 =& $model->getItems();
		$this->state	 =& $model->getState();		
		$this->children= $model->getChildren();
				
		// Title TODO
		/*
		if(!empty($this->category)){
			$this->title = $this->category->title;
		}
		elseif(is_object($menu)){
			$this->title = $menu->title;
		}
		else{
			
			$title = JText::_($this->category->title);
		}	
		*/	
	
		$this->action=$uri->toString();
		
		$this->user=&JFactory::getUser();
		//Display
		parent::display($tpl);
    }

}
