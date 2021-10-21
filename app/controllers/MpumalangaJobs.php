<?php

class MpumalangaJobs extends Controller
{
    public $provinces;
    public $province;
    public $province_slug;
    public function __construct()
    {

        $this->postModel = $this->model('mpumalangaJob');
        $this->userModel = $this->model('Umntu');
        $this->provinces = new Provinces;
        $this->province_slug = ($this->provinces->getProvinces()[0]);
        $this->province = ($this->provinces->getProvinces()[1]);

    }

    /********************************************************************
     *                                                                  *
     *                  Get all jobs and paginate                       *
     *                                                                  *
     ********************************************************************/
    public function index($page = 0)
    {
       
        include_once "../app/views/inc/get_jobs.php";
        
        $this->view("$this->province_slug/index", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                  Filter jobs by job_location                         *
     *                                                                  *
     ********************************************************************/
    public function job_location($job_location, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_job_location.php";
        
        $this->view("$this->province_slug/index", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                  Filter jobs by msebenzi onjani                  *
     *                                                                  *
     ********************************************************************/
    public function onjani($job_type, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_onjani.php";
        
        $this->view("$this->province_slug/onjani", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by job_education                       *
     *                                                                  *
     ********************************************************************/
    public function job_education($education, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_job_education.php";
        
        $this->view("$this->province_slug/job_education", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by experience                   *
     *                                                                  *
     ********************************************************************/
    public function experience($exp, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_experience.php";
        
        $this->view("$this->province_slug/experience", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by industry                     *
     *                                                                  *
     ********************************************************************/
    public function category($type, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_category.php";
        
        $this->view("$this->province_slug/category", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by employer                     *
     *                                                                  *
     ********************************************************************/
    public function employer($employer, $page = 0)
    {
       
        include_once "../app/views/inc/filter_employer.php";
        
        $this->view("$this->province_slug/employer", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Edit job                                    *
     *                                                                  *
     ********************************************************************/
    public function edit($id)
    {
       
        include_once "../app/views/inc/jb_edit.php";
        
    }

    /********************************************************************
     *                                                                  *
     *                      Load single post                            *
     *                                                                  *
     ********************************************************************/
    public function umsebenzi($slug)
    {

        include_once "../app/views/inc/umsebenzi.php";
    
        $this->view("$this->province_slug/umsebenzi", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                            Delete job                            *
     *                                                                  *
     ********************************************************************/
    public function delete($id)
    {

        include_once "../app/views/inc/jb_delete.php";
    
    }

    /********************************************************************
     *                                                                  *
     *                          Search jobs                             *
     *                                                                  *
     ********************************************************************/
    public function search()
    {

        include_once "../app/views/inc/jb_search.php";
    
    }

    /********************************************************************
     *                                                                  *
     *                         Add commnet                              *
     *                                                                  *
     ********************************************************************/
    public function comment($slug)
    {

        include_once "../app/controllers/inc/jobs/comment.php";
    
    }
}