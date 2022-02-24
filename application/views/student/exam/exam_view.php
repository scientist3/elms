<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<?php

use Carbon\Carbon;

echo "<pre>";
// print_r($_SESSION);
// print_r($applied_exams);
// print_r($approved_exams);
// print_r($upcomming_exams);
// print_r($all_exams);
// print_r($past_exams);
print_r($std_exam);
echo "</pre>"
?>
<section class="content">
  <div class="container-fluid">
    <!-- todays Examinations -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Todays Examination</h3>
          </div>
          <div class="card-body" id="todays_exam_div">

          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    <!-- Applied Examinations -->
    <?php /* <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Applied Examination</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="datatable1 table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Exam Name</th>
                  <th>Reg Start / Reg End</th>
                  <th>Reg Status</th>
                  <th>Exam Start / Exam End</th>
                  <th>Exam Days Left</th>
                  <!-- <th>Status</th> -->
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($applied_exams)) {
                  $sl = 0;
                  foreach ($applied_exams as $exam) {
                    $sl++; ?>
                    <tr>
                      <td><?php echo $sl ?></td>
                      <td><?php echo $exam->e_name ?></td>
                      <td>
                        <?php echo date("Y-M-d h:m:sa", strtotime($exam->e_reg_start)); ?>
                        <br>To<br>
                        <?php echo date("Y-M-d h:m:sa", strtotime($exam->e_reg_end)); ?>
                      </td>
                      <td>
                        <span class="badge badge-danger text-md">
                          <?php
                          $start = strtotime(date("Y-m-d H:m:s")); //strtotime($exam->e_reg_start);
                          $end   = strtotime($exam->e_reg_end);
                          $datediff1 =  round(($end - $start) / (60 * 60 * 24));
                          if ($datediff1 <= 0) {
                            echo "Expired";
                          } else {
                            echo $datediff1 . "Days";
                          }
                          ?>
                        </span>
                      </td>
                      <td>
                        <?php echo date("Y-M-d h:m:sa", strtotime($exam->e_exam_start)); ?>
                        <br>To<br>
                        <?php echo date("Y-M-d h:m:sa", strtotime($exam->e_exam_end)); ?>
                      </td>
                      <td><span class="badge badge-danger text-md">Exam Has
                          <?php
                          $start = strtotime(date("Y-m-d H:m"));
                          $end   = strtotime($exam->e_exam_start);
                          $datediff =  $end - $start;
                          echo round($datediff / (60 * 60 * 24));
                          ?> Days left</span></td>

                      <!-- <td><?php echo $exam->e_status ?></td> -->
                      <td class="text-center" width="100">
                        <?php
                        // $applied = 0;
                        // dd($std_exam);
                        // if (
                        //   $std_exam->se_u_id == $this->session->userdata('user_id') &&
                        //   $std_exam->se_e_id == $exam->e_id
                        // ) {
                        //   $applied = 1;
                        // }
                        $std_id = $this->session->userdata('user_id');
                        if (isset($std_exam[$exam->e_id][$std_id])) { ?>
                          <?php if ($std_exam[$exam->e_id][$std_id]['applied'] && $std_exam[$exam->e_id][$std_id]['approved']) { ?>
                            <span class="badge badge-success">Approved</span>
                          <?php } else {  ?>
                            <span class="badge badge-warning">Applied But not approved</span>
                          <?php } ?>
                        <?php } else { ?>
                          <?php
                          echo strtotime($exam->e_reg_end) . "<br>";

                          echo  strtotime(date('Y-m-d H:m:s'));
                          if (strtotime($exam->e_reg_end) > strtotime(date('Y-m-d H:m:s'))) { ?>
                            <a href="<?php echo base_url("student/exam/apply/$exam->e_id") ?>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Apply"><i class="fa fa-check-circle"></i></a>
                          <?php } else { ?>
                            <span class="badge badge-warning">Registration Date is over</span>
                          <?php } ?>
                        <?php } ?>
                      </td>
                    </tr>
                <?php  }
                } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>S.No</th>
                  <th>Exam Name</th>
                  <th>Reg Start / Reg End</th>
                  <th>Reg Status</th>
                  <th>Exam Start / Exam End</th>
                  <th>Exam Days Left</th>
                  <!-- <th>Status</th> -->
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div> */ ?>

    <!-- Upcomming Examinations -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Upcomming Examination</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="datatable1 table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Exam Name</th>
                  <th>Reg Start / Reg End</th>
                  <th>Reg Status</th>
                  <th width="10%">Exam Days Left</th>
                  <th>Progress</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($upcomming_exams)) {
                  $sl = 0;
                  foreach ($upcomming_exams as $exam) {
                    $sl++; ?>
                    <tr>
                      <td><?php echo $sl ?></td>
                      <td><strong><?php echo $exam->e_name ?></strong></td>
                      <td class="text-center">
                        <?php echo date("d-M-Y h:m:sa", strtotime($exam->e_reg_start)); ?>
                        <div class="text-center">To</div>
                        <?php echo date("d-M-Y h:m:sa", strtotime($exam->e_reg_end)); ?>
                      </td>
                      <td>
                        <span>
                          <?php

                          $start  = \Carbon\Carbon::parse($exam->e_reg_start, "Asia/Kolkata");
                          $end    = \Carbon\Carbon::parse($exam->e_reg_end, "Asia/Kolkata");
                          echo '<div class="badge badge-warning text-md"> has ' . str_replace(['before', 'after'], '', $end->diffForHumans($start)) . '</div><br><br>';
                          echo '<div class="badge badge-danger text-md">Reg time left ' . str_replace(['before', 'after'], '', $end->diffForHumans(null, true)) . '</div>';

                          ?>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge-danger text-sm" style="word-wrap: break-word;">Exam Has
                          <?php
                          echo $end->diffForHumans();
                          ?>
                        </span>
                      </td>

                      <td class="text-center" width="100">
                        <?php
                        $applied = 0;
                        $approved = 0;
                        if (isset($std_exam[$exam->e_id])) {
                          $applied = 1;
                          echo '<div class="badge badge-success">Applied: Yes</div>';
                        } else {
                          $applied = 0;
                          echo '<div class="badge badge-warning">Applied: No</div>';
                        }

                        if (isset($std_exam[$exam->e_id]) && $std_exam[$exam->e_id]['approved'] == 1) {
                          $approved = 1;
                          echo '<div class="badge badge-success">Approved: Yes</div>';
                        } else {
                          $approved = 0;
                          echo '<div class="badge badge-warning">Approved: No</div>';
                        }
                        ?>
                      </td>

                      <td>
                        <!-- If not applied -->
                        <?php if ($applied == 0) { ?>
                          <a href="<?php echo base_url("student/exam/apply/$exam->e_id") ?>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Apply"><i class="fa fa-check-circle"></i></a>
                        <?php } else if ($approved == 0) { ?>
                          <span class="badge badge-warning">Wait for the approval</span>
                        <?php } else if ($approved == 1) { ?>
                          <span class="badge badge-warning">Already Applied </span>
                        <?php } ?>
                      </td>
                    </tr>
                <?php  }
                } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>S.No</th>
                  <th>Exam Name</th>
                  <th>Reg Start / Reg End</th>
                  <th>Reg Status</th>
                  <th>Exam Days Left</th>
                  <th>Progress</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    <!-- Past Exams -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Past Examination</h3>
          </div>

          <div class="card-body">
            <table id="example2" class="datatable2 table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Exam Name</th>
                  <th>Reg Start / Reg End</th>
                  <th>Exam Start / Exam End</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($past_exams)) {
                  $sl = 0;
                  foreach ($past_exams as $exam) {
                    $sl++; ?>
                    <tr>
                      <td><?php echo $sl ?></td>
                      <td><strong><?php echo $exam->e_name ?></strong></td>
                      <td class="text-center">
                        <?php echo date("d-M-Y h:m:sa", strtotime($exam->e_reg_start)); ?>
                        <div class="text-center">To</div>
                        <?php echo date("d-M-Y h:m:sa", strtotime($exam->e_reg_end)); ?>
                      </td>

                      <td class="text-center">
                        <?php echo date("d-M-Y h:m:sa", strtotime($exam->e_exam_start)); ?>
                        <div class="text-center">To</div>
                        <?php echo date("d-M-Y h:m:sa", strtotime($exam->e_exam_end)); ?>
                      </td>
                      <td class="text-center" width="100">

                        <a href="<?php echo base_url("student/exam/check_result/$exam->e_id") ?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Check Result"><i class="fa fa-eye"></i></a>
                        <!-- <a href="<?php echo base_url("student/exam/edit/$exam->e_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url("student/exam/delete/$exam->e_id/") ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are You Sure') "><i class="fa fa-trash"></i></a> -->
                      </td>
                    </tr>
                <?php  }
                } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>S.No</th>
                  <th>Exam Name</th>
                  <th>Reg Start / Reg End</th>
                  <th>Exam Start / Exam End</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>


