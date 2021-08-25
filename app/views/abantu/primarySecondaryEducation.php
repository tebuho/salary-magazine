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
                <div class="experience-title pt-2">
                    <h3 class="page-container">Primary/Secondary Education</h3>
                </div>
                <div class="profile-card">
                    <?php echo flash("message_ye_education"); ?>
                    <form action="<?php echo URLROOT; ?>/abantu/primarySecondaryEducation/<?php echo $data["id"]; ?>" method="post">
                        <div class="form-group">
                            <label for="grade" class="mt-2">Grade: <sup class="text-danger">*</sup></label>
                            <input type="text" name="grade" id="grade" class="bg-light mb-0 form-control form-control-lg <?php echo (!empty($data["grade_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["grade"]; ?>" focused>
                            <span class="invalid-feedback"><?php echo $data["grade_err"]; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Ubusenza ntoni">Igama le'skolo: <sup class="text-danger">*</sup></label>
                            <input type="text" name="school" class="bg-light mb-0 form-control form-control-lg <?php echo (!empty($data["school_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["school"]; ?>">
                            <span class="invalid-feedback"><?php echo $data["school_err"]; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Ugqibe nini">Ugqibe nini: <sup class="text-danger">*</sup></label>
                            <div class="input-container col-3 p-0">
                                <select name="year" class="p-2 form-control custom-select" id="">
                                    <?php if(!empty($data["year"])) : ?>
                                        <option class="form-control" value="<?php echo $data["year"]; ?>"><?php echo $data["year"]; ?></option>
                                    <?php endif; ?>
                                    <?php foreach($data["years"] as $year) :  ?>
                                        <option class="form-control" value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="invalid-feedback"><?php echo $data["year_err"]; ?></span>
                            </div>
                        </div>
                        <div class="input-label__container pt-1 mt-3">
                            <label class="page-container font-weight-normal"><a href="<?php echo URLROOT; ?>/abantu/tertiaryEducation/<?php echo $data["id"]; ?>">Tertiary Education?</a></label>
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