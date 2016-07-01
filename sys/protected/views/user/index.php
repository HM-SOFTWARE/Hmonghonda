<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
$this->layout = NULL;
?>

<?php
$this->breadcrumbs = array(
    'Users',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create User', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage User', 'url' => array('admin')),
);
?>
<fieldset class="scheduler-border"> 
    <legend style="font-size: 18px;"><b><?= Yii::t('app', 'ລາຍ​ການ​ຜູ້​ເຂົ້າ​ລະ​ບົບ') ?></b></legend>
    <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=user/create" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>ເພີ່ມ​ຜູ້​ເຂົ້າ​ລະ​ບົບ</a></div>

    <?php
    $this->widget('bootstrap.widgets.BsGridView', array(
        'id' => 'user-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'template' => '{items}{pager}',
        'columns' => array(
            'id',
            'username',
            array(
                'name' => 'user_type',
                'filter' => array('Admin' => 'Admin', 'User' => 'User'),
            ),
            array(
                'name' => 'branch_id',
                'value' => 'empty($data->branch_id)?"":$data->branch->branch_name',
                'filter' => CHtml::listData(Branch::model()->findAll(), 'id', 'branch_name'),
            ),
            array(
                'class' => 'bootstrap.widgets.BsButtonColumn',
                'template' => '{update} {delete}',
                'buttons' => array(
                    'update' => array(
                        // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'btn btn-success',
                        ),
                    ),
                    'delete' => array(
                        // 'url' => 'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'btn btn-danger',
                        ),
                    ),
                ),
                'htmlOptions' => array('width' => 120),
            ),
        ),
    ));
    ?>
</fieldset>