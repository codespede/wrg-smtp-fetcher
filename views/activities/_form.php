<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList([ 'user' => 'User', 'system' => 'System', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'action')->dropDownList([ 'fetch' => 'Fetch', 'delete' => 'Delete', 'search' => 'Search', 'view' => 'View', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'searchParams')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
