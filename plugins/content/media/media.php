<?php

/**
 * @version		$Id: example.php 16807 2010-05-05 05:36:11Z eddieajau $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

// This lib adds the media 
//include_once dirname(__FILE__).DS.'media'.DS.'htmlembed.php';
//include_once dirname(__FILE__).DS.'media'.DS.'thumbnails.php';
include_once dirname(__FILE__) . DS . 'types' . DS . 'mediatype.php';

/**
 * Media Content Plugin
 *
 * @package		Joomla
 * @subpackage	Content
 * @since		1.6
 */
class plgContentMedia extends JPlugin {

    /**
     * Example prepare content method
     *
     * Method is called by the view
     *
     * @param	string	The context of the content being passed to the plugin.
     * @param	object	The content objec
     * @param	object	The content params
     * @param	int		The 'page' number
     * @since	1.6
     */
    public function onContentPrepare($context, &$row, &$params, $limitstart) {
        // Just to check if plg_media may be called or not, for better performance
        $makeMedia = strpos($row->text, 'media');
        $makeThumb = strpos($row->text, 'thumb');
        if ($makeMedia === false && $makeThumb === false) {
            return true;
        }

        if ($makeMedia) {
            // Regular Expression
            $regex = '/\{media(.*?)}/i';
            $total = preg_match_all($regex, $row->text, $matches);

            // 	Default	->fixed
            $w = (int)$this->params->def('width', 400);
            $h = (int)$this->params->def('height', 0 );
            $ast = (int) $this->params->def('autostart', 0);

            // Loop
            for ($x = 0; $x < $total; $x++) {
                // General Params // Dumies Prof
                $parts = preg_replace('/\<.*?\>/', '', trim($matches[1][$x])); 
                $parts = explode(' ', $parts); // Split
                // Default Vaues
                /*
                  $width = $w;
                  $height = ($h > 0)? $h : ($width * 0.7);
                  $autostart = $ast;
                 */
                $width = "";
                $height = '';
                $autostart = $ast;
                // Params
                $pcount = count($parts);

                /*                 * Width */
                if ($pcount > 1) {
                    $width = (is_numeric($parts[1]) && $parts[1] > 0) ? $parts[1] : $w;
                    $height = $width * 0.7;
                }

                /*                 * Height */
                if ($pcount > 2) {
                    $height = (is_numeric($parts[2]) && $parts[2] > 0) ? $parts[2] : $h;
                    $width = ($parts[1]) ? $parts[1] : $height * 1.3;
                }

                /*                 * autoStart */
                if ($pcount > 3) {
                    $autostart = (boolean) $parts[3];
                }

                // Video Display
                $media = $this->getMediaObject($parts[0], $params);

                // Put Video inside the content
                $replace = '<span id="media_' . $x . '" class="media" style="position:relative">'
                        . $media->getMedia()
                        . '</span>';
                $row->text = str_replace($matches[0][$x], $replace, $row->text);
            }
        }

        // Thumb not ready
        if (false) {
            // Regular Expression
            $regex = '/\{thumb(.*?)}/i';
            $total = preg_match_all($regex, $row->text, $matches);

            // 	Default	->fixed
            $w = (int) $this->params->def('thumbwidth', 160);
            $h = (int) $this->params->def('thumbheight');

            // Loop
            for ($x = 0; $x < $total; $x++) {
                // General Params
                $parts = preg_replace('/\<.*?\>/', '', trim($matches[1][$x])); // Dumies Prof
                $parts = explode(' ', $parts); // Split
                // Default Vaues
                $width = $w;
                $height = ($h > 0) ? $h : ($width * 0.7);

                // Params
                $pcount = count($parts);

                /*                 * Width */
                if ($pcount > 1) {
                    $width = (is_numeric($parts[1]) && $parts[1] > 0) ? $parts[1] : $w;
                    $height = $width * 0.7;
                }

                /*                 * Height */
                if ($pcount > 2) {
                    $height = (is_numeric($parts[2]) && $parts[2] > 0) ? $parts[2] : $h;
                    $width = ($parts[1]) ? $parts[1] : $height * 1.3;
                }

                // Video Display
                $url = $parts[0];

                // Put Video inside the content
                $thumbnail = self::getThumb($url, $width, $height);
                $replace = '<span id="thumb_' . $x . '" class="thumb" style="position:relative">'
                        . '<img src="' . $thumbnail . '" width="' . $width . '" height="' . $height . '">'
                        . '</span>';
                $row->text = str_replace($matches[0][$x], $replace, $row->text);
            }
        }

        return true;
    }

    //this is the patch
    /**
     *
     * @param $item
     * @param $params
     */
    public function onLoadMedia($item, &$params) {
        // Merge params
        $this->params->merge($params);

        // Get Media Object and return the Code to embed
        $media = $this->getMediaObject($item->url, $params);
        $item->media = $media->getMedia();
        return true;
    }
    
    public static function getParams() {
        $db = JFactory::getDbo();
        $db->setQuery("select params from #__extensions where name='PLG_CONTENT_MEDIA' ");
        $res = $db->query();
        if ($res) {
            $params = $db->loadResult();
            //We get the params in serialized JSON form :) But let's reduce efforts by converting to an Array
            $reg = JRegistry::getInstance(0);
            $reg->loadJSON($params);
            //Wuhoo we have the params...now send it...
            return $params;
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $media
     * @param JParams $params
     * @return MediaObject
     */
    public function getMediaObject($media, $params=array()) {
        //Preprocess the media data to make it standard for the functions...
        $this->params->merge($params);
        $params = $this->params; //->toArray();
        //var_dump($params);

        // Fix Media UrL
        $media = strpos($media, "http://") ?
                $media : // Custom PATH
                $params->get('default_path', 'images/') . $media; // Default PATH
        
        //First Check if we have the file extension
        $type = substr($media, strrpos($media, '.') + 1);
        if (ctype_alnum($type)) { // If the type is alphanumeric...
            // Aha...include the file based on the extension...
            switch($type){
                case 'jpg':
                case 'jpeg':
                case 'gif':
                case 'png':
                    $type = 'image';
                    break;
            }
        }
        // It might be a remote server
        else {
            //This means that we don't know the extension of the file..
            // \W removes the f* whitespace char
            $pattern = '/(www\.)|(http\:\/\/)|(\/(.*))|(\W)/i';
            $type = preg_replace($pattern, '', $media);
        }
        
        // Now I get the media object
        $file = dirname(__FILE__) . DS . 'types' . DS . $type . '.php';

        // If there is no file load the parent
        if (!file_exists($file)) {
            //return new MediaType();
            return new MediaType($media, $params);
        }

        // There is a file so load it
        require_once $file;
        $class = 'MediaType' . $type;
        return new $class($media, $params);
    }
}