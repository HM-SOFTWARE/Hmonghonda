<?php
/* @var $this UserController */
/* @var $model User */
$this->layout = NULL;
?>

<?php
$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List User', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create User', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View User', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage User', 'url' => array('admin')),
);
?>
<div class="row" style="padding-bottom: 10px;">
    <fieldset class="scheduler-border"> 
        <legend style="font-size: 18px;"><b><?= Yii::t('app', 'ແກ້​ໄຂຜູ້​ເຂົ້າ​ລະ​ບົບ') ?></b></legend>
        <div class="col-md-12">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </fieldset>
</div>