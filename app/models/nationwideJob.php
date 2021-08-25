<?php
class nationwideJob
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
            "SELECT COUNT(*) AS count FROM imisebenzi WHERE label = :label AND province = :province AND id != :id"
         );
         
         $this->db->bind(':id', $data['job_id']);
         $this->db->bind(':label', $data['label']);
         $this->db->bind(":province", $data['province']);
         $results = $this->db->resultSet();
         return $results;
    }
    
    /**
     * Check if post is still active
     */
    public function checkIfActive($data)
    {
        $this->db->query(
           "SELECT * FROM imisebenzi WHERE label = :label AND province = :province
           AND closing_date = '0000-00-00' AND timestampdiff(day, imisebenzi.created_at, now()) <= 7
           OR label = :label AND province = :province closing_date >= :namhlanje"
        );
        
        $this->db->bind(':id', $data['job_id']);
        $this->db->bind(':label', $data['label']);
        $this->db->bind(":province", $data['province']);
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();
        return $results;
    }
    
    public function getImisebenzi()
    {
        $this->db->query(
            'SELECT msebenzi_onjani, gama_le_company, job_title, ndawoni, id_yomntu, image
            FROM imisebenzi
            WHERE imisebenzi.province = "Nationwide"
            AND imisebenzi.closing_date = "0000-00-00" AND timestampdiff(day, imisebenzi.created_at, now()) <= 7
            OR imisebenzi.province = "Nationwide"
            AND imisebenzi.closing_date >= :namhlanje
            ORDER BY imisebenzi.created_at DESC
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();

        return $results;
    }
    
    // For pagination
    public function paginateImisebenzi($data)
    {
        $this->db->query(
            "SELECT msebenzi_onjani, ngowantoni, gama_le_company, job_title, province_slug, ndawoni, slug, id_yomntu, purpose, image,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
             END AS 'closingDate',
            FROM imisebenzi
            WHERE province = 'Nationwide'
            AND closing_date = '0000-00-00' AND timestampdiff(day, created_at, now()) <= 7
            OR province = 'Nationwide'
            AND closing_date >= :namhlanje
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ");
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /**
     * Get related jobs
     */
    public function getEminyeImisebenzi($data)
    {
        $this->db->query(
            "SELECT closing_date, label, slug,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
             END AS 'closingDate'
             FROM imisebenzi
             WHERE NOT slug = :slug AND province = 'Nationwide'
             AND closing_date >= :namhlanje AND ngowantoni = :ngowantoni
            
             OR NOT slug = :slug AND province = 'Nationwide'
             AND closing_date = '0000-00-00' AND timestampdiff(day, created_at, now()) <= 7
             AND ngowantoni = :ngowantoni
            
             ORDER BY RAND ()
             LIMIT 5
            "
        );
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':ngowantoni', $data['ngowantoni']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Filter jobs by location                     *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByLocation()
    {
        $this->db->query(
            'SELECT ndawoni, ndawoni_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY ndawoni
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get jobs by location                        *
     *                                                                  *
     ********************************************************************/
    public function getImisebenziByLocation($location)
    {
        $this->db->query(
            'SELECT * FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now() AND ndawoni_slug = :ndawoni
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND ndawoni_slug = :ndawoni
            
            ORDER BY created_at DESC
         ');
        $this->db->bind(":ndawoni", $location);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *          Paginate imisebenzi by Location                         *
     *                                                                  *
     ********************************************************************/
    public function paginateImisebenziNgeNdawo($data)
    {
        $this->db->query(
            "SELECT msebenzi_onjani, ngowantoni, gama_le_company, job_title, province_slug, ndawoni, slug, id_yomntu, purpose, image,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
             END AS 'closingDate'
             FROM imisebenzi
            WHERE province = 'Nationwide' AND ndawoni = :ndawoni
            AND closing_date = '0000-00-00' AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = 'Nationwide'
            AND closing_date >= now() AND ndawoni = :ndawoni
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ");
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":ndawoni", $data['area']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Filter jobs by type                         *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByType()
    {
        $this->db->query(
            'SELECT ngowantoni, ngowantoni_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now() AND ngowantoni_slug != :empty
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND ngowantoni_slug != :empty
            
            GROUP BY ngowantoni
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":empty", '');
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get jobs by type                            *
     *                                                                  *
     ********************************************************************/
    public function getImisebenziByType($type)
    {
        $this->db->query(
            'SELECT * FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now() AND ngowantoni_slug = :ngowantoni
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND ngowantoni_slug = :ngowantoni
            
            ORDER BY created_at DESC
         ');
        $this->db->bind(":ngowantoni", $type);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                  Paginate imisebenzi by type                     *
     *                                                                  * 
     ********************************************************************/
    public function paginateImisebenziByType($data)
    {
        $this->db->query(
            "SELECT msebenzi_onjani, ngowantoni, gama_le_company, job_title, province_slug, ndawoni, slug, id_yomntu, purpose, image,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
             END AS 'closingDate'
             FROM imisebenzi
            
            WHERE province = 'Nationwide' AND ngowantoni = :ngowantoni
            AND closing_date = '0000-00-00' AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = 'Nationwide'
            AND closing_date >= now() AND ngowantoni = :ngowantoni
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ");
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":ngowantoni", $data['type']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Filter jobs by employer                         *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByEmployer()
    {
        $this->db->query(
            'SELECT DISTINCT gama_le_company, employer_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY gama_le_company
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get jobs by employer                            *
     *                                                                  *
     ********************************************************************/
    public function getImisebenziByEmployer($employer)
    {
        $this->db->query(
            'SELECT * FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now() AND employer_slug = :employer
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND employer_slug = :employer
            
            ORDER BY created_at DESC
         ');
        $this->db->bind(":employer", $employer);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *              Paginate imisebenzi by employer                     *
     *                                                                  * 
     ********************************************************************/
    public function paginateImisebenziByEmployer($data)
    {
        $this->db->query(
            'SELECT msebenzi_onjani, ngowantoni, gama_le_company, job_title, province_slug, ndawoni, slug, id_yomntu, purpose, image,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, "%D"), " ka ", DATE_FORMAT(`closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, "%e"), " ka ", DATE_FORMAT(`closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            
            WHERE province = "Nationwide" AND gama_le_company = :employer
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide"
            AND closing_date >= now() AND gama_le_company = :employer
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":employer", $data['employer']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                  Filter jobs by experience                       *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByExperience()
    {
        $this->db->query(
            'SELECT experience, experience_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY experience
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get jobs by experience                      *
     *                                                                  *
     ********************************************************************/
    public function getImisebenziByExperience($exp)
    {
        $this->db->query(
            'SELECT * FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now() AND experience_slug = :experience
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND experience_slug = :experience
            
            ORDER BY created_at DESC
            
         ');
        $this->db->bind(":experience", $exp);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *              Paginate imisebenzi by experience                   *
     *                                                                  *
     ********************************************************************/

    public function paginateImisebenziNgeExperience($data)
    {
        $this->db->query(
            "SELECT msebenzi_onjani, ngowantoni, gama_le_company, job_title, province_slug, ndawoni, slug, id_yomntu, purpose, image,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
             END AS 'closingDate'
             FROM imisebenzi
            
            WHERE province = 'Nationwide' AND experience = :experience
            AND closing_date = '0000-00-00' AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = 'Nationwide'
            AND closing_date >= now() AND experience = :experience
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ");
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":experience", $data['years']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Filter jobs by onjani                       *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByOnjani()
    {
        $this->db->query(
            'SELECT msebenzi_onjani, onjani_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY msebenzi_onjani ASC
         ');
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get jobs ngobunjani                         *
     *                                                                  *
     ********************************************************************/
    public function getImisebenziByOnjani($onjani)
    {
        $this->db->query(
            'SELECT msebenzi_onjani, onjani_slug, ngowantoni, closing_date, label, slug, requirements, id_yomntu
            FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now() AND onjani_slug = :onjani
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND onjani_slug = :onjani
            
            ORDER BY created_at DESC
         ');
         
        $this->db->bind(":onjani", $onjani);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                  Paginate imisebenzi ngobunjani                  *
     *                                                                  *
     ********************************************************************/
    public function paginateImisebenziNgoBunjani($data)
    {
        $this->db->query(
            "SELECT msebenzi_onjani, ngowantoni, gama_le_company, job_title, province_slug, ndawoni, slug, id_yomntu, purpose, image,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
             END AS 'closingDate'
             FROM imisebenzi
            WHERE province = 'Nationwide' AND msebenzi_onjani = :onjani
            AND closing_date = '0000-00-00' AND timestampdiff(day, created_at, now()) < 7
            
            OR province = 'Nationwide'
            AND closing_date >= now() AND msebenzi_onjani = :onjani
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ");
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":onjani", $data['njani']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Filter jobs by mfundo                       *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByMfundo()
    {
        $this->db->query(
            'SELECT mfundo, mfundo_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY mfundo ASC
            
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                       Get jobs by Education                      *
     *                                                                  *
     ********************************************************************/
    public function getImisebenziByMfundo($education)
    {
        $this->db->query(
            'SELECT * FROM imisebenzi
            
            WHERE province = "Nationwide" AND closing_date >=  now() AND mfundo_slug = :mfundo
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND mfundo_slug = :mfundo
            
            ORDER BY created_at DESC
         ');
        $this->db->bind(":mfundo", $education);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *              Paginate imisebenzi nge mfundo                      *
     *                                                                  *
     ********************************************************************/
    public function paginateImisebenziNgeMfundo($data)
    {
        $this->db->query(
            "SELECT msebenzi_onjani, ngowantoni, gama_le_company, job_title, province_slug, ndawoni, slug, id_yomntu, purpose, image,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
             END AS 'closingDate'
             FROM imisebenzi
            WHERE province = 'Nationwide' AND mfundo = :mfundo
            AND closing_date = '0000-00-00' AND timestampdiff(day, created_at, now()) <= 7
            OR province = 'Nationwide'
            AND closing_date >= now() AND mfundo = :mfundo
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ");
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":mfundo", $data['ed']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get provinces                               *
     *                                                                  *
     ********************************************************************/
    public function getProvinces()
    {
        $this->db->query(
            'SELECT province, province_slug, COUNT(*) AS "count" FROM imisebenzi
            WHERE closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND province != "Not Applicable" AND province != "Other - Non-South African Location"
            AND province != "Nationwide"
            OR closing_date >= :namhlanje AND province != "Not Applicable" AND province != "Nationwide"
            AND province != "Other - Non-South African Location"
            GROUP BY province'
        );
        $this->db->bind(":namhlanje", date("Y-m-d"));
        
        $results = $this->db->resultSet();
        return $results;
    }

    public function updateJob($data)
    {
        $this->db->query(
            "UPDATE imisebenzi SET
                gama_le_company = :gama_le_company,
                province = :province,
                ndawoni = :ndawoni,
                ndawoni_slug = :ndawoni_slug,
                job_title = :job_title,
                label = :label,
                closing_date = :closing_date,
                msebenzi_onjani = :msebenzi_onjani,
                onjani_slug = :onjani_slug,
                mfundo = :mfundo,
                mfundo_slug = :mfundo_slug,
                experience = :experience,
                experience_slug = :experience_slug,
                ngowantoni = :ngowantoni,
                ngowantoni_slug = :ngowantoni_slug,
                purpose = :purpose,
                requirements = :requirements,
                skills_competencies = :skills_competencies,
                responsibilities = :responsibilities,
                additional_info = :additional_info,
                jb_specification = :jb_specification,
                apply_nge_website = :apply_nge_website, 
                apply_ngesandla = :apply_ngesandla,
                apply_nge_email = :apply_nge_email,
                image = :image,
                slug = :slug,
                updated_at = :updated_at
                WHERE id = :id"
        );
        
        $this->db->bind(':id', $data['job_id']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':gama_le_company', $data['gama_le_company']);
        $this->db->bind(':province', $data['province']);
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
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':purpose', $data['purpose']);
        $this->db->bind(':skills_competencies', $data['skills_competencies']);
        $this->db->bind(':responsibilities', $data['responsibilities']);
        $this->db->bind(':additional_info', $data['additional_info']);
        $this->db->bind(':jb_specification', $data['jb_specification']);
        $this->db->bind(':apply_nge_website', $data['apply_nge_website']);
        $this->db->bind(':apply_ngesandla', $data['apply_ngesandla']);
        $this->db->bind(':apply_nge_email', $data['apply_nge_email']);
        $this->db->bind(':image', $data['image_name']);
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
        $this->db->query(
            "SELECT gama_le_company, employer_slug, province,
            ndawoni, ndawoni_slug, job_title, msebenzi_onjani, onjani_slug, mfundo,
            experience, ngowantoni, ngowantoni_slug, requirements, purpose, skills_competencies, 
            responsibilities, additional_info, apply_nge_website, apply_ngesandla,
            apply_nge_email, image, id_yomntu, label, closing_date,
            jb_specification, slug, id, created_at,
            CASE
            WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
            THEN CONCAT(DATE_FORMAT(`closing_date`, '%D'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
            ELSE CONCAT(DATE_FORMAT(`closing_date`, '%e'), ' ka ', DATE_FORMAT(`closing_date`, '%M %Y'))
            END AS 'closingDate'
            FROM imisebenzi
            WHERE slug = :slug"
            );
        $this->db->bind(':slug', $slug);

        $row = $this->db->single();
        return $row;
    }
    
    public function getUserById($id)
    {
        $this->db->query(
            "SELECT id, igama, fani FROM abantu WHERE id = :id"
        );
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    /**
     * Delete the job
     */
    public function deleteJob($slug)
    {
        $this->db->query("DELETE FROM imisebenzi WHERE slug = :slug");
        $this->db->bind(':slug', $slug);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Search query
     */
    public function searchImisebenzi($data)
    {
        $this->db->query(
            'SELECT *,
             CASE
                WHEN DAYOFMONTH(`closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`closing_date`, "%D"), " ka ", DATE_FORMAT(`closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`closing_date`, "%e"), " ka ", DATE_FORMAT(`closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            
            WHERE province = "Nationwide" AND gama_le_company LIKE :search AND closing_date >=  now()
            
            OR province = "Nationwide" AND gama_le_company LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND ndawoni LIKE :search AND closing_date >=  now() 
            
            OR province = "Nationwide" AND ndawoni LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND job_title LIKE :search AND closing_date >=  now()
            
            OR province = "Nationwide" AND job_title LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND ngowantoni LIKE :search AND closing_date >=  now()
            
            OR province = "Nationwide" AND ngowantoni LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND mfundo LIKE :search AND closing_date >=  now()
            
            OR province = "Nationwide" AND mfundo LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND responsibilities LIKE :search AND closing_date >=  now()
            
            OR province = "Nationwide" AND responsibilities LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND skills_competencies LIKE :search
            AND closing_date >=  now()
            
            OR province = "Nationwide" AND skills_competencies LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND requirements LIKE :search
            AND closing_date >=  now()
            
            OR province = "Nationwide" AND requirements LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            
            OR province = "Nationwide" AND additional_info LIKE :search
            AND closing_date >=  now()
            
            OR province = "Nationwide" AND additional_info LIKE :search
            AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) < 7
            ORDER BY created_at DESC
         ');
         
        $this->db->bind(':search', $data['search']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Post comment                                *
     *                                                                  *
     ********************************************************************/
    
    public function addComment($data)
    {
        $this->db->query(
            "INSERT INTO job_comments (
                job_id,
                id_yomntu,
                comment,
                pub_date
            ) VALUE (
                :job_id,
                :id_yomntu,
                :comment,
                :pub_date
            )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':job_id', $data['id']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':pub_date', $data['date']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get comments                                *
     *                                                                  *
     ********************************************************************/
    
    public function getImpenduloById($id)
    {
        $this->db->query(
            "SELECT comment, update_date, igama, fani, email,
            job_comments.job_id as jobId,
            abantu.id as userId
            FROM job_comments
            INNER JOIN abantu
            ON job_comments.id_yomntu = abantu.id WHERE job_comments.job_id = :id
            ORDER BY pub_date DESC
            ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        
        return ($results);

    }
    
    /********************************************************************
     *                                                                  *
     *                      Get comments                                *
     *                                                                  *
     ********************************************************************/
    
    public function getUserEmail($data)
    {
        $this->db->query(
            "SELECT email, igama,
            job_comments.id_yomntu AS comment_user_id,
            abantu.id AS userId
            FROM job_comments
            INNER JOIN abantu ON job_comments.id_yomntu = abantu.id
            INNER JOIN imisebenzi ON job_id = imisebenzi.id
            WHERE abantu.id <> :id AND imisebenzi.id = :job_id
            ORDER BY update_date DESC
            ");
        $this->db->bind(':id', $data['id_yomntu']);
        $this->db->bind(':job_id', $data['id']);
        $results = $this->db->resultSet();

        return $results;
    }
}
?>