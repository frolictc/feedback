<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FeedbackMessages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-messages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'theme_id')->textInput() ?>

    <?= $form->field($model, 'message_body')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
