<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'infon-car-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
if (!isset($_POST['branch']) && !empty(Yii::app()->session['search'])) {
    $_POST['search'] = Yii::app()->session['search'];
    $_POST['date_start'] = Yii::app()->session['date_start'];
    $_POST['date_end'] = Yii::app()->session['date_end'];
    $_POST['status_sale'] = Yii::app()->session['status_sale'];
    $_POST['branch'] = Yii::app()->session['branch'];
    $_POST['code_car1'] = Yii::app()->session['code_car1'];
    $_POST['generation'] = Yii::app()->session['generation'];
}
?>
<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ລົດ​ທີ່​ຂ​າຍແລ້ວ</h1></div>
&nbsp;
<div class="row" >
    <div class="col-md-5">
        ຈາກວັນ​ທີ: <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'date_start',
            'value' => isset($_POST['date_start']) ? $_POST['date_start'] : '',
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => '2000:2099',
                'minDate' => '2000-01-01', // minimum date
                'maxDate' => '2099-12-31', // maximum date
            ),
            'htmlOptions' => array(
                'style' => ''
            ),
        ));
        ?>
        ຫາ <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'date_end',
            'value' => isset($_POST['date_end']) ? $_POST['date_end'] : '',
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => '2000:2099',
                'minDate' => '2000-01-01', // minimum date
                'maxDate' => '2099-12-31', // maximum date
            ),
            'htmlOptions' => array(
                'style' => ''
            ),
        ));
        ?>
    </div>
</div>
<div class="row" style="padding-top: 5px;">
    <div class="col-md-6">
        ເລກ​ຈັກ: &nbsp; <input type="text" name="code_car1" value="<?= isset($_POST['code_car1']) ? $_POST['code_car1'] : "" ?>">
        ລຸ້ນລົດ: <input type="text" name="generation" value="<?= isset($_POST['generation']) ? $_POST['generation'] : "" ?>">
    </div>
</div>
<div class="row" style="padding-top: 5px;">
    <div class="col-md-6">
        ເລືອກ​ສາ​ຂາ <select name="branch" >
            <?php
            if (Yii::app()->user->checkAccess('Admin')) {
                $data = Branch::model()->findAll();
                echo '<option value>ທັງ​ໝົດ</option>';
            } else {
                $user = User::model()->findByPk(Yii::app()->user->id);
                $data = Branch::model()->findAll('id=' . $user->branch_id . '');
            }
            foreach ($data as $branchs) {
                ?>
                <option value="<?= $branchs->id ?>" <?= (isset($_POST['branch']) && $_POST['branch'] == $branchs->id) ? "selected" : "" ?>><?= $branchs->branch_name ?></option>
                <?php
            }
            ?>
        </select>
        &nbsp; ສະ​ຖານ​ນະ​ການ​ຊື້: 
        <select name="status_sale" >
            <option value>ທັງ​ໝົດ</option>
            <?php
            $status = SaleStatus::model()->findAll('id<4');
            foreach ($status as $statuss) {
                ?>
                <option value="<?= $statuss->id ?>" <?= (isset($_POST['status_sale']) && $_POST['status_sale'] == $statuss->id) ? "selected" : "" ?>><?= $statuss->name ?></option>
                <?php
            }
            ?>
        </select>
    </div>

</div>
<div class="row" style="padding-top: 10px">
    <div class="col-lg-offset-3">
        <button type="submit" name="search" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> ເບີ່ງ​ລາຍງານ</button>
    </div>
</div>
<br/>
<br/>
<?php $this->endWidget(); ?>
<div align="right" >

    <script>
        function getHtmlData()
        {
            $("#print_pdf").val('<table border="1" cellspacing="0" cellpadding="5" style="font-size:5px;">' + $("#pdf_export").clone().html() + '</table>');
            return true;
        }
    </script>

    <form method="post" action="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/ExportPdf&care=<?= @$_POST['status_sale'] ?>" onSubmit="javascript:return getHtmlData()">
        <input type="hidden" id="print_pdf" name="pdf" value="">  
        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-export"></span>ລາຍ​ງານ​ເປັນ PDF</button>
    </form>
</div>
<script>
    $(function () {
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]',
            container: 'body'
        });
    })
