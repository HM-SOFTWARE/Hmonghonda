<?php
/* @var $this InfoSparesController */
/* @var $data InfoSpares */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spare_code')); ?>:</b>
	<?php echo CHtml::encode($data->spare_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spare_name')); ?>:</b>
	<?php echo CHtml::encode($data->spare_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spare_price_buy')); ?>:</b>
	<?php echo CHtml::encode($data->spare_price_buy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spare_price_sale')); ?>:</b>
	<?php echo CHtml::encode($data->spare_price_sale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out')); ?>:</b>
	<?php echo CHtml::encode($data->date_out); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('spare_position_id')); ?>:</b>
	<?php echo CHtml::encode($data->spare_position_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_or_spare_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_or_spare_status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_from_share')); ?>:</b>
	<?php echo CHtml::encode($data->branch_from_share); ?>
	<br />

	*/ ?>

</div>