<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\Cities;

class CityFormWidget extends Widget {

    public function run() {


            $model = new Cities();
            return $this->render('cityFormWidget', [
                'model' => $model,
            ]);
    }

}