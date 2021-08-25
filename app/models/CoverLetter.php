<?php
class CoverLetter
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getCoverLetters()
    {
        $this->db->query(
            'SELECT *,
            cover_letters.id as cover_letterId,
            abantu.id as userId
            FROM cover_letters
            INNER JOIN abantu
            ON cover_letters.id_yomntu = abantu.id
            ORDER BY cover_letters.ibhalwe_nini DESC'
        );
        $results = $this->db->resultSet();

        return $results;
    }

    public function addCoverLetter($data)
    {
        $this->db->query(
            "INSERT INTO cover_letters (
                ngeyantoni,
                id_yomntu,
                cover_letter,
                number_of_likes,
                number_comments,
                number_of_complaints,
                ibhalwe_nini,
                ilungiswe_nini
                ) VALUE (
                :ngeyantoni,
                :id_yomntu,
                :cover_letter,
                :number_of_likes,
                :number_comments,
                :number_of_complaints,
                :ibhalwe_nini,
                :ilungiswe_nini
            )"
        );
        $this->db->bind(':ngeyantoni', $data['ngeyantoni']);
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':cover_letter', $data['cover_letter']);
        $this->db->bind(':number_of_likes', 0);
        $this->db->bind(':number_comments', 0);
        $this->db->bind(':number_of_complaints', 0);
        $this->db->bind(':ibhalwe_nini', date("Y-m-d H:i:s"));
        $this->db->bind(':ilungiswe_nini', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCoverLetter($data)
    {
        $this->db->query(
            "UPDATE cover_letters SET
                ngeyantoni = :ngeyantoni,
                cover_letter = :cover_letter,
                ibhalwe_nini = :ibhalwe_nini
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':ngeyantoni', $data['ngeyantoni']);
        $this->db->bind(':cover_letter', $data['cover_letter']);
        $this->db->bind(':ibhalwe_nini', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getCoverLetterById($id)
    {
        $this->db->query(
            "SELECT *,
            cover_letters.id as cover_letterId,
            abantu.id as userId
            FROM cover_letters
            INNER JOIN abantu
            ON cover_letters.id_yomntu = abantu.id WHERE cover_letters.id = :id"
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
    public function deleteCoverLetter($id)
    {
        $this->db->query("DELETE FROM cover_letters WHERE id = :id");
        $this->db->bind(':id', $id);
        echo $id;

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert impendulo
     *
     * @param [type] $data
     * @return void
     */
    public function phendulaCoverLetter($data)
    {
        $this->db->query(
            "INSERT INTO cover_letter_comments (
                id_yomntu,
                id_ye_cover_letter,
                impendulo,
                date
            ) VALUE (
                :id_yomntu,
                :id_ye_cover_letter,
                :impendulo,
                :date
            )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':id_ye_cover_letter', $data['id']);
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
     * Get impendulo ye Cover Letter
     */
    public function getImpenduloById($id)
    {
        $this->db->query(
            "SELECT *,
            cover_letter_comments.id_ye_cover_letter as cover_letterId,
            abantu.id as userId
            FROM cover_letter_comments
            INNER JOIN abantu
            ON cover_letter_comments.id_yomntu = abantu.id WHERE cover_letter_comments.id_ye_cover_letter = :id
            ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        return $results;
    }
}
?>