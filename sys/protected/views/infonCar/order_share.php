
<div id="err"></div>
<div  id="cancle" class="status">
    <?php
    /* @var $this InfonCarController */
    /* @var $dataProvider CActiveDataProvider */
    $this->layout = NULL;
    $criteria = new CDbCriteria();
    $criteria->addInCondition('id', $all_list_order);
    $carinfo = InfonCar::model()->findAll($criteria);
    ?>
    <script type="text/javascript">
<?php
$i = 0;
foreach ($carinfo as $carinfo1) {
    $i++;
    ?>
            $(function () {
                $("#SaleStatus_id_<?= $i ?>").change(function () {
                    if ($(this).val() == 1 || $(this).val() == 4) {
                        $("#amout_<?= $i ?>").prop("disabled", true);
                        $("#inter_<?= $i ?>").prop("disabled", true);
                        $("#count_date_pay_<?= $i ?>").prop("disabled", true);
                    } else {
                        $("#amout_<?= $i ?>").prop("disabled", false);
                        $("#inter_<?= $i ?>").prop("disabled", false);
                        $("#count_date_pay_<?= $i ?>").prop("disabled", false);
                    }

                });
            });
    <?php
}
?>
    </script>

    <?php
    $this->breadcrumbs = array(
        'Infon Cars',
    );
    $this->menu = array(
        array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create InfonCar', 'url' => array('create')),
        array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage InfonCar', 'url' => array('admin')),
    );
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?= Yii::t('app', 'ລາຍ​ການ​ລົດ​ທີ່​ຈະ​ແບ່ງ​ໃຫ້​ສາ​ຂາ') ?></h3>
        </div>
        <form >

            <table class="table table-striped">
                <tr>
                    <th style="width: 40px;">ລ​/ດ</th> 
                    <th style="width: 100px;">ເລກ​ຖັງ</th>
                    <th style="width: 100px;">ລຸ້ນ​ລົດ</th>
                    <th style="width: 80px;">ຍີ່​ຫໍ​່</th>
                    <th style="width: 70px;">ສີ​ລົດ</th>
                    <th style="width: 1​00px;">ລາ​ຄາ/ກີບ</th>
                    <th style="width: 100px;">ສະ​ຖາ​ນະ</th>
                    <th style="width: 100px;">ແບ່ງ​ໃຫ້​ສາ​ຂາ</th>
                    <th style="width: 90px;">ຍົກ​ເລີກ</th>
                </tr>
                <?php
                $i = 0;
                foreach ($carinfo as $k => $carinfos) {
                    $i++;
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $carinfos->car_code_2 ?></td>
                        <td><?= $carinfos->generation ?></td>
                        <td><?= $carinfos->brand ?></td>
                        <td><?= $carinfos->color ?></td>
                        <td><?= number_format($carinfos->car_price_sale, 2) ?></td>
                        <td>

                            <?php
                            $ac[$k] = Yii::app()->session['full_or_dao'];
                            Yii::app()->session['status_pay'] = $ac;
                            echo CHtml::dropDownList('status_pay[' . $k . ']', !empty(Yii::app()->session['status_pay']) ? Yii::app()->session['status_pay'][$k] : '', CHtml::listData(SaleStatus::model()->findAll('id in (4)'), 'id', 'name'), array('id' => 'SaleStatus_id_' . $i . '',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('infonCar/Status', array('key' => $k)),
                                    // 'update' => '.qautity_' . $k . ',#qautity',
                                    'update' => '.status',
                                    'data' => array('status_id' => 'js:this.value'),
                                ),
                            ));
                            ?>

                        </td>
                        <td>
                            <?php
                            if (isset(Yii::app()->session['admin_sale_branch'])) {
                                $a = Yii::app()->session['admin_sale_branch'];
                            } else {
                                $a = User::model()->findByPk(Yii::app()->user->id)->branch_id;
                            }
                            echo CHtml::dropDownList('share_to_branch[' . $k . ']', isset(Yii::app()->session['Sharebranch']) ? Yii::app()->session['Sharebranch'] : "", CHtml::listData(Branch::model()->findAll('id not in(' . $a . ')'), 'id', 'branch_name'), array('empty' => '== ເລືອກ​ ==',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('infonCar/Sharebranch', array('key' => $k)),
                                    // 'update' => '.qautity_' . $k . ',#qautity',
                                    'update' => '.status',
                                    'data' => array('share_to_branch' => 'js:this.value'),
                                ),
                            ));
                            ?>
                        </td>

                        <td>
                            <?php
                            echo CHtml::link(
                                    '<span class="glyphicon glyphicon-remove"></span> ຍົກ​ເລີກ', // the link body (it will NOT be HTML-encoded.)
                                    array('infonCar/cancle&id=' . $k . ''), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
                                    array(
                                'class' => 'btn btn-danger btn-sm')
                            );
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <?php
                if (!empty($all_list_order)) {
                    ?>
                    <tr>
                        <td colspan="10">
                            <div class="col-md-6"> 
                                <?php
                                if (!empty(Yii::app()->session['admin_sale_branch'])) {
                                    ?>
                                    <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=<?= Yii::app()->session['full_or_dao'] ?>&share=true&branc_id=<?= Yii::app()->session['admin_sale_branch'] ?>" class="btn btn-primary">ສັ່ງ​ເພີ່ມ</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&share=true&status=<?= Yii::app()->session['full_or_dao'] ?>" class="btn btn-primary">ສັ່ງ​ເພີ່ມ</a>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="col-md-6" align="right"> 
                                <?php
                                echo CHtml::ajaxLink('<span class="glyphicon glyphicon-compressed"></span> ຢັ້ງ​ຢືນ​ການ​ຊື້', Yii::app()->createUrl('infonCar/comfirmSale'), array(
                                    'type' => 'POST',
                                    'update' => '#err'
                                        ), array('class' => 'btn btn-success',));
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <?php
                if (empty($all_list_order)) {
                    ?>
                    <tr>
                        <td colspan="10">ຂໍ້​ມູ​ນ​ສັ່ງ​ຊື່​ລົດ​ບໍ່​ມີ</td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </form>
    </div>
</div>
