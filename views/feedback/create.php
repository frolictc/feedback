<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use vova07\imperavi\Widget;

$this->title = 'Создать обращение';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-5">
	<?php $form = ActiveForm::begin(['id' => 'feedback-form', 'options' => [ 'enctype' => 'multipart/form-data']]); ?>
		<?= $form->field($model, 'theme_id')->dropdownList(
					$themes,
					['prompt'=>'Выберите категорию']
				); ?>
		<?= $form->field($model, 'message_body')->widget(Widget::className(), [
															'settings' => [
																'lang' => 'ru',
																'minHeight' => 200,
																'plugins' => [
																	'clips',
																	'fullscreen'
																]
															]
															]); ?> 
		<?= $form->field($model, 'file')->fileInput(); ?>

		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'feedback-button']) ?>
		</div>
	<?php ActiveForm::end(); ?>

</div>
