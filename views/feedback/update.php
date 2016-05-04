<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeedbackMessages */

$this->title = 'Update Feedback Messages: ' . ' ' . $model->message_id;
$this->params['breadcrumbs'][] = ['label' => 'Feedback Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->message_id, 'url' => ['view', 'id' => $model->message_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedback-messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
