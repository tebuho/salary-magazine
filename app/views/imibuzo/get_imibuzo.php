<?php

    //Get imibuzo
    $imibuzo = $this->postModel->getImibuzo();

    $range = 2;
    if (isset($_GET['url'])) {
    $page = $page;
    } else {
    $page = 1;
    }
    
    $data = [
        'results_per_page' => 15,
        'start' => '',
        'total_pages' => '',
        'page' => $page,
        'initial_num' => $page - $range,
        'condition_limit_num' => ($page + 1)  + 1,
        'page_image' => URLROOT . '/public/img/imibuzo/imibuzo-yabantu.png',
        'page_description' => 'Imibuzo Yabantu',
        'page_type' => 'website',
        'page_url' => URLROOT . "/" . $_GET['url'],
        'page_title' => 'Imibuzo Yabantu',
        'h1' => 'Wubhale apha umbuzo wakho',
        'heading_yombuzo' => 'Umbuzo wakho ungantoni?',
        'imibuzo' => $imibuzo,
    ];

    if ($page > 1) {
        $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
    } else {
        $data['start'] = 0;
    }

    $data['total_pages'] = ceil(count($data['imibuzo'])/$data['results_per_page']);

    //Get imibuzo with limit and offset
    $imibuzo = $this->postModel->paginateImibuzo($data);
    $data['imibuzo'] = $imibuzo;
    
?>