<?php
/**
 * Show message if job exists and active
 *
 * @param array $data 
 * 
 * @return array
 */
function Show_Job_exists($data) {
    $model = new addJob();

    $results = $model->checkIfActive($data);
    foreach ($results as $result) {
        if (count($results) > 0) {
            $data["duplicate_job_err"] = "ERROR";
            $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
            $data["page_description"] = URLROOT . "Wufake Apha Umsebenzi";
            $data["page_type"] = URLROOT . "website";
            $data["page_url"] = URLROOT . "/" . $_GET["url"];
            $data["page_title"] = URLROOT . "Wufake Apha Umsebenzi";

            $active_job_url 
                = URLROOT . "/" . $result->job_province_slug . "/umsebenzi/" . $result->job_slug;
            
            error(
                "message_yomsebenzi", 
                "Ukhona umsebenzi ofana nalo. Ixesha lawo alikaphelelwa. 
                <a target='_blank' href='" . $active_job_url ."'> 
                Wujonge apha</a>."
            );
        }
    }
    
    return $data;
}
?>