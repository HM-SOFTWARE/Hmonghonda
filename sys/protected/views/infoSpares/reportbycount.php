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
    <div class="col-md-12">
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
    <div class="col-md-12" style="padding-top: 10px;">
        ​​ຊື່​ອາ​ໄຫຼ່: 
        <?php
        $arraysp = array();
        $sp = InfoSpares::model()->findAll();
        foreach ($sp as $sps) {
            if (!in_array($sps->spare_name, $arraysp)) {
                $arraysp[] = $sps->spare_name;
            }
        }
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'name_spares',
            'value' => @$_POST['name_spares'],
            'source' => $arraysp,
            // additional javascript options for the autocomplete plugin
            'options' => array(
                'minLength' => '1',
            ),
            'htmlOptions' => array(
            // 'style' => 'height:20px;',
            ),
        ));
        ?>
        ​​ລະ​ຫັດອາ​ໄຫຼ່: 
        <?php
        $arraypc = array();
        $spc = InfoSpares::model()->findAll();
        foreach ($spc as $spcs) {
            if (!in_array($spcs->spare_code, $arraypc)) {
                $arraypc[] = $spcs->spare_code;
            }
        }
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'code_spares',
            'value' => @$_POST['code_spares'],
            'source' => $arraypc,
            // additional javascript options for the autocomplete plugin
            'options' => array(
                'minLength' => '1',
            ),
            'htmlOptions' => array(
            // 'style' => 'height:20px;',
            ),
        ));
        ?>
        ປະ​ເພດ​ອາ​ໄຫຼ່
        <?php
        $arraytp = array();
        $spt = InfoSpares::model()->findAll();
        foreach ($spt as $spts) {
            if (!in_array($spts->type_spares, $arraytp)) {
                $arraytp[] = $spts->type_spares;
            }
        }
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'type_spares',
            'value' => @$_POST['type_spares'],
            'source' => $arraytp,
            // additional javascript options for the autocomplete plugin
            'options' => array(
                'minLength' => '1',
            ),
            'htmlOptions' => array(
            // 'style' => 'height:20px;',
            ),
        ));
        ?>
        ເລກ​ທີ່​ນຳ​ເຂົ້າ
        <?php
        $arraytp = array();
        $spt = InfoSpares::model()->findAll();
        foreach ($spt as $spts) {
            if (!in_array($spts->number_come, $arraytp)) {
                $arraytp[] = $spts->number_come;
            }
        }
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'number_come',
            'value' => @$_POST['number_come'],
            'source' => $arraytp,
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
    <div class="col-lg-offset-10">
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
    <div class="table-responsive">
        <table  class="table table-bordered">
            <thead>
                <tr  style="background-color: #0063dc">
                    <th style="white-space: nowrap">ວັນ​ທີ​ນຳ​ເຂົ້າໃໝ່</th>
                    <th style="white-space: nowrap"> ເລກ​ທີ່​ນຳ​ເຂົ້າ</th>
                    <th style="white-space: nowrap">ປະ​ເພດ​ອາ​ໄຫຼ່</th>
                    <th style="white-space: nowrap">​​ລະ​ຫັດ​ອາ​ໄຫຼ່</th>
                    <th style="white-space: nowrap">​​ຊື່​ອາ​ໄຫຼ່</th>
                    <th style="white-space: nowrap">​​ຕຳ​ແໜ່ງອາ​ໄຫຼ່</th>
                    <th style="white-space: nowrap">ລາ​ຄາ​ອາ​ໄຫຼ່</th>
                    <th style="white-space: nowrap">ອາ​ໄຫ​ຼ່​ຄ້າງ</th>
                    <th style="white-space: nowrap">ອາ​ໄຫ​ຼ່​ເຂົ້າ​ໃໝ່</th>
                    <th style="white-space: nowrap">ລວ​ມກັນ</th>
                    <th style="white-space: nowrap">ອາ​ໄຫຼ່​ໂອນ​ໃຫ້​ສາ​ຂ​າ</th>
                    <th style="white-space: nowrap">ອາ​ໄຫ​ຼ່​ທີ່​ຂາຍ​ແລ້ວ</th>
                    <th style="white-space: nowrap">ເປັນ​ເງີນ</th>
                    <th style="white-space: nowrap">ອາ​ໄຫ​ຼ່​ທີ​ຍັງ​ເຫຼືອ</th>
                    <th style="white-space: nowrap">ເປັນ​ເງີນ</th>
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
                        <td colspan="15" style="background-color: #FFF6BF"><b><?= $branchs->branch_name ?></b></td>
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
                    if (isset($_POST['date_start']) && !empty($_POST['date_start'])) {
                        $criteria->addBetweenCondition('date_in', date('Y-m-d', strtotime($_POST['date_start'])), date('Y-m-d', strtotime($_POST['date_end'])));
                    }
                    if (isset($_POST['name_spares']) && !empty($_POST['name_spares'])) {
                        $criteria->compare('t.spare_name', @$_POST['name_spares'], true);
                    }
                    if (isset($_POST['code_spares']) && !empty($_POST['code_spares'])) {
                        $criteria->compare('t.spare_code', @$_POST['code_spares'], true);
                    }
                    if (isset($_POST['number_come']) && !empty($_POST['number_come'])) {
                        $criteria->compare('t.number_come', @$_POST['number_come'], true);
                    }
                    if (isset($_POST['type_spares']) && !empty($_POST['type_spares'])) {
                        $criteria->compare('t.type_spares', @$_POST['type_spares'], true);
                    }
                    $spares = InfoSpares::model()->findAll($criteria);
                    $total = 0;
                    $total_sale_transfer = 0;
                    $total_sale = 0;
                    $total_yet = 0;
                    $total_paid = 0;
                    $total_price = 0;
                    $total_old_q = 0;
                    $total_last_q = 0;
                    foreach ($spares as $spare) {
                        $sale_spare = Yii::app()->db->createCommand('SELECT SUM(qautity) FROM sale_spares WHERE info_spares_id=' . $spare->id . ' and sale_status_id=1 || sale_status_id=2')->queryScalar();
                        $sale_paid = Yii::app()->db->createCommand('SELECT SUM(paid) FROM sale_spares WHERE info_spares_id=' . $spare->id . ' and sale_status_id=1 || sale_status_id=2')->queryScalar();
                        $sale_transfer_branch = Yii::app()->db->createCommand('SELECT SUM(qautity) FROM sale_spares WHERE info_spares_id=' . $spare->id . ' and sale_status_id=4')->queryScalar();
                        ?>
                        <tr>
                            <td data-toggle="tooltip" title="ວັນ​ທີ​ນຳ​ເຂົ້າໃໝ່"><?= $spare->date_in ?></td>
                            <td data-toggle="tooltip" title=" ເລກ​ທີ່​ນຳ​ເຂົ້າ"><?= $spare->number_come ?></td>
                            <td data-toggle="tooltip" title="ປະ​ເພດ​ອາ​ໄຫຼ່"><?= $spare->type_spares ?></td>
                            <td data-toggle="tooltip" title="​​ລະ​ຫັດ​ອາ​ໄຫຼ່"><?= $spare->spare_code ?></td>
                            <td data-toggle="tooltip" title="​​ຊື່​ອາ​ໄຫຼ່"><?= $spare->spare_name ?></td>
                            <td data-toggle="tooltip" title="​​ຕຳ​ແໜ່ງອາ​ໄຫຼ່"><?= $spare->sparePosition->name ?></td>
                            <td data-toggle="tooltip" title="ລາ​ຄາ​ອາ​ໄຫຼ່"><?= number_format($spare->spare_price_sale, 2) ?></td>
                            <td data-toggle="tooltip" title="ອາ​ໄຫ​ຼ່​ຄ້າງ">
                                <?php
                                $last_spare = LastOldSpares::model()->findByAttributes(array('info_spares_id' => $spare->id));
                                if (!empty($last_spare)) {
                                    $old_q = $last_spare->old_qautity;
                                    $last_q = $last_spare->last_qautity;
                                    echo $last_spare->old_qautity;
                                } else {
                                    $old_q = 0;
                                    $last_q = 0;
                                    echo 0;
                                }
                                ?>
                            </td>
                            <td data-toggle="tooltip" title="ອາ​ໄຫ​ຼ່​ເຂົ້າ​ໃໝ່"><?= $last_q - $old_q ?></td>
                            <td data-toggle="tooltip" title="ລວມ​ກັນ"><?= $last_q ?></td>
                            <td data-toggle="tooltip" title="ລວມ​ກັນ"><?= $sale_transfer_branch ?></td>
                            <td data-toggle="tooltip" title="ອາ​ໄຫຼ່​ໂອນ​ໃຫ້​ສາ​ຂ​າ"><?= $sale_spare ?></td>
                            <td data-toggle="tooltip" title="ເປັ​ນ​ເງີນ"><?= number_format($sale_paid, 2) ?></td>
                            <td data-toggle="tooltip" title="ອາ​ໄຫ​ຼ່​ທີ​ຍັງ​ເຫຼືອ"><?= $spare->qautity ?></td>
                            <td data-toggle="tooltip" title="ເປັ​ນ​ເງີນ"><?= number_format($spare->qautity * $spare->spare_price_sale, 2) ?></td>
                        </tr>
                        <?php
                        $total+=$last_q;
                        $total_old_q+=$old_q;
                        $total_last_q+=$last_q - $old_q;
                        $total_sale+=$sale_spare;
                        $total_sale_transfer+=$sale_transfer_branch;
                        $total_yet+=$spare->qautity;
                        $total_paid+=$sale_paid;
                        $total_price+=$spare->qautity * $spare->spare_price_sale;
                    }
                    ?>
                    <tr>
                        <td colspan="7" align="right"><b>ລວ​ມ​ຈຳ​ນວນ</b></td>
                        <td>​<b><?= $total_old_q ?></b></td>
                        <td>​<b><?= $total_last_q ?></b></td>
                        <td>​<b><?= $total ?></b></td>
                        <td>​<b><?= $total_sale_transfer ?></b></td>
                        <td><b><?= $total_sale ?></b></td>
                        <td><b><?= number_format($total_paid, 2) ?></b></td>
                        <td><b><?= $total_yet ?></b></td>
                        <td><b><?= number_format($total_price, 2) ?></b></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->endWidget(); ?>
