<?php
/**
 * Creates a slug for each province
 *
 * @param string $province 
 * @param string $province_slug 
 * 
 * @return string
 */
function Create_Province_slug($province, $province_slug) 
{
    //Create province slug
    switch ($province) {
        case "Eastern Cape":
            return $province_slug = "easternCapeJobs";
            break;
        case "Free State":
            return $province_slug = "freeStateJobs";
            break;
        case "Gauteng":
            return $province_slug = "gautengJobs";
            break;
        case "KwaZulu-Natal":
            return $province_slug = "kwaZuluNatalJobs";
            break;
        case "Limpopo":
            return $province_slug = "limpopoJobs";
            break;
        case "Mpumalanga":
            return $province_slug = "mpumalangaJobs";
            break;
        case "North West":
            return $province_slug = "northWestJobs";
            break;
        case "Northern Cape":
            return $province_slug = "northernCapeJobs";
            break;
        case "Western Cape":
            return $province_slug = "westernCapeJobs";
            break;
        case "Nationwide":
            return $province_slug = "nationwide";
    }
}

/**
 * Corrects location provided by user
 *
 * @param string $location 
 * @param string $location_err 
 * 
 * @return string
 */
function Correct_location($location, $location_err)
{
    if (empty($location)) {
        return $location_err = "Location?";
    }
    if ($location == "Roodepoort") {
        $location = "Roodepoort, Johannesburg";
    }
    if ($location == "King Williams Town") {
        $location = "King William's Town";
    }
    return $location;
}

/**
 * Validates form fields and returns error messages
 *
 * @param string $closing_date 
 * @param string $province 
 * @param string $province_err 
 * @param string $job_title 
 * @param string $job_title_err 
 * @param string $employer 
 * @param string $employer_err 
 * @param int    $posts 
 * @param string $posts_err 
 * @param string $msebenzi_onjani 
 * @param string $job_type_err 
 * @param string $mfundo 
 * @param string $job_education_err 
 * @param string $experience 
 * @param string $experience_err 
 * @param string $ngowantoni 
 * @param string $job_category_err 
 * @param string $employer_type 
 * @param string $employer_type_err 
 * @param string $requirements 
 * @param string $requirements_err 
 * @param string $responsibilities 
 * @param string $responsibilities_err 
 * @param string $apply_nge_website 
 * @param string $job_web_application_err 
 * @param string $apply_ngesandla 
 * @param string $job_hand_application_err 
 * @param string $apply_nge_email 
 * @param string $job_email_application_err 
 * 
 * @return array
 */
function Validate_Form_input(
    $closing_date,
    $province,
    $province_err,
    $job_title,
    $job_title_err,
    $employer,
    $employer_err,
    $posts,
    $posts_err,
    $msebenzi_onjani,
    $job_type_err,
    $mfundo,
    $job_education_err,
    $experience,
    $experience_err,
    $ngowantoni,
    $job_category_err,
    $employer_type,
    $employer_type_err,
    $requirements,
    $requirements_err,
    $responsibilities,
    $responsibilities_err,
    $apply_nge_website,
    $job_web_application_err,
    $apply_ngesandla,
    $job_hand_application_err,
    $apply_nge_email,
    $job_email_application_err
) {
    
    if ($closing_date === "") {
        $closing_date = "0000-00-00";
    }
    if ($province == "Khetha") {
        $province_err = "Select province";
    }
    
    if ($employer_type == "Khetha") {
        $employer_type_err = "Employer type?";
    }
    if (empty($job_title)) {
        $job_title_err = "Job title ithini";
    }
    if (empty($employer)) {
        $employer_err = "Employer name?";
    }
    if (empty($posts)) {
        $posts_err = "How many posts?";
    }
    if ($msebenzi_onjani == "Khetha") {
        $job_type_err = "Ngumsebenzi onjani lo?";
    }
    if ($mfundo == "Khetha") {
        $job_education_err = "Level yemfundo ithini";
    }
    if ($experience == "Khetha") {
        $experience_err = "Experience efunwayo ingakanani?";
    }
    if ($ngowantoni == "Khetha") {
        $job_category_err = "Ngumsebenzi wantoni lo?";
    }
    if (empty($requirements)) {
        $requirements_err = "Requirements zithini?";
    }
    if (empty($responsibilities)) {
        $responsibilities_err = "Responsibilities zithini?";
    }
    if (isset($apply_nge_website) && empty($apply_nge_website)) {
        $job_web_application_err = "Sicela i-link";
    }
    if (isset($apply_ngesandla) && empty($apply_ngesandla)) {
        $job_hand_application_err = "Sicela i-address";
    }
    if (isset($apply_nge_email) && empty($apply_nge_email)) {
        $job_email_application_err = "Sicela i-email";
    }

    return [
        "closing_date" => $closing_date,
        "province"=> $province,
        "province_err" => $province_err,
        "job_title_err" => $job_title_err,
        "posts_err" => $posts_err,
        "employer_err" => $employer_err,
        "job_type_err" => $job_type_err,
        "job_education_err" => $job_education_err,
        "experience_err" => $experience_err,
        "job_category_err" => $job_category_err,
        "employer_type_err" => $employer_type_err,
        "requirements_err" => $requirements_err,
        "responsibilities_err" => $responsibilities_err,
        "job_web_application_err" => $job_web_application_err,
        "job_hand_application_err" => $job_hand_application_err,
        "job_email_application_err" => $job_email_application_err
    ];
}
?>