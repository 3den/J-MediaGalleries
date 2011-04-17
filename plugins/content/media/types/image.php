<?php
/**
 * For JPG, GIF, PNG...
 */
class MediaTypeImage extends MediaType {

    public function getMedia($media='', $width='', $height='', $params=array()) {
        return "<img src='" . $media . "'" . "style='" . $width . " " . $height . "' >";
    }

}
?>