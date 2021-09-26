<?php
    //Get imisebenzi
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $imisebenzi_job_education = $this->postModel->getImisebenziByMfundo($education);
    $filter_job_education = $this->postModel->filterImisebenziByMfundo();
    $job_education = $this->postModel->filterImisebenziByMfundo();
    $ndawoni = $this->postModel->filterImisebenziByLocation();
    $category = $this->postModel->filterImisebenziByType();
    $experience = $this->postModel->filterImisebenziByExperience();
    $provinces = $this->postModel->getProvinces();
    
    if (isset($_GET['url'])) {
        $page = $page;
    } else {
        $page = 0;
    }
    
    //Get education for title tag
    foreach ($imisebenzi_job_education as $job_education_type) {
        $education = $job_education_type->job_education;
    }
    
    //Get education slug
    foreach ($imisebenzi_job_education as $job_education_slug) {
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
        'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi_job_education[0]->image,
        'page_description' => 'If ukhangela imisebenzi efuna i-' . $education . ' ungayijonga apha.',
        'page_type' => 'website',
        'page_url' => URLROOT . "/" . $_GET['url'],
        'page_title' => 'Imisebenzi efuna i-' . $education,
        'ndawoni' => $ndawoni,
        'category' => $category,
        'experience' => $experience,
        'imisebenzi' => $imisebenzi_job_education,
        'job_education_jobs_filtered' => $filter_job_education,
        'job_education' => $job_education,
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
        $data['ed'] = $imisebenzi->job_education;
    }
    
    $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
    
    //Get imisebenzi with limit and offset
    $imisebenzi = $this->postModel->paginateImisebenziNgeMfundo($data);
    $data['imisebenzi'] = $imisebenzi;

?>