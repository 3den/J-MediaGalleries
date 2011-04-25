<?php 
class MediaTypegif extends MediaTypeImage{
	
	
	public function getThumb($media='', $width='', $height=''){
	
		return "<img src='".$media."'". "style='".$width." ".$height."' >";
    }

}

?>