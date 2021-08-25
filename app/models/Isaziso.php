<?php
class Isaziso
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getIzaziso()
    {
        $this->db->query(
            'SELECT *,
            izaziso.id as isazisoId,
            abantu.id as userId
            FROM izaziso
            INNER JOIN abantu
            ON izaziso.id_yomntu = abantu.id
            ORDER BY izaziso.saziswe_nini DESC'
        );
        $results = $this->db->resultSet();

        return $results;
    }

    public function fakaIsaziso($data)
    {
        $this->db->query(
            "INSERT INTO izaziso (
                singantoni,
                id_yomntu,
                isaziso,
                number_of_likes,
                number_comments,
                number_of_complaints,
                saziswe_nini
                ) VALUE (
                :singantoni,
                :id_yomntu,
                :isaziso,
                :number_of_likes,
                :number_comments,
                :number_of_complaints,
                :saziswe_nini
            )"
        );
        $this->db->bind(':singantoni', ucwords(strtolower($data['singantoni'])));
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':isaziso', $data['isaziso']);
        $this->db->bind(':number_of_likes', 0);
        $this->db->bind(':number_comments', 0);
        $this->db->bind(':number_of_complaints', 0);
        $this->db->bind(':saziswe_nini', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateIsaziso($data)
    {
        $this->db->query(
            "UPDATE izaziso SET
                singantoni = :singantoni,
                isaziso = :isaziso,
                updated_at = :updated_at
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':singantoni', $data['singantoni']);
        $this->db->bind(':isaziso', $data['isaziso']);
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getIsazisoById($id)
    {
        $this->db->query(
            "SELECT *,
            izaziso.id as isazisoId,
            abantu.id as userId
            FROM izaziso
            INNER JOIN abantu
            ON izaziso.id_yomntu = abantu.id WHERE izaziso.id = :id
            ");
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
    public function deleteIsaziso($id)
    {
        $this->db->query("DELETE FROM izaziso WHERE id = :id");
        $this->db->bind(':id', $id);
        echo $id;

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function phendulaIsaziso($data)
    {
        $this->db->query(
            "INSERT INTO izaziso_comments (
                id_yomntu,
                id_yesaziso,
                impendulo,
                date
            ) VALUE (
                :id_yomntu,
                :id_yesaziso,
                :impendulo,
                :date
            )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':id_yesaziso', $data['id']);
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
     * Get impendulo yesaziso
     */
    public function getImpenduloById($id)
    {
        $this->db->query(
            "SELECT *,
            izaziso_comments.id_yesaziso as isazisoId,
            abantu.id as userId
            FROM izaziso_comments
            INNER JOIN abantu
            ON izaziso_comments.id_yomntu = abantu.id WHERE izaziso_comments.id_yesaziso = :id
            ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        return $results;
    }
}
?>