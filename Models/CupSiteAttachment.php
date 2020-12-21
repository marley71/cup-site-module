<?php
namespace Modules\CupSite\Models;

use Gecche\Cupparis\App\Breeze\Breeze;
use Gecche\Cupparis\App\Models\AttachmentTrait;
use Gecche\Cupparis\App\Models\FotoTrait;
use Gecche\Cupparis\App\Models\UploadableTraits;

class CupSiteAttachment extends Breeze
{
    use UploadableTraits;
    use AttachmentTrait;
    protected $guarded = false;
    public $dir = 'cup_site_attachment'; //e.g. allegati
    public $prefix = 'allegato'; //e.g. allegato
    public $timestamps = true;
    public $ownerships = true;
    protected $table = 'cup_site_attachments';
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
        return '/viewmediable/cup_site_attachment/'.$this->getKey();
    }
}
