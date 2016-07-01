<?php
$this->layout = NULL;
?>
<div id="payment1"></div>
<div id="payment">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?= Yii::t('app', 'ການ​ຊຳ​ລະ​ຄ່າ​ໜີ້​ອາ​ໄຫຼ່') ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'action' => Yii::app()->createUrl('infoSpares/payment')
                ));
                ?>
                <div class="col-md-3">
                    ລະ​ຫັດ​ລູກ​ຄ້າ:
                    <?php
                    echo CHtml::textField("cus_id", isset($_POST['cus_id']) ? $_POST['cus_id'] : '');
                    ?>
                </div>
                <div class="col-md-2"><button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-search"></span> ຄົ້ນ​ຫາ</button></div>
                <?php $this->endWidget(); ?>
            </div><br/>
            <table class="table table-bordered">
                <tr>
                    <th>ລຳ​ດັບ</th>
                    <th>ລະ​ຫັດ​ອາ​ໄຫຼ່</th>
                    <th>ຊື່​ອາ​ໄຫຼ່</th>
                    <th>ຈຳ​ນວນອາ​ໄຫຼ່</th>
                    <th>ລາ​ຄາ</th>
                    <th>ເງີນ​ຈ່າຍແລ້ວ</th>
                    <th>ເງີນ​ຍັງຄ້າງ</th>
                    <th>ຊຳ​ລະ</th>
                </tr>
                <?php
                $datas = SaleSpares::model()->getData($_POST['cus_id']);
                foreach ($datas as $data) {
                    $salep = SaleSpares::model()->findAllByAttributes(array('customer_id' => $data['customer_id']));
                    $i = 0;
                    foreach ($salep as $saleps) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $saleps->infoSpares->spare_code ?></td>
                            <td><?= $saleps->infoSpares->spare_name ?></td>
                            <td><?= $saleps->qautity ?></td>
                            <td><?= number_format($saleps->price_buy * $saleps->qautity, 2) ?></td>
                            <?php
                            if ($i == 1) {
                                $payb = Paybefore::model()->findByAttributes(array('customer_id' => $data['customer_id']));
                                ?>
                                <td rowspan="<?= count($salep) ?>">
                                    <?php
                                    echo number_format($payb->price, 2);
                                    ?>
                                </td>
                                <?php
                            }
                            ?>
                            <?php
                            if ($i == 1) {
                                ?>
                                <td rowspan="<?= count($salep) ?>">
                                    <?php
                                    $total = 0;
                                    foreach ($salep as $salepss) {
                                        $total+= $salepss->price_buy * $salepss->qautity;
                                    }
                                    echo number_format($total - $payb->price, 2);
                                    ?></td>
                                <?php
                            }
                            ?>
                            <?php
                            if ($i == 1) {
                                ?>
                                <td rowspan="<?= count($salep) ?>">
                                    <?php
                                    if (($total - $payb->price) != 0) {
                                        echo CHtml::ajaxLink(
                                                '<span class="glyphicon glyphicon-modal-window"></span>', // the link body (it will NOT be HTML-encoded.)
                                                array('infoSpares/paynot', 'cus_id' => $data['customer_id']), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
                                                array(
                                            'update' => '#payment1',
                                                ), array(
                                            'class' => 'btn btn-success'
                                                )
                                        );
                                    }
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
            </table>
        </div>
    </div>
</div>
<div id="payment1"></div>