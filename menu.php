<style>
    body{
        font-family: 'Saysettha OT';
    }
</style>
<ul class="sidebar-menu" style="font-family: 'Saysettha OT'">
    <li class="header">ລາຍ​ການຫຼັກ</li>
    <?php
    if (isset($_SESSION['type_user']) && $_SESSION['type_user'] == "Admin") {
        ?>
        <li class="treeview">
            <a href="">
                <i class="fa fa-files-o"></i>
                ຕັ້ງ​ຄ່າລະ​ບົບ
            </a>
            <ul class="treeview-menu">
                <li><a href="/sys/index.php?r=user/index"><span class="glyphicon glyphicon-user"></span>​ຕັ້ງ​ຄ່າຜູ້​ເຂົ້າ​ລະ​ບົບ</a></li>
                <li><a href="/sys/index.php?r=user/backupdb"><span class="glyphicon glyphicon-user"></span>​Backup ຖານ​ຂໍ້​ມູນ</a></li>
                <li><a href="/sys/index.php?r=bg/index"><span class="glyphicon glyphicon-user"></span>ຮູບພາບ​ພື້ນຫຼັງ</a></li>
                <li><a href="/branch/index.php"><span class="glyphicon glyphicon-ban-circle"></span>ຕັ້ງ​ຄ່​າສາ​ຂາ</a></li>
                <li><a href="/staff/index.php"><span class="glyphicon glyphicon-ban-circle"></span>ຂໍ​້ມູນ​ພະ​ນັກ​ງານ</a></li>
                <li><a href=""><span class="glyphicon glyphicon-ban-circle"></span>ຄົ້ນຫາສໍາເນົາລົດ</a>
                    <ul class="treeview-menu">
                        <li><a  href="/search-list-mocycle/index.php"><span class="glyphicon glyphicon-certificate"></span>ສໍາເນົາລົດທັງໝົດ</a></li>
                        <li><a  href="/search-list-mocycle1/index.php"><span class="glyphicon glyphicon-certificate"></span>ສໍາເນົາລົດຈ່າຍສົດ</a></li>
                        <li><a  href="/search-list-mocycle2/index.php"><span class="glyphicon glyphicon-certificate"></span>ສໍາເນົາລົດດາວ</a></li>
                    </ul>
                </li>

            </ul>          
        </li>
        <li>
            <a href="/sys/index.php?r=infonCar"><span class="fa fa-car"></span>​ປ້ອນຂໍ້​ມູນລົດ​</a>
            <ul class="treeview-menu">
                <?php
                $sql = mysql_query("select * from branch") or die(mysql_error());
                while ($branchs = mysql_fetch_array($sql)) {
                    ?>
                    <li><a href="/sys/index.php?r=infonCar/index&branc_id=<?= $branchs['id'] ?>"><span class="glyphicon glyphicon-user"></span><?= $branchs['branch_name'] ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </li>

        <li>
            <a href="/sys/index.php?r=infoSpares"><span class="fa fa-bell-slash"></span>ປ້ອນຂໍ້​ມູນອາ​ໄຫ່</a>
            <ul class="treeview-menu">
                <?php
                $sql = mysql_query("select * from branch") or die(mysql_error());
                while ($branchs = mysql_fetch_array($sql)) {
                    ?>
                    <li><a href="/sys/index.php?r=infoSpares/index&branc_id=<?= $branchs['id'] ?>"><span class="glyphicon glyphicon-user"></span><?= $branchs['branch_name'] ?></a></li>
                    <?php
                }
                ?>

            </ul>
        </li>
        <li>
            <a href="/sys/index.php?r=paymentIn/admin"><span class="fa fa-bell-slash"></span>ຂໍ້​ມູນ​ລາຍ​ຈ່າຍ</a>
        </li>
        <li>
            <a href="/sys/index.php?r=acountTransfer/admin"><span class="fa fa-bell-slash"></span>ຂໍ້​ມູນ​ເງິນ​ໂອນ​ເຂົ້​າ​ບັນ​ຊີ</a>
        </li>
        <li>
            <a href="/sys/index.php?r=infonCar/salecar"><span class="fa fa-shopping-cart"></span>​ຂາຍ​ລົດ</a>
            <ul class="treeview-menu">
                <?php
                $sql = mysql_query("select * from branch") or die(mysql_error());
                while ($branchs = mysql_fetch_array($sql)) {
                    ?>
                    <li><a href="/sys/index.php?r=infonCar/salecar&branc_id=<?= $branchs['id'] ?>"><span class="glyphicon glyphicon-user"></span><?= $branchs['branch_name'] ?></a>
                        <ul class="treeview-menu">
                            <li><a href="/sys/index.php?r=infonCar/salecar&status=1&branc_id=<?= $branchs['id'] ?>"><span class="glyphicon glyphicon-certificate"></span>ຂາຍ​ຈ່າຍ​ສົດ</a></li>
                            <li><a href="/sys/index.php?r=infonCar/salecar&status=2&branc_id=<?= $branchs['id'] ?>"><span class="glyphicon glyphicon-ban-circle"></span>ຂາຍ​ຈ່າຍ​ຜ່ອນ</a></li>
                            <li><a href="/sys/index.php?r=infonCar/salecar&share=true&branc_id=<?= $branchs['id'] ?>"><span class="glyphicon glyphicon-transfer"></span>​ແບ່ງ​ໃຫ້​ສາ​ຂາ​</a></li>

                        </ul> 
                    </li>
                    <?php
                }
                ?>
            </ul>   
        </li>

        <li>
            <a href="/sys/index.php?r=infonCar/salecar"><span class="fa fa-shopping-cart"></span>ຂາຍ​ອາ​ໄຫຼ່</a>
            <ul class="treeview-menu">
                <?php
                $sql = mysql_query("select * from branch") or die(mysql_error());
                while ($branchs = mysql_fetch_array($sql)) {
                    ?>
                    <li><a href="/sys/index.php?r=infoSpares/sale&branc_id=<?= $branchs['id'] ?>"><span class="glyphicon glyphicon-user"></span><?= $branchs['branch_name'] ?></a></li>
                    <?php
                }
                ?>
            </ul>   
        </li>
        <li><a href="/sys/index.php?r=infonCar/Payment"><span class="fa fa-money"></span>​ຊຳລະຄ່າ​ລົດ</a></li>
        <li><a href="/sys/index.php?r=infoSpares/Payment"><span class="fa fa-money"></span>​ຊຳລະຄ່າ​ໜີ້​ອາ​ໄຫຼ່</a></li>
        <li><a href="/sys/index.php?r=infonCar/listrunpai"><span class="fa fa-money"></span>​ລົດ​ທີ່​ແລ່ນ​ປ້າຍ</a></li>
        <li class="treeview">
            <a href="">
                <i class="fa fa-files-o"></i>
                ລາຍ​ງານ
            </a>
            <ul class="treeview-menu">
                <li><a href="sys/index.php?r=infonCar/reportsalecar&rs=1"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຂາຍແລ້ວ</a></li>
                <li><a href="sys/index.php?r=infonCar/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportsalecar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ຂາຍແລ້ວ</a></li>
                <li><a href="sys/index.php?r=infonCar/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຍັງເຫຼຶອ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາໄຫຼ່ທີ່ຍັງເຫຼຶອ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                <li><a href="sys/index.php?r=paymentIn/reportpayin"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລາຍ​ຈ່າຍ</a></li>
                <li><a href="sys/index.php?r=acountTransfer/reporttransfer"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</a></li>                                   
              <!--  <li><a href="sys/index.php?r=infonCar/reportdaily"><span class="glyphicon glyphicon-file"></span>ລາຍ​ຮັ​ບ​ລາຍ​ເດືອນ</a></li>-->
                <li><a href="sys/index.php?r=infonCar/reportdailybydate"><span class="glyphicon glyphicon-file"></span>ລາຍ​ຮັ​ບ​ລາຍ​ວັນ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportbycount"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່​ຕາມ​ຈຳ​ນວນ</a></li>
                <li><a href="sys/index.php?r=infonCar/cardaocash"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດ​ດາວ​ຈ່າຍ​ດ້ວຍ​ເງີນ​ສົດ</a></li>
            </ul>          
        </li>
        <?php
    } else {
        ?>
        <li><a href="/sys/index.php?r=infonCar"><span class="fa fa-car"></span>​ປ້ອນຂໍ້​ມູນລົດ​</a></li>
        <li><a href="/sys/index.php?r=infoSpares"><span class="fa fa-bell-slash"></span>ປ້ອນຂໍ້​ມູນອາ​ໄຫຼ່</a></li>
        <li>
            <a href="/sys/index.php?r=paymentIn/admin"><span class="fa fa-bell-slash"></span>ຂໍ້​ມູນ​ລາຍ​ຈ່າຍ</a>
        </li>
        <li>
            <a href="/sys/index.php?r=acountTransfer/admin"><span class="fa fa-bell-slash"></span>ຂໍ້​ມູນ​ເງິນ​ໂອນ​ເຂົ້​າ​ບັນ​ຊີ</a>
        </li>
        <li><a href="/sys/index.php?r=infonCar/salecar"><span class="fa fa-shopping-cart"></span>​ຂາຍ​ລົດ</a>
            <ul class="treeview-menu">
                <li><a href="/sys/index.php?r=infonCar/salecar&status=1"><span class="glyphicon glyphicon-certificate"></span>ຂາຍ​ຈ່າຍ​ສົດ</a></li>
                <li><a href="/sys/index.php?r=infonCar/salecar&status=2"><span class="glyphicon glyphicon-ban-circle"></span>ຂາຍ​ຈ່າຍ​ຜ່ອນ</a></li>
                <li><a href="/sys/index.php?r=infonCar/salecar&share=true"><span class="glyphicon glyphicon-transfer"></span>​ແບ່ງ​ໃຫ້​ສາ​ຂາ​</a></li>

            </ul> 
        </li>
        <li><a href="/sys/index.php?r=infoSpares/sale"><span class="fa fa-shopping-cart"></span>ຂາຍ​ອາ​ໄຫຼ່</a></li>
        <li><a href="/sys/index.php?r=infonCar/Payment"><span class="fa fa-money"></span>​ຊຳລະຄ່າ​ລົດ</a></li>
        <li><a href="/sys/index.php?r=infoSpares/Payment"><span class="fa fa-money"></span>​ຊຳລະຄ່າ​ໜີ້​ອາ​ໄຫຼ່</a></li>
        <li><a href="/sys/index.php?r=infonCar/listrunpai"><span class="fa fa-money"></span>​ລົດ​ທີ່​ແລ່ນ​ປ້າຍ</a></li>

        <li class="treeview">
            <a href="">
                <i class="fa fa-reply"></i>
                ລາຍ​ງານ
            </a>
            <ul class="treeview-menu">
                <li><a href="sys/index.php?r=infonCar/reportsalecar&rs=1"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຂາຍແລ້ວ</a></li>
                <li><a href="sys/index.php?r=infonCar/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportsalecar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ຂາຍແລ້ວ</a></li>
                <li><a href="sys/index.php?r=infonCar/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລົດທີ່ຍັງເຫຼຶອ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportcar"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາໄຫຼ່ທີ່ຍັງເຫຼຶອ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportshare"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່ທີ່ໂອນ​ໃຫ້​ສາ​ຂາ</a></li>
                <li><a href="sys/index.php?r=paymentIn/reportpayin"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບລາຍ​ຈ່າຍ</a></li>
                <li><a href="sys/index.php?r=acountTransfer/reporttransfer"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບເງີນ​ໂອນ​ເຂົ້າ​ບັນ​ຊີ</a></li>                                   
                <li><a href="sys/index.php?r=infonCar/reportdaily"><span class="glyphicon glyphicon-file"></span>ລາຍ​ຮັ​ບ​ລາຍ​ເດືອນ</a></li>
                <li><a href="sys/index.php?r=infoSpares/reportbycount"><span class="glyphicon glyphicon-file"></span>ສະຫຼຸບອາ​ໄຫຼ່​ຕາມ​ຈຳ​ນວນ</a></li>
            </ul>          
        </li>
        <?php
    }
    ?>
</ul>  