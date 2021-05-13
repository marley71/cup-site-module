<?php

namespace Modules\CupSite\Models;

use App\Models\CupSiteFoto;
use Gecche\Cupparis\App\Breeze\Breeze;
use Illuminate\Support\Facades\Config;
use PHPHtmlParser\Dom;

/**
 * Breeze (Eloquent) model for T_AREA table.
 */
class CupSiteNews extends Breeze
{

    use HtmlTraits;

//    use ModelWithUploadsTrait;

    protected $table = 'cup_site_news';

    protected $guarded = ['id'];

    //public $timestamps = false;
    //public $ownerships = false;

//    public $appends = [
//        'thumb_url'
//    ];


    public static $relationsData = [
        'fotos' => [self::MORPH_MANY, 'related' => CupSiteFoto::class, 'name' => 'mediable'],
        'attachments' => [self::MORPH_MANY, 'related' => CupSiteAttachment::class, 'name' => 'mediable'],
        'videos' => array(self::MORPH_MANY, 'related' => CupSiteVideo::class,'name' => 'mediable'),

//        'belongsto' => array(self::BELONGS_TO, Area::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Area::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Area::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['titolo_it'];
     //['id','nome_it'];

    public $defaultOrderColumns = ['data' => 'DESC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['titolo_it'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';

    public function save(array $options = array())
    {
        //echo($this->content_id);

        $this->descrizione_it = $this->_saveHtmlEntities($this->descrizione_it);

        if (!$this->getKey()) {
            $this->menu_it = 'new' . rand();
            parent::save($options);
        }

        $this->menu_it = $this->getKey() . "-" . str_replace(' ','-',$this->titolo_it);
        return parent::save($options);
    }

//    public function getThumbUrlAttribute()
//    {
//        if (!$this->descrizione_it)
//            return config('cup-site.default_thumb_url');
//
//        $dom = new Dom();
//        $dom->loadStr($this->descrizione_it);
//        foreach ($dom->find('img') as $image) {
//            $src = $image->getAttribute('src');
//            if (strpos($src,"data:") === FALSE) {
//                return $src;
//            }
//        }
//        return config('cup-site.default_thumb_url');
//    }
}
