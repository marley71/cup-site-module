<?php

namespace Modules\CupSite\Models;

use Gecche\Cupparis\App\Breeze\Breeze;
use PHPHtmlParser\Dom;

/**
 * Breeze (Eloquent) model for T_AREA table.
 */
class CupSitePage extends Breeze
{


//    use ModelWithUploadsTrait;

    protected $table = 'cup_site_pages';

    protected $guarded = ['id'];

    //public $timestamps = false;
    //public $ownerships = false;

    public $appends = [

    ];


    public static $relationsData = [



//        'belongsto' => array(self::BELONGS_TO, Area::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Area::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Area::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['titolo_it'];
     //['id','nome_it'];

    public $defaultOrderColumns = ['id' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['titolo_it'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';



    public static function getPageTree() {
        $pages = self::whereNull('cup_site_page_id')->get()->toArray();
        for($i=0;$i<count($pages);$i++) {
            $subPages = self::where('cup_site_page_id',$pages[$i]['id'])->get()->toArray();
            $pages[$i]['children'] = $subPages;
        }
        return $pages;
    }

    /**
     * Overload model save.
     *
     * $name_equals string Assert User's name (Optional)
     */
    public function save(array $options = array())
    {
        //echo($this->content_id);
        $content = $this->content_it;
        if (!$content)
            return parent::save($options);
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
        $this->content_it = $dom->outerHtml;
        return parent::save($options);
    }

    protected function _mimeToExt($mime) {
        $tmp = explode('/',$mime);
        return $tmp[1];
    }
}
