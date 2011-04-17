<?php
/**
* @version		$Id: 1pixeloutplayer.php 2008-06-25 duvien.com $
* @package		Joomla 1.5.x
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
*
* One Pixel out audio player v1.5.2
* License: http://www.gnu.org/copyleft/gpl.html
* Author: Du Vien Trang (duvien.com)
* 25 Jun 2008 - Add new 1pixelout player (with volume control) by Duvien
* 25 Jun 2008 - Fixed &amp; not escaping properly (validation) by Nathan Diehl 
* 21 Mar 2008 - Added per-file autoplay, SEF URL compatibility, performance improvements by Art Delano
* 20 Feb 2008 - Minor bug fixed to work on Joomla 1.5 by duvien.com
* 20 Feb 2008 - Ported to Joomla 1.5.x by Lars Schneider
*
* You may wish to improve on it, thanks.
* --- Joomla 1.5.x version created on 20 Feb 2008 ---
* --- Updated on 15 May 2007 ---
* --- Joomla 1.0.x version Created on 20 Feb 2007 ---
*
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
// Import library dependencies
jimport('joomla.event.plugin');
// Add audio-player.js to <HEAD>. This helps to play only one track at a time.
$mainframe->addCustomHeadTag('<script src="'. JURI::base() .'plugins/content/1pixelout/audio-player.js" type="text/javascript"></script>');
$mainframe->registerEvent( 'onPrepareContent', 'bot1pixeloutplayer' );
function bot1pixeloutplayer( &$row, &$params, $page=0 ) {
	global $plugin;
	// define the regular expression for the bot
	$regex = "#{audio(\s+[a-zA-Z]+)?}(.*?){/audio}#s"; // this the MP3 URL is in matches[2], even when autostart is not set
	// the regex will speed up if the wildcard is replaced with URL-legal chars (a-zA-Z0-9/.&#-_;:@?+= etc)
	$plugin =& JPluginHelper::getPlugin('content', '1pixeloutplayer');
	global $plugin;
	if ($plugin->published) {
		$row->text = preg_replace( $regex, '', $row->text );
		return;
	}
	// perform the replacement
	$row->text = preg_replace_callback( $regex, 'bot1pixeloutplayer_replacer', $row->text );
	return true;
}
// this is the 'add parameters' process in bot1pixeloutplayer_replacer()
// $pop1_params contains the parameters common to every player on the site.
function bot1pixeloutplayer_parameterBuilder () {
	static $pop1_params = array();
	if (!$pop1_params) {
		// build the parameters list.
		$plugin =& JPluginHelper::getPlugin('content', '1pixeloutplayer');
		$params = new JParameter( $plugin->params );
		// List of all parameters. Player-specific params are commented out, but noted for reference.
		$pop1_paramlist = array('bg','leftbg','lefticon','rightbg','rightbghover','righticon','righticonhover',
			'text','slider','track','border','loader','loop'/*,'autostart','playerID','soundFile'*/);
		// list of parameters that are color values
		$pop1_paramhex = array('bg','leftbg','lefticon','rightbg','rightbghover','righticon','righticonhover',
			'text','slider','track','border','loader');
		foreach ($pop1_paramlist as $pop1_name) {
			if ($thispop1p = $params->get($pop1_name)) {
				if (array_search($pop1_name,$pop1_paramhex)!==FALSE) { // a color value.
					$thispop1p = "0x$thispop1p";
				}
				$pop1_params[] = "{$pop1_name}=$thispop1p";
			}
		}
	}
	static $pop1_defaultpath = '';
	if (!$pop1_defaultpath) {
		$pop1_defaultpath = JURI::base() . $params->get('defaultpath');  // zzz define the default path and hold it until needed
		$pop1_defaultpath = trim($pop1_defaultpath,' /'); // zzz
	}
	$pop1_allparams = array('pop1_defaultpath'=>$pop1_defaultpath,'pop1_params'=>$pop1_params);
	return $pop1_allparams;
}
function bot1pixeloutplayer_replacer ( &$matches ) {
// this function is called on every mp3 in the page.

// we can speed up a lot if the plugin parameters parser is defined once outside this function.
	$pop1_allparams = bot1pixeloutplayer_parameterBuilder();
	extract ($pop1_allparams,EXTR_SKIP);
// Generic player instance function (returns object tag code)
	global $ap_options, $ap_playerID;
	// Get next player ID
	$ap_playerID++;
	$pop1_params[] = "playerID=$ap_playerID";
	static $pop1_autostarted = 0;
	if (trim($matches[1])=='autostart') {
		// autostart is only engaged for the first mp3 on the page.
		if (!$pop1_autostarted) {
			$pop1_autostarted = 1;
			$pop1_params[] = 'autostart=yes';
		}
	}
	$thisParams = explode("|",$matches[2]);
	if (strpos($thisParams[0],'http://')===FALSE and strpos($thisParams[0],'/')!==0) {
		// If the file is externally hosted or the path is redirected, do not use the default path
		$pop1_params[] = "soundFile={$pop1_defaultpath}/{$thisParams[0]}";
	} else {
		if (strpos($thisParams[0],'/')===0) {
			$pop1_params[] = "soundFile=".JURI::base().ltrim($thisParams[0],'/');
		} else {
			$pop1_params[] = "soundFile={$thisParams[0]}";
		}
	}
	$res = '<span class="1pixelout"><object type="application/x-shockwave-flash" data="'. JURI::base() .'plugins/content/1pixelout/player.swf" id="audioplayer'.$ap_playerID.'" height="24" width="290">
		<param name="movie" value="'. JURI::base() .'plugins/content/1pixelout/player.swf" />
		<param name="FlashVars" value="'.implode('&amp;',$pop1_params).'" />
		<param name="quality" value="high" />
		<param name="menu" value="false" />
		<param name="wmode" value="transparent" />
		</object>
</span>';
	return $res;
}
?>