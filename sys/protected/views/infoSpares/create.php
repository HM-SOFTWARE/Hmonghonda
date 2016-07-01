<?php
/* @var $this InfoSparesController */
/* @var $model InfoSpares */
?>

<?php
$this->breadcrumbs = array(
    'Info Spares' => array('index'),
    'Create',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List InfoSpares', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage InfoSpares', 'url' => array('admin')),
);
?>

<div class="row" style="padding-bottom: 10px;">
    <fieldset class="scheduler-border"> 
        <legend style="font-size: 18px;"><b><?= Yii::t('app', 'ເອົາ​ອາ​ໄຫຼ່ເຂົ້າ') ?></b></legend>
        <div class="col-md-12">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </fieldset>
</div>