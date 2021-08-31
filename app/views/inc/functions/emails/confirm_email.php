<?php
function send_confirm_email($email, $vkey, $first_name) {
    
    $to = $email;
    $subject = "Confirm email address yakho";
    $message
        = "Hi " . $first_name
        . ", enkosi ngokubhalisa kwi website yethu
        &nbsp;<a href='https://salarymagazine.co.za'>
        salarymagazine.co.za</a>. Sicela ucofe kule link to
        confirm le email address and uzokutsho ukwazi
        ukungena kwi website yethu nje ngomnye wethu.
        <a href='https://salarymagazine.co.za/abantu/confirm/"
        . $vkey . "'>Cofa apha</a>";

    $headers = "From: Salary Magazine <info@salarymagazine.co.za> \r\n";
    $headers .= "MIME-VERSION: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset:utf-8" . "\r\n";
    mail($to, $subject, $message, $headers);
}

?>