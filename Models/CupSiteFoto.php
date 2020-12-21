<?php
namespace Modules\CupSite\Models;

use Gecche\Cupparis\App\Breeze\Breeze;
use Gecche\Cupparis\App\Models\FotoTrait;
use Gecche\Cupparis\App\Models\UploadableTraits;

class CupSiteFoto extends Breeze
{
    use UploadableTraits;
    use FotoTrait;
    protected $guarded = false;
    public $dir = 'cup_site_foto'; //e.g. allegati
    public $prefix = 'foto'; //e.g. allegato
    public $timestamps = true;
    public $ownerships = true;
    protected $table = 'cup_site_fotos';
    protected $fillable = array('ext','nome_it','descrizione_it','ordine');
    protected $appends = array('full_filename','resource');
    public static $rules = array(
        //'nome' => 'required',
    );

    public static $relationsData = array(
        'mediable' => array(self::MORPH_TO, 'name' => 'mediable'),
    );

    public function getUrl()
    {
        return '/viewmediable/cup_site_foto/'.$this->getKey();
    }
}
