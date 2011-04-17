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
 */
function addVideoYoutube( $video, $width='', $height='',  $params=array() ){	
	$video = ( strpos( $video, '/v/' ) )? // Condition
		substr( strstr( $video, '/v/' ), 3 ) : // If yes, New way
		substr( strstr( $video, 'v=' ), 2 ) ; // Else, Old way
	
	$embed = '<object style="'.$width . $height.'">'.
		'<param name="movie" value="http://www.youtube.com/v/'.$video.'&'. implode('') .'" />'.
		'<param name="wmode" value="transparent" />'.
		'<embed class="denvideo" style="'.$width . $height.'" 
			src="http://www.youtube.com/v/'.$video.'&autoplay='. $autostart .'"  
			wmode="transparent" type="application/x-shockwave-flash"></embed>'.
	'</object>';
	
	return $embed;
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
		
		$embed = '<object  style="'.$width . $height.'">
			<param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.4" />
			<param name="allowFullScreen" value="true" />
			<param name="flashVars" value="id='.$video[1] .'&vid='.$video[0].'&lang=en-us&intl=us&embed=1" />
			<embed class="denvideo" style="'.$width . $height.'" 
				src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.4" 
				type="application/x-shockwave-flash" 
				allowFullScreen="true" 
				flashVars="id='.$video[1] .'&vid='.$video[0].'&lang=en-us&intl=us&embed=1"></embed>
		</object>';
		
		return $embed;
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
		$embed = '<embed class="denvideo" style="'.$width . $height.'" 
				type="application/x-shockwave-flash" 
				src="http://video.google.com/googleplayer.swf?docid='.$video.'" 
				flashvars="autostart='.$autostart.'">
			</embed>';
			
		return $embed;
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
function addVideoBrighcove( $video, $width='', $height='',  $autostart='0' ){ 
		$video = substr( stristr( $video, 'title=' ), 6 );	
		
		$replace = '<embed class="denvideo" style="'.$width . $height.'"
				src="http://www.brightcove.tv/playerswf" 
				flashVars="initVideoId='.$video.'&servicesURL=http://www.brightcove.tv&viewerSecureGatewayURL=https://www.brightcove.tv&cdnURL=http://admin.brightcove.com&autoStart='.$autostart.'" 
				base="http://admin.brightcove.com" 
				name="bcPlayer" 
				allowFullScreen="true" 
				allowScriptAccess="always" 
				seamlesstabbing="false" 
				type="application/x-shockwave-flash" 
				swLiveConnect="true" 
				pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
		</embed>';
}

/**TODO
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
		$video = substr( stristr( $video, 'videos/' ), 7 ); //' v12316545ACFsJaJY'
		$replace = '<script src="http://flash.revver.com/player/1.0/player.js?mediaId:990840;width:480;height:392;" type="text/javascript"></script>';
}
	
/**TODO
 * Add Megavideo
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoMegavideo( $video, $width='', $height='',  $autostart='0' ){ 
		$video = substr( stristr( $video, 'videos/' ), 7 ); //' v12316545ACFsJaJY'
		$replace = '<script src="http://flash.revver.com/player/1.0/player.js?mediaId:990840;width:480;height:392;" type="text/javascript"></script>';
}	

/**TOFIX
 * Add Veoh
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVeoh( $video, $width='', $height='',  $autostart='0' ){
		$video = substr( stristr( $video, 'videos/' ), 7 ); //' v12316545ACFsJaJY'
		$replace = '<embed class="denvideo" style="'.$width . $height.'"
			src="http://www.veoh.com/veohplayer.swf?permalinkId='.  $video  .'&id=anonymous&player=videodetailsembedded&videoAutoPlay='. $autostart .'" 
			allowFullScreen="true" 
			bgcolor="'. $bgcolor .'" 
			type="application/x-shockwave-flash" 
			pluginspage="http://www.macromedia.com/go/getflashplayer">
		</embed>';
		
		return $replace; 
}
	
/**TOFIX
 * Add SWF vmedia
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */	
function addVideoSWF( $video, $width='', $height='',  $autostart='0' ){ 
		$replace = '<object class="denvideo" style="'.$width . $height.'" 
			classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0">'
			. '<param name="movie" value="'.$video.'" />'
			. '<param name="quality" value="high" />'
			. '<embed class="denvideo" style="'.$width . $height.'" 
				src="'.$video.'" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" ></embed>'
		. '</object>';
		return $replace;		
}
		
/**TODO
 * Add 1pixelout player
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */		
function addMusic1Pixelout( $video, $autostart='0', $params=array() ){
		$player = $paths['plg'].'audioplayer.swf';			
		$play = 'soundFile='.$video.'&autostart='.$autostart.'&file='.$video;
				
		$replace = '<object type="application/x-shockwave-flash" 
			data="'. $player .'" 
			height="24" width="290">
			<param name="movie" value="'. $player .'" />
			<param name="FlashVars" value="'. $play .'" />
			<param name="quality" value="high" />
			<param name="menu" value="false" />
			<param name="wmode" value="transparent" />
		</object>';
		return $replace;
}			

/**TOFIX
 * Add FLV video with flvPlayer
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoFLVPlayer( $video, $width='', $height='',  $autostart='0' ){
		$player = $paths['plg'].'flvplayer.swf';			
		$play = $player.'?autoStart='.$autostart.'&file='.$video;

		$replace = '<object class="denvideo" style="'.$width . $height.'" 
			type="application/x-shockwave-flash" data="'.$play.'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" style="'.$width . $height.'" wmode="transparent" />'.
			'<param name="movie" value="'.$play.'" />'.
			'<param name="wmode" value="transparent" />'.
			'<param name="allowfullscreen" value="1" />'.
			'<embed class="denvideo" style="'.$width . $height.'" 
				src="'.$play.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" 
				allowfullscreen="1" type="application/x-shockwave-flash"></embed>'.
		'</object>';
		
		return $replace;
}					
	
/**TODO
 * Add with JWPlawer: mp3, flv, mp4, mov 
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoJWPlayer	($video, $width='', $height='',  $autostart='0', $params=array() ){
		$player = $paths['plg'].'mediaplayer.swf';			
		$play = $player.'?autoStart='.$autostart.'&file='.$video;

		$replace = '<object class="denvideo" style="'.$width . $height.'" 
			type="application/x-shockwave-flash" data="'.$play.'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" style="'.$width . $height.'" wmode="transparent" />'.
			'<param name="movie" value="'.$play.'" />'.
			'<param name="wmode" value="transparent" />'.
			'<param name="allowfullscreen" value="1" />'.
			'<embed class="denvideo" style="'.$width . $height.'" 
				src="'.$play.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" 
				allowfullscreen="1" type="application/x-shockwave-flash"></embed>'.
		'</object>';
		
		return $replace;	
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
function addVideoQuicktime	($video, $width='', $height='',  $autostart='0', $params=array() ){	
		$replace = '<object style="'.$width . $height.'" class="denvideo"   
			codebase="http://www.apple.com/qtactivex/qtplugin.cab" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B">'
			. '<param name="src" value="'.$video.'" />'
			. '<param name="controller" value="True" />'
			. '<param name="cache" value="False" />'
			. '<param name="autostart" value="'.$autostart.'" />'
			. '<param name="kioskmode" value="False" />'
			. '<param name="scale" value="tofit" />'
			. '<embed class="denvideo" style="'.$width . $height.'" src="'.$video.'" 
				pluginspage="http://www.apple.com/quicktime/download/" 
				scale="tofit" kioskmode="False" 
				qtsrc="'.$video.'" cache="False" controller="True" type="video/quicktime" autostart="'.$autostart.'" />'
		. '</object>';	
		return $replace;
}
			
/**TOFIX
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

		$replace = '<object class="denvideo" style="'.$width . $height.'" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" >'.
			'<param name="controls" value="ControlPanel" />'.
			'<param name="autostart" value="'.$autostart.'" />'.
			'<param name="src" value="'.$video.'" />'.
			'<embed class="denvideo" style="'.$width . $height.'" 
				src="'.$video.'" type="audio/x-pn-realaudio-plugin" controls="ControlPanel" autostart="'.$autostart.'" />'.
		'</object>';
		return $replace;
}


/**
 * Add Java Applet .class 
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param array $params [optional]
 */
function addAppletJava($video, $width='', $height='',  $params=array() ){			
		$end = strrpos($video, '/');
		$code = substr( $video, 0, $end );
		$video = substr( $video, $end+1 );			
		
		$replace = '<applet class="denvideo" style="'.$width . $height.'"
			codebase="'.$code.'" 
			code="'.$video.'" >
		</applet>';
		return $replace;
}

/**TOFIX
 * Add DivX video
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addVideoDivx($video, $width='', $height='',  $autostart='0' ){		
			/* $replace = '<object class="denvideo" classid="CLSID:67DABFBF-D0AB-41fa-9C46-CC0F21721616"'
				. ' codebase="http://download.divx.com/webplayer/stage6/windows/AutoDLDivXWebPlayerInstaller.cab" '
			   	. ' type="application/x-oleobject" style="'. $width . $height .'">'
			   	. ' <param name="src" value="'. $video .'" />'
			   	. ' <param name="custommode" value="Stage6" />'
			  	. ' <param name="showControls" value="1" />'
			  	. ' <param name="showpostplaybackad" value="false" />'
		      	. ' <param name="autoplay" value="'. $autostart .'" />'
		      	. ' <embed type="video/divx" src="'. $video .'" class="denvideo" '
		      		. ' style="'. $width . $height .'" '
		      		. ' pluginspage="http://go.divx.com/plugin/download/" '
		      		. ' showpostplaybackad="false" custommode="Stage6" '
		      		. ' autoplay="'. $autostart .'" />'
			.'</object>'; */
			$replace = '<embed class="denvideo" style="'.$width . $height.'" type="video/divx" 
				src="'.$video.'" custommode="none" mode="zero" autoPlay="'.$autostart.'"  
				pluginspage="http://go.divx.com/plugin/download/">
			</embed>';
			return $replace;
}
		
/**TOFIX
 * Add Windows Media formats
 * 
 * @return embed tag
 * @param string $video url
 * @param string $width [optional]
 * @param string $height [optional]
 * @param bool $autostart [optional]
 * @param array $params [optional]
 */
function addWindowsMedia($video, $width='', $height='',  $autostart='0' ){		
		$replace = '<object class="denvideo" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6"
			type="application/x-oleobject" style="'. $width . $height .'">'
			. '<param name="URL" value="'. $video .'" />'
			. '<param name="stretchToFit" value="1" />'
			. '<param name="showControls" value="1" />'
			. '<param name="showStatusBar" value="0" />'
			. '<param name="animationAtStart" value="1" />'
			. '<param name="autoStart" value="'. $autostart .'" />'
			. '<param name="enableFullScreenControls" value="1" />'
			. '<embed class="denvideo" src="'. $video .'" style="'. $width . $height .'" 
					autoStart="'. $autostart .'" animationAtStart="1" 
					enableFullScreenControls="1" 
					type="application/x-mplayer2"/></embed>'
		. '</object>';
		return $replace;
}