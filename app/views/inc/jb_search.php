<?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //Sanitize POST array
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        

        //Get imisebenzi
        if (isset($_GET['search'])) {
        $search = $_GET['search'];
        }
        
        $path = $_SERVER['REQUEST_URI'];
        $search = "%$search%";
        $data = [
            'search' =>  $search
        ];

        //Get imisebenzi
        $imisebenzi = $this->postModel->getImisebenzi();
        $ndawoni = $this->postModel->filterImisebenziByLocation();
        $category = $this->postModel->filterImisebenziByType();
        $experience = $this->postModel->filterImisebenziByExperience();
        $onjani = $this->postModel->filterImisebenziByOnjani();
        $job_education = $this->postModel->filterImisebenziByMfundo();
        $provinces = $this->postModel->getProvinces();

        $range = 2;
        if (isset($_GET['url'])) {
        $page = 0;
        } else {
        $page = 1;
        }
        
        $imisebenzi = $this->postModel->searchImisebenzi($data);
        $data = [
            'results_per_page' => 12,
            'start' => '',
            'total_pages' => '',
            'page' => $page,
            'initial_num' => $page - $range,
            'condition_limit_num' => ($page + 1)  + 1,
            'page_image' => URLROOT . '/img/imisebenzi/' . $imisebenzi[0]->image,
            'page_description' => 'Search results',
            'page_type' => 'website',
            'page_url' => URLROOT . $path,
            'page_title' => $this->province . ucwords($_GET['search']) . ' Jobs',
            'ndawoni' => $ndawoni,
            'category' => $category,
            'experience' => $experience,
            'job_education' => $job_education,
            'onjani' => $onjani,
            'imisebenzi' => $imisebenzi,
            'provinces' => $provinces,
            'imisebenzi' => $imisebenzi
        ];
        die(var_dump($this->province));
        $this->view("$this->province_slug/search", $data);
        
    }
?>