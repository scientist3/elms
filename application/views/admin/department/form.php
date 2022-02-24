<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- Save -->
    <div class="col-sm-4">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title"><i class="fa fa-plus"></i> <?php echo $subtitle; ?></h3>

        </div>
        <div class="card-body">
          <!-- <?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?> -->

          <?php if ($this->session->flashdata('msg') != null) {  ?>
            <div class="alert alert-info alert-dismissable" style="font-size: 1rem;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->session->flashdata('msg'); ?>
            </div>
          <?php } ?>

          <?php if ($this->session->flashdata('exp') != null) {  ?>
            <div class="alert alert-danger alert-dismissable" style="font-size: 1rem;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->session->flashdata('exp'); ?>
            </div>
          <?php } ?>

          <div class="row">
            <div class="col-md-12">

              <form role="form" action="<?php echo site_url('admin/department/create') ?>" method="post" id="save_type_form">
                <?php echo form_hidden('dept_id', $input->dept_id) ?>

                <div class="row">

                  <!-- status_name -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="dept_name"><?php echo ('name'); ?></label> <small class="req"> *</small>
                      <input name="dept_name" class="form-control form-control-sm" type="text" placeholder="<?php echo ('name') ?>" id="dept_name" value="<?php echo $input->dept_name; ?>" data-toggle="tooltip" title="<?php echo ('name'); ?>">
                      <?php echo form_error('dept_name', '<span class="badge bg-danger p-1">', '</span>'); ?>
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

                  <!-- Satus -->
                  <div class="col-sm-12">
                    <div class="form-group ">
                      <label for="dept_status"><?php echo ('status'); ?></label>
                      <div class="form-check row form-inline form-control-sm">
                        <div class="col-6 form-inline">
                          <label class=" col-sm-6 radio-inline">
                            <input type="radio" name="dept_status" value="1" <?= ($input->dept_status == '1') ? 'checked' : null; ?> data-toggle="tooltip" title="Active status">
                            <?php echo ('active') ?>
                          </label>
                        </div>
                        <div class="col-6 form-inline">
                          <label class="col-sm-6 radio-inline">
                            <input type="radio" name="dept_status" value="0" <?= ($input->dept_status == '0') ? 'checked' : null; ?> data-toggle="tooltip" title="Disabled status"> &nbsp;<?php echo ('inactive') ?>
                          </label>
                        </div>
                        <br>
                      </div>
                      <?php echo form_error('dept_status', '<span class="badge bg-danger p-1">', '</span>'); ?>
                    </div>
                  </div>
                  <!-- </div> 
                
                            <div class="row"> -->
                  <!-- Submit -->
                  <div class="col-sm-12 ">
                    <div class="form-group">
                      <!-- <label>Submit</label> -->
                      <?php if ($this->uri->segment(3) != "edit") { ?>
                        <button type="submit" name="save" value="add_station" class="form-control form-control-sm btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-plus"> &nbsp;<?php echo ('save'); ?></i></button>
                      <?php } else { ?>

                        <button type="submit" name="save" value="edit_station" class="form-control form-control-sm btn btn-warning btn-sm pull-right checkbox-toggle"><i class="fa fa-edit"> &nbsp;<?php echo ('update'); ?></i></button>
                      <?php } ?>
                    </div>
                  </div>

                </div>
                <!-- <hr><hr> -->
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Search -->
    <!-- Display -->
    <div class="col-sm-8">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Department List
          </h3>
          <!-- <a class="btn btn-warning pull-right" href="< ?= base_url('admin/transaction/payment_report/').$search->start_date.'/'.$search->end_date; ?>"><i class="fa fa-print"></i></a> -->
        </div>

        <div class="card-body">
          <table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th><?php echo ('unique_id') ?></th>
                <th><?php echo ('name') ?></th>
                <!-- <th><?php echo ('parent') ?></th> -->
                <th><?php echo ('status') ?></th>
                <th><?php echo ('action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($labels)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($labels as $label) { ?>
                  <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $label->dept_name ?></td>
                    <td class="text-center">
                      <?php echo ($label->dept_status) ?
                        '<i class="fa fa-check" aria-hidden="true"></i>' :
                        '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
                    </td>
                    <td class="text-center" width="100">
                      <?php if (!in_array($label->dept_id, [1, 3])) { ?>
                        <a href="<?php echo base_url("admin/label/edit/$label->dept_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url("admin/label/delete/$label->dept_id/") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo ('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
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
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- jquery-validation -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/jquery.validate.min.js"></script>

<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $(function() {
      // $('#save_type_form').validate({
      //   rules: {
      //     dept_name: {
      //       required: true,
      //     },
      //     dept_status: {
      //       required: true,
      //     }
      //   },
      //   messages: {
      //     dept_name: {
      //       required: "Please provide a Property Label Name"
      //     },
      //     dept_status: {
      //       required: "Please select status"
      //     }
      //   },
      //   errorElement: 'span',
      //   errorPlacement: function(error, element) {
      //     error.addClass('badge badge-danger invalid-feedback');
      //     element.siblings('span.invalid-feedback').remove();
      //     element.closest('.form-group').append(error);
      //   },
      //   highlight: function(element, errorClass, validClass) {
      //     $(element).addClass('is-invalid');
      //   },
      //   unhighlight: function(element, errorClass, validClass) {
      //     $(element).removeClass('is-invalid');
      //   }
      // });
    });
    //$('[data-toggle="tooltip"]').tooltip();
    //bsCustomFileInput.init();

    // $('.datatable2').DataTable({
    //   responsive: true,
    //   dom: "<'row'<'col-sm-6 btn-sm'B><'col-sm-6 p-1'f>>tp",
    //   "lengthChange": false,
    //   "autoWidth": false,
    //   // "lengthMenu": [
    //   //   [10, 25, 50, -1],
    //   //   [10, 25, 50, "All"]
    //   // ],
    //   buttons: [{
    //     extend: 'colvis',
    //     className: 'btn-sm'
    //   }]
    // });
    // $(".dataTables_wrapper > div > div")[0].remove();
    // $(".dataTables_wrapper > div > div").each(function() {
    //   $(this).addClass('col-sm-6');
    // });
  });
</script>