<?php
class Employers extends Controller
{
    public $provinces;
    public $employers_json;
    

    public function __construct()
    {
        $this->postModel = $this->model('Employer');
        $this->provinces = new Provinces;
        

    }
    

    /********************************************************************
     *                                                                  *
     *                      Find all employers on SM                    *
     *                                                                  *
     ********************************************************************/
    public function index($page = 0)
    {
        if (!isset($_SESSION['id_yomntu']) && $_SESSION['id_yomntu'] !== 2 || !isset($_SESSION['id_yomntu']) && $_SESSION['id_yomntu'] !== 3) {
            redirect("");
        }
        //Check if user is not Admin
        // if ($_SESSION['id_yomntu'] != 2 || $_SESSION['id_yomntu'] != 3) {
        //     redirect("employers/");
        // }
        // include_once "../app/views/inc/filter_employer.php";
        $employers = $this->postModel->getAllEmployers();
        foreach ($employers as $em) {
            for ($i = 0; $i < count($employers); $i++) {
                $emp_arr = [
                    $i => (object) [
                        "name" => $employers[$i]->employer
                    ],
                ];
                $wya[] = $emp_arr[$i];
                $data["name"] = $wya;
                $em_json = $data["name"];
                $abaqashi = json_encode($em_json);
                // Create JSON
                $employers_json = fopen("./api/employers.json", "w");
                fwrite($employers_json, $abaqashi);
                fclose($employers_json);
                // array_push($emp_arr, $employers[$i]->employer);
            }
        }

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
            'page_image' => URLROOT . '/public/img/SM.jpg',
            'page_description' => 'A database of all the employers we\'ve collected over the years.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/",
            'page_title' => 'Employers',
            'description' => 'A database of all the employers we\'ve collected over the years.',
            'employers' => $employers,
            'total_employers' => $employers,
            'employer' => '',
            'employer_slug' => '',
            'number' => '',
            'employer_like_slug' => '',
            'slug_like_employer' => ''
        ];

        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }

        $data['total_pages'] = ceil(count($data['employers'])/$data['results_per_page']);
    
        //Get employers with limit and offset
        $employers = $this->postModel->paginateEmployers($data);
        $data['employers'] = $employers;

        foreach ($data['employers'] as $employer) {
            // Counting number of employers to list them
            // numerically on index
            for ($x = 1; $x < count($data['employers']); $x++) {
                $data['number'] = $x;
            }

            $data['employer'] = $employer->employer;
            $data['employer_slug'] = $employer->employer_slug;
            
        }
        
        $this->view("employers/index", $data);
        
    }

    // Search employers
    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            redirect("admin/");
        }
        
        $data["search"] = $_POST["search"];
        $search = $this->postModel->searchEmployers($data);
        $this->view("employers/search");
    }
    public function employers()
    {
        
        $this->view("employers/employers");
    }
}