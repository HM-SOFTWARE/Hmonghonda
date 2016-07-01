<?php

/* @var $this PaymentInController */
/* @var $model PaymentIn */
?>

<?php

$this->breadcrumbs = array(
    'Payment Ins' => array('index'),
    'Create',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List PaymentIn', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage PaymentIn', 'url' => array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>