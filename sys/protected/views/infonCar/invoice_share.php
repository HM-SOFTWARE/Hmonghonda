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
<div id="printableArea" >
    <table class="table table-striped" style="font-family:'Saysettha OT' ;font-size: 12px; width: 100%">
        <tr>
            <td colspan="2" align='center' >
                ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ<br/>
                ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ<br/><br/>
                <span style="font-size: 24px;"> <b>ໃບ​ນຳ​ສົ່ງ</b></span></td>
        </tr>
        <td style="width: 70%">
            <?php
            if (isset(Yii::app()->session['admin_sale_branch'])) {
                $branch = Branch::model()->findByPk((int) Yii::app()->session['admin_sale_branch']);
                //    echo (int) Yii::app()->session['admin_sale_branch'];
                //    exit;
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

            </table>
        </td>
        <td>
            <span style="font-size: 18px;"><b>No. <?= sprintf('%06d', $cus_id) ?></b></span><br/>
            <?php
            $cus = Customer::model()->findByPk($cus_id);
            ?>
            ສົ່ງ​ຫາ​ສາຂາ: <?= $cus->first_name . ' ' . $cus->last_name ?><br/>
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
            <th>ລຳ​ດັບ</th>
            <th colspan="6">ລາຍ​ລະ​ອຽດ</th>
            <th>ຈຳ​ນວນ</th>
            <th>ລາ​ຄາ/ກີບ</th>
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
                <td style="width: 50px;"><?= $i ?></td>
                <td colspan="6">
                    <table style="font-family:'Saysettha OT' ;font-size: 12px; border: 0px;">
                        <tr>
                            <td>ເລກ​ຈັກ</td>
                            <td>: <?= $info_car->car_code_1 ?></td>
                        </tr>
                        <tr>
                            <td>ເລກ​ຖັງ</td>
                            <td>: <?= $info_car->car_code_2 ?></td>
                        </tr>
                        <tr>
                            <td>ລຸ້ນ​ລົດ</td>
                            <td>: <?= $info_car->generation ?></td>
                        </tr>
                        <tr>
                            <td>ຍີ່​ຫໍ​່</td>
                            <td>: <?= $info_car->brand ?></td>
                        </tr>
                        <tr>
                            <td>ສີ</td>
                            <td>: <?= $info_car->color ?></td>
                        </tr>
                        <tr>
                            <td>ສະ​ຖາ​ນະ</td>
                            <td>: <?= $sale_lists->saleStatus->name ?></td>
                        </tr>
                    </table>

                </td>
                <td style="width: 60px;">1</td>
                <td style="width: 100px;">
                    <?php
                    echo number_format($info_car->car_price_sale, 2);
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <div style="font-family:'Saysettha OT' ">
        <div class="col-md-6">
            <u>ເຊັນ​ຜູ​ຮັບ</u>
        </div>
        <div class="col-md-6" align='right'>
            <u>ເຊັນ​ຜູ້​ສົ່ງ</u>
        </div>
    </div>
</div>