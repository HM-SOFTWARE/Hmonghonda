<?php
include 'config.php';

if (isset($_POST['sqlsearch'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $branchs = $_POST['branch'];
} else {
    $result = mysql_query("SELECT car_type.type_name as cartype, infon_car.car_code_1 as code1, infon_car.car_code_2 as code2, infon_car.color as color, infon_car.generation as lun, placard.date_note as date FROM `placard` inner join infon_car on placard.infon_car_id= infon_car.id INNER JOIN car_type on infon_car.car_type_id=car_type.id where placard.date_note is null");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FAJTIMHMOOB</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

        <!--------------Date picker----------------->


        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script>

            $(function () {
                $("#datepicker").datepicker();
            });

            $(function () {
                $("#datepicker1, #datepicker2").addClass('datepicker');
                $(".datepicker").datepicker({dateFormat: "yy-mm-dd"});
            });

        </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>H</b>H</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>FAJTIMHMOOB</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">


                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../dist/img/Icon-user.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">  <?php
//$_SESSION['user_id']
                                        $userid = $_SESSION['user_id'];

                                        $results = mysql_query("SELECT * from user where id='" . $userid . "'");
                                        $i = 0;
                                        while ($rows = mysql_fetch_array($results)) {
                                            $i++
                                            ?>
                                            <label><?php echo $rows['first_name']; ?></label>
                                            <?PHP
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../dist/img/Icon-user.png" class="img-circle" alt="User Image">

                                        <p>
                                            <?php
//$_SESSION['user_id']
                                            $userid = $_SESSION['user_id'];

                                            $results = mysql_query("SELECT * from user where id='" . $userid . "'");
                                            $i = 0;
                                            while ($rows = mysql_fetch_array($results)) {
                                                $i++
                                                ?>
                                                <label><?php echo $rows['first_name']; ?></label>
                                                <?PHP
                                            }
                                            ?>

                                            <small><?php echo date('d-m-Y'); ?></small>
                                        </p>
                                    </li>

                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="../sys/index.php?r=user/profile&&pro=1&&id=<?= $_SESSION['user_id'] ?>" class="btn btn-default btn-flat">ແກ້​ໄຂຂໍ້ມູນສ່ວນຕົວ</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="../sys/index.php?r=site/logout" class="btn btn-default btn-flat">ອອກ​ຈາກ​ລະ​ບົບ</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->

                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php
                    include '../menu.php';
                    ?>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h2 class="box-title" style="font-family:'Saysettha OT';">ລົດທີ່ບໍ່ທັນແຈ້ງສັບສີນ</h2>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1"  class="table table-bordered table-striped" style="font-family:'Saysettha OT';font-size: 14px;">
                                            <thead>
                                                <tr>
                                                    <th>ລໍາດັບ</th>
                                                    <th>​ປະ​ເພດ​ລົດ</th>
                                                    <th>​ເລກ​ຈັກ</th>
                                                    <th>ເລ​ກ​ຖັງ</th>
                                                    <th>​ສີ​ລົດ</th>
                                                    <th>ລຸ້ນລົດ</th>
                                                    <th>​ຈຳ​ນວນ</th>
                                                    <th>ວັນ​ທີແຈ້ງສັບສີນ</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
//$result = mysql_query("SELECT * from staff where status='1'");
                                                $i = 0;


                                                while ($row = mysql_fetch_array($result)) {
                                                    $i++
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['cartype'] ?></td> 
                                                        <td><?php echo $row['code1']; ?></td> 
                                                        <td><?php echo $row['code2']; ?></td>                                                                               
                                                        <td><?php echo $row['color'] ?></td> 
                                                        <td><?php echo $row['lun']; ?></td>
                                                        <td><?php echo "1"; ?></td>
                                                        <td><?php echo $row['date'] ?></td>                                                     
                                                    </tr>

                                                    <?php
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>

                    </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Develop By:</b> <a href="#">ITTOJSIAB</a>
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">ITTOJSIAB.COM</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- 
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>jQuery 2.1.4 -->
<!-- Bootstrap 3.3.5 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
</script>
</body>
</html>