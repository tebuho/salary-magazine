<?php

/**
 * User controller
 */
class Abantu extends Controller {

    public $provinces;
    public $province;
    public $province_slug;

    /**
     * Constructor
     * Method
     */
    public function __construct()
    {
        $this->userModel = $this->model("Umntu");
    }

    /**
     * Register new user
     *
     * @return void
     */
    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Kufuneka ubhalisa apha xa ufuna ukufaka imisebenzi, imibuzo, imithandazo, izaziso, cover letters, blogs nokuba yinxalenye ye Salary Magazine.",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Kubhaliswa Apha",
                "first_name" => ucwords(strtolower(trim($_POST["first_name"]))),
                "last_name" => trim($_POST["last_name"]),
                "user_slug" => "",
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "confirm_password" => trim($_POST["confirm_password"]),
                "role" => "Member",
                "verified" => 0,
                "verification_key" => "",
                "first_name_err" => "",
                "last_name_err" => "",
                "email_err" => "",
                "password_err" => "",
                "confirm_password_err" => "",
            ];
            
            if (empty($data["first_name"])
                || preg_match("/[0-9]+/", $data["first_name"])
                || strlen($data["first_name"]) < 3
                || strlen($data["first_name"]) > 25
            ) {
                $data["first_name_err"] = "Must be between 3-25 characters and without numbers";
            }

            if (empty($data["last_name"])
                || preg_match("/[0-9]+/", $data["last_name"])
            ) {
                $data["last_name_err"] = "Sicela ufake ifani yakho and make sure akukho manani.";
            }

            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)
                || empty($data["email"])
            ) {
                $data["email_err"] = "Check if email address is correct.";
            } else {
                if ($this->userModel->findUserByEmail($data["email"])) {
                    $data["email_err"] = "Ukhona umntu osebenzisa le email.";
                }
            }
            
            if (empty($data["password"]) || strlen($data["password"]) < 6) {
                $data["password_err"]
                    = "Password yakho should be at least 6 characters.";
            }

            if (empty($data["confirm_password"])
                || $data["password"] != $data["confirm_password"]
            ) {
                $data["confirm_password_err"]
                    = "Passwords zakho kufuneka zifane.";
            }

            //When there no errors
            if (empty($data["email_err"])
                && empty($data["first_name_err"])
                && empty($data["last_name_err"])
                && empty($data["password_err"])
                && empty($data["confirm_password_err"])
            ) {
                // Create slug first
                $data["user_slug"]
                    = strtolower($data["first_name"])
                    . "-" . strtolower($data["last_name"]);

                if (preg_match("/[a-zA-Z\s]+$/", $data["first_name"])) {
                    $data["user_slug"] = explode(" ", $data["user_slug"]);
                    $data["user_slug"] = implode("-", $data["user_slug"]);
                }

                $results = $this->userModel->findUserBySlug($data);
                
                if ($results > 0) {
                    $data["user_slug"] = $data["user_slug"] . "-" . $results;
                }
                
                $data["password"]
                    = password_hash($data["password"], PASSWORD_DEFAULT);
                
                //Generate verification key
                $data["verification_key"]
                    = md5(time() . $data["first_name"] . $data["last_name"]);

                //Register user
                if ($this->userModel->registerUser($data)) {
                    $user_info = $this->userModel->findNewUser($data);
                    $data["user_id"] = $user_info->id;

                    // Insert verification info into database
                    $this->userModel->insertVerification($data);
                    
                    //Confirm email address
                    $to = $data["email"];
                    $subject = "Confirm email address yakho";
                    $message = "Hi " . $data['first_name'] . ", enkosi ngokubhalisa kwi website yethu salarymagazine.co.za. Sicela ucofe kule link to confirm le email address and uzokutsho ukwazi ukungena kwi website yethu nje ngomnye wethu. <a href='https://salarymagazine.co.za/abantu/confirm/" . $data['verification_key'] . "'>Cofa apha</a>";
                    $headers = "From: Salary Magazine <info@salarymagazine.co.za> \r\n";
                    $headers .= "MIME-VERSION: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset:utf-8" . "\r\n";
                    mail($to, $subject, $message, $headers);
                    
                    //New member registration notification
                    $to = "info@salarymagazine.co.za";
                    $subject = "Notification: New Salary Magazine Member";
                    $message = $data["first_name"] . " " . $data["last_name"] . " usandokubhalisa.";
                    $headers = "From: Salary Magazine <info@salarymagazine.co.za> \r\n";
                    $headers .= "MIME-VERSION: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset:utf-8" . "\r\n";
                    $headers .= "Bcc: sisekogwegwe@gmail.com" . "\r\n";
                    mail($to, $subject, $message, $headers);
                    
                    flash(
                        "register_success",
                        "Enkosi ngokubhalisa. Ukuze siqiniseke ukuba email yakho iyasebenza sikuthumelele umyalezo kuyo. Sicela uyijonge emva koko ucofe kula link sikuthumelele yona ukuze ukwazi ukungena kwi preference yakho."
                    );

                    redirect("abantu/login");
                } else {
                    die("Ikhona into eyenzekileyo erongo");
                }
            } else {
                //Load view with errors
                $data["page_title"] = "ERROR";
                $this->view("abantu/register", $data);
            }

        } else {
            //Init data
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Kufuneka ubhalise apha xa ufuna ukufaka imisebenzi, imibuzo, imithandazo, izaziso, cover letters, blogs nokuba yinxalenye ye Salary Magazine.",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Kubhaliswa Apha",
                "first_name" => "",
                "last_name" => "",
                "email" => "",
                "ndawoni" => "",
                "password" => "",
                "confirm_password" => "",
                "first_name_err" => "",
                "email_err" => "",
                "password_err" => "",
                "confirm_password_err" => "",
            ];

            //Load view
            $this->view("abantu/register", $data);
        }
    }
        
    /**
     * Confirm email address
     *
     * @param [type] $verification_key
     * @return void
     */
    public function confirm($verification_key)
    {
        $data = [
            "user_id" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($user_info->verified == 0) {
                $user_info = $this->userModel->verifyUmntu($verification_key);
                $this->userModel->getvKey($verification_key);
                $data["user_id"] = $user_info->id;
                
                // Update verification status on the database
                $this->userModel->updateVerification($data);
                
                flash(
                    "confirmation_success",
                    "Enkosi ngokuqinisekisa ukuba i-email address yakho iyasebenza. Ungangena ke ngoku."
                );
                
                redirect("abantu/login");
            } else {
                flash(
                    "confirmation_success",
                    "Email address yakho is already verified."
                );
                redirect("abantu/login");
            }
        }
    }

    /**
     * Log user in
     *
     * @return void
     */
    public function login()
    {
        //Check for POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Process form
            $data = [
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "province" => "Unknown",
                "city" => "Uknown",
                "email_err" => "",
                "password_err" => "",
                "verified_err" => ""
            ];

            //Validate email
            if (empty($data["email"])) {
                $data["email_err"] = "Sicela ufake email yakho";
            }
            
            //Validate password
            if (empty($data["password"])
                || !$this->userModel->verifyLoginPass(
                    $data["email"], $data["password"]
                )
            ) {
                $data["password_err"] = "Check password is correct";
            }

            //Check for user/email
            if (!$this->userModel->findUserByEmail($data["email"])) {
                //Akhomntu onjalo apha
                $data["email_err"] = "Ha a, akakabikho umntu onjalo apha";
            }

            if (empty($data["email_err"])
                && empty($data["password_err"])
            ) {
                //Jonga umntu then umngenise if ukhona
                $loggedInUser = $this->userModel->login($data["email"], $data["password"]);
                $data["ip"] = $_SERVER["REMOTE_ADDR"];
                $ip_data = @json_decode(
                    file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $data["ip"])
                );

                if (!empty($ip_data->geoplugin_region)
                    || !empty($ip_data->geoplugin_city)
                ) {
                    $data["province"] = $ip_data->geoplugin_region;
                    $data["city"] = $ip_data->geoplugin_city;
                }
                
                $data["verification_key"] = $loggedInUser->verification_key;
                $data["token"] = openssl_random_pseudo_bytes(16);
                $data["token"] = bin2hex($data["token"]);
                $this->userModel->updateIp($data);
                
                $cookie = $loggedInUser->verification_key . ":" . $data["token"];
                $mac = hash_hmac("sha256", $cookie, "secret");
                $cookie .= ":" . $mac;
                
                setcookie('remember_me', $cookie, time() + 60*60*24*365, "/", "", "", true);
                
                if ($loggedInUser && $loggedInUser->verified == 1) {
                    //Qala i-session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data["password_err"] = "Password yakho irongo okanye khange uyicofe la link sikuthumelele kwi email address yakho after ubhalisile.";
                    //Load view with errors
                    $data["page_title"] = "ERROR";
                    $data["page_url"] = URLROOT . "/" . $_GET["url"];
                    $data["page_type"] = "website";
                    $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                    $data["page_description"] = "Check to see awenzanga mistake";
                    $this->view("abantu/login", $data);
                }
            } else {
                //Load view with errors
                $data["page_title"] = "ERROR";
                $data["page_url"] = URLROOT . "/" . $_GET["url"];
                $data["page_type"] = "website";
                $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                $data["page_description"] = "Check to see awenzanga mistake";
                $this->view("abantu/login", $data);
            }
        } else {
            //Init data
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Kufuneka uungene apha xa ufuna ukufaka imisebenzi, imibuzo, imithandazo, izaziso, cover letters, blogs nokuba yinxalenye ye Salary Magazine.",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Kungenwa Apha",
                "email" => "",
                "password" => "",
                "email_err" => "",
                "password_err" => "",
            ];

            //Load view
            $this->view("abantu/login", $data);
        }
    }
    
    /**
     * Create session
     *
     * @param [type] $umntu
     * @return void
     */
    public function createUserSession($umntu)
    {
        $_SESSION["id_yomntu"] = $umntu->id;
        $_SESSION["email_yomntu"] = $umntu->email;
        $_SESSION["igama_lomntu"] = $umntu->first_name;
        $_SESSION["role"] = $umntu->role;
        if ($_SESSION["role"] = "Admin") {
            redirect("");
        }
        redirect("addJobs/add");
    }
    
    /**
     * Log user out
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION["id_yomntu"]);
        unset($_SESSION["email_yomntu"]);
        unset($_SESSION["igama_lomntu"]);
        unset($_SESSION["role"]);

        setcookie(
            'remember_me', 
            $loggedInUser->verification_key, 
            time() - 60*60*24*365, "/"
        );

        session_destroy();
        redirect("");
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION["id_yomntu"])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Forgot password
     */
    public function forgotPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $expires = date("U") + 1800;
            $forgot_url = "/abantu/resetPassword/" . $selector . "/";
            
            $data = [
                "selector" => $selector,
                "token" => $token,
                "expires" => $expires,
                "url" => URLROOT . $forgot_url . bin2hex($token),
                "email" => trim($_POST["email"]),
                "email_err" => "",
                ];
            
            if (empty($data["email"])) {
                $data["email_err"] = "Kufuneka ufake i-email address yakho.";
            } elseif (!$this->userModel->checkResetEmail($data["email"])) {
                $data["email_err"] = "Email efana nale asinayo kwi system yethu.";
            }
            
            if (empty($data["email_err"])) {
                $this->userModel->deletePassword($data);
                $this->userModel->insertPassword($data);

                //Confirm email address
                $to = $data["email"];
                $subject = "Tshintsha i-Password Yakho";
                $message = "Hi, sikuthumelele lomyalezo kuba ufuna ukutshintsha i-password yakho kwi website yethu <a href='https://salarymagazine.co.za/'>salarymagazine.co.za</a>. Sicela ucofe kule link ukuze ukwazi ukutshintsha i-password yakho <a href='" . $data['url'] . "'>" . $data['url'] . "</a>. If awufuni ukuyitshintsha, sicela ungawuhoyi lomyalezo.";
                $headers = "From: Salary Magazine <info@salarymagazine.co.za> \r\n";
                $headers .= "MIME-VERSION: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset:utf-8" . "\r\n";
                
                mail($to, $subject, $message, $headers);
                
                flash(
                    "password_reset_message",
                    "Sikuthumelele umyalezo nge email. Sicela uwujonge and ucofe kula link sikuthumelele yona."
                );
                redirect("abantu/forgotPassword");
            } else {
                $this->view("abantu/forgotPassword", $data);
            }
        } else {
            $page_url = "/public/img/western-cape-jobs/westernCapeJobs.png";
            
            $data = [
                "page_image" => URLROOT . $page_url,
                "page_description" => "Faka i-email address yakho ukuze sizokuthumelela indlela ozokuyitshintsha ngayo i-password yakho.",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Password Yakho Uyilibele?",
                "email" => "",
                "email_err" => ""
            ];
            
            $this->view("abantu/forgotPassword", $data);
        }
    }

    /**
     * Reset Password
     *
     * @param [type] $selector
     * @param [type] $token
     * @return void
     */
    public function resetPassword($selector, $token)
    {
        /**
         * Load Reset Password Page
         */
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data = [
                "selector" => $selector,
                "validator" => $token,
                ];
            
            if (empty($selector) || empty($token)) {
                flash(
                    "reset_message",
                    "Ikhona into erongo. 
                    Make sure uyicofile la link sikuthumelele kwi email address yakho."
                );
            } else {
                if (ctype_xdigit($selector) !== false
                    && ctype_xdigit($token) !== false
                ) {
                    $this->view("abantu/resetPassword", $data);
                }
            }
        }
        
        /**
         * Process & Reset Password
         */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                "selector" => trim($_POST["selector"]),
                "validator" => trim($_POST["validator"]),
                "password" => trim($_POST["password"]),
                "confirm_password" => trim($_POST["confirm_password"]),
                "password_err" => "",
                "confirm_password_err" => "",
            ];
            
            //Validate password
            if (empty($data["password"])) {
                $data["password_err"] = "Sicela ufake i-password yakho entsha";
            } else {
                if (strlen($data["password"]) < 6) {
                    $data["password_err"]
                        = "Password yakho kufuneka ibene characters eziyi 6 at least.";
                }
            }

            //Validate password confirmation
            if (empty($data["confirm_password"])) {
                $data["confirm_password_err"]
                    = "Sicela uphinde ufake i-password yakho entsha nalapha.";
            } else {
                if ($data["password"] != $data["confirm_password"]) {
                    $data["confirm_password_err"]
                        = "Make sure ii-passwords zakho ziyafana.";
                }
            }
            
            if (empty($data["password_err"]) 
                && empty($data["confirm_password_err"])
            ) {
                $current_date = date("U");
                $token_bin = hex2bin($data["validator"]);
                $db_results = $this->userModel->resetPassword($data["selector"]);
                $token_check = password_verify(
                    $token_bin,
                    $db_results->password_reset_token
                );
                
                if ($token_check == false) {
                    flash(
                        "reset_message",
                        "Ikhona into erongo eyenzekileyo. Sicela uphinde."
                    );
                    $this->view("abantu/resetPassword", $data);
                } else {
                    if ($token_check == true) {
                        $token_email = $db_results->password_reset_email;
                        //Get email address yomntu from the database
                        $this->userModel->findUserByEmail($token_email);
                        $new_password = password_hash(
                            $data["password"], PASSWORD_DEFAULT
                        );
                        $this->userModel->updatePassword(
                            $token_email, $new_password
                        );
                        $this->userModel->deletePassword($token_email);
                    }
                }

                flash(
                    "password_reset_message",
                    "Password yakho itshintshile. Ungangena ke ngoku."
                );
                redirect("abantu/login");

            } else {
                $this->view("abantu/resetPassword", $data);
            }
        } else {
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Yifake apha i-password yakho entsha.",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Reset Password Yakho",
                "selector" => "",
                "validator" => "",
                "password" => "",
                "confirm_password" => "",
                "password_err" => "",
                "confirm_password_err" => "",
            ];

            $this->view("abantu/resetPassword", $data);
        }
    }
}