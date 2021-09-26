<?php
class Umbuzo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getImibuzo()
    {
        $this->db->query(
            'SELECT imibuzo.id, imibuzo.user_id, imibuzo.umbuzo, buzwe_nini, igama, LEFT(fani, 1) AS fani, CONCAT(LEFT(igama, 1),LEFT(fani, 1)) AS initials,
            COUNT(impendulo) AS "comments"
            FROM imibuzo
            INNER JOIN abantu
            ON imibuzo.user_id = abantu.id
            LEFT JOIN imibuzo_comments
            ON imibuzo.id = imibuzo_comments.id_yombuzo
            GROUP BY imibuzo.buzwe_nini DESC'
        );
        
        $results = $this->db->resultSet();
        return $results;
    }
    //Paginate imisebenzi
    public function paginateImibuzo($data)
    {
        $this->db->query(
            'SELECT imibuzo.id, imibuzo.user_id, umbuzo, slug, buzwe_nini, igama, LEFT(fani, 1) AS fani, CONCAT(LEFT(igama, 1), LEFT(fani, 1)) AS initials, COUNT(impendulo) AS "comments"
             FROM imibuzo
            INNER JOIN abantu
            ON imibuzo.user_id = abantu.id
            LEFT JOIN imibuzo_comments
            ON imibuzo_comments.id_yombuzo = imibuzo.id
            GROUP BY buzwe_nini DESC
            LIMIT :start, :rpp'
        );
        $this->db->bind(":start", $data['start']);
        $this->db->bind(":rpp", $data['results_per_page']);
        $results = $this->db->resultSet();

        return $results;
    }

    public function fakaUmbuzo($data)
    {
        $this->db->query(
            "INSERT INTO imibuzo (
                ungantoni,
                slug,
                user_id,
                umbuzo,
                buzwe_nini
                ) VALUE (
                :ungantoni,
                :slug,
                :user_id,
                :umbuzo,
                :buzwe_nini
            )"
        );
        $this->db->bind(':ungantoni', $data['ungantoni']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':umbuzo', $data['umbuzo']);
        $this->db->bind(':buzwe_nini', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUmbuzo($data)
    {
        $this->db->query(
            "UPDATE imibuzo SET
                ungantoni = :ungantoni,
                umbuzo = :umbuzo,
                updated_at = :updated_at
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':ungantoni', $data['ungantoni']);
        $this->db->bind(':umbuzo', $data['umbuzo']);
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUmbuzoById($slug)
    {
        $this->db->query(
            "SELECT user_id, umbuzo, ungantoni, slug, buzwe_nini, igama, LEFT(fani, 1) AS fani, CONCAT(LEFT(igama, 1),LEFT(fani, 1)) AS initials, imibuzo.id as umbuzoId
            FROM imibuzo
            INNER JOIN abantu
            ON imibuzo.user_id = abantu.id WHERE slug = :slug"
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
    public function deleteUmbuzo($id)
    {
        $this->db->query("DELETE FROM imibuzo WHERE id = :id");
        $this->db->bind(':id', $id);
        echo $id;

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function phendulaUmbuzo($data)
    {
        $this->db->query(
            "INSERT INTO imibuzo_comments (
                user_id,
                id_yombuzo,
                impendulo,
                date
            ) VALUE (
                :user_id,
                :id_yombuzo,
                :impendulo,
                :date
            )"
        );
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':id_yombuzo', $data['id']);
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
     * Get impendulo yo Mbuzo
     */
    public function getImpenduloById($id)
    {
        $this->db->query(
            "SELECT imibuzo_comments.user_id, id_yombuzo, impendulo, date, igama, LEFT(fani, 1) AS fani, CONCAT(LEFT(igama, 1),LEFT(fani, 1)) AS initials, role,
            imibuzo_comments.id_yombuzo as umbuzoId,
            abantu.id as userId,
            abantu.igama as igama_lomphenduli
            FROM imibuzo_comments
            INNER JOIN abantu
            ON imibuzo_comments.user_id = abantu.id
            INNER JOIN imibuzo
            ON imibuzo.id = id_yombuzo
            WHERE slug = :id
            ORDER BY imibuzo_comments.date ASC"
        );
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();
        return $results;
    }
}
?>