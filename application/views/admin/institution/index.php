<!-- Main content -->
<section class="content">
	<!-- alert message -->
	<?php if ($this->session->flashdata('message') != null) {  ?>
		<div class="alert alert-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('message'); ?>
		</div>
	<?php } ?>
	<!-- Institution Form -->
	<div class="row">
		<!-- Form -->
		<div class="col-sm-12">
			<?php echo form_open('admin/institution/index', ['class' => 'email', 'id' => 'institution_form', 'enctype' => 'multipart/form-data']); ?>
			<div class="card card-dark">
				<h5 class="card-header"><i class="fa fa-plus"></i> Add Institution</h5>
				<div class="card-body">
					<div class="col-sm-12">
						<!-- <form action="" method="post" enctype="multipart/form-data"> -->
						<input type="hidden" name="inst_id" value="<?php echo $institution->inst_id ?>">
						<div class="form-group">
							<label for="inst_name">Name <i class="text-danger">*</i></label>
							<input type="text" id="inst_name" name="inst_name" class="form-control" placeholder="Institution Name" value="<?php echo $institution->inst_name ?? null; ?>" />
							<?php echo form_error('inst_name', '<span class="badge badge-danger d-block">', '</span>'); ?>
						</div>

						<div class="form-group">
							<label for="inst_phone_no">Phone <i class="text-danger">*</i></label>
							<input type="text" id="inst_phone_no" name="inst_phone_no" class="form-control" placeholder="Phone Number" value="<?php echo $institution->inst_phone_no ?? null; ?>" />
							<?php echo form_error('inst_phone_no', '<span class="badge badge-danger d-block">', '</span>'); ?>
						</div>

						<div class="form-group">
							<label for="inst_email_id">Address <i class="text-danger">*</i></label>
							<input type="email" id="inst_email_id" name="inst_email_id" class="form-control" placeholder="email" value="<?php echo $institution->inst_email_id ?? null; ?>" />
							<?php echo form_error('inst_email_id', '<span class="badge badge-danger d-block">', '</span>'); ?>
						</div>

						<!-- Select image -->
						<div class="form-group">
							<label for="attach_file">Logo <i class="text-danger hide">*</i></label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="attach_file" name="attach_file" value="<?php echo $institution->inst_logo ?? null; ?>">
									<label class="custom-file-label" for="attach_file">Choose file</label>
									<input type="hidden" id="existing_logo" name="existing_logo" value="<?php echo $institution->inst_logo; ?>">
								</div>
							</div>
						</div>
						<!-- Preview and instruction -->
						<div class="col-sm-12">
							<div class="form-group">
								<p style="display: flex;justify-content: center;">
									<img id="preview_img" class="img " width="130px" height="100px" src="<?php echo !empty($institution->inst_logo) ? base_url($institution->inst_logo) : base_url('uploads/noimageselected.png'); ?>" alt="">
								</p>
								<p id="upload-progress" class="hide alert" style="display: none;"></p>
								<span class="text-danger" style="display: none;"><?php echo form_error('hidden_attach_file', '<span class="badge badge-dabger">'); ?></span>
								<div id="output" class="hide badge badge-danger" style="display: none;"></div>
								<!-- <span class="badge badge-danger d-block">Note: only image files</span> -->
							</div>
						</div>

					</div>
				</div>
				<div class="card-footer">
					<div class="form-group float-right">
						<input type="submit" class="btn btn-primary" value="Submit" name="instiution_btn">
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			<!-- /.card -->
		</div>
		<!-- Institution List -->
		<?php /* <div class="col-sm-8">
			<div class="card card-dark">
				<h5 class="card-header"><i class="fa fa-list"></i> View Institution</h5>
				<div class="card-body">


				</div>
				<div class="card-footer">

				</div>
			</div>
		</div> */ ?>

	</div>
</section>
<!-- /.content -->

<script src="<?php echo base_url("vendor/almasaeed2010/adminlte/"); ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url("vendor/almasaeed2010/adminlte/"); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		// debugger;
		bsCustomFileInput.init();
		var browseFile = $('#attach_file');
		var form = $('#institution_form');
		// var progress = $("#upload-progress");
		var hiddenFile = $("#existing_logo");
		// var doc_type = $("#doc_type");
		var output = $("#output");
		var preview_img = $('#preview_img');

		browseFile.on('change', function(e) {
			e.preventDefault();
			uploadData = new FormData(form[0]);

			$.ajax({
				url: '<?php echo base_url('admin/institution/do_upload/img') ?>',
				type: form.attr('method'),
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: uploadData,
				beforeSend: function() {
					hiddenFile.val('');
					// doc_type.val('');
					output.hide();
					// progress.show().html('<i class="fa fa-cog fa-spin"></i> Loading..');
				},
				success: function(data) {
					// progress.hide();
					if (data.status == false) {
						output.show().html(data.exception).addClass('alert-danger').removeClass('hide').removeClass('alert-info');
					} else if (data.status == true) {
						output.show().html(data.message).addClass('alert-info').removeClass('hide').removeClass('alert-danger');
						hiddenFile.val(data.filepath);
						// doc_type.val(data.filetype);
						preview_img.attr('src', data.fullfilepath);
					}
				},
				error: function() {
					// progress.hide();
					output.hide();
					alert('Failed to upload the file');
				}
			});
		});



		//datatable
		/*$('.datatable1').DataTable({ 
		    responsive: true,
		    ordering:  false,
		    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
		    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
		    buttons: [  
		        {extend: 'copy', className: 'btn-sm'}, 
		        {extend: 'csv', 
		            title: 'Payment_<?=
																date("dMY", strtotime($search->start_date)) . '_' .
																	date("dMY", strtotime($search->end_date)) . '_CSV'; ?>',
		            className: 'btn-sm'}, 
		        {extend: 'excel', 
		            title: 'Payment_<?=
																date("dMY", strtotime($search->start_date)) . '_' .
																	date("dMY", strtotime($search->end_date)) . '_EXCEL'; ?>', 
		            className: 'btn-sm'}, 
		        {extend: 'pdf', 
		            title: 'Payment_<?=
																date("dMY", strtotime($search->start_date)) . '_' .
																	date("dMY", strtotime($search->end_date)) . '_PDF'; ?>', 
		            className: 'btn-sm',
		            orientation: 'landscape'}, 
		        {extend: 'print', className: 'btn-sm',exportOptions: { columns: [ 0, 1, 2, 3, 4, 5 ]}} 
		    ]
		});*/


		// $('#acc_id').change(function(){
		//     $('#search_filter').submit();
		// });

	});
</script>