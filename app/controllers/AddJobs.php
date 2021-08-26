<?php

class addJobs extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if (isset($_SESSION["role"]) && $_SESSION["role"] !== "Admin") {
            redirect("");
        }
        $this->postModel = $this->model("addJob");
        $this->userModel = $this->model("Umntu");
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "gama_le_company" => trim(filter_input(INPUT_POST, "igama_le_company", FILTER_SANITIZE_STRING)),
                "id_yomntu" => $_SESSION["id_yomntu"],
                "province" => filter_input(INPUT_POST, "job_province", FILTER_SANITIZE_STRING),
                "province_slug" => "",
                "ndawoni" => trim(filter_input(INPUT_POST, "ndawoni_pha", FILTER_SANITIZE_STRING)),
                "job_title" => trim(filter_input(INPUT_POST, "job_title", FILTER_SANITIZE_STRING)),
                "label" => trim(filter_input(INPUT_POST, "igama_le_company", FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, "job_title", FILTER_SANITIZE_STRING) . " " . filter_input(INPUT_POST, "ndawoni_pha", FILTER_SANITIZE_STRING)),
                "closing_date" => filter_input(INPUT_POST, "closing_date", FILTER_SANITIZE_STRING),
                "msebenzi_onjani" => filter_input(INPUT_POST, "msebenzi_onjani", FILTER_SANITIZE_STRING),
                "mfundo" => filter_input(INPUT_POST, "mfundo", FILTER_SANITIZE_STRING),
                "experience" => filter_input(INPUT_POST, "experience", FILTER_SANITIZE_STRING),
                "ngowantoni" => filter_input(INPUT_POST, "ngowantoni", FILTER_SANITIZE_STRING),
                "requirements" => trim($_POST["requirements"]),
                "purpose" => trim($_POST["purpose"]),
                "skills_competencies" => trim($_POST["skills_competencies"]),
                "responsibilities" => trim($_POST["responsibilities"]),
                "additional_info" => trim($_POST["additional_info"]),
                "apply_nge_website" => filter_input(INPUT_POST, "website", FILTER_SANITIZE_STRING),
                "apply_ngesandla" => trim($_POST["ngesandla"]),
                "apply_nge_email" => filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING),
                "image_name" => strip_tags(trim($_FILES["image"]["name"])),
                "image_size" => trim($_FILES["image"]["size"]),
                "image_type" => trim($_FILES["image"]["type"]),
                "tmp_name" => trim($_FILES["image"]["tmp_name"]),
                "dir" => "/home/salarfng/public_html/public/img/imisebenzi/",
                "page_image" . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "employer_slug" => "",
                "page_description" => "",
                "page_type" => "",
                "page_title" => "",
                "pattern" => "/[^\pN\pL]+/u",
                "slug" => "",
                "ndawoni_slug" => "",
                "onjani_slug" => "",
                "experience_slug" => "",
                "mfundo_slug" => "",
                "ngowantoni_slug" => "",
                "gama_le_company_err" => "",
                "province_err" => "",
                "ndawoni_pha_err" => "",
                "job_title_err" => "",
                "msebenzi_onjani_err" => "",
                "mfundo_err" => "",
                "experience_err" => "",
                "ngowantoni_err" => "",
                "requirements_err" => "",
                "responsibilities_err" => "",
                "apply_nge_website_err" => "",
                "apply_ngesandla_err" => "",
                "apply_nge_email_err" => "",
                "image_type_err" => "",
                "image_size_err" => "",
                "duplicate_job_err" => "",
                "jb_specification" => ""
            ];
            
            if ($data["closing_date"] === "") {
                $data["closing_date"] = "0000-00-00";
            }
            
            if ($data["gama_le_company"] == "Premier Foods") {
                $data["gama_le_company"] = "Premier";
            }
            
            if ($data["gama_le_company"] == "Perishable Products Export Control Board (PPECB)") {
                $data["gama_le_company"] = "Perishable Products Export Control Board";
            }
            
            //Validate data
            if (empty($data["gama_le_company"])) {
                $data["gama_le_company_err"] = "Kufuneka ufake igama le company.";
            } if ($data["gama_le_company"] === "Pioneer") {
                $data["gama_le_company"] = "Pioneer Foods";
            }
            if ($data["province"] == "Khetha") {
                $data["province_err"] = "Kufuneka ukhethe i-province";
            }
            if (empty($data["ndawoni"])) {
                $data["ndawoni_pha_err"] = "Ndawoni pha?";
            }
            if ($data["ndawoni"] == "Roodepoort") {
                $data["ndawoni"] = "Roodepoort, Johannesburg";
            }
            if ($data["ndawoni"] == "King Williams Town") {
                $data["ndawoni"] = "King William\'s Town";
            }
            if (empty($data["job_title"])) {
                $data["job_title_err"] = "Job title ithini";
            }
            if ($data["msebenzi_onjani"] == "Khetha") {
                $data["msebenzi_onjani_err"] = "Ngumsebenzi onjani lo?";
            }
            if ($data["mfundo"] == "Khetha") {
                $dta["mfundo_err"] = "Level yemfundo ithini";
            }
            if ($data["experience"] == "Khetha") {
                $data["experience_err"] = "Experience efunwayo ingakanani?";
            }
            if ($data["ngowantoni"] == "Khetha") {
                $data["ngowantoni_err"] = "Ngumsebenzi wantoni lo?";
            }
            if (empty($data["requirements"])) {
                $data["requirements_err"] = "Requirements zithini?";
            }
            if (empty($data["responsibilities"]))  {
                $data["responsibilities_err"] = "Responsibilities zithini?";
            }
            if (isset($data["apply_nge_website"]) && empty($data["apply_nge_website"])) {
                $data["apply_nge_website_err"] = "Sicela i-link";
            }
            if (isset($data["apply_ngesandla"]) && empty($data["apply_ngesandla"])) {
                $data["apply_ngesandla_err"] = "Sicela i-address";
            }
            if (isset($data["apply_nge_email"]) && empty($data["apply_nge_email"])) {
                $data["apply_nge_email_err"] = "Sicela i-email";
            }

            //Create employer slug
            $data["employer_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["gama_le_company"]));
            
            //Create slug for filtering by location/ndawoni
            $data["ndawoni_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["ndawoni"]));
            
            //Create slug for filtering by mfundo
            $data["mfundo_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["mfundo"]));
            
            //Create slug for filtering by experience
            $data["experience_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["experience"]));
            
            //Create slug for filtering by msebenzi onjani
            $data["onjani_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["msebenzi_onjani"]));
            
            //Create slug for filtering by ngowantoni
            $data["ngowantoni_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["ngowantoni"]));
            
            //Create province slug
            switch ($data["province"]) {
                case "Eastern Cape":
                    $data["province_slug"] = "easternCapeJobs";
                    break;
                case "Free State":
                    $data["province_slug"] = "freeStateJobs";
                    break;
                case "Gauteng":
                    $data["province_slug"] = "gautengJobs";
                    break;
                case "KwaZulu-Natal":
                    $data["province_slug"] = "kwaZuluNatalJobs";
                    break;
                case "Limpopo":
                    $data["province_slug"] = "limpopoJobs";
                    break;
                case "Mpumalanga":
                    $data["province_slug"] = "mpumalangaJobs";
                    break;
                case "North West":
                    $data["province_slug"] = "northWestJobs";
                    break;
                case "Northern Cape":
                    $data["province_slug"] = "northernCapeJobs";
                    break;
                case "Western Cape":
                    $data["province_slug"] = "westernCapeJobs";
                    break;
                case "Nationwide":
                    $data["province_slug"] = "nationwide";
            }

            //Create temp slug
            $data["slug"] = createSlug($data["gama_le_company"] . "-" . $data["job_title"] . "-" . $data["ndawoni"] . "-" . $data["province_slug"]);
            
            if (!empty($data["image_name"])) {
                $data["image_name"] = explode(".", $data["image_name"]);
                $data["image_name"] = $data["slug"] . "-" . time() . "." . $data["image_name"][1];

                //Validate image type
                if ($data["image_type"] != "image/jpg" || $data["image_type"] != "image/png") {
                    $data["image_type_err"] = "Type ye image yakho kufuneka ibe yi jpg or png";
                }
                
                //Validate image size
                if ($data["image_size"] > 2000000) {
                    $data["image_size_err"] = "Image yakho akufunekanga ibengaphezulu ko 2 MB";
                }
            }
                
            //If job exists and still active
            $results = $this->postModel->checkIfActive($data);
            foreach ($results as $result) {
                if (count($results) > 0) {
                    $data["duplicate_job_err"] = "ERROR";
                    $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                    $data["page_description"] = URLROOT . "Wufake Apha Umsebenzi";
                    $data["page_type"] = URLROOT . "website";
                    $data["page_url"] = URLROOT . "/" . $_GET["url"];
                    $data["page_title"] = URLROOT . "Wufake Apha Umsebenzi";
                    error("message_yomsebenzi", "Ukhona umsebenzi ofana nalo. Ixesha lawo alikaphelelwa. <a target='_blank' href='" . URLROOT . "/" . $result->province_slug . "/umsebenzi/" . $result->slug ."'>Wujonge apha</a>.");
                }
            }
            $results = $this->postModel->checkSlug($data);
            
            //Check if temp slug exists
            if ($results->count > 0) {  
                $data["slug"] = $data["slug"] . "-" . $results->count;
            }

            if (!empty($data["image_name"])) {
                $data["image_name"] = $data["slug"];
            }
            
            //Make sure there are no errors
            if (empty($data["gama_le_company_err"]) && empty($data["province_err"]) && empty($data["ndawoni_pha_err"]) && empty($data["job_title_err"]) && empty($data["msebenzi_onjani_err"]) && empty($dta["mfundo_err"]) && empty($data["experience_err"]) && empty($data["ngowantoni_err"]) && empty($data["requirements_err"]) && empty($data["responsibilities_err"]) && empty( $data["duplicate_job_err"])) {
                
                //Move temp image
                move_uploaded_file($data["tmp_name"], $data["dir"] . $data["image_name"]);
                
                //Validated
                if ($this->postModel->addJob($data)) {
                    flash("message_yomsebenzi", "Umsebenzi wakho ungenile");
                    redirect("");
                    
                } else {
                    die("Ikhona into erongo");
                }
            } else {
                    //Load the view with errors
                    $data["page_title"] = "ERROR";
                    error("message_yomsebenzi", "Ikhona into erongo. Please double check akho mistake oyenzileyo.");
                    $this->view("addJobs/add", $data);
                }
                
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
            
            /*************************************************** 
            *                                                  *
            * Insert jobs from Gray Link xml feed on page load *
            *                                                  *
            ****************************************************/
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    
            $url = "https://www.recruitwave.com/Feed.ashx?f=177&d=1";

            $xml = simplexml_load_file($url);
    
            foreach($xml->job as $item) {
                $company = trim($item->company);
                $title = trim($item->title);
                $country = trim($item->country);
                $province = trim($item->province);
                $city = trim($item->city);
                $ngowantoni = trim($item->category);
                $onjani = trim($item->classification_type);
                $url = trim($item->url);
                $description = trim($item->description);
                $ngowantoni = trim($item->category);
                $job_type = trim($item->jobtype);
    
                //Determine closing date after 7 days
                $now = date("Y-m-d"); 
                $closing_date = date("Y-m-d", strtotime($now . " + 7 days"));
    
                if ($onjani == "Permanent" || $item->jobtype == "Permanent" || $item->jobtype == "Talent Pool") {
                    $onjani = "Full-Time";
                } elseif ($item->jobtype == "Learnerships") {
                    $onjani = "Learnership";
                }
                if ($url == "https://unitrans.erecruit.co/candidateapp/Jobs/View/UNI210622-1") {
                    $city = "Mobeni, Durban";
                    $ngowantoni = "General Work";
                }
                if (isset($item->state)) {

                    $province = trim($item->state);

                } if ($province == "North-West") {

                    $province = "North West";
                } if ($title == "ASP.NET Developer") {

                    $ngowantoni = "IT";

                } if ($title == "Pharmacy Manager - Amalinda") {
                    $title = "Pharmacy Manager";
                    $city = "Amalinda, East London";
                    $ngowantoni = "Pharmacy";

                }

                if ($title == "Recruitment Officer ( Temporary position )") {
                    $title = "Recruitment Officer (Temporary position)";
                    $onjani = "Contract";
                    $ngowantoni = "Human Resources";

                }
                 if ($title == "Pharmacist Assistant (Post-Basic) - Eerste River" || $city == "Eerste River") {
                    $city = "Eerste River, Cape Town";
                    $title = "Pharmacist Assistant (Post-Basic)";
                    $ngowantoni = "Pharmacy";
                }
                if ($title == "Pharmacist's Assistant (Post-Basic) - Medirite Zevenwacht" || $city == "Kuils River") {
                   $city = "Kuils River, Cape Town";
                   $title = "Pharmacist Assistant (Post-Basic)";
                   $ngowantoni = "Pharmacy";
               }
                if ($company == "TB HIV Care" && $city == "Head Office") {
                    $city = "Adderley Street, Cape Town";
                }

                if ($city == "Hocraft") {
                    $city = "Fisantekraal, Cape Town";
                }
                
                if ($ngowantoni == "TEMPLATE PLACEHOLDER") {

                    $ngowantoni = "Logistics";

                }

                if ($city == "OR Tambo" || $city == "O.R. Tambo") {
                    $city = "OR Tambo District Municipality";
                }

                if ($city == "Bisho") {
                    $city = "Bhisho";
                }

                if ($city == "Port Elizabeth" || $city == "Lakeside") {
                    $city = "Gqeberha";
                }

                if ($title == "Pharmacist's Assistant (Post-Basic) - Medirite Moffet On Main") {
                    $city = "Charlo, Gqeberha";
                }

                if ($city == "Port Elizabeth, Phoenix and Elgin" || $city == "East London/ Queenstown/ Mthatha" || $city == "OR Tambo/Amathole/Chris Hani" || $city == "OR Tambo / Chris Hani / Amathole" || $city == "Eastern Cape" || $city == "Mthatha/Queenstown") {
                    $city = "Various Areas";
                }

                if ($city == "Cape Metro") {
                    $city = "Cape Town";
                }

                if ($city == "Midrand") {
                    $city = "Midrand, Johannesburg";
                }

                if ($city == "Bellville - Cape Town" || $city == "Cape Town - Bellville") {
                    $city = "Bellville, Cape Town";
                }

                if ($city == "Brackenfell" || $city == "Cape Town, Brackenfell" || $city == "Cape Town/Brackenfell") {
                    $city = "Brackenfell, Cape Town";
                }
                if ($title == "Operations Clerk II" && $city == "Cape Town") {
                    $city = "Brackenfell, Cape Town";
                }
                if ($title == "Transport Clerk - Transpharm (Bellville)" && $city == "Cape Town") {
                    $city = "Bellville, Cape Town";
                    $title == "Transport Clerk - Transpharm";
                }

                if ($city == "Retreat" || $title == "Customer Advisor - Retreat") {
                    $city = "Retreat, Cape Town";
                    $title = "Customer Advisor";
                    $ngowantoni = "Call Centre";
                }
                if($city == "Durban - Queen Nandi Drive") {
                    $city = "Durban";
                }
                if ($title == "Pharmacy Sales Assistant - MediRite Edendale Mall") {
                    $city = "Edendale, Pietermaritzburg";
                }
                
                if ($country == "South Africa" || $province != "Country Wide" || $province != "National" || $province != "Not Applicable" || $province != "TEMPLATE PLACEHOLDER" || $province != "Various" || $city != "National" || $city != "Nationwide")) {
                    $data = [
                    "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                    "page_description" => "Wufake Apha Umsebenzi",
                    "page_type" => "website",
                    "page_url" => URLROOT . "/" . $_GET["url"],
                    "page_title" => "Wufake Apha Umsebenzi",
                    "gama_le_company" => filter_var($company, FILTER_SANITIZE_STRING),
                    "id_yomntu" => 2055,
                    "province" => filter_var($province, FILTER_SANITIZE_STRING),
                    "province_slug" => "",
                    "ndawoni" => filter_var($city, FILTER_SANITIZE_STRING),
                    "job_title" => filter_var($title, FILTER_SANITIZE_STRING),
                    "label" => filter_var($company, FILTER_SANITIZE_STRING) . " " . filter_var($title, FILTER_SANITIZE_STRING) . " " . filter_var($city, FILTER_SANITIZE_STRING),
                    "closing_date" => $closing_date,
                    "msebenzi_onjani" => filter_var($onjani, FILTER_SANITIZE_STRING),
                    "mfundo" => null,
                    "experience" => filter_var($title, FILTER_SANITIZE_STRING),
                    "ngowantoni" => filter_var($ngowantoni, FILTER_SANITIZE_STRING),
                    "employer_slug" => "",
                    "requirements" => "",
                    "purpose" => "",
                    "skills_competencies" => "",
                    "responsibilities" => "",
                    "additional_info" => "",
                    "jb_specification" => $description,
                    "apply_nge_website" => filter_var($url, FILTER_SANITIZE_STRING),
                    "apply_ngesandla" => "",
                    "apply_nge_email" => "",
                    "image_name" => "",
                    "image_size" => "",
                    "image_type" => "",
                    "tmp_name" => "",
                    "dir" => "",
                    "pattern" => "/[^\pN\pL]+/u",
                    "slug" => "",
                    "ndawoni_slug" => "",
                    "onjani_slug" => "",
                    "experience_slug" => "",
                    "mfundo_slug" => "",
                    "ngowantoni_slug" => ""
                    ];
                
                    $data["employer_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["gama_le_company"]));
                    
                    //Validate data
    
                    
                    //Create slug for filtering by location/ndawoni
                    $data["ndawoni_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["ndawoni"]));
                    
                    //Create slug for filtering by mfundo
                    $data["mfundo_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["mfundo"]));
                    
                    //Create slug for filtering by experience
                    $data["experience_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["experience"]));
                    
                    //Create slug for filtering by msebenzi onjani
                    $data["onjani_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["msebenzi_onjani"]));
                    
                    //Create slug for filtering by ngowantoni
                    $data["ngowantoni_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["ngowantoni"]));
                    
                    //Create province slug
                    switch ($data["province"]) {
                        case "Eastern Cape":
                            $data["province_slug"] = "easternCapeJobs";
                            break;
                        case "Free State":
                            $data["province_slug"] = "freeStateJobs";
                            break;
                        case "Gauteng":
                            $data["province_slug"] = "gautengJobs";
                            break;
                        case "KwaZulu-Natal":
                            $data["province_slug"] = "kwaZuluNatalJobs";
                            break;
                        case "Limpopo":
                            $data["province_slug"] = "limpopoJobs";
                            break;
                        case "Mpumalanga":
                            $data["province_slug"] = "mpumalangaJobs";
                            break;
                        case "North West":
                            $data["province_slug"] = "northWestJobs";
                            break;
                        case "Northern Cape":
                            $data["province_slug"] = "northernCapeJobs";
                            break;
                        case "Western Cape":
                            $data["province_slug"] = "westernCapeJobs";
                            break;
                        case "Nationwide":
                            $data["province_slug"] = "nationwideJobs";
                    }
                        
                    //If job exists and still active
                    $results = $this->postModel->checkIfActive($data);
                    die(var_dump($results));
                    
                    if (count($results) === 0) {
                        
                        //Create temp slug
                        $data["slug"] = createSlug($data["gama_le_company"] . "-" . $data["job_title"] . "-" . $data["ndawoni"] . "-" . $data["province_slug"]);
                            
                        $results = $this->postModel->checkSlug($data);
                        
                        //Check if temp slug exists
                        if ($results->count > 0) {
                                
                                $data["slug"] = $data["slug"] . "-" . $results->count;
                        }
                        $this->postModel->addJob($data);
                       
                    }
                }
            }
            $data["job_title"] = "";
            $data["gama_le_company"] = "";
            $data["province"] = "";
            $data["ndawoni"] = "";
            $data["msebenzi_onjani"] = "";
            $data["mfundo"] = "";
            $data["closing_date"] = "";
            $data["ngowantoni"] = "";
            $data["experience"] = "";
            $data["apply_nge_website"] = "";
            $data["apply_ngesandla"] = "";
            $data["apply_nge_email"] = "";
            $this->view("addJobs/add", $data);
            
        }
    }
}
 ?>