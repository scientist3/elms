<table id="todays_exam" class="datatableajax datatable1 table table-bordered table-striped">
  <thead>
    <tr>
      <th>S.No</th>
      <th>Exam Name</th>
      <th>Start</th>
      <th>End</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($todays_exam)) {
      $sl = 0;
      foreach ($todays_exam as $exam) {
        $sl++; ?>
        <tr>
          <td><?php echo $sl ?></td>
          <td><?php echo $exam->e_name ?></td>
          <td>
            <?php
            $exam_start_time = \Carbon\Carbon::parse($exam->e_exam_start);
            echo $exam_start_time->toDayDateTimeString();
            ?>
            <input type="hidden" name="exam_start_time" id="exam_start_time" value="<?php echo $exam_start_time; ?>">
          </td>
          <td>
            <?php
            $exam_end_time = \Carbon\Carbon::parse($exam->e_exam_end);
            echo $exam_end_time->toDayDateTimeString();
            ?>
            <input type="hidden" name="exam_end_time" id="exam_end_time" value="<?php echo $exam_end_time; ?>">
          </td>
          <td>
            <span class="badge badge-danger text-md" id="exam_time_status">

              <?php
              $start  = \Carbon\Carbon::parse($exam->e_exam_start,  "Asia/Kolkata")->toDateTimeString();
              $end    = \Carbon\Carbon::parse($exam->e_exam_end,    "Asia/Kolkata")->toDateTimeString();
              $now    = \Carbon\Carbon::now("Asia/Kolkata")->toDateTimeString();

              echo $start . "<br>";
              echo $end . "<br>";
              echo $now . "<br>";
              $earlyaccess10mins = \Carbon\Carbon::parse($exam->e_exam_start,  "Asia/Kolkata")->subMinutes(10)->toDateTimeString();

              $ready = 0;

              if (isBetween($now, $earlyaccess10mins, $end)) {
                $ready = 1;
              }

              if (isBetween($now, $start, $end)) {
                echo "Exam is going on ";
                echo  td($now, $end, ' left');
              } else if ($now < $start) {
                echo "Exam will Start in ";
                echo  td($start, $now, '.');
              } else if ($now > $end) {
                $ready = 0;
                echo "Exam finished ";
                echo  td($now, $end, ' ago');
              }
              ?>
            </span>
          </td>
          <td>
            <?php
            if ($ready == 1) { ?>
              <a href="<?php echo base_url("student/exam/take/$exam->e_id") ?>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Start"><i class="fa fa-check-circle"> Start exam</i></a>
            <?php }
            ?>
          </td>
        </tr>
      <?php  } ?>
    <?php } ?>
  </tbody>
</table>


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
  // $(function() {
  //   $.noConflict();

  //   $(function() {
  //     $('[data-toggle="tooltip"]').tooltip()
  //   })

  // });
</script>