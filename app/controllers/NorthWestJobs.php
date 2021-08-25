<?php

class NorthWestJobs extends Controller
{
    public $provinces;
    public $province;
    public $province_slug;
    public function __construct()
    {
        $this->postModel = $this->model('northWestJob');
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
     *                  Filter jobs by location                         *
     *                                                                  *
     ********************************************************************/
    public function ndawoni($location, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_location.php";
        
        $this->view("$this->province_slug/ndawoni", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                  Filter jobs by msebenzi onjani                  *
     *                                                                  *
     ********************************************************************/
    public function onjani($msebenzi_onjani, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_onjani.php";
        
        $this->view("$this->province_slug/onjani", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by mfundo                       *
     *                                                                  *
     ********************************************************************/
    public function mfundo($education, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_mfundo.php";
        
        $this->view("$this->province_slug/mfundo", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by experience                       *
     *                                                                  *
     ********************************************************************/
    public function experience($exp, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_experience.php";
        
        $this->view("$this->province_slug/experience", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by industry                       *
     *                                                                  *
     ********************************************************************/
    public function ngowantoni($type, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_ngowantoni.php";
        
        $this->view("$this->province_slug/ngowantoni", $data);
        
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

    public function edit($id)
     {
       
        include_once "../app/views/inc/jb_edit.php";
        
    }
        
    public function umsebenzi($slug)
    {

        include_once "../app/views/inc/umsebenzi.php";
    
        $this->view("$this->province_slug/umsebenzi", $data);
        
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {

        include_once "../app/views/inc/jb_delete.php";
    
    }

    /**
     * Search query
     */

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