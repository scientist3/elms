<!-- DataTables -->
<link href="<?= base_url('vendor/almasaeed2010/adminlte/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url('vendor/almasaeed2010/adminlte/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url('vendor/almasaeed2010/adminlte/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- Save -->
    <div class="col-sm-4">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title"><i class="fa fa-plus"></i> <?php echo $subtitle; ?></h3>

        </div>
        <div class="card-body">
          <!-- <?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?> -->

          <?php if ($this->session->flashdata('msg') != null) {  ?>
            <div class="alert alert-info alert-dismissable" style="font-size: 1rem;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->session->flashdata('msg'); ?>
            </div>
          <?php } ?>

          <?php if ($this->session->flashdata('exp') != null) {  ?>
            <div class="alert alert-danger alert-dismissable" style="font-size: 1rem;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->session->flashdata('exp'); ?>
            </div>
          <?php } ?>

          <div class="row">
            <div class="col-md-12">

              <form role="form" action="<?php echo site_url('admin/department/create') ?>" method="post" id="save_type_form">
                <?php echo form_hidden('dept_id', $input->dept_id) ?>

                <div class="row">

                  <!-- status_name -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="dept_name"><?php echo ('Name'); ?></label> <small class="req"> *</small>
                      <input name="dept_name" class="form-control form-control-sm" type="text" placeholder="<?php echo ('Name') ?>" id="dept_name" value="<?php echo $input->dept_name; ?>" data-toggle="tooltip" title="<?php echo ('Department Name'); ?>">
                      <?php echo form_error('dept_name', '<span class="badge bg-danger p-1">', '</span>'); ?>
                    </div>
                  </div>

                  <!-- Description -->
                  <!-- <div class="col-sm-12">
                  <div class="form-group">
                    <label for="ps_desc"><?php echo ('description'); ?></label> <small class="req"> *</small>
                    <input name="ps_desc" class="form-control " type="text" placeholder="<?php echo ('description') ?>" id="ps_desc" value="<?php echo $input->ps_desc; ?>" data-toggle="tooltip" title="<?php echo ('description'); ?>">
                    <?php echo form_error('ps_desc', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div> -->

                  <!-- Satus -->
                  <div class="col-sm-12">
                    <div class="form-group ">
                      <label for="dept_status"><?php echo ('Status'); ?></label>
                      <div class="form-check row form-inline form-control-sm">
                        <div class="col-6 form-inline">
                          <label class=" col-sm-6 radio-inline">
                            <input type="radio" name="dept_status" value="1" <?= ($input->dept_status == '1') ? 'checked' : null; ?> data-toggle="tooltip" title="Active status">
                            <?php echo (' Active') ?>
                          </label>
                        </div>
                        <div class="col-6 form-inline">
                          <label class="col-sm-6 radio-inline">
                            <input type="radio" name="dept_status" value="0" <?= ($input->dept_status == '0') ? 'checked' : null; ?> data-toggle="tooltip" title="Disabled status"> &nbsp;<?php echo ('Inactive') ?>
                          </label>
                        </div>
                        <br>
                      </div>
                      <?php echo form_error('dept_status', '<span class="badge bg-danger p-1">', '</span>'); ?>
                    </div>
                  </div>
                  <!-- </div> 
                
                            <div class="row"> -->
                  <!-- Submit -->
                  <div class="col-sm-12 ">
                    <div class="form-group">
                      <!-- <label>Submit</label> -->
                      <?php if ($this->uri->segment(3) != "edit") { ?>
                        <button type="submit" name="save" value="add_station" class="form-control form-control-sm btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-plus"> &nbsp;<?php echo ('Save'); ?></i></button>
                      <?php } else { ?>

                        <button type="submit" name="save" value="edit_station" class="form-control form-control-sm btn btn-warning btn-sm pull-right checkbox-toggle"><i class="fa fa-edit"> &nbsp;<?php echo ('Update'); ?></i></button>
                      <?php } ?>
                    </div>
                  </div>

                </div>
                <!-- <hr><hr> -->
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Search -->
    <!-- Display -->
    <div class="col-sm-8">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Department List
          </h3>
          <!-- <a class="btn btn-warning pull-right" href="< ?= base_url('admin/transaction/payment_report/').$search->start_date.'/'.$search->end_date; ?>"><i class="fa fa-print"></i></a> -->
        </div>

        <div class="card-body">
          <table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th><?php echo ('Unique Id') ?></th>
                <th><?php echo ('Name') ?></th>
                <!-- <th><?php echo ('parent') ?></th> -->
                <th><?php echo ('Status') ?></th>
                <th><?php echo ('Action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($departments)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($departments as $department) { ?>
                  <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $department->dept_name ?></td>
                    <td class="text-center">
                      <?php echo ($department->dept_status) ?
                        '<i class="fa fa-check" aria-hidden="true"></i>' :
                        '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
                    </td>
                    <td class="text-center" width="100">
                      <?php if (!in_array($department->dept_id, [])) { ?>
                        <a href="<?php echo base_url("admin/department/edit/$department->dept_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url("admin/department/delete/$department->dept_id/") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo ('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php $sl++; ?>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table> <!-- /.table-responsive -->
        </div>
      </div>
    </div>


  </div>
</section>
<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/') ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- jquery-validation -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/jquery.validate.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $(function() {
      // $('#save_type_form').validate({
      //   rules: {
      //     dept_name: {
      //       required: true,
      //     },
      //     dept_status: {
      //       required: true,
      //     }
      //   },
      //   messages: {
      //     dept_name: {
      //       required: "Please provide a Property Label Name"
      //     },
      //     dept_status: {
      //       required: "Please select status"
      //     }
      //   },
      //   errorElement: 'span',
      //   errorPlacement: function(error, element) {
      //     error.addClass('badge badge-danger invalid-feedback');
      //     element.siblings('span.invalid-feedback').remove();
      //     element.closest('.form-group').append(error);
      //   },
      //   highlight: function(element, errorClass, validClass) {
      //     $(element).addClass('is-invalid');
      //   },
      //   unhighlight: function(element, errorClass, validClass) {
      //     $(element).removeClass('is-invalid');
      //   }
      // });
    });
    //$('[data-toggle="tooltip"]').tooltip();
    //bsCustomFileInput.init();

    // $('.datatable2').DataTable({
    //   responsive: true,
    //   dom: "<'row'<'col-sm-6 btn-sm'B><'col-sm-6 p-1'f>>tp",
    //   "lengthChange": false,
    //   "autoWidth": false,
    //   // "lengthMenu": [
    //   //   [10, 25, 50, -1],
    //   //   [10, 25, 50, "All"]
    //   // ],
    //   buttons: [{
    //     extend: 'colvis',
    //     className: 'btn-sm'
    //   }]
    // });
    // $(".dataTables_wrapper > div > div")[0].remove();
    // $(".dataTables_wrapper > div > div").each(function() {
    //   $(this).addClass('col-sm-6');
    // });
  });
