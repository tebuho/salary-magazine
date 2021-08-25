<?php
class Admins extends Controller
{

    public function __construct()
    {
        $this->postModel = $this->model('Admin');

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
        // $employers = $this->postModel->getEmployerSlug();
        $imisebenzi = $this->postModel->getAlljobs();

        $range = 2;
        if (isset($_GET['url'])) {
        $page = $page;
        } else {
        $page = 1;
        }
        
        $data = [
            'results_per_page' => 25,
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
            'imisebenzi' => $imisebenzi,
            'total_imisebenzi' => $imisebenzi,
            'umsebenzi' => '',
            'umsebenzi_slug' => '',
            'number' => '',
            'umsebenzi_like_slug' => '',
            'slug_like_employer' => ''
        ];

        if ($page > 1) {
            $data['start'] = ($page * $data['results_per_page']) - $data['results_per_page'];
        } else {
            $data['start'] = 0;
        }
        $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
        $data["total_jobs"] = count($data['imisebenzi']);
        //Get imisebenzi with limit and offset
        $imisebenzi = $this->postModel->paginateJobs($data);
        $data['imisebenzi'] = $imisebenzi;
        // foreach ($data['imisebenzi'] as $umsebenzi) {
        //     // Counting number of employers to list them
        //     // numerically on index
        //     for ($x = 1; $x < count($data['imisebenzi']); $x++) {
        //         $data['number'] = $x;
        //     }

        //     $data['umsebenzi'] = $umsebenzi->umsebenzi;
        //     $data['umsebenzi_slug'] = $umsebenzi->umsebenzi_slug;

        //     $results = $this->postModel->getEmployerBySlug($data["umsebenzi_slug"]);

        //     if ($results == false) {
        //         // Update slug
        //         $update = $this->postModel->updateSlug($data);
        //     }
            
        //     $results = $this->postModel->checkEmployer($data['umsebenzi']);
            
        //     if ($results->count != 1) {
        //         //Create temp slug
        //         $data["umsebenzi_slug"] = createSlug($data["umsebenzi"]);
        //         $this->postModel->addEmployer($data);
        //     }
            
        // }
        
        $this->view("admins/index", $data);
        
    }

    // Update employer
    public function edit($slug)
    {
        if (!isset($_SESSION['id_yomntu']) && $_SESSION['id_yomntu'] !== 2 || !isset($_SESSION['id_yomntu']) && $_SESSION['id_yomntu'] !== 3) {
            redirect("");
        }

        // From database ye misebenzi
        $employer = $this->postModel->getEmployerBySlug($slug);
        // From database ye misebenzi
        $categories = $this->postModel->getIndustry($slug);
        // From database ye employers
        $cat_from_employers = explode("; ", $this->postModel->getIndustryFromEmployers($slug)->category);
        
        // Before updating
        $data = [
            'page_image' => URLROOT . '/public/img/SM.jpg',
            'page_description' => 'A database of all the employers we\'ve collected over the years.',
            'page_type' => 'website',
            'page_url' => URLROOT . "/",
            'page_title' => 'Edit ' . $employer->employer,
            'description' => 'Edit ' . $employer->employer,
            'id' => $employer->id,
            'employers' => $employer,
            'employer' => $employer->employer,
            'employer_err' => '',
            'employer_slug' => $employer->employer_slug,
            'vacancies' => $employer->vacancies,
            'vacancies_err' => '',
            'website' => $employer->website,
            'website_err' => '',
            'provinces' => $employer->provinces,
            'categories' => $categories,
            'cat_from_employers' => $cat_from_employers,
            'type' => $employer->type,
            'head_office' => $employer->head_office,
            'facebook' => $employer->facebook,
            'linkedin' => $employer->linkedin,
            'twitter' => $employer->twitter,
            'created_at' => $employer->created_at
        ];

        $data['provinces'] = explode(", ", $data['provinces']);

        $cat_arr = array();
        foreach ($categories as $category) {
            if ($category->ngowantoni == "Safety, Health & Environment Quality") {
                $category->ngowantoni = "SHEQ";
            }
            $cat_arr[] = $category->ngowantoni;
        }
        $categories = $cat_arr;
        
        // After updating
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $_POST['provinces'] = implode(", ", $_POST['provinces']);
            $_POST['categories'] = implode("; ", $_POST['categories']);
            
            $data['vacancies'] = trim($_POST['vacancies']);
            $data['website'] = trim($_POST['website']);
            $data['provinces'] = trim($_POST['provinces']);
            $data['categories'] = $_POST['categories'];
            $data['type'] = trim($_POST['type']);
            $data['head_office'] = trim($_POST['head_office']);
            $data['facebook'] = trim($_POST['facebook']);
            $data['linkedin'] = trim($_POST['linkedin']);
            $data['twitter'] = trim($_POST['twitter']);
            
            $new_cat = explode("; ", $cat_from_employers->category);
            if (!empty($data['categories'])) {
                if (empty($new_cat[0])) {
                    array_splice($new_cat, 0, 1);
                }
                array_push($new_cat, $data['categories']);
            }
            if (count($new_cat) > 1) {
                $data['categories'] = implode("; ", $new_cat);
            }

                // Update employer slug when employer has changed
                if ($data['employer'] !== trim($_POST['employer'])) {
                    $data['employer'] = trim($_POST['employer']);
                    $data['employer_slug'] = createSlug($data["employer"]);
                }

                // Update employer info on db
                if ($this->postModel->updateEmployer($data)) {
                    flash("message_yomsebenzi", $data['employer'] . " has been updated on the employers' list.");
                    redirect("employers/");
                }
            }
        
