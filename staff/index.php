<?php
include 'config.php';
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
                <?php
                include '../logo.php';
                ?>
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
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title" style="font-family:'Saysettha OT';">ຂໍ້ມູນພະນັກງານ</h3>
                                        </div>

                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <?php
                                        if (isset($_POST['save'])) {
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
                                            $sql = mysql_query("insert into staff values ('','$name','$lastname','$gender','$age','$address','$tel','$salary','$date','$status','$branch')");
                                            echo "<script type=\"text/javascript\">window.alert('Save Success.....!');window.location.href = 'index.php';</script>";
                                            exit;
                                        }
                                        ?>
                                        <form class = "form-horizontal" method="post" role="form" action="index.php">
                                            <div class = "box-body" style = "font-family:'Saysettha OT';font-size: 14px;">
                                                <input type = "hidden" name="id" class = "form-control" id = "firstname" >

                                                <div class = "form-group">                                              
                                                    <label for = "name" class = "col-sm-2 control-label">ຊື່</label>
                                                    <div class = "col-sm-4">
                                                        <input type = "text" name="name" class = "form-control" id = "name" placeholder="ຊື່">
                                                    </div>

                                                    <label for = "mobile" class = "col-sm-2 control-label">ໂທ</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control"  name="tel" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="ໂທ...">
                                                    </div>


                                                </div>
                                                <div class="form-group">

                                                    <label for = "lastname" class = "col-sm-2 control-label">ນາມສະກຸນ</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control"  name="lastname" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="ນາມສະກຸນ...">
                                                    </div>

                                                    <label for = "tel" class = "col-sm-2 control-label">ເງິນເດືອນ</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="salary" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="ເງິນເດືອນ...">
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
                                                        <input type="text" class="form-control" name="age" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="ອາຍຸ">
                                                    </div>

                                                    <label for = "tel" class = "col-sm-2 control-label">ວັນທີເຂົ້າມາເຮັດວຽກ</label>
                                                    <div class="col-sm-4">
                                                        <input type="date" class="form-control" name="date" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="ເງິນເດືອນ...">
                                                    </div>
                                                </div>
                                                <!---------------------------------------------------------------->
                                                <div class="form-group">
                                                    <label for = "tel" class = "col-sm-2 control-label">ເບີໂທ</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="tel" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="ເບີໂທ...">
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
                                                <div class="form-group">

                                                    <label for = "address" class = "col-sm-2 control-label">ທີ່ຢູ່ປັດຈຸບັນ</label>
                                                    <div class="col-sm-4">
                                                        <textarea class="textarea" name="address" placeholder="ທີ່ຢູ່ປັດຈຸບັນ...." style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <div class="col-sm-offset-2 col-sm-10">  
                                                        <button type="submit" name="save" class="btn btn-info pull-left">ບັນທືກ</button>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->

                                            <!-- /.box-footer -->
                                        </form>
                                    </div>


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
                                                    <th>ສາ​ຂາ</th>
                                                    <th>ວັນທີມ/ວ</th>
                                                    <th>ຂໍ້ມູນ</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = mysql_query("SELECT * from staff where status='1'");
                                                $i = 0;

                                                //function format
                                                function formatMoney($number, $fractional = false)
                                                {
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

                                                        <td><?php
                                                            $district_id = $row['branch_id'];
                                                            $sqld = mysql_query("select * from branch where id='$district_id'");
                                                            while ($rowd = mysql_fetch_array($sqld)) {
                                                                $id = $rowd['id'];
                                                                $district_name = $rowd['branch_name'];
                                                                echo $district_name;
                                                            }
                                                            ?></td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                                        <td><?php echo $row['date'] ?></td>
                                                        <td> <a href="edit.php?staff_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a href="delete.php?staff_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

                                                        </td>
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
    <?php
    include '../footer.php';
    ?>

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
