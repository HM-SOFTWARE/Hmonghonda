<?php
/* @var $this AcountTransferController */
/* @var $model AcountTransfer */
$this->layout = NULL;

$this->breadcrumbs = array(
    'Acount Transfers' => array('index'),
    'Manage',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List AcountTransfer', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create AcountTransfer', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#acount-transfer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ຂໍ້​ມູນ​ເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=acountTransfer/create" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>ເພີ່ມ​ເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</a></div>
        </div>
    </div>
    <div class="panel-body">

        <?php
        if (Yii::app()->user->checkAccess('Admin')) {
            $data = Branch::model()->findAll();
        } else {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $data = Branch::model()->findAll('id=' . $user->branch_id . '');
        }
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'acount-transfer-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'afterAjaxUpdate' => "function(){jQuery('#date').datepicker({'dateFormat': 'yy-mm-dd'})} ",
            'columns' => array(
                array(
                    'name' => 'id',
                    'filter' => false,
                ),
                array(
                    'name' => 'name',
                    'filter' => false,
                ),
                array(
                    'name' => 'amount',
                    'value' => 'number_format($data->amount,2)',
                    'filter' => false,
                ),
                array(
                    'name' => 'date',
                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'date',
                        'htmlOptions' => array(
                            'id' => 'date',
                            'class' => 'form-control',
                        ),
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'showOtherMonths' => true,
                            'selectOtherMonths' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                        )
                            ), true)
                ),
                array(
                    'name' => 'branch_id',
                    'value' => 'Branch::model()->findByPk($data->branch_id)->branch_name',
                    'filter' => CHtml::listData($data, 'id', 'branch_name'),
                ),
                array(
                    'class' => 'bootstrap.widgets.BsButtonColumn',
                    'template' => '{lock} {view} {update} {delete}',
                    'buttons' => array(
                        'lock' => array(
                            'url' => 'Yii::app()->createUrl("acountTransfer/lock", array("id"=>$data->id))',
                            'icon' => BsHtml::GLYPHICON_LOCK,
                            'options' => array(
                                'class' => 'btn btn-success',
                            ),
                            'visible' => Yii::app()->user->checkAccess('Admin') ? '($data->status=="Approve")?true:false' : 'false'
                        ),
                        'view' => array(
                            'options' => array(
                                'class' => 'btn btn-primary',
                            ),
                        ),
                        'update' => array(
                            // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                            'options' => array(
                                'class' => 'btn btn-success',
                            ),
                            'visible' => Yii::app()->user->checkAccess('Admin') ? 'true' : '($data->status=="Pending")?true:false'
                        ),
                        'delete' => array(
                            // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
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
</div>




