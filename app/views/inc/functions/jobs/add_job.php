<?php
function create_province_slug($province, $province_slug) 
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
function correct_employer($employer)
{
    if ($employer == "Premier Foods") {
        $employer = "Premier";
    }
    
    if ($employer == "Perishable Products Export Control Board (PPECB)") {
        $employer = "Perishable Products Export Control Board";
    }
    
    //Validate data
    if (empty($employer)) {
        $data["gama_le_company_err"] = "Kufuneka ufake igama le company.";
    } if ($employer === "Pioneer") {
        $employer = "Pioneer Foods";
    }
    return $employer;
}
function correct_location($location, $location_err)
{
    if (empty($location)) {
        return $data["ndawoni_pha_err"] = "Ndawoni pha?";
    }
    if ($location == "Roodepoort") {
        $location = "Roodepoort, Johannesburg";
    }
    if ($location == "King Williams Town") {
        $location = "King William's Town";
    }
    return $location;
}

function validate_form_input(
    $closing_date,
    $province,
    $province_err,
    $job_title,
    $job_title_err,
    $msebenzi_onjani,
    $msebenzi_onjani_err,
    $mfundo,
    $mfundo_err,
    $experience,
    $experience_err,
    $ngowantoni,
    $ngowantoni_err,
    $employer_type,
    $employer_type_err,
    $requirements,
    $requirements_err,
    $responsibilities,
    $responsibilities_err,
    $apply_nge_website,
    $apply_nge_website_err,
    $apply_ngesandla,
    $apply_ngesandla_err,
    $apply_nge_email,
    $apply_nge_email_err
)
{
            
    if ($closing_date === "") {
        $closing_date = "0000-00-00";
    }
    if ($province == "Khetha") {
        $province_err = "Kufuneka ukhethe i-province";
    }
    
    if ($employer_type == "Khetha") {
        $employer_type_err = "Employer type?";
    }
    if (empty($job_title)) {
        $job_title_err = "Job title ithini";
    }
    if ($msebenzi_onjani == "Khetha") {
        $msebenzi_onjani_err = "Ngumsebenzi onjani lo?";
    }
    if ($mfundo == "Khetha") {
        $mfundo_err = "Level yemfundo ithini";
    }
    if ($experience == "Khetha") {
        $experience_err = "Experience efunwayo ingakanani?";
    }
    if ($ngowantoni == "Khetha") {
        $ngowantoni_err = "Ngumsebenzi wantoni lo?";
    }
    if (empty($requirements)) {
        $requirements_err = "Requirements zithini?";
    }
    if (empty($responsibilities)) {
        $responsibilities_err = "Responsibilities zithini?";
    }
    if (isset($apply_nge_website) && empty($apply_nge_website)) {
        $apply_nge_website_err = "Sicela i-link";
    }
    if (isset($apply_ngesandla) && empty($apply_ngesandla)) {
        $apply_ngesandla_err = "Sicela i-address";
    }
    if (isset($apply_nge_email) && empty($apply_nge_email)) {
        $apply_nge_email_err = "Sicela i-email";
    }
    return [
        "closing_date" => $closing_date,
        "province"=> $province,
        "province_err" => $province_err,
        "job_title_err" => $job_title_err,
        "msebenzi_onjani_err" => $msebenzi_onjani_err,
        "mfundo_err" => $mfundo_err,
        "experience_err" => $experience_err,
        "ngowantoni_err" => $ngowantoni_err,
        "employer_type_err" => $employer_type_err,
        "requirements_err" => $requirements_err,
        "responsibilities_err" => $responsibilities_err,
        "apply_nge_website_err" => $apply_nge_website_err,
        "apply_ngesandla_err" => $apply_ngesandla_err,
        "apply_nge_email_err" => $apply_nge_email_err
    ];
}
?>