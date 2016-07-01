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
<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ລາຍ​ຮັບ​ລາຍ​ເດືອນ</h1></div>
&nbsp;
<div class="row" >
    <div class="col-md-6">
        ຈາກວັນ​ທີ: 
        <?php
        $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', array(
            'name' => 'date_start',
            'value' => isset($_POST['date_start']) ? $_POST['date_start'] : "",
            'options' => array(
                'yearRange' => '-5:+15',
                'dateFormat' => 'yy-mm',
                'yearRange' => '2016:' . date('Y') . '',
            ),
            'htmlOptions' => array(
                'onChange' => 'js:doSomething()',
            ),
        ));
        ?>

        ຫາ 
        <?php
        $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', array(
            'name' => 'date_end',
            'value' => isset($_POST['date_end']) ? $_POST['date_end'] : "",
            'options' => array(
                'yearRange' => '-5:+15',
                'dateFormat' => 'yy-mm',
                'yearRange' => '2016:' . date('Y') . '',
            ),
            'htmlOptions' => array(
                'onChange' => 'js:doSomething()',
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
    <tr style="background-color: #006dcc">
        <th>ເດືອນ</th>
        <th>ລາຍ​ຮັບ​ລວມ</th>
        <th>​ລາຍ​ຈ່າຍ​ລວມ</th>
        <th>​ລາ​ຍ​ຮັບສຸດ​ທີ</th>
        <th>ໝີ້​ຕ້ອງ​ຮັ​ບ</th>
        <th>ໝີ້​ຈ່າຍ​ເຂົ້າ</th>
        <th>​ເງີນ​ສົດ​ສຸດ​ທີ</th>
    </tr>
    <?php
    if (isset($_POST['search'])) {
        if (!empty($_POST['branch'])) {
            $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
        } else {
            $branch = Branch::model()->findAll();
        }

        foreach ($branch as $branchs) {
            ?>
            <tr style="background-color: #FFE495">
                <td colspan="6"><?= $branchs->branch_name ?></td>
            </tr>
            <?php
            $a = 0;
            $count_next = 0;
            $total_recived = 0;
            $total_paid = 0;
            $total_recived_max = 0;
            $total_nitonghup = 0;
            $total_nitongpayin = 0;
            $total_real_recived = 0;
            $arra = array();
            for ($i = date('m', strtotime($_POST['date_start'])); $i <= date('m', strtotime($_POST['date_end'])); $i++) {
                $a++;
                ?>
                <tr>
                    <td>ເດືອນ <?= (int) $i ?></td>
                    <td>
                        <?php
                        $command_recieve = Yii::app()->db->createCommand('SELECT SUM(paid) FROM car_sale WHERE MONTH(date)=' . $i . ' and branch_id=' . $branchs->id . ' and sale_status_id IN(1,2)')->queryScalar();
                        $command_recieve_pares = Yii::app()->db->createCommand('SELECT SUM(paid) FROM sale_spares WHERE MONTH(date)=' . $i . ' and branch_id=' . $branchs->id . ' and sale_status_id IN(1)')->queryScalar();
                        $command_recieve_debts = Yii::app()->db->createCommand('SELECT DISTINCT customer_id FROM sale_spares WHERE MONTH(date)=' . $i . ' and branch_id=' . $branchs->id . ' and sale_status_id IN(2)')->queryAll();
                        $command_recieve_d = 0;
                        foreach ($command_recieve_debts as $command_recieve_debt) {
                            $command_recieve_d+= Yii::app()->db->createCommand('SELECT SUM(price) FROM paybefore WHERE customer_id=' . $command_recieve_debt['customer_id'] . '')->queryScalar();
                        }
                        echo number_format(($command_recieve + $command_recieve_pares + $command_recieve_d), 2);
                        $total_recived+=$command_recieve + $command_recieve_pares + $command_recieve_d;
                        ?>
                    </td>
                    <td>
                        <?php
                        $command_payout = Yii::app()->db->createCommand('SELECT SUM(amonut) FROM payment_in WHERE MONTH(date)=' . $i . ' and branch_id=' . $branchs->id . '')->queryScalar();
                        echo number_format($command_payout, 2);
                        $total_paid+=$command_payout;
                        ?>
                    </td>
                    <td>
                        <?= number_format(($command_recieve + $command_recieve_pares + $command_recieve_d) - $command_payout, 2) ?>
                        <?php
                        $total_recived_max+=($command_recieve + $command_recieve_pares + $command_recieve_d) - $command_payout;
                        ?>
                    </td>
                    <td>
                        <?php
                        $command_debts = Yii::app()->db->createCommand('SELECT DISTINCT infon_car_id FROM car_sale WHERE MONTH(date)<=' . $i . ' and YEAR(date)=' . date('Y') . '  and branch_id=' . $branchs->id . ' and sale_status_id IN(2)')->queryAll();
                        $count_peroir = 0;
                        $paid = 0;
                        $count_next = 0;
                        foreach ($command_debts as $command_debt) {
                            $dept_paymoth = Yii::app()->db->createCommand('SELECT paid FROM depts_month_pay WHERE infon_car_id=' . $command_debt['infon_car_id'] . ' and MONTH(date_pay)=' . $i . ' and YEAR(date_pay)=' . date('Y') . '  and status="0"')->queryScalar();
                            $count_next+=$dept_paymoth;
                            $dept_paidmoth = Yii::app()->db->createCommand('SELECT paid FROM depts_month_pay WHERE infon_car_id=' . $command_debt['infon_car_id'] . ' and MONTH(date_pay)=' . $i . ' and YEAR(date_pay)=' . date('Y') . ' and status="1" and first_pay="N"')->queryScalar();
                            $count_peroir+=$dept_paidmoth;
                        }
                        $total_nitonghup+=$count_next;
                        $total_nitongpayin+=$count_peroir;
                        echo number_format($count_next, 2);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo number_format($count_peroir, 2);
                        ?>
                    </td>
                    <td>
                        <?= number_format((($command_recieve + $command_recieve_pares + $command_recieve_d) - $count_next - $command_payout), 2) ?>
                        <?php
                        $total_real_recived+=(($command_recieve + $command_recieve_pares + $command_recieve_d) - $count_next - $command_payout);
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td><b>ລວມ​ຈຳ​ນວນເງີນ</b></td>
                <td><b><?= number_format($total_recived, 2) ?></b></td>
                <td><b><?= number_format($total_paid, 2) ?></b></td>
                <td><b><?= number_format($total_recived_max, 2) ?></b></td>
                <td><b><?= number_format($total_nitonghup, 2) ?></b></td>
                <td><b><?= number_format($total_nitongpayin, 2) ?></b></td>
                <td><b><?= number_format($total_real_recived, 2) ?></b></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
