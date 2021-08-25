<?php
class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
     /**
     * Get all Employers from imisebenzi table
     *
     * @return void
     */
    public function getAlljobs()
    {
        $this->db->query(
            "SELECT `job_title`, `gama_le_company`, `slug`, `province_slug`, `image`, DATE(`created_at`), `closing_date`, `province`, `id_yomntu` FROM `imisebenzi`"
        );
        $results = $this->db->resultSet();
        return $results;
    }
    
    //Paginate employers
    public function paginateJobs($data)
    {
        $this->db->query(
            'SELECT `job_title`, `gama_le_company`, `slug`, `province_slug`, CONCAT(DAY(DATE(`created_at`)), "/", MONTH(DATE(`created_at`)), "/", YEAR(DATE(`created_at`))) AS date_created, CONCAT(DAY(DATE(`closing_date`)), "/", MONTH(DATE(`closing_date`)), "/", YEAR(DATE(`closing_date`))) AS closing_date, imisebenzi.`province`, `image`, `id_yomntu`, CONCAT(SUBSTRING(abantu.igama, 1, 1), ". ", abantu.fani) AS igama
            FROM imisebenzi 
            INNER JOIN abantu ON imisebenzi.id_yomntu = abantu.id
            ORDER BY created_at DESC
            LIMIT :start, :rpp'
        );
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    /**
    * Get all Employers and their slugs from employers table
    *
    * @return void
    */
   public function getEmployerSlug()
   {
       $this->db->query(
           "SELECT * FROM `employers` GROUP BY `employer` ORDER BY `employer`"
       );
       $results = $this->db->resultSet();
       return $results;
   }

   /**
    * Check if employer exists
    */
   public function checkEmployers($employer)
   {
       $this->db->query(
           "SELECT COUNT(employer) AS count FROM employers WHERE employer_slug = :employer_slug"
       );
       $this->db->bind(':employer_slug', '');
       $row = $this->db->single();
       return $row;
   }

    /**
     * Check if employer exists
     */
    public function checkEmployer($employer)
    {
        $this->db->query(
            "SELECT COUNT(employer) AS count FROM employers WHERE employer = :employer"
        );
        $this->db->bind(':employer', $employer);
        $row = $this->db->single();
        return $row;
    }
    // Get employer by slug
    public function getEmployerBySlug($slug) {
        $this->db->query(
            "SELECT * FROM employers WHERE employer_slug = :slug"
        );
        $this->db->bind(":slug", $slug);
        $row = $this->db->single();
        return $row;
    }

    // Update slug if empty
    public function updateSlug($data)
    {
        $this->db->query(
            "UPDATE employers SET employer_slug = :slug WHERE employer = :employer"
        );

        $this->db->bind(":employer", $data['employer']);
        $this->db->bind(":slug", $data['employer_slug']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get an employer's category of employment
     * from imisebenzi
     */
    public function getIndustry($slug)
    {
        $this->db->query(
            "SELECT `ngowantoni` FROM `imisebenzi` WHERE `ngowantoni` != 'TEMPLATE PLACEHOLDER' AND `ngowantoni` != '' GROUP BY `ngowantoni`"
        );
        $this->db->bind(':employer', $slug);
        $results = $this->db->resultSet();
        return $results;
    }

    /**
     * Get an employer's category of employment
     * from employers
     */
    public function getIndustryFromEmployers($slug)
    {
        $this->db->query(
            "SELECT `category` FROM `employers` WHERE employer_slug = :employer GROUP BY `category`"
        );
        $this->db->bind(':employer', $slug);
        $row = $this->db->single();
        return $row;
    }

    /**
     * Get an employer's education of employment
     */
    public function getEducation($slug)
    {
        $this->db->query(
            "SELECT `mfundo` FROM `imisebenzi` WHERE employer_slug = :employer GROUP BY `mfundo`"
        );
        $this->db->bind(':employer', $slug);
        $results = $this->db->resultSet();
        return $results;
    }

    // Update employer info
    public function updateEmployer($data)
    {
        
        $this->db->query(
             "REPLACE INTO employers (`id`, `employer`, `employer_slug`, `vacancies`, `website`, `provinces`, `category`, `type`, `head_office`, `facebook`, `linkedin`, `twitter`, `created_at`) VALUES (:id, :employer, :employer_slug, :vacancies, :website, :provinces, :category, :job_type, :head_office, :facebook, :linkedin, :twitter, :created_at)"
        );

        $this->db->bind(":id", $data['id']);
        $this->db->bind(":employer", $data['employer']);
        $this->db->bind(":employer_slug", $data['employer_slug']);
        $this->db->bind(":vacancies", $data['vacancies']);
        $this->db->bind(":website", $data['website']);
        $this->db->bind(":provinces", $data['provinces']);
        $this->db->bind(":category", $data['categories']);
        $this->db->bind(":job_type", $data['type']);
        $this->db->bind(":head_office", $data['head_office']);
        $this->db->bind(":facebook", $data['facebook']);
        $this->db->bind(":linkedin", $data['linkedin']);
        $this->db->bind(":twitter", $data['twitter']);
        $this->db->bind(":created_at", $data['created_at']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // delete employer from db
    public function deleteEmployer($data)
    {
        $this->db->query(
             "DELETE FROM `employers`
              WHERE employer = :employer"
        );

        $this->db->bind(":employer", $data['employer']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Insert employer into database
    public function addEmployer($data)
    {
        $this->db->query(
            "INSERT INTO
                `employers` (`employer`, `employer_slug`, `vacancies`, `website`, created_at)
            VALUES
                (:employer, :slug, '', '', :created_at)"
        );
        $this->db->bind(":employer", $data['employer_like_slug']);
        $this->db->bind(":slug", $data['slug_like_employer']);
        $this->db->bind(":created_at", date("Y-m-d H:i:s"));

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /********************************************************************
     *                                                                  *
     *                      Search for jobs                             *
     *                                                                  *
     ********************************************************************/
    public function searchImisebenzi($data)
    {
        $this->db->query(
            'SELECT `job_title`, `gama_le_company`, `slug`, `province_slug`, CONCAT(DAY(DATE(`created_at`)), "/", MONTH(DATE(`created_at`)), "/", YEAR(DATE(`created_at`))) AS date_created, CONCAT(DAY(DATE(`closing_date`)), "/", MONTH(DATE(`closing_date`)), "/", YEAR(DATE(`closing_date`))) AS closing_date, imisebenzi.`province`, `image`, `id_yomntu`, CONCAT(SUBSTRING(abantu.igama, 1, 1), ". ", abantu.fani) AS igama
            FROM imisebenzi
            INNER JOIN abantu ON imisebenzi.id_yomntu = abantu.id
            -- Search for keyword with closing date
            WHERE gama_le_company LIKE :search
            OR imisebenzi.province LIKE :search
            OR imisebenzi.ndawoni LIKE :search
            OR ngowantoni LIKE :search
            OR mfundo LIKE :search
            OR ngowantoni LIKE :search
            OR job_title LIKE :search
            OR msebenzi_onjani LIKE :search
            OR experience LIKE :search
            OR purpose LIKE :search
            OR requirements LIKE :search
            OR skills_competencies LIKE :search
            OR responsibilities LIKE :search
            OR additional_info LIKE :search
        ');
         
        $this->db->bind(':search', $data['search']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                      Search for jobs                             *
     *                                                                  *
     ********************************************************************/
    public function PaginateJobSearch($data)
    {
        $this->db->query(
            'SELECT `job_title`, `gama_le_company`, `slug`, `province_slug`, CONCAT(DAY(DATE(`created_at`)), "/", MONTH(DATE(`created_at`)), "/", YEAR(DATE(`created_at`))) AS date_created, CONCAT(DAY(DATE(`closing_date`)), "/", MONTH(DATE(`closing_date`)), "/", YEAR(DATE(`closing_date`))) AS closing_date, imisebenzi.`province`, `image`, `id_yomntu`, CONCAT(SUBSTRING(abantu.igama, 1, 1), ". ", abantu.fani) AS igama
            FROM imisebenzi
            INNER JOIN abantu ON imisebenzi.id_yomntu = abantu.id
            -- Search for keyword with closing date
            WHERE gama_le_company LIKE :search
            OR imisebenzi.province LIKE :search
            OR imisebenzi.ndawoni LIKE :search
            OR ngowantoni LIKE :search
            OR mfundo LIKE :search
            OR ngowantoni LIKE :search
            OR job_title LIKE :search
            OR msebenzi_onjani LIKE :search
            OR experience LIKE :search
            OR purpose LIKE :search
            OR requirements LIKE :search
            OR skills_competencies LIKE :search
            OR responsibilities LIKE :search
            OR additional_info LIKE :search
                        
            ORDER BY created_at DESC LIMIT :start, :rpp
        ');
         
        $this->db->bind(':search', $data['search']);
        $this->db->bind(':start', $data['start']);
        $this->db->bind(':rpp', $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    public function getImisebenzi()
    {
        $this->db->query(
            'SELECT msebenzi_onjani, gama_le_company, job_title, ndawoni, id_yomntu, image
            FROM imisebenzi
            WHERE imisebenzi.province = "Eastern Cape"
            AND imisebenzi.closing_date = "0000-00-00" AND timestampdiff(day, imisebenzi.created_at, now()) <= 7
            OR imisebenzi.province = "Eastern Cape"
            AND imisebenzi.closing_date >= :namhlanje
            OR imisebenzi.province = "Nationwide"
            AND imisebenzi.closing_date = "0000-00-00" AND timestampdiff(day, imisebenzi.created_at, now()) <= 7
            OR imisebenzi.province = "Nationwide"
            AND imisebenzi.closing_date >= :namhlanje
            ORDER BY imisebenzi.created_at DESC
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
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
            
            WHERE province = "Eastern Cape" AND closing_date >=  now()
            OR province = "Eastern Cape" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY ndawoni
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
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
            
            WHERE province = "Eastern Cape" AND closing_date >=  now() AND ngowantoni_slug != :empty
            OR province = "Eastern Cape" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            AND ngowantoni_slug != :empty
            
            OR province = "Nationwide" AND closing_date >=  now() AND ngowantoni_slug != :empty
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
     *                      Filter jobs by employer                         *
     *                                                                  *
     ********************************************************************/
    public function filterImisebenziByEmployer()
    {
        $this->db->query(
            'SELECT DISTINCT gama_le_company, employer_slug, COUNT(*) AS count FROM imisebenzi
            
            WHERE province = "Eastern Cape" AND closing_date >=  now()
            OR province = "Eastern Cape" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY gama_le_company
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
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
            
            WHERE province = "Eastern Cape" AND closing_date >=  now()
            OR province = "Eastern Cape" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY experience
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
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
            
            WHERE province = "Eastern Cape" AND closing_date >=  now()
            OR province = "Eastern Cape" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY msebenzi_onjani ASC
         ');
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
            
            WHERE province = "Eastern Cape" AND closing_date >=  now()
            OR province = "Eastern Cape" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            OR province = "Nationwide" AND closing_date >=  now()
            OR province = "Nationwide" AND closing_date = "0000-00-00" AND timestampdiff(day, created_at, now()) <= 7
            
            GROUP BY mfundo ASC
            
         ');
        $this->db->bind(":namhlanje", date("Y-m-d"));
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
}