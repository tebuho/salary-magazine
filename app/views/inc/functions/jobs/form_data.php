<?php
/**
 * Initiate form fields when empty
 *
 * @param array $data 
 * 
 * @return array
 */
function Init_Form_data($data)
{
    $data["page_image"] = "";
    $data["page_type"] = "website";
    $data["page_url"] = URLROOT . "/" . $_GET["url"];
    $data["page_title"] = "Add New Job";
    $data["job_title"] = "";
    $data["job_employer"] = "";
    $data["job_province"] = "";
    $data["job_location"] = "";
    $data["job_location_err"] = "";
    $data["job_type"] = "";
    $data["job_duration"] = "";
    $data["job_education"] = "";
    $data["job_closing_date"] = "";
    $data["job_category"] = "";
    $data["job_experience"] = "";
    $data["job_purpose"] = "";
    $data["job_requirements"] = "";
    $data["job_skills_competencies"] = "";
    $data["job_responsibilities"] = "";
    $data["job_additional_info"] = "";
    $data["job_web_application"] = "";
    $data["job_hand_application"] = "";
    $data["job_postal_application"] = "";
    $data["job_email_application"] = "";
    $data["job_employer_type"] = "";
    $data["job_remuneration"] = "";
    $data["job_centre"] = "";
    $data["job_drivers_license"] = "";
    $data["job_ref_no"] = "";
    $data["job_facebook_post"] = "";
    $data["job_num_posts"] = "";
    $data["job_afrikaans_required"] = "";
    $data["job_enquiries"] = "";
    $data["job_for_attention"] = "";
    $data["form"] = "";
    $data["job_full_vacancy"] = "";
    $data["job_editable_form"] = "";
    $data["job_non_editable_form"] = "";

    return $data;
}
?>