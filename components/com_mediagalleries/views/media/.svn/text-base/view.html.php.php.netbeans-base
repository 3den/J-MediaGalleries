<?php
/**
 * View for ... single media view
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
 * Comments View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class MediagalleriesViewMedia extends JView
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
		$model	=& $this->getModel();
		$cparams =& $app->getParams(); 

		// Add default Style
		$document->addStyleSheet( URI_ASSETS. $cparams->get('style', 'default.css') );		
		$model= JModel::getInstance("media");
		// Get some data from the model
		$item	=& $this->get('Data');		
		// Build lists
		$lists 	=& $this->_buildLists($item);
		$links	=& $this->_buildLinks($item);
		
		// TODO :switch layout--Right now making only one layout
		//  Increment views count
		$model->hit();
		$item->hits++;

		// get video			
		$video = PlayerHelper::play($item->url, 
		$cparams->get('width'), 
		$cparams->get('height'), 
		$cparams->get('autostart'));
		$embed = PlayerHelper::safeStr($video); 					
			
		// Comments
		$comments = $this->_buildCommentList($item);
		$comments .= $this->_buildCommentForm($item);

		// Author	
		if($item->author==''){ $item->author = JText::_('Guest'); }  
				
		// Date
		$date =& JFactory::getDate($item->added);
		$item->added = $date->toFormat( JText::_('DATE_FORMAT_LC2') ) ;	
				
		// links
		$links['cat'] = JRoute::_('index.php?option=com_mediagalleries&catid='.$item->catid);
				
				
		// Set page title
		$document->setTitle($item->title);
		$pathway->addItem($item->category, $links['cat']);
		$pathway->addItem($item->alias, '');
						
		//clean data
		JFilterOutput::objectHTMLSafe( $item );//, ENT_QUOTES, 'description' );
					
		// Assign References
		$this->assignRef('embed',	$embed);
		$this->assignRef('comments',	$comments);				
		$this->assignRef('video',	$video);
		break;	
	
		// Assign General References 
		$this->assignRef('params', $cparams);
		$this->assignRef('lists', 	$lists);
		$this->assignRef('links', 	$links);
		$this->assignRef('item',	$item);
		
		// Display
		parent::display($tpl);
    }
	



}