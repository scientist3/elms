<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>" class="brand-link">
    <img src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/img/AdminLTELogo.png" alt="Online ES" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Online ES</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Online ES</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url('teacher/home/index'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == "home") ? "active" : null; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <li class="nav-item <?php echo ($this->uri->segment(2) == "exam") ? "menu-is-opening menu-open" : null; ?>">
          <a href="#" class="nav-link <?php echo ($this->uri->segment(2) == "exam") ? "active" : null; ?>">
            <!-- <i class="nav-icon fas fa-copy"></i> -->
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>
              Exam
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('teacher/exam/create'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == "exam" && $this->uri->segment(3) == "create") ? "active" : null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Exam</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('teacher/exam/index'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == "exam" && $this->uri->segment(3) == "index") ? "active" : null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Exam</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item <?php echo ($this->uri->segment(2) == "question") ? "menu-is-opening menu-open" : null; ?>">
          <a href="#" class="nav-link <?php echo ($this->uri->segment(2) == "question") ? "active" : null; ?>">
            <i class="nav-icon fa fa-question-circle"></i>
            <p>
              Questions
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="<?php echo base_url('teacher/question/create'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add question</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="<?php echo base_url('teacher/question/index'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == "question" && $this->uri->segment(3) == "index") ? "active" : null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add/View question</p>
              </a>
            </li>

          </ul>
        </li>
        <li class="nav-item <?php echo ($this->uri->segment(2) == "response") ? "menu-is-opening menu-open" : null; ?>">
          <a href="#" class="nav-link <?php echo ($this->uri->segment(2) == "response") ? "active" : null; ?>">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Responses
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('teacher/response/index'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == "response" && $this->uri->segment(3) == "index") ? "active" : null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View responses</p>
              </a>
            </li>

          </ul>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>