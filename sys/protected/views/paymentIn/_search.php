<?php
/* @var $this PaymentInController */
/* @var $model PaymentIn */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textAreaControlGroup($model,'detail',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'amonut'); ?>
    <?php echo $form->textFieldControlGroup($model,'date'); ?>
    <?php echo $form->textFieldControlGroup($model,'branch_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
