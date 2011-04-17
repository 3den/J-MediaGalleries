<?php

class MediaTypeMetacafe extends MediaType {

    function getMedia($media, $params=array()) {
        $video = substr(stristr($video, 'watch/'), 6); //' v12316545ACFsJaJY'
        $video = explode('/', $video);
        $video = 'http://www.metacafe.com/fplayer/' . $video[0] . '/' . $video[1] . '.swf';
        $vars = 'playerVars=showStats=no|autoPlay=' . ( ($params['autostart']) ? 'yes' : 'no' ) . '|videoTitle='
                . '&altServerURL=http://www.metacafe.com';

        $params['a'] = '';
        $params['p'] = '<param name="flashVars" value="' . $vars . '" />';

        return $this->html4Player($video, $params);
    }

}
