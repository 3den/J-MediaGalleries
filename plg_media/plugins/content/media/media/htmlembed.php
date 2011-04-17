<?php
/**
 * Add youTube video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 * 
 *   	rel: 	Values: 0 or 1. Default is 1. Sets whether the player should load related 
 *   			videos once playback of the initial video starts. Related videos are displayed 
 *   			in the "genie menu" when the menu button is pressed.
 *   	autoplay: 	Values: 0 or 1. Default is 0. Sets whether or not the initial video 
 *   						will autoplay when the player loads.
 *   	loop:	Values: 0 or 1. Default is 0. In the case of a single video player, a setting of 1 
 *   				will cause the player to play the initial video again and again. In the case of a 
 *   				playlist player (or custom player), the player will play the entire playlist and 
 *   				then start again at the first video.
 *   	enablejsapi:	Values: 0 or 1. Default is 0. Setting this to 1 will enable the Javascript API. 
 *   							For more information on the Javascript API and how to use it, see the 
 *   							JavaScript API documentation.
 *  	playerapiid:	Value can be any alphanumeric string. This setting is used in 
 *  							conjunction with the JavaScript API. See the JavaScript API documentation 
 *  							for details. 
 *   	disablekb:	Values: 0 or 1. Default is 0. Setting to 1 will disable the player keyboard controls. Keyboard controls are as follows:
 *						     Spacebar: Play / Pause
 *						     Arrow Left: Restart current video
 *						     Arrow Right: Jump ahead 10% in the current video
 *						     Arrow Up: Volume up
 *						     Arrow Down: Volume Down
 *   	egm: 	Values: 0 or 1. Default is 0. Setting to 1 enables the "Enhanced Genie Menu". 
 *   				This behavior causes the genie menu (if present) to appear when the user's mouse 
 *   				enters the video display area, as opposed to only appearing when the menu 
 *   				button is pressed.
 *   	border:	Values: 0 or 1. Default is 0. Setting to 1 enables a border around the entire video 
 *   					player. The border's primary color can be set via the color1 parameter, 
 *   					and a secondary color can be set by the color2 parameter.
 *   	color1, color2:	Values: Any RGB value in hexadecimal format. color1 is the primary  
 *   								bordercolor, and color2 is the video control bar background color and 
 *   								secondary border color.
 */
function addVideoYoutube( $video, $width='', $height='', $params=array() ){	

	if( !$width ){
		$width='width: 425px;';
		$height='height: 344px;';// Auto H		
		
		}
	if( strpos( $video, '/v/' ) ) {// If yes, New way
		$video = substr( strstr( $video, '/v/' ), 3 );
		$video = explode( '/', $video);
		$video = $video[0];
	}
	else{// Else, Old way		
		$video = substr( strstr( $video, 'v=' ), 2 ) ; 
		$video = explode( '&', $video);
		$video = $video[0];
	}	
		
	$player = 'http://www.youtube.com/v/'. $video .'&'. implode('&', $params);
	
	$a = '';
	$p = '';
	//Just removed the unnecessary $replace
	return addMediaSWF( $player, $width, $height, $a, $p );
	
}
	
/**
 * Add Yahoo video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoYahoo($video, $width='', $height='',  $autostart='0') {	
	$video = explode( '/', substr( strstr( $video, 'watch/' ), 6 ) );		
	$player = 'http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.4';
	$vars = 'id='. $video[1] .'&vid='. $video[0] .'&autoPlay='. $autostart
		. '&lang=en-us&intl=us&thumbUrl=&embed=1';

	$a = '';
	$p = '<param name="allowFullScreen" value="true" />'
		. '<param name="flashvars" value="'. $vars .'" />';
	
	return addMediaSWF( $player, $width, $height, $a, $p );
	
}

/**
 * Add megaVideo video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoMegavideo($video, $width='', $height='',  $autostart='0' ) {	
	$video = substr( stristr( $video, 'v=' ), 2 );		
	$player = 'http://wwwstatic.megavideo.com/mv_player.swf?v='.$video;
	$vars = 'v='. $video .'&autoplay='. ($autostart? 1: 0);
	
	
	$a = '';
	$p = '<param name="allowFullScreen" value="true" />
		<param name="FlashVars" value="'. $vars .'" />
		<param name="allowScriptAccess" value="always" />';

	return addMediaSWF( $player, $width, $height, $a, $p );
	 
}

/**
 * Add tangle video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoTangle($video, $width='', $height='',  $autostart='0' ) {	
	$video = substr( stristr( $video, 'viewkey=' ), 8 );		
	$player = 'http://www.tangle.com/flash/swf/flvplayer.swf';
	$vars = 'viewkey='. $video .'&autoplay='. ($autostart? 1: 0);
	$a = '';
	$p = '<param name="allowFullScreen" value="true" />
		<param name="FlashVars" value="'. $vars .'" />
		<param name="quality" value="high" />
		<param name="allowScriptAccess" value="always" />';

/*
<embed src="http://www.tangle.com/flash/swf/flvplayer.swf" 		FlashVars="viewkey=7c79617810cccc01df2a" wmode="transparent" quality="high" 
width="330" height="270" name="tangle" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
*/

	return addMediaSWF( $player, $width, $height, $a, $p );
	 
}

