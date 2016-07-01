<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php
            if (Yii::app()->session['admin_sale_branch']) {
                $branch = Branch::model()->findByPk(Yii::app()->session['admin_sale_branch']);
            } else {
                $branch = Branch::model()->findByPk(User::model()->findByPk(Yii::app()->user->id)->branch_id);
            }
            echo "ລາຍ​ຊື່​ລູກ​ຄ້າ​ທີ​ຍັງ​ບໍ່​ໄດ້ມາຈ່າຍໜີ້​ໃນເດືອນ ";
            ?>
            <?= isset($_POST['date']) ? date('m', strtotime($_POST['date'])) : date('m') ?>
        </h3>
    </div>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'infon-car-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <div style="padding: 5px">
        <?php
        $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', array(
            'name' => 'date',
            'value' => isset($_POST['date']) ? $_POST['date'] : "",
            'options' => array(
                'yearRange' => '-5:+15',
                'dateFormat' => 'yy-mm',
                'yearRange' => '2016:' . date('Y') . '',
            ),
            'htmlOptions' => array(
                'onChange' => 'js:doSomething()',
            ),
        ));
        ?>
        <button type="submit" name="search" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span> ຄົ້ນ​ຫາ</button>
    </div>
    <?php $this->endWidget(); ?>
    <table class="table table-stri ped">
        <tr>
            <th>
                ລຳ​ດັບ
            </th>
            <th>ລະ​ຫັດ​ລູກ​ຄ້າ</th>
            <th>ຊື່ ແລະ​ ນາມສະ​ກຸນ</th>
            <th>ເບີ​ໂທ</th>
            <th>ທີ​ຢູ່</th>
            <th>ສາ​ຂາ</th>
        </tr>
        <?php
        $i = 0;
        foreach ($models as $model) {
            $i++;
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= sprintf('%06d', $model->customer_id) ?></td>
                <td><?= $model->customer->first_name . " " . $model->customer->last_name ?></td>
                <td><?php
                    echo $model->customer->phone_1 . ', ' . $model->customer->phone_2;
                    ?></td>
                <td>
                    <?php
                    echo 'ແຂວງ ' . $model->customer->province->province_name . ', ເມືອງ ' . $model->customer->district->district_name . ', ບ້ານ ' . $model->customer->address;
                    ?>
                </td>
                <td><?= $model->infonCar->branch->branch_name ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>