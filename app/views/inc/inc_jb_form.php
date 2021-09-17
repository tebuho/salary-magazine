<div class="container">
    <div class="row">
        <div class="bhalisa-ngena__form white-background-border col-md-6">
            <?php if ($_GET['url'] != "addJobs/add") : ?>
            <h1 class="page-container">Edit</h1>
            <h3><?php echo $data['job_title']; ?></h3>
            <p><?php echo $data['gama_le_company']; ?> - <?php echo $data['ndawoni']; ?>, <?php echo $data['province']; ?></p>
            <?php endif; ?>
            <?php echo flash('message_yomsebenzi'); ?>
            <h1>Wufake Apha Umsebenzi</h1>
            <form action="<?php echo URLROOT; ?>/<?php echo $_GET['url']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-container">
                    <!-- Job title -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_title">Job Title</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_title" class="form-control form-control-lg <?php echo (!empty($data["err_mssg"]['job_title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['job_title']; ?>" autofocus>
                            <span class="invalid-feedback"><?php echo $data["err_mssg"]['job_title_err']; ?></span>
                        </div>
                    </div>
                    <!-- No. of posts -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="posts">No. of Posts</label>
                        </div>
                        <div class="input-container">
                            <input type="number" name="posts" class="form-control form-control-lg" value="<?php echo $data['posts']; ?>">
                        </div>
                    </div>
                    <!-- Employer -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="igama_le_company">Igama le Company</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="igama_le_company" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['gama_le_company_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['gama_le_company']; ?>" >
                            <span class="invalid-feedback"><?php echo $data['gama_le_company_err']; ?></span>
                        </div>
                    </div>
                    <!-- Provinces -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Province">Province</label>
                        </div>
                        <div class="input-container">
                            <select name="job_province" class="form-control form-control-lg <?php echo (!empty($data['province_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['province']) ? 'Khetha' : $data['province']; ?>"><?php echo empty($data['province']) ? 'Khetha' : $data['province']; ?></option>
                                <option class="form-control" value="Eastern Cape">Eastern Cape</option>
                                <option class="form-control" value="Free State">Free State</option>
                                <option class="form-control" value="Gauteng">Gauteng</option>
                                <option class="form-control" value="KwaZulu-Natal">KwaZulu-Natal</option>
                                <option class="form-control" value="Limpopo">Limpopo</option>
                                <option class="form-control" value="Mpumalanga">Mpumalanga</option>
                                <option class="form-control" value="North West">North West</option>
                                <option class="form-control" value="Northern Cape">Northern Cape</option>
                                <option class="form-control" value="Western Cape">Western Cape</option>
                                <option class="form-control" value="Nationwide">Nationwide</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data['province_err']; ?></span>
                        </div>
                    </div>
                    <!-- Location -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Ndawoni">Ndawoni Pha</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="ndawoni_pha" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['ndawoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ndawoni']; ?>" >
                            <span class="invalid-feedback"><?php echo $data['ndawoni_err']; ?></span>
                        </div>
                    </div>
                    <!-- Onjani -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Msebenzi Onjani">Ngumsebenzi Onjani</label>
                        </div>
                        <div class="input-container">
                            <select name="msebenzi_onjani" class="form-control form-control-lg <?php echo (!empty($data["err_mssg"]['msebenzi_onjani_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['msebenzi_onjani']) ? 'Khetha' : $data['msebenzi_onjani']; ?>"><?php echo empty($data['msebenzi_onjani']) ? 'Khetha' : $data['msebenzi_onjani']; ?></option>
                                <option class="form-control" value="Apprenticeship">Apprenticeship</option>
                                <option class="form-control" value="Bursary">Bursary</option>
                                <option class="form-control" value="Casual">Casual</option>
                                <option class="form-control" value="Contract">Contract</option>
                                <option class="form-control" value="Full-Time">Full-Time</option>
                                <option class="form-control" value="In-Service">In-Service</option>
                                <option class="form-control" value="Internship">Internship</option>
                                <option class="form-control" value="Learnership">Learnership</option>
                                <option class="form-control" value="Part-time">Part-time</option>
                                <option class="form-control" value="Scholarship">Scholarship</option>
                                <option class="form-control" value="Volunteer">Volunteer</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data["err_mssg"]['msebenzi_onjani_err']; ?></span>
                        </div>
                    </div>
                    <!-- Education -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Msebenzi Onjani">Level ye Mfundo</label>
                        </div>
                        <div class="input-container">
                            <select name="mfundo" class="form-control form-control-lg <?php echo (!empty($data["err_mssg"]['mfundo_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['mfundo']) ? 'Khetha' : $data['mfundo']; ?>"><?php echo empty($data['mfundo']) ? 'Khetha' : $data['mfundo']; ?></option>
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
                            <span class="invalid-feedback"><?php echo $data["err_mssg"]["mfundo_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Experience -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Msebenzi Onjani">Iminyaka ye Experience</label>
                        </div>
                        <div class="input-container">
                            <select name="experience" class="form-control form-control-lg <?php echo (!empty($data["err_mssg"]["experience_err"])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['experience']) ? 'Khetha' : $data['experience']; ?>"><?php echo empty($data['experience']) ? 'Khetha' : $data['experience']; ?></option>
                                <option class="form-control" value="0 years">0 years</option>
                                <option class="form-control" value="1 - 2 years">1 - 2 years</option>
                                <option class="form-control" value="3 - 5 years">3 - 5 years</option>
                                <option class="form-control" value="6 - 9 years">6 - 9 years</option>
                                <option class="form-control" value="10 - 14 years">10 - 14 years</option>
                                <option class="form-control" value="15+ years">15+ years</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data["err_mssg"]["experience_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Ngowantoni -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Ngowantoni">Ngowantoni</label>
                        </div>
                        <div class="input-container">
                            <select name="ngowantoni" class="form-control form-control-lg <?php echo (!empty($data["err_mssg"]['ngowantoni_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['ngowantoni']) ? 'Khetha' : $data['ngowantoni']; ?>"><?php echo empty($data['ngowantoni']) ? 'Khetha' : $data['ngowantoni']; ?></option>
                                <option class="form-control" value="Accounting">Accounting</option>
                                <option class="form-control" value="Actuary">Actuary</option>
                                <option class="form-control" value="Administration">Administration</option>
                                <option class="form-control" value="Agriculture">Agriculture</option>
                                <option class="form-control" value="Artisan">Artisan</option>
                                <option class="form-control" value="Auditing">Auditing</option>
                                <option class="form-control" value="Banking">Banking</option>
                                <option class="form-control" value="Call Centre">Call Centre</option>
                                <option class="form-control" value="Cashier">Cashier</option>
                                <option class="form-control" value="Catering">Catering</option>
                                <option class="form-control" value="Chef">Chef</option>
                                <option class="form-control" value="Chemical Engineering">Chemical Engineering</option>
                                <option class="form-control" value="Cleaning">Cleaning</option>
                                <option class="form-control" value="Communications">Communications</option>
                                <option class="form-control" value="Community Services">Community Services</option>
                                <option class="form-control" value="Cookery">Cookery</option>
                                <option class="form-control" value="Customer Service">Customer Service</option>
                                <option class="form-control" value="Data Capturing">Data Capturing</option>
                                <option class="form-control" value="Driver">Driver</option>
                                <option class="form-control" value="Education">Education</option>
                                <option class="form-control" value="Emergency Services">Emergency Services</option>
                                <option class="form-control" value="Engineering">Engineering</option>
                                <option class="form-control" value="Environmental">Environmental</option>
                                <option class="form-control" value="Facilities">Facilities/Property</option>
                                <option class="form-control" value="Finance">Finance</option>
                                <option class="form-control" value="Food Technology">Food Technology</option>
                                <option class="form-control" value="General Work">General Work</option>
                                <option class="form-control" value="Government">Government</option>
                                <option class="form-control" value="Graphic Design">Graphic Design</option>
                                <option class="form-control" value="Handyman">Handyman</option>
                                <option class="form-control" value="Healthcare">Healthcare</option>
                                <option class="form-control" value="Horticulture">Horticulture</option>
                                <option class="form-control" value="Hospitality">Hospitality</option>
                                <option class="form-control" value="Housekeeping">Housekeeping</option>
                                <option class="form-control" value="Human Resources">Human Resources</option>
                                <option class="form-control" value="Insurance">Insurance</option>
                                <option class="form-control" value="Investigations">Investigations</option>
                                <option class="form-control" value="IT">IT</option>
                                <option class="form-control" value="Law">Law</option>
                                <option class="form-control" value="Law Enforcement">Law Enforcement</option>
                                <option class="form-control" value="Library">Library</option>
                                <option class="form-control" value="Logistics">Logistics</option>
                                <option class="form-control" value="Maintenance">Maintenance</option>
                                <option class="form-control" value="Manufacturing">Manufacturing</option>
                                <option class="form-control" value="Marketing">Marketing</option>
                                <option class="form-control" value="Mechanic">Mechanic</option>
                                <option class="form-control" value="Media">Media</option>
                                <option class="form-control" value="Merchandiser">Merchandiser</option>
                                <option class="form-control" value="Monitoring and Evaluation">Monitoring and Evaluation</option>
                                <option class="form-control" value="Municipality">Municipality</option>
                                <option class="form-control" value="Nursing">Nursing</option>
                                <option class="form-control" value="Payroll">Payroll</option>
                                <option class="form-control" value="Personal Assistant">Personal Assistant</option>
                                <option class="form-control" value="Pharmacy">Pharmacy</option>
                                <option class="form-control" value="Policing">Policing</option>
                                <option class="form-control" value="Production">Production</option>
                                <option class="form-control" value="Project Managament">Project Managament</option>
                                <option class="form-control" value="Public Relations">Public Relations</option>
                                <option class="form-control" value="Restaurant">Restaurant</option>
                                <option class="form-control" value="Reception">Reception</option>
                                <option class="form-control" value="Research">Research</option>
                                <option class="form-control" value="Retail">Retail</option>
                                <option class="form-control" value="Safety Health Environment Risk & Quality">Safety Health Environment Risk & Quality</option>
                                <option class="form-control" value="Sales">Sales</option>
                                <option class="form-control" value="Science">Science</option>
                                <option class="form-control" value="Secretary">Secretary</option>
                                <option class="form-control" value="Security">Security</option>
                                <option class="form-control" value="Social Media">Social Media</option>
                                <option class="form-control" value="Social Work">Social Work</option>
                                <option class="form-control" value="Statistics">Statistics</option>
                                <option class="form-control" value="Stock Control">Stock Control</option>
                                <option class="form-control" value="Supply Chain/Procurement">Supply Chain/Procurement</option>
                                <option class="form-control" value="Technician">Technician</option>
                                <option class="form-control" value="Tourism">Tourism</option>
                                <option class="form-control" value="Travel">Travel</option>
                                <option class="form-control" value="Volunteering">Volunteering</option>
                                <option class="form-control" value="Waitor/Waitress">Waitor/Waitress</option>
                                <option class="form-control" value="Warehouse">Warehouse</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data["err_mssg"]['ngowantoni_err']; ?></span>
                        </div>
                    </div>
                    <!-- Ref No. -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="ref_no">Ref No.</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="ref_no" id="ref-no" class="form-control form-control-lg" value="<?php echo $data['ref_no']; ?>">
                        </div>
                    </div>
                    <!-- Centre -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="centre">Centre</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="centre" id="centre" class="form-control form-control-lg" value="<?php echo $data['centre']; ?>">
                        </div>
                    </div>
                    <!-- Salary, stipend & benefits -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="remuneration">Remuneration</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="remuneration" id="remuneration" class="form-control form-control-lg" value="<?php echo $data['remuneration']; ?>">
                        </div>
                    </div>
                    <!-- Driver's license -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="license">Driver's License</label>
                        </div>
                        <div class="input-container">
                            <select name="license" class="form-control form-control-lg" id="license">
                                <option class="form-control" value="<?php echo empty($data['license']) ? 'Khetha' : $data['license']; ?>"><?php echo empty($data['license']) ? 'Khetha' : $data['license']; ?></option>
                                <option class="form-control" value="Yes">Yes</option>
                                <option class="form-control" value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <!-- Afrikaans -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="afrikaans">Afrikaans?</label>
                        </div>
                        <div class="input-container">
                            <select name="afrikaans" class="form-control form-control-lg" id="afrikaans">
                                <option class="form-control" value="<?php echo empty($data['afrikaans']) ? 'Khetha' : $data['afrikaans']; ?>"><?php echo empty($data['afrikaans']) ? 'Khetha' : $data['afrikaans']; ?></option>
                                <option class="form-control" value="Yes">Yes</option>
                                <option class="form-control" value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <!-- Employer type -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="license">Employer Type</label>
                        </div>
                        <div class="input-container">
                            <select name="employer_type" class="form-control form-control-lg" id="employer_type">
                                <option class="form-control" value="<?php echo empty($data['employer_type']) ? 'Khetha' : $data['employer_type']; ?>"><?php echo empty($data['employer_type']) ? 'Khetha' : $data['employer_type']; ?></option>
                                <option class="form-control" value="Company">Company</option>
                                <option class="form-control" value="Government">Government</option>
                                <option class="form-control" value="Municipality">Municipality</option>
                                <option class="form-control" value="NGO">NGO</option>
                            </select>
                        </div>
                    </div>
                    <!-- Facebook -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="facebook">Facebook Post?</label>
                        </div>
                        <div class="input-container">
                            <select name="facebook" class="form-control form-control-lg" id="facebook">
                                <option class="form-control" value="<?php echo empty($data['facebook']) ? 'Khetha' : $data['facebook']; ?>"><?php echo empty($data['facebook']) ? 'Khetha' : $data['facebook']; ?></option>
                                <option class="form-control" value="Yes">Yes</option>
                                <option class="form-control" value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <!-- Closing date -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="closing_date">Closing date</label>
                        </div>
                        <div class="input-container">
                            <input type="date" name="closing_date" id="closing_date" class="form-control" data-date-format="DD MMMM YYYY" value="<?php echo $data['closing_date']; ?>">
                        </div>
                    </div>
                    <!-- Purpose -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="closing_date">Purpose (optional)</label>
                        </div>
                        <div class="input-container">
                            <textarea name="purpose" rows="6" id="purpose" class="form-control form-control-lg">
                            
                                <?php echo $data['purpose']; ?>
                            </textarea>
                            <script>
                                // Replace the <textarea id="purpose"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'purpose' );
                            </script>
                        </div>
                    </div>
                    <!-- Requirements -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="closing_date">Requirements</label>
                        </div>
                        <div class="input-container">
                            <textarea name="requirements" rows="6" id="requirements" class="form-control form-control-lg <?php echo (!empty($data["err_mssg"]['requirements_err'])) ? 'is-invalid' : ''; ?>" >
                                <?php echo $data['requirements']; ?>
                            </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'requirements' );
                            </script>
                            <span class="invalid-feedback"><?php echo $data["err_mssg"]['requirements_err']; ?></span>
                        </div>
                    </div>
                    <!-- Skills -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="closing_date">Skills &amp; Competencies (Optional)</label>
                        </div>
                        <div class="input-container">
                            <textarea name="skills_competencies" rows="6" id="skills_competencies" class="form-control"><?php echo $data['skills_competencies']; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'skills_competencies' );
                            </script>
                        </div>
                    </div>
                    <!-- Responsibilities -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="closing_date">Responsibilities</label>
                        </div>
                        <div class="input-container">
                            <textarea name="responsibilities" rows="6" id="responsibilities" class="form-control form-control-lg <?php echo (!empty($data["err_mssg"]['responsibilities_err'])) ? 'is-invalid' : ''; ?>" ><?php echo $data['responsibilities']; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'responsibilities' );
                            </script>
                            <span class="invalid-feedback"><?php echo $data["err_mssg"]['responsibilities_err']; ?></span>
                        </div>
                    </div>
                    <!-- Form -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="enquiries">Application Form</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="enquiries" id="enquiries" class="form-control form-control-lg" value="<?php echo $data['enquiries']; ?>">
                        </div>
                    </div>
                    <!-- For attention -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="for_attention">For Attention</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="for_attention" id="for-attention" class="form-control form-control-lg" value="<?php echo $data['for_attention']; ?>">
                        </div>
                    </div>
                    <!-- Form -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="form">Application Form</label>
                        </div>
                        <div class="input-container">
                            <input type="url" name="form" id="form" class="form-control form-control-lg" value="<?php echo $data['form']; ?>">
                        </div>
                    </div>
                    <!-- Full Vacancy -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="full_vacancy">Download Full Vacancy</label>
                        </div>
                        <div class="input-container">
                            <input type="url" name="full_vacancy" id="full_vacancy" class="form-control form-control-lg" value="<?php echo $data['full_vacancy']; ?>">
                        </div>
                    </div>
                    <!-- Additional Info -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="closing_date">Additional Information</label>
                        </div>
                        <div class="input-container">
                            <textarea name="additional_info" rows="6" id="additional_info" class="form-control"><?php echo $data['additional_info']; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'additional_info' );
                            </script>
                        </div>
                    </div>
                    <!-- Screenshot -->
                    <div class="custom-file mt-3 mb-3">
                        <input type="file" name="image" class="custom-file-input <?php echo (!empty($data['image_name_err'])) ? 'is-invalid' : ''; ?>" id="image" value="<?php echo (!empty($data['image'])) ? $data['image'] : ''; ?>">
                        <label class="custom-file-label" for="validatedCustomFile">Faka i-screenshot... (optional)</label>
                        <span class="invalid-feedback"><?php echo $data['image_name_err']; ?></span>
                    </div>
                    <!-- Application Method -->
                    <div class="input-label__container mb-2">
                        <div class="label-container">
                            <label for="closing_date">Ku Aplaywa Njani</label>
                        </div>
                        <div>
                            <input type="radio" name="application_mode" id="email" <?php echo (!empty($data['apply_nge_email'])) ? 'checked' : ''; ?>> <label for="email">Email</label>
                            <input type="radio" name="application_mode" id="hand" <?php echo (!empty($data['apply_ngesandla'])) ? 'checked' : ''; ?>> <label for="hand">Hand</label>
                            <input type="radio" name="application_mode" id="web" <?php echo (!empty($data['apply_nge_website'])) ? 'checked' : ''; ?>> <label for="web">Web</label>
                        </div>
                        <div class="row show-input">
                            <div class="col">
                                <div class="collapse" id="ngesandla">
                                    <div class="input-container mb-3" id="application_option">
                                        <textarea id="apply_ngesandla" name="ngesandla" rows="6" class="form-control"><?php echo $data['apply_ngesandla']; ?></textarea>
                                        <script>
                                            // Replace the <textarea id="editor1"> with a CKEditor
                                            // instance, using default configuration.
                                            CKEDITOR.replace( 'apply_ngesandla' );
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="collapse" id="email_address">
                                    <div class="input-container ">
                                        <input type="email" name="email" class="form-control" value="<?php echo $data['apply_nge_email']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="collapse" id="website">
                                    <div class="input-container ">
                                        <input type="url" name="website" class="form-control" value="<?php echo $data['apply_nge_website']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="input-label__container">
                        <div class="input-container ">
                            <button class="form-btn__primary btn-block">Cofa xa Ugqibile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>