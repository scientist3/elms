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
            <h3 class="card-title">Add Exam</h3>
            <a href="<?php echo base_url('teacher/exam/index'); ?>" class="col-sm-2 btn btn-info btn-sm float-right">View Exam</a>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('teacher/exam/create') ?>" method="post">
            <?php //dd($input); 
            ?>
            <div class="card-body">
              <?php echo form_hidden('e_id', $input->e_id) ?>
              <div class="row">
                <!-- Exam Name -->
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="e_name"><strong> Exam Name</strong></label>
                    <input type="text" class="form-control" id="e_name" name="e_name" placeholder="Exam Name" value="<?php echo $input->e_name; ?>">
                    <?php echo form_error('e_name', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Reg Date Start:</label>
                    <div class="input-group date initdatetime" id="e_reg_start" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input " data-target="#e_reg_start" id="e_reg_start" name="e_reg_start" value="<?php echo $input->e_reg_start ?>">
                      <div class="input-group-append" data-target="#e_reg_start" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                    <?php echo form_error('e_reg_start', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Reg End Date:</label>
                    <div class="input-group date initdatetime" id="e_reg_end" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#e_reg_end" name="e_reg_end" value="<?php echo $input->e_reg_end ?>">
                      <div class="input-group-append" data-target="#e_reg_end" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                    <?php echo form_error('e_reg_end', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- <div class="col-sm-2">
                  <div class="form-group d-block">
                    <label for="">Days Left</label>
                    <div class="input-group">
                      <span id="registration_days_left" class=" badge badge-danger mt-1 text-lg"> 3 Days</span>
                    </div>
                  </div>
                </div> -->

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Examination Start Date:</label>
                    <div class="input-group date initdatetime" id="e_exam_start" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#e_exam_start" name="e_exam_start" value="<?php echo $input->e_exam_start ?>">
                      <div class="input-group-append" data-target="#e_exam_start" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                    <?php echo form_error('e_exam_start', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Examination End Date:</label>
                    <div class="input-group date initdatetime" id="e_exam_end" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#e_exam_end" name="e_exam_end" value="<?php echo  $input->e_exam_end; ?>">
                      <div class="input-group-append" data-target="#e_exam_end" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                    <?php echo form_error('e_exam_end', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- <div class="col-sm-2">
                  <div class="form-group d-block">
                    <label for="">Days Left</label>
                    <div class="input-group">
                      <span id="registration_days_left" class=" badge badge-danger mt-1 text-lg"> 3 Days</span>
                    </div>
                  </div>
                </div> -->

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

    $('.initdatetime').on('click', function() {
      $(this).datetimepicker('toggle');
    });

    //Date and time picker
    $('.initdatetime').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD HH:mm'
    });

    $("#e_reg_start").on("dp.change", function(e) {
      alert("loo");
    });

  });
</script>