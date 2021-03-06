<?php
    
$umsebenzi = $this->postModel->getPostBySlug($slug);
$user = $this->postModel->getUserById($umsebenzi->user_id);
$comment = $this->postModel->getImpenduloById($umsebenzi->id);
$article_ad = '<div class="pr-0 pl-0"><div class="google-ad__container"><div class="google-ad"><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><ins class="adsbygoogle" style="display:block" data-ad-format="fluid" data-ad-layout-key="-6r+dz+1l-2o+4u" data-ad-client="ca-pub-1034834624649462" data-ad-slot="7207707222"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div></div></div>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data = [
        "id" => $umsebenzi->id,
        "comment" => $_POST(trim($_POST["comment"])),
        "user_id" => $_SESSION["user_id"],
        "date" => date("Y-m-d H:i:s"),
        "comment_err" => ""
    ];
    
    //Validate data
    if (empty($data["comment"])) {

        $data["comment_err"] = "Comment yakho?";

    }

    //Make sure there no errors
    if (empty($data["comment_err"])) {

        //Validated
        if ($this->postModel->addComment($data)) {

            $user_commented = $this->postModel->getUserEmail($data);

            if (!empty($user_commented)) {

                foreach($user_commented as $commenter) {
                    
                    //Send notification email to the person who asked the question
                    $to = $commenter->email;
                    $subject = "Comment entsha";
                    $message = "Hi " . $commenter->igama . ", u-$user->igama usandokuphendula kula mebenzi ubukhomente kuye. Ungayijonga lempendulo<a href='". URLROOT . "/$this->province_slug/umsebenzi/$umsebenzi->slug" . "'> ngokucofa apha</a>";
                    $headers = "From: Salary Magazine <info@salarymagazine.co.za> \r\n";
                    $headers .= "MIME-VERSION: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset:utf-8" . "\r\n";
                    $headers .= "Bcc: info@salarymagazine.co.za" . "\r\n";
                    mail($to, $subject, $message, $headers);

                }

            }
            
            flash("comment_message", "Comment yakho ingenile");

            redirect("$this->province_slug/umsebenzi/$slug");

        } else {

            die("Ikhona into erongo");

        }

    } else {

            //Load the view with errors

            $data = [
                "page_image" => URLROOT . "/img/imisebenzi/" . $umsebenzi->image,
                "page_description" => strip_tags($umsebenzi->job_requirements),
                "page_type" => "article",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => $umsebenzi->label,
                "umsebenzi" => $umsebenzi,
                "job_slug" => $umsebenzi->slug,
                "job_employer" => $umsebenzi->job_employer,
                "experience" => $umsebenzi->experience,
                "category" => $umsebenzi->job_category,
                "job_type" => $umsebenzi->job_type,
                "job_location" => $umsebenzi->job_location,
                "job_education" => $umsebenzi->job_education,
                "jb_specification" => $umsebenzi->jb_specification,
                "today" => time(),
                "pub_date" => strtotime($umsebenzi->job_date_published),
                "date_diff" => "",
                "since_pub_date" => "",
                "results" => "",
                "umntu" => $user,
                "comments" => $comment,
                "comment_err" => "Comment ayikwazi ukuba empty",
                "pos" => strpos($umsebenzi->job_employer, "University"),
            ];
            
            flash("comment_error", "Comment yakho ayikwazi ukuba empty", "border border-danger p-2");
        
            if (!empty($data["umsebenzi"]->purpose) AND !empty($data["umsebenzi"]->skills_competencies) AND !empty($data["umsebenzi"]->additional_info)) {
                $data["jb_specification"] = "<h3>Purpose</h3>" . $data["umsebenzi"]->purpose;
                $data["jb_specification"] .= "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info;
            } elseif (!empty($data["umsebenzi"]->purpose) AND !empty($data["umsebenzi"]->skills_competencies)) {
                $data["jb_specification"] = "<h3>Purpose</h3>" . $data["umsebenzi"]->purpose;
                $data["jb_specification"] .= "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;
            } elseif (!empty($data["umsebenzi"]->purpose) AND !empty($data["umsebenzi"]->additional_info)) {
                $data["jb_specification"] = "<h3>Purpose</h3>" . $data["umsebenzi"]->purpose;
                $data["jb_specification"] .= "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;
                $data["jb_specification"] .= "<h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info;
            } elseif (!empty($data["umsebenzi"]->purpose)) {
                $data["jb_specification"] = "<h3>Purpose</h3>" . $data["umsebenzi"]->purpose;
                $data["jb_specification"] .= "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;
            } elseif (!empty($data["umsebenzi"]->skills_competencies) AND !empty($data["umsebenzi"]->additional_info)) {
                $data["jb_specification"] = "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= "<h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;
                $data["jb_specification"] .= "<h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info;
            } elseif (!empty($data["umsebenzi"]->skills_competencies)) {
                $data["jb_specification"] = "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= "<h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;
            } elseif (!empty($data["umsebenzi"]->additional_info)) {
                $data["jb_specification"] = "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;
                $data["jb_specification"] .= $article_ad;
                $data["jb_specification"] .= "<h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info;
            } elseif (!empty($data["umsebenzi"]->job_requirements) AND !empty($data["umsebenzi"]->job_responsibilities)) {
                $data["jb_specification"] = "<h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements;
                $data["jb_specification"] .= "<h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities;  
            }
            
            $data["date_diff"] = ($data["today"] - $data["pub_date"]);
            $data["since_pub_date"] = round($data["date_diff"] / (60 * 60 * 24));
            
            $data["results"] = $this->postModel->getEminyeImisebenzi($data);

            $this->view("$this->province_slug/umsebenzi", $data);

    }

} else {
    
    $data = [
        "page_image" => URLROOT . "/img/imisebenzi/" . $umsebenzi->image,
        "page_description" => strip_tags($umsebenzi->job_requirements),
        "page_type" => "article",
        "page_url" => URLROOT . "/" . $_GET["url"],
        "page_title" => $umsebenzi->label,
        "umsebenzi" => $umsebenzi,
        "job_slug" => $umsebenzi->slug,
        "job_employer" => $umsebenzi->job_employer,
        "experience" => $umsebenzi->experience,
        "category" => $umsebenzi->job_category,
        "job_type" => $umsebenzi->job_type,
        "job_location" => $umsebenzi->job_location,
        "job_education" => $umsebenzi->job_education,
        "jb_specification" => $umsebenzi->jb_specification,
        "today" => time(),
        "pub_date" => strtotime($umsebenzi->job_date_published),
        "date_diff" => "",
        "since_pub_date" => "",
        "results" => "",
        "umntu" => $user,
        "comments" => $comment,
        "pos" => strpos($umsebenzi->job_employer, "University"),
    ];
    
    switch($data['umsebenzi']->job_employer) {
        case "Independent Communications Authority of South Africa":
            $data['umsebenzi']->job_employer = "ICASA";
            break;
        case "PSG Management Services":
            $data['umsebenzi']->job_employer = "PSG";
            break;
    }

    if (!empty($data["umsebenzi"]->purpose) AND !empty($data["umsebenzi"]->skills_competencies) AND !empty($data["umsebenzi"]->additional_info)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Purpose</h3>" . $data["umsebenzi"]->purpose . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info . '</div>';
    } elseif (!empty($data["umsebenzi"]->purpose) AND !empty($data["umsebenzi"]->skills_competencies)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Purpose</h3>" . $data["umsebenzi"]->purpose . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';
    } elseif (!empty($data["umsebenzi"]->purpose) AND !empty($data["umsebenzi"]->additional_info)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Purpose</h3>" . $data["umsebenzi"]->purpose . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info . '</div>';
    } elseif (!empty($data["umsebenzi"]->purpose)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Purpose</h3>" . $data["umsebenzi"]->purpose . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';
    } elseif (!empty($data["umsebenzi"]->skills_competencies) AND !empty($data["umsebenzi"]->additional_info)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info . '</div>';
    } elseif (!empty($data["umsebenzi"]->skills_competencies)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Skills & Competencies</h3>" . $data["umsebenzi"]->skills_competencies . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';
    } elseif (!empty($data["umsebenzi"]->additional_info)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';
        $data["jb_specification"] .= $article_ad;
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Additional Information</h3>" . $data["umsebenzi"]->additional_info . '</div>';
    } elseif (!empty($data["umsebenzi"]->job_requirements) AND !empty($data["umsebenzi"]->job_responsibilities)) {
        $data["jb_specification"] = "<div class='highlight-grey'><h3>Requirements</h3>" . $data["umsebenzi"]->job_requirements . '</div>';
        $data["jb_specification"] .= "<div class='highlight-grey'><h3>Responsibilities</h3>" . $data["umsebenzi"]->job_responsibilities . '</div>';  
    }
    
    $data["date_diff"] = ($data["today"] - $data["pub_date"]);
    $data["since_pub_date"] = round($data["date_diff"] / (60 * 60 * 24));
    
    $data["results"] = $this->postModel->getEminyeImisebenzi($data);

}
    
    
?>