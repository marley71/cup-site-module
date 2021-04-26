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
        foreach ($dom->find('img') as $image) {
            $src = $image->getAttribute('src');
            if (strpos($src,"data:") !== FALSE) {
                $imgData = substr($src,strpos($src,"base64,")+strlen("base64,"));
                $imgData = base64_decode($imgData);
                $mimeType = substr($src,5,strpos($src,"base64,")-6); // elimino data: fino a prima di ;base64
                $ext = $this->_mimeToExt($mimeType);
                $filename = "image" . rand() . ".$ext";
                file_put_contents(public_path('/cup_site/media/images/'.$filename),$imgData);
                $image->setAttribute('src','/cup_site/media/images/'.$filename);
            }

        }
        $content = $dom->outerHtml;
        return $content;
    }

    protected function _mimeToExt($mime) {
        $tmp = explode('/',$mime);
        return $tmp[1];
    }
}
