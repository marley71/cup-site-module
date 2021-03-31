<?php

namespace Modules\CupSite\Models;

use Gecche\Cupparis\App\Breeze\Breeze;


/**
 * Breeze (Eloquent) model for T_AREA table.
 */
class CupSitePage extends Breeze
{


    use HtmlTraits;

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


    /**
     * restituisce le pagine in formato albero, in caso isAdmin e' settato a true restituisce
     * anche le pagine non attive.
     * @param false $isAdmin
     * @return mixed
     */
    public static function getPageTree($isAdmin=false) {
        $pages = self::whereNull('cup_site_page_id')->where('in_menu',1);
        if (!$isAdmin)
            $pages->where('attivo',1);

        $pages = $pages->orderBy('ordine')->get()->toArray();
        for($i=0;$i<count($pages);$i++) {
            $subPages = self::where('cup_site_page_id',$pages[$i]['id']);
            if (!$isAdmin)
                $subPages->where('attivo',1);
            $subPages = $subPages->get()->toArray();
            $pages[$i]['children'] = $subPages;
        }
        return $pages;
    }

    public function save(array $options = array()) {
        $this->content_it = $this->_saveHtmlEntities($this->content_it);
        return parent::save($options);
    }
}
