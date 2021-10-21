<div class="container">
    <div class="row">
        <div class="bhalisa-ngena__form white-background-border col-md-6">
            <?php if ($_GET['url'] != "addJobs/add") : ?>
            <h1 class="page-container">Edit</h1>
            <h3><?php echo $data['job_title']; ?></h3>
            <p><?php echo $data['job_employer']; ?> - <?php echo $data['job_location']; ?>, <?php echo $data['province']; ?></p>
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
                            <input type="text" name="job_title" class="form-control form-control-lg <?php echo (!empty($data['job_title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['job_title']; ?>" autofocus>
                            <span class="invalid-feedback"><?php echo $data['job_title_err']; ?></span>
                        </div>
                    </div>
                    <!-- No. of posts -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_num_posts">No. of Posts</label>
                        </div>
                        <div class="input-container">
                            <input type="number" name="job_num_posts" class="form-control form-control-lg <?php echo (!empty($data['job_num_posts_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['job_num_posts']; ?>">
                            <span class="invalid-feedback"><?php echo $data['job_num_posts_err']; ?></span>
                        </div>
                    </div>
                    <!-- Employer -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_employer">Employer Name</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_employer" id="igama-le-company" class="form-control form-control-lg <?php echo (!empty($data['job_employer_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['job_employer']; ?>" >
                            <span class="invalid-feedback"><?php echo $data['job_employer_err']; ?></span>
                        </div>
                    </div>
                    <!-- Employer type -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_drivers_license">Employer Type</label>
                        </div>
                        <div class="input-container">
                            <select name="job_employer_type" class="form-control form-control-lg <?php echo (!empty($data['job_employer_type_err'])) ? 'is-invalid' : ''; ?>" id="job_employer_type">
                                <option class="form-control" value="<?php echo empty($data['job_employer_type']) ? 'Select' : $data['job_employer_type']; ?>"><?php echo empty($data['job_employer_type']) ? 'Select' : $data['job_employer_type']; ?></option>
                                <option class="form-control" value="Company">Company</option>
                                <option class="form-control" value="Government">Government</option>
                                <option class="form-control" value="Municipality">Municipality</option>
                                <option class="form-control" value="NGO">NGO</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data['job_employer_type_err']; ?></span>
                        </div>
                    </div>
                    <!-- Province -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Province">Province</label>
                        </div>
                        <div class="input-container">
                            <select name="job_province" class="form-control form-control-lg <?php echo (!empty($data['job_province_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['job_province']) ? 'Select' : $data['job_province']; ?>"><?php echo empty($data['job_province']) ? 'Select' : $data['job_province']; ?></option>
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
                            <span class="invalid-feedback"><?php echo $data['job_province_err']; ?></span>
                        </div>
                    </div>
                    <!-- Location -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_location">Job Location</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_location" id="job_location" class="form-control form-control-lg <?php echo (!empty($data['job_location_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['job_location']; ?>" >
                            <span class="invalid-feedback"><?php echo $data['job_location_err']; ?></span>
                        </div>
                    </div>
                    <!-- Job type -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Msebenzi Onjani">Job Type</label>
                        </div>
                        <div class="input-container">
                            <select name="job_type" class="form-control form-control-lg <?php echo (!empty($data['job_type_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['job_type']) ? 'Select' : $data['job_type']; ?>"><?php echo empty($data['job_type']) ? 'Select' : $data['job_type']; ?></option>
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
                            <span class="invalid-feedback"><?php echo $data['job_type_err']; ?></span>
                        </div>
                    </div>
                    <!-- Job type -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_duration">Duration</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_duration" id="job_duration" class="form-control form-control-lg <?php echo (!empty($data['job_duration_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['job_duration']; ?>">
                            <span class="invalid-feedback"><?php echo $data['job_duration_err']; ?></span>
                        </div>
                    </div>
                    <!-- Education -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Msebenzi Onjani">Education Level</label>
                        </div>
                        <div class="input-container">
                            <select name="job_education" class="form-control form-control-lg <?php echo (!empty($data['job_education_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['job_education']) ? 'Select' : $data['job_education']; ?>"><?php echo empty($data['job_education']) ? 'Select' : $data['job_education']; ?></option>
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
                            <span class="invalid-feedback"><?php echo $data["job_education_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Experience -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Msebenzi Onjani">Job Experience</label>
                        </div>
                        <div class="input-container">
                            <select name="experience" class="form-control form-control-lg <?php echo (!empty($data["job_experience_err"])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['job_experience']) ? 'Select' : $data['job_experience']; ?>"><?php echo empty($data['job_experience']) ? 'Select' : $data['job_experience']; ?></option>
                                <option class="form-control" value="0 years">0 years</option>
                                <option class="form-control" value="1 - 2 years">1 - 2 years</option>
                                <option class="form-control" value="3 - 5 years">3 - 5 years</option>
                                <option class="form-control" value="6 - 9 years">6 - 9 years</option>
                                <option class="form-control" value="10 - 14 years">10 - 14 years</option>
                                <option class="form-control" value="15+ years">15+ years</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data["job_experience_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Category -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="Ngowantoni">Job Category</label>
                        </div>
                        <div class="input-container">
                            <select name="category" class="form-control form-control-lg <?php echo (!empty($data['job_category_err'])) ? 'is-invalid' : ''; ?>" id="">
                                <option class="form-control" value="<?php echo empty($data['job_category']) ? 'Select' : $data['job_category']; ?>"><?php echo empty($data['job_category']) ? 'Select' : $data['job_category']; ?></option>
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
                            <span class="invalid-feedback"><?php echo $data['job_category_err']; ?></span>
                        </div>
                    </div>
                    <!-- Ref No. -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_ref_no">Ref No.</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_ref_no" id="ref-no" class="form-control form-control-lg" value="<?php echo $data["job_ref_no"]; ?>">
                        </div>
                    </div>
                    <!-- Centre -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_centre">Centre</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_centre" id="job_centre" class="form-control form-control-lg" value="<?php echo $data["job_centre"]; ?>">
                        </div>
                    </div>
                    <!-- Salary, stipend & benefits -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_remuneration">Remuneration</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_remuneration" id="job_remuneration" class="form-control form-control-lg" value="<?php echo $data["job_remuneration"]; ?>">
                        </div>
                    </div>
                    <!-- Driver's job_drivers_license -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_drivers_license">Driver's License Required?</label>
                        </div>
                        <div class="input-container">
                            <select name="job_drivers_license" class="form-control form-control-lg <?php echo (!empty($data['job_drivers_license_err'])) ? 'is-invalid' : ''; ?>" id="job_drivers_license">
                                <option class="form-control" value="<?php echo empty($data['job_drivers_license']) ? 'Select' : $data['job_drivers_license']; ?>"><?php echo empty($data['job_drivers_license']) ? 'Select' : $data['job_drivers_license']; ?></option>
                                <option class="form-control" value="Yes">Yes</option>
                                <option class="form-control" value="No">No</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data["job_drivers_license_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Afrikaans -->
                    <div class="input-label__container">
                        <div class=label-container">
                            <label for="job_afrikaans_required">Afrikaans Required?</label>
                        </div>
                        <div class="input-container">
                            <select name="job_afrikaans_required" class="form-control form-control-lg <?php echo (!empty($data['job_afrikaans_required_err'])) ? 'is-invalid' : ''; ?>" id="job_afrikaans_required">
                                <option class="form-control" value="<?php echo empty($data["job_afrikaans_required"]) ? 'Select' : $data["job_afrikaans_required"]; ?>"><?php echo empty($data["job_afrikaans_required"]) ? 'Select' : $data["job_afrikaans_required"]; ?></option>
                                <option class="form-control" value="Yes">Yes</option>
                                <option class="form-control" value="No">No</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data["job_afrikaans_required_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Facebook -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_facebook_post">Facebook Post?</label>
                        </div>
                        <div class="input-container">
                            <select name="job_facebook_post" class="form-control form-control-lg <?php echo (!empty($data['job_facebook_post_err'])) ? 'is-invalid' : ''; ?>" id="job_facebook_post">
                                <option class="form-control" value="<?php echo empty($data["job_facebook_post"]) ? 'Select' : $data["job_facebook_post"]; ?>"><?php echo empty($data["job_facebook_post"]) ? 'Select' : $data["job_facebook_post"]; ?></option>
                                <option class="form-control" value="Yes">Yes</option>
                                <option class="form-control" value="No">No</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data["job_facebook_post_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Closing date -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_closing_date">Closing date</label>
                        </div>
                        <div class="input-container">
                            <input type="date" name="job_closing_date" id="job_closing_date" class="form-control" data-date-format="DD MMMM YYYY" value="<?php echo $data["job_closing_date"]; ?>">
                        </div>
                    </div>
                    <!-- Purpose -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_purpose">Purpose (optional)</label>
                        </div>
                        <div class="input-container">
                            <textarea name="job_purpose" rows="6" id="job_purpose" class="form-control form-control-lg">
                            
                                <?php echo $data["job_purpose"]; ?>
                            </textarea>
                            <script>
                                // Replace the <textarea id="job_purpose"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( "job_purpose" );
                            </script>
                        </div>
                    </div>
                    <!-- Requirements -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="job_closing_date">Requirements</label>
                        </div>
                        <div class="input-container">
                            <textarea name="job_requirements" rows="6" id="job_requirements" class="form-control form-control-lg <?php echo (!empty($data['job_requirements_err'])) ? 'is-invalid' : ''; ?>" >
                                <?php echo $data["job_requirements"]; ?>
                            </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'job_requirements' );
                            </script>
                            <span class="invalid-feedback"><?php echo $data["job_requirements_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Skills -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="job_closing_date">Skills &amp; Competencies (Optional)</label>
                        </div>
                        <div class="input-container">
                            <textarea name="job_skills_competencies" rows="6" id="job_skills_competencies" class="form-control"><?php echo $data["job_skills_competencies"]; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( "job_skills_competencies" );
                            </script>
                        </div>
                    </div>
                    <!-- Responsibilities -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="job_closing_date">Responsibilities</label>
                        </div>
                        <div class="input-container">
                            <textarea name="job_responsibilities" rows="6" id="job_responsibilities" class="form-control form-control-lg <?php echo (!empty($data["job_responsibilities_err"])) ? 'is-invalid' : ''; ?>" ><?php echo $data["job_responsibilities"]; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'job_responsibilities' );
                            </script>
                            <span class="invalid-feedback"><?php echo $data["job_responsibilities_err"]; ?></span>
                        </div>
                    </div>
                    <!-- Enquiries -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_enquiries">Enquiries</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_enquiries" id="job_enquiries" class="form-control form-control-lg" value="<?php echo $data["job_enquiries"]; ?>">
                        </div>
                    </div>
                    <!-- For attention -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_for_attention">For Attention</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="job_for_attention" id="for-attention" class="form-control form-control-lg" value="<?php echo $data["job_for_attention"]; ?>">
                        </div>
                    </div>
                    <!-- Editable Form -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="editable-form">Application Form</label>
                        </div>
                        <div class="input-container">
                            <input type="url" name="job_editable_form" id="form" class="form-control form-control-lg" value="<?php echo $data["job_editable_form"]; ?>">
                        </div>
                    </div>
                    <!-- Non-editable Form -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="non-editable-form">Non-Editable Application Form</label>
                        </div>
                        <div class="input-container">
                            <input type="url" name="job_non_editable_form" id="non_editable_form" class="form-control form-control-lg" value="<?php echo $data['job_non_editable_form']; ?>">
                        </div>
                    </div>
                    <!-- Full Vacancy -->
                    <div class="input-label__container">
                        <div class="label-container">
                            <label for="job_full_vacancy">Download Full Vacancy</label>
                        </div>
                        <div class="input-container">
                            <input type="url" name="job_full_vacancy" id="job_full_vacancy" class="form-control form-control-lg" value="<?php echo $data["job_full_vacancy"]; ?>">
                        </div>
                    </div>
                    <!-- Additional Info -->
                    <div class="input-label__container mt-3">
                        <div class="label-container">
                            <label for="job_additional_info">Additional Information</label>
                        </div>
                        <div class="input-container">
                            <textarea name="job_additional_info" rows="6" id="job_additional_info" class="form-control"><?php echo $data['job_additional_info']; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'job_additional_info' );
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
                    <div class="input-label__container mb-3" style="border:1px solid #dfdfdf;padding:15px">
                        <div class="label-container">
                            <label for="job_closing_date">Application Methods</label>
                        </div>
                        <!-- Email -->
                        <div class="input-label__container">
                            <div class="label-container">
                                <label for="form">Email</label>
                            </div>
                            <div class="input-container">
                            <input type="email" name="job_email_application" class="form-control" value="<?php echo $data['job_email_application']; ?>">
                            </div>
                        </div>
                        <!-- Web -->
                        <div class="input-label__container">
                            <div class="label-container">
                                <label for="form">Web</label>
                            </div>
                            <div class="input-container">
                            <input type="url" name="job_web_application" class="form-control" value="<?php echo $data['job_web_application']; ?>">
                            </div>
                        </div>
                        <!-- Postal -->
                        <div class="input-label__container">
                            <div class="label-container">
                                <label for="postal">Postal</label>
                            </div>
                            <div class="input-container">
                                <textarea id="job_postal_application" name="job_postal_application" rows="3" class="form-control"><?php echo $data["job_postal_application"]; ?></textarea>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'job_postal_application' );
                                    </script>
                            </div>
                        </div>
                        <!-- Hand -->
                        <div class="input-label__container">
                            <div class="label-container">
                                <label for="form">Hand</label>
                            </div>
                            <div class="input-container">
                            <textarea id="job_hand_application" name="job_hand_application" rows="3" class="form-control form-control-lg"><?php echo $data['job_hand_application']; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'job_hand_application' );
                            </script>
                            </div>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="input-label__container">
                        <div class="input-container ">
                            <button class="form-btn__primary btn-block" type="submit">Cofa xa Ugqibile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>