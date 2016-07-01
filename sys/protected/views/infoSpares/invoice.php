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
    <table class="table table-striped" style="font-family:'Saysettha OT' ;font-size: 12px; width: 100%">
        <tr>
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
            <span style="font-size: 18px;"><b>No. <?= sprintf('%06d', $cus_id) ?></b></span><br/>
            <?php
            $cus = Customer::model()->findByPk($cus_id);
            ?>
            <?php
            if (Yii::app()->session['pstatus_sale'] == 4) {
                ?>
                ສົ່ງ​ຫາ​ສາຂາ: <?= $cus->first_name . ' ' . $cus->last_name ?><br/>
                ບ້ານ: <?= $cus->address ?><br/>
                ເມືອງ: <?= $cus->district->district_name ?><br/>
                ແຂວງ: <?= $cus->province->province_name ?><br/>
                ໂທ​ຣ​ລ​ະ​ສັບ: <?= $cus->phone_1 . ',' . $cus->phone_2 ?><br/>
                ວັນ​ທີ: <?= date('d/m/Y') ?>
                <?php
            } else {
                ?>
                ຊື່​ແລະ​ນາມ​ສະ​ກຸນ: <?= $cus->first_name . ' ' . $cus->last_name ?><br/>
                ບ້ານ: <?= $cus->address ?><br/>
                ເມືອງ: <?= $cus->district->district_name ?><br/>
                ແຂວງ: <?= $cus->province->province_name ?><br/>
                ໂທ​ຣ​ລ​ະ​ສັບ: <?= $cus->phone_1 . ',' . $cus->phone_2 ?><br/>
                ວັນ​ທີ: <?= date('d/m/Y') ?>
                <?php
            }
            ?>

        </td>
        </tr>
    </table>
    <table  border="1" cellpadding="5" class="table table-bordered" style="font-family:'Saysettha OT' ;font-size: 12px;border-collapse:collapse; width: 100%; ">
        <tr>
            <th style="width: 50px;">ລຳ​ດັບ</th>
            <th>ຊື່​ອາໄຫຼ່</th>
            <th style="width: 100px;">​ລາ​ຄາ</th>
            <th style="width: 70px;">​ຈຳ​ນວນ</th>
            <th style="width: 100px;">​ລ​າຄາ​ລວມ</th>
        </tr>
        <?php
        $criteria = new CDbCriteria;
        $criteria->compare('customer_id', $cus_id);
        $criteria->order = 'id ASC';
        $sale_list = SaleSpares::model()->findAll($criteria);
        $i = 0;
        $all_paid = 0;
        foreach ($sale_list as $sale_lists) {
            $info_spares = InfoSpares::model()->findByPk($sale_lists->info_spares_id);
            $all_paid+=$sale_lists->paid;
            $i++;
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $info_spares->spare_name ?></td>
                <td><?= number_format($sale_lists->price_buy, 2) ?></td>
                <td><?= $sale_lists->qautity ?></td>
                <td><?= number_format($sale_lists->paid, 2) ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="4" align="right"><b>ລວມ​ຈຳ​ນວນ​ເງີນ​</b></td>
            <td><b><?= number_format($all_paid, 2) ?></b></td>
        </tr>
        <tr>
            <td colspan="4" align="right"><b>ສ່ວນຫຼຸດ</b></td>
            <td><b>
                    <?php
                    $discount_p = 0;
                    $discount = Discount::model()->findByAttributes(array('customer_id' => $sale_lists->customer_id));
                    if (!empty($discount)) {
                        $discount_p = $discount->discount;
                        echo number_format($discount->discount, 2);
                    }
                    ?>
                </b></td>
        </tr>
        <tr>
            <td colspan="4" align="right"><b>ຄ່າ​ແຮງ​ງານ</b></td>
            <td><b>
                    <?php
                    $hengang_p = 0;
                    $hengang = Khahengang::model()->findByAttributes(array('customer_id' => $sale_lists->customer_id));
                    if (!empty($hengang)) {
                        $hengang_p = $hengang->price;
                        echo number_format($hengang->price, 2);
                    }
                    ?>
                </b></td>
        </tr>
        <?php
        if (Yii::app()->session['pstatus_sale'] == 2) {
            ?>
            <tr>
                <td colspan="4" align="right"><b>ຈ່າຍກອນ</b></td>
                <td><b>
                        <?php
                        $paybefore = Paybefore::model()->findByAttributes(array('customer_id' => $cus->id));
                        echo number_format($paybefore->price, 2);
                        ?>
                    </b></td>
            </tr>
            <tr>
                <td colspan="4" align="right"><b>ຍັງ​ຄ້າງ</b></td>
                <td><b><?php
                        if (!empty($discount)) {
                            echo number_format(($all_paid + $hengang_p) - ($paybefore->price + $discount->discount), 2);
                        } else {
                            echo number_format(($all_paid + $hengang_p) - $paybefore->price, 2);
                        }
                        ?></b></td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td colspan="4" align="right"><b>ຈ່າຍ</b></td>
                <td><b><?= number_format($all_paid - $discount->discount + $hengang_p, 2) ?></b></td>
            </tr>
            <?php
        }
        if (Yii::app()->session['pstatus_sale'] == 4) {
            ?>
            <tr>
                <td colspan="3">
            <u>ເຊັນ​ຜູ​ຮັບ</u>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            </td>
            <td colspan="2" align="right">
            <u>ເຊັນ​ຜູ້​ສົ່ງ</u>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            </td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td colspan="3">
            <u>ເຊັນຜູ້​ຮັບ​ເງີນ</u>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            </td>
            <td colspan="2" align="right">
            <u>​ເຊັນຜູ້​ຈ່າຍເງີນ</u>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>