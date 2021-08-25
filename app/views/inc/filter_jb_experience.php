<?php
        
    //Get imisebenzi
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $filter_mfundo = $this->postModel->filterImisebenziByMfundo();
    $mfundo = $this->postModel->filterImisebenziByMfundo();
    $ndawoni = $this->postModel->filterImisebenziByLocation();
    $ngowantoni = $this->postModel->filterImisebenziByType();
    $experiences = $this->postModel->filterImisebenziByExperience();
    $imisebenzi_experience = $this->postModel->getImisebenziByExperience($exp);
    $provinces = $this->postModel->getProvinces();

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
        'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi[0]->image,
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

?>