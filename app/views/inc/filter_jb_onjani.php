<?php
         
    //Get imisebenzi
    $ndawoni = $this->postModel->filterImisebenziByLocation();
    $ngowantoni = $this->postModel->filterImisebenziByType();
    $experience = $this->postModel->filterImisebenziByExperience();
    $mfundo = $this->postModel->filterImisebenziByMfundo();
    $onjani_umsebenzi = $this->postModel->getImisebenziByOnjani($msebenzi_onjani);
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $provinces = $this->postModel->getProvinces();
    
    //Get job type for title tag
    foreach ($onjani_umsebenzi as $job_type) {
        $type = $job_type->msebenzi_onjani;
    }

    foreach($onjani_umsebenzi as $njani) {
        $msebenzi_onjani = $njani->onjani_slug;
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
        'ndawoni' => $ndawoni,
        'ngowantoni' => $ngowantoni,
        'experience' => $experience,
        'mfundo' => $mfundo,
        'onjani' => $onjani,
        'onjani_slug' => $msebenzi_onjani,
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

?>