<?php

namespace vladkukushkin\faqaq\widgets\FaqWidget;

use vladkukushkin\faq\models\Faq;
use yii\bootstrap\Widget;

class FaqWidget extends Widget
{
    public $id = false;//faq_id open by default

    public function init()
    {
    }

    public function run()
    {
        $models = Faq::find()->where('faq_language = :language', [':language' => \Yii::$app->language])->asArray()->all();
        return $this->render('faq_list', [
            'models' => $models,
            'id' => $this->id,
        ]);
    }
}