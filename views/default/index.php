<?php

use yii\helpers\Html;
use yii\grid\GridView;
use vladkukushkin\faq\models\Faq;
use vladkukushkin\faq\Module;

/* @var $this yii\web\View */
/* @var $searchModel vladkukushkin\faq\models\search\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('faq', 'FREQUENTLY_ASKED_QUESTIONS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'faq_id',
            'faq_title',
            'faq_text:ntext',
            [
                'attribute' => 'faq_show_on_main',
                'value' => function ($model) {
                    return Faq::getVisibleOnMain()[$model->faq_show_on_main];
                },
                'filter' => Faq::getVisibleOnMain(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
