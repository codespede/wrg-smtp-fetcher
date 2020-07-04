<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActivitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activity Log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activities-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'action',
            'uid',
            'searchParams:ntext',
            'date',
            //'searchedAttribute',
            //'date',

            [
                'class' => 'yii\grid\ActionColumn', 
                'template' => '{view}{delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
