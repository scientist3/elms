<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/daterangepicker/daterangepicker.css">

<style>
  div>span.badge.bg-danger.p-1 {
    width: 100%;
  }
</style>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- Horizontal form elements -->
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Question</h3>
            <a href="<?php echo base_url('teacher/question/index'); ?>" class="col-sm-2 btn btn-info float-right">View Question</a>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('teacher/question/create') ?>" method="post">
            <div class="card-body">
              <?php echo form_hidden('q_id', $input->q_id) ?>

              <div class="row">
                <!-- exam_id -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Select Exam</label>
                    <?php echo form_dropdown('q_e_id', $exam_list, $input->q_e_id, 'class="form-control" id="q_e_id" '); ?>
                    <?php echo form_error('q_e_id', '<span class="error text-danger text-xs"> ', '</span>'); ?>
                  </div>
                </div>

                <!-- </div>

              <div class="row"> -->
                <!-- Exam Name -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="q_question">Question</label>
                    <input type="text" class="form-control" id="q_question" name="q_question" placeholder="Question" value="<?php echo $input->q_question; ?>">
                    <?php echo form_error('q_question', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="col-sm-3 btn btn-info float-right">Save</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- date-range-picker -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/daterangepicker/daterangepicker.js"></script>

<script>
  $(function() {

    //Date and time picker
    $('.initdatetime').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD HH:mm A'
    });

    //$('.initdatetime').data('datetimepicker').date(new Date())
    //$.noConflict();
    //Date and time picker
    //$('#reg_start_date').datetimepicker(
    //   {
    //   icons: {
    //     time: 'far fa-clock'
    //   }
    // }
    //  );
    //  $('#reg_start_date ').datetimepicker({
    //   icons: {
    //     time: 'far fa-clock'
    //   },
    //   format: 'YYYY-MM-DD HH:mm A'
    // });
    // $('#reg_end_date ').datetimepicker({
    //   icons: {
    //     time: 'far fa-clock'
    //   }
    // });
    // $('#exam_start_date ').datetimepicker({
    //   icons: {
    //     time: 'far fa-clock'
    //   }
    // });
    // $('#exam_end_date ').datetimepicker({
    //   icons: {
    //     time: 'far fa-clock'
    //   }
    // });

  });
</script>