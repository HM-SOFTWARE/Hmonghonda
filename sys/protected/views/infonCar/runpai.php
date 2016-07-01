<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            show: true,
        })
    });
</script>
<script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>
<div style="top:1%;" class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ວັນທີ") ?></h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'infon-car-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        // 'enableAjaxValidation' => true,
                ));
                ?>
                <div class="row">
                    <div class="col-md-6">
                        ວັນ​ທີແຈ້ງສັບສີນ
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'date_note',
                            'htmlOptions' => array(
                                'class' => 'datepicker form-control',
                                'disabled' => empty($model->date_note) ? true : Yii::app()->user->checkAccess('Admin') ? false : true
                            ),
                        ));
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if ($model->pay_note == "0.00") {
                            $pan = NULL;
                        } else {
                            $pan = $model->pay_note;
                        }
                        ?>
                        <?php echo $form->textFieldControlGroup($model, 'pay_note', array('maxlength' => 45, 'id' => 'buy', 'disabled' => empty($pan) ? true : Yii::app()->user->checkAccess('Admin') ? false : true)); ?>
                        <script type="text/javascript">$("#buy").maskMoney();</script>
                    </div>
                </div>

                <div class="row" style="display: <?= isset($_GET['c']) ? "none" : "inline" ?>">
                    <div class="col-md-6">

                        ວັນ​ທີຂືນທະບຽບ
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'date_placars',
                            'htmlOptions' => array(
                                'class' => 'datepicker form-control',
                                'disabled' => empty($model->date_placars) ? true : Yii::app()->user->checkAccess('Admin') ? false : true
                            ),
                        ));
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if ($model->pay_placar == "0.00") {
                            $pa = NULL;
                        } else {
                            $pa = $model->pay_placar;
                        }
                        ?>
                        <?php echo $form->textFieldControlGroup($model, 'pay_placar', array('maxlength' => 45, 'id' => 'buy1', 'disabled' => empty($pa) ? true : Yii::app()->user->checkAccess('Admin') ? false : true)); ?>
                        <script type="text/javascript">$("#buy1").maskMoney();</script>
                    </div>
                </div>
                <br/>

                <br/>
                <div align="right">
                    <?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_SAVE)); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>