<?php
/**
 * Insert into db
 *
 * @param array $data 
 * 
 * @return void
 */
function Insert_New_job($data)
{
    
    $model = new addJob();

    if (!empty($data)) {
        //Move temp image
        move_uploaded_file(
            $data["tmp_name"], 
            $data["dir"] . 
            $data["image_name"]
        );

        //Validated
        if ($model->addJob($data)) {
            
            flash("message_yomsebenzi", "Umsebenzi wakho ungenile");
            $recently_added_job = $model->getPostBySlug($data["job_slug"]);
            $data["new_job_id"] = $recently_added_job->id;
            $job_province_slug = $recently_added_job->job_province_slug;
            $job_url = $recently_added_job->job_province_slug
                . "/umsebenzi/". $recently_added_job->job_slug;

            Insert_Relational_data($data);
            
            redirect($job_url);
        } else {
            die("Ikhona into erongo");
        }
    }
}
?>