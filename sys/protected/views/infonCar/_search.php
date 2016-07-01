<?php
/* @var $this InfonCarController */
/* @var $model InfonCar */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<?php echo $form->textFieldControlGroup($model, 'id'); ?>
<?php echo $form->textFieldControlGroup($model, 'car_code_1', array('maxlength' => 45)); ?>
<?php echo $form->textFieldControlGroup($model, 'car_code_2', array('maxlength' => 45)); ?>
<?php echo $form->textFieldControlGroup($model, 'car_type_id'); ?>
<?php echo $form->textFieldControlGroup($model, 'car_generation_id'); ?>
<?php echo $form->textFieldControlGroup($model, 'car_color_id'); ?>
<?php echo $form->textFieldControlGroup($model, 'date_in'); ?>
<?php echo $form->textFieldControlGroup($model, 'date_out'); ?>
<?php echo $form->textFieldControlGroup($model, 'branch_id'); ?>
<?php echo $form->textFieldControlGroup($model, 'car_or_spare_status_id'); ?>
<?php echo $form->textFieldControlGroup($model, 'Brand_id'); ?>
    <?php echo $form->textFieldControlGroup($model, 'user_id'); ?>

<div class="form-actions">
<?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>
</div>

<?php $this->endWidget(); ?>
