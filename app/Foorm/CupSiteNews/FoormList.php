<?php

namespace App\Foorm\CupSiteNews;


use Gecche\Cupparis\App\Foorm\Base\FoormList as BaseFoormList;
use Illuminate\Support\Arr;
use Modules\CupSite\Models\CupSiteNews;

class FoormList extends BaseFoormList
{


    protected function applyListBuilder()
    {
//        if (Arr::get($this->customFuncs,'listBuilder') instanceof \Closure) {
//            $builder = $this->customFuncs['listBuilder'];
//            $this->formBuilder = $builder($this->model);
//            return;
//        }

        $modelClass = get_class($this->model);
        $this->formBuilder = $modelClass::query(); //::acl();

    }

}
