<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            show: true,
        })
    });
</script>
<script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>
<div style="top:1%;" class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ລາຍ​ລະ​ອຽດ​ຊຳ​ລະ​ເງີນ") ?></h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'sale-car-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => TRUE),
                    'action' => Yii::app()->createUrl('infonCar/detailpay')
                ));
                ?>
                <div class="row">
                    <div class="col-md-6"><b>ຈຳ​ນວນ​ເງີນ​ທີ​ຈ່າຍ</b> <?php echo CHtml::textField('paid1', $model->paid, array('disabled' => 'disabled', 'class' => 'form-control', 'maxlength' => 255)); ?>
                        <?php echo $form->hiddenField($model, 'paid', array('maxlength' => 255, 'id' => 'paid')); ?>
                        <script type="text/javascript">$("#paid").maskMoney();</script>
                    </div>
                    <div class="col-md-6"><?php echo $form->textFieldControlGroup($model, 'other_payment', array('required' => 'required', 'maxlength' => 255)); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><b>ຈຳ​ນວນ​ເງີນ​ປັບ​ໄໝ</b> 
                        <?php echo CHtml::textField('pup_mai', '', array('id' => 'pup_mai', 'class' => 'form-control', 'maxlength' => 255)); ?>
                        <script type="text/javascript">$("#pup_mai").maskMoney();</script>
                    </div>
                    <div class="col-md-6" style="padding-top: 20px;">
                        <input type="radio" required name="cash_transfer" value="Cash"> ຈ່າຍ​ສົດ
                        <input type="radio" required name="cash_transfer" value="Transfer">​ ໂອນ​ເຂົ້າ​ບັນ​ຊີ
                    </div>
                </div>
                <?php echo $form->hiddenField($model, 'date', array('value' => date('Y-m-d'))); ?>
                <?php echo CHtml::hiddenField('sale_id', $_GET['sale_id']); ?>
                <div align="right"> <?php echo BsHtml::submitButton('ຢັ້ງ​ຢືນ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_PUSHPIN)); ?></div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>