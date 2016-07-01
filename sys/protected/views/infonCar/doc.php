<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            show: true,
        })
    });
</script>
<div style="top:1%;" class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ວັນທີເອກະສານມາ") ?></h4>
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
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'date_d',
                    'htmlOptions' => array(
                        'class' => 'datepicker form-control',
                    ),
                ));
                ?>
                <br/>
                <div align="right">
                    <?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_SAVE)); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>