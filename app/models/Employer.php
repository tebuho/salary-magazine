
<?php
class Employer
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
    public function getAllEmployers()
    {
        $this->db->query(
            "SELECT `job_employer` FROM `imisebenzi` GROUP BY `job_employer` ORDER BY `job_employer`"
        );
        $results = $this->db->resultSet();
        return $results;
    }
    
    //Paginate employers
    public function paginateEmployers($data)
    {
        $this->db->query(
            'SELECT * FROM employers ORDER BY employer LIMIT :start, :rpp'
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
            "SELECT `category` FROM `imisebenzi` WHERE `category` != 'TEMPLATE PLACEHOLDER' AND `category` != '' GROUP BY `category`"
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
            "SELECT `job_education` FROM `imisebenzi` WHERE employer_slug = :employer GROUP BY `job_education`"
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

    // Search
    public function searchEmployers($data)
    {
        $this->db->query(
            "SELECT * FROM `employers`
            WHERE `employer` LIKE :search
            OR `provinces` LIKE :search
            OR `category` LIKE :search
            OR `type` LIKE :search
            OR `head_office` LIKE :search"
        );
        $this->db->bind(":search", $data['search']);
        $results = $this->db->resultSet();
        return $results;
    }
}