<?php
/*************************************************** 
            *                                                  *
            * Insert jobs from Gray Link xml feed on page load *
            *                                                  *
            ****************************************************/
            // $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    
            // $url = "https://www.recruitwave.com/Feed.ashx?f=177&d=1";

            // $xml = simplexml_load_file($url);
    
            // foreach($xml->job as $item) {
            //     $company = trim($item->company);
            //     $title = trim($item->title);
            //     $country = trim($item->country);
            //     $province = trim($item->province);
            //     $city = trim($item->city);
            //     $job_category = trim($item->job_category);
            //     $onjani = trim($item->classification_type);
            //     $url = trim($item->url);
            //     $description = trim($item->description);
            //     $job_category = trim($item->job_category);
            //     $job_type = trim($item->jobtype);
    
            //     //Determine closing date after 7 days
            //     $now = date("Y-m-d"); 
            //     $job_job_closing_date = date("Y-m-d", strtotime($now . " + 7 days"));
    
            //     if ($onjani == "Permanent"
            //         || $item->jobtype == "Permanent"
            //         || $item->jobtype == "Talent Pool"
            //     )
            //     {
            //         $onjani = "Full-Time";
            //     } elseif ($item->jobtype == "Learnerships") {
            //         $onjani = "Learnership";
            //     }
            //     if ($url == "https://unitrans.erecruit.co/candidateapp/Jobs/View/UNI210622-1") {
            //         $city = "Mobeni, Durban";
            //         $job_category = "General Work";
            //     }
            //     if (isset($item->state)) {
            //         $province = trim($item->state);
            //     }
                
            //     if ($province == "North-West") {
            //         $province = "North West";
            //     }
                
            //     if ($title == "ASP.NET Developer") {
            //         $job_category = "IT";
            //     } if ($title == "Pharmacy Manager - Amalinda") {
            //         $title = "Pharmacy Manager";
            //         $city = "Amalinda, East London";
            //         $job_category = "Pharmacy";
            //     }

            //     if ($title == "Recruitment Officer ( Temporary position )") {
            //         $title = "Recruitment Officer (Temporary position)";
            //         $onjani = "Contract";
            //         $job_category = "Human Resources";

            //     }
                
            //     if ($title == "Pharmacist Assistant (Post-Basic) - Eerste River"
            //         || $city == "Eerste River"
            //     ) {
            //         $city = "Eerste River, Cape Town";
            //         $title = "Pharmacist Assistant (Post-Basic)";
            //         $job_category = "Pharmacy";
            //     }
            //     if ($title == "Pharmacist's Assistant (Post-Basic) - Medirite Zevenwacht"
            //         || $city == "Kuils River"
            //     ) {
            //         $city = "Kuils River, Cape Town";
            //         $title = "Pharmacist Assistant (Post-Basic)";
            //         $job_category = "Pharmacy";
            //     }
            //     if ($company == "TB HIV Care" && $city == "Head Office") {
            //         $city = "Adderley Street, Cape Town";
            //     }

            //     if ($city == "Hocraft") {
            //         $city = "Fisantekraal, Cape Town";
            //     }
                
            //     if ($job_category == "TEMPLATE PLACEHOLDER") {
            //         $job_category = "Logistics";
            //     }

            //     if ($city == "OR Tambo" || $city == "O.R. Tambo") {
            //         $city = "OR Tambo District Municipality";
            //     }

            //     if ($city == "Bisho") {
            //         $city = "Bhisho";
            //     }

            //     if ($city == "Port Elizabeth" || $city == "Lakeside") {
            //         $city = "Gqeberha";
            //     }

            //     if ($title == "Pharmacist's Assistant (Post-Basic) - Medirite Moffet On Main") {
            //         $city = "Charlo, Gqeberha";
            //     }

            //     if ($city == "Port Elizabeth, Phoenix and Elgin"
            //         || $city == "East London/ Queenstown/ Mthatha"
            //         || $city == "OR Tambo/Amathole/Chris Hani"
            //         || $city == "OR Tambo / Chris Hani / Amathole"
            //         || $city == "Eastern Cape"
            //         || $city == "Mthatha/Queenstown"
            //     ) {
            //         $city = "Various Areas";
            //     }

            //     if ($city == "Cape Metro") {
            //         $city = "Cape Town";
            //     }

            //     if ($city == "Midrand") {
            //         $city = "Midrand, Johannesburg";
            //     }

            //     if ($city == "Bellville - Cape Town" 
            //         || $city == "Cape Town - Bellville"
            //     ) {
            //         $city = "Bellville, Cape Town";
            //     }

            //     if ($city == "Brackenfell"
            //         || $city == "Cape Town, Brackenfell"
            //         || $city == "Cape Town/Brackenfell"
            //     ) {
            //         $city = "Brackenfell, Cape Town";
            //     }

            //     if ($title == "Operations Clerk II"
            //         && $city == "Cape Town"
            //     ) {
            //         $city = "Brackenfell, Cape Town";
            //     }

            //     if ($title == "Transport Clerk - Transpharm (Bellville)"
            //         && $city == "Cape Town"
            //     ) {
            //         $city = "Bellville, Cape Town";
            //         $title == "Transport Clerk - Transpharm";
            //     }

            //     if ($city == "Retreat"
            //         || $title == "Customer Advisor - Retreat"
            //     ) {
            //         $city = "Retreat, Cape Town";
            //         $title = "Customer Advisor";
            //         $job_category = "Call Centre";
            //     }

            //     if ($city == "Durban - Queen Nandi Drive") {
            //         $city = "Durban";
            //     }

            //     if ($title == "Pharmacy Sales Assistant - MediRite Edendale Mall") {
            //         $city = "Edendale, Pietermaritzburg";
            //     }
                
            //     if ($country == "South Africa"
            //         || $province != "Country Wide"
            //         || $province != "National"
            //         || $province != "Not Applicable"
            //         || $province != "TEMPLATE PLACEHOLDER"
            //         || $province != "Various" 
            //         || $city != "National"
            //         || $city != "Nationwide"
            //     ) {
            //         $data = [
            //         "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
            //         "page_description" => "Wufake Apha Umsebenzi",
            //         "page_type" => "website",
            //         "page_url" => URLROOT . "/" . $_GET["url"],
            //         "page_title" => "Wufake Apha Umsebenzi",
            //         "job_employer" => filter_var($company, FILTER_SANITIZE_STRING),
            //         "user_id" => 2055,
            //         "province" => filter_var($province, FILTER_SANITIZE_STRING),
            //         "province_slug" => "",
            //         "job_location" => filter_var($city, FILTER_SANITIZE_STRING),
            //         "job_title" => filter_var($title, FILTER_SANITIZE_STRING),
            //         "label" => filter_var($company, FILTER_SANITIZE_STRING) . " " . filter_var($title, FILTER_SANITIZE_STRING) . " " . filter_var($city, FILTER_SANITIZE_STRING),
            //         "job_closing_date" => $job_job_closing_date,
            //         "job_type" => filter_var($onjani, FILTER_SANITIZE_STRING),
            //         "job_education" => null,
            //         "experience" => filter_var($title, FILTER_SANITIZE_STRING),
            //         "category" => filter_var($job_category, FILTER_SANITIZE_STRING),
            //         "job_employer_slug" => "",
            //         "job_requirements" => "",
            //         "job_purpose" => "",
            //         "job_skills_competencies" => "",
            //         "job_responsibilities" => "",
            //         "job_additional_info" => "",
            //         "jb_specification" => $description,
            //         "job_web_application" => filter_var($url, FILTER_SANITIZE_STRING),
            //         "job_hand_application" => "",
            //         "job_email_application" => "",
            //         "image_name" => "",
            //         "image_size" => "",
            //         "image_type" => "",
            //         "tmp_name" => "",
            //         "dir" => "",
            //         "pattern" => "/[^\pN\pL]+/u",
            //         "job_slug" => "",
            //         "job_location_slug" => "",
            //         "job_type_slug" => "",
            //         "experience_slug" => "",
            //         "job_education_slug" => "",
            //         "job_category_slug" => ""
            //         ];
                
            //         $data["job_employer_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["job_employer"]));
                    
            //         //Validate data
    
                    
            //         //Create slug for filtering by job_location/job_location
            //         $data["job_location_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["job_location"]));
                    
            //         //Create slug for filtering by job_education
            //         $data["job_education_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["job_education"]));
                    
            //         //Create slug for filtering by experience
            //         $data["experience_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["experience"]));
                    
            //         //Create slug for filtering by msebenzi onjani
            //         $data["job_type_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["job_type"]));
                    
            //         //Create slug for filtering by category
            //         $data["job_category_slug"] = strtolower(preg_replace($data["pattern"], "-", $data["category"]));
                    
            //         //Create province slug
            //         switch ($data["province"]) {
            //             case "Eastern Cape":
            //                 $data["province_slug"] = "easternCapeJobs";
            //                 break;
            //             case "Free State":
            //                 $data["province_slug"] = "freeStateJobs";
            //                 break;
            //             case "Gauteng":
            //                 $data["province_slug"] = "gautengJobs";
            //                 break;
            //             case "KwaZulu-Natal":
            //                 $data["province_slug"] = "kwaZuluNatalJobs";
            //                 break;
            //             case "Limpopo":
            //                 $data["province_slug"] = "limpopoJobs";
            //                 break;
            //             case "Mpumalanga":
            //                 $data["province_slug"] = "mpumalangaJobs";
            //                 break;
            //             case "North West":
            //                 $data["province_slug"] = "northWestJobs";
            //                 break;
            //             case "Northern Cape":
            //                 $data["province_slug"] = "northernCapeJobs";
            //                 break;
            //             case "Western Cape":
            //                 $data["province_slug"] = "westernCapeJobs";
            //                 break;
            //             case "Nationwide":
            //                 $data["province_slug"] = "nationwideJobs";
            //         }
                        
            //         //If job exists and still active
            //         $results = $this->postModel->checkIfActive($data);
                    
            //         if (count($results) === 0) {
                        
            //             //Create temp slug
            //             $data["job_slug"] = createSlug($data["job_employer"] . "-" . $data["job_title"] . "-" . $data["job_location"] . "-" . $data["province_slug"]);
                            
            //             $results = $this->postModel->checkSlug($data);
                        
            //             //Check if temp slug exists
            //             if ($results->count > 0) {
                                
            //                     $data["job_slug"] = $data["job_slug"] . "-" . $results->count;
            //             }
            //             $this->postModel->addJob($data);
                       
            //         }
            //     }
            // }
?>