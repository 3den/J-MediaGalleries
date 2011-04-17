<?php
/**
	 * Embedding function for SWF
	 * @param	video	URL
	 * @param	params	Array containing the keys 'width' , 'height' ,['a'],['p']//p= swf parameters 	
	 * @since	1.6
*/
function extension( $video,$params )
{
	
	$replace= 	'<object '. $params['a'] .' class="mediagalleries" style="'.$params['width'] . $params['height'].'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">'
		. '<param name="movie" value="'. $video .'" />'
		. '<param name="wmode" value="transparent" />'
		. $params['p'] // Params
		. '<!--[if !IE]>-->'
			. '<object '. $params['a'] .' class="mediagalleries" style="'.$params['width'] . $params['height'].'" 
				data="' .$video. '" type="application/x-shockwave-flash"> '
				. '<param name="wmode" value="transparent" />'
				. $params['p'] // Params
		. '<!--<![endif]-->'
				. '<a href="http://www.adobe.com/go/getflashplayer">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" 
							alt="Get Adobe Flash player" style="border:none;" /></a>'
		. '<!--[if !IE]>-->'
			. '</object>'
		. '<!--<![endif]-->'
	.'</object>';

	return $replace;	
}