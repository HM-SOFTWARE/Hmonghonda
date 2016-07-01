<?php
/* @var $this PaymentInController */
/* @var $model PaymentIn */
/* @var $form BSActiveForm */
$this->layout = NULL;
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'payment-in-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>
<?php echo $form->errorSummary($model); ?>
<?php
if (Yii::app()->user->checkAccess('Admin')) {
    $data = Branch::model()->findAll();
} else {
    $user = User::model()->findByPk(Yii::app()->user->id);
    $data = Branch::model()->findAll('id=' . $user->branch_id . '');
}
?>
<?php echo $form->dropDownListControlGroup($model, 'branch_id', CHtml::listData($data, 'id', 'branch_name')); ?>
<?php echo $form->textAreaControlGroup($model, 'detail', array('rows' => 6)); ?>
<?php echo $form->textFieldControlGroup($model, 'amonut', array('id' => 'am')); ?>
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
