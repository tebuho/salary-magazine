<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        //Sanitize POST array
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $umsebenzi = $this->postModel->getPostBySlug($id);
        $data = [
            'id' => $id,
            'job_id' => $umsebenzi->id,
            'job_employer' => filter_input(INPUT_POST, 'ijob_employer', FILTER_SANITIZE_STRING),
            'user_id' => $_SESSION['user_id'],
            'province' => filter_input(INPUT_POST, 'job_province', FILTER_SANITIZE_STRING),
            'province_slug' => '',
            'job_location' => trim(filter_input(INPUT_POST, 'job_location_pha', FILTER_SANITIZE_STRING)),
            'job_title' => trim(filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING)),
            'label' => filter_input(INPUT_POST, 'ijob_employer', FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, 'job_location_pha', FILTER_SANITIZE_STRING),
            'job_closing_date' => filter_input(INPUT_POST, 'job_closing_date', FILTER_SANITIZE_STRING),
            'job_type' => filter_input(INPUT_POST, 'job_type', FILTER_SANITIZE_STRING),
            'job_education' => filter_input(INPUT_POST, 'job_education', FILTER_SANITIZE_STRING),
            'experience' => filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING),
            'category' => filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING),
            'job_requirements' => trim($_POST['job_requirements']),
            'purpose' => trim($_POST['purpose']),
            'skills_competencies' => trim($_POST['skills_competencies']),
            'job_responsibilities' => trim($_POST['job_responsibilities']),
            'additional_info' => trim($_POST['additional_info']),
            'apply_nge_website' => filter_input(INPUT_POST, 'website', FILTER_SANITIZE_STRING),
            'job_hand_application' => trim($_POST['ngesandla']),
            'apply_nge_email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING),
            'image_name' => strip_tags(trim($_FILES['image']['name'])),
            'image_size' => trim($_FILES['image']['size']),
            'image_type' => trim($_FILES['image']['type']),
            'tmp_name' => trim($_FILES['image']['tmp_name']),
            'dir' => '/home/salarfng/public_html/public/img/imisebenzi/',
            'page_image' . '/public/img/western-cape-jobs/westernCapeJobs.png',
            "job_employer_slug" => "",
            'page_description' => '',
            'page_type' => '',
            'page_title' => '',
            'pattern' => '/[^\pN\pL]+/u',
            'slug' => '',
            'job_location_slug' => '',
            'job_type_slug' => '',
            'experience_slug' => '',
            'job_education_slug' => '',
            'job_category_slug' => '',
            'job_employer_err' => '',
            'province_err' => '',
            'job_location_err' => '',
            'job_title_err' => '',
            'job_type_err' => '',
            'job_education_err' => '',
            'experience_err' => '',
            'job_category_err' => '',
            'job_requirements_err' => '',
            'job_responsibilities_err' => '',
            'job_web_application_err' => '',
            'job_hand_application_err' => '',
            'job_email_application_err' => '',
            'image_type_err' => '',
            'image_size_err' => '',
            'duplicate_job_err' => '',
            'jb_specification' => ''
        ];
            
        if ($data['job_closing_date'] === "") {
            $data['job_closing_date'] = "1970-01-01";
        }
        
        if ($data['job_employer'] == "Premier Foods") {
            $data['job_employer'] = "Premier";
        }
        
        //Validate data
        if (empty($data['job_employer'])) {
            $data['job_employer_err'] = 'Kufuneka ufake igama le company.';
        }if ($data['job_employer'] === "Pioneer") {
            $data['job_employer'] = "Pioneer Foods";
        }
        if ($data['province'] == 'Select') {
            $data['province_err'] = 'Kufuneka ukhethe i-province';
        }
        if (empty($data['job_location'])) {
            $data['job_location_err'] = 'Ndawoni pha?';
        }
        if ($data['job_location'] == "Roodepoort") {
            $data['job_location'] = "Roodepoort, Johannesburg";
        }
        if (empty($data['job_title'])) {
            $data['job_title_err'] = 'Job title ithini';
        }
        if ($data['job_type'] == 'Select') {
            $data['job_type_err'] = 'Ngumsebenzi onjani lo?';
        }
        if ($data['job_education'] == 'Select') {
            $dta['job_education_err'] = 'Level yejob_education ithini';
        }
        if ($data['experience'] == 'Select') {
            $data['experience_err'] = 'Experienceefunwayo ingakanani?';
        }
        if ($data['category'] == 'Select') {
            $data['job_category_err'] = 'Ngumsebenzi wantoni lo?';
        }
        if (empty($data['job_requirements'])) {
            $data['job_requirements_err'] = 'Requirements zithini?';
        }
        if (empty($data['job_responsibilities']))  {
            $data['job_responsibilities_err'] = 'Responsibilities zithini?';
        }
        if (isset($data['apply_nge_website']) && empty($data['apply_nge_website'])) {
            $data['job_web_application_err'] = 'Sicela i-link';
        }
        if (isset($data['job_hand_application']) && empty($data['job_hand_application'])) {
            $data['job_hand_application_err'] = 'Sicela i-address';
        }
        if (isset($data['apply_nge_email']) && empty($data['apply_nge_email'])) {
            $data['job_email_application_err'] = 'Sicela i-email';
        }

        //Create employer slug
        $data["job_employer_slug"] = strtolower(preg_replace($data['pattern'], '-', $data['job_employer']));
        
        //Create slug for filtering by job_location/job_location
        $data['job_location_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['job_location']));
        
        //Create slug for filtering by job_education
        $data['job_education_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['job_education']));
        
        //Create slug for filtering by experience
        $data['experience_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['experience']));
        
        //Create slug for filtering by msebenzi onjani
        $data['job_type_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['job_type']));
        
        //Create slug for filtering by category
        $data['job_category_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['category']));
        
        //Create province slug
        switch ($data['province']) {
            case "Eastern Cape":
                $data['province_slug'] = "easternCapeJobs";
                break;
            case "Free State":
                $data['province_slug'] = "freeStateJobs";
                break;
            case "Gauteng":
                $data['province_slug'] = "gautengJobs";
                break;
            case "KwaZulu-Natal":
                $data['province_slug'] = "kwaZuluNatalJobs";
                break;
            case "Limpopo":
                $data['province_slug'] = "limpopoJobs";
                break;
            case "Mpumalanga":
                $data['province_slug'] = "mpumalangaJobs";
                break;
            case "North West":
                $data['province_slug'] = "northWestJobs";
                break;
            case "Northern Cape":
                $data['province_slug'] = "northernCapeJobs";
                break;
            case "Western Cape":
                $data['province_slug'] = "westernCapeJobs";
                break;
            case "Nationwide":
                $data['province_slug'] = "nationwide";
        }

        //Create temp slug
        $data['slug'] = createSlug($data['job_employer'] . '-' . $data['job_title'] . '-' . $data['job_location'] . '-' . $data['province_slug']);
        $results = $this->postModel->checkSlug($data);
        
        //Check if temp slug exists
        if ($results[0]->count > 0) {  
            $data['slug'] = $data['slug'] . '-' . $results[0]->count;
        }
        // die(var_dump($data['slug']));

        //Delete image if already in folder
        if (!empty($data['image_name'])) {
            $data['image_name'] = explode(".", $data['image_name']);

            $data['image_name'] = $data['slug'] . '-' . time() . "." . $data['image_name'][1];
            
            $img_dir = URLROOT . "/img/imisebenzi/" . $data['image_name'];
            
            //Validate image type
            if ($data['image_type'] != "image/jpg" || $data['image_type'] != "image/png") {
                $data['image_type_err'] = "Type ye image yakho kufuneka ibe yi jpg or png";
            }
            
            //Validate image size
            if ($data['image_size'] > 2000000) {
                $data['image_size_err'] = "Image yakho akufunekanga ibengaphezulu ko 2 MB";
            }
            
            //Move temp image
            move_uploaded_file($data['tmp_name'], $data['dir'] . $data['image_name']);
        } else {
            
            $data['image_name'] = $umsebenzi->image;
        }
        $jb_link = URLROOT . "/" . $data['province_slug'] . "/umsebenzi/" . $data['slug'];

        //Make sure there no errors
        if (empty($data['job_employer_err']) && empty($data['province_err']) && empty($data['job_location_err']) && empty($data['job_title_err']) && empty($data['job_type_err']) && empty($dta['job_education_err']) && empty($data['experience_err']) && empty($data['job_category_err']) && empty($data['job_requirements_err']) && empty($data['job_responsibilities_err']) && empty($data['application_mode_err'])) {
            
            //Validated
            if ($this->postModel->updateJob($data)) {
                $update_msg = "Umsebenzi wakho ulungisekile";
                flash('message_yomsebenzi', $update_msg);
                redirect($data['province_slug'] . "/umsebenzi/" . $data['slug']);
            } else {
                die('Ikhona into erongo');
            }
            } else {
                //Load the view with errors

                $data = [
                    'page_description' => 'Wulungise apha umsebenzi wakho.',
                    'page_type' => 'website',
                    'page_url' => URLROOT . "/" . $_GET['url'],
                    'page_title' => 'Edit ' . $umsebenzi->label,
                    'page_image' => $umsebenzi->image,
                    'job_employer' => $umsebenzi->job_employer,
                    'province' => $umsebenzi->province,
                    'job_location' => $umsebenzi->job_location,
                    'job_title' => $umsebenzi->job_title,
                    'label' => $umsebenzi->label,
                    'job_closing_date' => $umsebenzi->job_closing_date,
                    'job_type' => $umsebenzi->job_type,
                    'job_education' => $umsebenzi->job_education,
                    'experience' => $umsebenzi->experience,
                    'category' => $umsebenzi->job_category,
                    'purpose' => $umsebenzi->purpose,
                    'job_requirements' => $umsebenzi->job_requirements,
                    'skills_competencies' => $umsebenzi->skills_competencies,
                    'job_responsibilities' => $umsebenzi->job_responsibilities,
                    'additional_info' => $umsebenzi->additional_info,
                    'jb_specification' => $umsebenzi->jb_specification,
                    'apply_nge_website' => $umsebenzi->apply_nge_website, 
                    'job_hand_application' => $umsebenzi->job_hand_application,
                    'apply_nge_email' => $umsebenzi->apply_nge_email,
                    'image' => $umsebenzi->image,
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                
                $this->view('addJobs/edit', $data);
            }
    } else {

        $umsebenzi = $this->postModel->getPostBySlug($id);

        //Check if ufakwe nguye lomsebenzi lomntu
        if ($umsebenzi->user_id != $_SESSION['user_id'] && $_SESSION['role'] != "Admin") {
            redirect($this->province_slug . "/");
        }

        //Update umsebenzi
        $data = [
            'page_description' => 'Wulungise apha umsebenzi wakho.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Edit ' . $umsebenzi->label,
            'page_image' => $umsebenzi->image,
            'job_employer' => $umsebenzi->job_employer,
            'province' => $umsebenzi->province,
            'job_location' => $umsebenzi->job_location,
            'job_title' => $umsebenzi->job_title,
            'label' => $umsebenzi->label,
            'job_closing_date' => $umsebenzi->job_closing_date,
            'job_type' => $umsebenzi->job_type,
            'job_education' => $umsebenzi->job_education,
            'experience' => $umsebenzi->experience,
            'category' => $umsebenzi->job_category,
            'purpose' => $umsebenzi->purpose,
            'job_requirements' => $umsebenzi->job_requirements,
            'skills_competencies' => $umsebenzi->skills_competencies,
            'job_responsibilities' => $umsebenzi->job_responsibilities,
            'additional_info' => $umsebenzi->additional_info,
            'jb_specification' => $umsebenzi->jb_specification,
            'apply_nge_website' => $umsebenzi->apply_nge_website, 
            'job_hand_application' => $umsebenzi->job_hand_application,
            'apply_nge_email' => $umsebenzi->apply_nge_email,
            'image' => $umsebenzi->image,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        
        $this->view('addJobs/edit', $data);
    }

?>