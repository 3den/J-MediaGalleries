<?php 
class MediaTypemp3 extends MediaType{
	
	public function getMedia($media='', $width='', $height='', $params=array()){
    	$text='<script language="JavaScript">
				$f("audio", "http://releases.flowplayer.org/swf/flowplayer-3.2.7.swf", {

				// fullscreen button not needed here
				plugins: {
					controls: {
						fullscreen: false,
						height: 30,
						autoHide: false
					}
				},

				clip: {
					autoPlay: true		
				}

				});
					</script>';
    	return "<div id='mediagalleries' style='display:block;.".$width.";".$height."' href='".$media."' ></div>" . $text;
    }

}

?>