</script>
<div class="table-responsive" >
    <table class="table table-bordered " id="pdf_export"  >

        <thead>
            <tr> 
                <th style="white-space: nowrap">ວັນ​ທີນຳ​ລົດ​ເຂົ້າ</th>
                <th style="white-space: nowrap">ວັນ​ທີຂາຍ</th>
                <th style="white-space: nowrap">ຮູບ​ແບບ​ການ​ຈ່າຍ</th>
                <th style="white-space: nowrap">​ປະ​ເພດ​ລົດ</th>
                <th style="white-space: nowrap">​ເລກ​ຈັກ</th>
                <th style="white-space: nowrap">ເລ​ກ​ຖັງ</th>
                <th style="white-space: nowrap">ລ​ຸ້ນ​ລົດ</th>
                <th  style="white-space: nowrap">​ສີ​ລົດ</th>
                <th style="white-space: nowrap" align="center">​ຈນ</th>
                <th style="white-space: nowrap">ລາ​ຄາ​ລົດ</th>
                <th style="white-space: nowrap">ສ່ວນຫຼຸດ</th>
                <th style="white-space: nowrap">ລາ​ຄາ​ທີ​ຍັງ​ເຫຼືອ</th>
                <th style="white-space: nowrap">ຈ່າຍກ່ອນ</th>
                <th style="white-space: nowrap">ຈ່າຍ​ແລ້ວ</th>
                <th style="white-space: nowrap">ວັນ​ທີ່​ຊຳ​ລະລ່າສຸດ</th>
                <th style="white-space: nowrap">​ຍັງ​ຄ້າງ</th>
                <th style="white-space: nowrap">ປ້າຍ</th>
                <th style="white-space: nowrap">ຊື່​ຜູ້​ຂາຍ</th>
                <th style="white-space: nowrap">ຊື່​ຜູ້​ຊື້</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['search'])) {
                Yii::app()->session['search'] = true;
                Yii::app()->session['date_start'] = $_POST['date_start'];
                Yii::app()->session['date_end'] = $_POST['date_end'];
                Yii::app()->session['status_sale'] = $_POST['status_sale'];
                Yii::app()->session['branch'] = $_POST['branch'];
                Yii::app()->session['code_car1'] = $_POST['code_car1'];
                Yii::app()->session['generation'] = $_POST['generation'];
                if (!empty($_POST['branch'])) {
                    $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
                } else {
                    $branch = Branch::model()->findAll();
                }
                $total_all = 0;
                $totalpaid_all_all = 0;
                $totalnot_all_all = 0;
                $total_allcar = 0;
                $total_bpay_all = 0;
                $total_ad_all = 0;
                $total_d_all = 0;
                foreach ($branch as $branchs) {
                    $criteria = new CDbCriteria(
                            array(
                        'with' => array(
                            'carSales',
                        ),
                        'together' => true,
                    ));
                    if (empty($_POST['code_car1'])) {
                        $criteria->addBetweenCondition('date_out', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
                    }
                    $criteria->compare('t.branch_id', $branchs->id);
                    if (empty($_POST['status_sale'])) {
                        $criteria->addInCondition('carSales.sale_status_id', array(1, 2));
                    } else {
                        $criteria->compare('carSales.sale_status_id', $_POST['status_sale']);
                    }
                    $criteria->compare('car_code_1', $_POST['code_car1']);
                    $criteria->compare('generation', $_POST['generation'], true);
                    $criteria->compare('car_or_spare_status_id', 3);
                    $criteria->order = 'date_out ASC';
                    $cars = InfonCar::model()->findAll($criteria);
                    $total = 0;
                    $totalpaid_all = 0;
                    $totalnot_all = 0;
                    $total_car = 0;
                    $total_bpay = 0;
                    $total_ad = 0;
                    $total_d = 0;
                    if (count($cars) > 0) {
                        ?>
                        <tr>
                            <td colspan="18" style="background-color: #FFE495"><b><?= $branchs->branch_name ?></b></td>
                        </tr>
                        <?php
                        foreach ($cars as $car) {
                            $total_car++;

                            $carsale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                            ?>
                            <tr>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ວັນ​ທີນຳ​ລົດ​ເຂົ້າ"><?= $car->date_in ?></td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ວັນ​ທີຂາຍ"><?= $car->date_out ?></td>
                                <td style="white-space: nowrap;" data-toggle="tooltip" title="ຮູບ​ແບບ​ການ​ຈ່າຍ">
                                    <?php
                                    $status_pay = SaleStatus::model()->findByPk($carsale->sale_status_id);
                                    echo $status_pay->name;
                                    ?>
                                </td>
                                <td style="white-space: nowrap;" data-toggle="tooltip" title="​ປະ​ເພດ​ລົດ"><?= $car->carType->type_name ?></td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="​ເລກ​ຈັກ"><?= $car->car_code_1 ?></td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ເລ​ກ​ຖັງ"><?= $car->car_code_2 ?></td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ລ​ຸ້ນ​ລົດ"><?= $car->generation ?></td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="​ສີ​ລົດ"><?= $car->color ?></td>
                                <td style="width: 50px;" data-toggle="tooltip" title="​ຈຳ​ນວນ">1</td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ລາ​ຄາ​ລົດ">
                                    <?php
                                    $car_sale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                                    $discount = Discount::model()->findByAttributes(array('customer_id' => $car_sale->customer_id));
                                    if (!empty($discount)) {
                                        $discount_amount = $discount->discount;
                                    } else {
                                        $discount_amount = 0;
                                    }
                                    $x = $car->car_price_sale - $discount_amount - $car_sale->paid;
                                    $s = ($x * $car_sale->interest * $car_sale->count_date_pay) / 100;
                                    echo number_format($car->car_price_sale + $s, 2);
                                    $total+=$car->car_price_sale + $s;
                                    ?>
                                </td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ສ່ວນຫຼຸດ">
                                    <?php
                                    $car_sale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                                    $discount = Discount::model()->findByAttributes(array('customer_id' => $car_sale->customer_id));
                                    if (!empty($discount)) {
                                        echo number_format($discount->discount, 2);
                                        $total_d+=$discount->discount;
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ລາ​ຄາ​ລົດ​ທີ​ຍັງ​ເຫຼືອ">
                                    <?php
                                    if (!empty($discount)) {
                                        echo number_format(($car->car_price_sale + $s) - $discount->discount, 2);
                                        $total_ad+= ($car->car_price_sale + $s) - $discount->discount;
                                    } else {
                                        echo number_format(($car->car_price_sale + $s), 2);

                                        $total_ad+= $car->car_price_sale + $s;
                                    }
                                    ?>
                                </td>
                                <td data-toggle="tooltip" title="ຈ່າຍກ່ອນ">
                                    <?php
                                    $car_sale_min = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id), array('order' => 'id ASC'));
                                    if ($car_sale_min->sale_status_id == 2) {
                                        echo number_format($car_sale_min->paid, 2);
                                        $total_bpay+=$car_sale_min->paid;
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ຈ່າຍ​ແລ້ວ">
                                    <?php
                                    $totalpaid = 0;
                                    $lk = 0;
                                    $car_sale = CarSale::model()->findAllByAttributes(array('infon_car_id' => $car->id));

                                    $q = 0;
                                    $discount_price = 0;
                                    foreach ($car_sale as $car_sales) {
                                        $q++;
                                        if ($q == 1) {
                                            $discount = Discount::model()->findByAttributes(array('customer_id' => $car_sales->customer_id));
                                            if (!empty($discount)) {
                                                $discount_price = $discount->discount;
                                            } else {
                                                $discount_price = 0;
                                            }
                                            $totalpaid+= $car_sales->paid;
                                            $x = $car->car_price_sale - $discount_price - $car_sales->paid;
                                            $s = ($x * $car_sales->interest * $car_sales->count_date_pay) / 100;
                                            $tx = $s + $x;
                                        } else {
                                            $totalpaid+= $car_sales->paid;
                                            $lk+=$car_sales->paid;
                                        }
                                    }
                                    if ($car_sale_min->sale_status_id == 2) {
                                        $sume = $totalpaid - $car_sale_min->paid;
                                    } else {
                                        $sume = $totalpaid - $discount_price;
                                    }
                                    if ($car_sale_min->sale_status_id == 2) {
                                        echo number_format($sume, 2);
                                        $totalpaid_all+=$sume;
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ວັນ​ທີ່​ຊຳ​ລະລ່າສຸດ">
                                    <?php
                                    $car_sale_minpaid = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id, 'sale_status_id' => 2), array('order' => 'id ASC'));
                                    $car_sale_maxpaid = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id, 'sale_status_id' => 2), array('order' => 'id DESC'));
                                    if (!empty($car_sale_minpaid)) {
                                        if ($car_sale_minpaid->id != $car_sale_maxpaid->id) {
                                            echo $car_sale_maxpaid->date;
                                        }
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="​ຍັງ​ຄ້າງ">
                                    <?php
                                    if ($car_sale_min->sale_status_id == 2) {
                                        echo number_format(floor(($tx - $lk) / 1000) * 1000, 2);
                                        $totalnot_all+=$tx - $lk;
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ປ້າຍ">
                                    <?php
                                    $customer = Customer::model()->findByPk($carsale->customer_id);
                                    $runpai = Placard::model()->findByAttributes(array('infon_car_id' => $car->id));
                                    if (!empty($runpai)) {
                                        if (Yii::app()->user->checkAccess('Admin')) {
                                            echo CHtml::ajaxLink('ພ້ອມ​ປ້າຍ', array('infonCar/painornot', 'id' => $car->id, 'cus_id' => $customer->id), array('update' => '#data'));
                                        } else {
                                            echo "ພ້ອມ​ປ້າຍ";
                                        }
                                    } else {
                                        if (Yii::app()->user->checkAccess('Admin')) {
                                            echo CHtml::ajaxLink('ແລ່ນ​ເອງ', array('infonCar/painornot', 'id' => $car->id, 'cus_id' => $customer->id), array('update' => '#data'));
                                        } else {
                                            echo "ແລ່ນ​ເອງ";
                                        }
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap" data-toggle="tooltip" title="ຊື່​ຜູ້​ຂາຍ">
                                    <?php
                                    $user = User::model()->findByPk($carsale->user_id);
                                    echo $user->first_name . " " . $user->last_name;
                                    ?>
                                </td>
                                <td style="white-space: nowrap;" data-toggle="tooltip" title="ຊື່​ຜູ້​ຊື້">
                                    <?php
                                    if ($carsale->infonCar->duc_com == 1) {
                                        echo "<span style='color:forestgreen'><b>ເອ​ກະ​ສານ​ລົດ: ມາ​ແລ້ວ</b></span><br/>";
                                    } else {
                                        echo "<span style='color:red'><b>ເອ​ກະ​ສານ​ລົດ: ຍັງ​ບໍ່​ທັນມາ​</b></span> ";
                                        echo InfonCar::checkdsaled($carsale->infonCar->duc_com, $carsale->infonCar->id);
                                        echo"<br/>";
                                    }

                                    $customer = Customer::model()->findByPk($carsale->customer_id);
                                    if ($status_pay->id == 2) {
                                        echo"ລະ​ຫັດ:" . sprintf('%06d', $customer->id) . "<br/>";
                                    }
                                    echo CHtml::ajaxLink($customer->first_name . " " . $customer->last_name, array('infonCar/viewcus', 'id' => $customer->id), array('update' => '#data'));
                                    // echo $customer->first_name . " " . $customer->last_name;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="8" align="right"><b>ລວມ​ຈຳ​ນວນ​ເງີນ</b></td>
                            <td><?= $total_car ?></td>
                            <td ><b><?= number_format($total, 2) ?></b></td>
                            <td><b><?= number_format($total_d, 2) ?></b></td>
                            <td><b><?= number_format($total_ad, 2) ?></b></td>
                            <td><b><?= number_format($total_bpay, 2) ?></b></td>
                            <td ><b><?= number_format($totalpaid_all, 2) ?></b></td>
                            <td></td>
                            <td colspan="4"><b><?php
                                    if ($totalnot_all > 0) {
                                        echo number_format($totalnot_all, 2);
                                    } else {
                                        echo "0.00";
                                    }
                                    ?></b></td>
                        </tr>
                        <?php
                        $total_allcar+=$total_car;
                        $total_all+=$total;
                        $total_d_all+=$total_d;
                        $total_ad_all+=$total_ad;
                        $totalpaid_all_all+= $totalpaid_all;
                        if ($total_bpay > 0) {
                            $total_bpay_all+=$total_bpay;
                        }
                        if ($totalnot_all > 0) {
                            $totalnot_all_all+= $totalnot_all;
                        }
                    }
                }
                if (empty($_POST['branch'])) {
                    ?>
                    <tr>
                        <td colspan="8" align="right"><b>ລວມ​ຈຳ​ນວນ​ເງີນທັງ​ໝົດ</b></td>
                        <td><?= $total_allcar ?></td>
                        <td ><b><?= number_format($total_all, 2) ?></b></td>
                        <td><b><?= number_format($total_d_all, 2) ?></b></td>
                        <td><b><?= number_format($total_ad_all, 2) ?></b></td>
                        <td><b><?= number_format($total_bpay_all, 2) ?></b></td>
                        <td ><b><?= number_format($totalpaid_all_all, 2) ?></b></td>
                        <td colspan="4"><b><?= number_format($totalnot_all_all, 2) ?></b></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<div id="data"></div>