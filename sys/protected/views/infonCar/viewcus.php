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
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ລາຍ​ລະ​ອຽດ​ລູກ​ຄ້າ") ?></h4>
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
                            'name' => 'id',
                            'value' => sprintf('%06d', $model->id),
                            'label' => isset($_GET['share']) ? 'ລະ​ຫັດ​ໃບ​ບີນ' : 'ລະ​ຫັດ​ລູກ​ຄ້າ'
                        ),
                        array(
                            'name' => 'first_name',
                            'value' => $model->first_name . " " . $model->last_name,
                            'label' => isset($_GET['share']) ? 'ສາ​ຂາ' : 'ຊື່'
                        ),
                        array(
                            'name' => 'age',
                            'visible' => isset($_GET['share']) ? false : true
                        ),
                        array(
                            'name' => 'occupation',
                            'visible' => isset($_GET['share']) ? false : true
                        ),
                        array(
                            'name' => 'province_id',
                            'value' => $model->province->province_name
                        ),
                        array(
                            'name' => 'district_id',
                            'value' => $model->district->district_name
                        ),
                        array(
                            'name' => 'address',
                        ),
                        array(
                            'name' => 'phone_1',
                        ),
                        array(
                            'name' => 'phone_2',
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>