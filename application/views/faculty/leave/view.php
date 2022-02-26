<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- Status -->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Status
          </h3>
        </div>

        <div class="card-body">
          <table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th><?php echo ('Time Off Type') ?></th>
                <th><?php echo ('Earned') ?></th>
                <th><?php echo ('Comsumed') ?></th>
                <th><?php echo ('Pending') ?></th>
                <th><?php echo ('Balance Available') ?></th>
                <!-- <th><?php echo ('Faculty Name') ?></th>
                <th><?php echo ('Designation') ?></th>
                <th><?php echo ('Department') ?></th>
                <th><?php echo ('Type') ?></th>
                <th><?php echo ('To Date') ?></th>
                <th><?php echo ('From Date') ?></th>
                <th><?php echo ('Reason') ?></th>
                <th><?php echo ('Status') ?></th>
                <th><?php echo ('Action') ?></th> -->
              </tr>
            </thead>
            <tbody>
              <?php if (valArr($leave_types_list)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($leave_types_list as $lt_id => $leave_type) { ?>
                  <tr>
                    <!-- <td><?php echo $sl; ?></td> -->
                    <td><?php echo $leave_type ?></td>
                    <td><?php echo 5 ?></td>
                    <td><?php echo 6 ?></td>
                    <td><?php echo 4 ?></td>
                    <td><?php echo 6 ?></td>
                    </td>
                  </tr>
                  <?php $sl++; ?>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Display -->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Time Off Request --- <strong><?php echo $faculty_details->u_name . ' ' . $faculty_details->desg_name . ' ' . $faculty_details->dept_name; ?></strong>
          </h3>
          <!-- <a class="btn btn-warning pull-right" href="< ?= base_url('admin/transaction/payment_report/').$search->start_date.'/'.$search->end_date; ?>"><i class="fa fa-print"></i></a> -->
        </div>

        <div class="card-body">
          <table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <!-- <th><?php echo ('Unique Id') ?></th> -->
                <th><?php echo ('Time Off Type') ?></th>
                <th><?php echo ('Description') ?></th>
                <!-- <th><?php echo ('Faculty Name') ?></th> -->
                <!-- <th><?php echo ('Designation') ?></th> -->
                <!-- <th><?php echo ('Department') ?></th> -->
                <th><?php echo ('To Date') ?></th>
                <th><?php echo ('From Date') ?></th>
                <th><?php echo ('Status') ?></th>
                <th><?php echo ('Action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($leave)) { ?>
                <?php $sl = 1; ?>
                <!-- <?php //foreach ($leave as $leave) { 
                      ?> -->
                <tr>
                  <!-- <td><?php echo $sl; ?></td> -->
                  <td><?php echo $leave->leave_type ?></td>
                  <td><?php echo $leave->l_reason ?></td>
                  <!-- <td><?php echo $leave->faculty_name ?></td> -->
                  <!-- <td><?php echo $leave->faculty_desg ?></td> -->
                  <!-- <td><?php echo $leave->faculty_dept ?></td> -->
                  <td><?php echo date('D, d-M-Y', strtotime($leave->l_to_date)) ?></td>
                  <td><?php echo date('D, d-M-Y', strtotime($leave->l_from_date)) ?></td>
                  <td class="text-center">
                    <?php echo $leave->ls_name ?>
                  </td>
                  <td class="text-center" width="100">
                    <?php echo form_open('admin/leave/update', ['method' => 'post', 'class' => '', 'id' => 'leave_form',]); ?>
                    <?php echo form_hidden('l_id', $leave->l_id) ?>
                    <?php echo form_hidden('l_user_id', $leave->u_id) ?>
                    <?php echo form_dropdown('l_status', $leave_status_list, $leave->l_status, 'class="form-control form-control-sm" id="u_desg_id" requiredd'); ?>
                    <label for="l_comments" class="float-left">Comments</label>
                    <textarea class="" name="l_comments" id="l_comments" cols="20" rows="3"><?= $leave->l_comments; ?></textarea>

                    <button name="leave_update_btn" value="1" class="btn btn-sm btn-warning mt-2"><i class="fa fa-check "> Update</i></button>
                    </form>

                  </td>
                </tr>
                <!-- <?php //$sl++; 
                      ?> -->
                <!-- <?php // } 
                      ?> -->
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

<script type="text/javascript">
  $(document).ready(function() {
    $(function() {});
  });
</script>