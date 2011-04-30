<?php 
class MediaTypemp3 extends MediaType{
	
	public function getMedia($media='', $params=array()){
		$document = &JFactory::getDocument();
		$document->addScript( 'media/mediagalleries/player/flowplayer-3.2.6.min.js' );
		//fix autostart
		$params['autostart'] = isset($params['autostart'])?'false':(boolean) $params['autostart'];
		
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
					autoPlay: '.$params['autostart'].'
				}

				});
					</script>';
    	//echo $text;
    	
    	return "<div id='audio' style='display:block;width:800px;height:50px' href='$media'></div> $text";
    	//return "<div id='audio' style='display:block;".$params['width'].";".$params['height']."' href='".$media."' ></div> $text" ;
    }

}

?>