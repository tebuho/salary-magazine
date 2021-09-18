<?php

class Jobs extends Controller
{
    public $province_slug;
    public function __construct()
    {
        $this->postModel = $this->model('easternCapeJob');
        $this->userModel = $this->model('Umntu');

        $this->province_slug = new Provinces;
    }

    /********************************************************************
     *                                                                  *
     *                  Get all jobs and paginate                       *
     *                                                                  *
     ********************************************************************/
    public function index($page = 0)
    {
        //Get imisebenzi
        $imisebenzi = $this->postModel->getImisebenzi();
        $ndawoni = $this->postModel->filterImisebenziByLocation();
        $ngowantoni = $this->postModel->filterImisebenziByType();
        $experience = $this->postModel->filterImisebenziByExperience();
        $onjani = $this->postModel->filterImisebenziByOnjani();
        $mfundo = $this->postModel->filterImisebenziByMfundo();
        $provinces = $this->postModel->getProvinces();
        
        $range = 2;
        if (isset($_GET['url'])) {
            $page = $page;
        } else {
            $page = 1;
        }
       
        $data = [
            'results_per_page' => 12,
            'start' => '',
            'total_pages' => '',
            'page' => $page,
            'initial_num' => $page - $range,
            'condition_limit_num' => ($page + 1)  + 1,
            'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi[0]->image,
            'page_description' => 'If ukhangela imisebenzi ese Eastern Cape ungayijonga apha.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Imisebenzi ese Eastern Cape',
            'ndawoni' => $ndawoni,
            'ngowantoni' => $ngowantoni,
            'experience' => $experience,
            'mfundo' => $mfundo,
            'onjani' => $onjani,
            'imisebenzi' => $imisebenzi,
            'provinces' => $provinces
        ];
        
        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }
        
        $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
        
        //Get imisebenzi with limit and offset
        $imisebenzi = $this->postModel->paginateImisebenzi($data);
        $data['imisebenzi'] = $imisebenzi;
        
