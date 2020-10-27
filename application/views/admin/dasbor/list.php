<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Akses Level</th>
      <th>Username</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Nama</th>
      <th>Akses Level</th>
      <th>Username</th>
    </tr>
  </tfoot>
  <tbody>
    <tr>
      <td><?php echo $this->session->userdata('nama'); ?></td>
      <td><?php echo $this->session->userdata('akses_level'); ?></td>
      <td><?php echo $this->session->userdata('username'); ?></td>
    </tr>
  </tbody>
</table>

