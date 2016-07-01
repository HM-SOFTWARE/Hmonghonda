<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">
        <!-- Font Awesome -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->

        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/css/style.css">
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/bootstrap/css/bootstrap.css">
        <?php
        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery', CClientScript::POS_END);
        $cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
        ?>
        <title><?php echo "FAJTIMHMOOB HONDA"; ?></title>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper" id="page">
            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>H</b>HD</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>FAJTIMHMOOB</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="dist/img/Icon-user.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">
                                        <?php
                                        if (isset(Yii::app()->user->id)) {
                                            $user = User::model()->findByPk(Yii::app()->user->id);
                                            if ($user->user_type == "User") {
                                                echo Branch::model()->findByPk($user->branch_id)->branch_name;
                                            } else {
                                                echo $user->first_name;
                                            }
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="dist/img/Icon-user.png" class="img-circle" alt="User Image">

                                        <p>
                                            <?php
                                            $user = User::model()->findByPk(Yii::app()->user->id);
                                            echo $user->first_name;
                                            ?>
                                            <small><?php echo date('d-m-Y'); ?></small>
                                        </p>
                                    </li>

                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= Yii::app()->baseUrl ?>/index.php?r=user/profile&&pro=1&&id=<?= Yii::app()->user->id ?>" class="btn btn-default btn-flat">ແກ້​ໄຂຂໍ້ມູນສ່ວນຕົວ</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= Yii::app()->baseUrl ?>/index.php?r=site/logout" class="btn btn-default btn-flat">ອອກ​ຈາກ​ລະ​ບົບ</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar" >
                <!-- sidebar: style can be found in sidebar.less -->

                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" style="font-size: 16px;">
                        <li class="header">ລາຍ​ການຫຼັກ</li>
                        <?php
                        if (Yii::app()->user->checkAccess('Admin')) {
                            ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    ຕັ້ງ​ຄ່າ​ລະ​ບົບ
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=user/index"><span class="glyphicon glyphicon-user"></span>​ຕັ້ງ​ຄ່າຜູ້​ເຂົ້າ​ລະ​ບົບ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=user/backupdb"><span class="glyphicon glyphicon-user"></span>​Backup ຖານ​ຂໍ້​ມູນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=bg/index"><span class="glyphicon glyphicon-user"></span>ຮູບພາບ​ພື້ນຫຼັງ</a></li>
                                    <li><a href="../../../../branch/index.php?type_user=<?= $_SESSION['type_user'] ?>&user_id=<?= $_SESSION['user_id'] ?>"><span class="glyphicon glyphicon-ban-circle"></span>ຕັ້ງ​ຄ່​າສາ​ຂາ</a></li>
                                    <li><a href="../../../../staff/index.php?type_user=<?= $_SESSION['type_user'] ?>&user_id=<?= $_SESSION['user_id'] ?>"><span class="glyphicon glyphicon-ban-circle"></span>ຂໍ້​ມູນ​ພະ​ນັກ​ງານ</a></li>
                                    <li><a href=""><span class="glyphicon glyphicon-ban-circle"></span>ຄົ້ນຫາສໍາເນົາລົດ</a>
                                        <ul class="treeview-menu">
                                            <li><a  href="../../../../search-list-mocycle/index.php?type_user=<?= $_SESSION['type_user'] ?>&user_id=<?= $_SESSION['user_id'] ?>"><span class="glyphicon glyphicon-certificate"></span>ສໍາເນົາລົດທັງໝົດ</a></li>
                                            <li><a  href="../../../../search-list-mocycle1/index.php?type_user=<?= $_SESSION['type_user'] ?>&user_id=<?= $_SESSION['user_id'] ?>"><span class="glyphicon glyphicon-certificate"></span>ສໍາເນົາລົດຈ່າຍສົດ</a></li>
                                            <li><a  href="../../../../search-list-mocycle2/index.php?type_user=<?= $_SESSION['type_user'] ?>&user_id=<?= $_SESSION['user_id'] ?>"><span class="glyphicon glyphicon-certificate"></span>ສໍາເນົາລົດດາວ</a></li>
                                        </ul>
                                    </li>
                                </ul>          
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar"><span class="glyphicon glyphicon-blackboard"></span>​ປ້ອນຂໍ້​ມູນລົດ​</a>
                                <ul class="treeview-menu">
                                    <?php
                                    $branch = Branch::model()->findAll();
                                    foreach ($branch as $branchs) {
                                        ?>
                                        <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/index&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-blackboard"></span><?= $branchs->branch_name ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares"><span class="glyphicon glyphicon-th"></span>ປ້ອນຂໍ້​ມູນອາ​ໄຫຼ່</a>
                                <ul class="treeview-menu">
                                    <?php
                                    $branch = Branch::model()->findAll();
                                    foreach ($branch as $branchs) {
                                        ?>
                                        <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/index&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-th"></span><?= $branchs->branch_name ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=paymentIn/admin"><span class="glyphicon glyphicon-th"></span>ຂໍ້​ມູນ​ລາຍ​ຈ່າຍ</a>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=acountTransfer/admin"><span class="glyphicon glyphicon-list-alt"></span>ຂໍ້​ມູນ​ເງິນ​ໂອນ​ເຂົ້​າ​ບັນ​ຊີ</a>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar"><span class="glyphicon glyphicon-remove"></span>ລືບ​ລົດ​ທີ​ຂາ​ຍ​ແລ້ວ</a>
                                <ul class="treeview-menu">
                                    <?php
                                    $branch = Branch::model()->findAll();
                                    foreach ($branch as $branchs) {
                                        ?>
                                        <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/del&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-remove"></span><?= $branchs->branch_name ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar"><span class=" glyphicon glyphicon-remove-circle"></span>ລືບ​ອາ​ໄຫຼ່ທີ​ຂາ​ຍ​ແລ້ວ</a>
                                <ul class="treeview-menu">
                                    <?php
                                    $branch = Branch::model()->findAll();
                                    foreach ($branch as $branchs) {
                                        ?>
                                        <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/del&branc_id=<?= $branchs->id ?>"><span class=" glyphicon glyphicon-remove-circle"></span><?= $branchs->branch_name ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar"><span class="glyphicon glyphicon-shopping-cart"></span>​ຂາຍ​ລົດ</a>
                                <ul class="treeview-menu">
                                    <?php
                                    $branch = Branch::model()->findAll();
                                    foreach ($branch as $branchs) {
                                        ?>
                                        <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-user"></span><?= $branchs->branch_name ?></a>
                                            <ul class="treeview-menu">
                                                <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=1&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-th-large"></span>ຂາຍ​ຈ່າຍ​ສົດ</a></li>
                                                <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=2&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-th-large"></span>ຂາຍ​ຈ່າຍ​ຜ່ອນ</a></li>
                                                <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=4&share=true&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-th-large"></span>​ແບ່ງ​ໃຫ້​ສາ​ຂາ​</a></li>

                                            </ul>    
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>   
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/sale"><span class="glyphicon glyphicon-shopping-cart"></span>ຂາຍ​ອາ​ໄຫຼ່</a>
                                <ul class="treeview-menu">
                                    <?php
                                    $branch = Branch::model()->findAll();
                                    foreach ($branch as $branchs) {
                                        ?>
                                        <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/sale&branc_id=<?= $branchs->id ?>"><span class="glyphicon glyphicon-user"></span><?= $branchs->branch_name ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul> 
                            </li>
                            <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/Payment"><span class="glyphicon glyphicon-usd"></span>​ຊຳລະຄ່າ​ລົດ</a></li>
                            <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/Payment"><span class="glyphicon glyphicon-usd"></span>​ຊຳລະຄ່າ​ໜີ້​ອາ​ໄຫຼ່</a></li>
                            <li class="treeview">
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/listrunpai"><span class="glyphicon glyphicon-flag"></span>​ລົດ​ທີ່​ແລ່ນ​ປ້າຍ</a>
                                <ul class="treeview-menu">
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cengsupxen"><span class="glyphicon glyphicon-file"></span>ລົດບໍ່ທັນແຈ້ງສັບສີນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cengsupxendone"><span class="glyphicon glyphicon-file"></span>ລົດແຈ້ງສັບສີນແລ້ວ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/listrunpai"><span class="glyphicon glyphicon-file"></span>ລົດຂື້ນທະບຽນແລ້ວ</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="">
                                    <i class="glyphicon glyphicon-book"></i>
                                    ລາຍ​ງານ
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportsalecar&rs=1"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຂາຍແລ້ວ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportsalecar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ຂາຍແລ້ວ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຍັງເຫຼຶອ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາໄຫຼ່ທີ່ຍັງເຫຼຶອ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=paymentIn/reportpayin"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລາຍ​ຈ່າຍ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=acountTransfer/reporttransfer"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</a></li>
                                  <!--  <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportdaily"><span class="glyphicon glyphicon-file"></span>ລາຍ​ຮັ​ບ​ລາຍ​ເດືອນ</a></li>-->
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportdailybydate"><span class="glyphicon glyphicon-file"></span>ລາຍ​ຮັ​ບ​ລາຍ​ວັນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportbycount"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່​ຕາມ​ຈຳ​ນວນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cardaocash"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດ​ດາວ​ຈ່າຍ​ດ້ວຍ​ເງີນ​ສົດ</a></li>
                                </ul>          
                            </li>
                            <?php
                        } else {
                            ?>
                            <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar"><span class="glyphicon glyphicon-blackboard"></span>​ປ້ອນຂໍ້​ມູນລົດ​</a></li>
                            <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares"><span class="glyphicon glyphicon-bed"></span>ປ້ອນຂໍ້​ມູນອາ​ໄຫຼ່</a></li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=paymentIn/admin"><span class="glyphicon glyphicon-th"></span>ຂໍ້​ມູນ​ລາຍ​ຈ່າຍ</a>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=acountTransfer/admin"><span class="glyphicon glyphicon-list-alt"></span>ຂໍ້​ມູນ​ເງິນ​ໂອນ​ເຂົ້​າ​ບັນ​ຊີ</a>
                            </li>
                            <li>
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar"><span class="glyphicon glyphicon-shopping-cart"></span>​ຂາຍ​ລົດ</a>
                                <ul class="treeview-menu">
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=1"><span class="glyphicon glyphicon-certificate"></span>ຂາຍ​ຈ່າຍ​ສົດ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&status=2"><span class="glyphicon glyphicon-ban-circle"></span>ຂາຍ​ຈ່າຍ​ຜ່ອນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/salecar&share=true&status=4"><span class="glyphicon glyphicon-transfer"></span>​ແບ່ງ​ໃຫ້​ສາ​ຂາ​</a></li>
                                </ul>    

                            </li>
                            <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/sale"><span class="glyphicon glyphicon-shopping-cart"></span>ຂາຍ​ອາ​ໄຫຼ່</a></li>
                            <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/Payment"><span class="glyphicon glyphicon-usd"></span>​ຊຳລະຄ່າ​ລົດ</a></li>
                            <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/Payment"><span class="glyphicon glyphicon-usd"></span>​ຊຳລະຄ່າ​ໜີ້​ອາ​ໄຫຼ່</a></li>
                            <li class="treeview">
                                <a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/listrunpai"><span class="glyphicon glyphicon-flag"></span>​ລົດ​ທີ່​ແລ່ນ​ປ້າຍ</a>
                                <ul class="treeview-menu">
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cengsupxen"><span class="glyphicon glyphicon-file"></span>ລົດບໍ່ທັນແຈ້ງສັບສີນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cengsupxendone"><span class="glyphicon glyphicon-file"></span>ລົດແຈ້ງສັບສີນແລ້ວ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/listrunpai"><span class="glyphicon glyphicon-file"></span>ລົດຂື້ນທະບຽນແລ້ວ</a></li>
                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="">
                                    <i class="glyphicon glyphicon-book"></i>
                                    ລາຍ​ງານ
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportsalecar&rs=1"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຂາຍແລ້ວ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportsalecar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ຂາຍແລ້ວ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຍັງເຫຼຶອ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາໄຫຼ່ທີ່ຍັງເຫຼຶອ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=paymentIn/reportpayin"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລາຍ​ຈ່າຍ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=acountTransfer/reporttransfer"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</a></li>                                   
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/reportdaily"><span class="glyphicon glyphicon-file"></span>ລາຍ​ຮັ​ບ​ລາຍ​ເດືອນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infoSpares/reportbycount"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່​ຕາມ​ຈຳ​ນວນ</a></li>
                                    <li><a href="<?= Yii::app()->baseUrl ?>/index.php?r=infonCar/cardaocash"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດ​ດາວ​ຈ່າຍ​ດ້ວຍ​ເງີນ​ສົດ</a></li>
                                </ul>          
                            </li>
                            <?php
                        }
                        ?>
                    </ul>  
                </section>

                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" id="content">
                <!-- Main content -->
                <section class="content">
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <!-- /.row (main row) -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer" >
                <div class="pull-right hidden-xs">
                    <b>ອອກ​ແບບ​ ແລະ​ ພັດ​ທະ​ນາ​ໂດຍ </b> <a href="https://www.facebook.com/profile.php?id=100011485531661" target="_bank">HM-SOFTWARE</a>
                </div>
                <strong>ລິ​ຂະ​ສິດ​ສະ​ຫງວນ &copy; <?php echo date('Y'); ?> ບໍລີສັດ ວັງຈົງຈູ້ ການຄ້າຈຳກັດຜູ້ດຽວ</strong>

            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>

            <div class="control-sidebar-bg"></div>
        </div>
        <!--<script src="<?= Yii::app()->baseUrl ?>/dist/js/jQuery-2.1.4.min.js"></script>-->

            <!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="<?= Yii::app()->baseUrl ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= Yii::app()->baseUrl ?>/dist/js/app.min.js"></script>
        <script src="<?= Yii::app()->baseUrl ?>/bootstrap/js/jquery.price_format.min.js"></script>
    </body>
</html>
