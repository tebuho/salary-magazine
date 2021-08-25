<?php

$this->db->query(
    "SELECT email, igama,
    job_comments.id_yomntu AS comment_user_id,
    abantu.id AS userId
    FROM job_comments
    INNER JOIN abantu ON job_comments.id_yomntu = abantu.id
    INNER JOIN imisebenzi ON job_id = imisebenzi.id
    WHERE abantu.id <> :id AND imisebenzi.id = :job_id
    ORDER BY update_date DESC
    ");
$this->db->bind(':id', $data['id_yomntu']);
$this->db->bind(':job_id', $data['id']);
$results = $this->db->resultSet();

return $results;

?>