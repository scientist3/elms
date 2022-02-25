<!-- Main content -->
<section class="content">
    <div class="row">
        <!--  form area -->
        <div class="col-sm-12">
            <?php echo form_open_multipart('setting/create', 'class="form-horizontal"') ?>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i>Settings</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-sm-12">
                            <?php echo form_hidden('setting_id', $setting->setting_id) ?>
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label"><?php echo ('Institution Title') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-9">
                                    <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo ('Institution Title') ?>" value="<?php echo $setting->title ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label"><?php echo ('Address') ?></label>
                                <div class="col-sm-9">
                                    <input name="description" type="text" class="form-control" id="description" placeholder="<?php echo ('Address') ?>" value="<?php echo $setting->description ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label"><?php echo ('Email') ?></label>
                                <div class="col-sm-9">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo ('Email') ?>" value="<?php echo $setting->email ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-3 col-form-label"><?php echo ('Phone') ?></label>
                                <div class="col-sm-9">
                                    <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo ('Phone') ?>" value="<?php echo $setting->phone ?>">
                                </div>
                            </div>
                            <!-- if setting favicon is already uploaded -->
                            <?php if (!empty($setting->favicon)) {  ?>
                                <div class="form-group row">
                                    <label for="faviconPreview" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <img src="<?php echo base_url($setting->favicon) ?>" alt="Favicon" class="img-thumbnail" />
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label for="favicon" class="col-sm-3 col-form-label"><?php echo ('Favicon') ?> </label>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="favicon" id="favicon">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        <input type="hidden" name="old_favicon" value="<?php echo $setting->favicon ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- if setting logo is already uploaded -->
                            <?php if (!empty($setting->logo)) {  ?>
                                <div class="form-group row">
                                    <label for="logoPreview" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <img src="<?php echo base_url($setting->logo) ?>" alt="Picture" class="img-thumbnail" />
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label for="logo" class="col-sm-3 col-form-label"><?php echo ('Logo') ?></label>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        <input type="file" class="custom-file-input" name="logo" id="logo">
                                        <input type="hidden" name="old_logo" value="<?php echo $setting->logo ?>">
                                    </div>
                                </div>
                            </div>
                            <style>
                                .select2-container .select2-selection--single {
                                    height: 38px;
                                }

                                .select2-container--default .select2-selection--single .select2-selection__arrow {
                                    height: 38px;
                                }

                                .select2-container--default .select2-selection--single .select2-selection__clear {
                                    display: none;
                                }
                            </style>
                            <div class="form-group row">
                                <label for="footer_text" class="col-sm-3 col-form-label"><?php echo ('Language') ?></label>
                                <div class="col-sm-9">
                                    <?= form_dropdown('language', $languageList, $setting->language, 'class="form-control"') ?>
                                </div>
                            </div>
                            <?php /* <div class="form-group row">
                            <label for="footer_text" class="col-sm-3 col-form-label"><?php echo ('site_align') ?></label>
                            <div class="col-sm-9">
                                <?= form_dropdown('site_align', array('LTR' => ('left_to_right'), 'RTL' => ('right_to_left')), $setting->site_align, 'class="form-control"') ?>
                            </div>
                        </div>*/ ?>
                            <div class="form-group row">
                                <label for="footer_text" class="col-sm-3 col-form-label"><?php echo ('Footer Text') ?></label>
                                <div class="col-sm-9">
                                    <textarea name="footer_text" class="form-control" placeholder="Footer Text" maxlength="140" rows="2"><?php echo $setting->footer_text ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="reset" class="btn btn-default"><?php echo ('reset') ?></button>
                        <button class="btn btn-info float-right"><?php echo ('save') ?></button>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</section>