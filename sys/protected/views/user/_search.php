<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'first_name',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'last_name',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone1',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>255)); ?>
        <?php echo $form->textFieldControlGroup($model,'user_type',array('maxlength'=>5)); ?>
    <?php echo $form->textFieldControlGroup($model,'branch_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
