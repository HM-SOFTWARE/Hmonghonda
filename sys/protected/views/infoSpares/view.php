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
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ລາຍ​ລະ​ອຽດ​ອາ​ໄຫຼ່") ?></h4>
            </div>
            <div class="modal-body">

                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'htmlOptions' => array(
                        'class' => 'table table-striped table-condensed table-hover',
                    ),
                    'data' => $model,
                    'attributes' => array(
                        array(
                            'name' => 'type_spares',
                        //   'value' => TypeSpares::model()->findByPk($model->type_spares_id),
                        ),
                        'spare_code',
                        'spare_name',
                        array(
                            'name' => 'spare_price_buy',
                            'value' => number_format($model->spare_price_buy, 2),
                        ),
                        array(
                            'name' => 'spare_price_sale',
                            'value' => number_format($model->spare_price_sale, 2),
                        ),
                        array(
                            'name' => 'spare_position_id',
                            'value' => SparesPosition::model()->findByPk($model->spare_position_id),
                        ),
                        array(
                            'name' => 'car_or_spare_status_id',
                            'value' => CarOrSpareStatus::model()->findByPk($model->car_or_spare_status_id),
                        ),
                        array(
                            'name' => 'branch_from_share',
                            'value' => Branch::model()->findByPk($model->branch_from_share),
                        ),
                        array(
                            'name' => 'user_id',
                            'value' => $model->user->first_name . " " . $model->user->last_name,
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>