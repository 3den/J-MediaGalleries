<?php
/**
 * @version		$Id: view.html.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
jimport( 'joomla.registry.registry' );


/**
 * View Class for displaying a media
 *
 * @package		Joomla.Site
 * @subpackage	com_mediagalleries
 * @since		1.5
 */
class MediagalleriesViewMedia extends JView
{
	protected $state;
	protected $item;
	public $params;
	protected $category;
	protected $form;
	
	function display($tpl = null)
	{
		$app	= JFactory::getApplication();
		
		// Get some data from the models
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->category	= $this->get('Category');
		$this->params	= $app->getParams();
		
		
		$registry = new JRegistry();
		$registry->loadArray($this->item->params);
		$registry->toObject();
		$this->item->params= $registry;
		
		$layout = $this->getLayout();
		switch ($layout){
			case 'edit':
			case 'form':
				$layout = 'edit';
				$this->form = $this->get('Form');
				break;

			default:
				if ($this->item->url) {	
					$plug=JPluginHelper::getPlugin("content","media");
					$dispatcher=JDispatcher::getInstance();
					$dispatcher->trigger("addMedia");			
					$this->media=plgContentMedia::addMedia($this->item->url,$this->item->params->get('width'),$this->item->params->get('height'),$this->item->params->get('autostart',0));
				} else {
					//TODO create proper error handling
					return  JError::raiseError(404, "COM_MEDIAGALLERIES_MEDIA_NOT_FOUND");	
				}
		}
		$this->setLayout($layout);
	
		parent::display();
	}
}