<?php
class gautengJob
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
            "SELECT COUNT(*) AS count FROM imisebenzi WHERE gama_le_company = :gama_le_company AND job_title = :job_title AND ndawoni = :ndawoni"
        );
        $this->db->bind(':gama_le_company', $data['gama_le_company']);
        $this->db->bind(':ndawoni', $data['ndawoni']);
        $this->db->bind(':job_title', $data['job_title']);
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
           AND job_closing_date = '1970-01-01' AND timestampdiff(day, imisebenzi.created_at, now()) <= 7
           OR label = :label AND province = :province job_closing_date >= :namhlanje"
        );
        
        $this->db->bind(':label', $data['label']);
        $this->db->bind(":province", $data['province']);
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();
        return $results;
    }

    //Get imisebenzi
    public function getImisebenzi()
    {
        $this->db->query(
            'SELECT job_type, gama_le_company, job_title, ndawoni, user_id, image
            FROM imisebenzi
            WHERE province = "Gauteng"
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            OR province = "Gauteng"
            AND job_closing_date >= :namhlanje
            OR province = "Nationwide"
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            OR province = "Nationwide"
            AND job_closing_date >= :namhlanje
            ORDER BY created_at DESC
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();

        return $results;
    }
    
    //Paginate imisebenzi
    public function paginateImisebenzi($data)
    {
        $this->db->query(
            'SELECT job_type, category, gama_le_company, job_title, province_slug, ndawoni, slug, user_id, purpose, image,
             CASE
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate",
             CASE province_slug
                WHEN "nationwide" THEN "gautengJobs"
                ELSE "gautengJobs"
                END AS "province_slug"
             FROM imisebenzi
            WHERE province = "Gauteng"
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            OR province = "Gauteng"
            AND job_closing_date >= :namhlanje
            OR province = "Nationwide"
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            OR province = "Nationwide"
            AND job_closing_date >= :namhlanje
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ');
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
            "SELECT job_closing_date, label, slug,
             CASE
            WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
            THEN CONCAT(DATE_FORMAT(`job_closing_date`, '%D'), ' ka ', DATE_FORMAT(`job_closing_date`, '%M %Y'))
            ELSE CONCAT(DATE_FORMAT(`job_closing_date`, '%e'), ' ka ', DATE_FORMAT(`job_closing_date`, '%M %Y'))
            END AS 'closingDate'
            FROM imisebenzi
            WHERE NOT slug = :slug AND province = 'Gauteng'
            AND job_closing_date >= :namhlanje AND category = :category
            
            OR NOT slug = :slug AND province = 'Gauteng'
            AND job_closing_date = '1970-01-01' AND timestampdiff(day, created_at, now()) <= 7
            AND category = :category
            
            OR NOT slug = :slug AND province = 'Nationwide'
            AND job_closing_date >= :namhlanje AND category = :category
            
            OR NOT slug = :slug AND province = 'Nationwide'
            AND job_closing_date = '1970-01-01' AND timestampdiff(day, created_at, now()) <= 7
            AND category = :category
            
            ORDER BY RAND ()
            LIMIT 5
         ");
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':category', $data['category']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Filter jobs by job_location                     *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByLocation()
    {
        $this->db->query(
            'SELECT ndawoni, job_location_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Gauteng" AND job_closing_date >=  now()
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND job_closing_date >=  now()
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY ndawoni
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get jobs by job_location                        *
     *                                                                  *
     ********************************************************************/
    public function getImisebenziByLocation($job_location)
    {
        $this->db->query(
            'SELECT * FROM imisebenzi
            
            WHERE province = "Gauteng" AND job_closing_date >=  now() AND job_location_slug = :ndawoni
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_location_slug = :ndawoni
            
            OR province = "Nationwide" AND job_closing_date >=  now() AND job_location_slug = :ndawoni
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_location_slug = :ndawoni
            
            ORDER BY created_at DESC
         ');
        $this->db->bind(":ndawoni", $job_location);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Paginate imisebenzi                         *
     *                                                                  *
     ********************************************************************/
    public function paginateImisebenziNgeNdawo($data)
    {
        $this->db->query(
            'SELECT job_type, category, gama_le_company, job_title, province_slug, ndawoni, slug, user_id, purpose, image,
             CASE
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            WHERE province = "Gauteng" AND ndawoni = :ndawoni
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng"
            AND job_closing_date >= now() AND ndawoni = :ndawoni
            
            OR province = "Nationwide" AND ndawoni = :ndawoni
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide"
            AND job_closing_date >= now() AND ndawoni = :ndawoni
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ');
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
            'SELECT category, job_category_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Gauteng" AND job_closing_date >=  now() AND job_category_slug != :empty
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_category_slug != :empty
            
            OR province = "Nationwide" AND job_closing_date >=  now() AND job_category_slug != :empty
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_category_slug != :empty
            
            GROUP BY category
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
            
            WHERE province = "Gauteng" AND job_closing_date >=  now() AND job_category_slug = :category
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_category_slug = :category
            
            OR province = "Nationwide" AND job_closing_date >=  now() AND job_category_slug = :category
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_category_slug = :category
            
            ORDER BY created_at DESC
         ');
        $this->db->bind(":category", $type);
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
            'SELECT job_type, category, gama_le_company, job_title, province_slug, ndawoni, slug, user_id, purpose, image,
             CASE
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            
            WHERE province = "Gauteng" AND category = :category
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng"
            AND job_closing_date >= now() AND category = :category
            
            OR province = "Nationwide" AND category = :category
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide"
            AND job_closing_date >= now() AND category = :category
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":category", $data['type']);
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
            
            WHERE province = "Gauteng" AND job_closing_date >=  now()
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND job_closing_date >=  now()
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
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
            
            WHERE province = "Gauteng" AND job_closing_date >=  now() AND employer_slug = :employer
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND employer_slug = :employer
            
            OR province = "Nationwide" AND job_closing_date >=  now() AND employer_slug = :employer
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
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
            'SELECT job_type, category, gama_le_company, job_title, province_slug, ndawoni, slug, user_id, purpose, image,
             CASE
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            
            WHERE province = "Gauteng" AND gama_le_company = :employer
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng"
            AND job_closing_date >= now() AND gama_le_company = :employer
            
            OR province = "Nationwide" AND gama_le_company = :employer
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide"
            AND job_closing_date >= now() AND gama_le_company = :employer
            
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
            
            WHERE province = "Gauteng" AND job_closing_date >=  now()
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND job_closing_date >=  now()
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
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
            
            WHERE province = "Gauteng" AND job_closing_date >=  now() AND experience_slug = :experience
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND experience_slug = :experience
            
            OR province = "Nationwide" AND job_closing_date >=  now() AND experience_slug = :experience
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
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
            'SELECT job_type, category, gama_le_company, job_title, province_slug, ndawoni, slug, user_id, purpose, image,
             CASE
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            
            WHERE province = "Gauteng" AND experience = :experience
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng"
            AND job_closing_date >= now() AND experience = :experience
            
            OR province = "Nationwide" AND experience = :experience
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide"
            AND job_closing_date >= now() AND experience = :experience
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ');
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
            'SELECT job_type, job_type_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Gauteng" AND job_closing_date >=  now()
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND job_closing_date >=  now()
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY job_type ASC
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
            'SELECT * FROM imisebenzi
            
            WHERE province = "Gauteng" AND job_closing_date >=  now() AND job_type_slug = :onjani
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_type_slug = :onjani
            
            OR province = "Nationwide" AND job_closing_date >=  now() AND job_type_slug = :onjani
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_type_slug = :onjani
            
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
            'SELECT job_type, category, gama_le_company, job_title, province_slug, ndawoni, slug, user_id, purpose, image,
             CASE
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            WHERE province = "Gauteng" AND job_type = :onjani
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng"
            AND job_closing_date >= now() AND job_type = :onjani
            
            OR province = "Nationwide" AND job_type = :onjani
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide"
            AND job_closing_date >= now() AND job_type = :onjani
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":onjani", $data['njani']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Filter jobs by job_education                       *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByMfundo()
    {
        $this->db->query(
            'SELECT job_education, job_education_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Gauteng" AND job_closing_date >=  now()
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND job_closing_date >=  now()
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY job_education ASC
            
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
            
            WHERE province = "Gauteng" AND job_closing_date >=  now() AND job_education_slug = :job_education
            OR province = "Gauteng" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_education_slug = :job_education
            
            OR province = "Nationwide" AND job_closing_date >=  now() AND job_education_slug = :job_education
            OR province = "Nationwide" AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND job_education_slug = :job_education
            
            ORDER BY created_at DESC
         ');
        $this->db->bind(":job_education", $education);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *              Paginate imisebenzi nge job_education                      *
     *                                                                  *
     ********************************************************************/
    public function paginateImisebenziNgeMfundo($data)
    {
        $this->db->query(
            'SELECT job_type, category, gama_le_company, job_title, province_slug, ndawoni, slug, user_id, purpose, image,
             CASE
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            WHERE province = "Gauteng" AND job_education = :job_education
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            OR province = "Gauteng"
            AND job_closing_date >= now() AND job_education = :job_education
            
            OR province = "Nationwide" AND job_education = :job_education
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            OR province = "Nationwide"
            AND job_closing_date >= now() AND job_education = :job_education
            
            ORDER BY created_at DESC
            LIMIT :start, :rpp
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":job_education", $data['ed']);
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
            WHERE job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            AND province != "Not Applicable" AND province != "Other - Non-South African Location"
            AND province != "Nationwide"
            OR job_closing_date >= :namhlanje AND province != "Not Applicable" AND province != "Nationwide"
            AND province != "Other - Non-South African Location"
            GROUP BY province'
        );
        $this->db->bind(":namhlanje", date("Y-m-d"));
        
        $results = $this->db->resultSet();
        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Update jobs                                 *
     *                                                                  *
     ********************************************************************/
    public function updateJob($data)
    {
        $this->db->query(
            "UPDATE imisebenzi SET
                gama_le_company = :gama_le_company,
                employer_slug = :employer_slug,
                province = :province,
                ndawoni = :ndawoni,
                job_location_slug = :job_location_slug,
                job_title = :job_title,
                label = :label,
                job_closing_date = :job_closing_date,
                job_type = :job_type,
                job_type_slug = :job_type_slug,
                job_education = :job_education,
                job_education_slug = :job_education_slug,
                experience = :experience,
                experience_slug = :experience_slug,
                category = :category,
                job_category_slug = :job_category_slug,
                purpose = :purpose,
                job_requirements = :job_requirements,
                skills_competencies = :skills_competencies,
                job_responsibilities = :job_responsibilities,
                additional_info = :additional_info,
                jb_specification = :jb_specification,
                apply_nge_website = :apply_nge_website, 
                job_hand_application = :job_hand_application,
                apply_nge_email = :apply_nge_email,
                image = :image,
                slug = :slug,
                updated_at = :updated_at
                WHERE id = :id"
        );
        
        $this->db->bind(':id', $data['job_id']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':gama_le_company', $data['gama_le_company']);
        $this->db->bind(":employer_slug", $data['employer_slug']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(":ndawoni", $data['ndawoni']);
        $this->db->bind(":job_location_slug", $data['job_location_slug']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':label', $data['label']);
        $this->db->bind(':job_closing_date', $data['job_closing_date']);
        $this->db->bind(':job_type', $data['job_type']);
        $this->db->bind(':job_type_slug', $data['job_type_slug']);
        $this->db->bind(':job_education', $data['job_education']);
        $this->db->bind(':job_education_slug', $data['job_education_slug']);
        $this->db->bind(':experience', $data['experience']);
        $this->db->bind(':experience_slug', $data['experience_slug']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':job_category_slug', $data['job_category_slug']);
        $this->db->bind(':purpose', $data['purpose']);
        $this->db->bind(':job_requirements', $data['job_requirements']);
        $this->db->bind(':skills_competencies', $data['skills_competencies']);
        $this->db->bind(':job_responsibilities', $data['job_responsibilities']);
        $this->db->bind(':additional_info', $data['additional_info']);
        $this->db->bind(':jb_specification', $data['jb_specification']);
        $this->db->bind(':apply_nge_website', $data['apply_nge_website']);
        $this->db->bind(':job_hand_application', $data['job_hand_application']);
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
            ndawoni, job_location_slug, job_title, job_type, job_type_slug, job_education,
            experience, category, job_category_slug, job_requirements, purpose, skills_competencies, 
            job_responsibilities, additional_info, apply_nge_website, job_hand_application,
            apply_nge_email, image, user_id, label, job_closing_date,
            jb_specification, slug, id, created_at,
            CASE
            WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
            THEN CONCAT(DATE_FORMAT(`job_closing_date`, '%D'), ' ka ', DATE_FORMAT(`job_closing_date`, '%M %Y'))
            ELSE CONCAT(DATE_FORMAT(`job_closing_date`, '%e'), ' ka ', DATE_FORMAT(`job_closing_date`, '%M %Y'))
            END AS 'closingDate'
            FROM imisebenzi WHERE slug = :slug"
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
                WHEN DAYOFMONTH(`job_closing_date`) IN(1, 2, 3, 4, 5, 20, 22, 23, 24, 25, 29, 30, 31)
                THEN CONCAT(DATE_FORMAT(`job_closing_date`, "%D"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
                ELSE CONCAT(DATE_FORMAT(`job_closing_date`, "%e"), " ka ", DATE_FORMAT(`job_closing_date`, "%M %Y"))
             END AS "closingDate"
             FROM imisebenzi
            WHERE province = "Gauteng" AND gama_le_company LIKE :search AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND gama_le_company LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND ndawoni LIKE :search AND job_closing_date >=  now() 
            
            OR province = "Gauteng" AND ndawoni LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND job_title LIKE :search AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND job_title LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND category LIKE :search AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND category LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND job_education LIKE :search AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND job_education LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND job_responsibilities LIKE :search AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND job_responsibilities LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND skills_competencies LIKE :search
            AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND skills_competencies LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND job_requirements LIKE :search
            AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND job_requirements LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Gauteng" AND additional_info LIKE :search
            AND job_closing_date >=  now()
            
            OR province = "Gauteng" AND additional_info LIKE :search
            AND job_closing_date = "1970-01-01" AND timestampdiff(day, created_at, now()) <= 7
            
            ORDER BY imisebenzi.created_at DESC
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
                user_id,
                comment,
                pub_date
            ) VALUE (
                :job_id,
                :user_id,
                :comment,
                :pub_date
            )"
        );
        $this->db->bind(':user_id', $data['user_id']);
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
            "SELECT comment, update_date, igama, fani, email, zazise,
            job_comments.job_id as jobId,
            abantu.id as userId
            FROM job_comments
            INNER JOIN abantu
            ON job_comments.user_id = abantu.id WHERE job_comments.job_id = :id
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
            job_comments.user_id AS comment_user_id,
            abantu.id AS userId
            FROM job_comments
            INNER JOIN abantu ON job_comments.user_id = abantu.id
            INNER JOIN imisebenzi ON job_id = imisebenzi.id
            WHERE abantu.id <> :id AND imisebenzi.id = :job_id
            ORDER BY update_date DESC
            ");
        $this->db->bind(':id', $data['user_id']);
        $this->db->bind(':job_id', $data['id']);
        $results = $this->db->resultSet();

        return $results;
    }
}
?>