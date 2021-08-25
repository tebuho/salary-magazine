<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        //Sanitize POST array
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $umsebenzi = $this->postModel->getPostBySlug($id);
        $data = [
            'id' => $id,
            'job_id' => $umsebenzi->id,
            'gama_le_company' => filter_input(INPUT_POST, 'igama_le_company', FILTER_SANITIZE_STRING),
            'id_yomntu' => $_SESSION['id_yomntu'],
            'province' => filter_input(INPUT_POST, 'job_province', FILTER_SANITIZE_STRING),
            'province_slug' => '',
            'ndawoni' => trim(filter_input(INPUT_POST, 'ndawoni_pha', FILTER_SANITIZE_STRING)),
            'job_title' => trim(filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING)),
            'label' => filter_input(INPUT_POST, 'igama_le_company', FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, 'ndawoni_pha', FILTER_SANITIZE_STRING),
            'closing_date' => filter_input(INPUT_POST, 'closing_date', FILTER_SANITIZE_STRING),
            'msebenzi_onjani' => filter_input(INPUT_POST, 'msebenzi_onjani', FILTER_SANITIZE_STRING),
            'mfundo' => filter_input(INPUT_POST, 'mfundo', FILTER_SANITIZE_STRING),
            'experience' => filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING),
            'ngowantoni' => filter_input(INPUT_POST, 'ngowantoni', FILTER_SANITIZE_STRING),
            'requirements' => trim($_POST['requirements']),
            'purpose' => trim($_POST['purpose']),
            'skills_competencies' => trim($_POST['skills_competencies']),
            'responsibilities' => trim($_POST['responsibilities']),
            'additional_info' => trim($_POST['additional_info']),
            'apply_nge_website' => filter_input(INPUT_POST, 'website', FILTER_SANITIZE_STRING),
            'apply_ngesandla' => trim($_POST['ngesandla']),
            'apply_nge_email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING),
            'image_name' => strip_tags(trim($_FILES['image']['name'])),
            'image_size' => trim($_FILES['image']['size']),
            'image_type' => trim($_FILES['image']['type']),
            'tmp_name' => trim($_FILES['image']['tmp_name']),
            'dir' => '/home/salarfng/public_html/public/img/imisebenzi/',
            'page_image' . '/public/img/western-cape-jobs/westernCapeJobs.png',
            "employer_slug" => "",
            'page_description' => '',
            'page_type' => '',
            'page_title' => '',
            'pattern' => '/[^\pN\pL]+/u',
            'slug' => '',
            'ndawoni_slug' => '',
            'onjani_slug' => '',
            'experience_slug' => '',
            'mfundo_slug' => '',
            'ngowantoni_slug' => '',
            'gama_le_company_err' => '',
            'province_err' => '',
            'ndawoni_pha_err' => '',
            'job_title_err' => '',
            'msebenzi_onjani_err' => '',
            'mfundo_err' => '',
            'experience_err' => '',
            'ngowantoni_err' => '',
            'requirements_err' => '',
            'responsibilities_err' => '',
            'apply_nge_website_err' => '',
            'apply_ngesandla_err' => '',
            'apply_nge_email_err' => '',
            'image_type_err' => '',
            'image_size_err' => '',
            'duplicate_job_err' => '',
            'jb_specification' => ''
        ];
            
        if ($data['closing_date'] === "") {
            $data['closing_date'] = "0000-00-00";
        }
        
        if ($data['gama_le_company'] == "Premier Foods") {
            $data['gama_le_company'] = "Premier";
        }
        
        //Validate data
        if (empty($data['gama_le_company'])) {
            $data['gama_le_company_err'] = 'Kufuneka ufake igama le company.';
        }if ($data['gama_le_company'] === "Pioneer") {
            $data['gama_le_company'] = "Pioneer Foods";
        }
        if ($data['province'] == 'Khetha') {
            $data['province_err'] = 'Kufuneka ukhethe i-province';
        }
        if (empty($data['ndawoni'])) {
            $data['ndawoni_pha_err'] = 'Ndawoni pha?';
        }
        if ($data['ndawoni'] == "Roodepoort") {
            $data['ndawoni'] = "Roodepoort, Johannesburg";
        }
        if (empty($data['job_title'])) {
            $data['job_title_err'] = 'Job title ithini';
        }
        if ($data['msebenzi_onjani'] == 'Khetha') {
            $data['msebenzi_onjani_err'] = 'Ngumsebenzi onjani lo?';
        }
        if ($data['mfundo'] == 'Khetha') {
            $dta['mfundo_err'] = 'Level yemfundo ithini';
        }
        if ($data['experience'] == 'Khetha') {
            $data['experience_err'] = 'Experienceefunwayo ingakanani?';
        }
        if ($data['ngowantoni'] == 'Khetha') {
            $data['ngowantoni_err'] = 'Ngumsebenzi wantoni lo?';
        }
        if (empty($data['requirements'])) {
            $data['requirements_err'] = 'Requirements zithini?';
        }
        if (empty($data['responsibilities']))  {
            $data['responsibilities_err'] = 'Responsibilities zithini?';
        }
        if (isset($data['apply_nge_website']) && empty($data['apply_nge_website'])) {
            $data['apply_nge_website_err'] = 'Sicela i-link';
        }
        if (isset($data['apply_ngesandla']) && empty($data['apply_ngesandla'])) {
            $data['apply_ngesandla_err'] = 'Sicela i-address';
        }
        if (isset($data['apply_nge_email']) && empty($data['apply_nge_email'])) {
            $data['apply_nge_email_err'] = 'Sicela i-email';
        }

        //Create employer slug
        $data["employer_slug"] = strtolower(preg_replace($data['pattern'], '-', $data['gama_le_company']));
        
        //Create slug for filtering by location/ndawoni
        $data['ndawoni_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['ndawoni']));
        
        //Create slug for filtering by mfundo
        $data['mfundo_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['mfundo']));
        
        //Create slug for filtering by experience
        $data['experience_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['experience']));
        
        //Create slug for filtering by msebenzi onjani
        $data['onjani_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['msebenzi_onjani']));
        
        //Create slug for filtering by ngowantoni
        $data['ngowantoni_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['ngowantoni']));
        
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
        $data['slug'] = createSlug($data['gama_le_company'] . '-' . $data['job_title'] . '-' . $data['ndawoni'] . '-' . $data['province_slug']);
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
        if (empty($data['gama_le_company_err']) && empty($data['province_err']) && empty($data['ndawoni_pha_err']) && empty($data['job_title_err']) && empty($data['msebenzi_onjani_err']) && empty($dta['mfundo_err']) && empty($data['experience_err']) && empty($data['ngowantoni_err']) && empty($data['requirements_err']) && empty($data['responsibilities_err']) && empty($data['application_mode_err'])) {
            
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
                    'gama_le_company' => $umsebenzi->gama_le_company,
                    'province' => $umsebenzi->province,
                    'ndawoni' => $umsebenzi->ndawoni,
                    'job_title' => $umsebenzi->job_title,
                    'label' => $umsebenzi->label,
                    'closing_date' => $umsebenzi->closing_date,
                    'msebenzi_onjani' => $umsebenzi->msebenzi_onjani,
                    'mfundo' => $umsebenzi->mfundo,
                    'experience' => $umsebenzi->experience,
                    'ngowantoni' => $umsebenzi->ngowantoni,
                    'purpose' => $umsebenzi->purpose,
                    'requirements' => $umsebenzi->requirements,
                    'skills_competencies' => $umsebenzi->skills_competencies,
                    'responsibilities' => $umsebenzi->responsibilities,
                    'additional_info' => $umsebenzi->additional_info,
                    'jb_specification' => $umsebenzi->jb_specification,
                    'apply_nge_website' => $umsebenzi->apply_nge_website, 
                    'apply_ngesandla' => $umsebenzi->apply_ngesandla,
                    'apply_nge_email' => $umsebenzi->apply_nge_email,
                    'image' => $umsebenzi->image,
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                
                $this->view('addJobs/edit', $data);
            }
    } else {

        $umsebenzi = $this->postModel->getPostBySlug($id);

        //Check if ufakwe nguye lomsebenzi lomntu
        if ($umsebenzi->id_yomntu != $_SESSION['id_yomntu'] && $_SESSION['role'] != "Admin") {
            redirect($this->province_slug . "/");
        }

        //Update umsebenzi
        $data = [
            'page_description' => 'Wulungise apha umsebenzi wakho.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Edit ' . $umsebenzi->label,
            'page_image' => $umsebenzi->image,
            'gama_le_company' => $umsebenzi->gama_le_company,
            'province' => $umsebenzi->province,
            'ndawoni' => $umsebenzi->ndawoni,
            'job_title' => $umsebenzi->job_title,
            'label' => $umsebenzi->label,
            'closing_date' => $umsebenzi->closing_date,
            'msebenzi_onjani' => $umsebenzi->msebenzi_onjani,
            'mfundo' => $umsebenzi->mfundo,
            'experience' => $umsebenzi->experience,
            'ngowantoni' => $umsebenzi->ngowantoni,
            'purpose' => $umsebenzi->purpose,
            'requirements' => $umsebenzi->requirements,
            'skills_competencies' => $umsebenzi->skills_competencies,
            'responsibilities' => $umsebenzi->responsibilities,
            'additional_info' => $umsebenzi->additional_info,
            'jb_specification' => $umsebenzi->jb_specification,
            'apply_nge_website' => $umsebenzi->apply_nge_website, 
            'apply_ngesandla' => $umsebenzi->apply_ngesandla,
            'apply_nge_email' => $umsebenzi->apply_nge_email,
            'image' => $umsebenzi->image,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        
        $this->view('addJobs/edit', $data);
    }

?>