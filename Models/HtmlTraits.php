<?php

namespace Modules\CupSite\Models;

use PHPHtmlParser\Dom;

trait HtmlTraits {
    /**
     * $content : html da parserizzare
     *
     * durante il salvataggio faccio il controllo se ci sono delle immagini o attachments presenti nell'html
     * generati dall'editor html. In caso li trovi, salvo l'ìmmagine come file esterno e viene inserito il suo
     * link.
     */
    protected function _saveHtmlEntities($content) {
        if (!$content)
            return $content;
        $dom = new Dom();
        $dom->loadStr($content);
        $imageCount = 0;
        foreach ($dom->find('img') as $image) {
            $src = $image->getAttribute('src');
            if (strpos($src,"data:") !== FALSE) {
                $imgData = substr($src,strpos($src,"base64,")+strlen("base64,"));
                $imgData = base64_decode($imgData);
                $mimeType = substr($src,5,strpos($src,"base64,")-6); // elimino data: fino a prima di ;base64
                $ext = $this->_mimeToExt($mimeType);
                $filename = "image" . rand() . ".$ext";
                $image_path = config('cup-site.media_image_path','/cup_site/media/imagesdddd/');
                file_put_contents(public_path( $image_path . $filename),$imgData);
                $image->setAttribute('src',$image_path .$filename);
            }
            if ($imageCount == 0)
                $this->thumb_url =  $image->getAttribute('src');
            $imageCount++;
        }
        if (!$this->thumb_url)
            $this->thumb_url = config('cup-site.default_thumb_url');
        $content = $dom->outerHtml;
        return $content;
    }

    protected function _mimeToExt($mime) {
        $tmp = explode('/',$mime);
        return $tmp[1];
    }
}
