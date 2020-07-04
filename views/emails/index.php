<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EmailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'from',
            'subject',
            'to',
            [
                'attribute' => 'body',
                'value' => function($model){
                    return strlen($model->body) > 100? substr($model->body, 0, 100)."..." : $model->body;
                }
            ],
            'dateSent',
            [
                'class' => 'yii\grid\ActionColumn', 
                'template' => '{view}{delete}',
            ],
        ],
    ]); ?>


</div>
