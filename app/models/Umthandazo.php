<?php
class Umthandazo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getImithandazo()
    {
        $this->db->query(
            'SELECT *,
            imithandazo.id as umthandazoId,
            abantu.id as userId
            FROM imithandazo
            INNER JOIN abantu
            ON imithandazo.id_yomntu = abantu.id
            ORDER BY imithandazo.thandazwe_nini DESC'
        );
        $results = $this->db->resultSet();

        return $results;
    }

    public function fakaUmthandazo($data)
    {
        $this->db->query(
            "INSERT INTO imithandazo (
                ngowantoni,
                id_yomntu,
                umthandazo,
                number_of_likes,
                number_comments,
                number_of_complaints,
                thandazwe_nini
                ) VALUE (
                :ngowantoni,
                :id_yomntu,
                :umthandazo,
                :number_of_likes,
                :number_comments,
                :number_of_complaints,
                :thandazwe_nini
            )"
        );
        $this->db->bind(':ngowantoni', $data['ngowantoni']);
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':umthandazo', $data['umthandazo']);
        $this->db->bind(':number_of_likes', 0);
        $this->db->bind(':number_comments', 0);
        $this->db->bind(':number_of_complaints', 0);
        $this->db->bind(':thandazwe_nini', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUmthandazo($data)
    {
        $this->db->query(
            "UPDATE imithandazo SET
                ngowantoni = :ngowantoni,
                umthandazo = :umthandazo,
                updated_at = :updated_at
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':ngowantoni', $data['ngowantoni']);
        $this->db->bind(':umthandazo', $data['umthandazo']);
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUmthandazoById($id)
    {
        $this->db->query(
            "SELECT *,
            imithandazo.id as umbuzoId,
            abantu.id as userId
            FROM imithandazo
            INNER JOIN abantu
            ON imithandazo.id_yomntu = abantu.id WHERE imithandazo.id = :id"
        );
        $this->db->bind(':id', $id);

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
    public function deleteUmthandazo($id)
    {
        $this->db->query("DELETE FROM imithandazo WHERE id = :id");
        $this->db->bind(':id', $id);
        echo $id;

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function phendulaUmthandazo($data)
    {
        $this->db->query(
            "INSERT INTO imithandazo_comments (
                id_yomntu,
                id_yomthandazo,
                impendulo,
                date
            ) VALUE (
                :id_yomntu,
                :id_yomthandazo,
                :impendulo,
                :date
            )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':id_yomthandazo', $data['id']);
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
            imithandazo_comments.id_yomthandazo as umthandazoId,
            abantu.id as userId
            FROM imithandazo_comments
            INNER JOIN abantu
            ON imithandazo_comments.id_yomntu = abantu.id WHERE imithandazo_comments.id_yomthandazo = :id
            ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        return $results;
    }
}
?>