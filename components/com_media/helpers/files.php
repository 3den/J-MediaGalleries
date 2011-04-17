<?php


defined( '_JEXEC' ) or die( 'Restricted access' );

class FilesHelper{
	
	/**
	 * Converts folder path to URL
	 * 
	 * @static
	 * @return string URL
	 * @param string $path 
	 */	
	function url2path($url){
		$uri = str_replace('/administrator/', '/', JURI::base());
		$sea = array( $uri, '/' );
		$rep = array( JPATH_SITE.DS, DS );
		
		return str_replace( $sea, $rep, $url );			
	}
	
	/**
	 * Converts folder path to URL
	 * 
	 * @static
	 * @return string URL
	 * @param string $path 
	 */
	function path2url($path){
		$uri = str_replace('/administrator/', '/', JURI::base());
		$rep= array( $uri, '/' );		
		$sea = array( JPATH_SITE, DS );
				
		return str_replace( $sea, $rep, $path );			
	}	
	
	/**
	 * Upload a file
	 *
	 * @since 1.5
	 */
	function upload($file, $folder)
	{	
		// import jclass file
		jimport('joomla.filesystem.file');
		jimport('joomla.client.helper');
				
		// floder		
		$format	= JRequest::getVar( 'format', 'html', '', 'cmd');
		$folder = self::url2path($folder);

		// folder exists
		if( !JFolder::exists($folder) ){
			JError::raiseWarning(100, JText::_('PATH IS NOT A FOLDER'));
			return '';
		}	
			
		// Make the filename safe
		$fname = $file['name'];
		$fname = JFile::makeSafe($fname);		
		$filepath = JPath::clean($folder.DS.$fname);
				
		// is Valid
		if(!self::isValid($filepath)){
			JError::raiseWarning( 100, JText::_('Invalid file type') );
			return '';
		}
		
		// Set FTP credentials, if given
		JClientHelper::setCredentialsFromRequest('ftp');

		// try to upload
		if (!JFile::upload($file['tmp_name'], $filepath)) {
			JError::raiseWarning(100, JText::_('WARNFS_ERR02') );
			return '';
		}
		
		return $filepath;
	}
	

	/**
	 * Deletes paths from the current path
	 *
	 * @param array $paths The files to delete
	 */
	function delete($paths=array(0))
	{
		// Force to array
		//TODO		
		$paths = self::url2path( $paths );

		// Set FTP credentials, if given
		jimport('joomla.client.helper');
		JClientHelper::setCredentialsFromRequest('ftp');	

		// Initialize variables
		$res = true;
		if (count($paths) ) {
			jimport('joomla.filesystem.file');
			
			foreach ($paths as $path){
				if (is_file($path)) {
					$res = JFile::delete($path) && $res;
				} 
				else{
					$res = false;
				}
			}
			
			return $res;
		}
	}
	
	/**
	 * 
	 * @return boolean True on valid
	 * @param string $fname
	 */
	function isValid($fname){
		$type = substr( $fname, strrpos($fname, '.') );
		$type = strtolower($type);
		switch($type){			
			// Audio
			case '.mp3':
			// Video
			case '.mp4':
			case '.wmv':
			case '.wma':
			case '.mov':
			case '.divx':
			case '.avi':
			case '.flv':
			// Figure
			case '.jpg':
			case '.gif':
			case '.png':
			// Java
			case '.class':
				$res=true;
				break;
				
			default:
				$res=false;	
				break;
		}	
		return $res;
	}
	
