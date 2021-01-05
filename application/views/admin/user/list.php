<h2>Pengguna Saat Ini Berjumlah: <?= count($user); ?> Pengguna</h2>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
    </tfoot>
    <tbody>
        <?php $no = 1;
        foreach ($user as $user) { ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $user->nama ?></td>
            <td><?php echo $user->email ?></td>
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