            $this->view("admins/edit", $data);

    }
    // Delete employer from db
    public function delete($slug)
    {
        // Get employer by slug
        $employer = $this->postModel->getEmployerBySlug($slug);

        $data = [
            'employer' => $employer->employer
        ];
        // Delete employer and redirect to employers' page
        if ($this->postModel->deleteEmployer($data)) {
            flash("message_yomsebenzi", $data['employer'] . " has been deleted from employers' list.");
            redirect("employers/");
        }
        
        $this->view("admins/delete");
    }

    /********************************************************************
     *                                                                  *
     *                          Search jobs                             *
     *                                                                  *
     ********************************************************************/
    public function search($page = 0)
    {

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            //Get imisebenzi
            if (isset($_GET["search"])) {
                $ukhangela_ntoni = $_GET["search"];
                $_SESSION["search"] = $_GET["search"];
            }
            
            $path = $_SERVER["REQUEST_URI"];
            $ukhangela_ntoni = "$ukhangela_ntoni%";
            $data = [
                "search" =>  $ukhangela_ntoni,
            ];
            $imisebenzi = $this->postModel->searchImisebenzi($data);
    
            $range = 2;
            if (!empty($imisebenzi)) {
                $image = $imisebenzi[0]->image;
            } else {
                $image = "";
            }
            
            $data = [
                "search" =>  $ukhangela_ntoni,
                "results_per_page" => 25,
                "start" => "",
                "total_pages" => "",
                "page" => $page,
                "initial_num" => $page - $range,
                "condition_limit_num" => ($page + 1)  + 1,
                "page_image" => URLROOT . "/img/imisebenzi/" . $image,
                "page_description" => "Search results",
                "page_type" => "website",
                "page_url" => URLROOT . $path,
                "page_title" => "Search results for " . ucwords($_GET["search"]) . " Jobs",
                "imisebenzi" => $imisebenzi,
            ];
            $data['total_pages'] = ceil(count($data['imisebenzi'])/$data['results_per_page']);
            $data["total_jobs"] = count($data['imisebenzi']);

            if ($data['page'] < $data['total_pages'] && isset($_GET["search"]) && isset($_GET['page'])) {
                $data['page'] = $_GET["page"];
            }
            if ($data['page'] > 1) {
                $data['start'] = ($data['page'] * $data['results_per_page']) - $data['results_per_page'];
            } else {
                $data['start'] = 0;
            }
            
            $imisebenzi = $this->postModel->PaginateJobSearch($data);
            $data['imisebenzi'] = $imisebenzi;
            if (empty($data['imisebenzi'])) {
                redirect("admins/no_results");
            }
            
            $this->view("admins/search", $data);
        }
    
    }
    public function no_results()
    {
        
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $data = [
                "search" => $_SESSION["search"],
                "page_image" => URLROOT . "/public/img/SM.jpg",
                "page_description" => "A database of all the employers we\"ve collected over the years.",
                "page_type" => "website",
                "page_url" => URLROOT . "/",
                "page_title" => "Employers",
                "description" => "A database of all the employers we\"ve collected over the years.",
                "umsebenzi" => "",
                "umsebenzi_slug" => "",
                "number" => "",
                "umsebenzi_like_slug" => "",
                "slug_like_employer" => ""
            ];
        }
        $this->view("admins/no_results", $data);
    }
}