/**
 * Add Yahoo video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoGameTrailers($video, $width='', $height='',  $autostart='0') {	
	$video = explode( '/', substr( strstr( $video, 'watch/' ), 6 ) );		

	$a = '';
	$p = '<param name="allowfullscreen" value="true" />';

	return	addMediaSWF( $player, $width, $height, $a, $p );
	
}
/**
 * Add Google video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */	
function 	addVideoGoogle( $video, $width='', $height='',  $autostart='0' ){
	$video = substr( stristr( $video, 'docid=' ), 6 );		
	$vars = 'autoPlay='.$autostart;
	$player = 'http://video.google.com/googleplayer.swf?docid='.$video;
	
	$a= '';
	$p='<param name="flashvars" value="'. $vars .'" />';
		
	return	addMediaSWF( $player, $width, $height, $a, $p );
	
}
	
/**
 * Add Brightcove video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoBrightcove( $video, $width='', $height='',  $autostart='0' ){ 
	$video = substr( stristr( $video, 'title=' ), 6 );	
	$player = 'http://www.brightcove.tv/playerswf';
	$vars = 'initVideoId='.$video .'&autoStart='. ( ($autostart)? 'true': 'false' )
		.'&allowFullScreen=true&servicesURL=http://www.brightcove.tv&viewerSecureGatewayURL=https://www.brightcove.tv&cdnURL=http://admin.brightcove.com'; 
	//flashVars='allowFullScreen=true&initVideoId=1541120765&servicesURL=http://www.brightcove.tv&viewerSecureGatewayURL=https://www.brightcove.tv&cdnURL=http://admin.brightcove.com&autoStart=false' 	

	/*
	$a = '';
	$p = '<param name="flashvars" value="'. $vars .'" />'
		.'<param name="base" value="http://admin.brightcove.com" />'
		.'<param name="allowFullScreen" value="true" />'
		.'<param name="allowScriptAccess" value="always" />'
		.'<param name="seamlesstabbing" value="false" />'
		.'<param name="swLiveConnect" value="true" />';	
	$replace = addMediaSWF( $player, $width, $height, $a, $p );
	*/

	// opera code
	return "<embed src='http://www.brightcove.tv/playerswf'  class='mediagalleries' style='".$width . $height."'
	flashVars='".$vars."' 
	base='http://admin.brightcove.com' 
	allowFullScreen='true' allowScriptAccess='always' seamlesstabbing='false' swLiveConnect='true'
	type='application/x-shockwave-flash'  pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash'></embed>";

}

/**
 * Add Metacafe video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoMetacafe( $video, $width='', $height='',  $autostart='0' ){ 
	$video = substr( stristr( $video, 'watch/' ), 6 ); //' v12316545ACFsJaJY'
	$video = explode('/', $video);
	$video = 'http://www.metacafe.com/fplayer/'. $video[0] .'/'. $video[1] .'.swf';
	$vars = 'playerVars=showStats=no|autoPlay='.( ($autostart)? 'yes': 'no' ).'|videoTitle='
		.'&altServerURL=http://www.metacafe.com';
	
	$a= '';
	$p = '<param name="flashVars" value="'. $vars .'" />';
	
	return addMediaSWF( $video, $width, $height, $a, $p );
		
}
	

/**
 * Add Veoh
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoVeoh( $video, $width='', $height='',  $autostart='0', $bgcolor='#afafaf' ){
		$video = substr( stristr( $video, 'videos/' ), 7 ); //' v12316545ACFsJaJY'
			
		return '<embed class="mediagalleries" style="'.$width . $height.'"
			src="http://www.veoh.com/veohplayer.swf?permalinkId='.  $video  .'&id=anonymous&player=videodetailsembedded&videoAutoPlay='. $autostart .'" 
			allowFullScreen="true" 
			bgcolor="'. $bgcolor .'" 
			type="application/x-shockwave-flash" 
			pluginspage="http://www.macromedia.com/go/getflashplayer">
		</embed>';
}
	
	
/**
 * Add Picture
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param string $p [optional]
 * @param string $atr [optional]
 */			
