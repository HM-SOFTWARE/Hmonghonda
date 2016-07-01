<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            show: true,
        })
    });
</script>
<div style="top:1%;" class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ລາຍ​ລະ​ອຽດຜູ້​ຊື້") ?></h4>
            </div>
            <div class="modal-body">

                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'customer-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => TRUE),
                    'action' => Yii::app()->createUrl('customer/create')
                ));
                ?>
                <div class="row">
                    <div class="col-md-6"> <?php echo $form->textFieldControlGroup($model, 'first_name', array('maxlength' => 255)); ?></div>
                    <div class="col-md-6"><?php echo $form->textFieldControlGroup($model, 'last_name', array('maxlength' => 255)); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><?php echo $form->textFieldControlGroup($model, 'age', array('maxlength' => 45)); ?></div>
                    <div class="col-md-6"><?php echo $form->textFieldControlGroup($model, 'occupation', array('maxlength' => 45)); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><?php echo $form->textFieldControlGroup($model, 'phone_1', array('maxlength' => 45)); ?></div>
                    <div class="col-md-6"><?php echo $form->textFieldControlGroup($model, 'phone_2', array('maxlength' => 45)); ?></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo $form->dropDownListControlGroup($model, 'province_id', CHtml::listData(Province::model()->findAll(), 'id', 'province_name'), array(
                            'empty' => Yii::t('app', '=== ເລືອກ​ແຂວງ ==='),
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('infonCar/ajaxcheckDistrict'),
                                'update' => '#Customer_district_id', //selector to update value
                                'data' => array('province_id' => 'js:this.value'),
                            ))
                        );
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $form->dropDownListControlGroup($model, 'district_id', array('' => Yii::t('app', '=== ເລືອກ​ເມືອງ ===')));
                        ?>

                    </div>
                </div>
                <?php echo $form->textAreaControlGroup($model, 'address', array('rows' => 3)); ?>
                <?php echo $form->hiddenField($model, 'date', array('value' => date('Y-m-d'))); ?>
                <div align="right"> <?php echo BsHtml::submitButton('ອອກ​ໃບ​ບີນ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_PUSHPIN)); ?></div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>