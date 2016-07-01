<?php
$this->layout = "login";
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => true,
        ));
?>
<?php echo $form->textFieldControlGroup($model, 'username', array('maxlength' => 255, 'labelOptions' => array('label' => Yii::t('app', 'ຊື່​ເຂົ້າ​ລະ​ບົບ')))); ?>
<?php echo $form->passwordFieldControlGroup($model, 'password', array('maxlength' => 255, 'labelOptions' => array('label' => Yii::t('app', 'ລະ​ຫັດ​ຜ່ານ')))); ?>
<div align="right">
<?php echo BsHtml::submitButton('ເຂົ້າ​ລະ​ບົບ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_LOG_IN)); ?>
</div>
    <?php $this->endWidget(); ?>
