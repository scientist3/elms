<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo isset($total_applied) ? $total_applied : 0; ?></h3>

            <p>Exams Applied</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-graduate"></i>
          </div>
          <a href="<?php echo base_url('student/exam/index'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo isset($total_attempted) ? $total_attempted : 0; ?><sup style="font-size: 20px"></sup></h3>

            <p>Exams Attempted</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url('student/exam/index'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box - ->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>-->
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box - ->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div> -->
      </div>
    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <!-- Todays Exams-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Todays Exam <strong>( <?php echo \Carbon\Carbon::now("Asia/Kolkata")->toDayDateTimeString(); ?> )</strong>
            </h3>

          </div>
          <div class="card-body" id="todays_exam_div">
            <!-- <table id="today_exam_table" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Extn.</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
            </table> -->
          </div>
          <!-- <div class="overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i> <span class="pl-3"> Loading...</span>
          </div> -->
        </div>

      </section>
    </div>
  </div>
</section>

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
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
          $(".datatable1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        },
        error: function() {
          alert('Failed to load todays exam');
        }
      });

      setTimeout(function() {
        doRefresh();
      }, 10000);
    }

    doRefresh();
  });
</script>