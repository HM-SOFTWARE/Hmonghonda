<?php
/* @var $this AcountTransferController */
/* @var $model AcountTransfer */
/* @var $form BSActiveForm */
$this->layout = NULL;
?>
<script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>
<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'acount-transfer-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<?php
if (Yii::app()->user->checkAccess('Admin')) {
    $data = Branch::model()->findAll();
} else {
    $user = User::model()->findByPk(Yii::app()->user->id);
    $data = Branch::model()->findAll('id=' . $user->branch_id . '');
}
?>
<?php echo $form->dropDownListControlGroup($model, 'branch_id', CHtml::listData($data, 'id', 'branch_name')); ?>
<?php echo $form->textFieldControlGroup($model, 'name', array('maxlength' => 255)); ?>
<?php echo $form->textFieldControlGroup($model, 'amount', array('id' => 'am')); ?>
<script type="text/javascript">$("#am").maskMoney();</script>
<?php
echo $form->labelEx($model, 'date');
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'date',
    'htmlOptions' => array(
        'class' => 'datepicker form-control',
    ),
));
echo $form->error($model, 'date', array('style' => "color:red;"));
?>
<br/>
<?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
<?php $this->endWidget(); ?>
