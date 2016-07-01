<?php
/* @var $this InfonCarController */
/* @var $model InfonCar */


$this->breadcrumbs = array(
    'Infon Cars' => array('index'),
    'Manage',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List InfonCar', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create InfonCar', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#infon-car-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Manage', 'Infon Cars') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Advanced search', array('class' => 'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH, 'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div>
        <!-- search-form -->

        <?php
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'infon-car-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'id',
                'car_code_1',
                'car_code_2',
                'car_type_id',
                /*
                  'car_generation_id',
                  'car_color_id',
                  'date_in',
                  'date_out',
                  'branch_id',
                  'car_or_spare_status_id',
                  'Brand_id',
                  'user_id',
                 */
                array(
                    'class' => 'bootstrap.widgets.BsButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>




