<script>
    function printDiv(divName) {
//        var printContents = document.getElementById(divName).innerHTML;
//        var originalContents = document.body.innerHTML;
//        document.body.innerHTML = printContents;
//        window.print();
//        document.body.innerHTML = originalContents;
        var html = "<html moznomarginboxes mozdisallowselectionprint>";
        html += "<style type='text/css' media='print'> @page{margin:0;} body{margin:2.0cm;}</style> "
        html += document.getElementById(divName).innerHTML;
        html += "</html>";
        var printWin = window.open();
        printWin.document.write(html);
        printWin.document.close();
        printWin.focus();
        printWin.print();
        printWin.close();
    }
</script>
<div align="right"><button type="button" onclick="printDiv('printableArea')" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> ພີມ​ອອກ</button></div>
<div id="printableArea">
    <table  class="table table-striped" style="font-family:'Saysettha OT' ;font-size: 12px; width: 100%">
        <tr>
            <td colspan="2" align='center' >
                ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ<br/>
                ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ<br/><br/>

                <span style="font-size: 24px;"> <b>ໃບ​ຮັບ​ເງີນ</b></span></td>
        </tr>
        <td style="width: 70%">
            <?php
            if (isset(Yii::app()->session['admin_sale_branch'])) {
                $branch = Branch::model()->findByPk(Yii::app()->session['admin_sale_branch']);
            } else {
                $branch = Branch::model()->findByPk(User::model()->findByPk(Yii::app()->user->id)->branch->id);
            }
            ?>
            <table style="font-family:'Saysettha OT' ;font-size: 12px;">
                <tr>
                    <td>ສາ​ຂາ </td>
                    <td>: <?= $branch->branch_name ?></td>
                </tr>
                <tr>
                    <td>ບ້ານ</td>
                    <td>: <?= $branch->address ?></td>
                </tr>
                <tr>
                    <td>ເມືອງ</td>
                    <td>: <?= $branch->district->district_name ?></td>
                </tr>
                <tr>
                    <td>ແຂວງ</td>
                    <td>: <?= $branch->province->province_name ?></td>
                </tr>
                <tr>
                    <td>ໂທ​ຣ​ລ​ະ​ສັບ</td>
                    <td>: <?= $branch->mobile ?></td>
                </tr>
                <tr>
                    <td>ແຟກ</td>
                    <td>: <?= $branch->tel ?></td>
                </tr>
                <tr>
                    <td>ຊື່​ຜູ້​ຂາຍ</td>
                    <td>: 
                        <?php
                        $user = User::model()->findByPk(Yii::app()->user->id);
                        echo $user->first_name . " " . $user->last_name;
                        ?>
                    </td>
                </tr>

            </table>
        </td>
        <td>
            <span style="font-size: 14px;"><b>No. <?= sprintf('%06d', $cus_id) ?></b></span><br/>
            <?php
            $cus = Customer::model()->findByPk($cus_id);
            ?>
            ຊື່​ແລະ​ນາມ​ສະ​ກຸນ: <?= $cus->first_name . ' ' . $cus->last_name ?><br/>
            ບ້ານ: <?= $cus->address ?><br/>
            ເມືອງ: <?= $cus->district->district_name ?><br/>
            ແຂວງ: <?= $cus->province->province_name ?><br/>
            ໂທ​ຣ​ລ​ະ​ສັບ: <?= $cus->phone_1 . ',' . $cus->phone_2 ?><br/>
            ວັນ​ທີ: <?= date('d/m/Y') ?>


        </td>
        </tr>
    </table>
    <table  border="1" cellpadding="5" class="table table-bordered" style="font-family:'Saysettha OT' ;font-size: 12px;border-collapse:collapse; width: 100%">
        <tr>
            <th colspan="7">ລາຍ​ລະ​ອຽດ</th>
            <th>ຈ/ນ</th>
            <th>ລາ​ຄາ/ກີບ</th>
            <?php
            $sale_check_doa_or_full = CarSale::model()->findByAttributes(array('customer_id' => $cus_id));

            if ($sale_check_doa_or_full->sale_status_id == 1) {
                ?>
                <th>ຈຳ​ນວນ​ເງີນ​ຈ່າຍ</th>
                <?php
            } else {
                ?>
                <th>ຈຳ​ນວນ​ເງີນ​ຈ່າຍກ່ອນ</th>
                <?php
            }
            ?>
            <?php
            if ($sale_check_doa_or_full->sale_status_id != 1) {
                ?>
                <th>ຍັງ​ຄ້າງທັງຫ​ໝົດ</th>
                <th>ເຊັນຜູ້​ຮັບ​ເງີນ</th>
                <th>ເຊັນຜູ້​ຈ່າຍເງີນ</th>
                <?php
            }
            ?>
        </tr>
        <?php
        $criteria = new CDbCriteria;
        $criteria->compare('customer_id', $cus_id);
        $criteria->order = 'id DESC';
        $sale_list = CarSale::model()->findAll($criteria);
        $i = 0;
        $all_paid = 0;
        foreach ($sale_list as $sale_lists) {
            $info_car = InfonCar::model()->findByPk($sale_lists->infon_car_id);
            $all_paid+=$sale_lists->paid;
            $i++;
            ?>
            <tr>
                <td colspan="7" style="width: 400px;">
                    <table style="font-family:'Saysettha OT' ;font-size: 12px; border: 0px;">
                        <tr>
                            <td style="white-space: nowrap">ເລກ​ຈັກ</td>
                            <td style="white-space: nowrap">: <?= $info_car->car_code_1 ?></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap">ເລກ​ຖັງ</td>
                            <td style="white-space: nowrap">: <?= $info_car->car_code_2 ?></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap">ລຸ້ນ​ລົດ</td>
                            <td style="white-space: nowrap">: <?= $info_car->generation ?></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap">ຍີ່​ຫໍ​່</td>
                            <td style="white-space: nowrap">: <?= $info_car->brand ?></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap">ສີ</td>
                            <td style="white-space: nowrap">: <?= $info_car->color ?></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap">ສະ​ຖາ​ນະ</td>
                            <td style="white-space: nowrap">: <?= $sale_lists->saleStatus->name ?></td>
                        </tr>
                        <?php
                        if ($sale_lists->sale_status_id == 2) {
                            ?>
                            <tr>
                                <td style="white-space: nowrap">ອັດ​ຕາດອກ​ເບ້ຍ</td>
                                <td style="white-space: nowrap">: 
                                    <?= $sale_lists->interest ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="white-space: nowrap">ໄລ​ຍະ​ຜ່ອນ​</td>
                                <td style="white-space: nowrap">: 
                                    <?= $sale_lists->count_date_pay ?> ເດືອນ
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                    <?php
                    $customer_checkmultioder = CarSale::model()->findAllByAttributes(array('customer_id' => $sale_lists->customer_id));
                    if ($i == count($customer_checkmultioder)) {
                        $giveaway = Giveaway::model()->findByAttributes(array('customer_id' => $sale_lists->customer_id));
                        if (!empty($giveaway)) {
                            ?>
                            <hr/>
                            <b>ຂອງ​ແຖມ</b><br/>
                            <?= nl2br($giveaway->giveaway) ?>
                            <?php
                        }
                    }
                    ?>
                </td>
                <td>1</td>
                <td style="width: 100px;" valign='top'><?php
                    echo number_format($info_car->car_price_sale, 2);
                    ?>
                </td>
                <td style="width: 200px;" valign='top'>
                    <?= number_format($sale_lists->paid, 2) ?><br/>
                </td>
                <?php
                if ($sale_check_doa_or_full->sale_status_id != 1) { /// come in only dao
                    ?>
                    <td style="width: 100px;" valign='top'>
                        <?php
                        $discount = Discount::model()->findByAttributes(array('customer_id' => $sale_lists->customer_id));
                        if (!empty($discount)) {
                            $discount_amount = $discount->discount;
                        } else {
                            $discount_amount = 0;
                        }
                        $x = $info_car->car_price_sale - $discount_amount - $sale_lists->paid;
                        $s = ($x * $sale_lists->interest * $sale_lists->count_date_pay) / 100;
                        $tx = $s + $x;
                        echo number_format(floor($tx / 1000) * 1000, 2);
                        ?>
                    </td>
                    <td style="width: 100px;"></td>
                    <td style="width: 100px;"></td>
                    <?php
                }
                ?>
            </tr>
            <?php
            if ($i == count($customer_checkmultioder)) {
                ?>
                <tr>
                    <td colspan="7"></td>
                    <td><?= $i ?></td>
                    <td>ລວມ​ເງີນ​ທັງ​ໜົດ</td>
                    <td><?= number_format($all_paid, 2) ?></td>
                </tr>

                <tr>
                    <td colspan="9" align="right">ສ່ວນຫຼຸດຕໍໍ່​ຈ​/ນ</td>
                    <td>
                        <?php
                        $total_discount = 0;
                        $discount = Discount::model()->findByAttributes(array('customer_id' => $sale_lists->customer_id));
                        if (!empty($discount)) {
                            $total_discount = $discount->discount;
                            echo number_format($discount->discount, 2);
                        } else {
                            $total_discount = 0;
                            echo "0.0";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="9"  align="right">ຈ່າຍ</td>
                    <td>
                        <?php
                        if ($sale_check_doa_or_full->sale_status_id == 1) {
                            echo number_format($all_paid - ($total_discount * $i), 2);
                        } else {
                            echo number_format($all_paid, 2);
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if ($sale_check_doa_or_full->sale_status_id == 1) {
                    ?>
                    <tr>
                        <td colspan="5"  align="left"><u><b>ເຊັນ​ຜູ້​ຊື້</b></u><br><br><br><br><br><br></td>
                    <td colspan="5" align="right"><u><b>ເຊັນ​ຜູ້​ຂາຍ</b></u></td>
                    </tr>
                    <?php
                }
                ?>
                <?php
            }
            ?>

            <?php
            if ($sale_lists->count_date_pay != 0) {
                if ($sale_lists->customer->date == date('Y-m-d')) {

                    $check_listpay = DeptsMonthPay::model()->findByAttributes(array('customer_id' => $cus_id, 'date_pay' => date('Y-m-d')));
                    if (empty($check_listpay)) {
                        $depts_pay = new DeptsMonthPay();
                        $depts_pay->status = 1;
                        $depts_pay->first_pay = 'Y';
                        $depts_pay->customer_id = $cus_id;
                        $depts_pay->infon_car_id = $sale_lists->infon_car_id;
                        $depts_pay->paid = $sale_lists->paid;
                        $depts_pay->date_pay = date('Y-m-d');
                        $depts_pay->save();
                    }
                }
                ?>
                <tr style="background-color: #FFE495">
                    <th>ງວດ​ຊຳ​ລະ</th>
                    <th colspan="6">ວັນ​ທີ​ຊຳ​ລະ</th>
                    <th colspan="2">ດອກ​ເບ້ຍຈ່າຍ​</th>
                    <th>ຈ່າຍ​ແຕ່​ລະ​ງວດ</th>
                    <th>ຍອດ​ເຫຼືອ​ແຕ່​ລະ​ງວດ</th>
                    <td></td>
                    <td></td>
                </tr>
                <?php
            }
            $s = 0;
            $c = $sale_lists->count_date_pay;
            $pc = 0;
            for ($a = 1; $a <= $sale_lists->count_date_pay; $a++) {
                $s++;
                ?>
                <tr>
                    <td><?= $s ?></td>
                    <td colspan="6">
                        <?php
                        $time = strtotime(date('Y-m-d'));
                        $final = date("d/m/Y", strtotime("+$s month", $time));
                        echo $final;
                        ?>
                    </td>
                    <td colspan="2"><?= number_format(floor((($x * $sale_lists->interest) / 100) / 1000) * 1000, 2) ?></td>
                    <td style="background-color: #FFE0E1">
                        <?php
                        $k = ($x / $sale_lists->count_date_pay) + ($x * $sale_lists->interest) / 100;
                        $pc+= floor($k / 1000) * 1000;
                        if ($c == $a) {
                            $pcd = $tx - $pc;
                            $dept_pay = floor(($k + $pcd) / 1000) * 1000;
                            echo number_format(floor(($k + $pcd) / 1000) * 1000, 2);
                        } else {
                            $dept_pay = floor($k / 1000) * 1000;
                            echo number_format(floor($k / 1000) * 1000, 2);
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($c - 1 == $a) {
                            $dpc = $tx - $pc;
                            echo number_format(floor($dpc / 1000) * 1000, 2);
                        } else {
                            $lk = ($tx) - (($x / $sale_lists->count_date_pay) + ($x * $sale_lists->interest) / 100) * $s;
                            echo number_format(floor($lk / 1000) * 1000, 2);
                        }
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                $time1 = strtotime(date('Y-m-d'));
                $time1 = strtotime(date('Y-m-d'));

                $final1_min = date("d", strtotime("+$s month", $time1));
                $final1_max = date("t", strtotime("+$s month", $time1));
                if ($final1_min > $final1_max) {
                    $final1 = date("Y-m-t", strtotime("+$s month", $time1));
                } else {
                    $final1 = date("Y-m-d", strtotime("+$s month", $time1));
                }
                if ($sale_lists->customer->date == date('Y-m-d')) {
                    $check_listpay = DeptsMonthPay::model()->findByAttributes(array('customer_id' => $cus_id, 'date_pay' => $final1));
                    if (empty($check_listpay)) {
                        $depts_pay = new DeptsMonthPay();
                        $depts_pay->status = 0;
                        $depts_pay->customer_id = $cus_id;
                        $depts_pay->infon_car_id = $sale_lists->infon_car_id;
                        $depts_pay->paid = $dept_pay;
                        $depts_pay->date_pay = $final1;
                        $depts_pay->save();
                    }
                }
            }
        }
        ?>
    </table>
</div>