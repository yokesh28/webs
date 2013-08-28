<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a')); ?>:</b>
	<?php echo CHtml::encode($data->a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b')); ?>:</b>
	<?php echo CHtml::encode($data->b); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c')); ?>:</b>
	<?php echo CHtml::encode($data->c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('month_id')); ?>:</b>
	<?php echo CHtml::encode($data->month_id); ?>
	<br />


</div>