<?php

namespace App\Foorm\CupSitePage;


use Gecche\Cupparis\App\Foorm\Base\FoormList as BaseFoormList;
use Illuminate\Support\Arr;
use Modules\CupSite\Models\CupSitePage;

class FoormList extends BaseFoormList
{


    public function finalizeData($finalizationFunc = null)
    {

        parent::finalizeData($finalizationFunc); // TODO: Change the autogenerated stub
        $this->formData['data'] = CupSitePage::getPageTree();
        return;

    }

}