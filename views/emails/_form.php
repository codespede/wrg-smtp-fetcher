<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Emails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dateSent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
