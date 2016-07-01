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
<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ລົດທີ​ຍັງ​ເຫຼຶອ</h1></div>
&nbsp;
<div class="row">
</div>
<div class="row" style="padding-top: 5px;">
    <div class="col-md-10">
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
        &nbsp; ສະ​ຖານ​ນະ​: 
        <select name="status_sale" >
            <option value>ທັງ​ໝົດ</option>
            <?php
            $criter = new CDbCriteria();
            $criter->addInCondition('id', array(1, 2));
            $status = CarOrSpareStatus::model()->findAll($criter);
            foreach ($status as $statuss) {
                ?>
                <option value="<?= $statuss->id ?>" <?= (isset($_POST['status_sale']) && $_POST['status_sale'] == $statuss->id) ? "selected" : "" ?>><?= $statuss->status ?></option>
                <?php
            }
            ?>
        </select>
        <br/><br/>
        ເລກ​ຈັກ: &nbsp; <input type="text" name="code_car1" value="<?= isset($_POST['code_car1']) ? $_POST['code_car1'] : "" ?>">
        ລຸ້ນລົດ: <input type="text" name="generation" value="<?= isset($_POST['generation']) ? $_POST['generation'] : "" ?>">

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
<div id="h-s">
    <table class="table table-striped">
        <tr>
            <th>ວັນ​ທີນຳລົດ​ເຂົ້າ</th>
            <th>​ປະ​ເພດ​ລົດ</th>
            <th>​ເລກ​ຈັກ</th>
            <th>ເລ​ກ​ຖັງ</th>
            <th>​ສີ​ລົດ</th>
            <th>​ລຸ້ນ</th>
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
                        'carSales',
                    ),
                    'together' => true,
                ));
                $criteria->compare('t.branch_id', $branchs->id);
                if (empty($_POST['status_sale'])) {
                    $criteria->compare('car_or_spare_status_id', array(1, 2));
                } else {
                    $criteria->compare('car_or_spare_status_id', $_POST['status_sale']);
                }
                $criteria->compare('car_code_1', $_POST['code_car1']);
                $criteria->compare('generation', $_POST['generation']);
                $cars = InfonCar::model()->findAll($criteria);
                $total = 0;
                if (count($cars) > 0) {
                    ?>
                    <tr>
                        <td colspan="8" style="background-color: #FFE495"><b><?= $branchs->branch_name ?></b></td>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($cars as $car) {
                        $total+=$car->car_price_sale;
                        $i++;
                        ?>
                        <tr>
                            <td data-toggle="tooltip" title="ວັນ​ທີນຳລົດ​ເຂົ້າ"><?= $car->date_in ?></td>
                            <td data-toggle="tooltip" title="​ປະ​ເພດ​ລົດ"><?= $car->carType->type_name ?></td>
                            <td data-toggle="tooltip" title="​ເລກ​ຈັກ"><?= $car->car_code_1 ?></td>
                            <td data-toggle="tooltip" title="ເລ​ກ​ຖັງ"><?= $car->car_code_2 ?></td>
                            <td data-toggle="tooltip" title="​ສີ​ລົດ"><?= $car->color ?></td>
                            <td data-toggle="tooltip" title="​ລຸ້ນ"><?= $car->generation ?></td>
                            <td data-toggle="tooltip" title="​ຈຳ​ນວນ">1</td>
                            <td data-toggle="tooltip" title="ຈຳ​ນວນ​ເງີນ"><?= number_format($car->car_price_sale, 2) ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="6"><b>ລວມ​ຈຳ​ນວນ​ເງີນ</b></td>
                        <td ><b><?= $i ?></b></td>
                        <td><b><?= number_format($total, 2) ?></b></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
    </table>
</div>
<?php $this->endWidget(); ?>