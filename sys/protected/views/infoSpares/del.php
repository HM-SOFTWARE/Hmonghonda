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
            echo "ລືບອາ​ໄຫຼ່ທີ່​ຂາຍແລ້ວ ສາ​ຂາ " . $branch->branch_name . "";
            ?></h3>
    </div>
    <div class="panel-body">
        <div class="row ">

        </div>
    </div>
    <?php
    $this->widget('bootstrap.widgets.BsGridView', array(
        'id' => 'infon-car-grid',
        'dataProvider' => $model->searchdel(),
        'afterAjaxUpdate' => "function(){jQuery('#event_date_search').datepicker({'dateFormat': 'yy-mm-dd'})}",
        'template' => '{items}{pager}',
        'ajaxUpdate' => 'false',
        'filter' => $model,
        'columns' => array(
            array(
                'name' => 'date',
                'header' => 'ວັນ​ມີ​ຂາຍ',
                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'date',
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
                'name' => 'info_spares_id',
                'value' => '$data->infoSpares->spare_code',
                'header' => 'ລະ​ຫັດ​ອາ​ໄຫຼ່',
                'filter' => false,
            ),
            array(
                'name' => 'info_spares_id',
                'value' => '$data->infoSpares->spare_name',
                'header' => 'ຊື່ອາ​ໄຫຼ່',
                'filter' => false,
            ),
            array(
                'name' => 'qautity',
                'value' => '$data->qautity',
                'header' => 'ຈຳ​ນວນ',
                'filter' => false,
            ),
            array(
                'name' => 'paid',
                'value' => 'number_format($data->paid, 2)',
                'header' => 'ຈຳ​ນວນເງີນ',
                'filter' => false,
            ),
            array(
                'name' => 'customer_id',
                'value' => '$data->customer->first_name. " ".  $data->customer->last_name',
                'header' => 'ຜູ້​ຊື້',
                'filter' => false,
            ),
            array(
                'class' => 'bootstrap.widgets.BsButtonColumn',
                'template' => '{cancle} {delete}',
                'buttons' => array(
                    'cancle' => array(
                        'url' => 'Yii::app()->createUrl("infoSpares/canclesale", array("branch_id"=>' . $_GET['branc_id'] . ',"id"=>$data->info_spares_id ,"qautity"=>$data->qautity,"cus_id"=>$data->customer_id))',
                        'label' => 'ຍົກ​ເລີກ​ອາ​ໄຫຼ່ທີ​ຂາຍ​ແລ້ວ',
                        'icon' => BsHtml::GLYPHICON_REFRESH,
                        'options' => array(
                            'class' => 'btn btn-success',
                        ),
                    //  'visible' => Yii::app()->user->checkAccess('Admin') ? 'true' : '($data->status=="Pending")?true:false'
                    ),
                    'delete' => array(
                        'url' => 'Yii::app()->createUrl("infoSpares/delsale", array("id"=>$data->id))',
                        'label' => 'ລຶບ​ອອກ',
                        'options' => array(
                            'class' => 'btn btn-danger',
                        ),
                    ),
                ),
                'htmlOptions' => array('width' => 200, 'align' => 'right'),
            ),
        ),
    ));
    ?>
</div>
<?php
if (Yii::app()->user->hasFlash('success')) {
    $this->renderPartial('success');
}
?>