<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
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
  $(document).ready(function() {

    $.noConflict();

    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })


    $(".datatable1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('.datatable2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
</script>


<!-- jQuery -->
<!-- <script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script> -->
<script>
  // $(document).ready(function() {
  //   $('#todays_exam_table').DataTable({
  //     "ajax": '../ajax/data/arrays.txt'
  //   });
  // });

  $(document).ready(function() {
    // Update Exam Remaining time
    function doRefresh() {
      $.ajax({
        url: "<?= base_url('student/home/get_todays_exam'); ?>",
        type: 'post',
        dataType: 'text',
        beforeSend: function() {
          // $("#todays_exam_div .overlay").remove().add('<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i> <span class="pl-3"> Loading...</span></div>');
        },
        success: function(data) {
          $("#todays_exam_div").html(data);
          $(".datatableajax").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#todays_exam_wrapper .col-md-6:eq(0)');
        },
        error: function() {
          alert('Failed to load todays exam');
        }
      });

      setTimeout(function() {
        doRefresh();
      }, 1000);
    }

    doRefresh();
  });
</script>

<!-- 
/*$start = strtotime(date("Y-m-d H:m:s")); //strtotime($exam->e_reg_start);
$end = strtotime($exam->e_reg_end);
$datediff1 = ($end - $start) / (60 * 60 * 24);
// echo $datediff1;
$type = "D";
if ($datediff1 < 0) { $type="E" ; echo "Expired" ; } else { if ($datediff1> 0 && $datediff1 < 1) { $datediff1 *=24; if ($datediff1> 1) {
    $type = "H";
    echo round($datediff1, 1) . " Hours";
    } else {
    $type = "M";
    $datediff1 *= 60;
    echo round($datediff1) . " Minutes";
    }
    } else {
    $type = "D";
    echo round($datediff1) . " Days";
    }
    } */ -->