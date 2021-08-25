<?php

$this->db->query(
    "SELECT * FROM imisebenzi WHERE label = :label AND province = :province AND id != :id"
 );
 
 $this->db->bind(':id', $data['job_id']);
 $this->db->bind(':label', $data['label']);
 $this->db->bind(":province", $data['province']);
 $results = $this->db->resultSet();
 return $results;

?>