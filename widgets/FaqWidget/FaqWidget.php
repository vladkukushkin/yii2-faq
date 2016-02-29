<?php

namespace vladkukushkin\faq\widgets\FaqWidget;

use vladkukushkin\faq\models\Faq;
use yii\bootstrap\Widget;

class FaqWidget extends Widget
{
    /**
     * @var bool|int if id defined then this FAQ will be opened
     */
    public $id = false;//faq_id open by default

    /**
     * @var string path to your view
     */
    public $viewPath = 'faq_list';


    public function run()
    {
        $models = Faq::find()->where([
            'faq_language' => \Yii::$app->language
        ])->asArray()->all();
        return $this->render($this->viewPath, [
            'models' => $models,
            'id' => $this->id,
        ]);
    }
}