<div id="view"></div>
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
<div id="myDiv">
    <div class="col-md-12" style=" border-bottom: 1px solid #b71113"><h1>ລົດບໍ່ທັນແຈ້ງສັບສີນ</h1></div>
    &nbsp;
    <div class="row" >
        <div class="col-md-6">
            ຈາກວັນ​ທີ: 
            <?php
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
        <div class="col-md-4" style="padding-top: 15px;">​
            ເລກ​ຈັກ <input type="text" name="car_code"  value="<?= @$_POST['car_code'] ?>"> 
        </div>
        <div class="col-md-2" style="padding-top: 20px;">
            <?php echo BsHtml::submitButton('ຄົ້ນ​ຫາ', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' => BsHtml::GLYPHICON_SEARCH)); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            ​<h4 class=" pull-right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cengsupxen"><u>ລົດບໍ່ທັນແຈ້ງສັບສີນ </u></a>|| <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cengsupxendone"><u>​ລົດແຈ້ງສັບສີນແລ້ວ​ </u></a>|| <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/listrunpai"><u>ລົດຂື້ນທະບຽນແລ້ວ</u></a></h4>

        </div>

    </div>
    <br/>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th style="white-space: nowrap">ວັນ​ທີ</th>
                <th style="white-space: nowrap">​ປະ​ເພດ​ລົດ</th>
                <th style="white-space: nowrap">​ເລກ​ຈັກ</th>
                <th style="white-space: nowrap">ເລ​ກ​ຖັງ</th>
                <th style="white-space: nowrap">​ສີ​ລົດ</th>
                <th style="white-space: nowrap">​ຈຳ​ນວນ</th>
                <th style="white-space: nowrap">ຊື່​ລູກ​ຄ້າ</th>
                <th style="white-space: nowrap"></th>
            </tr>
            <?php
            $placard = Placard::model()->findAll('date_note IS NULL OR date_placars IS NULL');
            $array = array();
            foreach ($placard as $placards) {
                $array[] = $placards->infon_car_id;
            }
            if (Yii::app()->user->checkAccess('Admin')) {
                $branch = Branch::model()->findAll();
            } else {
                $user = User::model()->findByPk(Yii::app()->user->id);
                $branch = Branch::model()->findAllByAttributes(array('id' => $user->branch_id));
            }
            $branch_id = array();
            foreach ($branch as $branchs) {
                $branch_id[] = $branchs->id;
                $criteria = new CDbCriteria(
                        array(
                    'with' => array(
                        'carSales',
                        'placards',
                    ),
                    'together' => true,
                ));
                $criteria->compare('t.branch_id', $branchs->id);
                if (isset($_POST['date_start']) && $_POST['date_end']) {
                    $criteria->addBetweenCondition('date_out', @$_POST['date_start'], @$_POST['date_end']);
                }
                $criteria->compare('car_or_spare_status_id', 3);
                $criteria->compare('car_code_1', @$_POST['car_code']);
                $criteria->addInCondition('t.id', $array);
                $criteria->addCondition('placards.date_note IS NULL');
                $criteria->addCondition('placards.date_placars IS NULL');
                $criteria->order = 'carSales.id ASC';
                /*  $a = InfonCar::model()->findAll('branch_id IN (' . implode(',', $branch_id) . ')');
                  $count = count($a);
                  $pages = new CPagination($count);

                  // results per page
                  $pages->pageSize = 5;
                  $pages->applyLimit($criteria); */
                $cars = InfonCar::model()->findAll($criteria);

                $total_note = 0;
                $total_placar = 0;
                if (count($cars) > 0) {
                    ?>
                    <tr>
                        <td colspan="12" style="background-color: #f7ecb5"><b><?= $branchs->branch_name ?></b></td>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($cars as $car) {
                        $i++;
                        $placardp = Placard::model()->findByAttributes(array('infon_car_id' => $car->id));
                        $total_note+=substr(preg_replace("/[^0-9]/", "", $placardp->pay_note), 0, -2);
                        $total_placar+=substr(preg_replace("/[^0-9]/", "", $placardp->pay_placar), 0, -2);
                        ?>
                        <tr>
                            <td><?= $car->date_out ?></td>
                            <td><?= $car->carType->type_name ?></td>
                            <td><?= $car->car_code_1 ?></td>
                            <td><?= $car->car_code_2 ?></td>
                            <td><?= $car->color ?></td>
                            <td>1</td>

                            <td style=" word-break: break-all;width: 400px;"><?php
            $carsale = CarSale::model()->findByAttributes(array('infon_car_id' => $car->id));
            echo $carsale->customer->first_name . $carsale->customer->first_name;
                        ?></td>
                            <td>
                                <?=
                                CHtml::ajaxLink('LP', Yii::app()->createUrl("infonCar/runpai&id=$placardp->id&c=1"), array('update' => '#view', 'beforeSend' => 'function(){
      $("#myDiv").addClass("loading");}',
                                    'complete' => 'function(){
      $("#myDiv").removeClass("loading");}',), array('class' => 'btn btn-success',))
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="5"><b>ລວມ​ຈຳ​ນວນ​ເງີນ</b></td>
                        <td><?= $i ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <div class="col-md-12" align="center">
            <?php
            /*  $this->widget('CLinkPager', array(
              'pages' => $pages,
              )) */
            ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>