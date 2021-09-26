<?php
/**
 * Insert relational data
 *
 * @param array $data 
 * 
 * @return void
 */
function Insert_Relational_data($data)
{
    $model = new addJob();
    // insert into additional info table
    if (!empty($data["job_duration"])) {
        $model->addJobDuration($data);
    }

    // insert into additional info table
    if (!empty($data["job_additional_info"])) {
        $model->addJobAdditionalInfo($data);
    }

    // insert into additional info table
    if (!empty($data["job_centre"])) {
        $model->addJobCentre($data);
    }

    // insert into additional info table
    if (!empty($data["job_email_application"])) {
        $model->addEmailApplicationAddress($data);
    }

    // insert into additional info table
    if (!empty($data["job_for_attention"])) {
        $model->addJobForAttentionContact($data);
    }
    
    // insert into editatble forms table
    if (!empty($data["job_editable_form"])) {
        $model->addJobEditableForm($data);
    }
    
    // insert into non editatble forms table
    if (!empty($data["job_non_editable_form"])) {
        $model->addJobNonEditableForm($data);
    }
    
    // insert into job enquiries table
    if (!empty($data["job_enquiries"])) {
        $model->addJobEnquiries($data);
    }
    
    // insert into full job documents table
    if (!empty($data["job_full_vacancy"])) {
        $model->addJobFullDocument($data);
    }
    
    // insert into job hand deliver table
    if (!empty($data["job_hand_application"])) {
        $model->addJobHandApplications($data);
    }
    
    // insert job postal address
    if (!empty($data["job_postal_application"])) {
        $model->addJobPostalAddress($data);
    }
    
    // insert job purpose
    if (!empty($data["job_purpose"])) {
        $model->addJobPurpose($data);
    }
    
    // insert ref no
    if (!empty($data["job_ref_no"])) {
        $model->addJobRefNo($data);
    }
    
    // insert job remuneration
    if (!empty($data["job_remuneration"])) {
        $model->addJobRemuneration($data);
    }
    
    // insert job screenshot
    if (!empty($data["job_screenshot"])) {
        $model->addJobScreenshot($data);
    }
    
    // insert skills and competencies
    if (!empty($data["job_skills_competencies"])) {
        $model->addJobSkillsRequired($data);
    }
    
    // insert url to apply on
    if (!empty($data["job_apply_url"])) {
        $model->addJobWebUrl($data);
    }
    return $model;
}
?>