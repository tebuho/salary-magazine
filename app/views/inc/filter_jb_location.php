<?php

    //Get imisebenzi
    $imisebenzi = $this->postModel->getImisebenziByLocation($location);
    $ndawoni = $this->postModel->filterImisebenziByLocation();
    $ngowantoni = $this->postModel->filterImisebenziByType();
    $experience = $this->postModel->filterImisebenziByExperience();
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $mfundo = $this->postModel->filterImisebenziByMfundo();
    $provinces = $this->postModel->getProvinces();
    
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
        'page_title' => 'Imisebenzi ese ' . $location,
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

?>