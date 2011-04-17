<?php
/**
 * @version		$Id: debug.php 19024 2010-10-02 18:53:34Z 3dentech $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Joomla! Debug plugin
 *
 * @package		Joomla
 * @subpackage	System
 */
class plgSystemDebug extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access	protected
	 * @param	object $subject The object to observe
	 * @param	array  $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

	}

	/**
	* Converting the site URL to fit to the HTTP request
	*
	*/
	function onAfterRender()
	{
		global $_PROFILER;

		// Do not render if debugging is not enabled
		if (!JDEBUG) {
			return;
		}

		$document	= JFactory::getDocument();
		$doctype	= $document->getType();

		// Only render for HTML output
		if ($doctype !== 'html') {
			return;
		}

		// If the user is not allowed to view the output then end here
		$filterGroups = (array) $this->params->get('filter_groups', null);
		if (!empty($filterGroups)) {
			$userGroups = JFactory::getUser()->get('groups');
			if (!array_intersect($filterGroups, array_keys($userGroups))) {
				return;
			}
		}

		$profiler	= &$_PROFILER;

		ob_start();
		echo '<div id="system-debug" class="profiler">';
		$errors = JError::getErrors();

		if (!empty($errors)) {
			echo '<h4>'.JText::_('Errors').'</h4><ol>';
			while($error = JError::getError(true)) {
				echo '<li>'.$error->getMessage().'<br /><h4>'.JText::_('Info').'</h4><pre>'.print_r($error->get('info'), true).'</pre><br /><h4>'.JText::_('Backtrace').'</h4>'.JError::renderBacktrace($error).'</li>';
			}
			echo '</ol>';
		}

		if ($this->params->get('profile', 1)) {
			echo '<h4>'.JText::_('PLG_DEBUG_PROFILE_INFORMATION').'</h4>';
			foreach ($profiler->getBuffer() as $mark) {
				echo '<div>'.$mark.'</div>';
			}
		}

		if ($this->params->get('memory', 1)) {
			echo '<h4>'.JText::_('PLG_DEBUG_MEMORY_USAGE').'</h4>';
			$bytes = $profiler->getMemory();
			echo JHtml::_('number.bytes', $bytes);
			echo ' ('.number_format($bytes).' Bytes)';
		}

		if ($this->params->get('queries', 1)) {
			$newlineKeywords = '#\b(FROM|LEFT|INNER|OUTER|WHERE|SET|VALUES|ORDER|GROUP|HAVING|LIMIT|ON|AND)\b#i';

			$db	= JFactory::getDbo();

			echo '<h4>'.JText::sprintf('PLG_DEBUG_QUERIES_LOGGED',  $db->getTicker()).'</h4>';

			if ($log = $db->getLog()) {
				echo '<ol>';
				$selectQueryTypeTicker = array();
				$otherQueryTypeTicker = array();
				foreach ($log as $k => $sql) {
					// Start Query Type Ticker Additions
					$fromStart = stripos($sql, 'from');
					$whereStart = stripos($sql, 'where', $fromStart);
					if ($whereStart === false) {
						$whereStart = stripos($sql, 'order by', $fromStart);
					}
					if ($whereStart === false) {
						$whereStart = strlen($sql) - 1;
					}
					$fromString = substr($sql, 0, $whereStart);
					$fromString = str_replace("\t", " ", $fromString);
					$fromString = str_replace("\n", " ", $fromString);
					$fromString = trim($fromString);

					// Initialize the select/other query type counts the first time:
					if (!isset($selectQueryTypeTicker[$fromString])) {
						$selectQueryTypeTicker[$fromString] = 0;
					}
					if (!isset($otherQueryTypeTicker[$fromString])) {
						$otherQueryTypeTicker[$fromString] = 0;
					}
					// Increment the count:
					if (stripos($sql, 'select') === 0) {
						$selectQueryTypeTicker[$fromString] = $selectQueryTypeTicker[$fromString] + 1;
						unset($otherQueryTypeTicker[$fromString]);
					} else {
						$otherQueryTypeTicker[$fromString] = $otherQueryTypeTicker[$fromString] + 1;
						unset($selectQueryTypeTicker[$fromString]);
					}
					// Finish Query Type Ticker Additions


					$text = htmlspecialchars($sql, ENT_QUOTES);
					$text = preg_replace($newlineKeywords, '<br />&#160;&#160;\\0', $text);
					echo '<li>'.$text.'</li>';
				}
				echo '</ol>';

				if ($this->params->get('query_types', 1)) {
					// Get the totals for the query types:
					$totalSelectQueryTypes = count($selectQueryTypeTicker);
					$totalOtherQueryTypes = count($otherQueryTypeTicker);
					$totalQueryTypes = $totalSelectQueryTypes + $totalOtherQueryTypes;

					echo '<h4>'.JText::sprintf('PLG_DEBUG_QUERY_TYPES_LOGGED', $totalQueryTypes) . '</h4>';

					if ($totalSelectQueryTypes) {
						echo '<h5>'.JText::sprintf('PLG_DEBUG_SELECT_QUERIES').'</h5>';
						arsort($selectQueryTypeTicker);
						echo '<ol>';
						foreach($selectQueryTypeTicker as $table => $occurrences) {
							echo '<li>'.JText::sprintf('PLG_DEBUG_QUERY_TYPE_AND_OCCURRENCES', $table, $occurrences).'</li>';
						}
						echo '</ol>';
					}

					if ($totalOtherQueryTypes) {
						echo '<h5>'.JText::sprintf('PLG_DEBUG_OTHER_QUERIES').'</h5>';
						arsort($otherQueryTypeTicker);
						echo '<ol>';
						foreach($otherQueryTypeTicker as $table => $occurrences) {
							echo '<li>'.JText::sprintf('PLG_DEBUG_QUERY_TYPE_AND_OCCURRENCES', $table, $occurrences).'</li>';
						}
						echo '</ol>';
					}
				}
			}
		}

		$lang = JFactory::getLanguage();
		if ($this->params->get('language_errorfiles', 1)) {
			echo '<h4>'.JText::_('PLG_DEBUG_LANGUAGE_FILES_IN_ERROR').'</h4>';
			$errorfiles = $lang->getErrorFiles();
			if (count($errorfiles)) {
				echo '<ul>';
				foreach ($errorfiles as $file => $error) {
					echo "<li>$error</li>";
				}
				echo '</ul>';
			} else {
				echo '<pre>'.JText::_('JNONE').'</pre>';
			}
		}

		if ($this->params->get('language_files', 1)) {
			echo '<h4>'.JText::_('PLG_DEBUG_LANGUAGE_FILES_LOADED').'</h4>';
			echo '<ul>';
			$extensions	= $lang->getPaths();
			foreach ($extensions as $extension => $files) {
				foreach ($files as $file => $status) {
					echo "<li>$file $status</li>";
				}
			}
			echo '</ul>';
		}

		if ($this->params->get('language_strings')) {
			$stripFirst	= $this->params->get('strip-first');
			$stripPref	= $this->params->get('strip-prefix');
			$stripSuff	= $this->params->get('strip-suffix');

			echo '<h4>'.JText::_('PLG_DEBUG_UNTRANSLATED_STRINGS').'</h4>';
			echo '<pre>';
			$orphans = $lang->getOrphans();
			if (count($orphans)) {
				ksort($orphans, SORT_STRING);
				$guesses = array();

				foreach ($orphans as $key => $occurance) {

					if (is_array($occurance) AND isset($occurance[0])) {
						$info = &$occurance[0];
						$file = @$info['file'];
						if (!isset($guesses[$file])) {
							$guesses[$file] = array();
						}

						// Prepare the key

						if (($pos = strpos($info['string'], '=')) > 0) {
							$parts	= explode('=', $info['string']);
							$key	= $parts[0];
							$guess	= $parts[1];

						} else {
							$guess = str_replace('_', ' ', $info['string']);
							if ($stripFirst) {
								$parts = explode(' ', $guess);
								if (count($parts) > 1) {
									array_shift($parts);
									$guess = implode(' ', $parts);
								}
							}

							$guess = trim($guess);

							if ($stripPref) {
								$guess = trim(preg_replace(chr(1).'^'.$stripPref.chr(1).'i', '', $guess));
							}

							if ($stripSuff) {
								$guess = trim(preg_replace(chr(1).$stripSuff.'$'.chr(1).'i', '', $guess));
							}
						}

						$key = trim(strtoupper($key));
						$key = preg_replace('#\s+#', '_', $key);
						$key = preg_replace('#\W#', '', $key);

						// Prepare the text

						$guesses[$file][] = $key.'="'.$guess.'"';
					}
				}

				foreach ($guesses as $file => $keys) {
					echo "\n\n# ".($file ? $file : JText::_('PLG_DEBUG_UNKNOWN_FILE'))."\n\n";
					echo implode("\n", $keys);
				}
			} else {
				echo JText::_('JNONE');
			}
			echo '</pre>';
		}
		echo '</div>';

		$debug = ob_get_clean();

		$body = JResponse::getBody();
		$body = str_replace('</body>', $debug.'</body>', $body);
		JResponse::setBody($body);
	}
}