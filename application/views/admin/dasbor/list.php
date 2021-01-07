<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Akses Level</th>
      <th>Username</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($admin as $admin){?>
    <tr>
      <td> <?php echo $admin->nama ?></td>
      <td> <?php echo $admin->username ?></td>
      <td> <?php echo $admin->akses_level ?></td>
    </tr>
    <?php }?>
  </tbody>
</table>

