<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hmong Honda</title>
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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>H</b>H</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Hmong </b>Honda</span>
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
                                    <img src="../images/user.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Admin</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../images/user.png" class="img-circle" alt="User Image">
                                        <p>
                                            Admin 
                                            <small><?php echo date('d-m-Y'); ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </li>
                                    <!-- Menu Footer-->
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
            <?php
            include 'menu.php';
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Data Tables
                        <small>advanced tables</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                                <div class="box">
                                    <!-- /.box-header<div class="col-xs-12"> -->
                                    <div class="box-body">
                                        <table id="example1"  class="table table-bordered table-striped" style="font-family:'Saysettha OT';font-size: 14px;">
                                            <thead>
                                                <tr>
                                                    <th>ລໍາດັບ</th> 
                                                    <th>ເພດ</th>
                                                    <th>ຊື່</th> 
                                                    <th>ນາມສະກຸນ</th>                         
                                                    <th>ອາຍຸ</th>                      
                                                    <th>ບ່ອນຢູ່</th>
                                                    <th>ເບີໂທ</th>
                                                    <th>ເງີນເດືອນ</th>
                                                    <th>ວັນທີມ/ວ</th>
                                                    <th>ຂໍ້ມູນ</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = mysql_query("SELECT * from staff where status='2'");
                                                $i = 0;

                                                //function format
                                                function formatMoney($number, $fractional = false) {
                                                    if ($fractional) {
                                                        $number = sprintf('%.2f', $number);
                                                    }
                                                    while (true) {
                                                        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                                                        if ($replaced != $number) {
                                                            $number = $replaced;
                                                        } else {
                                                            break;
                                                        }
                                                    }
                                                    return $number;
                                                }

                                                //end function format
                                                while ($row = mysql_fetch_array($result)) {
                                                    $i++
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['gender'] ?></td> 
                                                        <td><?php echo $row['name']; ?></td> 
                                                        <td><?php echo $row['lastname']; ?></td> 
                                                        <td><?php echo $row['age'] ?></td>                           
                                                        <td><?php echo $row['address'] ?></td> 
                                                        <td><?php echo $row['tel'] ?></td>
                                                        <td><?php echo formatMoney($row['salary']) ?></td> 
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
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">ITTOJSIAB.COM</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
