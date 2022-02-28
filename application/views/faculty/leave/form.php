<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- Save -->
    <div class="col-sm-3">

      <div class="info-box">
        <span class="info-box-icon bg-warning"><i class="far fa-clock"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pending</span>
          <span class="info-box-number"><?= valArr($leave_status) ? $leave_status[0]->total_days : 0; ?></span>
        </div>
      </div>

      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Approved</span>
          <span class="info-box-number"><?= valArr($leave_status) ? $leave_status[1]->total_days : 0; ?></span>
        </div>
      </div>

      <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="fa fa-ban"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Rejected</span>
          <span class="info-box-number"><?= valArr($leave_status) ? $leave_status[2]->total_days : 0; ?></span>
        </div>
      </div>

      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa fa-calculator"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total</span>
          <span class="info-box-number"><?= valArr($leave_status) ? $leave_status[0]->total_days + $leave_status[1]->total_days + $leave_status[2]->total_days : 0; ?></span>
        </div>
      </div>
    </div>

    <div class="col-sm-9">
      <?php echo form_open('faculty/leave/index', ['method' => 'post', 'class' => '', 'id' => 'leave_form', 'enctype' => 'multipart/form-data']); ?>
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title"><i class="fa fa-plus"></i> <?php echo $subtitle; ?></h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <?php echo form_hidden('l_id', $input->l_id) ?>
                <!-- l_leave_type_id -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="l_leave_type_id"><?php echo ('Time Off Type'); ?></label> <i class="req text-danger"> *</i>
                    <?php echo form_dropdown('l_leave_type_id', $leave_types_list, $input->l_leave_type_id, 'class="form-control form-control-sm" id="l_leave_type_id" requiredd data-toggle="tooltip" title="Leave Type"'); ?>
                    <?php echo form_error('l_leave_type_id', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- l_from_date -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="l_from_date"><?php echo ('From Date'); ?></label> <small class="req"> *</small>
                    <input name="l_from_date" class="form-control form-control-sm" type="date" min="<?php echo date('Y-m-d', strtotime("0 Days")); ?>" placeholder="<?php echo ('From Date') ?>" id="l_from_date" value="<?php echo $input->l_from_date; ?>" data-toggle="tooltip" title="<?php echo ('From Date'); ?>">
                    <?php echo form_error('l_from_date', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- l_to_date -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="l_to_date"><?php echo ('To Date'); ?></label> <small class="req"> *</small>
                    <input name="l_to_date" class="form-control form-control-sm" type="date" min="<?php echo date('Y-m-d', strtotime("0 Days")); ?>" placeholder="<?php echo ('To Date') ?>" id="l_to_date" value="<?php echo $input->l_to_date; ?>" data-toggle="tooltip" title="<?php echo ('To Date'); ?>">
                    <?php echo form_error('l_to_date', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- l_is_half_day -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="l_is_half_day"><?php echo ('Full / Half Day'); ?></label> <i class="req text-danger"> *</i>
                    <?php echo form_dropdown('l_is_half_day', $full_half_list, $input->l_is_half_day, 'class="form-control form-control-sm" id="l_is_half_day" requiredd'); ?>
                    <?php echo form_error('l_is_half_day', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- l_first_or_second_half -->
                <div class="col-sm-4 ">
                  <div class="form-group">
                    <label for="l_first_or_second_half"><?php echo ('First / Second Half'); ?></label>
                    <?php

                    echo form_dropdown('l_first_or_second_half', $first_second_list, $input->l_first_or_second_half, 'class="form-control form-control-sm" id="l_first_or_second_half" disabled'); ?>
                    <?php echo form_error('l_first_or_second_half', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>


                <!-- l_reason -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="l_reason">Reason</label>
                    <textarea name="l_reason" id="l_reason" class="form-control" rows="3" placeholder="" data-toggle="tooltip" title="Please put forward you reason!"><?= $input->l_reason; ?></textarea>
                    <?php echo form_error('l_reason', '<span class="badge bg-danger p-1">', '</span>'); ?>
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

              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row mb-2">
            <div class="col-sm-4 offset-8">
              <div class="form-group mb-0">
                <!-- <label>Submit</label> -->
                <?php if ($this->uri->segment(3) != "edit") { ?>
                  <button type="submit" name="save" value="add_station" class="form-control  btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-plus"> &nbsp;<?php echo ('Save'); ?></i></button>
                <?php } else { ?>

                  <button type="submit" name="save" value="edit_station" class="form-control  btn btn-warning btn-sm pull-right checkbox-toggle"><i class="fa fa-edit"> &nbsp;<?php echo ('Update'); ?></i></button>
                <?php } ?>
              </div>
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
            <i class="fa fa-list"></i> Pending Time Off Requests
          </h3>
          <!-- <a class="btn btn-warning pull-right" href="< ?= base_url('admin/transaction/payment_report/').$search->start_date.'/'.$search->end_date; ?>"><i class="fa fa-print"></i></a> -->
        </div>

        <div class="card-body">
          <table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <!-- <th><?php echo ('Unique Id') ?></th> -->
                <!-- <th><?php echo ('Faculty Name') ?></th> -->
                <!-- <th><?php echo ('Designation') ?></th> -->
                <th><?php echo ('Applied On') ?></th>
                <th><?php echo ('Type') ?></th>
                <th><?php echo ('From Date') ?></th>
                <th><?php echo ('To Date') ?></th>
                <th><?php echo ('Reason') ?></th>
                <th><?php echo ('Status') ?></th>
                <th><?php echo ('Comments') ?></th>
                <th><?php echo ('Action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($leaves)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($leaves as $leave) { ?>
                  <tr>
                    <!-- <td><?php echo $sl; ?></td> -->
                    <!-- <td><?php echo $leave->faculty_name ?></td> -->
                    <!-- <td><?php echo $leave->faculty_desg ?></td> -->
                    <!-- <td><?php echo $leave->faculty_dept ?></td> -->
                    <td><?php echo date('d-M-Y', strtotime($leave->l_applied_date)) ?></td>
                    <td><?php echo $leave->leave_type ?></td>
                    <td><?php echo date('d-M-Y', strtotime($leave->l_from_date)) ?></td>
                    <td><?php echo date('d-M-Y', strtotime($leave->l_to_date)) ?></td>
                    <td><?php echo $out = strlen($leave->l_reason) > 50 ? substr($leave->l_reason, 0, 50) . "..." : $leave->l_reason; ?></td>
                    <td class="text-center">
                      <span class="badge badge-info"><?php echo $leave->ls_name ?></span>
                    </td>
                    <td><?php echo $out = strlen($leave->l_comments) > 300 ? substr($leave->l_comments, 0, 300) . "..." : $leave->l_comments; ?></td>
                    <td class="text-center" width="100">
                      <?php if (!in_array($leave->l_status, [2, 3])) { ?>
                        <a href="<?php echo base_url("faculty/leave/edit/$leave->l_id/$leave->u_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
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

      // On change Is Half Day
      $('#l_is_half_day').off('change').on('change', function() {
        if ($('#l_is_half_day').val() === 'half_day') {

          $('#l_to_date').prop('disabled', 'disabled');
          $('#l_first_or_second_half').prop('disabled', false);
          // $('#l_first_or_second_half').show(1000);
        } else {

          $('#l_to_date').prop('disabled', false);
          $('#l_first_or_second_half').prop('disabled', 'disabled');
          // $('#l_first_or_second_half').hide(1000);
        }
      });

      // Is Half Day
      $('#l_is_half_day').trigger('change');

      // Set the date on update 
      var from_date = "<?php echo $input->l_from_date; ?>";
      var to_date = "<?php echo $input->l_to_date; ?>";

      // console.log(from_date == "");
      if (from_date === "") {
        $('#l_from_date').prop('value', '<?php echo date('Y-m-d'); ?>');
        $('#l_to_date').prop('value', '<?php echo date('Y-m-d'); ?>');
      } else {
        $('#l_from_date').prop('value', '<?php echo date('Y-m-d', strtotime($input->l_from_date)); ?>');
        $('#l_to_date').prop('value', '<?php echo date('Y-m-d', strtotime($input->l_to_date . ' +1 day')); ?>');
      }

      // Disabled the past date 
      $('#l_from_date').off('change').on('change', function() {
        console.log('From Date Changed');
        $('#l_to_date').attr('min', $(this).val());
        $('#l_to_date').prop('value', $(this).val());
      });

      // Initialize the tooltip
      $('[data-toggle="tooltip"]').tooltip();

    });
    //bsCustomFileInput.init();

  });
</script>