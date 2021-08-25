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
            <div class="ml-3 mr-3 profile-form__container center-side profile-content col-md-6">
                
                    <div class="heading-container card-lokubuza mt-3 mb-3">
                        <div class="user-feed__meta">
                            <div class="add-content text-dark font-weight-bold">
                                <p>Sixelele ufuna umsebenzi onjani. Sizokwazisa nge email xa siwufumene.</p>
                            </div>
                        </div>
                    </div>
                    
                <div class="profile-card">
                    <?php echo $data['checked']; ?>
                    <?php echo flash('message_ye_profile'); ?>
                    <form action="<?php echo URLROOT; ?>/abantu/preference/<?php echo $data["id"]; ?>" method="post">
                        <div class="form-group">
                            <label for="igama lakho" class="font-weight-bold">Job Title: <sup class="text-danger">*</sup></label><br>
                            <small class="pb-1 d-block">(Use a comma to separate job titles)</small>
                            <input type="text" name="job_title[]" class="form-control form-control-lg <?php echo (!empty($data["job_title_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["job_title"]; ?>"  required autofocus>
                            <span class="invalid-feedback"><?php echo $data["job_title_err"]; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="fani yakho" class="font-weight-bold">Education: <sup class="text-danger">*</sup></label><br>
                            <ul>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Grade 4 - 9/NQF Level 1" <?php echo is_array($data['education']) && in_array("Grade 4 - 9/NQF Level 1", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Grade 4 - 9/NQF Level 1</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Grade 10/N1/NQF Level 2" <?php echo is_array($data['education']) && in_array("Grade 4 - 9/NQF Level 1", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Grade 10/N1/NQF Level 2</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Grade 11/N2/NQF Level 3" <?php echo is_array($data['education']) && in_array("Grade 11/N2/NQF Level 3", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Grade 11/N2/NQF Level 3</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Matric/NQF Level 4" <?php echo is_array($data['education']) && in_array("Matric/NQF Level 4", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Matric/NQF Level 4</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Higher Certificate/NQF Level 5" <?php echo is_array($data['education']) && in_array("Higher Certificate/NQF Level 5", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Higher Certificate/NQF Level 5</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Diploma/NQF Level 6" <?php echo is_array($data['education']) && in_array("Diploma/NQF Level 6", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Diploma/NQF Level 6</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Degree/BTech/NQF Level 7" <?php echo is_array($data['education']) && in_array("Degree/BTech/NQF Level 7", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Degree/BTech/NQF Level 7</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Honours/Postgraduate" <?php echo is_array($data['education']) && in_array("Honours/Postgraduate", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Honours/Postgraduate</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Master's" <?php echo is_array($data['education']) && in_array("Master's", $data['education']) ? "checked" : ""; ?>>
                                        <label class="form-check-label font-weight-normal">Master's</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="education[]" type="checkbox" value="Doctorate" <?php echo is_array($data['education']) && in_array("Doctorate", $data['education']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Doctorate</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="fani yakho" class="font-weight-bold">Experience: <sup class="text-danger">*</sup></label><br>
                            <ul>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="experience[]" type="checkbox" value="0 years" <?php echo is_array($data['experience']) && in_array("0 years", $data['experience']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">0 years</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="experience[]" type="checkbox" value="1 - 2 years" <?php echo is_array($data['experience']) && in_array("1 - 2 years", $data['experience']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">1 - 2 years</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="experience[]" type="checkbox" value="3 - 5 years" <?php echo is_array($data['experience']) && in_array("3 - 5 years", $data['experience']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">3 - 5 years</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="experience[]" type="checkbox" value="6 - 9 years" <?php echo is_array($data['experience']) && in_array("6 - 9 years", $data['experience']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">6 - 9 years</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="experience[]" type="checkbox" value="10 - 14 years" <?php echo is_array($data['experience']) && in_array("10 - 14 years", $data['experience']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">10 - 14 years</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="experience[]" type="checkbox" value="15+ years" <?php echo is_array($data['experience']) && in_array("15+ years", $data['experience']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">15+ years</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="fani yakho" class="font-weight-bold">Onjani: <sup class="text-danger">*</sup></label>
                            <ul>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Apprenticeship" <?php echo is_array($data['onjani']) && in_array("Apprenticeship", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Apprenticeship</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Bursary" <?php echo is_array($data['onjani']) && in_array("Bursary", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Bursary</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Casual" <?php echo is_array($data['onjani']) && in_array("Casual", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Casual</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Contract" <?php echo is_array($data['onjani']) && in_array("Contract", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Contract</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Full-Time" <?php echo is_array($data['onjani']) && in_array("Full-Time", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Full-Time</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="In-Service" <?php echo is_array($data['onjani']) && in_array("In-Service", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">In-Service</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Internship" <?php echo is_array($data['onjani']) && in_array("Internship", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Internship</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Learnership" <?php echo is_array($data['onjani']) && in_array("Learnership", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Learnership</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Part-time" <?php echo is_array($data['onjani']) && in_array("Part-time", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Part-time</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="onjani[]" type="checkbox" value="Scholarship" <?php echo is_array($data['onjani']) && in_array("Scholarship", $data['onjani']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal">Scholarship</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="fani yakho" class="font-weight-bold">Category: <sup class="text-danger">*</sup></label>
                            <ul>
                                <?php

                                for ($i = 1; $i < count($data['job_categories']); $i++) :

                                foreach($data['job_categories'][$i] as $job_category => $jb):

                                ?>

                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="categories[]" type="checkbox" value="<?php echo $jb; ?>" <?php echo is_array($data['categories']) && in_array($jb, $data['categories']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label font-weight-normal" for="categories"><?php echo $jb; ?></label>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endfor; ?>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="fani yakho" class="font-weight-bold">Province: <sup class="text-danger">*</sup></label><br>
                            <ul>
                                <?php foreach($province->provinces as $province => $slug) : ?>
                                    <li>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="provinces[]" type="checkbox" value="<?php echo $province; ?>" <?php echo is_array($data['provinces']) && in_array($province, $data['provinces']) ? 'checked' : ''; ?>>
                                            <label class="form-check-label font-weight-normal"><?php echo $province; ?></label>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col flex">
                                <button class="form-btn__primary">Cofa xa Ugqibile</button>
                            </div>
                        </div>
                        <div class="input-label__container">
                    </div>
                    </form>
                </div>
            </div>

            <?php require APPROOT .'/views/abantu/inc/aside.php'; ?>

        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>