<?php
class addJob
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    /**
     * Check if slug exists
     */
    public function checkSlug($data)
    {
        $this->db->query(
            "SELECT COUNT(*) AS count FROM imisebenzi WHERE label = :label AND province = :province"
        );
        $this->db->bind(':label', $data['label']);
        $this->db->bind(":province", $data['province']);
        $row = $this->db->single();
        return $row;
    }
    
    public function addJob($data)
    {
        $this->db->query(
            "INSERT INTO imisebenzi (
                gama_le_company,
                employer_slug,
                id_yomntu,
                province,
                province_slug,
                ndawoni,
                ndawoni_slug,
                job_title,
                label,
                closing_date,
                msebenzi_onjani,
                onjani_slug,
                mfundo,
                mfundo_slug,
                experience,
                experience_slug,
                ngowantoni,
                ngowantoni_slug,
                purpose,
                requirements,
                skills_competencies,
                responsibilities,
                additional_info,
                jb_specification,
                apply_nge_website,
                apply_ngesandla,
                apply_nge_email,
                slug,
                image,
                created_at
                ) SELECT * FROM (SELECT
                :gama_le_company AS company,
                :employer_slug AS employer,
                :id_yomntu AS user_id,
                :province AS province_name,
                :province_slug,
                :ndawoni AS area,
                :ndawoni_slug AS area_slug,
                :job_title AS title,
                :label AS label,
                :closing_date AS end_date,
                :msebenzi_onjani AS jb_onjani,
                :onjani_slug AS field,
                :mfundo AS education,
                :mfundo_slug AS education_slug,
                :experience AS iminyaka,
                :experience_slug AS iminyaka_slug,
                :ngowantoni AS Category,
                :ngowantoni_slug AS category_slug,
                :purpose AS job_purpose,
                :requirements AS job_requirements,
                :skills_competencies AS job_skills,
                :responsibilities AS job_responsibilities,
                :additional_info AS info,
                :jb_specification AS jb_spec,
                :apply_nge_website AS online_application,
                :apply_ngesandla AS hand,
                :apply_nge_email AS email,
                :slug AS page_slug,
                :image AS jb_image,
                :created_at AS pub_date
            ) AS tmp
                WHERE NOT EXISTS (
                    SELECT label, province, closing_date FROM imisebenzi WHERE slug= :slug AND label = :label AND province = :province
            AND closing_date >= :closing_date
            ) LIMIT 1"
        );

        
        $this->db->bind(':slug', $data['slug']); 
        $this->db->bind(':gama_le_company', $data['gama_le_company']);
        $this->db->bind(':employer_slug', $data['employer_slug']);
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':province_slug', $data['province_slug']);
        $this->db->bind(":ndawoni", $data['ndawoni']);
        $this->db->bind(":ndawoni_slug", $data['ndawoni_slug']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':label', $data['label']);
        $this->db->bind(':closing_date', $data['closing_date']);
        $this->db->bind(':msebenzi_onjani', $data['msebenzi_onjani']);
        $this->db->bind(':onjani_slug', $data['onjani_slug']);
        $this->db->bind(':mfundo', $data['mfundo']);
        $this->db->bind(':mfundo_slug', $data['mfundo_slug']);
        $this->db->bind(':experience', $data['experience']);
        $this->db->bind(':experience_slug', $data['experience_slug']);
        $this->db->bind(':ngowantoni', $data['ngowantoni']);
        $this->db->bind(':ngowantoni_slug', $data['ngowantoni_slug']);
        $this->db->bind(':purpose', $data['purpose']);
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':skills_competencies', $data['skills_competencies']);
        $this->db->bind(':responsibilities', $data['responsibilities']);
        $this->db->bind(':additional_info', $data['additional_info']);
        $this->db->bind(':jb_specification', $data['jb_specification']);
        $this->db->bind(':apply_nge_website', $data['apply_nge_website']);
        $this->db->bind(':apply_ngesandla', $data['apply_ngesandla']);
        $this->db->bind(':apply_nge_email', $data['apply_nge_email']);
        $this->db->bind(':created_at', date("Y-m-d H:i:s"));
        $this->db->bind(':image', $data['image_name']);

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
            "SELECT label, slug, province, province_slug, closing_date FROM imisebenzi WHERE label = :label AND province = :province
            AND closing_date = '0000-00-00' AND timestampdiff(day, imisebenzi.created_at, CURDATE()) <= 7
            OR label = :label AND closing_date >= CURDATE() AND province = :province"
            );
        $this->db->bind(":label", $data['label']);
        $this->db->bind(":province", $data['province']);
        $results = $this->db->resultSet();
        return $results;
    }

    public function updateJob($data)
    {
        $this->db->query(
            "UPDATE imisebenzi SET
                gama_le_company = :gama_le_company,
                employer_slug = :employer_slug,
                province = :province,
                ndawoni = :ndawoni,
                job_title = :job_title,
                closing_date = :closing_date,
                msebenzi_onjani = :msebenzi_onjani,
                mfundo = :mfundo,
                experience = :experience,
                ngowantoni = :ngowantoni,
                purpose = :purpose,
                requirements = :requirements,
                skills_competencies = :skills_competencies,
                responsibilities = :responsibilities,
                additional_info = :additional_info,
                apply_nge_website = :apply_nge_website, 
                created_at = :created_at,
                updated_at = :updated_at
                WHERE id = :id"
        );   
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':gama_le_company', $data['gama_le_company']);
        $this->db->bind(':employer_slug', $data['employer_slug']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':ndawoni', $data['ndawoni']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':closing_date', $data['closing_date']);
        $this->db->bind(':msebenzi_onjani', $data['msebenzi_onjani']);
        $this->db->bind(':mfundo', $data['mfundo']);
        $this->db->bind(':experience', $data['experience']);
        $this->db->bind(':ngowantoni', $data['ngowantoni']);
        $this->db->bind(':purpose', $data['purpose']);
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':skills_competencies', $data['skills_competencies']);
        $this->db->bind(':responsibilities', $data['responsibilities']);
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
    public function getPostBySlug($slug)
    {
        $this->db->query("SELECT * FROM imisebenzi WHERE slug = :slug");
        $this->db->bind(':slug', $slug);

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