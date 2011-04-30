<?php

class MediaTypeYoutubecom extends MediaType {

    /**
     * Get the media Code
     * @return string $embed_html HTML code to embed the video
     */
    public function getMedia() {
        $params = $this->params;
        $video = $this->media;

        // Set youtube Params
        $vparams[] = 'loop=' . $params['youtube_loop']; //, 'advanced');
        $vparams[] = 'egm=' . $params['youtube_egm']; //, 'advanced');
        $vparams[] = 'border=' . $params['youtube_border']; //, 'advanced');
        $vparams[] = 'color1=0x' . $params['youtube_color1']; //, 'advanced');
        $vparams[] = 'color2=0x' . $params['youtube_color2']; //, 'advanced');
        
        // media params
        $width = &$params['width'];
        $height = &$params['height'];
        if (!$width) {
            $width = 'width: 425px;';
            $height = 'height: 344px;'; // Auto H		
        }


        // Return the embed code
        $player = 'http://www.youtube.com/v/' . $this->getV() . '&' . implode('&', $vparams);
        return $this->html4Player($player, $params);
    }

    /**
     * Return the thumbnail
     * @return string $html
     */
    public function getThumb() {
        $this->thumb = 'http://i.ytimg.com/vi/' . $this->getV() . '/default.jpg';
        return parent::getThumb();
    }

    /**
     * Extract the video id from the media url
     * this is a helper method used by both the media and thumb
     * @staticvar type $v
     * @return string $v 
     */
    private function getV() {
        static $v;
        if ($v) {
            return $v;
        }
        
        $media = $this->media;
        if (strpos($media, '/v/')) {// If yes, New way
            $video = substr(strstr($media, '/v/'), 3);
            $video = explode('/', $video);
            $video = $video[0];
        } else {
            $video = substr(strstr($media, 'v='), 2); // Else, Old way	
            $video = explode('&', $video);
            $video = $video[0];
        }
        
        return $video;
    }

}
