<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4>
	<!-- Brand Logo -->
	<a href=" <?php echo base_url('admin/home'); ?>" class="brand-link">
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
					<a href="<?php echo base_url('admin/home/index') ?>" class="nav-link <?php echo (($this->uri->segment(1) == 'admin') && (($this->uri->segment(2) == 'home')) ? "active" : null) ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							<?= ('Dashboard'); ?>
							<!-- <i class="right fas fa-angle-left"></i> -->
						</p>
					</a>
				</li>
				<!-- ############# Institution #############-->
				<li class="nav-item <?php echo ($this->uri->segment(2) == "institution") ? "menu-open" : null; ?>">
					<a href="#" class="nav-link <?php echo ($this->uri->segment(2) == "property") || ($this->uri->segment(2) == "unit") ? "active" : null; ?>">
						<i class="nav-icon fas fa-building"></i>
						<p>
							<?php echo ('Institution') ?>
							<i class="fas fa-angle-left right"></i>
							<!-- <span class="badge badge-info right">6</span> -->
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("admin/institution/index") ?>" class="nav-link <?php echo ($this->uri->segment(3) == "index") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('Add Instiution') ?></p>
							</a>
						</li>

					</ul>
				</li>


				<!-- ############# Other Details #############-->
				<li class="nav-item <?php echo (in_array($this->uri->segment(2), ["department", "type", "label", "feature"])) ? "menu-open" : null; ?>">
					<a href="#" class="nav-link <?php echo (in_array($this->uri->segment(2), ["status", "type", "label", "feature"])) ? "active" : null; ?>">
						<i class="nav-icon fas fa-balance-scale"></i>
						<p>
							<?php echo ('Other Details') ?>
							<i class="fas fa-angle-left right"></i>
							<!-- <span class="badge badge-info right">6</span> -->
						</p>
					</a>
					<ul class="nav nav-treeview">

						<li class="nav-item">
							<a href="<?php echo base_url("admin/department") ?>" class="nav-link <?php echo (in_array($this->uri->segment(2), ["department"])) ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('Add View Department') ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("admin/type") ?>" class="nav-link <?php echo ($this->uri->segment(2) == "type") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('add_view_type') ?></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("admin/status") ?>" class="nav-link <?php echo ($this->uri->segment(2) == "status") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('add_view_status') ?></p>
							</a>
						</li>



						<li class="nav-item">
							<a href="<?php echo base_url("admin/label") ?>" class="nav-link <?php echo ($this->uri->segment(2) == "label") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('add_view_label') ?></p>
							</a>
						</li>
					</ul>
				</li>

				<!-- ############# Settings#############-->
				<li class="nav-item <?php echo ($this->uri->segment(1) == "setting") ? "menu-open" : null; ?>">
					<a href="#" class="nav-link <?php echo ($this->uri->segment(2) == "setting") ? "active" : null; ?>">
						<i class="nav-icon fas fa-cogs"></i>
						<p>
							<?php echo ('settings') ?>
							<i class="fas fa-angle-left right"></i>
							<!-- <span class="badge badge-info right">6</span> -->
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("setting") ?>" class="nav-link <?php echo ($this->uri->segment(1) == "setting") ? "active" : null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo ('app_setting') ?></p>
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
				<li class="nav-item">
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