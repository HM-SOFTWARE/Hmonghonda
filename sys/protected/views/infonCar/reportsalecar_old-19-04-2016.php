<div style="height: 800px">
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
        echo $_POST['branch'];
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

    <div style="position: absolute; height: 70%; width: 98%;overflow-x: scroll;overflow-y: hidden; " > 
        <table class="table table-bordered">
            <thead>
                <tr> 
                    <th style="white-space: nowrap;padding-right:12px;"">ວັນ​ທີນຳ​ລົດ​ເຂົ້າ</th>
                    <th style="white-space: nowrap;padding-right:39px;">ວັນ​ທີຂາຍ</th>
                    <th style="white-space: nowrap;padding-right:14px;">ຮູບ​ແບບ​ການ​ຈ່າຍ</th>
                    <th style="white-space: nowrap;padding-right:11px;">​ປະ​ເພດ​ລົດ</th>
                    <th style="white-space: nowrap; padding-right:200px;">​ເລກ​ຈັກ</th>
                    <th style="white-space: nowrap;padding-right:200px;">ເລ​ກ​ຖັງ</th>
                    <th style="white-space: nowrap;padding-right:70px;">ລ​ຸ້ນ​ລົດ</th>
                    <th  style="white-space: nowrap;padding-right:59px;">​ສີ​ລົດ</th>
                    <th style="white-space: nowrap;padding-right:6px;">​ຈນ</th>
                    <th style="white-space: nowrap;padding-right:100px;">ລາ​ຄາ​ລົດ</th>
                    <th style="white-space: nowrap;padding-right:100px;">ສ່ວນຫຼຸດ</th>
                    <th style="white-space: nowrap;padding-right:100px;">ຈ່າຍ​ແລ້ວ</th>
                    <th style="white-space: nowrap;padding-right:100px;">​ຍັງ​ຄ້າງ</th>
                    <th style="white-space: nowrap;padding-right:70px;">ປ້າຍ</th>
                    <th style="white-space: nowrap;padding-right:200px;">ຊື່​ຜູ້​ຂາຍ</th>
                    <th style="white-space: nowrap;padding-right:200px;">ຊື່​ຜູ້​ຊື້</th>
                </tr>
            </thead>

            <tbody style="position:absolute; height: 85%; overflow-x: hidden;overflow-y: scroll; " >
                <tr> 
                    <td style="padding-left:96px;"></td>
                    <td style="padding-left:94px;"></td>
                    <td style="padding-left:110px;"></td>
                    <td style="padding-left:72px;"></td>
                    <td style="padding-left:242px;"></td>
                    <td style="padding-left:242px;"></td>
                    <td style="padding-left:106px;"></td>
                    <td style="padding-left:87px;"></td>
                    <td style="padding-left:7px;"></td>
                    <td style="padding-left:152px;"></td>
                    <td style="padding-left:147px;"></td>
                    <td style="padding-left:152px;"></td>
                    <td style="padding-left:142px;"></td>
                    <td style="padding-left:95px;"></td>
                    <td style="padding-left:245px;"></td>
                    <td style="padding-left:245px;"></td>
                </tr>
                <?php
                if (isset($_POST['search'])) {
                    Yii::app()->session['search'] = true;
                    Yii::app()->session['date_start'] = $_POST['date_start'];
                    Yii::app()->session['date_end'] = $_POST['date_end'];
                    Yii::app()->session['status_sale'] = $_POST['status_sale'];
                    Yii::app()->session['branch'] = $_POST['branch'];
                    if (!empty($_POST['branch'])) {
                        $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
                    } else {
                        $branch = Branch::model()->findAll();
                    }
                    $total_all = 0;
                    $totalpaid_all_all = 0;
                    $totalnot_all_all = 0;
                    $total_allcar = 0;
                    foreach ($branch as $branchs) {
                        $criteria = new CDbCriteria(
                                array(
                            'with' => array(
                                'carSales',
                            ),
                            'together' => true,
                        ));
                        $criteria->addBetweenCondition('date_out', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
                        $criteria->compare('t.branch_id', $branchs->id);
                        if (empty($_POST['status_sale'])) {
                            $criteria->addInCondition('carSales.sale_status_id', array(1, 2));
                        } else {
                            $criteria->compare('carSales.sale_status_id', $_POST['status_sale']);
                        }
                        $criteria->compare('car_or_spare_status_id', 3);
                        $criteria->order = 'date_out ASC';
                        $cars = InfonCar::model()->findAll($criteria);
                        $total = 0;
                        $totalpaid_all = 0;
                        $totalnot_all = 0;
                        $total_car = 0;
                        if (count($cars) > 0) {
                            ?>
                            <tr>
                                <td colspan="16" style="background-color: #FFE495"><b><?= $branchs->branch_name ?></b></td>
                            </tr>
                            <?php
                            foreach ($cars as $car) {
                                $total_car++;
                                $total+=$car->car_price_sale;
                                $carsale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                                ?>
                                <tr>
                                    <td><?= $car->date_in ?></td>
                                    <td style="white-space: nowrap"><?= $car->date_out ?></td>
                                    <td style="white-space: nowrap">
                                        <?php
                                        $status_pay = SaleStatus::model()->findByPk($carsale->sale_status_id);
                                        echo $status_pay->name;
                                        ?>
                                    </td>
                                    <td style="white-space: nowrap"><?= $car->carType->type_name ?></td>
                                    <td style="white-space: nowrap"><?= $car->car_code_1 ?></td>
                                    <td style="white-space: nowrap"><?= $car->car_code_2 ?></td>
                                    <td style="white-space: nowrap"><?= $car->generation ?></td>
                                    <td style="white-space: nowrap"><?= $car->color ?></td>
                                    <td>1</td>
                                    <td style="white-space: nowrap"><?= number_format($car->car_price_sale, 2) ?></td>
                                    <td style="white-space: nowrap">
                                        <?php
                                        $car_sale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                                        $discount = Discount::model()->findByAttributes(array('customer_id' => $car_sale->customer_id));
                                        if (!empty($discount)) {
                                            echo number_format($discount->discount, 2);
                                        }
                                        ?>
                                    </td>
                                    <td style="white-space: nowrap">
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
                                                }
                                                $totalpaid+= $car_sales->paid;
                                                $x = $car->car_price_sale - $car_sales->paid;
                                                $s = ($x * $car_sales->interest * $car_sales->count_date_pay) / 100;
                                                $tx = $s + $x;
                                            } else {
                                                $totalpaid+= $car_sales->paid;
                                                $lk+=$car_sales->paid;
                                            }
                                        }
                                        echo number_format($totalpaid - $discount_price, 2);
                                        $totalpaid_all+=$totalpaid - $discount_price;
                                        ?>
                                    </td>
                                    <td style="white-space: nowrap"><?= number_format(floor(($tx - $lk) / 1000) * 1000, 2); ?></td>
                                    <td style="white-space: nowrap">
                                        <?php
                                        $totalnot_all+=$car->car_price_sale - $totalpaid;
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
                                    <td style="white-space: nowrap">
                                        <?php
                                        $user = User::model()->findByPk($carsale->user_id);
                                        echo $user->first_name . " " . $user->last_name;
                                        ?>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <?php
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
                                <td></td>
                                <td ><b><?= number_format($totalpaid_all, 2) ?></b></td>
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
                            $totalpaid_all_all+= $totalpaid_all;
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
                            <td></td>
                            <td ><b><?= number_format($totalpaid_all_all, 2) ?></b></td>
                            <td ><b><?= number_format($totalnot_all_all, 2) ?></b></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- this code for send to export to pdf -->
    <div style="display: none">
        <table class="table table-bordered " id="pdf_export" >
            <tr> 
                <th style="white-space: nowrap">ວັນ​ທີນຳ​ລົດ​ເຂົ້າ</th>
                <th style="white-space: nowrap">ວັນ​ທີຂາຍ</th>
                <th style="white-space: nowrap">ຮູບ​ແບບ​ການ​ຈ່າຍ</th>
                <th style="white-space: nowrap">​ປະ​ເພດ​ລົດ</th>
                <th style="white-space: nowrap">​ເລກ​ຈັກ</th>
                <th style="white-space: nowrap">ເລ​ກ​ຖັງ</th>
                <th style="white-space: nowrap">ລ​ຸ້ນ​ລົດ</th>
                <th  style="white-space: nowrap">​ສີ​ລົດ</th>
                <th style="white-space: nowrap">​ຈນ</th>
                <th style="white-space: nowrap">ລາ​ຄາ​ລົດ</th>
                <th style="white-space: nowrap">ສ່ວນຫຼຸດ</th>
                <th style="white-space: nowrap">ຈ່າຍ​ແລ້ວ</th>
                <th style="white-space: nowrap">​ຍັງ​ຄ້າງ</th>
                <th style="white-space: nowrap">ປ້າຍ</th>
                <th style="white-space: nowrap">ຊື່​ຜູ້​ຂາຍ</th>
                <th style="white-space: nowrap">ຊື່​ຜູ້​ຊື້</th>
            </tr>
            <?php
            if (isset($_POST['search'])) {
                Yii::app()->session['search'] = true;
                Yii::app()->session['date_start'] = $_POST['date_start'];
                Yii::app()->session['date_end'] = $_POST['date_end'];
                Yii::app()->session['status_sale'] = $_POST['status_sale'];
                Yii::app()->session['branch'] = $_POST['branch'];
                if (!empty($_POST['branch'])) {
                    $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
                } else {
                    $branch = Branch::model()->findAll();
                }
                $total_all = 0;
                $totalpaid_all_all = 0;
                $totalnot_all_all = 0;
                $total_allcar = 0;
                foreach ($branch as $branchs) {
                    $criteria = new CDbCriteria(
                            array(
                        'with' => array(
                            'carSales',
                        ),
                        'together' => true,
                    ));
                    $criteria->addBetweenCondition('date_out', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
                    $criteria->compare('t.branch_id', $branchs->id);
                    if (empty($_POST['status_sale'])) {
                        $criteria->addInCondition('carSales.sale_status_id', array(1, 2));
                    } else {
                        $criteria->compare('carSales.sale_status_id', $_POST['status_sale']);
                    }
                    $criteria->compare('car_or_spare_status_id', 3);
                    $criteria->order = 'date_out ASC';
                    $cars = InfonCar::model()->findAll($criteria);
                    $total = 0;
                    $totalpaid_all = 0;
                    $totalnot_all = 0;
                    $total_car = 0;
                    if (count($cars) > 0) {
                        ?>
                        <tr>
                            <td colspan="15" style="background-color: #FFE495"><b><?= $branchs->branch_name ?></b></td>
                        </tr>
                        <?php
                        foreach ($cars as $car) {
                            $total_car++;
                            $total+=$car->car_price_sale;
                            $carsale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                            ?>
                            <tr>
                                <td style="white-space: nowrap"><?= $car->date_in ?></td>
                                <td style="white-space: nowrap"><?= $car->date_out ?></td>
                                <td style="white-space: nowrap">
                                    <?php
                                    $status_pay = SaleStatus::model()->findByPk($carsale->sale_status_id);
                                    echo $status_pay->name;
                                    ?>
                                </td>
                                <td style="white-space: nowrap"><?= $car->carType->type_name ?></td>
                                <td style="white-space: nowrap"><?= $car->car_code_1 ?></td>
                                <td style="white-space: nowrap"><?= $car->car_code_2 ?></td>
                                <td style="white-space: nowrap"><?= $car->generation ?></td>
                                <td style="white-space: nowrap"><?= $car->color ?></td>
                                <td>1</td>
                                <td style="white-space: nowrap"><?= number_format($car->car_price_sale, 2) ?></td>
                                <td style="white-space: nowrap">
                                    <?php
                                    $car_sale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                                    $discount = Discount::model()->findByAttributes(array('customer_id' => $car_sale->customer_id));
                                    if (!empty($discount)) {
                                        echo number_format($discount->discount, 2);
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap">
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
                                            }
                                            $totalpaid+= $car_sales->paid;
                                            $x = $car->car_price_sale - $car_sales->paid;
                                            $s = ($x * $car_sales->interest * $car_sales->count_date_pay) / 100;
                                            $tx = $s + $x;
                                        } else {
                                            $totalpaid+= $car_sales->paid;
                                            $lk+=$car_sales->paid;
                                        }
                                    }
                                    echo number_format($totalpaid - $discount_price, 2);
                                    $totalpaid_all+=$totalpaid - $discount_price;
                                    ?>
                                </td>
                                <td style="white-space: nowrap"><?= number_format(floor(($tx - $lk) / 1000) * 1000, 2); ?></td>
                                <td style="white-space: nowrap">
                                    <?php
                                    $totalnot_all+=$car->car_price_sale - $totalpaid;
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
                                <td style="white-space: nowrap">
                                    <?php
                                    $user = User::model()->findByPk($carsale->user_id);
                                    echo $user->first_name . " " . $user->last_name;
                                    ?>
                                </td>
                                <td style="white-space: nowrap">
                                    <?php
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
                            <td></td>
                            <td ><b><?= number_format($totalpaid_all, 2) ?></b></td>
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
                        $totalpaid_all_all+= $totalpaid_all;
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
                        <td></td>
                        <td ><b><?= number_format($totalpaid_all_all, 2) ?></b></td>
                        <td ><b><?= number_format($totalnot_all_all, 2) ?></b></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
    <!-- End coding send export to PDF -->
    <div id="data"></div>
    <?php ?>
</div>