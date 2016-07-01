<?php
/* @var $this InfonCarController */
/* @var $model InfonCar */
?>

<?php
$this->breadcrumbs = array(
    'Infon Cars' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List InfonCar', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create InfonCar', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View InfonCar', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage InfonCar', 'url' => array('admin')),
);
?>
<div class="row" style="padding-bottom: 10px;">
    <fieldset class="scheduler-border"> 
        <legend style="font-size: 18px;"><b><?= Yii::t('app', 'ເອົາ​ລົດ​ເຂົ້າ') ?></b></legend>
        <div class="col-md-12">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </fieldset>
</div>