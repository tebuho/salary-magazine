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
                <div class="tertiary-card">
                    <?php echo flash("message_ye_education"); ?>
                    <form id="tertiaryForm" action="<?php echo URLROOT; ?>/abantu/tertiaryEducation/<?php echo $data["id"]; ?>" method="post">

                        <!-- Tertiary education -->
                        <div class="input-label__container pt-1">
                            <div class="tertiary-title">
                                <h3 class="page-container" id="tertiary">Tertiary Education</h3>
                                <small class="float-right"><a href="#" id="add"><i class="fas fa-plus"></i> Add</a></small>
                            </div>
                            <?php foreach ($data['tertiary_education'] as $tertiary) : ?>
                                <div class="form-fields bg-white pb-2" id="formFields">
                                    <div class="form-group">
                                        <label for="level_passed">Highest level passed: <sup class="text-danger">*</sup></label>
                                        <input type="text" name="level_passed[]" class="bg-light form-control form-control-lg <?php echo (!empty($data["level_passed_err"])) ? 'is-invalid' : ''; ?>" value="<?php echo !isset($data["tertiary_education"]->level_passed) ? $tertiary->level_passed : $data["tertiary_education"]->level_passed; ?>">
                                        <span class="invalid-feedback"><?php echo $data['level_passed_err']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="course">Course yantoni: <sup class="text-danger">*</sup></label>
                                        <input type="text" name="course[]" class="bg-light form-control form-control-lg <?php echo !empty($data["course_err"]) ? 'is-invalid' : ''; ?>" value="<?php echo !isset($data["tertiary_education"]->course) ? $tertiary->course : ""; ?>">
                                        <span class="invalid-feedback"><?php echo $data['course_err']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="institution">Igama le s'kolo: <sup class="text-danger">*</sup></label>
                                        <input type="text" id="institution" name="institution[]" class="bg-light form-control form-control-lg <?php echo !empty($data["institution_err"]) ? 'is-invalid' : ''; ?>" value="<?php echo !isset($data["tertiary_education"]->institution) ? $tertiary->institution : ""; ?>">
                                        <span class="invalid-feedback"><?php echo $data["institution_err"]; ?></span>
                                    </div>
                                    <div class="form-group content-true">
                                        <label for="year_passed">Ugqibe nini: <sup class="text-danger">*</sup></label>
                                        <div class="input-container col-3 p-0">
                                            <select name="year_passed[]" class="p-2 form-control custom-select" id="year_passed">
                                                <?php if (!empty($tertiary->year_passed)) : ?>
                                                    <option class="form-control" value="<?php echo $tertiary->year_passed; ?>"><?php echo $tertiary->year_passed; ?></option>
                                                <?php endif; ?>
                                                <?php foreach($data["years"] as $year) :  ?>
                                                    <option class="form-control" value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="invalid-feedback"><?php echo $data["year_passed"]; ?></span>
                                        </div>
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