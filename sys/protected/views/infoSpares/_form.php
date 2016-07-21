<?php
/* @var $this InfoSparesController */
/* @var $model InfoSpares */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'info-spares-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => true,
        ));
?>
<?php
$user = User::model()->findByPk(Yii::app()->user->id);
if (!Yii::app()->user->checkAccess('User')) {
    $user->branch_id = Yii::app()->session['admin_sale_branch'];
}
?>
<script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>
<div id="creat"></div>
<div class="row">
    <div class="col-md-4  ">
        <?php echo $form->textFieldControlGroup($model, 'type_spares', array('maxlength' => 255)); ?>
    </div>
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'spare_code', array('maxlength' => 45)); ?></div>
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'spare_name', array('maxlength' => 255)); ?></div>

</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->textFieldControlGroup($model, 'spare_price_buy', array('id' => 'buy')); ?>
        <script type="text/javascript">$("#buy").maskMoney();</script>
    </div>
    <div class="col-md-4">
        <?php echo $form->textFieldControlGroup($model, 'spare_price_sale', array('id' => 'sale')); ?>
        <script type="text/javascript">$("#sale").maskMoney();</script>
    </div>
    <div class="col-md-4"><?php echo $form->textFieldControlGroup($model, 'qautity', array('readonly' => empty($model->id) ? false : true)); ?></div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-10">
                <?php echo $form->dropDownListControlGroup($model, 'spare_position_id', CHtml::listData(SparesPosition::model()->findAll('branch_id=' . $user->branch_id . ''), 'id', 'name'), array('empty' => '=== ເລືອກ​ຕຳ​ແໜ່ງ===')); ?>
            </div>
            <div class="col-md-1" style="padding-left: 0; padding-top: 26px;">
                <?php
                echo CHtml::ajaxLink(
                        '<span class="glyphicon glyphicon-plus"></span>', // the link body (it will NOT be HTML-encoded.)
                        array('infoSpares/position'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
                        array(
                    'update' => '#creat'), array(
                    'class' => 'btn btn-block'
                        )
                );
                ?>
            </div>
            <div class="col-md-1" style="padding-left: 0; padding-top: 26px;">
                <?php
                if (Yii::app()->user->checkAccess('Admin')) {
                    echo CHtml::ajaxLink(
                            '<span class="glyphicon glyphicon-remove-circle"></span>', // the link body (it will NOT be HTML-encoded.)
                            array('infoSpares/positiondel'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
                            array(
                        'update' => '#creat'), array(
                        'class' => 'btn btn-block'
                            )
                    );
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
<?= ($model->car_or_spare_status_id == 2) ? " $('.box1').show();" : "$('.box1').hide();" ?>
            $('#dropdown').change(function () {
                $('.box1').hide();
                $('.' + $(this).val()).show();
            });
        });
    </script>
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
    <div class="col-md-4"><?php echo $form->dropDownListControlGroup($model, 'car_or_spare_status_id', CHtml::listData(CarOrSpareStatus::model()->findAll('id!=3'), 'id', 'status'), array('id' => "dropdown", 'empty' => '=== ເລືອກ​ສະ​ຖາ​ນະ ===')); ?></div>
    <div class="col-md-4 box1 2"><?php echo $form->dropDownListControlGroup($model, 'branch_from_share', CHtml::listData(Branch::model()->findAll(), 'id', 'branch_name'), array('empty' => '=== ເລືອກ​ສາ​ຂາ ===')); ?> <span style="color: red;"><?php echo Yii::app()->user->getFlash('error'); ?></span></div>
    <div class="col-md-4 ">
        <?php echo $form->textFieldControlGroup($model, 'number_come', array('maxlength' => 45)); ?>
    </div>
</div>

<?php echo $form->hiddenField($model, 'branch_id', array('value' => $user->branch_id)); ?>

<?php echo $form->hiddenField($model, 'user_id', array('value' => Yii::app()->user->id)); ?>
<div align="right">
    <?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
</div>
<?php $this->endWidget(); ?>