	/**
	 * Get Thumbnail from video url
	 * 
	 * @static
	 * @return string Thumbnail URL
	 * @param string $url Video URL
	 */
	function getThumbURL($url){
		// clean URL
		$url = self::path2url($url);
		
		// Thumbs folder
		$localdir = JPATH_COMPONENT_SITE.DS.'assets/thumbs/';
		$localdir = self::path2url($localdir);

		/* ***************************************************
	 	* The Show Begins
	 	*****************************************************/	
		// Youtube
		if( strpos( $url,'youtube.com' ) ){
			if( strpos( $url, '/v/' ) ) {// If yes, New way
				$video = substr( strstr( $url, '/v/' ), 3 );
				$video = explode( '/', $video);
				$video = $video[0];
			}
			else{	
				$video = substr( strstr( $url, 'v=' ), 2 ) ; // Else, Old way	
				$video = explode( '&', $video);
				$video = $video[0];
			}
			
			$thumbnail = 'http://i.ytimg.com/vi/'.$video.'/default.jpg';
		}
		
		// Yahoo Video 
		elseif( strpos( $url,'video.yahoo' ) ){	
			//TODO
			$thumbnail = $localdir. 'sample-video.jpg';
		}
	
		// Google Video 
		elseif( strpos( $url,'video.google' ) ){
			//TODO
			$thumbnail = $localdir. 'sample-video.jpg';
		}
		
		// Brightcove Video 
		elseif( strpos( $url,'brightcove.tv' ) ){
			//TODO
			$thumbnail = $localdir. 'sample-video.jpg';
		}

		// Metacafe.com
		elseif( strpos( $url,'metacafe' ) ){
			//TODO
			$thumbnail = $localdir. 'sample-video.jpg';
		}
		
		/* Video from files
		******************************************************/ 
		else{			
			$type = substr( $url, strrpos($url, '.') );	
			$type = strtolower($type);
			switch( $type ){
				
			// Flash .SWF 
			case '.swf':		    
				$thumbnail = $localdir. 'sample-swf.jpg';
				break;				
			
			// Music
			case '.mp3': 	
				$thumbnail = $localdir. 'sample-audio.jpg';	
				break;
			 
			// JPG, GIF, PNG, H264
			case '.jpg':
			case '.gif':
			case '.png': 			
				$uribase = str_replace('/administrator/', '/', JURI::base());
				$thumbnail = $localdir .'thumb.php?w=148&src='.$url;
				
				break;
				
			// Video .FLV
			case '.h264':
			case '.flv': 	
				$thumbnail = $localdir. 'sample-flv.jpg';
				break;				
			
			// Quicktime MOV,  MP4
			case '.mov':
			case '.3gp':		
			case '.mp4': 	
				$thumbnail = $localdir. 'sample-quicktime.jpg';
				break;
				
			// Realmedia .RM & .RAM
			case '.rm':
			case '.rmvb':
			case '.ram': 	
				//TODO
				$thumbnail = $localdir. 'sample-video.jpg';
				break;
				
			// Applet .CLASS
			case '.class':			
				//TODO	
				$thumbnail = $localdir. 'sample-video.jpg';
				break;
			
			// DivX
			case '.div':
			case '.avi':
			case '.divx':
				//TODO
				$thumbnail = $localdir. 'sample-video.jpg';
				break;
			
			// Windows Media
			case '.asx':
			case '.wma':
			case '.wmv':
			case '.mpg':
			case '.mpeg':
				$thumbnail = $localdir. 'sample-wmv.jpg';
				break;
	
			// Error
			default: 
				$thumbnail = $localdir. 'sample-video.jpg';
				break;
			}
		}		
		
		return $thumbnail;
	}
	
	/**
	 * Send File
	 * @return string
	 * @param $file string
	 * @param $folder string
	 * @param $maxsize KB
	 * @param $prefix string[optional]
	 */
	function sendFile($file, $folder, $maxsize=0, $prefix='' )
	{		
		// try to find file 
		if( empty($file['name']) ){
			return null;
		}
		// check size
		$maxsize *= 1024;
		if( $maxsize &&$file['size'] > $maxsize){
			JError::raiseWarning(100,  'O arquivo é muito grande e não pode ser enviado.' );
			return null;
		}
		// Upload
		$file['name'] = $prefix.$file['name'];
		$fpath = self::upload($file, $folder);
		if( trim($fpath) == '' ){
			JError::raiseWarning(100,  'Arquivo não pode ser enviado' );
			return null;
		}		
		//set url
		return self::path2url($fpath);
	}
}
