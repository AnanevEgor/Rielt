<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\Streets;

class StreetFormWidget extends Widget {

    public function run() {


        $model = new Streets();
        return $this->render('streetFormWidget', [
            'model' => $model,
        ]);
    }

}