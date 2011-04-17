<?php
/**
 * @version		
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.helper');
/**
 * Weblink Component HTML Helper
 *
 * @static
 * @package		Joomla.Site
 * @subpackage	com_weblinks
 * @since 1.5
 */
class JHTMLIcon
{
	static function create($weblink, $params)
	{
		$uri = JFactory::getURI();

		$url = 'index.php?option=com_weblink&task=weblink.add&return='.base64_encode($uri).'&id=0';

		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/new.png', JText::_('JNEW'), NULL, true);
		} else {
			$text = JText::_('JNEW').'&#160;';
		}

		$attribs	= array('title' => JText::_('JNEW'));
		return JHTML::_('link',JRoute::_($url), $text, $attribs);
	}


	static function edit($weblink, $params, $attribs = array())
	{
		$user = JFactory::getUser();
		$uri = JFactory::getURI();

		if ($params && $params->get('popup')) {
			return;
		}

		if ($weblink->state < 0) {
			return;
		}


		JHtml::_('behavior.tooltip');

		$url = 'index.php?task=weblink.edit&id='.$weblink->id.'&return='.base64_encode($uri);
		$icon = $weblink->state ? 'edit.png' : 'edit_unpublished.png';
		$text = JHTML::_('image','system/'.$icon, JText::_('JGLOBAL_EDIT'), NULL, true);

		if ($weblink->state == 0) {
			$overlib = JText::_('JUNPUBLISHED');
		} else {
			$overlib = JText::_('JPUBLISHED');
		}
		$date = JHTML::_('date',$weblink->created);
		$author = $weblink->created_by_alias ? $weblink->created_by_alias : $weblink->author;

		$overlib .= '&lt;br /&gt;';
		$overlib .= $date;
		$overlib .= '&lt;br /&gt;';
		$overlib .= htmlspecialchars($author, ENT_COMPAT, 'UTF-8');

		$button = JHTML::_('link',JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.JText::_('COM_WEBLINKS_EDIT').' :: '.$overlib.'">'.$button.'</span>';
		return $output;
	}
}