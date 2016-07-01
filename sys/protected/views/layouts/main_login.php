<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/css/style.css">
        <title><?php echo "FAJTIMHMOOB HONDA"; ?></title>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box" id="page">
            <div class="login-box-body">
                <p class="login-box-msg "><b>ບໍລີສັດ ວັງຈົງຈູ້ ການຄ້າຈຳກັດຜູ້ດຽວ<br/> VUNGJONGJU Trading Sole Co.,Ltd</b></p>
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $content; ?>
                    </div>

                </div>

            </div>
            <div class="alert-success" align="center">ອອກ​ແບບ​ ແລະ​ ພັດ​ທະ​ນາ​ໂດຍ <a style="color: #fff;" href="http://www.facebook.com/profile.php?id=100011485531661" target="_bank">HM-SOFTWARE</a></div>
        </div>
        <!-- jQuery 2.1.4 -->
        <script src="<?= Yii::app()->baseUrl ?>/dist/js/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?= Yii::app()->baseUrl ?>/bootstrap/js/bootstrap.min.js"></script>

        <!-- AdminLTE App -->
        <script src="<?= Yii::app()->baseUrl ?>/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?= Yii::app()->baseUrl ?>/dist/js/demo.js"></script>
    </body>
</html>
