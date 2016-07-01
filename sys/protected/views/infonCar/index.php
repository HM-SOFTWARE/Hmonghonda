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
<div id="view"></div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> <?php
            if (Yii::app()->session['admin_sale_branch']) {
                $branch = Branch::model()->findByPk(Yii::app()->session['admin_sale_branch']);
            } else {
                $branch = Branch::model()->findByPk(User::model()->findByPk(Yii::app()->user->id)->branch_id);
            }
            echo "ລາຍ​ການ​ລົດ​ທີ່​ເອົາ​ເຂົ້າແລ້ວ ສາ​ຂາ " . $branch->branch_name . "";
            ?></h3>
    </div>
    <div class="panel-body">
        <div class="row ">
            <div class="col-md-12">
                <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/create" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>ເພີ່ມ​ລົດ​ເຂົ້າ​ລະ​ບົບ</a></div>
            </div>
        </div>
    </div>
    <?php
    $this->widget('bootstrap.widgets.BsGridView', array(
        'id' => 'infon-car-grid',
        'dataProvider' => $model->search(),
        'afterAjaxUpdate' => "function(){jQuery('#event_date_search').datepicker({'dateFormat': 'yy-mm-dd','changeMonth':true,'changeYear':true})}",
        'template' => '{items}{pager}',
        'ajaxUpdate' => 'false',
        'filter' => $model,
        'columns' => array(
            'number_com',
            array(
                'name' => 'date_in',
                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'date_in',
                    'htmlOptions' => array(
                        'id' => 'event_date_search',
                        'class' => 'form-control',
                    ),
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '2000:2099',
                        'minDate' => '2000-01-01', // minimum date
                        'maxDate' => '2099-12-31', // maximum date
                    )
                        ), true)
            ),
            'car_code_1',
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
                'value' => 'number_format($data->car_price_sale, 2)',
                'filter' => false,
            ),
            array(
                'name' => 'duc_com',
                'type' => 'raw',
                'value' => 'InfonCar::checkd($data->duc_com,$data->id)',
                'filter' => false,
                'htmlOptions' => array('width' => 110, 'align' => 'left'),
            ),
            array(
                'class' => 'bootstrap.widgets.BsButtonColumn',
                'template' => '{lock} {view} {update} {delete}',
                'buttons' => array(
                    'lock' => array(
                        'label' => 'ເປິດ​ລອກ',
                        'url' => 'Yii::app()->createUrl("infonCar/lock", array("id"=>$data->id))',
                        'icon' => BsHtml::GLYPHICON_LOCK,
                        'options' => array(
                            'class' => 'btn btn-success',
                        ),
                        'visible' => Yii::app()->user->checkAccess('Admin') ? '($data->status=="Approve")?true:false' : 'false'
                    ),
                    'view' => array(
                        'label' => 'ເບີ່ງ​ລາຍ​ລະ​ອຽດ',
                        'options' => array(
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => "js:$(this).attr('href')", // ajax post will use 'url' specified above
                                'update' => '#view'
                            ),
                            'class' => 'btn btn-primary',
                        ),
                    ),
                    'update' => array(
                        'label' => 'ແກ​້​ໄຂ',
                        // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'btn btn-success',
                        ),
                        'visible' => Yii::app()->user->checkAccess('Admin') ? 'true' : '($data->status=="Pending")?true:false'
                    ),
                    'delete' => array(
                        // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                        'label' => 'ລຶບ​ອອກ',
                        'options' => array(
                            'class' => 'btn btn-danger',
                        ),
                        'visible' => Yii::app()->user->checkAccess('Admin') ? 'true' : '($data->status=="Pending")?true:false'
                    ),
                ),
                'htmlOptions' => array('width' => 200, 'align' => 'right'),
            ),
        ),
    ));
    ?>
</div>