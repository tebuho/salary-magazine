<?php

    //Get imisebenzi
    $imisebenzi = $this->postModel->getImisebenzi();
    $job_location = $this->postModel->filterImisebenziByLocation();
    $job_category = $this->postModel->filterImisebenziByType();
    $experience = $this->postModel->filterImisebenziByExperience();
    $onjani = $this->postModel->filterImisebenziByOnjani();
    $job_education = $this->postModel->filterImisebenziByMfundo();
    $provinces = $this->postModel->getProvinces();
    $employers = $this->postModel->filterImisebenziByEmployer();

    $range = 2;
    if (isset($_GET['url'])) {
    $page = $page;
    } else {
    $page = 1;
    }
    
    if (!empty($imisebenzi)) {
        $imisebenzi_image = "";
    } else {
        $imisebenzi_image = "";
    }

    $data = [
        'results_per_page' => 15,
        'start' => '',
        'total_pages' => '',
        'page' => $page,
        'initial_num' => $page - $range,
        'condition_limit_num' => ($page + 1)  + 1,
        'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi_image,
        'page_description' => "If ukhangela imisebenzi ese $this->province ungayijonga apha.",
        'page_type' => 'website',
        'page_url' => URLROOT . "/",
        'page_title' => "Imisebenzi ese $this->province",
        'job_location' => $job_location,
        'category' => $job_category,
        'experience' => $experience,
        'job_education' => $job_education,
        'onjani' => $onjani,
        'imisebenzi' => $imisebenzi,
        'provinces' => $provinces,
        'employers' => $employers
    ];

    if (isset($_GET['url'])) {
        $data["page_url"] = URLROOT . "/" . $_GET['url'];
    }

    if ($page > 1) {
        $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
    } else {
        $data['start'] = 0;
    }

    $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);

    //Get imisebenzi with limit and offset
    // $imisebenzi = $this->postModel->paginateImisebenzi($data);
    $data['imisebenzi'] = $imisebenzi;
    $my_file = fopen("jb-all.json", "w");
    $em_all = json_encode($imisebenzi);
    fwrite($my_file, $em_all);
    fclose($my_file);
    
?>