<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'a'); ?>
		<?php echo $form->textField($model,'a'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'b'); ?>
		<?php echo $form->textField($model,'b'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c'); ?>
		<?php echo $form->textField($model,'c'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'month_id'); ?>
		<?php echo $form->textField($model,'month_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->