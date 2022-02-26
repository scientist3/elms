<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4>
	<!-- Brand Logo -->
	<a href=" <?php echo base_url('faculty/home'); ?>" class="brand-link">
	<?php
	$logo = $this->session->userdata('logo');
	$logo = (!empty($logo)) ? base_url($logo) : base_url('uploads/no_logo.png');
	?>
	<img src="<?php echo $logo; ?>" alt="Employee Leave MS" class="brand-image img-circlee elevation-3" style="opacity: .8">
	<!-- <span class="brand-text font-weight-light">HYUN KUNUN</span> -->
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<!-- // Fixme: -->
				<img src="<?php echo (!empty($picture) ? base_url($picture) : base_url("uploads/noimageold.png")) ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?php echo $this->session->userdata('fullname') ?></a>
				<a href="#" class="d-block text-xs"><i class="fa fa-circle text-success text-xs"></i>
					<?php echo $user_role_list[$this->session->userdata('user_role')]; ?>
				</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-compactt" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?php echo base_url('faculty/home/index') ?>" class="nav-link <?php echo (($this->uri->segment(1) == 'admin') && (($this->uri->segment(2) == 'home')) ? "active" : null) ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							<?= ('Dashboard'); ?>
							<!-- <i class="right fas fa-angle-left"></i> -->
						</p>
					</a>
				</li>


				<!-- ############# Add leave #############-->
				<li class="nav-item <?php echo ($this->uri->segment(2) == "leave") ? "menu-open" : null; ?>">
					<a href="#" class="nav-link <?php echo ($this->uri->segment(2) == "leave") || ($this->uri->segment(2) == "unit") ? "active" : null; ?>">
						<i class="nav-icon fas fa-power-off"></i>
						<p>
							<?php echo ('Leave / Time Off') ?>
							<i class="fas fa-angle-left right"></i>
							<!-- <span class="badge badge-info right">6</span> -->
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("faculty/leave/index") ?>" class="nav-link <?php echo ($this->uri->segment(3) == "index") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('Apply For Time Off') ?></p>
							</a>
						</li>

					</ul>
				</li>

				<!-- ############# Settings#############-->
				<li class=" d-none nav-item <?php echo ($this->uri->segment(1) == "setting") ? "menu-open" : null; ?>">
					<a href="#" class="nav-link <?php echo ($this->uri->segment(2) == "setting") ? "active" : null; ?>">
						<i class="nav-icon fas fa-cogs"></i>
						<p>
							<?php echo ('Settings') ?>
							<i class="fas fa-angle-left right"></i>
							<!-- <span class="badge badge-info right">6</span> -->
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("setting") ?>" class="nav-link <?php echo ($this->uri->segment(1) == "setting") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('Institution Setting') ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("language") ?>" class="nav-link <?php echo ($this->uri->segment(1) == "language") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('language') ?></p>
							</a>
						</li>
					</ul>
				</li>

				<!--############# Contact#############-->
				<li class="nav-item d-none">
					<a href="<?php echo base_url("contactus/index") ?>" class="nav-link <?php echo ($this->uri->segment(1) == "contactus") ? "active" : null; ?>">
						<i class="nav-icon fas fa-th"></i>
						<p>
							<?php echo ('message') ?>
							<span class="right badge badge-danger"><?php echo !empty($new_messages) ? 'New' : ''; ?></span>
						</p>
					</a>
				</li>

			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>