<?php
/* @var $this InfoSparesController */
/* @var $model InfoSpares */
?>

<?php
$this->breadcrumbs = array(
    'Info Spares' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List InfoSpares', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create InfoSpares', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View InfoSpares', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage InfoSpares', 'url' => array('admin')),
);
?>

<div class="row" style="padding-bottom: 10px;">
    <fieldset class="scheduler-border"> 
        <legend style="font-size: 18px;"><b><?= Yii::t('app', 'ແກ້​ໄຂໄຫຼ່ເຂົ້າ') ?></b></legend>
        <div class="col-md-12">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </fieldset>
</div>