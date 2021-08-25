<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Get existing job from model
        $umsebenzi = $this->postModel->getPostBySlug($id);

        //Check for owner
        if ($umsebenzi->id_yomntu != $_SESSION['id_yomntu']) {
            redirect($this->province_slug);
        }
        if ($this->postModel->deleteJob($id)) {
            flash('message_yomsebenzi', 'Umsebenzi wakho has been deleted');
            redirect($this->province_slug);
        } else {
            die('Ikhono into erongo eyenzekileyo');
        }
    } else {
        redirect($this->province_slug);
    }
?>