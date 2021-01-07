<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Username</th>
      <th>Akses Level</th>
      <th>Login Terakhir</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($admin as $admin){?>
    <tr>
      <td> <?php echo $admin->nama ?></td>
      <td> <?php echo $admin->username ?></td>
      <td> <?php echo $admin->akses_level ?></td>
      <th> <?php echo $this->simple_login->time_elapsed_string($admin->last_login); ?> </th>
    </tr>
    <?php }?>
  </tbody>
</table>

