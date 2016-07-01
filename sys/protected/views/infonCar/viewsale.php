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
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ລາຍ​ລະ​ອຽດ​ລົດ") ?></h4>
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
                            'name' => 'car_type_id',
                            'value' => CarType::model()->findByPk($model->car_type_id)->type_name,
                        ),
                        array(
                            'name' => 'generation',
                        ),
                        array(
                            'name' => 'brand',
                        ),
                        'car_code_1',
                        'car_code_2',
                        array(
                            'name' => 'color',
                        ),
                        array(
                            'name' => 'car_price_sale',
                            'value' => number_format($model->car_price_sale, 2),
                        ),
                        array(
                            'name' => 'car_or_spare_status_id',
                            'value' => CarOrSpareStatus::model()->findByPk($model->car_or_spare_status_id)->status,
                        ),
                        array(
                            'name' => 'branch_from_share',
                            'value' => empty($model->branch_from_share) ? "" : Branch::model()->findByPk($model->branch_from_share)->branch_name,
                        ),
                        'date_in',
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>