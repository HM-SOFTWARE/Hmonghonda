<?php
/* @var $this BgController */
/* @var $model Bg */

$this->layout = NULL;
$this->breadcrumbs = array(
    'Bgs' => array('index'),
    'Manage',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Bg', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Bg', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bg-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ຮູບ​ພາບ</h3>
    </div>
    <!--  <div class="row">
          <div class="col-md-12">
              <div align="right"><a href="<?= Yii::app()->baseUrl ?>/index.php?r=bg/create" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>ເພີ່ມ​ຮູບ​ພາບ</a></div>
          </div>
      </div>-->
    <div class="panel-body" >

        <?php
        if (Yii::app()->user->checkAccess('Admin')) {
            $data = Branch::model()->findAll();
        } else {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $data = Branch::model()->findAll('id=' . $user->branch_id . '');
        }
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'payment-in-grid',
            'type' => 'striped bordered condensed',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'afterAjaxUpdate' => "function(){jQuery('#date').datepicker({'dateFormat': 'yy-mm-dd'})} ",
            'columns' => array(
                array(
                    'name' => 'id',
                    'headerHtmlOptions' => array('style' => "width:50px;"),
                    'filter' => false,
                ),
                array(
                    'name' => 'photo',
                    //  'value' => ' CHtml::image(Yii::app()->baseUrl."/files/slide/".$data->image)',
                    'value' => ' CHtml::image(Yii::app()->baseUrl."/images/".$data->photo," ", array("class" => "img-responsive" ,"id"=>"img")) ',
                    'type' => 'raw'
                ),
                array(
                    'class' => 'bootstrap.widgets.BsButtonColumn',
                    'template' => '{update}',
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
                    'htmlOptions' => array('width' => 200, 'align' => 'right'),
                ),
            ),
        ));
        ?>
    </div>
</div>
