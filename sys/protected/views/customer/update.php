<?php
/* @var $this CustomerController */
/* @var $model Customer */
?>

<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Customer', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Customer', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Customer', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Customer '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>