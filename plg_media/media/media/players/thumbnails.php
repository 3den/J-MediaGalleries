<?php
function thumbYoutube($media,$width,$height){
	if( strpos( $media, '/v/' ) ) {// If yes, New way
				$video = substr( strstr( $media, '/v/' ), 3 );
				$video = explode( '/', $video);
				$video = $video[0];
			}
	else{	
				$video = substr( strstr( $media, 'v=' ), 2 ) ; // Else, Old way	
				$video = explode( '&', $video);
				$video = $video[0];
			}
			
	
	return 'http://i.ytimg.com/vi/'.$video.'/default.jpg';
}

function thumbVideoYahoo($media, $width, $height){
	//TODO
}

function thumbVideoGoogle($media, $width, $height){
	//TODO
}

function thumbVideoBrightcove( $media, $width, $height){
	//TODO
}
function thumbVideoMetacafe($media, $width, $height, $autostart ){
	//TODO
}
function thumbVideoTangle($media, $width, $height, $autostart ){
	//TODO
}
function thumbVideoMegavideo($media, $width, $height, $autostart ){
	//TODO
}

function thumbMediaSWF($media, $width, $height){
	return 'media/mediagalleries/thumbs/sample-swf.jpg';
}

function thumbAudioMp3($media, $width, $height){
	return 'media/mediagalleries/thumbs/sample-audio.jpg';
}

function thumbFlv($media, $width, $height){
	return 'media/mediagalleries/thumbs/sample-flv.jpg';
}

function thumbH264($media, $width, $height){
}

function thumbVideoQuicktime($media, $width, $height){
	return 'media/mediagalleries/thumbs/sample-quicktime.jpg';
}

function thumbVideoRealmedia($media, $width, $height){
}

function thumbVideoDivx($media, $width, $height){
}

function thumbVideoWindows($media, $width, $height){
}

function thumbDefault(){
	return 'media/mediagalleries/thumbs/sample-none.jpg';
}

function thumbImage($media, $width , $height){
	$timthumb= 'media/mediagalleries/thumbs/timthumb/timthumb.php';
	$w="";
	$h="";
	if(isset($width) && $width) // To check if the width is non zero and defined
	{
		$w= "&w=".$width;
	}
	
	if(isset($width)) // To check if the height is non zero and defined
	{
		if(!$width){
		$h= "&h=".$height;
		}
	}
	
	return $timthumb."?src=".$media.$w.$h;
	
}

