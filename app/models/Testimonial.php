<?php
class Testimonial
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Get testimonials from database
     *
     * @param [type] $data
     * @return void
     */
    public function getTestimonials()
    {
        $this->db->query(
            'SELECT testimonials.id, testimonials.id_yomntu, testimonial, igama, fani, province
            FROM testimonials
            INNER JOIN abantu
            ON testimonials.id_yomntu = abantu.id
            ORDER BY testimonials.created_at DESC'
        );
        $results = $this->db->resultSet();
        return $results;
    }
    //Paginate imisebenzi
    public function paginateTestimonials($data)
    {
        $this->db->query(
            'SELECT testimonials.id, testimonials.id_yomntu, testimonial, slug, created_at, igama, LEFT(fani, 1) AS fani, CONCAT(LEFT(igama, 1), LEFT(fani, 1)) AS initials
             FROM testimonials
            INNER JOIN abantu
            ON testimonials.id_yomntu = abantu.id
            GROUP BY created_at DESC
            LIMIT :start, :rpp'
        );
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }

    /**
     * Add testimonial into database
     */
    public function addTestimonial($data)
    {
        $this->db->query(
            'INSERT INTO testimonials (
                id_yomntu,
                testimonial,
                slug,
                created_at
                ) VALUE (
                :id_yomntu,
                :testimonial,
                :slug,
                :created_at
                )'
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':testimonial', $data['testimonial']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':created_at', $data['created_at']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get last testimonial id
     */
    public function getTestimonialId()
    {
        $this->db->query(
            'SELECT `id` FROM `testimonials` ORDER by `created_at` DESC LIMIT 1'
        );
        $row = $this->db->single();
        return $row;
    }
}