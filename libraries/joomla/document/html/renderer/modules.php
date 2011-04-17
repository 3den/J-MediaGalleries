<?php
/**
 * @version		$Id: modules.php 18109 2010-07-13 11:21:43Z 3dentech $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('JPATH_BASE') or die;

/**
 * JDocument Modules renderer
 *
 * @package		Joomla.Framework
 * @subpackage	Document
 * @since		1.5
 */
class JDocumentRendererModules extends JDocumentRenderer
{
	/**
	 * Renders multiple modules script and returns the results as a string
	 *
	 * @param	string	$name		The position of the modules to render
	 * @param	array	$params		Associative array of values
	 * @return	string	The output of the script
	 */
	public function render($position, $params = array(), $content = null)
	{
		$renderer	= $this->_doc->loadRenderer('module');
		$buffer		= '';

		foreach (JModuleHelper::getModules($position) as $mod) {
			$buffer .= $renderer->render($mod, $params, $content);
		}
		return $buffer;
	}
}