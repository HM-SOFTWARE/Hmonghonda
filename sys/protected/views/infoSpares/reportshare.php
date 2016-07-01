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
<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ອາ​ໄຫຼ່​ທີໂອນ​ໃຫ້​ສາ​ຂາ</h1></div>
&nbsp;
<div class="row">
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
        ຫາ <?php
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
            $("#print_pdf").val('<table border="1" cellspacing="0" cellpadding="5" style="font-size: 5px;">' + $("#pdf_export").clone().html() + '</table>');
            return true;
        }
    </script>

    <form method="post" action="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/ExportPdf&spales=1" onSubmit="javascript:return getHtmlData()">
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
<div class="table-responsive">
    <table class="table table-bordered" id="pdf_export" >
        <tr>
            <th style="white-space: nowrap">ວັນ​ທີ</th>
            <th style="white-space: nowrap">ສະ​ຖາ​ນະ</th>
            <th style="white-space: nowrap">​ປະ​ເພດ​ອາ​ໄຫຼ່</th>
            <th style="white-space: nowrap">ຊື່​ອາ​ໄຫຼ່</th>
            <th style="white-space: nowrap">​ລາ​ຄາ</th>
            <th style="white-space: nowrap">​ຈຳ​ນວນ</th>
            <th style="white-space: nowrap">ຈຳ​ນວນ​ເງີນ</th>
            <th style="white-space: nowrap">ຊື່​ຜູ້​ໂອນ</th>
            <th style="white-space: nowrap">ສາ​ຂາ</th>
        </tr>
        <?php
        if (isset($_POST['search'])) {
            if (!empty($_POST['branch'])) {
                $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
            } else {
                $branch = Branch::model()->findAll();
            }
            $total_all = 0;
            $total_done_all = 0;
            $total_not_all = 0;
            $total_d_all = 0;
            $total_share_all = 0;
            foreach ($branch as $branchs) {
                $criteria = new CDbCriteria(
                        array(
                    'with' => array(
                        'infoSpares',
                    ),
                    'together' => true,
                ));
                $criteria->addBetweenCondition('date', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
                $criteria->compare('t.branch_id', $branchs->id);
                $criteria->compare('sale_status_id', 4);
                $criteria->order = "customer_id DESC";

                $salep = SaleSpares::model()->findAll($criteria);
                if (count($salep) > 0) {
                    ?>
                    <tr>
                        <td colspan="12" style="background-color: #FFE495"><b><?= $branchs->branch_name ?></b></td>
                    </tr>
                    <?php
                    $datas = SaleSpares::model()->getData1();
                    $total = 0;
                    $total_done = 0;
                    $total_not = 0;
                    $total_d = 0;
                    $tatol_share = 0;
                    foreach ($datas as $data) {
                        $criteria = new CDbCriteria(
                                array(
                            'with' => array(
                                'infoSpares',
                            ),
                            'together' => true,
                        ));
                        $criteria->addBetweenCondition('date', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
                        $criteria->compare('t.branch_id', $branchs->id);
                        $criteria->compare('customer_id', $data['customer_id']);
                        $criteria->compare('sale_status_id', 4); // the 4 is ID get from table sale_staus 
                        $criteria->order = "customer_id DESC";
                        $salep = SaleSpares::model()->findAll($criteria);
                        $a = 0;
                        foreach ($salep as $saleps) {
                            $total+=$saleps->paid;
                            $tatol_share+=$saleps->qautity;
                            $a++;
                            ?>
                            <tr>
                                <?php
                                if ($a == 1) {
                                    ?>
                                    <td data-toggle="tooltip" title="ວັນ​ທີ" style="white-space: nowrap" rowspan="<?= count($salep) ?>"><?= $saleps->date ?></td>
                                    <?php
                                }
                                if ($a == 1) {
                                    ?>
                                    <td data-toggle="tooltip" title="ສະ​ຖາ​ນະ" style="white-space: nowrap" rowspan="<?= count($salep) ?>">
                                        <?php
                                        echo $saleps->saleStatus->name;
                                        ?>
                                    </td>
                                    <?php
                                }
                                ?>
                                <td data-toggle="tooltip" title="​ປະ​ເພດ​ອາ​ໄຫຼ່" style="white-space: nowrap"><?= $saleps->infoSpares->type_spares ?></td>
                                <td data-toggle="tooltip" title="ຊື່​ອາ​ໄຫຼ່" style="white-space: nowrap"><?= $saleps->infoSpares->spare_name ?></td>
                                <td data-toggle="tooltip" title="​ລາ​ຄາ" style="white-space: nowrap"><?= $saleps->price_buy ?></td>
                                <td data-toggle="tooltip" title="​ຈຳ​ນວນ" style="white-space: nowrap"><?= $saleps->qautity ?></td>
                                <td data-toggle="tooltip" title="ຈຳ​ນວນ​ເງີນ" style="white-space: nowrap"><?= number_format($saleps->paid, 2) ?></td>
                                <?php
                                if ($a == 1) {
                                    ?>
                                    <td data-toggle="tooltip" title="ຊື່​ຜູ້​ໂອນ" style="white-space: nowrap" rowspan="<?= count($salep) ?>">
                                        <?php
                                        $user = User::model()->findByPk($saleps->user_id);
                                        echo $user->first_name . " " . $user->last_name;
                                        ?>
                                    </td>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($a == 1) {
                                    ?>
                                    <td data-toggle="tooltip" title="ສາ​ຂາ" style="white-space: nowrap" rowspan="<?= count($salep) ?>">
                                        <?php
                                        $customer = Customer::model()->findByPk($saleps->customer_id);
                                        echo CHtml::ajaxLink($customer->first_name . " " . $customer->last_name, array('infonCar/viewcus', 'id' => $customer->id, 'share' => true), array('update' => '#data'));
                                        ?>
                                    </td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="5" align="right"><b>ລວມ​ຈຳ​ນວນ​ເງີນ</b></td>
                        <td><?= $tatol_share ?></td>
                        <td><b><?= number_format($total, 2) ?></b></td>
                        <td colspan="2"></td>
                    </tr>
                    <?php
                    $total_all+=$total;
                    $total_done_all+=$total_done;
                    $total_not_all+=$total_not;
                    $total_d_all+=$total_d;
                    $total_share_all+=$tatol_share;
                }
            }
            if (empty($_POST['branch'])) {
                ?>
                <tr>
                    <td colspan="5" align="right"><b>ລວມ​ຈຳ​ນວນ​ເງີນທັງໝົດ</b></td>
                    <td><?= $total_share_all ?></td>
                    <td><b><?= number_format($total_all, 2) ?></b></td>

                    <td colspan="2"></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<div id="data"></div>