<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
?>
<?=  DetailView::widget([
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
			[
				'label'=>'Файл',
				'format'=>'raw',
				'value'=>$model->file_name !='' ? $model->file_info . ' ' . Html::a('Просмотреть файл', [Url::to('../web/uploads/'.$model->file_name)]) : null,
			],
            //'file_name',
			[
				'label'=>'',
				'format'=>'raw',
				'value'=>Html::a('Перейти к обращению', ['view', 'id' => $model->message_id]),
			],
        ],
    ]) ?>