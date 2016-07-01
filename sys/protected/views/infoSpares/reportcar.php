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
<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ອາ​ໄຫຼ່​ທີ​ຍັງ​ເຫຼຶອ</h1></div>
&nbsp;
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
<script>
    $(function () {
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]',
            container: 'body'
        });
    })
</script>
<table class="table table-striped">
    <tr>
        <th>ວັນ​ທີນຳ​ເຂົ້າ</th>
        <th>​ປະ​ເພດ​ອາ​ໄຫຼ່</th>
        <th>ຊື່​ອາ​ໄຫຼ່</th>
        <th>​ລາ​ຄາ</th>
        <th>​ຈຳ​ນວນ</th>
        <th>ຈຳ​ນວນ​ເງີນ</th>
    </tr>
    <?php
    if (isset($_POST['search'])) {
        if (!empty($_POST['branch'])) {
            $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
        } else {
            $branch = Branch::model()->findAll();
        }
        foreach ($branch as $branchs) {
            $criteria = new CDbCriteria(
                    array(
                'with' => array(
                //  'infoSpares',
                ),
                'together' => true,
            ));
            $criteria->compare('t.branch_id', $branchs->id);
            $salep = InfoSpares::model()->findAll($criteria);
            $total = 0;
            $total_c = 0;
            if (count($salep) > 0) {
                ?>
                <tr>
                    <td colspan="7" style="background-color: #FFE495"><b><?= $branchs->branch_name ?></b></td>
                </tr>
                <?php
                foreach ($salep as $saleps) {
                    $total+=$saleps->spare_price_sale;
                    $total_c+=$saleps->qautity;
                    ?>
                    <tr>
                        <td data-toggle="tooltip" title="ວັນ​ທີນຳເຂົ້າ"><?= $saleps->date_in ?></td>
                        <td data-toggle="tooltip" title="​ປະ​ເພດ​ອາ​ໄຫຼ່"><?= $saleps->type_spares ?></td>
                        <td data-toggle="tooltip" title="ຊື່​ອາ​ໄຫຼ່"><?= $saleps->spare_name ?></td>
                        <td data-toggle="tooltip" title="​ລາ​ຄາ"><?= $saleps->spare_price_sale ?></td>
                        <td data-toggle="tooltip" title="​ຈຳ​ນວນ"><?= $saleps->qautity ?></td>
                        <td data-toggle="tooltip" title="ຈຳ​ນວນ​ເງີນ"><?= number_format($saleps->spare_price_sale * $saleps->qautity, 2) ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="4"><b>ລວມ​ຈຳ​ນວນ​ເງີນ</b></td>
                    <td><?= $total_c ?></td>
                    <td><b><?= number_format($total, 2) ?></b></td>
                </tr>
                <?php
            }
        }
    }
    ?>
</table>
<?php $this->endWidget(); ?>