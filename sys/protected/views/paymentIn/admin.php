<?php
/* @var $this PaymentInController */
/* @var $model PaymentIn */

$this->layout = NULL;
$this->breadcrumbs = array(
    'Payment Ins' => array('index'),
    'Manage',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List PaymentIn', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create PaymentIn', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#payment-in-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ລາຍ​ຈ່າຍ</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=paymentIn/create" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>ເພີ່ມ​ລາຍ​ຈ່າຍ</a></div>
        </div>
    </div>
    <div class="panel-body" >

        <?php
        if (Yii::app()->user->checkAccess('Admin')) {
            $data = Branch::model()->findAll();
        } else {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $data = Branch::model()->findAll('id=' . $user->branch_id . '');
        }
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'payment-in-grid',
            'type' => 'striped bordered condensed',
            'dataProvider' => $model->search1(),
            'filter' => $model,
            'afterAjaxUpdate' => "function(){jQuery('#date').datepicker({'dateFormat': 'yy-mm-dd'})} ",
            'columns' => array(
                array(
                    'name' => 'id',
                    'headerHtmlOptions' => array('style' => "width:50px;"),
                    'filter' => false,
                ),
                array(
                    //  'htmlOptions' => array('width' => 350),
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
                    'name' => 'detail',
                    'filter' => false,
                //  'footer' => '<b>ລວມ​ຈຳ​ນວນ​ເງີນ</b>'
                ),
                array(
                    'name' => 'amonut',
                    'value' => 'number_format($data->amonut,2)',
                    'filter' => false,
                //  'footer' => '<b>' . $model->getTotal($model->search()->getData(), 'amonut') . '</b>',
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
                            'url' => 'Yii::app()->createUrl("paymentIn/lock", array("id"=>$data->id))',
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




