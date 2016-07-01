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
<div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລາຍ​ງານ​ອາ​ໄຫຼ່​ຕາມ​ຈຳ​ນວນ</h1></div>
&nbsp;
<div class="row">
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
        ​​ຕຳ​ແໜ່ງອາ​ໄຫຼ່: 
        <?php
        $arrayp = array();
        $postions = SparesPosition::model()->findAll();
        foreach ($postions as $postion) {
            if (!in_array($postion->name, $arrayp)) {
                $arrayp[] = $postion->name;
            }
        }
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'position',
            'value' => @$_POST['position'],
            'source' => $arrayp,
            // additional javascript options for the autocomplete plugin
            'options' => array(
                'minLength' => '1',
            ),
            'htmlOptions' => array(
            // 'style' => 'height:20px;',
            ),
        ));
        ?>
    </div>

</div>
<div class="row" style="padding-top: 10px">
    <div class="col-lg-offset-4">
        <button type="submit" name="search" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> ເບີ່ງ​ລາຍງານ</button>
    </div>
</div>
<div class="row" style="padding-top: 5px;">
    <?php
    if (Yii::app()->user->checkAccess('Admin')) {

        $branch = Branch::model()->findAll();
    } else {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $branch = Branch::model()->findAll('id=' . $user->branch_id . '');
    }
    ?>
    <script>
        $(function () {
            $("body").tooltip({
                selector: '[data-toggle="tooltip"]',
                container: 'body'
            });
        })
    </script>
    <table  class="table table-bordered">
        <thead>
            <tr  style="background-color: #0063dc">
                <th>ປະ​ເພດ​ອາ​ໄຫຼ່</th>
                <th>​​ລະ​ຫັດ​ອາ​ໄຫຼ່</th>
                <th>​​ຊື່​ອາ​ໄຫຼ່</th>
                <th>​​ຕຳ​ແໜ່ງອາ​ໄຫຼ່</th>
                <th>ອາ​ໄຫ​ຼ່​ທີ​ມີ</th>
                <th>ອາ​ໄຫ​ຼ່​ທີ່​ຂາຍ​ແລ້ວ</th>
                <th>ອາ​ໄຫ​ຼ່​ທີ​ຍັງ​ເຫຼືອ</th>
            </tr>
        </thead>
        <tbody >
            <?php
            if (!empty($_POST['branch'])) {
                $branch = Branch::model()->findAll('id=' . $_POST['branch'] . '');
            } else {
                if (Yii::app()->user->checkAccess('Admin')) {

                    $branch = Branch::model()->findAll();
                } else {
                    $user = User::model()->findByPk(Yii::app()->user->id);
                    $branch = Branch::model()->findAll('id=' . $user->branch_id . '');
                }
            }
            foreach ($branch as $branchs) {
                ?>
                <tr>
                    <td colspan="7" style="background-color: #FFF6BF"><b><?= $branchs->branch_name ?></b></td>
                </tr>
                <?php
                $criteria = new CDbCriteria(
                        array(
                    'with' => array(
                        'sparePosition',
                    ),
                    'together' => true,
                ));
                $criteria->compare('t.branch_id', $branchs->id);
                $criteria->compare('sparePosition.name', @$_POST['position'], true);
                $spares = InfoSpares::model()->findAll($criteria);
                $total = 0;
                $total_sale = 0;
                $total_yet = 0;
                foreach ($spares as $spare) {
                    $sale_spare = Yii::app()->db->createCommand('SELECT SUM(qautity) FROM sale_spares WHERE info_spares_id=' . $spare->id . '')->queryScalar();
                    $total+=($spare->qautity + $sale_spare);
                    $total_sale+=$sale_spare;
                    $total_yet+=$spare->qautity;
                    ?>
                    <tr>
                        <td data-toggle="tooltip" title="ປະ​ເພດ​ອາ​ໄຫຼ່"><?= $spare->type_spares ?></td>
                        <td data-toggle="tooltip" title="​​ລະ​ຫັດ​ອາ​ໄຫຼ່"><?= $spare->spare_code ?></td>
                        <td data-toggle="tooltip" title="​​ຊື່​ອາ​ໄຫຼ່"><?= $spare->spare_name ?></td>
                        <td data-toggle="tooltip" title="​​ຕຳ​ແໜ່ງອາ​ໄຫຼ່"><?= $spare->sparePosition->name ?></td>
                        <td data-toggle="tooltip" title="ອາ​ໄຫ​ຼ່​ທີ​ມີ"><?= $spare->qautity + $sale_spare ?></td>
                        <td data-toggle="tooltip" title="ອາ​ໄຫ​ຼ່​ທີ່​ຂາຍ​ແລ້ວ"><?= $sale_spare ?></td>
                        <td data-toggle="tooltip" title="ອາ​ໄຫ​ຼ່​ທີ​ຍັງ​ເຫຼືອ"><?= $spare->qautity ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="4" align="right"><b>ລວ​ມ​ຈຳ​ນວນ</b></td>
                    <td>​<b><?= $total ?></b></td>
                    <td><b><?= $total_sale ?></b></td>
                    <td><b><?= $total_yet ?></b></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php $this->endWidget(); ?>
