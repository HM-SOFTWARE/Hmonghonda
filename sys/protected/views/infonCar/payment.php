<?php
$this->layout = NULL;
?>
<div id="payment1"></div>
<div id="payment">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?= Yii::t('app', 'ລາຍ​ການ​ຊຳ​ລະ​ຄ່າ​ລົດ') ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'action' => Yii::app()->createUrl('infonCar/payment')
                ));
                ?>
                <div class="col-md-3">
                    ລະ​ຫັດ​ລູກ​ຄ້າ:
                    <?php
                    echo CHtml::textField("cus_id", isset($_POST['cus_id']) ? $_POST['cus_id'] : '');
                    ?>
                    <input type="hidden" name="car_code"/>
                </div>
                <!--<div class="col-md-3">
                    ເລກ​ຈັກ:
                <?php
                echo CHtml::textField("car_code", isset($_POST['car_code']) ? $_POST['car_code'] : '');
                ?>
                </div>-->
                <div class="col-md-2"><button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-search"></span> ຄົ້ນ​ຫາ</button></div>
                <?php $this->endWidget(); ?>
            </div><br/>
            <table class="table table-striped">
                <tr>
                    <th>ລຳ​ດັບ</th>
                    <th colspan="5">ລາຍ​ລະ​ອຽດ</th>
                    <th>ລາ​ຄາ</th>
                    <th>ເງີນ​ຈ່າຍແລ້ວ</th>
                    <th></th>
                    <th >ເງີນ​ຍັງຄ້າງ</th>
                    <th>ວັນ​ທີ​ຈ່າຍ</th>
                </tr>
                <?php
                $i = 0;
                $car_id = 0;
                $totalpaid = 0;
                foreach ($list as $lists) {

                    $totalpaid+=$lists->paid;
                    if ($car_id != $lists->infon_car_id) {
                        $cus = 0;
                    }
                    $cus++;
                    ?>
                    <tr>
                        <td><?= ($i != 0) ? $i : '' ?></td>
                        <td colspan="5">
                            <?php
                            if ($cus == 1) {
                                ?>
                                <?= "ເລກ​ຈັກ " . $lists->infonCar->car_code_1 ?><br/>
                                <?= "ເລກ​ຖັງ " . $lists->infonCar->car_code_2 ?><br/>
                                <?= "ລຸ້ນ " . $lists->infonCar->generation ?><br/>
                                <?= "ຍີ່​ຫໍ້ " . $lists->infonCar->brand ?><br/>
                                <?= "ສີ " . $lists->infonCar->color ?><br/>
                                <?= "ອັດ​ຕາ​ດອກ​ເບ້ຍ " . $lists->interest ?><br/>
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php
                            if ($cus == 1) {
                                $discount = Discount::model()->findByAttributes(array('customer_id' => $lists->customer_id));
                                if (!empty($discount)) {
                                    $discount_amount = $discount->discount;
                                } else {
                                    $discount_amount = 0;
                                }
                                echo number_format($lists->infonCar->car_price_sale, 2);
                                $x = $lists->infonCar->car_price_sale - $discount_amount - $lists->paid;
                                $interest = $lists->interest;
                            } else {
                                echo number_format(floor((($x * $interest) / 100) / 1000) * 1000, 2);
                            }
                            ?></td>
                        <td ><?= number_format($lists->paid, 2) ?></td>
                        <?php
                        if ($i != 0) {
                            ?>
                            <td>
                                <?php
                                $pupmai = PupmaiPaylate::model()->findByAttributes(array('car_sale_id' => $lists->id));
                                if (!empty($pupmai)) {
                                    echo number_format($pupmai->price, 2);
                                }
                                ?>
                            </td>
                            <?php
                        } else {
                            echo"<td></td>";
                        }
                        ?>
                        <td>
                            <?php
                            if ($cus == 1) {

                                $x = $lists->infonCar->car_price_sale - $discount_amount - $lists->paid;
                                $s = ($x * $lists->interest * $lists->count_date_pay) / 100;
                                $tx = floor(($s + $x) / 1000) * 1000;
                                echo number_format($tx, 2);
                                $k = ($x / $lists->count_date_pay) + ($x * $lists->interest) / 100;
                            } else {
                                $lk = $tx - ($lists->paid * ($cus - 1));
                                if ($lists->count_date_pay == 0) {
                                    echo "0.00";
                                } else {
                                    echo number_format(floor($lk / 1000) * 1000, 2);
                                }
                            }
                            ?>

                        </td>
                        <td>
                            <?= date('d/m/Y', strtotime($lists->date)) ?>
                        </td>
                    </tr>
                    <?php
                    if ($cus == 1) {
                        ?>
                        <tr style="background: #FFE495">
                            <th>ງວດ​ຊຳ​ລະ</th>
                            <th colspan="5">
                            </th>
                            <th>ດອກ​ເບ້ຍ​ຈ່າຍ</th>
                            <th>ຈ່າຍ​ແຕ່​ລະ​ງວດ</th>
                            <th>ຄ່າ​ປັບ​ໄໝ​ຊຳ​ລະຊ້າ</th>
                            <th>ຍອດ​ເຫຼື​ອແຕ່​ລະ​ງວດ</th>
                            <th>
                                <?= date('d/m/Y', strtotime($lists->date)) ?>
                            </th>
                        </tr>
                        <?php
                    }
                    ?>
                    <?php
                    if (count(CarSale::model()->findAllByAttributes(array('infon_car_id' => $lists->infon_car_id))) == $cus) {
                        $s = $i;
                        $r = 0;
                        $c = $lists->count_date_pay;
                        for ($a = 1; $a <= $lists->count_date_pay; $a++) {
                            $s++;
                            $r++;
                            ?>
                            <tr>
                                <td style="background: #EFFDFF;" colspan="10"><?= $s ?></td>
                                <td><div align="right" >
                                        <?php
                                        if ($r == $c) {
                                            $lk = $tx - ($lists->paid * ($cus - 1));
                                            $pd = floor($lk / 1000) * 1000;
                                        } else {
                                            $pd = floor($k / 1000) * 1000;
                                        }
                                        if ($r == 1) {
                                            echo CHtml::ajaxLink(
                                                    '<span class="glyphicon glyphicon-modal-window"></span>', // the link body (it will NOT be HTML-encoded.)
                                                    array('infonCar/detailpay', 'sale_id' => $lists->id, 'paid' => $pd), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
                                                    array(
                                                'update' => '#payment1',
                                                    ), array(
                                                'class' => 'btn btn-success'
                                                    )
                                            );
                                            ?>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                    <?php
                    $car_id = $lists->infon_car_id;
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>
</div>