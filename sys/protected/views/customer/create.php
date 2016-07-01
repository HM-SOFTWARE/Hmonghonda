<?php
/* @var $this CustomerController */
/* @var $model Customer */
?>

<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Customer', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Customer') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>