function addPicture( $img, $width='', $height='', $a='' ){ 		
	return	'<img '. $a .' class="mediagalleries" style="'.$width . $height.'" src="'. $img .'" />';
	
}			
	
/**
 * Add SWF media
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param string $p [optional]
 * @param string $atr [optional]
 */			
function addMediaSWF( $video, $width='', $height='', $a='',  $p='' ){ 		
	$replace= 	'<object '. $a .' class="mediagalleries" style="'.$width . $height.'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">'
		. '<param name="movie" value="'. $video .'" />'
		. '<param name="wmode" value="transparent" />'
		. $p // Params
		. '<!--[if !IE]>-->'
			. '<object '. $a .' class="mediagalleries" style="'.$width . $height.'" 
				data="' .$video. '" type="application/x-shockwave-flash"> '
				. '<param name="wmode" value="transparent" />'
				. $p // Params
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
		
/**
 * Add 1pixelout player
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */		
function addMusic1Pixelout( $video, $width='', $height='', $params=array() ){
	$player = $params['path_player'].'1pixeloutplayer.swf';			
	$vars = 'soundFile='.$video.'&autostart='.$params['autostart'];
	
	$a = '';
	$p = '<param name="FlashVars" value="'. $vars .'" />'
		. '<param name="quality" value="high" />'
		. '<param name="menu" value="false" />';
		
	$replace = addMediaSWF($player, $width, $height, $a, $p);
				
	return $replace;
}			

/**
 * Add FLV video with flvPlayer
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param array $params [optional]
 */
function addVideo2KPlayer( $video, $width='', $height='',  $params='0' ){
	$player = $params['path_player'].'2kplayer.swf';			
	$video = $player.'?file='.$video. '&autoStart='. $params['autostart'];

	$a = '';
	$p = '';

	return addMediaSWF($video, $width, $height, $a, $p);
		
	
}					
	
/**
 * Add with JWPlawer: MP3, FLV, SWF, JPG, GIF, PNG, H264 file or a playlist.
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param array $params [optional]
 */
function addVideoJWPlayer	($video, $width='', $height='', $params=array() ){
		$player = $params['path_player'].'jwplayer.swf';	
		$vars = 'file='.$video .'&'. implode('&', $params['flashvars']);

		$a = '';
		$p = '<param name="flashvars" value="'. $vars .'" />'
			. '<param name="quality" value="high" />'
			. '<param name="menu" value="false" />'
			. '<param name="allowfullscreen" value="true" />'
			. '<param name="allowscriptaccess" value="always" />';
			
		return addMediaSWF($player, $width, $height, $a, $p);
		
}	

/**
 * Add quicktime video: mov, mp4
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoQuicktime	($video, $width='', $height='',  $autostart='0'){	
		
	$replace = '<object class="mediagalleries" style="'.$width . $height.'" 
		classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab">'
		. '<param name="src" value="'.$video.'" />'
		. '<param name="qtsrc" value="'.$video.'" />'				
		. '<param name="controller" value="true" />'
		. '<param name="autostart" value="'.( ($autostart)? 'true': 'false' ).'" />'
		. '<param name="scale" value="tofit" />'
		
		. '<embed class="mediagalleries" style="'.$width . $height.'" src="'.$video.'" qtsrc="'.$video.'"
				pluginspage="http://www.apple.com/quicktime/download/" type="video/quicktime" 
				scale="tofit" cache="False" controller="true"
				autostart="'.( ($autostart)? 'true': 'false' ).'" />'
	. '</object>';

	return $replace;
}
			
/**
 * Add Realmedia videos and audios
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoRealmedia($video, $width='', $height='',  $autostart='0' ){		
	$replace = '<object class="mediagalleries" style="'.$width . $height.'" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" >'.
		'<param name="controls" value="all" />'.
		'<param name="autostart" value="'.$autostart.'" />'.
		'<param name="src" value="'.$video.'" />'.
		'<embed class="mediagalleries" style="'.$width . $height.'" type="audio/x-pn-realaudio-plugin"
			src="'.$video.'" controls="all" autostart="'.$autostart.'" />'.
	'</object>';
	
	return $replace;
}

/**
 * Add DivX video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 */
function addVideoDivx($video, $width='', $height='',  $autostart='0' ){		

	$replace = '<object style="'.$width . $height.'" 
		classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616"
		codebase="http://go.divx.com/plugin/DivXBrowserPlugin.cab">'
		. '<param name="src" value="'. $video .'" />'
		. '<param name="custommode" value="none" />'
		. '<param name="autoPlay" value="'.( ($autostart)? 'true': 'false' ).'" />'
		. '<param name="mode" value="mini">'
		. '<param name="allowContextMenu" value="true">'
		. '<param name="bannerEnabled" value="false">'
		. '<param name="bufferingMode" value="auto">'

		. '<embed class="mediagalleries" style="'.$width . $height.'" src="'. $video .'" type="video/divx" 
			custommode="none" autoPlay="'.( ($autostart)? 'true': 'false' ).'"  mode="mini"
			allowContextMenu="true" bannerEnabled="false" bufferingMode="auto"
			pluginspage="http://go.divx.com/plugin/download/" ></embed>'
	. '</object>';


	return $replace;
			
}
		
/**TOTEST
 * Add Windows Media formats
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 */
function addVideoWindows($video, $width='', $height='',  $autostart='0' ){		
/*
 	$replace = '<object class="mediagalleries" style="'.$width . $height.'" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6">'
		. '<param name="url"  value="'. $video .'" />'
		. '<param name="src"  value="'. $video .'" />'
		. '<param name="showcontrols" value="true" />'
		. '<param name="stretchToFit" value="true" />'
		. '<param name="showControls" value="true" />'
		. '<param name="showStatusBar" value="false" />'
		. '<param name="animationAtStart" value="true" />'
		. '<param name="autostart" value="'..'" />'
		. '<param name="enableFullScreenControls" value="true" />'
		.'<!--[if !IE]>-->'
		  	. '<object class="mediagalleries" style="'.$width . $height.'" type="application/x-mplayer2" 
		    	data=""'. $video .'" >'
		    	. '<param name="src" value="'. $video .'" />'
		    	. '<param name="autostart" value="true" />'
		    	. '<param name="controller" value="true" />'
		.'<!--<![endif]-->'		
	
		
		.'<!--[if !IE]>-->'
		  	. '</object>'
		.'<!--<![endif]-->'
	. '</object>';
*/

	$replace = '<object classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6"
		class="mediagalleries" style="'.$width . $height.'" >'
		. '<param name="url" value="'. $video .'" />'
		. '<param name="stretchToFit" value="true" />'
		. '<param name="scale" value="tofit" />'		
		. '<param name="showControls" value="true" />'
		. '<param name="showStatusBar" value="false" />'
		. '<param name="animationAtStart" value="true" />'
		. '<param name="autoStart" value="'. ( ($autostart)? 'true': 'false' ) .'" />'
		. '<param name="enableFullScreenControls" value="true" />'
		. '<embed class="mediagalleries" style="'.$width . $height.'"
				src="'. $video .'" type="application/x-mplayer2"
				autoStart="'.( ($autostart)? 'true': 'false' ).'" animationAtStart="true" enableFullScreenControls="true" 
				stretchToFit="true" scale="tofit"
				pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/MediaPlayer/" /></embed>'
	. '</object>';

	return $replace;
}

/**
 * Add Java Applet .class 
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 */
function addAppletJava($video, $width='', $height=''){			
	$end = strrpos($video, '/');
	$code = substr( $video, 0, $end );
	$video = substr( $video, $end+1 );			
	
	$replace = '<applet class="mediagalleries" style="'.$width . $height.'"
		codebase="'.$code.'" 
		code="'.$video.'" >
	</applet>';
	return $replace;
}


/**
 * Add Video error message
 * 
 * @return embed tag
 * @param string $video url
 * @param string $msg error message [optional]
 */
function addMediaError( $video, $msg="Invalid Media: " ){		
	$error = '<q class="class="error">'.$msg.$video.'</q>';
	return $error;
}
