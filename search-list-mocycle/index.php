<?php
include 'config.php';



if (isset($_POST['sqlsearch'])) {

    // echo "test";
    // exit();
    //$date3 = date_create("14-03-2016");

    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    //$date1 = date_format($d1, 'Y-m-d');
    //$date2 = date_format($d2, 'Y-m-d');
    $branchs = $_POST['branch'];

    //echo $branchs;
    //exit();


    if ($branchs == 'all') {

        $result = mysql_query("SELECT `car_code_1`, `car_code_2`, `generation`, `date_in` , branch.branch_name as branch_name  FROM `infon_car` inner join branch on infon_car.branch_id= branch.id  where  date_in between '" . $date1 . "' and '" . $date2 . "' order BY date_in  ASC");

        //sql2
        $result2 = mysql_query("SELECT `date_in`,branch.branch_name as branch_name, COUNT(`date_in`) as cnt FROM `infon_car` inner join branch on infon_car.branch_id= branch.id  WHERE  `date_in` BETWEEN '" . $date1 . "' and '" . $date2 . "' GROUP by `date_in`");
    } else {


        $result = mysql_query("SELECT `car_code_1`, `car_code_2`, `generation`, `date_in` , branch.branch_name as branch_name FROM `infon_car` inner join branch on infon_car.branch_id= branch.id  where  branch_id='" . $branchs . "' and date_in between '" . $date1 . "' and '" . $date2 . "' order BY date_in  ASC");

        ///sql2
        $result2 = mysql_query("SELECT `date_in`, branch.branch_name as branch_name , COUNT(`date_in`) as cnt FROM `infon_car` inner join branch on infon_car.branch_id= branch.id  WHERE  `branch_id` ='" . $branchs . "' and `date_in` BETWEEN '" . $date1 . "' and '" . $date2 . "' GROUP by `date_in`");
    }
} else {
    $result = mysql_query("SELECT `car_code_1`, `car_code_2`, `generation`, `date_in` , branch.branch_name as branch_name FROM `infon_car` inner join branch on infon_car.branch_id= branch.id  order BY date_in  ASC");

    //sql2

    $result2 = mysql_query("SELECT `date_in`, branch.branch_name as branch_name , COUNT(`date_in`) as cnt FROM `infon_car` inner join branch on infon_car.branch_id= branch.id   GROUP by `date_in`");
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
                                            <h3 class="box-title" style="font-family:'Saysettha OT';">ຄົ້ນຫາຈໍານວນລົດ</h3>
                                        </div>

                                        <!-- /.box-header -->
                                        <!-- form start -->

                                        <form class = "form-horizontal" method="post" role="form" action="index.php">
                                            <div class = "box-body" style = "font-family:'Saysettha OT';font-size: 14px;">
                                                <input type = "hidden" name="id" class = "form-control" id = "firstname" >

                                                <div class = "form-group">                                              
                                                    <label for = "d1" class = "col-sm-2 control-label">ຈາກວັນທີ</label>
                                                    <div class = "col-sm-4">

                                                        <input type = "text" name="date1" class = "form-control" id="datepicker1">



                                                    </div>

                                                    <label for = "d2" class = "col-sm-2 control-label">ຫາວັນທີ</label>
                                                    <div class = "col-sm-4">

                                                        <input type = "text" name="date2" class = "form-control" id="datepicker2">


                                                    </div>


                                                </div>
                                                <div class="form-group">

                                                    <label for = "branch" class = "col-sm-2 control-label">ສາຂາ</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control select2" name="branch" style="width: 100%;">
                                                            <option selected="selected" value="all">ທາງໝົດ</option>
                                                            <?php
                                                            // include('db.php');
                                                            $sql = mysql_query("select id,branch_name from branch");
                                                            while ($row = mysql_fetch_array($sql)) {
                                                                $id = $row['id'];
                                                                $name = $row['branch_name'];
                                                                echo '<option value="' . $id . '">' . $name . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                </div>




                                                <div class="modal-footer">
                                                    <div class="col-sm-offset-2 col-sm-10">  
                                                        <button type="submit" name="sqlsearch" class="btn btn-info pull-left">ເບີ່ງລາຍການ</button>

                                                    </div>
                                                </div>
                                            </div>


                                        </form>
                                    </div>

                                </div>

                                <!-----------Ende Search Content--------------->

                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title" style="font-family:'Saysettha OT';">ຈໍານວນລົດ</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ລໍາດັບ</th>                                                            
                                                    <th>ວັນທີນໍາເຂົ້າ</th>
                                                    <th>ຈໍານວນ</th>
                                                    <th>ສາຂາ</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $i = 0;
                                                $sum = 0;

                                                while ($row = mysql_fetch_array($result2)) {
                                                    $i++
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['date_in'] ?></td> 
                                                        <td><?php
                                                            echo $row['cnt'];

                                                            $value = $row['cnt'];
                                                            $sum += $value;
                                                            ?></td> 
                                                        <td><?php echo $row['branch_name'] ?></td>
                                                    </tr>



                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>ລວມເງີນທັງໝົດ :</th>
                                                    <th><?php echo $sum; ?></th>
                                                    <th></th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->

                                <!------------End List-------------->





                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title" style="font-family:'Saysettha OT';">ລາຍລະອຽດຈໍານວນລົດ</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1"  class="table table-bordered table-striped" style="font-family:'Saysettha OT';font-size: 14px;">
                                            <thead>
                                                <tr>
                                                    <th>ລໍາດັບ</th> 
                                                    <th>ເລກຈັກ</th>
                                                    <th>ເລກຖັງ</th> 
                                                    <th>ລຸ້ນລົດ</th>           
                                                    <th>ວັນທີນໍາເຂົ້າ</th>
                                                    <th>ສາຂາ</th>

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
                                                        <td><?php echo $row['car_code_1'] ?></td> 
                                                        <td><?php echo $row['car_code_2']; ?></td> 
                                                        <td><?php echo $row['generation']; ?></td>                                                                               
                                                        <td><?php echo $row['date_in'] ?></td> 
                                                        <td><?php echo $row['branch_name'] ?></td>                                                     
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