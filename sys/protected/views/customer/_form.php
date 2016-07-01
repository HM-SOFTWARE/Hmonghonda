<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'customer-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'first_name',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'last_name',array('maxlength'=>255)); ?>
    <?php echo $form->textAreaControlGroup($model,'address',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_1',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_2',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'district_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'date'); ?>
    <?php echo $form->textFieldControlGroup($model,'province_id'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
