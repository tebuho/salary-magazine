<?php

class nationwideJobs extends Controller
{
    public $provinces;
    public $province;
    public $province_slug;
    public function __construct()
    {
        $this->postModel = $this->model('nationwideJob');
        $this->userModel = $this->model('Umntu');
        $this->provinces = new Provinces;
        $this->province_slug = ($this->provinces->getProvinces()[0]);
        $this->province = ($this->provinces->getProvinces()[1]);
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
}