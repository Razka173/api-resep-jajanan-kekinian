<div>
    <p class="text-lg">User Log:</p>
</div>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>User Id</th>
            <th>Action</th>
            <th>Type</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>User Id</th>
            <th>Action</th>
            <th>Type</th>
            <th>Timestamp</th>
        </tr>
    </tfoot>
    <tbody>
        <?php $no = 1;
        foreach ($log as $log) { ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $log->user_id ?></td>
            <td><?php echo $log->action ?></td>
            <td><?php echo $log->type ?></td>
            <td><?php echo $log->created_time ?></td>
            <!-- <td>
                <a href="<?php echo base_url('admin/bahan/edit/' . $bahan->id) ?>" class="btn btn-warning btn-xs"><i
                        class="fa fa-edit"></i> Edit</a>

                <?php include('delete.php') ?>
            </td> -->
        </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>
<hr>
<div>
    <p class="text-lg">Data log untuk type:</p>
</div>
<div style="width: 600px;">
    <canvas id="myPieChart"></canvas>
</div>
<hr>
<div>
    <p class="text-lg">Data log untuk action terbanyak:</p>
</div>
<div style="width: 600px;">
    <canvas id="actionterbanyak"></canvas>
</div>
<hr>
<div>
    <p class="text-lg">Data log untuk user teraktif:</p>
</div>
<div style="width: 600px;">
    <canvas id="userteraktif"></canvas>
</div>
<hr>
<div>
    <p class="text-lg">Data Resep terfavorit:</p>
</div>
<div style="width: 600px;">
    <canvas id="resepterfavorit"></canvas>
</div>
<hr>
<div>
    <p class="text-lg">Data Resep terpopuler:</p>
</div>
<div style="width: 600px;">
    <canvas id="resepterpopuler"></canvas>
</div>