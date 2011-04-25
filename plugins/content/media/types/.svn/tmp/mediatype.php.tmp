<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class MediaType{
	
	/**
	 * get the code
	 * Enter description here ...
	 * @param $media
	 */
    public function getMedia($media='',  $params=array()){
    	
    	return 'Invalid Server';
    }

    public function html4Player($video, $params){
	return 	'<object '. $params['a'] .' class="mediagalleries" style="'.$params['width'] . $params['height'].'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">'
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
    }


    /**
     * 
     * Enter description here ...
     * @param unknown_type $media
     * @param unknown_type $width
     * @param unknown_type $height
     * @param unknown_type $params
     */
    public function getThumb($media='', $width='', $height='', $params=array()){
    	
    	return '<img scr="defaultimag">';
    }
    
}

class MediaTypeImage extends MediaType{
	public function getMedia($media='', $params=array()){
    	
    	return "<img src='".$media."'". "style='".$params['width']." ".$params['height']."' >";
    }
	
}
?>
