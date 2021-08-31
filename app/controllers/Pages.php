<?php
class Pages extends Controller
{
    public $provinces;
    public $province;
    public $province_slug;

    public function __construct()
    {
        $this->postModel = $this->model('page');
    }

    /********************************************************************
     *                                                                  *
     *                  Get all jobs and paginate                       *
     *                                                                  *
     ********************************************************************/
    
    public function index($page = 0)
    {
       
        include_once "../app/views/inc/get_jobs.php";
        
        $this->view("pages/index", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by industry                     *
     *                                                                  *
     ********************************************************************/
    public function ngowantoni($type, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_ngowantoni.php";
        
        $this->view("pages/ngowantoni", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                      Filter jobs by employer                     *
     *                                                                  *
     ********************************************************************/
    public function employer($employer, $page = 0)
    {
       
        include_once "../app/views/inc/filter_employer.php";
        
        $this->view("pages/employer", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                  Filter jobs by msebenzi onjani                  *
     *                                                                  *
     ********************************************************************/
    public function onjani($msebenzi_onjani, $page = 0)
    {
       
        include_once "../app/views/inc/filter_jb_onjani.php";
        
        $this->view("pages/onjani", $data);
        
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
    
        $this->view("pages/umsebenzi", $data);
        
    }

    /********************************************************************
     *                                                                  *
     *                          Search jobs                             *
     *                                                                  *
     ********************************************************************/
    public function search()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            //Get imisebenzi
            if (isset($_GET['search'])) {
                $ukhangela_ntoni = $_GET['search'];
            }
            
            $path = $_SERVER['REQUEST_URI'];
            $ukhangela_ntoni = "$ukhangela_ntoni%";
            $data = [
                'search' =>  $ukhangela_ntoni,
            ];
    
            //Get imisebenzi
            $imisebenzi = $this->postModel->getImisebenzi();
            $ndawoni = $this->postModel->filterImisebenziByLocation();
            $ngowantoni = $this->postModel->filterImisebenziByType();
            $experience = $this->postModel->filterImisebenziByExperience();
            $onjani = $this->postModel->filterImisebenziByOnjani();
            $mfundo = $this->postModel->filterImisebenziByMfundo();
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
                'page_title' => 'Search results for ' . ucwords($_GET['search']) . ' Jobs',
                'ndawoni' => $ndawoni,
                'ngowantoni' => $ngowantoni,
                'experience' => $experience,
                'mfundo' => $mfundo,
                'onjani' => $onjani,
                'imisebenzi' => $imisebenzi,
                'provinces' => $provinces,
                'imisebenzi' => $imisebenzi
            ];
            $this->view("pages/search", $data);
        }
    
    }
    
}
?>