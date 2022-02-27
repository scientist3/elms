<?php $this->load->view('admin/layout/header') ?>
<?php $this->load->view('admin/layout/navbar') ?>
<?php $this->load->view('admin/layout/sidebar') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $title ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- alert message -->
    <?php if ($this->session->flashdata('message') != null) {  ?>
        <div class="alert alert-info alert-dismissible m-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Alert!</h5>
            <?php echo $this->session->flashdata('message');
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
            } ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('exception') != null) {  ?>
        <div class="alert alert-danger alert-dismissable  m-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i>Alert</h5>
            <?php echo $this->session->flashdata('exception');
            if (isset($_SESSION['exception'])) {
                unset($_SESSION['exception']);
            } ?>
        </div>
    <?php } ?>

    <?php if (validation_errors()) {  ?>
        <div class="alert alert-danger alert-dismissable  m-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i>Alert</h5>
            <?php echo validation_errors(); ?>
        </div>
    <?php } ?>


    <?php echo !empty($contents) ? $contents : null; ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('admin/layout/footer') ?>