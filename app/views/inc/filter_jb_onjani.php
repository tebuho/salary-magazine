<?php
         
    //Get imisebenzi
    $job_location = $this->postModel->filterImisebenziByLocation();
    $job_category = $this->postModel->filterImisebenziByType();
    $experience = $this->postModel->filterImisebenziByExperience();
    $job_education = $this->postModel->filterImisebenziByMfundo();
    $onjani_umsebenzi = $this->postModel->getImisebenziByOnjani($job_type);
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $provinces = $this->postModel->getProvinces();
    
    //Get job type for title tag
    foreach ($onjani_umsebenzi as $job_type) {
        $type = $job_type->job_type;
    }

    foreach($onjani_umsebenzi as $njani) {
        $job_type = $njani->job_type_slug;
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
        'page_image' => URLROOT . '/img/imisebenzi/' . $onjani_umsebenzi[0]->image,
        'page_description' => 'If ukhangela imisebenzi ye ' .  $type . ' ungayijonga apha.',
        'page_type' => 'website',
        'page_url' => URLROOT . "/" . $_GET['url'],
        'page_title' => 'Imisebenzi ye ' .  $type,
        'job_location' => $job_location,
        'category' => $job_category,
        'experience' => $experience,
        'job_education' => $job_education,
        'onjani' => $onjani,
        'job_type_slug' => $job_type,
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
        $data['njani'] = $onjani->job_type;
    }
    
    $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
    
    //Get imisebenzi with limit and offset
    $onjani_umsebenzi = $this->postModel->paginateImisebenziNgoBunjani($data);
    $data['imisebenzi'] = $onjani_umsebenzi;

?>