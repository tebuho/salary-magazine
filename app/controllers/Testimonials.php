<?php

class Testimonials extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Testimonial');
        $this->userModel = $this->model('Umntu');
    }

    //Testimonials index page
    public function index($page = 0)
    {
        //Testimnonials from db
        include_once "../app/views/testimonials/get_testimonials.php";

        $this->view('testimonials/index', $data);
    }

    /**
     * Add testimonials page
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            $data = [
                'page_image' => '',
                'page_modified' => '',
                'page_description' => '',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Add Testimonial'
            ];
            $this->view('testimonials/add', $data);
        } else {
            //Add testimonial
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'page_image' => '',
                'page_modified' => '',
                'page_description' => '',
                'page_type' => 'website',
                'page_url' => URLROOT . "/" . $_GET['url'],
                'page_title' => 'Add Testimonial',
                'id_yomntu' => $_SESSION['id_yomntu'],
                'testimonial' => $_POST['add-testimonial'],
                'created_at' => date('Y-m-d H:i:s'),
                'slug' => '',
                'testimonial_err' => ''
            ];
            $new = $this->postModel->getTestimonialId();
            $testimonialId = +$new->id + 1;
            $data['slug'] = 'testimonial-#' . $testimonialId;
            //Check if submitted testimonial textarea is empty and create error message
            if (empty($data['testimonial'])) {
                $data['testimonial_err'] = 'Testimonial yakho must not be empty.';
            }
            //If textarea is not emptythen submit testimonial
            if (empty($data['testimonial_err'])) {
                if ($this->postModel->addTestimonial($data)) {
                    //User info from db
                    $umntu = $this->userModel->getUserById($data['id_yomntu']);
                    //Flash message after testimonial has been submitted
                    flash('message_yomsebenzi', 'Testimonial yakho ingenile');
                    redirect('testimonials');
                } else {
                    die('Ikhona into erongo');
                }
            } else {
                //Load with error message
                $data['page_title'] = 'Error';
                error('message_yomsebenzi', 'Make sure testimonial yakho ayikho empty.');
                $this->view('testimonials/add', $data);
            }
        }
    }
    public function update()
    {
        $this->view('testimonials/update');
    }
}