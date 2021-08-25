<?php

$this->db->query(
    "INSERT INTO job_comments (
        job_id,
        id_yomntu,
        comment,
        pub_date
    ) VALUE (
        :job_id,
        :id_yomntu,
        :comment,
        :pub_date
    )"
);
$this->db->bind(':id_yomntu', $data['id_yomntu']);
$this->db->bind(':job_id', $data['id']);
$this->db->bind(':comment', $data['comment']);
$this->db->bind(':pub_date', $data['date']);

//Execute
if ($this->db->execute()) {
    return true;
} else {
    return false;
}

?>