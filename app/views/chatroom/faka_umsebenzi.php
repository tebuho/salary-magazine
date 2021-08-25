
<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/functions.php'; ?>
<div class="page container">
    <div class="page-container register-login">
        <h1>Wufake Apha Umsebenzi</h1>
    </div>
</div>
<div class="body-container container">
    <div class="bhalisa-ngena__form">
        <form action="<?php echo URLROOT; ?>/chatroom/faka_umsebenzi" method="post">
            <div class="form-container">
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="job_title">Job Title</label>
                    </div>
                    <div class="input-container flex">
                        <input type="text" name="job_title" id="job_title" class="form-control" value="<?php echo $data['job_title']; ?>">
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="igama_le_company">Igama le Company</label>
                    </div>
                    <div class="input-container flex">
                        <input type="text" name="igama_le_company" id="igama-le-company" class="form-control" value="<?php echo $data['igama_le_company']; ?>" required="required">
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="Province">Province</label>
                    </div>
                    <div class="input-container flex">
                        <select name="job_province" class="form-control" id="">
                            <?php echo $option->selectOption(); ?>
                            <option class="form-control" value="Eastern Cape">Eastern Cape</option>
                            <option class="form-control" value="Free State">Free State</option>
                            <option class="form-control" value="Gauteng">Gauteng</option>
                            <option class="form-control" value="KwaZulu-Natal">KwaZulu-Natal</option>
                            <option class="form-control" value="Limpopo">Limpopo</option>
                            <option class="form-control" value="Mpumalanga">Mpumalanga</option>
                            <option class="form-control" value="North West">North West</option>
                            <option class="form-control" value="Northern Cape">Northern Cape</option>
                            <option class="form-control" value="Western Cape">Western Cape</option>
                        </select>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="Ndawoni">Ndawoni Pha</label>
                    </div>
                    <div class="input-container flex">
                        <input type="text" name="ndawoni_pha" id="igama-le-company" class="form-control" value="<?php echo $data['ndawoni_pha']; ?>" required="required">
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="Msebenzi Onjani">Ngumsebenzi Onjani</label>
                    </div>
                    <div class="input-container flex">
                        <select name="msebenzi_onjani" class="form-control" id="">
                            <?php echo $option->selectOption(); ?>
                            <option class="form-control" value="Casual">Casual</option>
                            <option class="form-control" value="Contract">Contract</option>
                            <option class="form-control" value="Full-time">Full-time</option>
                            <option class="form-control" value="In-Service">In-Service</option>
                            <option class="form-control" value="Internship">Internship</option>
                            <option class="form-control" value="Learnership">Learnership</option>
                            <option class="form-control" value="Part-time">Part-time</option>
                        </select>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="Msebenzi Onjani">Level ye Mfundo</label>
                    </div>
                    <div class="input-container flex">
                        <select name="mfundo" class="form-control" id="">
                            <?php echo $option->selectOption(); ?>
                            <option class="form-control" value="Grade 4 - 9/NQF Level 1">Grade 4 - 9/NQF Level 1</option>
                            <option class="form-control" value="Grade 10/N1/NQF Level 2">Grade 10/N1/NQF Level 2</option>
                            <option class="form-control" value="Grade 11/N2/NQF Level 3">Grade 11/N2/NQF Level 3</option>
                            <option class="form-control" value="Matric/NQF Level 4">Matric/NQF Level 4</option>
                            <option class="form-control" value="Higher Certificate/NQF Level 5">Higher Certificate/NQF Level 5</option>
                            <option class="form-control" value="Diploma/NQF Level 6">Diploma/NQF Level 6</option>
                            <option class="form-control" value="Degree/BTech/NQF Level 7">Degree/BTech/NQF Level 7</option>
                            <option class="form-control" value="Honours/Postgraduate">Honours/Postgraduate</option>
                            <option class="form-control" value="Master's">Master's</option>
                            <option class="form-control" value="Doctorate">Doctorate</option>
                        </select>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="Msebenzi Onjani">Iminyaka ye Experience</label>
                    </div>
                    <div class="input-container flex">
                        <select name="experience" class="form-control" id="">
                            <?php echo $option->selectOption(); ?>
                            <option class="form-control" value="0 years">0 years</option>
                            <option class="form-control" value="1 - 2 years">1 - 2 years</option>
                            <option class="form-control" value="3 - 5 years">3 - 5 years</option>
                            <option class="form-control" value="6 - 9 years">6 - 9 years</option>
                            <option class="form-control" value="10 - 14 years">10 - 14 years</option>
                            <option class="form-control" value="15+ years">15+ years</option>
                        </select>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="Ngowantoni">Ngowantoni</label>
                    </div>
                    <div class="input-container flex">
                        <select name="ngowantoni" class="form-control" id="">
                            <?php echo $option->selectOption(); ?>
                            <option class="form-control" value="Administration">Administration</option>
                            <option class="form-control" value="Agriculture">Agriculture</option>
                            <option class="form-control" value="Banking">Banking</option>
                            <option class="form-control" value="Customer Service">Customer Service</option>
                            <option class="form-control" value="Education">Education</option>
                            <option class="form-control" value="Finance">Finance</option>
                            <option class="form-control" value="Healthcare">Healthcare</option>
                            <option class="form-control" value="Hospitality">Hospitality</option>
                            <option class="form-control" value="Human Resources">Human Resources</option>
                            <option class="form-control" value="IT">IT</option>
                            <option class="form-control" value="Law Enforcement">Law Enforcement</option>
                            <option class="form-control" value="Logistics">Logistics</option>
                            <option class="form-control" value="Marketing">Marketing</option>
                            <option class="form-control" value="Media">Media</option>
                            <option class="form-control" value="Real Estate">Real Estate</option>
                            <option class="form-control" value="Restaurant">Restaurant</option>
                            <option class="form-control" value="Retail">Retail</option>
                            <option class="form-control" value="Sales">Sales</option>
                            <option class="form-control" value="Scientific">Scientific</option>
                            <option class="form-control" value="Security">Security</option>
                            <option class="form-control" value="Social Care">Social Care</option>
                            <option class="form-control" value="Transportation">Transportation</option>
                            <option class="form-control" value="Travel">Travel</option>
                            <option class="form-control" value="Volunteering">Volunteering</option>
                        </select>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="closing_date">Closing date</label>
                    </div>
                    <div class="input-container flex">
                        <input type="date" name="closing_date" id="closing_date" class="form-control" data-date-format="DD MMMM YYYY" value="<?php echo $data['closing_date']; ?>" required="required" title="">
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="closing_date">Requirements</label>
                    </div>
                    <div class="input-container flex">
                        <textarea name="requirements" id="requirements" class="form-control" required="required"><?php echo $data['requirements']; ?></textarea>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'requirements' );
                        </script>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="closing_date">Skills &amp; Competencies</label>
                    </div>
                    <div class="input-container flex">
                        <textarea name="skills_competencies" id="skills_competencies" class="form-control"><?php echo $data['skills_competencies']; ?></textarea>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="closing_date">Responsibilities</label>
                    </div>
                    <div class="input-container flex">
                        <textarea name="responsibilities" id="responsibilities" class="form-control" required="required"><?php echo $data['responsibilities']; ?></textarea>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="closing_date">Additional Information</label>
                    </div>
                    <div class="input-container flex">
                        <textarea name="additional_info" id="closing_date" class="form-control"><?php echo $data['additional_info']; ?></textarea>
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="label-container">
                        <label for="closing_date">Ku Aplaywa Njani</label>
                    </div>
                    <div class="input-container flex">
                        <input type="url" name="application_mode" class="form-control <?php echo (!empty($data['application_mode_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['application_mode']; ?>">
                    </div>
                </div>
                <div class="input-label__container">
                    <div class="input-container flex">
                        <button class="form-btn__primary">Cofa xa Ugqibile</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>