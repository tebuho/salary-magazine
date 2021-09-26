<?php
/**
 * Cookie to keep a user logged in.
 * PHP version 8.0.9
 */

require_once dirname(__DIR__, 4) . "\libraries\Database.php";

if (isset($_COOKIE["remember_me"])) {

    $cookie = $_COOKIE["remember_me"];
    
    list ($verification_key, $token, $mac) = explode(":", $cookie);

    if (!hash_equals(hash_hmac("sha256", $verification_key . ":" . $token, "secret"), $mac)) {
        return false;
    }
    
    $conn = new Database();
    
    $conn->query(
        "SELECT `token`
        FROM last_login
        WHERE `verification_key` = :verification_key
        ORDER BY `token` ASC"
    );
    
    $conn->bind(":verification_key", $verification_key);
    
    $results = $conn->single();
    
    $user_token = $results->token;

    if (hash_equals($user_token, $token)) {

        $conn->query(
            "SELECT `registration`.`id`, `registration`.`email`, `registration`.`first_name`, `registration`.`role` 
            FROM `registration`
            LEFT JOIN `user_verification`
            ON `registration`.`id` = `user_verification`.`user_id`
            WHERE `verification_key` = :verification_key"
        );
        
        $conn->bind(":verification_key", $verification_key);
        
        $row = $conn->single();
        
        $_SESSION["user_id"] = $row->id;
        
        $_SESSION["email_yomntu"] = $row->email;
        
        $_SESSION["igama_lomntu"] = $row->first_name;
        
        $_SESSION["role"] = $row->role;
    }
}