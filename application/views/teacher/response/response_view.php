<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<?php
// dd($responses);
// dd($student_list);
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Filter and Add Question form  -->
      <div class="col-md-12">
        <div class="rrow">
          <div class="ccol-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Filter By Exam</h3>
              </div>
              <div class="card-body">
                <form action="<?php echo base_url('teacher/response/index'); ?>" method="post">
                  <div class="row">

                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="r_e_id">Select exam</label>
                        <?php echo form_dropdown('r_e_id', $exam_list, $exam_id, 'class="form-control" id="r_e_id" '); ?>
                        <?php echo form_error('r_e_id', '<span class="badge bg-danger p-1 text-center text-xs"> ', '</span>'); ?>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="r_u_id">Select Student</label>
                        <?php echo form_dropdown('r_u_id', $student_list, $student_id, 'class="form-control" id="r_u_id" '); ?>
                        <?php echo form_error('r_u_id', '<span class="badge bg-danger p-1 text-center text-xs"> ', '</span>'); ?>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="search_question">Filter</label>
                        <button type="submit" class="d-block col-sm-12 btn btn-info" name="search_question" value="1">Search</button>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
              <!-- /.card-header -->

            </div>
          </div>

        </div>
        <!-- </div> -->
      </div>
      <!-- Right Column Question List -->
    </div>
    <?php if (isset($input->r_e_id) && !empty($input->r_e_id)) { ?>
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-danger card-outline">
            <div class="card-header">
              <ul class="nav nav-tabs nav-fill" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="view-1-tab" data-toggle="pill" href="#view-1" role="tab" aria-controls="view-1" aria-selected="true">Response Chart View 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="view-2-tab" data-toggle="pill" href="#view-2" role="tab" aria-controls="view-2" aria-selected="false">Response Chart View 2</a>
                </li>

              </ul>
              <!-- <h3 class="card-title">Response Chart</h3> -->

              <!-- <a href="< ?php echo base_url('teacher/question/create'); ?>" class="col-sm-2 btn btn-info float-right">Add Question</a> -->

            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="view-1" role="tabpanel" aria-labelledby="view-1-tab">
                  <table id="example1" class="datatable1 table table-bordered table-striped  table-sm">

                    <?php include_once('response_body_view.php'); ?>

                  </table>
                </div>
                <div class="tab-pane fade" id="view-2" role="tabpanel" aria-labelledby="view-2-tab">
                  <table id="example1" class="datatable1 table table-bordered table-striped  table-sm">

                    <?php include_once('response_body_view1.php'); ?>

                  </table>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <!-- Stack+BAR CHART -->
          <div class="card card-success card-outline">
            <div class="card-header">
              <ul class="nav nav-tabs nav-filll float-left" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="response-view-1-tab" data-toggle="pill" href="#response-view-1" role="tab" aria-controls="response-view-1" aria-selected="true">Response Chart View 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="response-view-2-tab" data-toggle="pill" href="#response-view-2" role="tab" aria-controls="response-view-2" aria-selected="false">Response Chart View 2</a>
                </li>

              </ul>
              <!-- <h3 class="card-title">Student Response Bar Chart</h3> -->

              <div class="card-tools float-right">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="response-view-1" role="tabpanel" aria-labelledby="response-view-1-tab">
                  <div class="chart">
                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="tab-pane fade" id="response-view-2" role="tabpanel" aria-labelledby="response-view-2-tab">
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>



            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    <?php } ?>
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
<!-- ChartJS -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/chart.js/Chart.min.js"></script>
<?php
//  Generate the student labels
$student_label = '';
$attempted_labels = '';
$correct_labels = '';

if (!empty($responses)) {
  foreach ($responses as $std_id => $other) {
    // dd($other);
    //if ($std_id != null)
    $student_label .= '"' . $student_list[$std_id] . '",';
  }
  $student_label = rtrim($student_label, ",");

  // Generate the attempted and correct data.
  $attempted_count = 0;
  $correct_count = 0;
  foreach ($responses as $std_id => $questions) {
    foreach ($questions as $question_id => $question) {
      // dd($question);
      if ($question['attempted']) {
        $attempted_count++;
      }
      if ($question['correct']) {
        $correct_count++;
      }
    }
    $attempted_labels .= '"' . $attempted_count . '",';
    $correct_labels .= '"' . $correct_count . '",';
    $attempted_count = 0;
    $correct_count = 0;
  }
  $attempted_labels = rtrim($attempted_labels, ",");
  $correct_labels = rtrim($correct_labels, ",");
}



?>
<script>
  $(function() {
    // Student Result/Response Chart
    var areaChartData = {
      labels: [<?php echo $student_label; ?>],
      datasets: [{
          label: 'Correct',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [<?php echo $correct_labels; ?>]
        },
        {
          label: 'Attempted',
          backgroundColor: 'rgba(210, 214, 222, 1)',
          borderColor: 'rgba(210, 214, 222, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [<?php echo $attempted_labels; ?>]
        },
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false,
      scales: {
        xAxes: [{
          barPercentage: 0.4,
          categoryPercentage: 0.5
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        xAxes: [{
          barPercentage: 0.4,
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })

    // Handle the model and its contents
    $('a[href$="#Model"]').on("click", function(e) {
      //console.log($(this).data('question_id'));
      $('.modal-body').load('<?php echo base_url('teacher/question/fetch_questio_options?q_id='); ?>' + $(this).data('question_id'), function() {
        $('#view_option_model').modal({
          show: true
        });
      });
      // $('#view_option_model').modal('show');
    });

    $('a[href$="#addModel"]').on("click", function(e) {
      console.log($(this).data());
      // $('.modal-body').load('<?php echo base_url('teacher/question/fetch_questio_options?q_id='); ?>' + $(this).data('question_id'), function() {
      $('#add_option_model').modal({
        show: true
      });
      // });
      // $('#view_option_model').modal('show');
    });



    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
    $.noConflict();

    $(".datatable1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": [{
          extend: "copy",
          className: "btn btn-sm"
        },
        {
          extend: "csv",
          className: "btn btn-sm"
        },
        {
          extend: "excel",
          className: "btn btn-sm"
        },
        {
          extend: "pdf",
          className: "btn btn-sm"
        },
        {
          extend: "print",
          className: "btn btn-sm"
        },
        {
          extend: "colvis",
          className: "btn btn-sm"
        }
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<script>
  // Add multiple option 
  function add_more() {
    var row_count = $("#row_count").val();
    row_count++;
    $("#row_count").val(row_count);
    var new_row = $("#options_div > div:last").clone();
    $(new_row[0]).find('[name^="options[o_value]"]').val('');
    $(new_row[0]).find('[name^="options[o_correct]"]').val(row_count - 1);
    $(new_row[0]).find('[name^="options[o_correct]"]').prop("checked", false)
    // console.log(new_row);

    $("#options_div").append(new_row);

    //$("#options_div").append('');
  }

  function remove_more(current) {

    if ($("#options_div > div").length > 2) {
      $(current.closest(".row")).remove();
      var row_count = $("#row_count").val();
      row_count--;
      $("#row_count").val(row_count);
    }
  }
</script>