<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\FeedbackMessages */

$this->title = 'Просмотр Сообщения';
$this->params['breadcrumbs'][] = ['label' => 'Все сообщения', 'url' => ['all']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-messages-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			[    'label' => 'Категория',
				 'value' =>$model->theme->theme_name,
			],
			[
				'label' => 'Сообщение',
				'format'=>'raw',
				'value'=>strpos($model->message_body, 'script') !== false ? Html::encode($model->message_body) : $model->message_body,
			],
            //'file_name',
			[
				'label'=>'Файл',
				'format'=>'raw',
				'value'=>$model->file_name !='' ? $model->file_info . ' ' . Html::a('Просмотреть файл', [Url::to('../web/uploads/'.$model->file_name)]) : null,
			],
        ],
    ]) ?>
	

</div>
