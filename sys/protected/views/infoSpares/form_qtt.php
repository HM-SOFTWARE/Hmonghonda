
<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            show: true,
        })
    });
</script>
<div style="top:1%;" class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="width: 30%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ປ້ອນ​ຈຳ​ນວນ​ອາ​ໄຫຼ່") ?></h4>
            </div>
            <div class="modal-body">

                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'sale-car-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => TRUE),
                    'action' => Yii::app()->createUrl('infoSpares/qtt&id=' . $_GET['id'] . '')
                ));
                ?>
                <div class="row">
                    <div class="col-md-12"> <?php echo $form->textFieldControlGroup($model, 'qautity'); ?>
                    </div>
                </div>
                <div align="right"> <?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_PUSHPIN)); ?></div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>