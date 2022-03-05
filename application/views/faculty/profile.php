<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <?php $picture = $this->session->userdata('picture'); ?>
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url($picture) ?>" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center"><?php echo $user->u_name ?></h3>

          <p class="text-muted text-center"><?php echo ucfirst($user->ur_name) ?></p>

          <ul class="list-group list-group-unbordered mb-3">

            <li class="list-group-item  text-xs">
              <b>Designation</b> <a class="float-right"><?php echo $user->desg_name ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Department</b> <a class="float-right"><?php echo $user->dept_name ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Category</b> <a class="float-right"><?php echo $category_list[$user->u_category] ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Highest Qual.</b> <a class="float-right"><?php echo $user->u_qualification ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Date Of Appointment</b> <a class="float-right"><?php echo $user->u_d_o_appointment ?></a>
            </li>
            <li class="list-group-item  text-xs">
              <b>First Posting</b> <a class="float-right"><?php echo $user->u_first_place_of_posting ?></a>
            </li>


            <li class="list-group-item  text-xs">
              <b>Appointment at college</b> <a class="float-right"><?php echo $user->u_d_o_app_at_spc ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Date Of Last Promotion</b> <a class="float-right"><?php echo $user->u_d_o_last_promotion ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Mobile No.</b> <a class="float-right"><?php echo $user->u_mobile ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Address.</b> <a class="float-right"><?php echo $user->u_adress ?></a>
            </li>

            <li class="list-group-item  text-xs">
              <b>Joined</b> <a class="float-right"><?php echo date('d-M-Y', strtotime($user->u_doc)) ?></a>
            </li>

          </ul>

          <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">

            <div class="tab-pane active" id="settings">
              <?php echo form_open_multipart('faculty/home/form/', 'class="form-horizontal"') ?>

              <?php echo form_hidden('u_id', $user->u_id) ?>
              <!-- Enable edits to basic fields if allowed -->
              <?php if ($this->session->userdata('is_edit_enabled') == 1) { ?>

                <div class="form-group row">
                  <label for="u_name" class="col-sm-2 col-form-label"><?php echo ('Name') ?><i class="req text-danger"> *</i></label>
                  <div class="col-sm-10">
                    <input name="u_name" type="text" class="form-control" id="u_name" placeholder="Name" value="<?php echo $user->u_name ?>">
                    <?php echo form_error('u_name', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_desg_id -->

                <div class="form-group row">
                  <label for="u_desg_id" class="col-sm-2 col-form-label"><?php echo ('Designation'); ?> <i class="req text-danger"> *</i></label>
                  <div class="col-sm-10">
                    <?php echo form_dropdown('u_desg_id', $designation_list, $user->u_desg_id, 'class="form-control " id="u_desg_id" requiredd'); ?>
                    <?php echo form_error('u_desg_id', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>


                <!-- u_dept_id -->
                <div class="form-group row">
                  <label for="u_dept_id" class="col-sm-2 col-form-label"><?php echo ('Department'); ?> <i class="req text-danger"> *</i></label>
                  <div class="col-sm-10">
                    <?php echo form_dropdown('u_dept_id', $department_list, $user->u_dept_id, 'class="form-control " id="u_dept_id" requiredd'); ?>
                    <?php echo form_error('u_dept_id', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_category -->

                <div class="form-group row">
                  <label for="u_category" class="col-sm-2 col-form-label"><?php echo ('Category'); ?> <i class="req text-danger"> *</i></label>
                  <div class="col-sm-10">
                    <?php echo form_dropdown('u_category', $category_list, $user->u_category, 'class="form-control " id="u_category" requiredd'); ?>
                    <?php echo form_error('u_category', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_qualification -->
                <div class="form-group row">
                  <label for="u_qualification" class="col-sm-2 col-form-label"><?php echo ('Highest Qual.') ?> <i class="req text-danger"> *</i></label>
                  <div class="col-sm-10">
                    <input name="u_qualification" type="text" class="form-control" id="u_qualification" placeholder="Highest Qualification" value="<?php echo $user->u_qualification ?>">
                    <?php echo form_error('u_qualification', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_d_o_appointment -->
                <div class="form-group row">
                  <label for="u_d_o_appointment" class="col-sm-2 col-form-label"><?php echo ('Appointment date'); ?><small class="req text-danger"> *</small></label>
                  <div class="col-sm-10">
                    <!-- min="< ?php echo date('Y-m-d', strtotime("0 Days")); ?>" -->
                    <input name="u_d_o_appointment" class="form-control form-control-sm" type="date" placeholder="<?php echo ('Appointment date') ?>" id="u_d_o_appointment" value="<?php echo $user->u_d_o_appointment; ?>" data-toggle="tooltip" title="<?php echo ('Appointment date'); ?>">
                    <?php echo form_error('u_d_o_appointment', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>


                <!-- u_first_place_of_posting -->
                <div class="form-group row">
                  <label for="u_first_place_of_posting" class="col-sm-2 col-form-label"><?php echo ('First posting') ?> <i class="req text-danger"> *</i></label>
                  <div class="col-sm-10">
                    <input name="u_first_place_of_posting" type="text" class="form-control" id="u_first_place_of_posting" placeholder="First place of posting" value="<?php echo $user->u_first_place_of_posting ?>">
                    <?php echo form_error('u_first_place_of_posting', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>


                <!-- u_d_o_app_at_spc -->
                <div class="form-group row">
                  <label for="u_d_o_app_at_spc" class="col-sm-2 col-form-label"><?php echo ('Appointment date at this College'); ?><small class="req text-danger"> *</small></label>
                  <div class="col-sm-10">
                    <!-- min="< ?php echo date('Y-m-d', strtotime("0 Days")); ?>" -->
                    <input name="u_d_o_app_at_spc" class="form-control form-control-sm" type="date" placeholder="<?php echo ('Appointment date at this college.') ?>" id="u_d_o_app_at_spc" value="<?php echo $user->u_d_o_app_at_spc; ?>" data-toggle="tooltip" title="<?php echo ('Appointment date at this college.'); ?>">
                    <?php echo form_error('u_d_o_app_at_spc', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>

                <!-- u_d_o_last_promotion -->
                <div class="form-group row">
                  <label for="u_d_o_last_promotion" class="col-sm-2 col-form-label"><?php echo ('Last Promotion Date'); ?><small class="req text-danger"> *</small></label>
                  <div class="col-sm-10">
                    <!-- min="< ?php echo date('Y-m-d', strtotime("0 Days")); ?>" -->
                    <input name="u_d_o_last_promotion" class="form-control form-control-sm" type="date" placeholder="<?php echo ('Last Promotion Date') ?>" id="u_d_o_last_promotion" value="<?php echo $user->u_d_o_last_promotion; ?>" data-toggle="tooltip" title="<?php echo ('Last Promotion Date'); ?>">
                    <?php echo form_error('u_d_o_last_promotion', '<span class="badge bg-danger p-1">', '</span>'); ?>
                  </div>
                </div>
              <?php } ?>
              <!-- Enable edits to basic fields if allowed END-->

              <?php /*
              <div class="form-group row">
                <label for="u_dob" class="col-sm-2 col-form-label"><?php echo ('DOB') ?></label>
                <div class="col-sm-10">
                  <input name="u_dob" type="text" class="form-control" id="u_dob" placeholder="DOB" value="<?php echo $user->u_dob ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label for="u_desg_id" class="col-sm-2 col-form-label"><?php echo ('Designation') ?></label>
                <div class="col-sm-10">
                  <input name="u_desg_id" type="text" class="form-control" id="u_desg_id" placeholder="Designation" value="<?php echo $user->u_desg_id ?>" disabled>
                </div>
              </div>
              */ ?>

              <div class="form-group row">
                <label for="u_email" class="col-sm-2 col-form-label"><?php echo ('Email') ?></label>
                <div class="col-sm-10">
                  <input name="u_email" type="email" class="form-control" id="u_email" placeholder="<?php echo ('email') ?>" value="<?php echo $user->u_email ?>">
                  <?php echo form_error('u_email', '<span class="badge bg-danger p-1">', '</span>'); ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="u_password" class="col-sm-2 col-form-label"><?php echo ('Password') ?></label>
                <div class="col-sm-10">
                  <input name="u_password" type="text" class="form-control" id="u_password" placeholder="<?php echo ('password') ?>" value="">
                  <input type="hidden" name="old_password" value="<?php echo $user->u_password ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="u_mobile" class="col-sm-2 col-form-label"><?php echo ('Mobile') ?></label>
                <div class="col-sm-10">
                  <input name="u_mobile" type="text" class="form-control" id="u_mobile" placeholder="<?php echo ('mobile') ?>" value="<?php echo $user->u_mobile ?>">
                  <?php echo form_error('u_mobile', '<span class="badge bg-danger p-1">', '</span>'); ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="u_adress" class="col-sm-2 col-form-label"><?php echo ('Address') ?></label>
                <div class="col-sm-10">
                  <input name="u_adress" type="text" class="form-control" id="u_adress" placeholder="<?php echo ('address') ?>" value="<?php echo $user->u_adress ?>">
                  <?php echo form_error('u_adress', '<span class="badge bg-danger p-1">', '</span>'); ?>
                </div>
              </div>

              <?php if (!empty($user->u_picture)) { ?>
                <div class="form-group row">
                  <label for="picturePreview" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <img src="<?php echo base_url($user->u_picture) ?>" alt="Picture" class="img-thumbnail" />
                  </div>
                </div>
              <?php } ?>

              <div class="form-group row">
                <!-- Picture -->
                <label for="picture" class="col-sm-2 control-label"><?php echo ('Picture') ?></label>

                <div class="col-sm-10">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="picture" id="picture" value="<?php echo $user->u_picture ?>">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>

                  <input type="hidden" name="old_picture" value="<?php echo $user->u_picture ?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <?php if ($this->session->userdata('is_edit_enabled') == 1) { ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure. Please make sure the details are correct. You will not be able to make further changes!')">Submit</button>
                  <?php } else { ?>
                    <button type="submit" class="btn btn-danger">Submit</button>
                  <?php } ?>
                </div>
              </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</section>
<!-- /.row -->
<script>
  $(document).ready(function() {
    $(function() {
      // Initialize the tooltip
      $('[data-toggle="tooltip"]').tooltip();

      $('#u_d_o_appointment').prop('value', '<?php echo date('Y-m-d', strtotime($input->u_d_o_appointment)); ?>');
      //Flat red color scheme for iCheck
      /*$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      })*/

      //bsCustomFileInput.init();
    })
  });
</script>