</script>


<!-- DataTables JavaScript -->

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jszip/jszip.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/pdfmake/pdfmake.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/pdfmake/vfs_fonts.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  "use strict";
  $(document).ready(function() {

    //bsCustomFileInput.init();
    //datatable
    $('.datatable').DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      buttons: [{
          extend: 'copy',
          className: 'btn-sm'
        },
        {
          extend: 'csv',
          title: 'ExampleFile',
          className: 'btn-sm'
        },
        {
          extend: 'excel',
          title: 'ExampleFile',
          className: 'btn-sm',
          title: 'exportTitle'
        },
        {
          extend: 'pdf',
          title: 'ExampleFile',
          className: 'btn-sm'
        },
        {
          extend: 'print',
          className: 'btn-sm'
        }
      ]
    });

    $('.simple_datatable').DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-4'><'col-sm-4 text-center'B><'col-sm-4'>>",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      buttons: [{
          extend: 'copy',
          className: 'btn-sm'
        },
        {
          extend: 'csv',
          title: 'ExampleFile',
          className: 'btn-sm'
        },
        {
          extend: 'excel',
          title: 'ExampleFile',
          className: 'btn-sm',
          title: 'exportTitle'
        },
        {
          extend: 'pdf',
          title: 'ExampleFile',
          className: 'btn-sm'
        },
        {
          extend: 'print',
          className: 'btn-sm'
        }
      ]
    });

    // Datatable with column vis button only
    $('.datatable_colvis').DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-6 btn-sm'B><'col-sm-6 p-1'f>>tp",
      "lengthChange": false,
      "autoWidth": false,
      "lengthMenu": [
        [7, 10, 25, 50, -1],
        [7, 10, 25, 50, "All"]
      ],
      buttons: [{
        extend: 'colvis',
        className: 'btn-sm'
      }]
    });
  });
</script>