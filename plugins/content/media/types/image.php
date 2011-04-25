<?php
/**
 * For JPG, GIF, PNG...
 */
class MediaTypeImage extends MediaType{
    public function getMedia(){
    	return "<img src='".$this->media."'".
                    "style='".$this->params['width']." ".$this->params['height']."' >";
    }

    public function getThumb(){
	$timthumb= JPATH_SITE.'/media/mediagalleries/thumbs/timthumb/timthumb.php';
	
        // width
        if($this->params['thumb_width']){
            $w= "&w=" . $this->params['thumb_width'];
        }

        // height
        if($this->params['thumb_height']){
            $w= "&w=" . $this->params['thumb_height'];
        }

	return '<img src="' . $timthumb."?src=".$this->media.$w.$h . '" />';
    }
}
