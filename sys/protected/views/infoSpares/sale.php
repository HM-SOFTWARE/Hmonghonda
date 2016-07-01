<?php
/* @var $this InfoSparesController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs = array(
    'Info Spares',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create InfoSpares', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage InfoSpares', 'url' => array('admin')),
);
?>
<div id="view"></div>
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
            <?= Yii::t('app', 'ລາຍ​ການ​ອາ​ໄຫຼ່ທີ່​ຈະ​ຂາຍ​ຂອງ ສາ​ຂາ ' . $branch->branch_name . '') ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/orderList" class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span>ຈຳ​ນວນ​ທີ່​ສັ່ງ​ຊື່ (<?= count(Yii::app()->session['order_spares']) ?>)</a></div>
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
                'name' => 'type_spares',
            //   'value' => 'TypeSpares::model()->findByPk($data->type_spares_id)->type_name',
            //    'filter' => CHtml::listData(TypeSpares::model()->findAll(), 'id', 'type_name')
            ),
            'spare_code',
            array(
                'name' => 'spare_name',
                'filter' => false
            ),
            array(
                'name' => 'qautity',
                'filter' => false
            ),
            array(
                'name' => 'spare_price_sale',
                'value' => ' number_format($data->spare_price_sale,2)',
                'filter' => false,
            ),
            array(
                'class' => 'bootstrap.widgets.BsButtonColumn',
                'template' => '{view} {buy}',
                'buttons' => array(
                    'view' => array(
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
                        'url' => 'Yii::app()->createUrl("infoSpares/order", array("id"=>$data->id))',
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
</div>