<?php

/* @var $this AcountTransferController */
/* @var $model AcountTransfer */
$this->layout = NULL;
?>

<?php

$this->breadcrumbs = array(
    'Acount Transfers' => array('index'),
    $model->name,
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List AcountTransfer', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create AcountTransfer', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update AcountTransfer', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete AcountTransfer', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage AcountTransfer', 'url' => array('admin')),
);
?>

<?php

$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        array(
            'name' => 'amount',
            'value' => number_format($model->amount, 2),
        ),
        'date',
        array(
            'name' => 'branch_id',
            'value' => Branch::model()->findByPk($model->branch_id)->branch_name,
        ),
    ),
));
?>