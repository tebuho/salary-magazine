<?php
class Blog
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getBlogs()
    {
        $this->db->query(
            'SELECT blogs.id, id_yomntu, title, body, image, slug, pub_date, igama, fani, blogs.updated_at,
            blogs.id as blogId,
            abantu.id as userId
            FROM blogs
            INNER JOIN abantu
            ON blogs.id_yomntu = abantu.id
            ORDER BY blogs.pub_date DESC'
        );
        $results = $this->db->resultSet();

        return $results;
    }

    public function addBlog($data)
    {
        $this->db->query(
            "INSERT INTO blogs (
                id_yomntu,
                title,
                body,
                image,
                number_of_likes,
                number_comments,
                number_of_complaints,
                pub_date
                ) VALUE (
                :id_yomntu,
                :title,
                :body,
                :image,
                :number_of_likes,
                :number_comments,
                :number_of_complaints,
                :pub_date
            )"
        );
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':image', $data['image_name']);
        $this->db->bind(':number_of_likes', 0);
        $this->db->bind(':number_comments', 0);
        $this->db->bind(':number_of_complaints', 0);
        $this->db->bind(':pub_date', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBlog($data)
    {
        $this->db->query(
            "UPDATE blogs SET
                title = :title,
                body = :body,
                updated_at = :updated_at
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getBlogById($slug)
    {
        $this->db->query(
            "SELECT blogs.id, id_yomntu, title, body, image, slug, pub_date, igama, fani, blogs.updated_at,
            blogs.id as blogId,
            abantu.id as userId
            FROM blogs
            INNER JOIN abantu
            ON blogs.id_yomntu = abantu.id WHERE slug = :slug"
        );
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
    public function deleteBlog($id)
    {
        $this->db->query("DELETE FROM blogs WHERE id = :id");
        $this->db->bind(':id', $id);

        //Execute
        if ($this->db->execute()) {

            return true;

        } else {

            return false;
            
        }

    }
    
    public function blogComment($data)
    {
        $this->db->query(
            "INSERT INTO blog_comments (
                id_yomntu,
                blog_id,
                impendulo,
                date
            ) VALUE (
                :id_yomntu,
                :blog_id,
                :impendulo,
                :date
            )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':blog_id', $data['id']);
        $this->db->bind(':impendulo', $data['impendulo']);
        $this->db->bind(':date', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get impendulo yo Mthandazo
     */
    public function getImpenduloById($id)
    {
        $this->db->query(
            "SELECT *,
            blog_comments.blog_id as blogId,
            abantu.id as userId
            FROM blog_comments
            INNER JOIN abantu
            ON blog_comments.id_yomntu = abantu.id WHERE blog_comments.blog_id = :id
            ORDER BY date DESC
            ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        return $results;
    }
    /**
     * Search query
     */
    public function searchBlogs($data)
    {
        $this->db->query(
            'SELECT * FROM
            blogs WHERE title LIKE :search AND body LIKE :search
            ORDER BY blogs.pub_date DESC
         ');
        $this->db->bind(':search', $data['search']);
        $results = $this->db->resultSet();

        return $results;
    }
}
?>