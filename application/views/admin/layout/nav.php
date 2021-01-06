    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fab fa-weebly"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><?php echo 'Admin' ?></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- DASHBOARD -->
        <li class="nav-item <?php if (strpos(strtolower($title), 'administrator')) {
                            echo 'active';
                          } ?>">
            <a class="nav-link" href="<?php echo base_url('admin/dasbor') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- MENU RESEP -->
        <li class="nav-item <?php if (strpos(strtolower($title), 'resep')) {
                            echo 'active';
                          } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResep"
                aria-expanded="true" aria-controls="collapseResep">
                <i class="fas fa-fw fa-hamburger"></i>
                <span>Data Resep</span>
            </a>
            <div id="collapseResep" class="collapse" aria-labelledby="headingResep" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/resep') ?>"><i
                            class="fas fa-fw fa-table"></i> Data Resep</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/resep/tambah') ?>"><i
                            class="fas fa-fw fa-plus"></i> Tambah Resep</a>
                </div>
            </div>
        </li>

        <!-- MENU BAHAN -->
        <li class="nav-item <?php if (strpos(strtolower($title), 'bahan')) {
                            echo 'active';
                          } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBahan"
                aria-expanded="true" aria-controls="collapseBahan">
                <i class="fas fa-fw fa-cheese"></i>
                <span>Data Bahan</span>
            </a>
            <div id="collapseBahan" class="collapse" aria-labelledby="headingBahan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/bahan') ?>"><i
                            class="fas fa-fw fa-table"></i> Data Bahan</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/bahan/tambah') ?>"><i
                            class="fas fa-fw fa-plus"></i> Tambah Bahan</a>
                </div>
            </div>
        </li>

        <!-- MENU USER -->
        <li class="nav-item <?php if (strpos(strtolower($title), 'pengguna')) {
                            echo 'active';
                          } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna"
                aria-expanded="true" aria-controls="collapsePengguna">
                <i class="fas fa-fw fa-user"></i>
                <span>Pengaturan Pengguna</span>
            </a>
            <div id="collapsePengguna" class="collapse" aria-labelledby="headingPengguna"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/user') ?>"><i
                            class="fas fa-fw fa-table"></i> Data Pengguna</a>
                    <!-- <a class="collapse-item" href="<?php echo base_url('admin/user/tambah') ?>"><i
                            class="fas fa-fw fa-plus"></i> Tambah Pengguna</a> -->
                </div>
            </div>
        </li>

        <!-- DISKUSI -->
        <li class="nav-item <?php if (strpos(strtolower($title), 'diskusi')) {
                            echo 'active';
                          } ?>">
            <a class="nav-link" href="<?php echo base_url('admin/diskusi') ?>">
                <i class="fas fa-fw fa-comment"></i>
                <span>Diskusi</span></a>
        </li>

        <!-- VERIFIKASI -->
        <li class="nav-item <?php if (strpos(strtolower($title), 'verifikasi')) {
                            echo 'active';
                          } ?>">
            <a class="nav-link" href="<?php echo base_url('admin/verifikasi') ?>">
                <i class="fas fa-fw fa-check"></i>
                <span>Verifikasi</span></a>
        </li>

        <!-- Report -->
        <li class="nav-item <?php if (strpos(strtolower($title), 'report')) {
                            echo 'active';
                          } ?>">
            <a class="nav-link" href="<?php echo base_url('admin/report') ?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Report</span></a>
        </li>
        <!-- MENU STEP RESEP -->
        <!-- <li class="nav-item <?php if (strpos(strtolower($title), 'step')) {
                                  echo 'active';
                                } ?>">
        <a class="nav-link" href="<?php echo base_url('admin/step') ?>">
          <i class="fa fa-fw fa-check"></i>
          <span>Step Resep</span></a>
      </li> -->

        <!-- MENU KULKAS -->
        <!-- <li class="nav-item <?php if (strpos(strtolower($title), 'kulkas')) {
                                  echo 'active';
                                } ?>">
        <a class="nav-link" href="<?php echo base_url('admin/kulkas') ?>">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Kulkas</span></a>
      </li> -->

        <!-- MENU USER -->
        <!-- <li class="nav-item <?php if (strpos(strtolower($title), 'pengguna')) {
                                  echo 'active';
                                } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna" aria-expanded="true" aria-controls="collapsePengguna">
          <i class="fas fa-fw fa-lock"></i>
          <span>Null</span>
        </a>
        <div id="collapsePengguna" class="collapse" aria-labelledby="headingPengguna" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/user') ?>"><i class="fas fa-fw fa-table"></i> Data Pengguna</a>
            <a class="collapse-item" href="<?php echo base_url('admin/user/tambah') ?>"><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</a>
          </div>
        </div>
      </li> -->

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->