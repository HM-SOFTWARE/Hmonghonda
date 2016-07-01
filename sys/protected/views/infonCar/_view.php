<?php
/* @var $this InfonCarController */
/* @var $data InfonCar */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_code_1')); ?>:</b>
	<?php echo CHtml::encode($data->car_code_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_code_2')); ?>:</b>
	<?php echo CHtml::encode($data->car_code_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_price')); ?>:</b>
	<?php echo CHtml::encode($data->car_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_registration')); ?>:</b>
	<?php echo CHtml::encode($data->number_registration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_generation_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_generation_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('car_color_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_color_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out')); ?>:</b>
	<?php echo CHtml::encode($data->date_out); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_or_spare_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_or_spare_status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Brand_id')); ?>:</b>
	<?php echo CHtml::encode($data->Brand_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>