<?php
class MediaTypeYoutubecom extends MediaType {

    public function getMedia() {
        $vparams[] = 'autoplay='.$autostart;
        $vparams[] = 'rel=' . $params['youtube_rel']; //, 'advanced');
        $vparams[] = 'loop=' . $params['youtube_loop']; //, 'advanced');
        //$vparams[] = 'enablejsapi='.$params['youtube_enablejsapi'];
        //$vparams[] = 'playerapiid='.$params['youtube_playerapiid'];
        $vparams[] = 'disablekb=' . $params['youtube_disablekb']; //, 'advanced');
        $vparams[] = 'egm=' . $params['youtube_egm']; //, 'advanced');
        $vparams[] = 'border=' . $params['youtube_border']; //, 'advanced');
        $vparams[] = 'color1=0x' . $params['youtube_color1']; //, 'advanced');
        $vparams[] = 'color2=0x' . $params['youtube_color2']; //, 'advanced');

        if (!$width) {
            $width = 'width: 425px;';
            $height = 'height: 344px;'; // Auto H
        }
        if (strpos($media, '/v/')) {// If yes, New way
            $media = substr(strstr($media, '/v/'), 3);
            $media = explode('/', $media);
            $media = $media[0];
        } else {// Else, Old way
            $media = substr(strstr($media, 'v='), 2);
            $media = explode('&', $media);
            $media = $media[0];
        }

        $player = 'http://www.youtube.com/v/' . $media . '&' . implode('&', $params);

        $params['a'] = '';
        $params['p'] = '';

        //Call the SWF's extension function
        return $this->html4Player($player, $params);
    }
}