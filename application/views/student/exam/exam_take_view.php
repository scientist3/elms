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
// print_r($std_exam);
echo "</pre>"
?>
<section class="content">
  <div class="container-fluid">
    <!-- todays Examinations -->
    <div class="row">
      <div class="col-md-9">
        <div class="callout callout-info">
          <h5><i class="fas fa-info"></i> Exam Details:</h5>

          <h4>Question paper will appear below. Please submit before time. Form will be submitted automatically</h4>
        </div>
      </div>
      <style>
        .timeclass {
          position: fixed;
          top: 60px;
          width: 21% !important;
          right: 0;
          z-index: 10000;
        }
      </style>
      <div class="col-md-3 timeclass">
        <div class="sticky-top">
          <div class="callout callout-info text-center">
            <h5><i class="fas fa-info"> <span id="current_exam_details" class="badge badge-danger text-md"></span></i></h5>
          </div>
        </div>
      </div>

    </div>
    <div class="row d-none" id="question_div">
      <form class="form-horizontal" action="<?php echo base_url('student/exam/submit_exam') ?>" method="post" id="examform">
        <div class="col-sm-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Questions</h3>
            </div>
            <div class="card-body">
              <input type="hhidden" name="exam_id" value="<?php echo $exam_id; ?>">
              <?php if (!empty($questions)) {
                foreach ($questions as $q_id => $question) { ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Select Exam</label>
                        <?php echo form_dropdown('q_e_id', $exam_list, $input->q_e_id, 'class="form-control" id="q_e_id" '); ?>
                        <?php echo form_error('q_e_id', '<span class="error text-danger text-xs"> ', '</span>'); ?>
                      </div>
                    </div>
                  </div>
              <?php }
              } ?>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </form>
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
        url: "<?= base_url('student/exam/get_current_exam_updates'); ?>",
        type: 'post',
        data: {
          exam_id: <?php echo $exam_id; ?>
        },
        // contentType: "application/json",
        dataType: "json",
        // dataType: 'text',
        beforeSend: function() {
          // $("#current_exam_details .overlay").remove().add('<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i> <span class="pl-3"> Loading...</span></div>');
        },
        success: function(data) {

          if (data.status == 'R') {
            $('#question_div').removeClass('d-none').addClass('d-block');
          }
          if (data.status == 'F') {
            $("#examform").submit();
          }
          console.log(data.status);
          // console.log(data['status']);
          $("#current_exam_details").html(data.time_left);
          // $(".datatableajax").DataTable({
          //   "responsive": true,
          //   "lengthChange": false,
          //   "autoWidth": false,
          //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          // }).buttons().container().appendTo('#todays_exam_wrapper .col-md-6:eq(0)');
        },
        error: function() {
          clearTimeout(exam_timer);
          alert('Failed to load todays exam');
        }
      });

      var exam_timer = setTimeout(function() {
        doRefresh();
      }, 1000);
    }

    doRefresh();
  });
</script>