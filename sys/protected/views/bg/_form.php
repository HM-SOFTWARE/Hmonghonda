<?php

/* @var $this BgController */
/* @var $model Bg */
/* @var $form BSActiveForm */
?>

<?php

$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'bg-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
        ));
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->fileFieldControlGroup($model, 'photo', array('maxlength' => 255)); ?>
<?php echo $form->hiddenField($model, 'date', array('value' => date('Y-m-d'))); ?>

<?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
