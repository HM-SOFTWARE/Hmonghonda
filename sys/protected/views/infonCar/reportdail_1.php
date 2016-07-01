<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'infon-car-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ລາຍ​ຮັບ​ລາຍ​ວັນ</h1></div>
&nbsp;
<div class="row" >
    <div class="col-md-6">
        ຈາກວັນ​ທີ: <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'date_start',
            'value' => isset($_POST['date_start']) ? $_POST['date_start'] : "",
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
        ຫາ 
        <?php
        $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', array(
            'model' => $model,
            'attribute' => 'some_date',
            'options' => array(
                'yearRange' => '-5:+15',
                'dateFormat' => 'yy-mm',
            ),
            'htmlOptions' => array(
                'onChange' => 'js:doSomething()',
            ),
        ));
        ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'date_end',
            'value' => isset($_POST['date_end']) ? $_POST['date_end'] : "",
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
<div class="row">
</div>
<div class="row" style="padding-top: 5px;">
    <div class="col-md-3">
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

    </div>
    <div class="col-md-6">
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
            $("#print_pdf").val('<table border="1" cellspacing="0" cellpadding="5" style="font-size: 10px;">' + $("#pdf_export").clone().html() + '</table>');
            return true;
        }
    </script>

    <form method="post" action="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/ExportPdf&daily=1" onSubmit="javascript:return getHtmlData()">
        <input type="hidden" id="print_pdf" name="pdf" value="">  
        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-export"></span>ລາຍ​ງານ​ເປັນ PDF</button>
    </form>
</div>
<table class="table table-bordered" id="pdf_export" >
    <tr>
        <th>ສາ​ຂາ</th>
        <th>ລາຍ​ຮັບ​ລວມ</th>
        <th>​ລາຍ​ໄດ້​ໃນ​ບັນ​ຊີ</th>
        <th>​ເງີນ​ສົດລວມ</th>
        <th>​ເງ​ີນ​ສົດ​ສຸດ​ທີ</th>
        <th>​ລາຍ​ຮັບ​ສຸດ​ທີ</th>
    </tr>
    <?php
    if (isset($_POST['search'])) {
        if (!empty($_POST['branch'])) {
            $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
        } else {
            $branch = Branch::model()->findAll();
        }
        foreach ($branch as $branchs) {
            $criteria = new CDbCriteria();
            $criteria->addBetweenCondition('date', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
            $criteria->compare('branch_id', $branchs->id);
            $salecar = CarSale::model()->findAll($criteria);
            $total_car_sal = 0;
            $total_spares_sal = 0;
            foreach ($salecar as $salecars) {
                $total_car_sal+=$salecars->paid;
            }
            $salespares = SaleSpares::model()->findAll($criteria);
            foreach ($salespares as $salesparess) {
                $total_spares_sal+=$salesparess->paid;
            }
            /////  Still payment ////
            $criteria1 = new CDbCriteria(
                    array(
                'with' => array(
                    'carSales',
                ),
                'together' => true,
            ));
            $criteria1->addBetweenCondition('date_out', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
            $criteria1->compare('t.branch_id', $branchs->id);
            $criteria1->compare('car_or_spare_status_id', 3);
            $criteria1->compare('carSales.sale_status_id', 4);
            $cars = InfonCar::model()->findAll($criteria1);
            $nitonghup_total = 0;
            foreach ($cars as $car) {
                $salecar_inter = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
                $tunteun = $car->car_price_sale - $salecar_inter->paid;
                $interest_mount = ($tunteun * $salecar_inter->interest) / 100;
                $le_time = $interest_mount * $salecar_inter->count_date_pay;
                $nitonghup = $le_time + $tunteun;
                $all_paid = 0;
                $salecar_interAll = CarSale::model()->findAllByAttributes(array('infon_car_id' => $car->id));
                foreach ($salecar_interAll as $salecar_interAlls) {
                    $all_paid+=$salecar_interAlls->paid;
                }
                $nitonghup_all = $all_paid - $nitonghup;
                $nitonghup_total+=$nitonghup_all;
            }
            $criteria_amount = new CDbCriteria();
            $criteria_amount->compare('t.branch_id', $branchs->id);
            $criteria_amount->addBetweenCondition('date', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
            $amount_transfer = AcountTransfer::model()->findAll($criteria_amount);
            $total_amount_t = 0;
            foreach ($amount_transfer as $amount_transfers) {
                $total_amount_t+=$amount_transfers->amount;
            }

            $amount_paidin = PaymentIn::model()->findAll($criteria_amount);
            $total_amount_paidin = 0;
            foreach ($amount_paidin as $amount_paidins) {
                $total_amount_paidin+=$amount_paidins->amonut;
            }
            ?>
            <tr>
                <td><b><?= $branchs->branch_name ?></b></td>
                <td><?= number_format($total_car_sal + $total_spares_sal, 2) ?></td>
                <td><?= number_format($nitonghup_total + $total_amount_t, 2) ?></td>
                <td><?= number_format(($total_car_sal + $total_spares_sal) - ($nitonghup_total + $total_amount_t), 2) ?></b></td>
                <td><?= number_format((($total_car_sal + $total_spares_sal) - ($nitonghup_total + $total_amount_t)) - ($total_amount_paidin), 2) ?></td>
                <td><?= number_format(($total_car_sal + $total_spares_sal) - $total_amount_paidin, 2) ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
