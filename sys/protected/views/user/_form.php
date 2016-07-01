<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form BSActiveForm */
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


<?php echo $form->textFieldControlGroup($model, 'first_name', array('readonly' => isset($_GET['pro']) ? 'readonly' : '', 'maxlength' => 255, 'placeholder' => "ຊື່", 'labelOptions' => array('label' => 'ຊື່'))); ?>
<?php echo $form->textFieldControlGroup($model, 'last_name', array('readonly' => isset($_GET['pro']) ? 'readonly' : '', 'maxlength' => 255, 'placeholder' => "ນາມ​ສະ​ກຸນ", 'labelOptions' => array('label' => 'ນາມ​ສະ​ກຸນ'))); ?>
<?php echo $form->textFieldControlGroup($model, 'email', array('maxlength' => 255, 'placeholder' => "ອີ​ເມວ", 'labelOptions' => array('label' => 'ອີ​ເມວ'))); ?>
<?php echo $form->textFieldControlGroup($model, 'phone', array('maxlength' => 255, 'placeholder' => "ເບີ​ໂທ", 'labelOptions' => array('label' => 'ເບີ​ໂທ'))); ?>
<?php echo $form->textFieldControlGroup($model, 'phone1', array('maxlength' => 255, 'placeholder' => "ເບີ​ໂທ1", 'labelOptions' => array('label' => 'ເບີ​ໂທ1'))); ?>
<?php echo $form->textFieldControlGroup($model, 'username', array('maxlength' => 255, 'placeholder' => "ຊື່ເຂົ້າ​ລະ​ບົບ", 'labelOptions' => array('label' => 'ຊື່ເຂົ້າ​ລະ​ບົບ'))); ?>
<?php echo $form->passwordFieldControlGroup($model, 'password', array('maxlength' => 255, 'placeholder' => "ລະ​ຫັດ​ຜ່ານ", 'labelOptions' => array('label' => 'ລະ​ຫັດ​ຜ່ານ'))); ?>
<div style="display: <?= isset($_GET['pro']) ? "none" : "inline" ?>">
    <?php echo $form->dropDownListControlGroup($model, 'user_type', array('' => '=== ເລືອກ​ປະ​ເພດ​ຜູ້​ໃຊ້ ===', 'Admin' => 'Admin', 'User' => 'User'), array('maxlength' => 5, 'labelOptions' => array('label' => 'ປະ​ເພດ​ເຂົ້າ​ລະ​ບົບ'))); ?>
    <?php echo $form->dropDownListControlGroup($model, 'branch_id', CHtml::listData(Branch::model()->findAll(), 'id', 'branch_name'), array('empty' => "=== ເລືອກ​ສາ​ຂາ ===", 'labelOptions' => array('label' => 'ສາ​ຂາ'))); ?>
    <?php echo $form->dropDownListControlGroup($model, 'status', array('1' => 'ເປິດ​ໃຊ້​ງານ', '0' => 'ປິດ​ໃຊ້​ງານ'), array('labelOptions' => array('label' => 'ເປິດຫຼື​ປິດ​ເຂົ້າ​ໃຊ້​ລະ​ບົບ'))); ?>
</div>
<div align="right">
    <?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_SAVED)); ?>
</div>
<?php $this->endWidget(); ?>
