<?php
$myfile = fopen(Yii::app()->basePath . "/../../rules.txt", "r") or die("Unable to open file!");
$myfile2 = fopen(Yii::app()->basePath . "/../../rules.txt", "r") or die("Unable to open file!");
?>
<br/>
<?php
if (Yii::app()->user->checkAccess('Admin')) {
    ?>
    <form action="index.php?r=site/rules" method="POST">
        <textarea name="text" class="form-control" rows="12"><?= fread($myfile, filesize(Yii::app()->basePath . "/../../rules.txt")) ?></textarea>
        <br/>
        <div align="right">
            <input type="submit" name="submit" value="ບັນ​ທືກ" class="btn btn-primary btn-sm">
        </div>
    </form>
    <?php
}
?>
<div >
    <b>ລາຍ​ລະ​ອຽດ​ກົດ​ລະ​ບຽບ</b><br/>
    <?php
    echo nl2br(fread($myfile2, filesize(Yii::app()->basePath . "/../../rules.txt")));
    fclose($myfile);
    ?>
</div>