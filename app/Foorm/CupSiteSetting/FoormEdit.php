<?php

namespace App\Foorm\CupSiteSetting;


use Gecche\Cupparis\App\Foorm\Base\FoormEdit as BaseFoormEdit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormEdit extends BaseFoormEdit
{

    public function finalizeData($finalizationFunc = null) {
        if (!$this->formData['properties']) {
            $this->formData['properties'] = json_decode($this->formData['default_properties'],true);
        }
//        if (is_array($this->formData['mainrole'])) {
//            $this->formData['mainrole'] = $this->formData['mainrole']['id'];
//        }
    }

    protected function saveModel($input) {
//        parent::saveModel($input);
//        if (!$this->isAuth) {
//            $this->model->syncRoles(Arr::wrap(Arr::get($input,'mainrole',[])));
//        }
    }

}
