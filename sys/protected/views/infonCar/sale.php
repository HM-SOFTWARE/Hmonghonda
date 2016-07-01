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
<script>
    function showMe(box) {
        var chboxs = document.getElementsByName("order_id[]");
        var vis = "none";
        for (var i = 0; i < chboxs.length; i++) {
            if (chboxs[i].checked) {
                vis = "block";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
    }
    $(document).ready(function () {
        $('#infon-car-grid_c0_all').change(function () {
            if (this.checked)
                $('.autoUpdate').fadeIn('slow');
            else
                $('.autoUpdate').fadeOut('slow');

        });
    });
</script>
<div id="view"></div>
<?php
if (isset($_GET['share'])) {
    ?>
    <form action="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/Order&share=4&status=<?= $_GET['status'] ?>" method="post">
        <?php
    } else {
        ?>
        <form action="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/Order&status=<?= $_GET['status'] ?>" method="post">
            <?php
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> 
                    <?php
                    if (Yii::app()->session['admin_sale_branch']) {
                        $branch = Branch::model()->findByPk(Yii::app()->session['admin_sale_branch']);
                    } else {
                        $branch = Branch::model()->findByPk(User::model()->findByPk(Yii::app()->user->id)->branch_id);
                    }
                    ?>
                    <?= ($_GET['status'] == 4) ? 'ລາຍ​ການ​ລົດ​ທີ່​ຈະ​ແບ່ງ​ໃຫ້​ສາ​ຂາຂອງ ສາ​ຂາ ' . $branch->branch_name . '' : 'ລາຍ​ການ​ລົດ​ທີ່​ຈະ​ຂາຍຂອງ ສາ​ຂາ ' . $branch->branch_name . '' ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (empty(Yii::app()->session['order_car']) && empty(Yii::app()->session['share']) && count(Yii::app()->session['order_car']) > 0) {
                            ?>
                            <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/orderList" class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span>ຈຳ​ນວນ​ທີ່​ສັ່ງ​ຈະ​ສົງ​ຫາ​ສາ​ຂາ (<?= count(Yii::app()->session['order_car']) ?>)</a></div>
                            <?php
                        } elseif (!empty(Yii::app()->session['order_car']) && count(Yii::app()->session['order_car']) > 0) {
                            ;
                            ?>
                            <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/orderList" class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span>ຈຳ​ນວນ​ທີ່​ສັ່ງ​ຊື້ (<?= count(Yii::app()->session['order_car']) ?>)</a></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id' => 'infon-car-grid',
                'dataProvider' => $model->search1(),
                'template' => '{items}{pager}',
                'ajaxUpdate' => 'false',
                'filter' => $model,
                'columns' => array(
                    array(
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => 2,
                        'value' => '$data->id',
                        'checkBoxHtmlOptions' => array(
                            'name' => 'order_id[]',
                            'onclick' => "showMe('div1')"
                        ),
                    ),
                    'car_code_2',
                    array(
                        'name' => 'generation',
                    ),
                    array(
                        'name' => 'brand',
                    ),
                    array(
                        'name' => 'color',
                    ),
                    array(
                        'name' => 'car_price_sale',
                        'value' => 'number_format($data->car_price_sale,2)',
                        'filter' => false,
                    ),
                    array(
                        'class' => 'bootstrap.widgets.BsButtonColumn',
                        'template' => '{view} {buy}',
                        'buttons' => array(
                            'view' => array(
                                'label' => 'ເບີ່ງ​ລາຍ​ລະ​ອຽດ',
                                'url' => 'Yii::app()->createUrl("infonCar/viewsale", array("id"=>$data->id))',
                                'options' => array(
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url' => "js:$(this).attr('href')", // ajax post will use 'url' specified above
                                        'update' => '#view'
                                    ),
                                    'class' => 'btn btn-primary',
                                ),
                            ),
                            'buy' => array(
                                'url' => isset($_GET['share']) ? 'Yii::app()->createUrl("infonCar/order", array("id"=>$data->id,"share"=>4,"status"=>' . $_GET['status'] . '))' : 'Yii::app()->createUrl("infonCar/order", array("id"=>$data->id,"status"=>' . $_GET['status'] . '))',
                                'label' => 'ຊື້',
                                'icon' => BsHtml::GLYPHICON_SHOPPING_CART,
                                'options' => array(
                                    'class' => 'btn btn-success',
                                ),
                            ),
                            'delete' => array(
                                // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                                'options' => array(
                                    'class' => 'btn btn-danger',
                                ),
                            ),
                        ),
                        'htmlOptions' => array('width' => 150),
                    ),
                ),
            ));
            ?>
            <div id="div1" style="display:none" class="autoUpdate"><button type="submit" name="order" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span><?php
                    if (isset($_GET['share'])) {
                        echo "ແບ່ງ​ໃຫ້​ສາ​ຂາ";
                    } else {
                        echo "ສັ່ງຊື້";
                    }
                    ?></button></div>
        </div>
    </form>