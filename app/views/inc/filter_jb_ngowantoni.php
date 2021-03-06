<?php
    //Get imisebenzi
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $filter_job_education = $this->postModel->filterImisebenziByMfundo();
    $job_education = $this->postModel->filterImisebenziByMfundo();
    $job_location = $this->postModel->filterImisebenziByLocation();
    $job_category = $this->postModel->filterImisebenziByType();
    $experiences = $this->postModel->filterImisebenziByExperience();
    $imisebenzi_category = $this->postModel->getImisebenziByType($type);
    $provinces = $this->postModel->getProvinces();
    
    if (isset($_GET['url'])) {
        $page = $page;
    } else {
        $page = 0;
    }
    
    
    //Get job function for title tag
    foreach ($imisebenzi_category as $msebenzi_wantoni) {
        if ($msebenzi_wantoni->job_category == "Government") {
            $function = "Imisebenzi yakwa government";
        } else {
            $function = "Imisebenzi ye " . $msebenzi_wantoni->job_category;   
        }
    }
    
    //Get job function slug
    foreach ($imisebenzi_category as $msebenzi_wantoni) {
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
        'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi_category[0]->image,
        'page_description' => 'If ukhangela imisebenzi ye ' . $function . ' ungayijonga apha.',
        'page_type' => 'website',
        'page_url' => URLROOT . "/" . $_GET['url'],
        'page_title' => $function,
        'job_location' => $job_location,
        'category' => $job_category,
        'job_category_slug' => $function_slug,
        'experience' => $experiences,
        'imisebenzi' => $imisebenzi_category,
        'job_education_jobs_filtered' => $filter_job_education,
        'job_education' => $job_education,
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
        $data['type'] = $umsebenzi->job_category;
    }
    
    $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
    
    //Get imisebenzi with limit and offset
    $imisebenzi = $this->postModel->paginateImisebenziByType($data);
    $data['imisebenzi'] = $imisebenzi;

?>