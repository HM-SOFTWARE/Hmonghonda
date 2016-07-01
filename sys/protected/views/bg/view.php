<?php
/* @var $this BgController */
/* @var $model Bg */
?>

<?php
$this->breadcrumbs=array(
	'Bgs'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Bg', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Bg', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Bg', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Bg', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Bg', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Bg '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'photo',
		'date',
	),
)); ?>