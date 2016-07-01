<?php
/* @var $this CustomerController */
/* @var $model Customer */
?>

<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Customer', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Customer', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Customer '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'address',
		'phone_1',
		'phone_2',
		'district_id',
		'date',
		'province_id',
	),
)); ?>