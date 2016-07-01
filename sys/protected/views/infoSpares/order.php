
<div id="err"></div>
<div  id="cancle" class="qautity">
    <script src="<?= Yii::app()->baseUrl ?>/css/jquery.maskMoney.js" type="text/javascript"></script>
    <?php
    /* @var $this InfonCarController */
    /* @var $dataProvider CActiveDataProvider */
    $this->layout = NULL;
    ?>

    <?php
    $this->breadcrumbs = array(
        'Infon Cars',
    );
    $this->menu = array(
        array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create InfonCar', 'url' => array('create')),
        array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage InfonCar', 'url' => array('admin')),
    );
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?= Yii::t('app', 'ລາຍ​ການ​ອາ​ໄຫຼ​່ທີ່ສັ່ງຊື໊ແລ້ວ') ?></h3>
        </div>

        <table class="table table-striped">
            <tr>
                <th style="width: 60px;">ລະ​ຫັດ</th> 
                <th style="width: 100px;">ລະ​ຫັດ​ອາ​ໄຫຼ່</th>
                <th style="width: 100px;">​ຊື່​ອາ​ໄຫຼ່</th>
                <th style="width: 120px;">​ລາ​ຄາ</th>
                <th style="width: 90px;">​ຈຳ​ນວນ​ທີ່​ຕ້ອງ​ການ​ຊື໊</th>
                <th style="width: 150px;">ລາ​ຄາລວມ</th>
                <th style="width: 90px;">ຍົກ​ເລີກ</th>
            </tr>
            <?php
            $i = 0;
            $total = 0;
            foreach ($all_list_order as $k => $all_list_orders) {
                $criteria = new CDbCriteria();
                $criteria->addInCondition('id', array($all_list_orders));
                $sparesinfo = InfoSpares::model()->findAll($criteria);
                foreach ($sparesinfo as $kq => $sparesinfos) {
                    $i++;
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $sparesinfos->spare_code ?></td>
                        <td><?= $sparesinfos->spare_name ?></td>
                        <td><?= number_format($sparesinfos->spare_price_sale, 2) ?></td>
                        <td>
                            <?php
                            $arr = array();
                            for ($a = 1; $a <= $sparesinfos->qautity; $a++) {
                                $arr[$a] = $a;
                            }
                            echo CHtml::dropDownList('qautity[' . $k . ']', !empty(Yii::app()->session['qtt']) ? Yii::app()->session['qtt'][$k] : '', $arr, array('id' => 'qtt_' . $i . '', 'empty' => '== ເລືອກ​ ==',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('infoSpares/checkqautity', array('key' => $k, 'price' => $sparesinfos->spare_price_sale)),
                                    // 'update' => '.qautity_' . $k . ',#qautity',
                                    'update' => '.qautity',
                                    'data' => array('qautity' => 'js:this.value'),
                                ),
                            ));
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty(Yii::app()->session['qtt'])) {
                                $total+= Yii::app()->session['qtt'][$k] * $sparesinfos->spare_price_sale;
                                echo number_format(Yii::app()->session['qtt'][$k] * $sparesinfos->spare_price_sale, 2);
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            echo CHtml::ajaxLink(
                                    '<span class="glyphicon glyphicon-remove"></span> ຍົກ​ເລີກ', // the link body (it will NOT be HTML-encoded.)
                                    array('infoSpares/cancle&id=' . $k . ''), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
                                    array(
                                'update' => '#cancle'), array(
                                'class' => 'btn btn-danger btn-sm'
                                    )
                            );
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr>
                <td colspan="3" align="right"><b><?php
                        if (Yii::app()->session['pstatus_sale'] != 4) {
                            echo "ຄ່າ​ແຮງ​ງານ";
                        }
                        ?>
                    </b></td>
                <td>
                    <?php
                    echo CHtml::form('index.php?r=infoSpares/Morepay', 'post', array('class' => 'floatrightup'));
                    ?>

                    <?php
                    if (Yii::app()->session['pstatus_sale'] != 4) {
                        echo CHtml::textField("morepay", Yii::app()->session['morepay'], array('id' => 'dc1',
                            'onchange' => "this.form.submit()",
                        ));
                    }
                    ?>
                    <script type="text/javascript">$("#dc1").maskMoney();</script>
                    <?php
                    echo CHtml::endForm();
                    ?>
                </td>
                <td  align="right"><b>ລວມ​ລາ​ຄາ​ທັງ​ໝົດ</b></td>
                <td colspan="2">
                    <?php
                    echo CHtml::form('index.php?r=infoSpares/Discount', 'post', array('class' => 'floatrightup'));
                    ?>
                    <b><?= number_format($total, 2) ?></b> &nbsp;&nbsp;&nbsp;
                    <?php
                    if (Yii::app()->session['pstatus_sale'] != 4) {

                        echo '<b>ສ່ວນຫຼຸດ</b> ' . CHtml::textField("discount", Yii::app()->session['discount_spares'], array('id' => 'dc',
                            'onchange' => "this.form.submit()",
                        ));
                    }
                    ?>
                    <script type="text/javascript">$("#dc").maskMoney();</script>
                    <?php
                    echo CHtml::endForm();
                    ?>
                </td>

            </tr>
            <tr>
            <script>
                $(document).ready(function () {
                    $('#dropdown').change(function () {
                        $('.box1').hide();
                        $('.' + $(this).val()).show();
                    });
                });
            </script>
            <td colspan="3">
                <?php echo CHtml::form('index.php?r=infoSpares/checkpstatus', 'post', array('class' => 'floatrightup')); ?>
                ສະ​ຖາ​ນະ:
                <?php
                $arrp = array('1' => 'ຂາຍຈ່າຍ​ເຕັມ', '2' => '​ຂາຍຕິດ​ໜີ້', '4' => 'ແບ່ງ​ໃຫ້​ສາ​ຂາ');
                echo CHtml::dropDownList('status_sale', !empty(Yii::app()->session['pstatus_sale']) ? Yii::app()->session['pstatus_sale'] : '', $arrp, array('id' => "dropdown", 'empty' => '== ເລືອກ​ ==',
                    /* 'ajax' => array(
                      'type' => 'POST',
                      'url' => CController::createUrl('infoSpares/checkpstatus'),
                      // 'update' => '.qautity_' . $k . ',#qautity',
                      'update' => '.qautity',
                      'data' => array('status_sale' => 'js:this.value'),
                      ), */
                    'onchange' => "this.form.submit()",
                ));
                ?>
                <?php echo CHtml::endForm(); ?>
            </td>
            <?php
            if (isset(Yii::app()->session['admin_sale_branch'])) {
                $a = Yii::app()->session['admin_sale_branch'];
            } else {
                $a = User::model()->findByPk(Yii::app()->user->id)->branch_id;
            }
            ?>
            <td colspan="3" ><div style="display:<?= (Yii::app()->session['pstatus_sale'] == 4 || Yii::app()->session['pstatus_sale'] == 2) ? "inline" : "none" ?>">
                    <?php
                    if (Yii::app()->session['pstatus_sale'] == 4) {

                        echo CHtml::form('index.php?r=infoSpares/Paidbefore&b=true', 'post', array('class' => 'floatrightup'));
                        echo "ສາ​ຂາ " . CHtml::dropDownList('branch_from_share', !empty(Yii::app()->session['brach_h']) ? Yii::app()->session['brach_h'] : '', CHtml::listData(Branch::model()->findAll('id not in(' . $a . ')'), 'id', 'branch_name'), array('onchange' => "this.form.submit()", 'empty' => '=== ເລືອກ​ສາ​ຂາ ==='));
                        echo CHtml::endForm();
                    } elseif (Yii::app()->session['pstatus_sale'] == 2) {
                        echo CHtml::form('index.php?r=infoSpares/Paidbefore', 'post', array('class' => 'floatrightup'));
                        echo "ຈ່າຍກອນ " . CHtml::textField("paybefore", Yii::app()->session['paybefore'], array('id' => 'paybefore',
                            /* 'ajax' => array(
                              'type' => 'POST',
                              'url' => CController::createUrl('infoSpares/Paidbefore'),
                              'update' => '.qautity',
                              'data' => array('paybefore' => 'js:this.value'),
                              ) */
                            'onchange' => "this.form.submit()",
                        ));
                        if (empty(Yii::app()->session['discount_spares'])) {
                            Yii::app()->session['discount_spares'] = 0;
                        }
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ຍັງ​ຄ້າງ " . (number_format($total + substr(preg_replace("/[^0-9]/", "", Yii::app()->session['morepay']), 0, -2) - substr(preg_replace("/[^0-9]/", "", Yii::app()->session['discount_spares']), 0, -2) - substr(preg_replace("/[^0-9]/", "", Yii::app()->session['paybefore']), 0, -2), 2));

                        echo CHtml::endForm();
                    }
                    ?>
                    <script type="text/javascript">$("#paybefore").maskMoney();</script>
                </div>
            </td>
            <td></td>
            </tr>
            <?php
            if (!empty($all_list_order)) {
                ?>
                <tr>
                    <td colspan="10">
                        <div class="col-md-6"> 
                            <?php
                            if (isset(Yii::app()->session['admin_sale_branch'])) {
                                ?>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/sale&branc_id=<?= Yii::app()->session['admin_sale_branch'] ?>" class="btn btn-primary">ສັ່ງ​ຊື້​ເພີ່ມ</a>
                                <?php
                            } else {
                                ?>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/sale" class="btn btn-primary">ສັ່ງ​ຊື້​ເພີ່ມ</a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-6" align="right">
                            <?php
                            echo CHtml::ajaxLink('<span class="glyphicon glyphicon-compressed"></span> ຢັ້ງ​ຢືນ​ການ​ຊື້', Yii::app()->createUrl('infoSpares/comfirmSale'), array(
                                'type' => 'POST',
                                'update' => '#err'
                                    ), array('class' => 'btn btn-success',));
                            ?>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            <?php
            if (empty($all_list_order)) {
                ?>
                <tr>
                    <td colspan="10">ຂໍ້​ມູ​ນ​ສັ່ງ​ຊື່​ອາ​ໄຫຼ່ບໍ່​ມີ</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
