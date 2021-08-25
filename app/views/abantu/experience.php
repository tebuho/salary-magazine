<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content">
        <div class="body-container container">
            <div class="right-side profile-sidebar col-md-2">
                <div class="sidebar-container">
                    <h2>Please note</h2>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="ml-3 mr-3 center-side profile-content col-md-6">
                <?php echo flash('message_ye_experience'); ?>
                <div class="experience-card">
                    <form action="<?php echo URLROOT; ?>/abantu/experience/<?php echo $data['id_yomntu']; ?>" method="post">
                    <div class="input-label__container pt-1">
                        <div class="experience-title">
                            <h3 class="page-container" id="experience">Work Experience</h3>
                            <small class="float-right"><a href="#" id="add"><i class="fas fa-plus"></i> Add</a></small>
                        </div>
                        <?php foreach($data['work_experiences'] as $experience) : ?>
                        <div class="form-fields bg-white" id="formBlock_<?php echo $experience->ck_editor_id; ?>">
                            <div class="form-group">
                                <label for="company_<?php echo $experience->ck_editor_id; ?>">Company: <sup class="text-danger">*</sup></label>
                                <input type="text" name="company[]" id="company_<?php echo $experience->ck_editor_id; ?>" class="bg-light form-control <?php echo !empty($data['company_err']) ? 'is-invalid' : ''; ?>" value="<?php echo $experience->company; ?>" required>
                                <span class="invalid-feedback"><?php echo $data['company_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="job_title_<?php echo $experience->ck_editor_id; ?>">Job title: <sup class="text-danger">*</sup></label>
                                <input type="text" name="job_title[]" id="job_title_<?php echo $experience->ck_editor_id; ?>" class="bg-light form-control <?php echo (!empty($data['job_title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $experience->job_title; ?>" required>
                                <span class="invalid-feedback"><?php echo $data['job_title_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="start_year_<?php echo $experience->ck_editor_id; ?>">Uqale ngowuphi unyaka: <sup class="text-danger">*</sup></label>
                                <div class="input-container col-3 p-0">
                                    <select name="start_year[]" id="start_year_<?php echo $experience->ck_editor_id; ?>" class="p-2 form-control custom-select <?php echo (!empty($data['start_year_err'])) ? 'is-invalid' : ''; ?>">
                                        <option class="form-control" value="<?php echo empty($experience->start_year) ? 'Khetha' : $experience->start_year; ?>"><?php echo empty($experience->start_year) ? 'Khetha' : $experience->start_year; ?></option>
                                        <?php foreach($data['years'] as $year) :  ?>
                                            <option class="form-control" value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="invalid-feedback"><?php echo $data['start_year_err']; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usasebenza_apha_<?php echo $experience->ck_editor_id; ?>">Usasebenza apha: <sup class="text-danger">*</sup></label>
                                <div class="input-container col-3 p-0">
                                    <select name="usasebenza_apha[]" id="usasebenza_apha_<?php echo $experience->ck_editor_id; ?>" class="p-2 usasebenza_apha form-control custom-select">
                                        <?php if(!empty($experience->usasebenza_apha)) : ?>
                                            <option class="form-control" id="ewe_ndisasebenza_apha_0" value="<?php echo $experience->usasebenza_apha; ?>"><?php echo $experience->usasebenza_apha; ?></option>
                                            <option class="form-control" id="ewe_ndisasebenza_apha_0" value="<?php echo $experience->usasebenza_apha == "Hayi" ? "Ewe" : "Hayi"; ?>"><?php echo $experience->usasebenza_apha == "Hayi" ? "Ewe" : "Hayi"; ?></option>
                                        <?php else : ?>
                                            <option class="form-control" id="ewe_ndisasebenza_apha_0" value="Ewe">Ewe</option>
                                            <option class="form-control" id="hayi_ndisasebenza_apha_0" value="Hayi">Hayi</option>
                                        <?php endif; ?>
                                    </select>
                                    <input class="form-check-input <?php echo !empty($data["usasebenza_apha_err"]) ? 'is-invalid' : ''; ?>" type="hidden">
                                    <span class="invalid-feedback"><?php echo $data['usasebenza_apha_err']; ?></span>
                                </div>
                            </div>
                            <div class="form-group collapse gqibe_nini" id="gqibe_nini_<?php echo $experience->ck_editor_id; ?>" style="<?php echo !empty($experience->ugqibe_nini) ? 'display:block' : ''; ?>">
                                <label for="ugqibe_nini_<?php echo $experience->ck_editor_id; ?>">Uyeke nini?</label>
                                <div class="input-container col-3 p-0">
                                    <select name="ugqibe_nini[]" id="ugqibe_nini_<?php echo $experience->ck_editor_id; ?>" class="p-2 form-control custom-select <?php echo (!empty($data['ugqibe_nini_err'])) ? 'is-invalid' : ''; ?>">
                                        <option class="form-control" value="<?php echo empty($experience->ugqibe_nini) ? 'Khetha' : $experience->ugqibe_nini; ?>"><?php echo empty($experience->ugqibe_nini) ? 'Khetha' : $experience->ugqibe_nini; ?></option>
                                        <?php foreach($data['years'] as $year) :  ?>
                                            <option class="form-control" value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="invalid-feedback"><?php echo $data['ugqibe_nini_err']; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="responsibilities_<?php echo $experience->ck_editor_id; ?>">ZIntoni obuzenza apha: <sup class="text-danger">*</sup></label>
                                <textarea name="responsibilities[]" class="bg-light form-control <?php echo (!empty($data['responsibilities_err'])) ? 'is-invalid' : ''; ?>" id="responsibilities_<?php echo $experience->ck_editor_id; ?>">
                                    <?php echo $experience->responsibilities; ?>
                                </textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'responsibilities_<?php echo $experience->ck_editor_id; ?>' );
                                </script>
                                <span class="invalid-feedback"><?php echo $data['responsibilities_err']; ?></span>
                            </div>
                            <div class="form-group collapse" id="reason_<?php echo $experience->ck_editor_id; ?>">
                                <label for="reason_for_leaving_<?php echo $experience->ck_editor_id; ?>">Reason for leaving</label>
                                <input type="text" name="reason_for_leaving[]" id="reason_for_leaving_<?php echo $experience->ck_editor_id; ?>" class="form-control" value="<?php echo $experience->reason_for_leaving; ?>">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                        <div class="row">
                            <div class="col flex">
                                <button class="form-btn__primary">Cofa xa Ugqibile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php require APPROOT .'/views/abantu/inc/aside.php'; ?>

        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>