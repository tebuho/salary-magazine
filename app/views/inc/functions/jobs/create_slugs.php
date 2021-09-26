<?php
/**
 * Create slugs
 *
 * @param array $data 
 * 
 * @return void
 */
function Create_slugs($data) {
    
    switch ($data["job_province"]) 
    {      
    case "Eastern Cape":
        $data["job_province_slug"] = "easternCapeJobs";
        break;
    case "Free State":
        $data["job_province_slug"] = "freeStateJobs";
        break;
    case "Gauteng":
        $data["job_province_slug"] = "gautengJobs";
        break;
    case "KwaZulu-Natal":
        $data["job_province_slug"] = "kwaZuluNatalJobs";
        break;
    case "Limpopo":
        $data["job_province_slug"] = "limpopoJobs";
        break;
    case "Mpumalanga":
        $data["job_province_slug"] = "mpumalangaJobs";
        break;
    case "North West":
        $data["job_province_slug"] = "northWestJobs";
        break;
    case "Northern Cape":
        $data["job_province_slug"] = "northernCapeJobs";
        break;
    case "Western Cape":
        $data["job_province_slug"] = "westernCapeJobs";
        break;
    case "Nationwide":
        $data["job_province_slug"] = "nationwide";
    }

    //Create temp slug
    $data["job_slug_temp"] = createSlug(
        $data["job_employer"] . "-" . 
        $data["job_title"] . "-" . 
        $data["job_location"] . "-" . 
        $data["job_province_slug"]
    );
    
    if (!empty($data["image_name"])) {
        $data["image_name"] = explode(".", $data["image_name"]);
        $data["image_name"] = $data["job_slug_temp"] . "-" . 
        time() . "." . $data["image_name"][1];

        if ($data["image_type"] != "image/jpg" 
            || $data["image_type"] != "image/png"
        ) {
            $data["image_type_err"] 
                = "Type ye image yakho kufuneka ibe yi jpg or png";
        }
        
        if ($data["image_size"] > 2000000) {
            $data["image_size_err"] 
                = "Image yakho akufunekanga ibengaphezulu ko 2 MB";
        }
    }
    $model = new addJob();
    // how many identical job_num_posts in the db
    $results = $model->checkSlug($data);
    
    if ($results->count > 0) {  
        $data["job_slug"] = $data["job_slug"] . "-" . $results->count;
    }

    if (!empty($data["image_name"])) {
        $data["image_name"] = $data["job_slug"];
    }

    return $data;
 }
?>