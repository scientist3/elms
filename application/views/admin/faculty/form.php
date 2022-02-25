<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- Save -->
    <div class="col-sm-12">

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


      <?php echo form_open('admin/faculty/index', ['method' => 'post', 'class' => '', 'id' => 'faculty_form', 'enctype' => 'multipart/form-data']); ?>
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title"><i class="fa fa-plus"></i> <?php echo $subtitle; ?></h3>
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-md-12">


              <?php echo form_hidden('u_id', $input->u_id) ?>

              <div class="row">

                <!-- u_name -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="u_name"><?php echo ('Name'); ?></label> <small class="req"> *</small>
                    <input name="u_name" class="form-control form-control-sm" type="text" placeholder="<?php echo ('Name') ?>" id="u_name" value="<?php echo $input->u_name; ?>" data-toggle="tooltip" title="<?php echo ('Faculty Name'); ?>">
                    <?php echo form_error('u_name', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_desg_id -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="u_desg_id"><?php echo ('Designation'); ?></label> <i class="req text-danger"> *</i>
                    <?php echo form_dropdown('u_desg_id', $designation_list, $input->u_desg_id, 'class="form-control form-control-sm" id="u_desg_id" requiredd'); ?>
                    <?php echo form_error('u_desg_id', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_dept_id -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="u_dept_id"><?php echo ('Department'); ?></label> <i class="req text-danger"> *</i>
                    <?php echo form_dropdown('u_dept_id', $department_list, $input->u_dept_id, 'class="form-control form-control-sm" id="u_dept_id" requiredd'); ?>
                    <?php echo form_error('u_dept_id', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_mobile -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="u_mobile"><?php echo ('Mobile No'); ?></label>
                    <!-- <small class="req"> *</small> -->
                    <input name="u_mobile" class="form-control form-control-sm" type="text" placeholder="<?php echo ('Mobile No') ?>" id="u_mobile" value="<?php echo $input->u_mobile; ?>" data-toggle="tooltip" title="<?php echo ('Mobile Number'); ?>">
                    <?php echo form_error('u_mobile', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_email -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="u_email"><?php echo ('Email'); ?></label>
                    <small class="req"> *</small>
                    <input name="u_email" class="form-control form-control-sm" type="email" placeholder="<?php echo ('Email') ?>" id="u_email" value="<?php echo $input->u_email; ?>" data-toggle="tooltip" title="<?php echo ('Email'); ?>">
                    <?php echo form_error('u_email', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_password -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="u_password"><?php echo ('Password'); ?></label> <small class="req"> *</small>
                    <input name="u_password" class="form-control form-control-sm" type="text" placeholder="<?php echo ('Password') ?>" id="u_password" value="<?php echo $input->u_password ?? 'faculty@123'; ?>" data-toggle="tooltip" title="<?php echo ('Password'); ?>">
                    <?php echo form_error('u_password', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_status -->
                <div class="col-sm-3">
                  <div class="form-group ">
                    <label for="u_status"><?php echo ('Status'); ?></label>
                    <div class="form-check row form-inline form-control-sm">
                      <div class="col-6 form-inline">
                        <label class="  radio-inline">
                          <input type="radio" name="u_status" value="1" <?= ($input->u_status == '1' || ($input->u_status != '0')) ? 'checked' : null; ?> data-toggle="tooltip" title="Active status">&nbsp;
                          <?php echo ('Active') ?>
                        </label>
                      </div>
                      <div class="col-6 form-inline">
                        <label class=" radio-inline">
                          <input type="radio" name="u_status" value="0" <?= ($input->u_status == '0') ? 'checked' : null; ?> data-toggle="tooltip" title="Disabled status"> &nbsp;<?php echo ('Inactive') ?>
                        </label>
                      </div>
                      <br>
                    </div>
                    <?php echo form_error('u_status', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>



              </div>
              <!-- <hr><hr> -->

            </div>

          </div>

        </div>
        <div class="card-footer">
          <!-- Submit -->
          <div class="col-sm-3 float-right">
            <div class="form-group mb-0">
              <!-- <label>Submit</label> -->
              <?php if ($this->uri->segment(3) != "edit") { ?>
                <button type="submit" name="save" value="add_station" class="form-control form-control-sm btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-plus"> &nbsp;<?php echo ('Save'); ?></i></button>
              <?php } else { ?>

                <button type="submit" name="save" value="edit_station" class="form-control form-control-sm btn btn-warning btn-sm pull-right checkbox-toggle"><i class="fa fa-edit"> &nbsp;<?php echo ('Update'); ?></i></button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
    <!-- Search -->
    <!-- Display -->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Faculty List
          </h3>
          <!-- <a class="btn btn-warning pull-right" href="< ?= base_url('admin/transaction/payment_report/').$search->start_date.'/'.$search->end_date; ?>"><i class="fa fa-print"></i></a> -->
        </div>

        <div class="card-body">
          <table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th><?php echo ('Unique Id') ?></th>
                <th><?php echo ('Name') ?></th>
                <th><?php echo ('Designation') ?></th>
                <th><?php echo ('Department') ?></th>
                <th><?php echo ('Mobile No') ?></th>
                <th><?php echo ('Email') ?></th>
                <th><?php echo ('Status') ?></th>
                <th><?php echo ('Action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($users)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($users as $user) { ?>
                  <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $user->u_name ?></td>
                    <td><?php echo $designation_list[$user->u_desg_id] ?></td>
                    <td><?php echo $department_list[$user->u_dept_id] ?></td>
                    <td><?php echo $user->u_mobile ?></td>
                    <td><?php echo $user->u_email ?></td>
                    <td class="text-center">
                      <?php echo ($user->u_status) ?
                        '<i class="fa fa-check" aria-hidden="true"></i>' :
                        '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
                    </td>
                    <td class="text-center" width="100">
                      <?php if (!in_array($user->u_id, [])) { ?>
                        <a href="<?php echo base_url("admin/faculty/edit/$user->u_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url("admin/faculty/delete/$user->u_id/") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo ('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
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
<!-- <script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script> -->

<!-- jquery-validation -->
<!-- <script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/jquery.validate.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/additional-methods.min.js"></script> -->

<script type="text/javascript">
  $(document).ready(function() {
    $(function() {
      // $('#save_type_form').validate({
      //   rules: {
      //     u_name: {
      //       required: true,
      //     },
      //     u_status: {
      //       required: true,
      //     }
      //   },
      //   messages: {
      //     u_name: {
      //       required: "Please provide a Property Label Name"
      //     },
      //     u_status: {
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