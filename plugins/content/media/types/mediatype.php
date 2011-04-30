<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MediaType{
    
    /**
     * @var String 
     */
    protected $media;
    protected $thumb;
    
    /**
     * @var Array genearated by JParams
     */
    protected $params;

    /**
     * Constructor
     * @param String $media Media Url
     * @param Array $params
     */
    public function MediaType($media, $params){
        $this->media  = $media;
        $this->thumb  = $media;
        $this->params = $params;
    }
    
    /**
     * get the code
     * Enter description here ...
     * @param $media
     */
    public function getMedia(){
    	
    	return 'Invalid Media: ' . $this->media;
    }

    /**
     *
     * Enter description here ...
     * @param unknown_type $media
     * @param unknown_type $width
     * @param unknown_type $height
     * @param unknown_type $params
     */
    public function getThumb(){
    	return "<img src='".$this->thumb."'".
                    "style='".$this->params['thumb_width']." ".$this->params['thumb_height']."' >";
    }

    /**
     * Play videos using the HTML4 aproach
     * @param <type> $video
     * @param <type> $params
     * @return <type>
     */
    protected function html4Player($video, $params){
	return 	'<object '. $params['autostart'] .' class="mediagalleries" style="'.$params['width'] . $params['height'].'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">'
		. '<param name="movie" value="'. $video .'" />'
		. '<param name="wmode" value="transparent" />'
		//. $params['p'] // Params
		. '<!--[if !IE]>-->'
			. '<object '. $params['autostart'] .' class="mediagalleries" style="'.$params['width'] . $params['height'].'"
				data="' .$video. '" type="application/x-shockwave-flash"> '
				. '<param name="wmode" value="transparent" />'
				//. $params['p'] // Params
		. '<!--<![endif]-->'
				. '<a href="http://www.adobe.com/go/getflashplayer">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif"
							alt="Get Adobe Flash player" style="border:none;" /></a>'
		. '<!--[if !IE]>-->'
			. '</object>'
		. '<!--<![endif]-->'
	.'</object>';
    }    
}