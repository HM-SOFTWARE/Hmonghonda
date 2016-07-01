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
                <h4 class="modal-title" id="myModalLabel" style="color: red"><?php echo Yii::t('app', "ມີ​ຂໍ້ຜິດ​ພາດ​ລະ​ບົບ​ບໍໍ່​ອະ​ນຸ​ຍາດ") ?></h4>
            </div>
            <div class="modal-body" style="color: red">
                ການ​ປັອນ​ລາຍ​ລະ​ອຽດ​ມີ​ຂໍ້​ຜິດ​ພາດ​ໃນ​ແຖວ​ທີ <?= $key ?>. ກະ​ລຸ​ນາ​ກວດ​ຄືນ​ການ​ປ້ອນ​ຂໍ້​ມູ​ນ
            </div>
        </div>
    </div>
</div>