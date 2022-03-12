<!-- Main content -->
<section class="content">
  <!-- <?= dd($leave); ?> -->
  <div class="row">
    <!-- <?= dd($faculty_details); ?> -->

    <!-- Profile -->
    <div class="col-md-5">

      <div class="card card-widget widget-user">
        <div class="widget-user-header bg-info">
          <h3 class="widget-user-username"><?php echo ucfirst($faculty_details->u_name); ?></h3>
          <h5 class="widget-user-desc"><?php echo $faculty_details->desg_name; // . ' - ' . $faculty_details->dept_name; 
                                        ?></h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle elevation-2" src="<?php echo (!empty($faculty_details->u_picture) ? base_url($faculty_details->u_picture) : base_url("uploads/noimageold.png")) ?>" alt="User Avatar">
        </div>
        <div class="card-footer">
          <div class="row border-bottomm">
            <div class="col-sm-4 border-right">
              <div class="description-block text-yellow text-bold">
                <h5 class="description-header"><span class="badge badge-warning"><?= $leave_statistics_by_status[1]->total_days ?? 0; ?></span></h5>
                <span class="description-text ">Pending</span>
              </div>

            </div>

            <div class="col-sm-4 border-right">
              <div class="description-block text-green text-bold">
                <h5 class="description-header"><span class="badge badge-success"><?= $leave_statistics_by_status[2]->total_days ?? 0; ?></span></h5>
                <span class="description-text">Approved</span>
              </div>

            </div>

            <div class="col-sm-4">
              <div class="description-block text-danger text-bold">
                <h5 class="description-header "><span class="badge badge-danger"><?= $leave_statistics_by_status[3]->total_days ?? 0; ?></span></h5>
                <span class="description-text">Rejected</span>
              </div>

            </div>

          </div>

          <div class="row mt-2">
            <div class="col-sm-12">

              <table width="100%" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                  <tr>
                    <th><?php echo ('Time Off Type') ?></th>
                    <th><?php echo ('Pending') ?></th>
                    <th><?php echo ('Approved') ?></th>
                    <th><?php echo ('Rejected') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (valArr($leave_statistics_by_leave_type)) { ?>
                    <?php $sl = 1; ?>
                    <?php foreach ($leave_statistics_by_leave_type as $leave_type_name => $arrLeaveStatus) { ?>
                      <tr>

                        <td><?php echo $leave_type_name ?></td>
                        <?php foreach ($arrLeaveStatus as $leave_status => $total_days) { ?>
                          <td><?php echo ($total_days['total_days']) ?></td>
                        <?php } ?>
                        </td>
                      </tr>
                      <?php $sl++; ?>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>

            </div>
          </div>

          <!-- FIXME: Hidden as of now -->
          <div class="row mt-4 d-none">
            <div class="col-sm-12">
              <?php if (0 && valArr($leave_types_list)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($leave_types_list as $lt_id => $leave_type) { ?>
                  <dl class="row mb-1">
                    <dt class="col-sm-8"><?php echo $leave_type ?></dt>
                    <dd class="col-sm-4">1</dd>
                  </dl>
                  <?php $sl++; ?>
                <?php } ?>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Status -->
    <!-- FIXME: Removed -->
    <div class="col-sm-7 d-none">
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
    <div class="col-md-7 col-sm-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Time Off Request</strong>
          </h3>
          <!-- <a class="btn btn-warning pull-right" href="< ?= base_url('admin/transaction/payment_report/').$search->start_date.'/'.$search->end_date; ?>"><i class="fa fa-print"></i></a> -->
        </div>

        <div class="card-body pb-0 ">
          <?php if (!empty($leave)) { ?>
            <dl class="row">
              <dt class="col-sm-4">Leave Type</dt>
              <dd class="col-sm-8"><?php echo $leave->leave_type ?></dd>

              <dt class="col-sm-4">Reason</dt>
              <dd class="col-sm-8"><?php echo $leave->l_reason; ?></dd>

              <dt class="col-sm-4">No Of Days</dt>
              <dd class="col-sm-8">

                <span class="badge badge-success">
                  <?php
                  $earlier = new DateTime($leave->l_from_date);
                  $later = new DateTime($leave->l_to_date);

                  $abs_diff = $later->diff($earlier)->format("%a"); //3
                  echo $abs_diff != 0 ? $abs_diff : 1;
                  ?>
                </span>
              </dd>

              <dt class="col-sm-4">From Date</dt>
              <dd class="col-sm-8"><?php echo date('d M Y', strtotime($leave->l_from_date)) ?></dd>

              <dt class="col-sm-4">To Date</dt>
              <dd class="col-sm-8"><?php echo date('d M Y', strtotime($leave->l_to_date)) ?></dd>

              <dt class="col-sm-4">Leave Status</dt>
              <dd class="col-sm-8">
                <span class="badge badge-success"><?php echo $leave->ls_name; ?></span>
              </dd>
              <dt class="col-sm-4">Supporting Document</dt>
              <dd class="col-sm-8">
                <?php if (!empty($leave->l_document)) { ?>
                  <a href="<?php echo base_url($leave->l_document) ?>" target="_BLANK" class="btn btn-xs btn-success"><i class="fa fa-eye"> View / Download</i></a>
                <?php } else { ?>
                  <span>N/A</span>
                <?php } ?>
              </dd>
            </dl>

          <?php } ?>
        </div>
        <div class="card-footer">
          <?php echo form_open('admin/leave/update', ['method' => 'post', 'class' => '', 'id' => 'leave_form',]); ?>
          <?php echo form_hidden('l_id', $leave->l_id) ?>
          <?php echo form_hidden('l_user_id', $leave->u_id) ?>

          <div class="row" style="display: flex;align-items: center;">
            <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Approve/Reject</label>

                    <?php echo form_dropdown('l_status', $leave_status_list, $leave->l_status, 'class="form-control form-control-sm" id="u_desg_id" requiredd'); ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Comments</label>
                    <textarea class="form-control form-control-sm" name="l_comments" placeholder="Please write you feedback." id="l_comments" cols="20" rows="1"><?= $leave->l_comments; ?></textarea>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-sm-2 d-flex align-center">
              <button name="leave_update_btn" value="1" class="btn btn-block btn-sm btn-info mt-3"><i class="fa fa-check "> Save</i></button>
            </div>
          </div>


          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Default Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>

  </div>

</div>
<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/') ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $(function() {});
  });
</script>