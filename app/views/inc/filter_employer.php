<?php

    //Get imisebenzi
    $job_location = $this->postModel->filterImisebenziByLocation();
    $job_category = $this->postModel->filterImisebenziByType();
    $experience = $this->postModel->filterImisebenziByExperience();
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $job_education = $this->postModel->filterImisebenziByMfundo();
    $provinces = $this->postModel->getProvinces();
    $all_employers = $this->postModel->getImisebenziByEmployer($employer);
    $employers = $this->postModel->filterImisebenziByEmployer();
    
    //Get job_location for title tag
    foreach ($all_employers as $employer) {
        $employer_name = $employer->job_employer;
    }
    
    //Get job_location slug
    foreach ($all_employers as $ndawo_slug) {
        $job_location_slug = $ndawo_slug->job_location_slug;
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
        'page_image' => URLROOT . '/img/imisebenzi/' . $all_employers[0]->image,
        'page_description' => 'If ukhangela imisebenzi ese ' . $employer_name . ' ungayijonga apha.',
        'page_type' => 'website',
        'page_url' => URLROOT . "/" . $_GET['url'],
        'page_title' => $employer_name . ' Jobs',
        'job_location' => $job_location,
        'job_location_slug' => $job_location_slug,
        'category' => $job_category,
        'experience' => $experience,
        'job_education' => $job_education,
        'onjani' => $onjani,
        'area' => '',
        'imisebenzi' => $all_employers,
        'provinces' => $provinces,
        "employers" => $employers,
        "job_employer" => $employer_name
    ];
    
    if ($page > 1) {
        $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
    } else {
        $data['start'] = 0;
    }
    
    foreach ($data['imisebenzi'] as $area) {
        $data['area'] = "";
    }
    
    $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
    
    //Get imisebenzi with limit and offset
    $imisebenzi = $this->postModel->paginateImisebenziByEmployer($data);
    $data['imisebenzi'] = $imisebenzi;

?>