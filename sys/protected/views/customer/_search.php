<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'first_name',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'last_name',array('maxlength'=>255)); ?>
    <?php echo $form->textAreaControlGroup($model,'address',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_1',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_2',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'district_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'date'); ?>
    <?php echo $form->textFieldControlGroup($model,'province_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
