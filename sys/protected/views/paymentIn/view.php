<?php

/* @var $this PaymentInController */
/* @var $model PaymentIn */
$this->layout = NULL;
?>

<?php

$this->breadcrumbs = array(
    'Payment Ins' => array('index'),
    $model->id,
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List PaymentIn', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create PaymentIn', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update PaymentIn', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete PaymentIn', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage PaymentIn', 'url' => array('admin')),
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
        'detail',
        array(
            'name' => 'amonut',
            'value' => number_format($model->amonut, 2),
        ),
        'date',
        array(
            'name' => 'branch_id',
            'value' => Branch::model()->findByPk($model->branch_id)->branch_name,
        ),
    ),
));
?>