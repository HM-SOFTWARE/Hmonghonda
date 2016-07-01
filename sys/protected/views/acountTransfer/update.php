<?php

/* @var $this PaymentInController */
/* @var $model PaymentIn */
?>

<?php

$this->breadcrumbs = array(
    'Payment Ins' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List PaymentIn', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create PaymentIn', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View PaymentIn', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage PaymentIn', 'url' => array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>