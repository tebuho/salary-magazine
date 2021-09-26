<?php
/**
 * Show error message
 *
 * @param array $data 
 * 
 * @return array
 */
function Error_exists($data)
{
    
    $view = new addJobs();
    if (!empty($data["job_title_err"])
        || !empty($data["job_num_posts_err"]) 
        || !empty($data["job_employer_err"])
        || !empty($data["job_employer_type_err"])
        || !empty($data["job_province_err"]) 
        || !empty($data["job_location_err"]) 
        || !empty($data["job_type_err"]) 
        || !empty($data["job_education_err"]) 
        || !empty($data["job_experience_err"]) 
        || !empty($data["job_category_err"]) 
        || !empty($data["job_requirements_err"]) 
        || !empty($data["job_responsibilities_err"])
        || !empty($data["job_drivers_license_err"]) 
        || !empty($data["job_afrikaans_required_err"]) 
        || !empty($data["job_facebook_post_err"]) 
        || !empty($data["job_application_method_err"]) 
        || !empty($data["duplicate_job_err"])
    ) {
        
        $data["page_title"] = $data["duplicate_job_err"];

        error("message_yomsebenzi", "Ikhona into erongo. Please double check akho mistake oyenzileyo.");
        return $view->view("addJobs/add", $data);
    }
    return $data;
}
?>