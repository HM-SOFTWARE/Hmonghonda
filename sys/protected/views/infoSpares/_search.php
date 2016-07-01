<?php
/* @var $this InfoSparesController */
/* @var $model InfoSpares */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'spare_code',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'spare_name',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'spare_price_buy'); ?>
    <?php echo $form->textFieldControlGroup($model,'spare_price_sale'); ?>
    <?php echo $form->textFieldControlGroup($model,'date_in'); ?>
    <?php echo $form->textFieldControlGroup($model,'date_out'); ?>
    <?php echo $form->textFieldControlGroup($model,'spare_position_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'branch_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'car_or_spare_status_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'user_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'branch_from_share'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
