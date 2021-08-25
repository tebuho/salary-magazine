<?php

$this->db->query(
    "SELECT comment, update_date, igama, fani, email,
    job_comments.job_id as jobId,
    abantu.id as userId
    FROM job_comments
    INNER JOIN abantu
    ON job_comments.id_yomntu = abantu.id WHERE job_comments.job_id = :id
    ORDER BY pub_date DESC
    ");
$this->db->bind(':id', $id);
$results = $this->db->resultSet();

return ($results);

?>