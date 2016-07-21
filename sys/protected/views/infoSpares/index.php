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
            echo "ລາຍ​ການ​ອາ​ໄຫຼ່ທີ່​ເອົາ​ເຂົ້າແລ້ວ ສາ​ຂາ " . $branch->branch_name . "";
            ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/create" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>ເພີ່ມ​ອາ​ໄຫຼ່ເຂົ້າ​ລະ​ບົບ</a></div>
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
            'number_come',
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
            array(
                'name' => 'type_spares',
            ),
            'spare_code',
            'spare_name',
            'qautity',
            array(
                'name' => 'car_or_spare_status_id',
                'value' => 'CarOrSpareStatus::model()->findByPk($data->car_or_spare_status_id)->status',
                'filter' => CHtml::listData(CarOrSpareStatus::model()->findAll('id!=3'), 'id', 'status')
            ),
            array(
                'class' => 'bootstrap.widgets.BsButtonColumn',
                'template' => '{quatity_old} {quatity_new} {lock} {view} {update} {delete}',
                'buttons' => array(
                    'lock' => array(
                        'url' => 'Yii::app()->createUrl("infoSpares/lock", array("id"=>$data->id))',
                        'icon' => BsHtml::GLYPHICON_LOCK,
                        'options' => array(
                            'class' => 'btn btn-success btn-sm',
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
                            'class' => 'btn btn-primary btn-sm',
                        ),
                    ),
                    'quatity_old' => array(
                        'label' => 'ແກ້​ໄຂຈຳ​ນວນປ້ອນ​ຜິດ',
                        'icon' => BsHtml::GLYPHICON_BRIEFCASE,
                        'url' => 'Yii::app()->createUrl("infoSpares/qtt", array("id"=>$data->id,insert_last=>0))',
                        'options' => array(
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => "js:$(this).attr('href')", // ajax post will use 'url' specified above
                                'update' => '#view'
                            ),
                            'class' => 'btn btn-danger btn-sm',
                        ),
                        'visible' => Yii::app()->user->checkAccess('Admin') ? 'true' : 'false',
                    ),
                    'quatity_new' => array(
                        'label' => 'ເພີ່ມ​ຈຳ​ນວນເຂົ້າ​ໃໜ່',
                        'icon' => BsHtml::GLYPHICON_FLAG,
                        'url' => 'Yii::app()->createUrl("infoSpares/qtt", array("id"=>$data->id,insert_last=>1))',
                        'options' => array(
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => "js:$(this).attr('href')", // ajax post will use 'url' specified above
                                'update' => '#view'
                            ),
                            'class' => 'btn btn-success btn-sm',
                        ),
                        'visible' => Yii::app()->user->checkAccess('Admin') ? 'false' : 'true',
                    ),
                    'update' => array(
                        'label' => 'ແກ​້​ໄຂ',
                        // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'btn btn-success btn-sm',
                        ),
                        'visible' => Yii::app()->user->checkAccess('Admin') ? 'true' : '($data->status=="Pending")?true:false'
                    ),
                    'delete' => array(
                        // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                        'label' => 'ລຶບ​ອອກ',
                        'options' => array(
                            'class' => 'btn btn-danger btn-sm',
                        ),
                        'visible' => Yii::app()->user->checkAccess('Admin') ? 'true' : '($data->status=="Pending")?true:false'
                    ),
                ),
                'htmlOptions' => array('width' => 220, 'align' => 'right'),
            ),
        ),
    ));
    ?>
</div>