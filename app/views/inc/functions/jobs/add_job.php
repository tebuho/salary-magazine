<?php
/**
 * Creates a slug for each province
 *
 * @param string $province 
 * @param string $province_slug 
 * 
 * @return string
 */

/**
 * Validates form fields and returns error messages
 *
 * @param array $data 
 * 
 * @return array
 */
function Validate_Form_input($data) {
    
    if ($data["job_province"] == "Select") {
        $data["job_province_err"] = "Select province";
    }
    
    if (empty($data["job_location"])) {
        $data["job_location_err"] = "Location?";
    } else {
        if ($data["job_location"] == "Roodepoort") {
            $data["job_location"] = "Roodepoort, Johannesburg";
        }
        if ($data["job_location"] == "King Williams Town") {
            $data["job_location"] = "King William's Town";
        }
    }

    if ($data["job_employer_type"] == "Select") {
        $data["job_employer_type_err"] = "Select employer type?";
    }

    if (empty($data["job_title"])) {
        $data["job_title_err"] = "Job title ithini";
    }

    if (empty($data["job_employer"])) {
        $data["job_employer_err"] = "Employer name?";
    }

    if (empty($data["job_num_posts"])) {
        $data["job_num_posts_err"] = "How many posts?";
    }

    if ($data["job_type"] == "Select") {
        $data["job_type_err"] = "Select job type";
    }

    if ($data["job_type"] == "Contract" && empty($data["job_duration"])) {
        $data["job_duration_err"] = "Contract duration";
    }

    if ($data["job_education"] == "Select") {
        $data["job_education_err"] = "Education";
    }

    if ($data["job_experience"] == "Select") {
        $data["job_experience_err"] = "Select experience";
    }

    if ($data["job_category"] == "Select") {
        $data["job_category_err"] = "Select job category";
    }

    if ($data["job_drivers_license"] == "Select") {
        $data["job_drivers_license_err"] = "Select Yes or No";
    }

    if ($data["job_afrikaans_required"] == "Select") {
        $data["job_afrikaans_required_err"] = "Required";
    }

    if ($data["job_facebook_post"] == "Select") {
        $data["job_facebook_post_err"] = "Select Yes or No";
    }

    if ($data["job_closing_date"] === "") {
        $data["job_closing_date"] = "1970-01-01";
    }

    if (empty($data["job_requirements"])) {
        $data["job_requirements_err"] = "Requirements zithini?";
    }

    if (empty($data["job_responsibilities"])) {
        $data["job_responsibilities_err"] = "Responsibilities zithini?";
    }

    if (empty($data["job_web_application"]) 
        && empty($data["job_hand_application"]) 
        && empty($data["job_postal_application"]) 
        && empty($data["job_email_application"])
    ) {
        $data["application_method_err"] = "Provide application method";
    }

    //Create employer slug
    $data["job_employer_slug"] = strtolower(
        preg_replace(
            $data["pattern"], "-", $data["job_employer"]
        )
    );
    
    //Create slug for filtering by job_location/job_location
    $data["job_location_slug"] = strtolower(
        preg_replace(
            $data["pattern"], "-", $data["job_location"]
        )
    );
    
    //Create slug for filtering by job_education
    $data["job_education_slug"] = strtolower(
        preg_replace(
            $data["pattern"], "-", $data["job_education"]
        )
    );
    
    //Create slug for filtering by experience
    $data["job_experience_slug"] = strtolower(
        preg_replace(
            $data["pattern"], "-", $data["job_experience"]
        )
    );
    
    //Create slug for filtering by job type
    $data["job_type_slug"] = strtolower(
        preg_replace(
            $data["pattern"], "-", $data["job_type"]
        )
    );
    
    //Create slug for filtering by category
    $data["job_category_slug"] = strtolower(
        preg_replace(
            $data["pattern"], "-", $data["job_category"]
        )
    );

    return $data;
    
}
?>