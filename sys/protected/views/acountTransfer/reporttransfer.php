<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'infon-car-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
if (!isset($_POST['date_start']) && !isset($_POST['date_end'])) {
    $_POST['date_start'] = date('Y-m-d');
    $_POST['date_end'] = date('Y-m-d');
    $_POST['search'] = 'search';
}
?>

<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ລາຍ​ລະ​ອຽດ​ເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</h1></div>
&nbsp;
<div class="row" >
    <div class="col-md-12">
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
        ?>&nbsp;&nbsp;
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
<div class="table-responsive" > 
    <table class="table table-bordered " id="pdf_export" >
        <tr> 
            <th style="white-space: nowrap">ວັນ​ທີ</th>
            <th style="white-space: nowrap">ລາຍ​ລະ​ອຽດ​ເງີນ​ໂອນ​ເຂົ້າ</th>
            <th style="white-space: nowrap">ຈຳ​ນວນ​ເງີນ</th>
        </tr>
        <?php
        if (isset($_POST['search'])) {
            if (!empty($_POST['branch'])) {
                $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
            } else {
                $branch = Branch::model()->findAll();
            }
            $total_all = 0;
            foreach ($branch as $branchs) {
                $criteria = new CDbCriteria(
                        array(
                    'with' => array(
                        'branch',
                    ),
                    'together' => true,
                ));
                $criteria->addBetweenCondition('date', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
                $criteria->compare('t.branch_id', $branchs->id);
                $criteria->order = 'date ASC';
                $payins = AcountTransfer::model()->findAll($criteria);
                $total = 0;
                if (count($payins) > 0) {
                    ?>
                    <tr>
                        <td colspan="12" style="background-color: #FFE495"><b><?= $branchs->branch_name ?></b></td>
                    </tr>
                    <?php
                    foreach ($payins as $payin) {
                        $total+=$payin->amount;
                        ?>
                        <tr>
                            <td style="white-space: nowrap"><?= $payin->date ?></td>
                            <td style="white-space: nowrap"><?= $payin->name ?></td>
                            <td style="white-space: nowrap"><?= number_format($payin->amount, 2) ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="2" align="right"><b>ລວມ​ຈຳ​ນວນ​ເງີນ</b></td>
                        <td ><b><?= number_format($total, 2) ?></b></td>
                    </tr>
                    <?php
                    $total_all+=$total;
                }
            }
            if (empty($_POST['branch'])) {
                ?>
                <tr>
                    <td colspan="2" align="right"><b>ລວມ​ຈຳ​ນວນ​ເງີນທັງ​ໝົດ</b></td>
                    <td ><b><?= number_format($total_all, 2) ?></b></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<div id="data"></div>