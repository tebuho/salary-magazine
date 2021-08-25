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
            "SELECT * FROM `employers` ORDER BY `employer`"
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
    
    //Get employer provinces
    public function getEmployerProvinces()
    {
        $this->db->query(
            'SELECT `provinces` FROM employers GROUP BY `provinces`'
        );
        $results = $this->db->resultSet();

        return $results;
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