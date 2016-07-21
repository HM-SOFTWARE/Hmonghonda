
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
                <h4 class="modal-title" id="myModalLabel">
                    <?php
                    if ($_GET['insert_last'] == 1) {
                        echo "ປ້ອນ​ຈຳ​ນວນ​ອາ​ໄຫຼ່ເຂົ້າ​ໃໝ່";
                    } else {
                        echo "​ແກ້ຈຳ​ນວນ​ອາ​ໄຫຼ່ປ້ອນ​ຜິດ";
                    }
                    ?>
                </h4>
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
                <?php
                if ($_GET['insert_last'] == 1) {
                    ?>
                    <div class="row">
                        <div class="col-md-12"><label>ອາ​ໄຫຼ່​ທີ​ຍັງ​ເຫຼືອ</label><input type="qautity_old" value="<?= $model->qautity ?>" required class="form-control" readonly></div>
                        <div class="col-md-12" style="padding-top:5px;"><label>ອາ​ໄຫຼ່​ເຂົ້າ​ໃໜ່</label><input type="number" min="1" name="qautity_new" value="" required class="form-control"></div>
                        <div class="col-md-12" style="padding-top:5px;">
                            <label>ເລກ​ທີ່​ນຳ​ເຂົ້າ</label>

                            <input type="text" value="" name="number_come" required class="form-control">
                            <input type="hidden" name="insert_last" value="1">
                        </div>
                    </div>
                    <?php
                } else {
                    $last_old = LastOldSpares::model()->findByAttributes(array('info_spares_id' => $model->id));
                    if (empty($last_old)) {
                        $last_old = New LastOldSpares();
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-12"><label>ອາ​ໄຫຼ່​ທີ​ຍັງ​ເຫຼືອ</label><input type="qautity_old" value="<?= $last_old->old_qautity ?>" required class="form-control" readonly></div>
                        <div class="col-md-12" style="padding-top:5px;"><label>ອາ​ໄຫຼ່​ເຂົ້າ​ໃໜ່</label><input type="number" min="1" name="qautity_new" value="<?= $model->qautity - $last_old->old_qautity ?>" required class="form-control"></div>
                        <div class="col-md-12" style="padding-top:5px;">
                            <label>ເລກ​ທີ່​ນຳ​ເຂົ້າ</label>

                            <input type="text" value="<?= $model->number_come ?>" name="number_come" class="form-control">
                            <input type="hidden" name="insert_last" value="0">
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div align="right" style="padding-top: 10px;"> <?php echo BsHtml::submitButton('ບັນ​ທືກ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_PUSHPIN)); ?></div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>