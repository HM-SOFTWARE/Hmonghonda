
<!--<link rel="stylesheet" href="slide/css/main.css">
<style>
<?php
$bgs = Bg::model()->findAll();
if (!empty($bgs)) {
    $i = 0;
    foreach ($bgs as $bg) {
        $i++;
        if ($i == 1) {
            ?>
                                                                                                                                                                                                                                                    .crossfade > figure:nth-child(1) {
                                                                                                                                                                                                                                                        background-image: url('<?= Yii::app()->baseUrl ?>/images/<?= $bg->photo ?>');
                                                                                                                                                                                                                                                    }
            <?php
        } elseif ($i == 2) {
            ?>
                                                                                                                                                                                                                                                    .crossfade > figure:nth-child(2) {
                                                                                                                                                                                                                                                        animation-delay:6s;
                                                                                                                                                                                                                                                        background-image: url('<?= Yii::app()->baseUrl ?>/images/<?= $bg->photo ?>');
                                                                                                                                                                                                                                                    }
            <?php
        } else {
            ?>
                                                                                                                                                                                                                                                    .crossfade > figure:nth-child(<?= $i ?>) {
                                                                                                                                                                                                                                                        animation-delay:<?= 6 * ($i - 1) ?>s;
                                                                                                                                                                                                                                                        background-image: url('<?= Yii::app()->baseUrl ?>/images/<?= $bg->photo ?>');
                                                                                                                                                                                                                                                    }
            <?php
        }
    }
}
?>
</style>
<div class="crossfade">
<?php
$bgs = Bg::model()->findAll();
if (!empty($bgs)) {
    foreach ($bgs as $bg) {
        ?>
                                                                                                                                                                    <figure></figure>
        <?php
    }
}
?>
</div>-->
<?php
$bg = Bg::model()->findByPk(8);
?>
<style>
    #hg { 
        background: url(<?= Yii::app()->baseUrl ?>/images/<?= $bg->photo ?>) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 700px !important;
    }
</style>
<div class="row" style="height: 800px !important;" id="hg">
    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"> 
        <div align="center" ><img src="images/2.png" class="img-responsive" width="500"></div>
        <br/>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">

            <a href="/sys/index.php?r=infonCar/reportsalecar&rs=1">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-cloud"></span>
                    <b> ສະຫຼຸບລົດທີ່ຂາຍແລ້ວ</b>
                </div>
            </a>

            <a href="/sys/index.php?r=infonCar/reportcar">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-apple"></span>
                    <b>  ສະຫຼຸບລົດທີ່ຍັງເຫຼຶອ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=infonCar/reportshare">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-file"></span>
                    <b>ສະຫຼຸບລົດທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</b>
                </div>
            </a>

            <a href="/sys/index.php?r=infonCar/Payment">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-barcode"></span>
                    <b> ​ຊຳລະຄ່າ​ລົດ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=infonCar/listrunpai">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-rub"></span>
                    ​<b>ລົດ​ທີ່​ແລ່ນ​ປ້າຍ</b>
                </div>
            </a>

        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <a href="/sys/index.php?r=infoSpares/reportsalecar">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-bullhorn"></span>
                    <b> ສະຫຼຸບອາ​ໄຫຼ່ທີ່ຂາຍແລ້ວ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=infoSpares/reportcar">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-pawn"></span>
                    <b>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ຍັງເຫຼຶອ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=infoSpares/reportshare">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-briefcase"></span>
                    <b>  ສະຫຼຸບອາ​ໄຫຼ່ທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</b>
                </div>
            </a>

            <a href="/sys/index.php?r=infoSpares/reportbycount">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-file"></span>
                    <b> ສະຫຼຸບອາ​ໄຫຼ່​ຕາມ​ຈຳ​ນວນ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=infonCar/cardaocash">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-file"></span>
                    <b> ສະຫຼຸບລົດ​ດາວ​ຈ່າຍ​ດ້ວຍ​ເງີນ​ສົດ</b>
                </div>
            </a>

        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <a href="/sys/index.php?r=acountTransfer/reporttransfer">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-transfer"></span>
                    <b> ສະຫຼຸບເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=paymentIn/reportpayin">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-grain"></span>
                    <b> ສະຫຼຸບລາຍ​ຈ່າຍ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=infonCar/reportdailybydate">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-usd"></span>
                    <b>ລາຍ​ຮັ​ບ​ລາຍ​ວັນ</b>
                </div>
            </a>
            <a href="/sys/index.php?r=customer/listdept">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-user"></span>
                    <b>  ລາຍ​ຊື່​ລູກ​ຄ້າ​ທີ​ຍັງ​ບໍ່​ໄດ້ມາຊຳ​ລະໜີ້</b>
                </div>
            </a>
        </div>
    </div>
</div>
