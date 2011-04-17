<?php



class YoutubeHelper{
	
	/**
	 * Upload a file
	 *
	 * @since 1.5
	 */
	function upload($file, $username, $password, $params=array())
	{	
		// import jclass file
		jimport('joomla.filesystem.file');
		jimport('joomla.client.helper');
		include(dirname(__FILE__).DS.'phptube'.DS.'phptube.php');

		// Make the filename safe
		$fname = $file['name'];
		$fname = JFile::makeSafe($fname);		
		$filepath = JPath::clean($folder.DS.$fname);
				
		
		
		$tube = new PHPTube ("username","password");
		$id = $tube->upload (
			$file['tmp_name'], // Filename
			"PHPTube Demo", // title
			"Demo PHP YouTube", // tags
			"...", // description
			10, // category
			"DE", // lang
			true);	// public
			
		if(!$id){
			return false;
		}		

		return 'http://www.youtube.com/watch?v='.$id;
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
		$paths = FilesHelper::urlToPath( $paths );

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
	 * Get Thumbnail from video url
	 * 
	 * @static
	 * @return string Thumbnail URL
	 * @param string $url Video URL
	 */
	function getThumbURL($url){
		// clean URL
		$url = FilesHelper::pathToURL($url);
		
		// Thumbs folder
		$localdir = JPATH_SITE.DS.'components/com_mediagalleries/assets/thumbs/';
		$localdir = FilesHelper::pathToUrl($localdir);

		/* ***************************************************
	 	* The Show Begins
	 	*****************************************************/	
		// Youtube
		if( eregi( 'youtube.com', $url ) ){
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
		else{	
			$thumbnail = $localdir. 'sample-video.jpg';
		}
	}
}
