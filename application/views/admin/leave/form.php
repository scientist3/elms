<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- Display -->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Pending Time Off Requests
          </h3>
          <!-- <a class="btn btn-warning pull-right" href="< ?= base_url('admin/transaction/payment_report/').$search->start_date.'/'.$search->end_date; ?>"><i class="fa fa-print"></i></a> -->
        </div>

        <div class="card-body">
          <table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th><?php echo ('Unique Id') ?></th>
                <th><?php echo ('Faculty Name') ?></th>
                <th><?php echo ('Designation') ?></th>
                <th><?php echo ('Department') ?></th>
                <th><?php echo ('Type') ?></th>
                <th><?php echo ('From Date') ?></th>
                <th><?php echo ('To Date') ?></th>
                <th><?php echo ('Reason') ?></th>
                <th><?php echo ('Status') ?></th>
                <th><?php echo ('Action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($leaves)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($leaves as $leave) { ?>
                  <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $leave->faculty_name ?></td>
                    <td><?php echo $leave->faculty_desg ?></td>
                    <td><?php echo $leave->faculty_dept ?></td>
                    <td><?php echo $leave->leave_type ?></td>
                    <td><?php echo date('d-M-Y', strtotime($leave->l_from_date)) ?></td>
                    <td><?php echo date('d-M-Y', strtotime($leave->l_to_date)) ?></td>
                    <td><?php echo $out = strlen($leave->l_reason) > 50 ? substr($leave->l_reason, 0, 50) . "..." : $leave->l_reason; ?></td>
                    <td class="text-center">
                      <?php echo $leave->ls_name ?>
                    </td>
                    <td class="text-center" width="100">
                      <?php if (!in_array($leave->l_id, [])) { ?>
                        <a href="<?php echo base_url("admin/leave/view/$leave->l_id/$leave->u_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                        <!-- <a href="<?php echo base_url("admin/leave/edit/$leave->l_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a> -->
                        <!-- <a href="<?php echo base_url("admin/leave/delete/$leave->l_id/") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo ('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> -->
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
    <!-- Save -->
    <?php /*
    <div class="col-sm-4">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title"><i class="fa fa-plus"></i> <?php echo $subtitle; ?></h3>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">

              <form role="form" action="<?php echo site_url('admin/leave/create') ?>" method="post" id="save_type_form">
                <!-- <?php echo form_hidden('l_id', $input->l_id) ?> -->

                <div class="row">

                  <!-- status_name -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="dept_name"><?php echo ('Name'); ?></label> <small class="req"> *</small>
                      <input name="dept_name" class="form-control form-control-sm" type="text" placeholder="<?php echo ('Name') ?>" id="dept_name" value="<?php echo $input->dept_name; ?>" data-toggle="tooltip" title="<?php echo ('leave Name'); ?>">
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
                          <label class=" radio-inline">
                            <input type="radio" name="dept_status" value="1" <?= ($input->dept_status == '1') ? 'checked' : null; ?> data-toggle="tooltip" title="Active status">&nbsp;
                            <?php echo ('Active') ?>
                          </label>
                        </div>
                        <div class="col-6 form-inline">
                          <label class=" radio-inline">
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
    */ ?>


  </div>
</section>
<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/') ?>plugins/jquery/jquery.min.js"></script>
<!-- <script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script> -->

<!-- jquery-validation -->
<!-- <script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/jquery.validate.min.js"></script> -->

<!-- <script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/additional-methods.min.js"></script> -->

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