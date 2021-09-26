<?php
/**
 * Sanitize input data
 *
 * @param array $data 
 * 
 * @return array
 */
function Sanitize_data($data)
{
    $data = [
        "user_id" => $_SESSION["user_id"],
        "job_title" => trim(
            filter_input(
                INPUT_POST, 
                "job_title", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_title_err" => "",
        "job_num_posts" => filter_input(
            INPUT_POST, 
            "job_num_posts", 
            FILTER_SANITIZE_STRING
        ),
        "job_num_posts_err" => "",
        "job_employer" => trim(
            filter_input(
                INPUT_POST, 
                "job_employer", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_employer_slug" => "",
        "job_employer_err" => "",
        "job_employer_type" => filter_input(
            INPUT_POST, 
            "job_employer_type", 
            FILTER_SANITIZE_STRING
        ),
        "job_employer_type_err" => "",
        "job_province" => filter_input(
            INPUT_POST, 
            "job_province", 
            FILTER_SANITIZE_STRING
        ),
        "job_province_slug" => "",
        "job_province_err" => "",
        "job_location" => trim(
            filter_input(
                INPUT_POST, 
                "job_location",
                FILTER_SANITIZE_STRING
            )
        ),
        "job_location_slug" => "",
        "job_location_err" => "",
        "job_label" => trim(
            filter_input(
                INPUT_POST, 
                "job_employer", 
                FILTER_SANITIZE_STRING
            ) . " " . 
            filter_input(
                INPUT_POST, 
                "job_title", 
                FILTER_SANITIZE_STRING
            ) . " " . 
            filter_input(
                INPUT_POST, 
                "job_location", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_type" => filter_input(
            INPUT_POST, 
            "job_type", 
            FILTER_SANITIZE_STRING
        ),
        "job_type_slug" => "",
        "job_type_err" => "",
        "job_duration" => trim(
            filter_input(
                INPUT_POST,
                "job_duration",
                FILTER_SANITIZE_STRING
            )
        ),
        "job_duration_err" => "",
        "job_education" => filter_input(
            INPUT_POST, 
            "job_education", 
            FILTER_SANITIZE_STRING
        ),
        "job_education_slug" => "",
        "job_education_err" => "",
        "job_experience" => filter_input(
            INPUT_POST, 
            "experience", 
            FILTER_SANITIZE_STRING
        ),
        "job_experience_slug" => "",
        "job_experience_err" => "",
        "job_category" => filter_input(
            INPUT_POST, 
            "category", 
            FILTER_SANITIZE_STRING
        ),
        "job_category_slug" => "",
        "job_category_err" => "",
        "job_ref_no" => trim(
            filter_input(
                INPUT_POST, 
                "job_ref_no", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_centre" => trim(
            filter_input(
                INPUT_POST, 
                "job_centre", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_remuneration" => trim(
            filter_input(
                INPUT_POST, 
                "job_remuneration", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_drivers_license" => trim(
            filter_input(
                INPUT_POST, 
                "job_drivers_license", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_drivers_license_err" => "",
        "job_afrikaans_required" => filter_input(
            INPUT_POST, 
            "job_afrikaans_required", 
            FILTER_SANITIZE_STRING
        ),
        "job_afrikaans_required_err" => "",
        "job_facebook_post" => trim(
            filter_input(
                INPUT_POST, 
                "job_facebook_post", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_facebook_post_err" => "",
        "job_closing_date" => trim(
            filter_input(
                INPUT_POST, 
                "job_closing_date", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_purpose" => trim(
            htmlspecialchars($_POST["job_purpose"])
        ),
        "job_requirements" => trim(
            htmlspecialchars($_POST["job_requirements"])
        ),
        "job_requirements_err" => "",
        "job_skills_competencies" => trim(
            htmlentities($_POST["job_skills_competencies"])
        ),
        "job_responsibilities" => trim(
            htmlentities($_POST["job_responsibilities"])
        ),
        "job_responsibilities_err" => "",
        "job_additional_info" => trim(
            htmlentities($_POST["job_additional_info"])
        ),
        "job_web_application" => trim(
            urlencode($_POST["job_web_application"])
        ),
        "job_hand_application" => trim(
            htmlentities($_POST["job_hand_application"])
        ),
        "job_postal_application" => trim(
            htmlentities($_POST["job_postal_application"])
        ),
        "job_email_application" => trim(
            filter_input(
                INPUT_POST, 
                "job_email_application", 
                FILTER_SANITIZE_EMAIL
            )
        ),
        "job_application_method_err" => "",
        "job_enquiries" => trim(
            filter_input(
                INPUT_POST, 
                "job_enquiries", 
                FILTER_SANITIZE_STRING
            )
        ),
        "job_for_attention" => trim(
            filter_input(
                INPUT_POST,
                "job_for_attention",
                FILTER_SANITIZE_STRING
            )
        ),
        "job_editable_form" => trim(
            filter_input(
                INPUT_POST,
                "job_editable_form",
                FILTER_SANITIZE_STRING
            )
        ),
        "job_non_editable_form" => trim(
            filter_input(
                INPUT_POST,
                "job_non_editable_form",
                FILTER_SANITIZE_STRING
            )
        ),
        "job_full_vacancy" => trim(
            filter_input(
                INPUT_POST,
                "job_full_vacancy",
                FILTER_SANITIZE_URL
            )
        ),
        "image_name" => strip_tags(
            trim($_FILES["image"]["name"])
        ),
        "image_size" => trim($_FILES["image"]["size"]),
        "image_type" => trim($_FILES["image"]["type"]),
        "tmp_name" => trim($_FILES["image"]["tmp_name"]),
        "dir" => "/home/salarfng/public_html/public/img/imisebenzi/",
        "page_image" . "/public/img/western-cape-jobs/westernCapeJobs.png",
        "page_description" => "",
        "page_type" => "",
        "page_title" => "",
        "pattern" => "/[^\pN\pL]+/u",
        "job_slug" => "",
        "image_type_err" => "",
        "image_size_err" => "",
        "new_job_id" => "",
        "duplicate_job_err" => "",
    ];
    
    return $data;
}
?>