<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-messages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать сообщение', ['index'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php Pjax::begin(['id' => 'messages']); ?>
	<?=
	ListView::widget([
		'dataProvider' => $dataProvider,
		'options' => [
			'tag' => 'div',
			'class' => 'list-wrapper',
			'id' => 'list-wrapper',
		],
		'layout' => "{pager}\n{items}\n{summary}",
		'itemView' => function ($model, $key, $index, $widget) {
			$itemContent = $this->render('_feedback_view',['model' => $model]);
			return $itemContent; 
		},
		'pager' => [
			'firstPageLabel' => 'Первая',
			'lastPageLabel' => 'Последняя',
			'nextPageLabel' => 'Следующая',
			'prevPageLabel' => 'Предыдущая',
			'maxButtonCount' => 3,
		],
	]);
	?>
	<?php Pjax::end();?>
</div>


<?php
	/* GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'label'=>'Kатегория',
				//'format'=>'text', // Возможные варианты: raw, html
				'content'=>function($data){
					return $data->getThemeName();
				},
			],
            'message_body',
            'file_name',

			['class' => 'yii\grid\ActionColumn' ,'template'=>'{view}' ]
        ],
    ]); */
?>
