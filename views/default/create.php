<?php

use yii\helpers\Html;
use vladkukushkin\faq\Module;


/* @var $this yii\web\View */
/* @var $model vladkukushkin\faq\models\Faq */

$this->title = Module::t('faq', 'Create');
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'FREQUENTLY_ASKED_QUESTIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
