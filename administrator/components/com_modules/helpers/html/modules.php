<?php
/**
 * @version		$Id: modules.php 19209 2010-10-22 23:09:34Z chdemko $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	com_modules
 * @since		1.6
 */
abstract class JHtmlModules
{
	/**
	 * @param	int $clientId	The client id
	 * @param	string $state 	The state of the template
	 */
	static public function templates($clientId = 0, $state = '')
	{
		$templates = ModulesHelper::getTemplates($clientId, $state);
		foreach ($templates as $template) {
			$options[]	= JHtml::_('select.option', $template->element, $template->name);
		}
		return $options;
	}
	/**
	 */
	static public function types()
	{
		$options = array();
		$options[] = JHtml::_('select.option', 'user', 'COM_MODULES_OPTION_POSITION_USER_DEFINED');
		$options[] = JHtml::_('select.option', 'template', 'COM_MODULES_OPTION_POSITION_TEMPLATE_DEFINED');
		return $options;
	}

	/**
	 */
	static public function templateStates()
	{
		$options = array();
		$options[] = JHtml::_('select.option', '1', 'JENABLED');
		$options[] = JHtml::_('select.option', '0', 'JDISABLED');
		return $options;
	}
}
