<?php
/* @var $this InfonCarController */
/* @var $model InfonCar */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'infon-car-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => true,
        ));
?>
<script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>

<div class="row">
    <div class="col-md-4"><?php echo $form->dropDownListControlGroup($model, 'car_type_id', CHtml::listData(CarType::model()->findAll(), 'id', 'type_name'), array('empty' => '=== ເລືອກ​ປະ​ເພດ​ລົດ ===')); ?></div>
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'generation', array('maxlength' => 255)); ?></div>
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'brand', array('maxlength' => 255)); ?></div>
</div>
<div class="row">
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'car_code_1', array('maxlength' => 45)); ?></div>
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'car_code_2', array('maxlength' => 45)); ?></div>
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'color', array('maxlength' => 45)); ?></div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->textFieldControlGroup($model, 'car_price_buy', array('maxlength' => 45, 'id' => 'buy')); ?>
        <script type="text/javascript">$("#buy").maskMoney();</script>
    </div>
    <div class="col-md-4">
        <?php echo $form->textFieldControlGroup($model, 'car_price_sale', array('maxlength' => 45, 'id' => 'sale')); ?>
        <script type="text/javascript">$("#sale").maskMoney();</script>
    </div>
    <div class="col-md-4">
        <?php
        echo $form->labelEx($model, 'date_in');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'date_in',
            'htmlOptions' => array(
                'class' => 'datepicker form-control',
            ),
        ));
        echo $form->error($model, 'date_in', array('style' => "color:red;"));
        ?>

    </div>
</div>
<?php
$user = User::model()->findByPk(Yii::app()->user->id);
if (!Yii::app()->user->checkAccess('User')) {
    $user->branch_id = Yii::app()->session['admin_sale_branch'];
}
?>
<script>
    $("#show").click(function () {
        $("p").show();
    });
</script>
<div class="row">
    <script>
        $(document).ready(function () {
<?= ($model->car_or_spare_status_id == 2) ? " $('.box1').show();" : "$('.box1').hide();" ?>
            $('#dropdown').change(function () {
                $('.box1').hide();
                $('.' + $(this).val()).show();
            });
        });
    </script>
    <div class="col-md-4"><?php echo $form->dropDownListControlGroup($model, 'car_or_spare_status_id', CHtml::listData(CarOrSpareStatus::model()->findAll('id!=3'), 'id', 'status'), array('id' => "dropdown", 'empty' => '=== ເລືອກ​ສະ​ຖາ​ນະ ===')); ?></div>
    <div class="col-md-4 box1 2">
        <?php echo $form->dropDownListControlGroup($model, 'branch_from_share', CHtml::listData(Branch::model()->findAll('id not in(' . $user->branch_id . ')'), 'id', 'branch_name'), array('empty' => '=== ເລືອກ​ສາ​ຂາ ===')); ?>

        <span style="color: red;"><?php echo Yii::app()->user->getFlash('error'); ?></span>
    </div>
    <div class="col-md-4">
        <?php echo $form->hiddenField($model, 'branch_id', array('value' => $user->branch_id)); ?>
        <?php echo $form->textFieldControlGroup($model, 'number_com', array('maxlength' => 255)); ?>
    </div>
</div>
<div align="right">
    <?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_SAVE)); ?>
</div>
<?php $this->endWidget(); ?>
