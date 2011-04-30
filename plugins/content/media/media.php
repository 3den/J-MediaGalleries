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

        // Regular Expression
        $regex = '/\{(media|thumb)(.*?)}/i';
        $total = preg_match_all($regex, $row->text, $matches, PREG_SET_ORDER);
        if (!$total) {
            return true;
        }

        // Loop
        for ($x = 0; $x < $total; $x++) {
            // Params
            $match = $matches[$x][0];
            $type = strtolower($matches[$x][1]);
            $args = $matches[$x][2];
            $params = clone $this->params;

            // General Params // Dumies Prof
            $parts = preg_replace('/\<.*?\>/', '', $args);
            $parts = explode(' ', $parts); // Split
            $media = $parts[0];

            // Params
            $pcount = count($parts);

            // Width
            if ($pcount > 1) {
                $width = (is_numeric($parts[1]) && $parts[1] > 0) ? $parts[1] : $w;
                $height = $width * 0.7;
            }

            // Height
            if ($pcount > 2) {
                $height = (is_numeric($parts[2]) && $parts[2] > 0) ? $parts[2] : $h;
                $width = ($parts[1]) ? $parts[1] : $height * 1.3;
            }

            switch ($type) {
                case 'media':
                    // Size
                    $params->set('width', $width);
                    $params->set('height', $height);

                    // autoStart
                    if ($pcount > 3) {
                        $params->set('autostart', (boolean) $parts[3]);
                    }

                    // get media Object
                    $media = $this->getMediaObject($media, $params);

                    // Put Video inside the content
                    $replace = '<span id="media_' . $x . '" class="'. $params->get('media_class', '') .'" style="position:relative">'
                            . $media->getMedia()
                            . '</span>';
                    break;

                case 'thumb':
                    // Size
                    $params->set('thumb_width', $width);
                    $params->set('thumb_height', $height);

                    // get media Object
                    $media = $this->getMediaObject($media, $params);

                    // Put Video inside the content
                    $replace = '<span id="thumb_' . $x . '" class="'. $params->get('thumb_class', '') .'" style="position:relative">'
                            . $media->getThumb()
                            . '</span>';
                    break;
            }

            // Replace code
            $row->text = str_replace($match, $replace, $row->text);
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

    /**
     * Get the plugin params
     * 
     * @deprecated This method is not being used 
     * @return JRegistry 
     */
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
     * Get a Media object from an URL 
     * @param string $media
     * @param JParams $params
     * @return MediaObject
     */
    public function getMediaObject($media, $params=array()) {
        //Preprocess the media data to make it standard for the functions...
        $this->params->merge($params);
        $params = $this->params->toArray();

        // Here we fix Media UrL
        $media = strpos($media, "http://") ?
                $media : // Custom PATH
                $params->get('default_path', 'images/') . $media; // Default PATH
        
        //First Check if we have the file extension
        $type = substr($media, strrpos($media, '.') + 1);
        if (ctype_alnum($type)) { // If the type is alphanumeric...
            // Aha...include the file based on the extension...
            switch ($type) {
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