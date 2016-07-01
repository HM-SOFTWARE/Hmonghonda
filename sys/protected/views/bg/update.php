<?php

/* @var $this BgController */
/* @var $model Bg */
$this->layout = NULL;
?>
<?php

$this->breadcrumbs = array(
    'Bgs' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Bg', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Bg', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Bg', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Bg', 'url' => array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update', 'Bg ' . $model->id) ?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>