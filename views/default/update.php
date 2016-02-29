<?php

use yii\helpers\Html;
use vladkukushkin\faq\Module;

/* @var $this yii\web\View */
/* @var $model vladkukushkin\faq\models\Faq */

$this->title = 'Update {modelClass}: ' . ' ' . $model->faq_id;
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'FREQUENTLY_ASKED_QUESTIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->faq_id, 'url' => ['view', 'id' => $model->faq_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
