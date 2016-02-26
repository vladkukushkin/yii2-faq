<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Faq;

/* @var $this yii\web\View */
/* @var $model vladkukushkin\faq\models\Faq */

$this->title = $model->faq_id;
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'FREQUENTLY_ASKED_QUESTIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->faq_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->faq_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'faq_id',
            'faq_title',
            'faq_text:ntext',
            [
                'attribute' => 'faq_show_on_main',
                'value' => Faq::getVisibleOnMain()[$model->faq_show_on_main],
            ],
        ],
    ]) ?>

</div>
