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


        <!-------------For Province-------------->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                $(".province").change(function ()
                {
                    var id = $(this).val();
                    var dataString = 'id=' + id;

                    $.ajax
                            ({
                                type: "POST",
                                url: "ajax_city.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".district").html(html);
                                }
                            });

                });

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
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

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
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
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
            </aside>>





            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content">
                    <div class="row">



                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title" style="font-family:'Saysettha OT';">ຂໍ້ມູນສາຂາ</h3>
                                    </div>

                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <?php
                                    if (isset($_POST['save'])) {
                                        $branch_name = $_POST['branch_name'];
                                        $address = $_POST['address'];
                                        $province_id = $_POST['province'];
                                        $district_id = $_POST['district'];
                                        $mobile = $_POST['mobile'];
                                        $tel = $_POST['tel'];
                                        $sql = mysql_query("insert into branch values ('','$branch_name','$tel','$mobile','$address','$district_id','$province_id')");
                                        echo "<script type=\"text/javascript\">window.alert('Save Success.....!');window.location.href = 'index.php';</script>";
                                        exit;
                                    }
                                    ?>
                                    <form class = "form-horizontal" method="post" role="form" action="index.php">
                                        <div class = "box-body" style = "font-family:'Saysettha OT';font-size: 14px;">
                                            <input type = "hidden" name="id" class = "form-control" id = "firstname" >

                                            <div class = "form-group">                                              
                                                <label for = "branch" class = "col-sm-2 control-label">ສາຂາ</label>
                                                <div class = "col-sm-4">
                                                    <input type = "text" name="branch_name" class = "form-control" id = "firstname" placeholder="ສາຂາ">
                                                </div>

                                                <label for = "mobile" class = "col-sm-2 control-label">ໂທ</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control"  name="mobile" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="ໂທ...">
                                                </div>


                                            </div>
                                            <div class="form-group">

                                                <label for = "province" class = "col-sm-2 control-label">ແຂວງ</label>
                                                <div class="col-sm-4">

                                                    <select name="province" class="province form-control select2">
                                                        <option selected="selected">--ເລືອກແຂວງ--</option>
                                                        <?php
                                                        // include('db.php');
                                                        $sql = mysql_query("select id,province_name from province");
                                                        while ($row = mysql_fetch_array($sql)) {
                                                            $id = $row['id'];
                                                            $province_name = $row['province_name'];
                                                            echo '<option value="' . $id . '">' . $province_name . '</option>';
                                                        }
                                                        ?>
                                                    </select> 

                                                </div>

                                                <label for = "tel" class = "col-sm-2 control-label">Fax</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="tel" style="font-family:'Saysettha OT';font-size: 14px;" placeholder="Fax">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for = "district_id" class = "col-sm-2 control-label">ເມືອງ</label>
                                                <div class="col-sm-4">
                                                    <select name="district" class="district form-control">
                                                        <option selected="selected">--ເລືອກເມືອງ--</option>
                                                    </select>
                                                </div>




                                                <label for = "address" class = "col-sm-2 control-label">ທີ່ຕັ້ງ</label>
                                                <div class="col-sm-4">
                                                    <textarea class="textarea" name="address" placeholder="ສະຖານທີ່ຕັ້ງ" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                                                <th>ສາຂາ</th> 
                                                <th>ທີ່ຕັ້ງ</th> 
                                                <th>ເມືອງ</th> 
                                                <th>ແຂວງ</th> 
                                                <th>ໂທ</th> 
                                                <th>Fax</th> 
                                                <th>ຂໍ້ມູນ</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysql_query("SELECT * from branch");
                                            $i = 0;
                                            while ($row = mysql_fetch_array($result)) {
                                                $i++
                                                ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $row['branch_name'] ?></td> 
                                                    <td><?php echo $row['address'] ?></td> 
                                                    <td><?php
                                                        // echo $row['district_id']

                                                        $district_id = $row['district_id'];
                                                        $sqld = mysql_query("select * from district where id='$district_id'");
                                                        while ($rowd = mysql_fetch_array($sqld)) {
                                                            $id = $rowd['id'];
                                                            $district_name = $rowd['district_name'];
                                                            echo $district_name;
                                                        }
                                                        ?></td> 
                                                    <td><?php
                                                        //echo $row['province_id'] 

                                                        $province_id = $row['province_id'];
                                                        $sqlp = mysql_query("select * from province where id='$province_id'");
                                                        while ($rowp = mysql_fetch_array($sqlp)) {
                                                            $id = $rowp['id'];
                                                            $province_name = $rowp['province_name'];
                                                            echo $province_name;
                                                        }
                                                        ?></td> 
                                                    <td><?php echo $row['mobile'] ?></td> 
                                                    <td><?php echo $row['tel'] ?></td> 

                                                    <td> <a href="edit.php?branch_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                                                        <a href="delete.php?branch_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

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
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php
            include '../footer.php';
            ?>
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
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

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
        <script src="../plugins/fastclick/fastclick.js"></script>
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