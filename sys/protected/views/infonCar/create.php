<?php
/* @var $this InfonCarController */
/* @var $model InfonCar */
$this->layout = NULL;
?>

<?php
$this->breadcrumbs = array(
    'Infon Cars' => array('index'),
    'Create',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List InfonCar', 'url' => array('index')),
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