        $this->view('jobs/index', $data);
    }

    /********************************************************************
     *                                                                  *
     *                  Filter jobs by location                         *
     *                                                                  *
     ********************************************************************/
    public function ndawoni($location, $page = 0)
    {
        //Get imisebenzi
        $imisebenzi = $this->postModel->getImisebenziByLocation($location);
        $ndawoni = $this->postModel->filterImisebenziByLocation();
        $ngowantoni = $this->postModel->filterImisebenziByType();
        $experience = $this->postModel->filterImisebenziByExperience();
        $onjani = $this->postModel->filterImisebenziByOnjani();
        $mfundo = $this->postModel->filterImisebenziByMfundo();
        $provinces = $this->postModel->getProvinces();
        
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 0;
       }
       
       //Get location for title tag
       foreach ($imisebenzi as $ndawo) {
           $location = $ndawo->ndawoni;
       }
       
       //Get ndawoni slug
       foreach ($imisebenzi as $ndawo_slug) {
           $location_slug = $ndawo_slug->location_slug;
       }
        
        $range = 2;
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 1;
       }
       
        $data = [
            'results_per_page' => 12,
            'start' => '',
            'total_pages' => '',
            'page' => $page,
            'initial_num' => $page - $range,
            'condition_limit_num' => ($page + 1)  + 1,
            'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi[0]->image,
            'page_description' => 'If ukhangela imisebenzi ese ' . $location . ' ungayijonga apha.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Imisebenzi ese ' . $location . ", Eastern Cape",
            'ndawoni' => $ndawoni,
            'location_slug' => $location_slug,
            'ngowantoni' => $ngowantoni,
            'experience' => $experience,
            'mfundo' => $mfundo,
            'onjani' => $onjani,
            'area' => '',
            'imisebenzi' => $imisebenzi,
            'provinces' => $provinces
        ];
        
        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }
        
        foreach ($data['imisebenzi'] as $area) {
            $data['area'] = $area->ndawoni;
        }
        
        $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
        
        //Get imisebenzi with limit and offset
        $imisebenzi = $this->postModel->paginateImisebenziNgeNdawo($data);
        $data['imisebenzi'] = $imisebenzi;
        
        $this->view('easternCapeJobs/ndawoni', $data);
    }

    /********************************************************************
     *                                                                  *
     *                  Filter jobs by msebenzi onjani                  *
     *                                                                  *
     ********************************************************************/
    public function onjani($msebenzi_onjani, $page = 0)
    {
         
        //Get imisebenzi
        $ndawoni = $this->postModel->filterImisebenziByLocation();
        $ngowantoni = $this->postModel->filterImisebenziByType();
        $experience = $this->postModel->filterImisebenziByExperience();
        $mfundo = $this->postModel->filterImisebenziByMfundo();
        $onjani_umsebenzi = $this->postModel->getImisebenziByOnjani($msebenzi_onjani);
        $onjani = $this->postModel->filterImisebenziByOnjani();
        $provinces = $this->postModel->getProvinces();
        
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 0;
       }
       
       //Get job type for title tag
       foreach ($onjani_umsebenzi as $job_type) {
           $type = $job_type->msebenzi_onjani;
       }
       
        foreach($onjani_umsebenzi as $njani) {
            $msebenzi_onjani = $njani->job_type_slug;
        }
        
        $range = 2;
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 1;
       }
       
        $data = [
            'results_per_page' => 12,
            'start' => '',
            'total_pages' => '',
            'page' => $page,
            'initial_num' => $page - $range,
            'condition_limit_num' => ($page + 1)  + 1,
            'page_image' => URLROOT . '/img/imisebenzi/8003494d885b52be8d182940d4aeae13',
            'page_description' => 'If ukhangela imisebenzi ye ' .  $type . ' ungayijonga apha.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Imisebenzi ye ' .  $type,
            'ndawoni' => $ndawoni,
            'ngowantoni' => $ngowantoni,
            'experience' => $experience,
            'mfundo' => $mfundo,
            'onjani' => $onjani,
            'job_type_slug' => $msebenzi_onjani,
            'area' => '',
            'njani' => '',
            'imisebenzi' => $onjani_umsebenzi,
            'provinces' => $provinces
        ];
        
        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }
        
        foreach ($data['imisebenzi'] as $onjani) {
            $data['njani'] = $onjani->msebenzi_onjani;
        }
        
        $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
        
        //Get imisebenzi with limit and offset
        $onjani_umsebenzi = $this->postModel->paginateImisebenziNgoBunjani($data);
        $data['imisebenzi'] = $onjani_umsebenzi;
        
        $this->view('easternCapeJobs/onjani', $data);
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by mfundo                       *
     *                                                                  *
     ********************************************************************/
    public function mfundo($education, $page = 0)
    {
        //Get imisebenzi
        $onjani = $this->postModel->filterImisebenziByOnjani();
        $imisebenzi_mfundo = $this->postModel->getImisebenziByMfundo($education);
        $filter_mfundo = $this->postModel->filterImisebenziByMfundo();
        $mfundo = $this->postModel->filterImisebenziByMfundo();
        $ndawoni = $this->postModel->filterImisebenziByLocation();
        $ngowantoni = $this->postModel->filterImisebenziByType();
        $experience = $this->postModel->filterImisebenziByExperience();
        $provinces = $this->postModel->getProvinces();
        
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 0;
       }
       
       //Get education for title tag
       foreach ($imisebenzi_mfundo as $mfundo_type) {
           $education = $mfundo_type->mfundo;
       }
       
       //Get education slug
       foreach ($imisebenzi_mfundo as $job_education_slug) {
           $education_slug = $job_education_slug->job_education_slug;
       }
        
        $range = 2;
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 1;
       }
       
        $data = [
            'results_per_page' => 12,
            'start' => '',
            'total_pages' => '',
            'page' => $page,
            'initial_num' => $page - $range,
            'condition_limit_num' => ($page + 1)  + 1,
            'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi_mfundo[0]->image,
            'page_description' => 'If ukhangela imisebenzi efuna i-' . $education . ' ungayijonga apha.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => 'Imisebenzi efuna i-' . $education,
            'ndawoni' => $ndawoni,
            'ngowantoni' => $ngowantoni,
            'experience' => $experience,
            'imisebenzi' => $imisebenzi_mfundo,
            'mfundo_jobs_filtered' => $filter_mfundo,
            'mfundo' => $mfundo,
            'job_education_slug' => $education_slug,
            'ed' => '',
            'onjani' => $onjani,
            'provinces' => $provinces
        ];
        
        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }
        
        foreach ($data['imisebenzi'] as $imisebenzi) {
            $data['ed'] = $imisebenzi->mfundo;
        }
        
        $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
        
        //Get imisebenzi with limit and offset
        $imisebenzi = $this->postModel->paginateImisebenziNgeMfundo($data);
        $data['imisebenzi'] = $imisebenzi;
        
        $this->view('easternCapeJobs/mfundo', $data);
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by experience                       *
     *                                                                  *
     ********************************************************************/
    public function experience($exp, $page = 0)
    {
         
        
        //Get imisebenzi
        $onjani = $this->postModel->filterImisebenziByOnjani();
        $filter_mfundo = $this->postModel->filterImisebenziByMfundo();
        $mfundo = $this->postModel->filterImisebenziByMfundo();
        $ndawoni = $this->postModel->filterImisebenziByLocation();
        $ngowantoni = $this->postModel->filterImisebenziByType();
        $experiences = $this->postModel->filterImisebenziByExperience();
        $imisebenzi_experience = $this->postModel->getImisebenziByExperience($exp);
        $provinces = $this->postModel->getProvinces();
        
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 0;
       }
       
       //Get education for title tag
       foreach ($imisebenzi_experience as $experience_iminyaka) {
           if ($experience_iminyaka->experience == "0 years") {
               $experience_years = "Imisebenzi engadingi experiecne";
           } else {
               $experience_years = 'Imisebenzi ye ' . $experience_iminyaka->experience . '\' experience';
           }
       }
       
       //Get education slug
       foreach ($imisebenzi_experience as $experience_iminyaka) {
           $experience_slug = $experience_iminyaka->experience_slug;
       }
        
        $range = 2;
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 1;
       }
       
        $data = [
            'results_per_page' => 12,
            'start' => '',
            'total_pages' => '',
            'page' => $page,
            'initial_num' => $page - $range,
            'condition_limit_num' => ($page + 1)  + 1,
            'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi_experience[0]->image,
            'page_description' => 'If ukhangela imisebenzi ye ' . $experience_years . '\' experience Cape ungayijonga apha.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => $experience_years,
            'ndawoni' => $ndawoni,
            'ngowantoni' => $ngowantoni,
            'experience' => $experiences,
            'experience_slug' => $experience_slug,
            'imisebenzi' => $imisebenzi_experience,
            'mfundo_jobs_filtered' => $filter_mfundo,
            'mfundo' => $mfundo,
            'years' => '',
            'onjani' => $onjani,
            'provinces' => $provinces
        ];
        
        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }
        
        foreach ($data['imisebenzi'] as $umsebenzi) {
            $data['years'] = $umsebenzi->experience;
        }
        
        $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
        
        //Get imisebenzi with limit and offset
        $imisebenzi = $this->postModel->paginateImisebenziNgeExperience($data);
        $data['imisebenzi'] = $imisebenzi;
        
        $this->view('easternCapeJobs/experience', $data);
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by industry                       *
     *                                                                  *
     ********************************************************************/
    public function ngowantoni($type, $page = 0)
    {
         
        
        //Get imisebenzi
        $onjani = $this->postModel->filterImisebenziByOnjani();
        $filter_mfundo = $this->postModel->filterImisebenziByMfundo();
        $mfundo = $this->postModel->filterImisebenziByMfundo();
        $ndawoni = $this->postModel->filterImisebenziByLocation();
        $ngowantoni = $this->postModel->filterImisebenziByType();
        $experiences = $this->postModel->filterImisebenziByExperience();
        $imisebenzi_ngowantoni = $this->postModel->getImisebenziByType($type);
        $provinces = $this->postModel->getProvinces();
        
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 0;
       }
       
       //Get job function for title tag
       foreach ($imisebenzi_ngowantoni as $msebenzi_wantoni) {
           if ($msebenzi_wantoni->ngowantoni == "Government") {
               $function = "Imisebenzi yakwa government";
           } else {
             $function = "Imisebenzi ye " . $msebenzi_wantoni->ngowantoni;   
           }
       }
       
       //Get job function slug
       foreach ($imisebenzi_ngowantoni as $msebenzi_wantoni) {
           $function_slug = $msebenzi_wantoni->job_category_slug;
       }
        
        $range = 2;
       if (isset($_GET['url'])) {
           $page = $page;
       } else {
           $page = 1;
       }
       
        $data = [
            'results_per_page' => 12,
            'start' => '',
            'total_pages' => '',
            'page' => $page,
            'initial_num' => $page - $range,
            'condition_limit_num' => ($page + 1)  + 1,
            'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi_ngowantoni[0]->image,
            'page_description' => 'If ukhangela imisebenzi ye ' . $function . ' ungayijonga apha.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => $function,
            'ndawoni' => $ndawoni,
            'ngowantoni' => $ngowantoni,
            'job_category_slug' => $function_slug,
            'experience' => $experiences,
            'imisebenzi' => $imisebenzi_ngowantoni,
            'mfundo_jobs_filtered' => $filter_mfundo,
            'mfundo' => $mfundo,
            'type' => '',
            'onjani' => $onjani,
            'provinces' => $provinces
        ];
        
        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }
        
        foreach ($data['imisebenzi'] as $umsebenzi) {
            $data['type'] = $umsebenzi->ngowantoni;
        }
        
        $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
        
        //Get imisebenzi with limit and offset
        $imisebenzi = $this->postModel->paginateImisebenziByType($data);
        $data['imisebenzi'] = $imisebenzi;
        
        $this->view('easternCapeJobs/ngowantoni', $data);
    }

    public function edit($id)
     {
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
                'ndawoni' => filter_input(INPUT_POST, 'ndawoni_pha', FILTER_SANITIZE_STRING),
                'job_title' => filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING),
                'label' => filter_input(INPUT_POST, 'igama_le_company', FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, 'ndawoni_pha', FILTER_SANITIZE_STRING),
                'closing_date' => filter_input(INPUT_POST, 'closing_date', FILTER_SANITIZE_STRING),
                'msebenzi_onjani' => filter_input(INPUT_POST, 'msebenzi_onjani', FILTER_SANITIZE_STRING),
                'mfundo' => filter_input(INPUT_POST, 'mfundo', FILTER_SANITIZE_STRING),
                'experience' => filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING),
                'ngowantoni' => filter_input(INPUT_POST, 'ngowantoni', FILTER_SANITIZE_STRING),
                'purpose' => trim($_POST['purpose']),
                'requirements' => trim($_POST['requirements']),
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
                'pattern' => '/[^\pN\pL]+/u',
                'slug' => '',
                'location_slug' => '',
                'job_type_slug' => '',
                'experience_slug' => '',
                'job_education_slug' => '',
                'job_category_slug' => '',
                'updated_at' => date('Y-m-d'),
                'gama_le_company_err' => '',
                'province_err' => '',
                'location_err' => '',
                'job_title_err' => '',
                'job_type_err' => '',
                'job_education_err' => '',
                'experience_err' => '',
                'job_category_err' => '',
                'requirements_err' => '',
                'responsibilities_err' => '',
                'job_web_application_err' => '',
                'job_hand_application_err' => '',
                'job_email_application_err' => '',
            ];
            
            //Create slug for filtering by location/ndawoni
            $data['location_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['ndawoni']));
            
            //Create slug for filtering by mfundo
            $data['job_education_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['mfundo']));
            
            //Create slug for filtering by experience
            $data['experience_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['experience']));
            
            //Create slug for filtering by msebenzi onjani
            $data['job_type_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['msebenzi_onjani']));
            
            //Create slug for filtering by ngowantoni
            $data['job_category_slug'] = strtolower(preg_replace($data['pattern'], '-', $data['ngowantoni']));
            
            //Validate data
            if (empty($data['gama_le_company'])) {
                $data['gama_le_company_err'] = 'Kufuneka ufake igama le company.';
            }
            if ($data['province'] == 'Khetha') {
                $data['province_err'] = 'Kufuneka ukhethe i-province';
            }
            if (empty($data['ndawoni'])) {
                $data['location_err'] = 'Ndawoni pha?';
            }
            if (empty($data['job_title'])) {
                $data['job_title_err'] = 'Job title ithini';
            }
            if ($data['msebenzi_onjani'] == 'Khetha') {
                $data['job_type_err'] = 'Ngumsebenzi onjani lo?';
            }
            if ($data['mfundo'] == 'Khetha') {
                $dta['job_education_err'] = 'Level yemfundo ithini';
            }
            if ($data['experience'] == 'Khetha') {
                $data['experience_err'] = 'Experience efunwayo ingakanani?';
            }
            if ($data['ngowantoni'] == 'Khetha') {
                $data['job_category_err'] = 'Ngumsebenzi wantoni lo?';
            }
            if (empty($data['requirements'])) {
                $data['requirements_err'] = 'Requirements zithini?';
            }
            if (empty($data['responsibilities']))  {
                $data['responsibilities_err'] = 'Responsibilities zithini?';
            }
            if (empty($data['apply_nge_website'])) {
                $data['job_web_application_err'] = 'Sicela i-link';
            }
            if (empty($data['apply_ngesandla'])) {
                $data['job_hand_application_err'] = 'Sicela i-address';
            }
            if (empty($data['apply_nge_email'])) {
                $data['job_email_application_err'] = 'Sicela i-email';
            }
            if (!empty($data['image_name'])) {
                $data['image_name'] = md5($data['image_name']);
                
                //Validate image type
                if ($data['image_type'] != "image/jpg" || $data['image_type'] != "image/png") {
                    $data['image_type_err'] = "Type ye image yakho kufuneka ibe yi jpg or png";
                }
                
                //Validate image size
                if ($data['image_size'] > 2000000) {
                    $data['image_size_err'] = "Image yakho akufunekanga ibengaphezulu ko 2 MB";
                }
            }

            //Make sure there no errors
            if (empty($data['gama_le_company_err']) && empty($data['province_err']) && empty($data['location_err']) && empty($data['job_title_err']) && empty($data['job_type_err']) && empty($dta['job_education_err']) && empty($data['experience_err']) && empty($data['job_category_err']) && empty($data['requirements_err']) && empty($data['responsibilities_err']) && empty($data['application_mode_err'])) {
                
                //Validate image type
                move_uploaded_file($data['tmp_name'], $data['dir'] . $data['image_name']);
                    
                //Create temp slug
                $data['slug'] = createSlug($data['gama_le_company'] . '-' . $data['job_title'] . '-' . $data['ndawoni']);
                
                $results = $this->postModel->checkSlug($data);
                
                //Check if temp slug exists
                if (count($results) > 0) {
                    
                   $data['slug'] = $data['slug'] . '-' . count($results);
                }
                
                //Validated
                if ($this->postModel->updateJob($data)) {
                    flash('message_yomsebenzi', 'Umsebenzi wakho has been updated');
                    redirect('easternCapeJobs');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('addJobs/edit', $data);
                }
        } else {
            $umsebenzi = $this->postModel->getPostBySlug($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($umsebenzi->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("easternCapeJobs");
            }

            //Update umsebenzi
            $data = [
                'page_description' => 'Wulungise apha umsebenzi wakho.',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Edit ' . $umsebenzi->label,
                'id' => $id,
                'job_id' => $umsebenzi->id,
                'gama_le_company' => $umsebenzi->gama_le_company,
                'province' => $umsebenzi->province,
                'ndawoni' => $umsebenzi->ndawoni,
                'job_title' => $umsebenzi->job_title,
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
                'apply_nge_website' => $umsebenzi->apply_nge_website, 
                'apply_ngesandla' => $umsebenzi->apply_ngesandla,
                'apply_nge_email' => $umsebenzi->apply_nge_email,
                'image' => $umsebenzi->image,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            
            $this->view('addJobs/edit', $data);
        }
    }
        
    public function umsebenzi($slug) {
        $umsebenzi = $this->postModel->getPostBySlug($slug);
        $user = $this->userModel->getUserById($umsebenzi->id_yomntu);
        
        $data = [
            'page_image' => URLROOT. '/img/imisebenzi/' . $umsebenzi->image,
            'page_description' => strip_tags($umsebenzi->requirements),
            'page_type' => 'website',
            'page_url' => URLROOT . "/" . $_GET['url'],
            'page_title' => $umsebenzi->label,
            'umsebenzi' => $umsebenzi,
            'slug' => $umsebenzi->slug,
            'gama_le_company' => $umsebenzi->gama_le_company,
            'experience' => $umsebenzi->experience,
            'ngowantoni' => $umsebenzi->ngowantoni,
            'msebenzi_onjani' => $umsebenzi->msebenzi_onjani,
            'ndawoni' => $umsebenzi->ndawoni,
            'mfundo' => $umsebenzi->mfundo,
            'jb_specification' => $umsebenzi->jb_specification,
            'today' => time(),
            'pub_date' => strtotime($umsebenzi->created_at),
            'date_diff' => '',
            'since_pub_date' => '',
            'results' => '',
            'umntu' => $user
        ];

        if (!empty($data['umsebenzi']->purpose) AND !empty($data['umsebenzi']->skills_competencies) AND !empty($data['umsebenzi']->additional_info)) {
            $data['jb_specification'] = "<h3>Purose</h3>" . $data['umsebenzi']->purpose;
            $data['jb_specification'] .= "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Skills & Competencies</h3>" . $data['umsebenzi']->skills_competencies;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;
            $data['jb_specification'] .= "<h3>Additional Information</h3>" . $data['umsebenzi']->additional_info;
        } elseif (!empty($data['umsebenzi']->purpose) AND !empty($data['umsebenzi']->skills_competencies)) {
            $data['jb_specification'] = "<h3>Purose</h3>" . $data['umsebenzi']->purpose;
            $data['jb_specification'] .= "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Skills & Competencies</h3>" . $data['umsebenzi']->skills_competencies;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;
        } elseif (!empty($data['umsebenzi']->purpose) AND !empty($data['umsebenzi']->additional_info)) {
            $data['jb_specification'] = "<h3>Purose</h3>" . $data['umsebenzi']->purpose;
            $data['jb_specification'] .= "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;
            $data['jb_specification'] .= "<h3>Skills & Competencies</h3>" . $data['umsebenzi']->additional_info;
        } elseif (!empty($data['umsebenzi']->purpose)) {
            $data['jb_specification'] = "<h3>Purose</h3>" . $data['umsebenzi']->purpose;
            $data['jb_specification'] .= "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;
        } elseif (!empty($data['umsebenzi']->skills_competencies) AND !empty($data['umsebenzi']->additional_info)) {
            $data['jb_specification'] = "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Skills & Competencies</h3>" . $data['umsebenzi']->skills_competencies;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;
            $data['jb_specification'] .= "<h3>Additional Information</h3>" . $data['umsebenzi']->additional_info;
        } elseif (!empty($data['umsebenzi']->skills_competencies)) {
            $data['jb_specification'] = "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Skills & Competencies</h3>" . $data['umsebenzi']->skills_competencies;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;
        } elseif (!empty($data['umsebenzi']->additional_info)) {
            $data['jb_specification'] = "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;
            $data['jb_specification'] .= "<h3>Additional Information</h3>" . $data['umsebenzi']->additional_info;
        } elseif (!empty($data['umsebenzi']->requirements) AND !empty($data['umsebenzi']->responsibilities)) {
            $data['jb_specification'] = "<h3>Requirements</h3>" . $data['umsebenzi']->requirements;
            $data['jb_specification'] .= "<h3>Responsibilities</h3>" . $data['umsebenzi']->responsibilities;  
        }
      
        $data['date_diff'] = ($data['today'] - $data['pub_date']);
        $data['since_pub_date'] = round($data['date_diff'] / (60 * 60 * 24));
        
        $data['results'] = $this->postModel->getEminyeImisebenzi($data);
        
        $this->view('easternCapeJobs/umsebenzi', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($slug)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $umsebenzi = $this->postModel->getPostBySlug($slug);

            //Check for owner
            if ($umsebenzi->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('easternCapeJobs');
            }
            if ($this->postModel->deleteJob($slug)) {
                flash('message_yomsebenzi', 'Umsebenzi wakho has been deleted');
                redirect('easternCapeJobs');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('easternCapeJobs');
        }
    }

    /**
     * Search query
     */

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Get imisebenzi
            
            $path = $_SERVER['REQUEST_URI'];
            
            $search = $_GET['search'];
            $search = "%$search%";
            $data = [
                'search' =>  $search
            ];

            $imisebenzi = $this->postModel->searchImisebenzi($data);
            $data = [
                'page_description' => 'Search results',
                'page_type' => 'website',
                'page_url' => URLROOT . $path,
                'page_title' => 'Search results for ' . ucwords($_GET['search']) . ' in Eastern Cape.',
                'imisebenzi' => $imisebenzi
            ];
            $this->view('easternCapeJobs/search', $data);
        }
    }
}