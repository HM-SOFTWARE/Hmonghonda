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

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title" style="font-family:'Saysettha OT';">ແກ້ໄຂຂໍ້ມູນພະນັກງານ</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <?php
                                    if (isset($_POST['save'])) {

                                        $id = $_POST['id'];
                                        $name = $_POST['name'];
                                        $lastname = $_POST['lastname'];
                                        $address = $_POST['address'];
                                        $gender = $_POST['gender'];
                                        $age = $_POST['age'];
                                        $tel = $_POST['tel'];
                                        $salary = $_POST['salary'];
                                        $date = $_POST['date'];
                                        $branch = $_POST['branch'];
                                        $status = 1;

                                        $sql = mysql_query("update staff set name='" . $name . "', lastname='" . $lastname . "', gender='" . $gender . "', age='" . $age . "', address='" . $address . "', tel='" . $tel . "', salary='" . $salary . "', date='" . $date . "', status='1' , branch_id=" . $branch . " where id='" . $id . "'");
                                        echo "<script type=\"text/javascript\">window.alert('Updated Success.....!');window.location.href = 'index.php';</script>";
                                        exit;
                                    }



                                    if (isset($_GET['staff_id'])) {
                                        $staff_id = $_GET['staff_id'];


                                        $result = mysql_query("SELECT * from staff where id='" . $staff_id . "'");
                                        $i = 0;
                                        while ($rows = mysql_fetch_array($result)) {
                                            $i++
                                            ?>
                                            <form class = "form-horizontal" method="post" role="form" action="edit.php">
                                                <div class = "box-body" style = "font-family:'Saysettha OT';font-size: 14px;">
                                                    <input type = "hidden" name="id" class = "form-control" id = "id" value="<?php echo $rows['id']; ?>">

                                                    <div class = "form-group">                                              
                                                        <label for = "name" class = "col-sm-2 control-label">ຊື່</label>
                                                        <div class = "col-sm-4">
                                                            <input type = "text" name="name" class = "form-control" id = "name" value="<?php echo $rows['name']; ?>">
                                                        </div>

                                                        <label for = "tel" class = "col-sm-2 control-label">ໂທ</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" value="<?php echo $rows['tel']; ?>"  name="tel" style="font-family:'Saysettha OT';font-size: 14px;">
                                                        </div>


                                                    </div>
                                                    <div class="form-group">

                                                        <label for = "lastname" class = "col-sm-2 control-label">ນາມສະກຸນ</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control"  name="lastname" style="font-family:'Saysettha OT';font-size: 14px;" value="<?php echo $rows['lastname']; ?>">
                                                        </div>

                                                        <label for = "tel" class = "col-sm-2 control-label">ເງິນເດືອນ</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" name="salary" style="font-family:'Saysettha OT';font-size: 14px;" value="<?php echo $rows['salary']; ?>">
                                                        </div>
                                                    </div>
                                                    <!---------------------------------------------------------------->
                                                    <div class="form-group">



                                                        <label for = "gender" class = "col-sm-2 control-label">ເພດ & ອາຍຸ</label>
                                                        <div class="col-sm-2">
                                                            <select name="gender" class="district form-control">

                                                                <option selected="selected">ທ</option>
                                                                <option>ນ</option>
                                                            </select>                           
                                                        </div>
                                                        <div class="col-sm-2">  
                                                            <input type="text" class="form-control" name="age" style="font-family:'Saysettha OT';font-size: 14px;" value="<?php echo $rows['age']; ?>">
                                                        </div>

                                                        <label for = "tel" class = "col-sm-2 control-label">ວັນທີເຂົ້າມາເຮັດວຽກ</label>
                                                        <div class="col-sm-4">
                                                            <input type="date" class="form-control" name="date" style="font-family:'Saysettha OT';font-size: 14px;" value="<?php echo $rows['date']; ?>">
                                                        </div>
                                                    </div>
                                                    <!---------------------------------------------------------------->
                                                    <div class="form-group">

                                                        <label for = "address" class = "col-sm-2 control-label">ທີ່ຢູ່ປັດຈຸບັນ</label>
                                                        <div class="col-sm-4">
                                                            <textarea class="textarea" name="address" placeholder="ທີ່ຢູ່ປັດຈຸບັນ...." style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                        </div>
                                                        <label for = "address" class = "col-sm-2 control-label">ສາ​ຂາ</label>
                                                        <div class="col-sm-4">
                                                            <select name="branch" class="province form-control select2">
                                                                <option selected="selected">-- ເລືອກ​ສາ​ຂາ--</option>
                                                                <?php
                                                                // include('db.php');
                                                                $sql = mysql_query("select id,branch_name from branch");
                                                                while ($row = mysql_fetch_array($sql)) {
                                                                    $id = $row['id'];
                                                                    $province_name = $row['branch_name'];
                                                                    echo '<option value="' . $id . '">' . $province_name . '</option>';
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-sm-offset-2 col-sm-10">  
                                                            <button type="submit" name="save" class="btn btn-info pull-left">ບັນທືກ</button>
                                                            <a href="index.php" class="btn btn-default pull-right" data-dismiss="modal" style="font-family:'Saysettha OT';font-size: 14px;">ຍົກເລີກ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->

                                                <!-- /.box-footer -->
                                            </form>
                                        </div>
                                        <?PHP
                                    }
                                }
                                ?>

                                <!-- /.box-header -->

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
