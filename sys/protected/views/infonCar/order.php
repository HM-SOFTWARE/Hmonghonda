<script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>
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
foreach ($all_list_order as $carinfo1) {
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
            <h3 class="panel-title"> <?= Yii::t('app', 'ລາຍ​ການ​ສັ່ງລົດ​ຊື໊') ?></h3>
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
                    <th style="width: 100px;">ສະ​ຖາ​ນະ​ການ​ຊື້</th>
                    <th style="width: 100px;"><?= (Yii::app()->session['full_or_dao'] == 1) ? "ຈຳ​ນວນ​ເງີນ​ທີ​ຈ່າຍ" : "ຈ່າຍກອນ" ?></th>


                    <?php
                    if (Yii::app()->session['full_or_dao'] == 2) {
                        ?>
                        <th style="width: 90px;">ອັດ​ຕາ ດອກ​ເບ້ຍ</th>
                        <th style="width: 90px;">ໄລຍະ​ຜ່ອນ</th>
                        <?php
                    } else {
                        ?>
                        <th style="width: 90px;"></th>
                        <th style="width: 90px;"></th>
                        <?php
                    }
                    ?>
                    <?php
                    if (Yii::app()->session['full_or_dao'] == 2) {
                        ?>
                        <th>ຍັງຄ້າງ</th>
                        <?php
                    }
                    ?>
                    <th style="width: 90px;">ພ້ອມປ້າຍ</th>
                    <th style="width: 90px;">ຍົກ​ເລີກ</th>
                </tr>
                <?php
                $i = 0;
                $total = 0;
                foreach ($all_list_order as $k => $info_id) {
                    $carinfos = InfonCar::model()->findByPk($info_id);
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
                            $a[$k] = Yii::app()->session['full_or_dao'];
                            Yii::app()->session['status_pay'] = $a;
                            echo CHtml::dropDownList('status_pay[' . $k . ']', !empty(Yii::app()->session['status_pay']) ? Yii::app()->session['status_pay'][$k] : '', CHtml::listData(SaleStatus::model()->findAll('id in (' . Yii::app()->session['full_or_dao'] . ')'), 'id', 'name'), array('id' => 'SaleStatus_id_' . $i . '',
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
                            echo CHtml::textField("amonut_paid[$k]", (Yii::app()->session['status_pay'][$k] == 1 || Yii::app()->session['status_pay'][$k] == 4) ? number_format($carinfos->car_price_sale, 2) : Yii::app()->session['paid'][$k], array('id' => 'amout_' . $i . '', 'disabled' => (Yii::app()->session['status_pay'][$k] == 1 || Yii::app()->session['status_pay'][$k] == 4 || Yii::app()->session['status_pay'][$k] == 0) ? true : false, 'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('infonCar/Paid', array('key' => $k)),
                                    'update' => '.status',
                                    'data' => array('amonut_paid' => 'js:this.value'),
                            )));
                            ?>
                            <script type="text/javascript">$("#amout_<?= $i ?>").maskMoney();</script>
                        </td>

                        <td>
                            <?php
                            if (Yii::app()->session['full_or_dao'] == 2) {
                                $interset = array();
                                $inter = Interest::model()->findAll();
                                foreach ($inter as $inters) {
                                    $interset[$inters->interest] = $inters->interest;
                                }
                                echo CHtml::textField("interest[$k]", (Yii::app()->session['status_pay'][$k] == 1 || Yii::app()->session['status_pay'][$k] == 4) ? "" : Yii::app()->session['interest'][$k], array('size' => 3, 'id' => 'inter_' . $i . '', 'disabled1' => (Yii::app()->session['status_pay'][$k] == 1 || Yii::app()->session['status_pay'][$k] == 4 || Yii::app()->session['status_pay'][$k] == 0) ? true : false, 'ajax' => array(
                                        'type' => 'POST',
                                        'url' => CController::createUrl('infonCar/Interest', array('key' => $k)),
                                        'update' => '.status',
                                        'data' => array('interest' => 'js:this.value'),
                                )));
                            } else {
                                echo CHtml::hiddenField('interest[' . $k . ']', '0');
                            }
                            ?>
                        </td>

                        <td>
                            <?php
                            if (Yii::app()->session['full_or_dao'] == 2) {
                                echo CHtml::textField("period_paid[$k]", (Yii::app()->session['status_pay'][$k] == 1 || Yii::app()->session['status_pay'][$k] == 4 || Yii::app()->session['status_pay'][$k] == 0) ? "0" : Yii::app()->session['period_paid'][$k], array('id' => 'period_paid_' . $i . '', 'size' => 4, 'disabled1' => (Yii::app()->session['status_pay'][$k] == 1 || Yii::app()->session['status_pay'][$k] == 4 || Yii::app()->session['status_pay'][$k] == 0) ? true : false, 'ajax' => array(
                                        'type' => 'POST',
                                        'url' => CController::createUrl('infonCar/periodpaid', array('key' => $k)),
                                        'update' => '.status',
                                        'data' => array('period_paid' => 'js:this.value'),
                                )));
                            } else {
                                echo CHtml::hiddenField('period_paid[' . $k . ']', '0');
                            }
                            ?>
                            <?php
                            if (Yii::app()->session['full_or_dao'] == 2) {
                                if (isset(Yii::app()->session['discount_car'])) {
                                    $discount1 = (int) substr(preg_replace("/[^0-9]/", "", Yii::app()->session['discount_car']), 0, -2);
                                } else {
                                    $discount1 = 0;
                                }
                                $x = ($carinfos->car_price_sale - $discount1) - substr(preg_replace("/[^0-9]/", "", Yii::app()->session['paid'][$k]), 0, -2);
                                $s = ($x * Yii::app()->session['interest'][$k] * Yii::app()->session['period_paid'][$k]) / 100;
                                $tx = $s + $x;
                                ?>
                            <td><?= number_format($tx, 2) ?></td>
                            <?php
                        }
                        ?>
                        <td>
                            <?php
                            echo CHtml::checkBox("pai[$k]", (Yii::app()->session['pai'][$k] == 1) ? 1 : "", array('id' => 'pai_' . $i . '', 'value' => (Yii::app()->session['pai'][$k] == 1) ? 0 : 1, 'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('infonCar/pai', array('key' => $k)),
                                    'update' => '.status',
                                    'data' => array('pai' => 'js:this.value'),
                            )));
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
                    $total+= $carinfos->car_price_sale;
                }
                ?>
        </form>
        <tr>
            <td  align="right" colspan="7"><b>ສ່ວນຫຼຸດຕໍ່​ຈ​/ນ</b></td>
            <td>
                <?php
                echo CHtml::form('index.php?r=infonCar/discount', 'post', array('class' => 'floatrightup'));
                ?>
                <?php
                if (Yii::app()->session['full_or_dao'] == 1 || Yii::app()->session['full_or_dao'] == 2) {
                    echo CHtml::textField("discount", Yii::app()->session['discount_car'], array('id' => 'dc',
                        'onchange' => "this.form.submit()",
                    ));
                    /* echo CHtml::textField("discount", Yii::app()->session['discount_car'], array('id' => 'dc', 'ajax' => array(
                      'type' => 'POST',
                      'url' => CController::createUrl('infonCar/discount'),
                      'update' => '.status',
                      'data' => array('discount' => 'js:this.value'),
                      ))); */
                }
                ?>
                <?php
                echo CHtml::endForm();
                ?>
                <script type="text/javascript">$("#dc").maskMoney();</script>
            </td>
            <td colspan="4"><b><?= (Yii::app()->session['full_or_dao'] == 2 ? "ລວມ​ຈຳ​ນວນ​ຕ້ອງ​ຈ່າຍ" : "ລວມ​ທັງ​ໝົດ") ?>: 
                    <?= number_format((Yii::app()->session['full_or_dao'] == 2 ? substr(preg_replace("/[^0-9]/", "", Yii::app()->session['paid'][$k]), 0, -2) : $total - (substr(preg_replace("/[^0-9]/", "", Yii::app()->session['discount_car']), 0, -2) * $i)), 2) ?></b></td>
        </tr>
        <tr>
            <td colspan="8" ><b>ຂອງ​ແຖມ</b><br/>
                <?php
                if (Yii::app()->session['full_or_dao'] == 1 || Yii::app()->session['full_or_dao'] == 2) {
                    echo CHtml::textArea("cak_car", Yii::app()->session['givefree'], array('class' => 'form-control', 'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('infonCar/givefree'),
                            //  'update' => '.status',
                            'data' => array('cak_car' => 'js:this.value'),
                    )));
                }
                ?>
            </td>
        </tr>
        <?php
        if (!empty($all_list_order)) {
            ?>
            <tr>
                <td colspan="10">
                    <div class="col-md-6"> 
                        <?php
                        if (!empty(Yii::app()->session['admin_sale_branch'])) {
                            ?>
                            <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=<?= Yii::app()->session['full_or_dao'] ?>&branc_id=<?= Yii::app()->session['admin_sale_branch'] ?>" class="btn btn-primary"><?= (Yii::app()->session['full_or_dao'] == 2) ? "ກັບ​ຄືນ" : "ສັ່ງ​ຊື້​ເພີ່ມ" ?></a>
                            <?php
                        } else {
                            ?>
                            <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=<?= Yii::app()->session['full_or_dao'] ?>" class="btn btn-primary">ສັ່ງ​ຊື້​ເພີ່ມ</a>
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
        <!--</form>-->
    </div>
</div>
