<?php

    //Get testimonial
    $testimonials = $this->postModel->getTestimonials();

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
        'page_image' => URLROOT . '/public/img/testimonials/testimonials-zabantu.png',
        'page_description' => 'Testimonials Zabantu',
        'page_type' => 'website',
        'page_url' => URLROOT . "/" . $_GET['url'],
        'page_title' => 'Testimonials Zabantu',
        'h1' => 'Wubhale apha testimonial wakho',
        'heading_yombuzo' => 'Testimonial wakho ungantoni?',
        'testimonials' => $testimonials,
    ];

    if ($page > 1) {
        $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
    } else {
        $data['start'] = 0;
    }

    $data['total_pages'] = ceil(count($data['testimonials'])/$data['results_per_page']);

    //Get testimonial with limit and offset
    $testimonials = $this->postModel->paginateTestimonials($data);
    $data['testimonials'] = $testimonials;
    
?>