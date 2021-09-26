<?php
class addJob
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    /**
     * Check if job_slug exists
     */
    public function checkSlug($data)
    {
        $this->db->query(
            "SELECT COUNT(*) AS count FROM jobs WHERE job_label = :job_label AND job_province = :job_province"
        );
        $this->db->bind(':job_label', $data['job_label']);
        $this->db->bind(":job_province", $data['job_province']);
        $row = $this->db->single();
        return $row;
    }
    
    public function addJob($data)
    {
        $this->db->query(
            "INSERT INTO jobs (
                `user_id`,
                job_title,
                job_label,
                job_num_posts,
                job_employer,
                job_employer_slug,
                job_province,
                job_province_slug,
                job_location,
                job_location_slug,
                job_type,
                job_type_slug,
                job_education,
                job_education_slug,
                job_experience,
                job_experience_slug,
                job_category,
                job_category_slug,
                job_drivers_license,
                job_afrikaans_required,
                job_facebook_post,
                job_closing_date,
                job_requirements,
                job_responsibilities,
                job_slug,
                job_date_published
                ) VALUES (
                :user_id,
                :job_title,
                :job_label,
                :job_num_posts,
                :job_employer,
                :job_employer_slug,
                :job_province,
                :job_province_slug,
                :job_location,
                :job_location_slug,
                :job_type,
                :job_type_slug,
                :job_education,
                :job_education_slug,
                :job_experience,
                :job_experience_slug,
                :job_category,
                :job_category_slug,
                :job_drivers_license,
                :job_afrikaans_required,
                :job_facebook_post,
                :job_closing_date,
                :job_requirements,
                :job_responsibilities,
                :job_slug,
                :job_date_published
            )"
        );

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':job_label', $data['job_label']);
        $this->db->bind(":job_num_posts", $data['job_num_posts']);
        $this->db->bind(':job_employer', $data['job_employer']);
        $this->db->bind(':job_employer_slug', $data['job_employer_slug']); 
        $this->db->bind(':job_province', $data['job_province']);
        $this->db->bind(':job_province_slug', $data['job_province_slug']);
        $this->db->bind(":job_location", $data['job_location']);
        $this->db->bind(":job_location_slug", $data['job_location_slug']);
        $this->db->bind(':job_type', $data['job_type']);
        $this->db->bind(':job_type_slug', $data['job_type_slug']);
        $this->db->bind(':job_education', $data['job_education']);
        $this->db->bind(':job_education_slug', $data['job_education_slug']);
        $this->db->bind(':job_experience', $data['job_experience']);
        $this->db->bind(':job_experience_slug', $data['job_experience_slug']);
        $this->db->bind(':job_category', $data['job_category']);
        $this->db->bind(':job_category_slug', $data['job_category_slug']);
        $this->db->bind(':job_drivers_license', $data['job_drivers_license']);
        $this->db->bind(':job_afrikaans_required', $data['job_afrikaans_required']);
        $this->db->bind(':job_facebook_post', $data['job_facebook_post']);
        $this->db->bind(':job_closing_date', $data['job_closing_date']);
        $this->db->bind(':job_requirements', $data['job_requirements']);
        $this->db->bind(':job_responsibilities', $data['job_responsibilities']);
        $this->db->bind(':job_slug', $data['job_slug']);
        $this->db->bind(':job_date_published', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /************************************************************
     *                                                          *
     *              Check if job is still active                *
     *                                                          *
    *************************************************************/
    public function checkIfActive($data)
    {
        $this->db->query(
            "SELECT job_label, job_slug, job_province, job_province_slug, job_closing_date 
            FROM `jobs` 
            WHERE job_label = :job_label AND job_province = :job_province
            AND job_closing_date = '1970-01-01' 
            AND timestampdiff(day, job_date_published, CURDATE()) <= 7
            OR job_label = :job_label AND job_closing_date >= CURDATE() 
            AND job_province = :job_province"
        );
        $this->db->bind(":job_label", $data['job_label']);
        $this->db->bind(":job_province", $data['job_province']);
        $results = $this->db->resultSet();
        return $results;
    }

    public function updateJob($data)
    {
        $this->db->query(
            "UPDATE imisebenzi SET
                job_employer = :job_employer,
                job_employer_slug = :job_employer_slug,
                job_province = :job_province,
                job_location = :job_location,
                job_title = :job_title,
                job_closing_date = :job_closing_date,
                job_type = :job_type,
                job_education = :job_education,
                job_experience = :job_experience,
                job_category = :job_category,
                job_purpose = :job_purpose,
                job_requirements = :job_requirements,
                skills_competencies = :skills_competencies,
                job_responsibilities = :job_responsibilities,
                additional_info = :additional_info,
                apply_nge_website = :apply_nge_website, 
                created_at = :created_at,
                updated_at = :updated_at
                WHERE id = :id"
        );   
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':job_employer', $data['job_employer']);
        $this->db->bind(':job_employer_slug', $data['job_employer_slug']);
        $this->db->bind(':job_province', $data['job_province']);
        $this->db->bind(':job_location', $data['job_location']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':job_closing_date', $data['job_closing_date']);
        $this->db->bind(':job_type', $data['job_type']);
        $this->db->bind(':job_education', $data['job_education']);
        $this->db->bind(':job_experience', $data['job_experience']);
        $this->db->bind(':job_category', $data['job_category']);
        $this->db->bind(':job_purpose', $data['job_purpose']);
        $this->db->bind(':job_requirements', $data['job_requirements']);
        $this->db->bind(':skills_competencies', $data['skills_competencies']);
        $this->db->bind(':job_responsibilities', $data['job_responsibilities']);
        $this->db->bind(':additional_info', $data['additional_info']);
        $this->db->bind(':apply_nge_website', $data['apply_nge_website']);
        $this->db->bind(':created_at', date("Y-m-d H:i:s"));
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getPostBySlug($job_slug)
    {
        $this->db->query("SELECT * FROM jobs WHERE job_slug = :job_slug");
        $this->db->bind(':job_slug', $job_slug);

        $row = $this->db->single();
        return $row;
    }
    
    public function getUserById($id)
    {
        $this->db->query(
            "SELECT * FROM abantu WHERE id = :id"
        );
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    /**
     * Insert new job additional info into relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobDuration($data)
    {
        $this->db->query(
            "INSERT INTO `job_durations` (`job_id`, `job_duration`) 
            VALUES (:job_id, :job_duration)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_duration", $data["job_duration"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job additional info into relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobAdditionalInfo($data)
    {
        $this->db->query(
            "INSERT INTO `job_additional_info` (`job_id`, `job_additional_info`) 
            VALUES (:job_id, :job_additional_info)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_additional_info", $data["job_additional_info"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job additional info into relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobCentre($data)
    {
        $this->db->query(
            "INSERT INTO `job_centres` (`job_id`, `job_centre`) 
            VALUES (:job_id, :job_centre)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_centre", $data["job_centre"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job email application address
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addEmailApplicationAddress($data)
    {
        $this->db->query(
            "INSERT INTO `job_email_applications` (`job_id`, `job_email_application`) 
            VALUES (:job_id, :job_email_application)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_email_application", $data["job_email_application"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job contact to be sent to
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobForAttentionContact($data)
    {
        $this->db->query(
            "INSERT INTO `job_for_attentions` (`job_id`, `job_for_attention`) 
            VALUES (:job_id, :job_for_attention)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_for_attention", $data["job_for_attention"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job editable form into relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobEditableForm($data)
    {
        $this->db->query(
            "INSERT INTO `job_editable_forms` (`job_id`, `job_editable_form`) 
            VALUES (:job_id, :job_editable_form)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_editable_form", $data["job_editable_form"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job editable form into relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobNonEditableForm($data)
    {
        $this->db->query(
            "INSERT INTO `job_non_job_editable_forms` (`job_id`, `job_non_editable_form`) 
            VALUES (:job_id, :job_non_editable_form)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_non_editable_form", $data["job_non_editable_form"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job enquiries into relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobEnquiries($data)
    {
        $this->db->query(
            "INSERT INTO `job_enquiries` (`job_id`, `contact`) 
            VALUES (:job_id, :contact)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":contact", $data["job_enquiries"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job document into relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobFullDocument($data)
    {
        $this->db->query(
            "INSERT INTO `job_full_documents` (`job_id`, `document`) 
            VALUES (:job_id, :document)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":document", $data["job_full_vacancy"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job address for hand delivery relevant table
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobHandApplications($data)
    {
        $this->db->query(
            "INSERT INTO `job_hand_applications` (`job_id`, `job_hand_apply`) 
            VALUES (:job_id, :job_hand_application)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_hand_application", $data["job_hand_application"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job postal address
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobPostalAddress($data)
    {
        $this->db->query(
            "INSERT INTO `job_postal_applications` (`job_id`, `job_postal_application`) 
            VALUES (:job_id, :job_postal_application)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_postal_application", $data["job_postal_application"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job purpose
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobPurpose($data)
    {
        $this->db->query(
            "INSERT INTO `job_purposes` (`job_id`, `job_purpose`) 
            VALUES (:job_id, :job_purpose)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_purpose", $data["job_purpose"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job ref no
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobRefNo($data)
    {
        $this->db->query(
            "INSERT INTO `job_ref_nos` (`job_id`, `job_ref_no`) 
            VALUES (:job_id, :job_ref_no)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_ref_no", $data["job_ref_no"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job remuneration
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobRemuneration($data)
    {
        $this->db->query(
            "INSERT INTO `job_remunerations` (`job_id`, `job_remuneration`) 
            VALUES (:job_id, :job_remuneration)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_remuneration", $data["job_remuneration"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job screenshot url
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobScreenshot($data)
    {
        $this->db->query(
            "INSERT INTO `job_screenshots` (`job_id`, `job_screenshot`) 
            VALUES (:job_id, :job_screenshot)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_screenshot", $data["job_screenshot"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job remuneration
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobSkillsRequired($data)
    {
        $this->db->query(
            "INSERT INTO `job_skills` (`job_id`, `job_skill`) 
            VALUES (:job_id, :job_skill)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_skill", $data["job_skills_competencies"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert new job web application url
     *
     * @param string $data 
     * 
     * @return bool
     */
    public function addJobWebUrl($data)
    {
        $this->db->query(
            "INSERT INTO `job_web_applications` (`job_id`, `job_apply_url`) 
            VALUES (:job_id, :job_apply_url)"
        );

        $this->db->bind(":job_id", $data["new_job_id"]);
        $this->db->bind(":job_apply_url", $data["job_apply_url"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete the job
     */
    public function deleteJob($id)
    {
        $this->db->query("DELETE FROM imisebenzi WHERE id = :id");
        $this->db->bind(':id', $id);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>