<table class="table table-bordered">
    <tr>
        <th>ລຳ​ດັບ</th>
        <th>ຊື່ ແລະ ນາມ​ສະ​ການ</th>
        <th>ອາ​ຍຸ</th>
        <th>ບ່ອນ​ຢູ່</th>
        <th>ເບີ​ໂທ</th>
        <th>ສາ​ຂາ</th>
        <?php
        $i = 0;
        foreach ($model as $models) {
            $i++;
            ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $models->name . " " . $models->lastname ?></td>
            <td><?= $models->age ?></td>
            <td><?= $models->address ?></td>
            <td><?= $models->tel ?></td>
            <td><?= $models->branch->branch_name ?></td>
        </tr>
        <?php
    }
    ?>
</tr>
</table>