<?php
/* @var $this AcountTransferController */
/* @var $model AcountTransfer */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'name',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'amount'); ?>
    <?php echo $form->textFieldControlGroup($model,'date'); ?>
    <?php echo $form->textFieldControlGroup($model,'branch_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
