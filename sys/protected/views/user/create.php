<?php
/* @var $this UserController */
/* @var $model User */
$this->layout = NULL;
?>

<?php
$this->breadcrumbs = array(
    'Users' => array('index'),
    'Create',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List User', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage User', 'url' => array('admin')),
);
?>
<div class="row" style="padding-bottom: 10px;">
    <fieldset class="scheduler-border"> 
        <legend style="font-size: 18px;"><b><?= Yii::t('app', 'ສ້າງ​ຜູ້​ເຂົ້າ​ລະ​ບົບ') ?></b></legend>
        <div class="col-md-12">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </fieldset>
</div>