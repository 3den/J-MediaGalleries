<?php
/**
 * All Streams Helper of mediagalleries Component
 * @package			Joomla
 * @subpackage	mediagalleries
 * @copyright	Copyright (C) 2005 - 2008 3DEN. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 */

/** 
 * This helper can be used to play a media
 * Enter description here ...
 * @author eden
 *
 */
class PlayerHelper {
	
	/**
	 * 
	 * 
	 * @return string Embed string 
	 * @param string $code
	 */
	function safeStr($code){
		$search = array( '<', '>', '"' );
		$replace = array( '&lt;', '&gt;', '&quot;' );
		
		return	str_replace( $search, $replace, $code);
	}

	/**
	 * Play selected media
	 * 
	 * @return string Media code
	 * @param string $url media to play
	 * @param int $width [optional]
	 * @param int $width [optional]
	 * @param boolean $autoplay True if yes [optional]
	 */
	function play( $url, $width=0, $heigth=0, $autoplay=0 ){
		$media = plgContentMedia::addMedia($url, $width, $heigth, $autoplay );
		return $media;
	}
	
}	

/**
 * Simple debug function
 * @param $data
 */
function dump($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	return true;
}
