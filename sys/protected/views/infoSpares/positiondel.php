<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            show: true,
        })
    });
</script>
<div style="top:1%;" class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('app', "ລືບ​ຕຳ​ແໜງ​ອາ​ໄຫຼ່ອອກ") ?></h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ລຳ​ດັບ</th>
                        <th>ຊື່</th>
                        <th>ລືບ</th>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($model as $models) {
                        $i++;
                        ?>
                        <tr> 
                            <td><?= $i ?></td>
                            <td><?= $models->name ?></td>
                            <td><?= CHtml::link('<span class="glyphicon glyphicon-remove"></span>', array('infoSpares/positiondel', 'del' => $models->id)) ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>