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
            
            if (empty($data["first_name"]) || preg_match("/[0-9]+/", $data["first_name"]) || strlen($data["first_name"]) < 3 || strlen($data["first_name"]) > 25) {

                $data["first_name_err"] = "Must be between 3-25 characters and without numbers";

            }

            if (empty($data["last_name"]) || preg_match("/[0-9]+/", $data["last_name"])) {

                $data["last_name_err"] = "Sicela ufake ifani yakho and make sure akukho manani.";

            }

            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL) || empty($data["email"])) {

                $data["email_err"] = "Check if email address is correct.";

            } else {

                if ($this->userModel->findUserByEmail($data["email"])) {

                    $data["email_err"] = "Ukhona umntu osebenzisa le email.";

                }
            }
            
            if (empty($data["password"]) || strlen($data["password"]) < 6) {

                $data["password_err"] = "Password yakho should be at least 6 characters.";

            }

            if (empty($data["confirm_password"]) || $data["password"] != $data["confirm_password"]) {

                $data["confirm_password_err"] = "Passwords zakho kufuneka zifane.";

            }
            //When there no errors
            if (empty($data["email_err"]) && empty($data["first_name_err"]) && empty($data["last_name_err"]) && empty($data["password_err"]) && empty($data["confirm_password_err"]) ) {
                // Create slug first
                $data["user_slug"] = strtolower($data["first_name"]) . "-" . strtolower($data["last_name"]);

                if (preg_match("/[a-zA-Z\s]+$/", $data["first_name"])) {
                    $data["user_slug"] = explode(" ", $data["user_slug"]);
                    $data["user_slug"] = implode("-", $data["user_slug"]);
                }
                

                $results = $this->userModel->findUserBySlug($data);
                
                if ($results > 0) {

                    $data["user_slug"] = $data["user_slug"] . "-" . $results;
                    
                }
                
                $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
                
                //Generate verification key
                $data["verification_key"] = md5(time() . $data["first_name"] . $data["last_name"]);

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
                    
                    flash("register_success", "Enkosi ngokubhalisa. Ukuze siqiniseke ukuba email yakho iyasebenza sikuthumelele umyalezo kuyo. Sicela uyijonge emva koko ucofe kula link sikuthumelele yona ukuze ukwazi ukungena kwi preference yakho.");

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
                
                flash("confirmation_success", "Enkosi ngokuqinisekisa ukuba i-email address yakho iyasebenza. Ungangena ke ngoku.");
                
                redirect("abantu/login");

            } else {
            
                flash("confirmation_success", "Email address yakho is already verified.");
                
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
            if (empty($data["password"])) {

                $data["password_err"] = "Sicela ufake password yakho";
            }

            //Check for user/email
            if (!$this->userModel->findUserByEmail($data["email"])) {

                //Akhomntu onjalo apha
                $data["email_err"] = "Ha a, akakabikho umntu onjalo apha";

            }

            if (empty($data["email_err"]) && empty($data["password_err"])) {

                //Validated
                //Jonga umntu then umngenise if ukhona
                $loggedInUser = $this->userModel->login($data["email"], $data["password"]);

                $data["ip"] = $_SERVER["REMOTE_ADDR"];
                
                $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $data["ip"]));

                if (!empty($ip_data->geoplugin_region) || !empty($ip_data->geoplugin_city)) {

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
        redirect("abantu/profile/$umntu->id");
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
        if(isset($_SESSION["id_yomntu"])) {
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
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $expires = date("U") + 1800;
            $data = [
                "selector" => $selector,
                "token" => $token,
                "expires" => $expires,
                "url" => URLROOT . "/abantu/resetPassword/" . $selector . "/" . bin2hex($token),
                "email" => trim($_POST["email"]),
                "email_err" => "",
                ];
            
            if (empty($data["email"])) {
                $data["email_err"] = "Kufuneka ufake i-email address yakho.";
            } elseif ($this->userModel->checkResetEmail($data["email"]) == false) {
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
                flash("password_reset_message", "Sikuthumelele umyalezo nge email. Sicela uwujonge and ucofe kula link sikuthumelele yona.");
                redirect("abantu/forgotPassword");
            } else {
                $this->view("abantu/forgotPassword", $data);
            }
        } else {
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
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
                flash("reset_message", "Ikhona into erongo. Make sure uyicofile la link sikuthumelele kwi email address yakho.");
            } else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($token) !== false) {
                    
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
            if(empty($data["password"])) {
                $data["password_err"] = "Sicela ufake i-password yakho entsha";
            } else {
                if (strlen($data["password"]) < 6) {
                    $data["password_err"] = "Password yakho kufuneka ibene characters eziyi 6 at least.";
                }
            }

            //Validate password confirmation
            if(empty($data["confirm_password"])) {
                $data["confirm_password_err"] = "Sicela uphinde ufake i-password yakho entsha nalapha.";
            } else {
                if($data["password"] != $data["confirm_password"]) {
                    $data["confirm_password_err"] = "Make sure ii-passwords zakho ziyafana.";
                }
            }
            
            if (empty($data["password_err"]) && empty($data["confirm_password_err"])) {
                
                $current_date = date("U");
                $token_bin = hex2bin($data["validator"]);
                $db_results = $this->userModel->resetPassword($data["selector"]);
                $token_check = password_verify($token_bin, $db_results->password_reset_token);
                
                if ($token_check == false) {
                    flash("reset_message", "Ikhona into erongo eyenzekileyo. Sicela uphinde.");
                    $this->view("abantu/resetPassword", $data);
                } else {
                    if ($token_check == true) {
                        $token_email = $db_results->password_reset_email;
                        //Get email address yomntu from the database
                        $this->userModel->findUserByEmail($token_email);
                        $new_password = password_hash($data["password"], PASSWORD_DEFAULT);
                        $this->userModel->updatePassword($token_email, $new_password);
                        $this->userModel->deletePassword($token_email);
                    }
                }
                flash("password_reset_message", "Password yakho itshintshile. Ungangena ke ngoku.");
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

    /**
     * Profile yomntu
     */
    public function profile($id)
    {
        $jb_categories = $this->userModel->getJobCategories();

        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                "id" => $id,
                "igama" => trim($_POST["igama"]),
                "fani" => trim($_POST["fani"]),
                "email" => trim($_POST["email"]),
                "phone_number" => trim($_POST["phone_number"]),
                "province" => $_POST["province"],
                "ndawoni" => trim($_POST["ndawoni"]),
                "uyasebenza" => $_POST["uyasebenza"],
                "gender" => isset($_POST["gender"]) ? $_POST["gender"] : "",
                "zazise" => trim($_POST["zazise"]),
                "updated_at" => date("Y-m-d H:i:s")
            ];
            
            //Validate data
            if (empty($data["igama"])) {
                $data["igama_err"] = "Kufuneka ufake igama le company.";
            }
            if (empty($data["fani"])) {
                $data["fani_err"] = "Job title ithini";
            }
            if ($data["province"] == "Khetha") {
                $data["province_err"] = "Kufuneka ukhethe i-province";
            }
            if (empty($data["ndawoni"])) {
                $data["ndawoni_err"] = "Ndawoni pha?";
            }
            if ($data["email"] == "Khetha") {
                $data["email_err"] = "Ngumsebenzi onjani lo?";
            }
            if ($data["uyasebenza"] == "Khetha") {
                $data["uyasebenza_err"] = "Ngumsebenzi wantoni lo?";
            }
            
            //Verify phone numbers
            if (!empty($data["phone_number"]) && !is_numeric($data["phone_number"])) {
                $data["phone_number_err"] = "Phone number yakho kufuneka ibengamanani odwa and kungabikho space in between";
            }
            elseif (!empty($data["phone_number"]) && strlen($data["phone_number"]) != 10) {
                $data["phone_number_err"] = "Phone number yakho kufuneka iqale ngo 0 and ibenamanani alishumi";
            }
            
            if (!empty($data["phone_number_yesibini"]) && !is_numeric($data["phone_number_yesibini"])) {
                $data["phone_number_yesibini_err"] = "Phone number yakho kufuneka ibengamanani odwa and kungabikho space in between";
            }
            elseif (!empty($data["phone_number_yesibini"]) && strlen($data["phone_number_yesibini"]) != 10) {
                $data["phone_number_yesibini_err"] = "Phone number yakho kufuneka iqale ngo 0 and ibenamanani alishumi";
            }

            //Make sure there no errors
            if (empty($data["igama_err"]) && empty($data["province_err"]) && empty($data["ndawoni_err"]) && empty($data["fani_err"]) && empty($data["email_err"]) && empty($data["phone_number_err"]) && empty($data["phone_number_yesibini_err"]) && empty($data["zazise_err"])) {
                //Validated
                if ($this->userModel->updateUmntu($data)) {
                    flash("message_ye_profile", "Personal details zakho have been updated");
                    redirect("abantu/profile/$id");
                } else {
                    die("Ikhona into erongo");
                }
                } else {
                    //Load the view with errors
                    $data["page_title"] = "ERROR";
                    $this->view("abantu/profile", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($id != $_SESSION["id_yomntu"]) {
                redirect("abantu/profile/$id");
            }
            if (!isset($_SESSION["id_yomntu"])) {
                redirect("abantu/login");
            }

            //Default view
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Profile Yakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Profile Yakho",
                "id" => $id,
                "igama" => $user->igama,
                "fani" => $user->fani,
                "email" => $user->email,
                "role" => $user->role,
                "phone_number" => $user->phone_number,
                "phone_number_yesibini" => $user->phone_number_yesibini,
                "zazise" => trim($user->zazise),
                "province" => $user->province,
                "ndawoni" => $user->ndawoni,
                "uyasebenza" => $user->uyasebenza,
                "gender" => $user->gender,
                "job_categories" => $jb_categories,
                "updated_at" => date("Y-m-d H:i:s")
            ];
            
            $this->view("abantu/profile", $data);
        }
    }

    /************************************************
     *                                              *
     * Get user's Primary/Secondary Education       *
     *                                              *
     ************************************************/
    public function primarySecondaryEducation($id)
    {
        $user = $this->userModel->getUserById($id);
        $education  = $this->userModel->getEducation($id);

        //Get an array of years from 1980
        $years = array_combine(range(date("Y"), 1980), range(date("Y"), 1980));

        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "id" => $id,
                "id_yomntu" => $_SESSION["id_yomntu"],
                "grade" => $_POST["grade"],
                "school" => $_POST["school"],
                "year" => $_POST["year"],
                "igama" => $user->igama,
                "fani" => $user->fani,
                "role" => $user->role,
                "grade_err" => "",
                "school_err" => "",
                "year_err" => "",
                "created_at" => date("Y-m-d H:i:s")
            ];
            
            //Validate data
            if (empty($data["grade"])) {
                $data["grade_err"] = "Grade bani?";
            }
            if (empty($data["year"])) {
                $data["year_err"] = "Ugqibe nini?";
            }
            if (empty($data["school"])) {
                $data["school_err"] = "Igama le s'kolo?";
            }
            
            //Make sure there no errors
            if (empty($data["grade_err"]) && empty($dta["year_err"]) && empty($data["school_err"])) {
                
                //Validated
                if ($this->userModel->addEducation($data)) {
                    flash("message_ye_education", "Education yakho ingenile. Ba unayo enye ungayifaka.");
                    redirect("abantu/education/primarySecondaryEducation/$id");
                } else {
                    die("Ikhona into erongo");
                }
            } else {
                //Load the view with errors
                $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                $data["page_description"] = "Education Yakho";
                $data["page_type"] = "website";
                $data["page_url"] = URLROOT . "/" . $_GET["url"];
                $data["page_title"] = "Primary/Secondary Education Yakho";
                $data["years"] = $years;
                $data["created_at"] = date("Y-m-d H:i:s");
                $data["page_title"] = "ERROR";
                $this->view("abantu/primarySecondaryEducation", $data);
            }
        } else {
            
            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION["id_yomntu"]) {
                redirect("abantu/primarySecondaryEducation/$id");
            }
            
            if (!isset($_SESSION["id_yomntu"])) {
                redirect("abantu/login");
            }

            //Default view
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Education Yakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Primary/Secondary Education Yakho",
                "id" => $id,
                "igama" => $user->igama,
                "fani" => $user->fani,
                "role" => $user->role,
                "education" => $education,
                "grade" => "",
                "school" => "",
                "year" => "",
                "level_passed" => "",
                "institution" => "",
                "course" => "",
                "year_passed" => "",
                "years" => $years,
                "created_at" => date("Y-m-d H:i:s")
            ];

            if (!empty($education)) {

                $data["grade"] = $education->grade;
                $data["school"] = $education->school;
                $data["year"] = $education->year;
                $data["igama"] = $education->igama;
                $data["fani"] = $education->fani;
            }
            
            $this->view("abantu/primarySecondaryEducation", $data);
        }

    }
    public function tertiaryEducation($id)
    {

        $user = $this->userModel->getUserById($id);
        $tertiary  = $this->userModel->getTertiaryEducation($id);

        //Get an array of years from 1980
        $years = array_combine(range(date("Y"), 1980), range(date("Y"), 1980));

        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "id" => $id,
                "id_yomntu" => $_SESSION["id_yomntu"],
                "level_passed" => $_POST["level_passed"],
                "institution" => $_POST["institution"],
                "course" => $_POST["course"],
                "year_passed" => $_POST["year_passed"],
                "igama" => $user->igama,
                "fani" => $user->fani,
                "role" => $user->role,
                "course_err" => "",
                "level_passed_err" => "",
                "institution_err" => "",
                "year_passed_err" => "",
                "created_at" => date("Y-m-d H:i:s")
            ];

            $data["level_passed"] = implode(", ", array_values($data["level_passed"]));
            $data["institution"] = implode(", ", array_values($data["institution"]));
            $data["course"] = implode(", ", array_values($data["course"]));
            $data["year_passed"] = implode(", ", array_values($data["year_passed"]));
            
            //Validate data
            if (empty($data["level_passed"])) {
                $data["level_passed_err"] = "Level passed?";
            }
            if (empty($data["year_passed"])) {
                $dta["year_passed_err"] = "Ugqibe nini?";
            }
            if (empty($data["institution"])) {
                $data["institution_err"] = "Igama le s'kolo?";
            }
            if (empty($data["course"])) {

                $data["course_err"] = "Igama le course?";
            }
            //Make sure there no errors
            if (empty($data["level_passed_err"]) && empty($dta["year_passed_err"]) && empty($data["institution_err"])) {
                    
                //Validated
                if ($this->userModel->addTertiaryEducation($data)) {
                    flash("message_ye_education", "Education yakho ingenile. Ba unayo enye ungayifaka.");
                    redirect("abantu/tertiaryEducation/$id");
                } else {
                    die("Ikhona into erongo");
                }
            } else {
                //Load the view with errors
                $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                $data["page_description"] = "Education Yakho";
                $data["page_type"] = "website";
                $data["page_url"] = URLROOT . "/" . $_GET["url"];
                $data["page_title"] = "Primary/Secondary Education Yakho";
                $data["years"] = $years;
                $data["created_at"] = date("Y-m-d H:i:s");
                $data["page_title"] = "ERROR";
                if(empty($tertiary)) {
                    $data["level_passed"] = "Khetha";
                    $data["institution"] = "";
                    $data["tertiary_education"][] = (object) [ 
                            "level_passed" => "",
                            "institution" => "",
                            "course" => "",
                            "year_passed" => "",
                    ];
                }
                $this->view("abantu/tertiaryEducation", $data);
            }
        } else {
            
            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION["id_yomntu"]) {
                redirect("abantu/tertiaryEducation/$id");
            }
            
            if (!isset($_SESSION["id_yomntu"])) {
                redirect("abantu/login");
            }

            //Default view
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Education Yakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Tertiary Education Yakho",
                "id" => $id,
                "igama" => $user->igama,
                "fani" => $user->fani,
                "role" => $user->role,
                "level_passed" => "",
                "institution" => "",
                "course" => "",
                "year_passed" => "",
                "years" => $years,
                "tertiary" => $tertiary,
                "created_at" => date("Y-m-d H:i:s")
            ];

            if (!empty($tertiary)) {
                
                foreach($tertiary as $key => $value) {
                    
                    $data["level_passed"] = explode(", ", $value->level_passed);
                    $data["course"] = explode(", ", $value->course);
                    $data["institution"] = explode(", ", $value->institution);
                    $data["year_passed"] = explode(", ", $value->year_passed);
                    $data["igama"] = $value->igama;
                    $data["fani"] = $value->fani;
                    
                }

                if (count($data["level_passed"]) > 0) {
                    for ($i = 0; $i < count($data["level_passed"]); $i++) {
                            
                        $education[] = (object) [
                            "level_passed" => $data["level_passed"][$i],
                            "institution" => $data["institution"][$i],
                            "course" => $data["course"][$i],
                            "year_passed" => $data["year_passed"][$i],
                            ];
                        $data["tertiary_education"] = $education;
                    }
                }
                
            }

            if(empty($tertiary)) {
                $data["level_passed"] = "Khetha";
                $data["institution"] = "";
                $data["tertiary_education"][] = (object) [ 
                        "level_passed" => "",
                        "institution" => "",
                        "course" => "",
                        "year_passed" => "",
                ];
            }

            $this->view("abantu/tertiaryEducation", $data);
        }
    }

    public function experience($id)
    {
        
        $user = $this->userModel->getUserById($id);
        $experience  = $this->userModel->getExperience($id);

        //Get an array of years from 1980
        $years = array_combine(range(date("Y"), 1980), range(date("Y"), 1980));

        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if(!isset($_POST["usasebenza_apha"])) {
                $_POST["usasebenza_apha"] = "";
            }

            $data = [
                "id_yomntu" => $id,
                "company" => filter_var_array($_POST["company"]),
                "job_title" => filter_var_array($_POST["job_title"]),
                "start_year" => filter_var_array($_POST["start_year"]),
                "ugqibe_nini" => filter_var_array($_POST["ugqibe_nini"]),
                "responsibilities" => filter_var_array($_POST["responsibilities"]),
                "reason_for_leaving" => filter_var_array($_POST["reason_for_leaving"]),
                "usasebenza_apha" => filter_var_array($_POST["usasebenza_apha"]),
                "created_at" => date("Y-m-d H:i:s"),
                "years" => $years,
                "company_err" => "",
                "job_title_err" => "",
                "usasebenza_apha_err" => "",
                "start_year_err" => "",
                "ugqibe_nini_err" => "",
                "responsibilities_err" => "",
            ];
            
             $data["company"] = implode(", ", array_values($data["company"]));
             $data["job_title"] = implode(", ", array_values($data["job_title"]));
             $data["start_year"] = implode(", ", array_values($data["start_year"]));
             $data["responsibilities"] = implode(", ", array_values($data["responsibilities"]));
             $data["ugqibe_nini"] = implode(", ", array_values($data["ugqibe_nini"]));

                if (count($data["reason_for_leaving"]) > 1) {
                    $data["reason_for_leaving"] = implode(", ", array_values($data["reason_for_leaving"]));
                }
                $data["usasebenza_apha"] = implode(", ", array_values($data["usasebenza_apha"]));
            
            //Error messages
            if (empty($data["company"])) {

                $data["company_err"] = "Igama le company?";
            }
            if (empty($data["job_title"])) {

                $data["job_title_err"] = "Job title ithini?";
            }
            if (empty($data["usasebenza_apha"])) {

                $data["usasebenza_apha_err"] = "Usasebenza apha?";
            }
            if (empty($data["start_year"]) || $data["start_year"] == "Khetha") {

                $data["start_year_err"] = "Uqale ngowuphi unyaka?";
            }
            if (empty($data["responsibilities"])) {

                $data["responsibilities_err"] = "Wenze ntoni na ntoni?";
            }
            
            //Validated
            if (empty($data["company_err"]) && empty($data["job_title_err"]) && empty($data["start_year_err"]) && empty($data["usasebenza_apha_err"]) && empty($data["responsibilities_err"])) {
                
                if (isset($data["company"])) {

                    if ($this->userModel->addExperience($data)) {
                        flash("message_ye_experience", "Experience yakho ingenile. Ba unayo enye ungayifaka.");
                        redirect("abantu/experience/$id");
                    } else {
    
                    }
                }
            } else {
                
                //If user did not fill one or more input field(s) load page with error mmessage(s)
                $data["page_title"] = "ERROR";
                $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                $data["page_url"] = URLROOT . "/" . $_GET["url"];
                $data["page_type"] = "website";
                $data["page_description"] = "Experience Yakho";

                $this->view("abantu/experience", $data);
            }
        } else {
            $user = $this->userModel->getUserById($id);
            $experience  = $this->userModel->getExperience($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION["id_yomntu"]) {
                redirect("abantu/experience/" . $_SESSION["id_yomntu"]);
            }

            if (!isset($_SESSION["id_yomntu"])) {
                redirect("abantu/login");
            }
            
            //Default view
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Experience Yakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Experience Yakho",
                "id_yomntu" => $id,
                "igama" => "",
                "fani" => "",
                "role" => $user->role,
                "experiences" => $experience,
                "years" => $years,
                "company" => "",
                "job_title" =>"",
                "start_year" => "",
                "ugqibe_nini" => "",
                "responsibilities" => "",
                "reason_for_leaving" => "",
                "usasebenza_apha" => "",
                "ck_editor_id" => "",
                "created_at" => date("Y-m-d H:i:s")
            ];
            
            if ( !empty($data["experiences"]) ) {

                foreach($data["experiences"] as $experience) {
                    $data["company"] = explode(", ", $experience->company);
                    $data["job_title"] = explode(", ", $experience->job_title);
                    $data["start_year"] = explode(", ", $experience->uqale_nini);
                    $data["ugqibe_nini"] = explode(", ", $experience->ugqibe_nini);
                    $data["responsibilities"] = explode(", ", $experience->responsibilities);
                    $data["reason_for_leaving"] = explode(", ", $experience->reason_for_leaving);
                    $data["usasebenza_apha"] = explode(", ", $experience->usasebenza_apha);
                    $data["igama"] = $experience->igama;
                    $data["fani"] = $experience->fani;

                    
                    for ($i = 0; $i < count($data["company"]); $i++) {
                        $data["ck_editor_id"] = $i;
                        
                        if ( empty($data["ugqibe_nini"]) ) {
                            $data["ugqibe_nini"] = "-";
                        }
    
                        if( empty($data["reason_for_leaving"]) ) {
                            $data["reason_for_leaving"] = "-";
                        }
                            
                        $work_experiences = [
                            $i => ( object ) [
                                "id_yomntu" => $id,
                                "company" => $data["company"][$i],
                                "job_title" => $data["job_title"][$i],
                                "start_year" => $data["start_year"][$i],
                                "ugqibe_nini" => $data["ugqibe_nini"][$i],
                                "responsibilities" => $data["responsibilities"][$i],
                                "reason_for_leaving" => $data["reason_for_leaving"][$i],
                                "usasebenza_apha" => $data["usasebenza_apha"][$i],
                                "ck_editor_id" => $i
                            ],
                        ];
    
                        $new_work_experiences[] = $work_experiences[$i];
                        $data["work_experiences"] = $new_work_experiences;
                        $experience_json = $data["work_experiences"];
                        
                        //Create JSON file with user's work experience
                        $work_experience = json_encode($experience_json);
                        $fp = fopen("experience.json", "w");
                        fwrite($fp, $work_experience);
                        fclose($fp);
                    }
                }

                $all_experiences  = $this->userModel->getUsersExperiences();
                
                if ( !empty($all_experiences) ) {
                    
                    $id_yomntu = implode(", ", array_column($all_experiences, "id_yomntu"));
                    $company = implode(", ", array_column($all_experiences, "company"));
                    $job_title = implode(", ", array_column($all_experiences, "job_title"));
                    $uqale_nini = implode(", ", array_column($all_experiences, "uqale_nini"));
                    $ugqibe_nini = implode(", ", array_column($all_experiences, "ugqibe_nini"));
                    $responsibilities = implode(", ", array_column($all_experiences, "responsibilities"));
                    $reason_for_leaving = implode(", ", array_column($all_experiences, "reason_for_leaving"));
                    $usasebenza_apha = implode(", ", array_column($all_experiences, "usasebenza_apha"));
                        
                    $id_yomntu = explode(", ", $id_yomntu);
                    $company = explode(", ", $company);
                    $job_title = explode(", ", $job_title);
                    $start_year = explode(", ", $uqale_nini);
                    $ugqibe_nini = explode(", ", $ugqibe_nini);
                    $responsibilities = explode(", ", $responsibilities);
                    $reason_for_leaving = explode(", ", $reason_for_leaving);
                    $usasebenza_apha = explode(", ", $usasebenza_apha);
                    
                    for ($i = 0; $i < count($data["company"]); $i++) {
                        
                        if ( empty($data["ugqibe_nini"]) ) {
                            $data["ugqibe_nini"] = "-";
                        }
    
                        if( empty($data["reason_for_leaving"]) ) {
                            $data["reason_for_leaving"] = "-";
                        }
                            
                        $work_experiences = [
                             (object) [
                                "id_yomntu" => $id_yomntu,
                                "company" => $company,
                                "job_title" => $job_title,
                                "start_year" => $start_year,
                                "ugqibe_nini" => $ugqibe_nini,
                                "responsibilities" => $responsibilities,
                                "reason_for_leaving" => $reason_for_leaving,
                                "usasebenza_apha" => $usasebenza_apha,
                                "ck_editor_id" => $i,
                            ],
                        ];
                    }
                        
                    $new_work_experiences = $work_experiences;
                    $experience_json = $new_work_experiences;

                    foreach($new_work_experiences as $new_work_experience) {
                        for($i =0; $i <count($new_work_experience->company); $i++) {
                            $test = [
                                $i =>
                                    (object) [
                                        "id_yomntu" => $new_work_experience->id_yomntu,
                                        "company" => $new_work_experience->company[$i],
                                        "job_title" => $new_work_experience->job_title[$i],
                                        "start_year" => $new_work_experience->start_year[$i],
                                        "ugqibe_nini" => $new_work_experience->ugqibe_nini[$i],
                                        "responsibilities" => $new_work_experience->responsibilities[$i],
                                        "reason_for_leaving" => $new_work_experience->reason_for_leaving[$i],
                                        "usasebenza_apha" => $new_work_experience->usasebenza_apha[$i]
                                    ]
                                    ];
                        }
                        
                    }

                }
            } else {
                        
                $work_experiences = [
                    0 => (object) [
                        "id_yomntu" => $id,
                        "company" => "",
                        "job_title" => "",
                        "start_year" => "",
                        "ugqibe_nini" => "",
                        "responsibilities" => "",
                        "reason_for_leaving" => "",
                        "usasebenza_apha" => "",
                        "ck_editor_id" => 0
                    ]
                ];
                
                $new_work_experiences = $work_experiences;
                $data["work_experiences"] = $new_work_experiences;

            }


            $this->view("abantu/experience", $data);
        }
    }

    public function skills($id)
    {
        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $data = [
                "id_yomntu" => $id,
                "skill" => filter_var_array($_POST["skill"]),
                "skill_err" => "",
                "created_at" => date("Y-m-d H:i:s")
            ];
            $data["skill"] = implode(", ", $data["skill"]);

            //Validate data
            if (empty($data["skill"])) {
                $data["skill_err"] = "skill?";
            }

            //Make sure there no errors
            if ( empty($data["skill_err"]) ) {
                //Validated
                if ($this->userModel->addSkills($data)) {
                    flash("message_ye_skills", "Dankie, ba unaso esinye ungasifaka.");
                    redirect("abantu/skills/$id");
                } else {
                    die("Ikhona into erongo");
                }
            } else {
                    //Load the view with errors
                    $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                    $data["page_description"] = "Skills Zakho";
                    $data["page_type"] = "website";
                    $data["page_url"] = URLROOT . "/" . $_GET["url"];
                    $data["page_title"] = "Skills Zakho";
                    $data["id_yomntu"] = $id;
                    $data["page_title"] = "ERROR";
                $this->view("abantu/skills", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);
            $skills  = $this->userModel->getSkills($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION["id_yomntu"]) {
                redirect("abantu/skills/$id");
            }
            
            //Default view
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Skills Zakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Skills Zakho",
                "id_yomntu" => $id,
                "igama" => "",
                "fani" => "",
                "role" => $user->role,
                "skills" => $skills,
                "skill" => "",
                "created_at" => date("Y-m-d H:i:s")
            ];
            
            foreach ( $data["skills"] as $skill ) {
                $data["skills"] = explode(", ", $skill->skill);
                $data["igama"] =  $skill->igama;
                $data["fani"] =  $skill->fani;
            }
            
            $this->view("abantu/skills", $data);
        }
    }

    /**
     * Achievements
     *
     * @param [type] $id
     * @return void
     */
    public function achievements($id)
    {
        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "id_yomntu" => $id,
                "achievement_name" => trim($_POST["achievement_name"]),
                "company" => trim($_POST["company"]),
                "year" => trim($_POST["year"]),
                "created_at" => date("Y-m-d H:i:s")
            ];

            //Validate data
            if (empty($data["achievement_name"])) {
                $data["achievement_name_err"] = "Kufuneka ukhethe i-achievement_name";
            }
            if (empty($data["company"])) {
                $data["company_err"] = "company zithini?";
            }
            if (empty($data["year"])) {
                $data["year_err"] = "Level yeyear ithini";
            }

            //Make sure there no errors
            if (
                empty($data["achievement_name_err"])
                && empty($data["company_err"])
                && empty($dta["year_err"])
            ) {
                //Validated
                if ($this->userModel->addAchievements($data)) {
                    flash("message_ye_achievements", "achievements yakho ingenile. Ba unayo enye ungayifaka.");
                    redirect("abantu/achievements/$id");
                } else {
                    die("Ikhona into erongo");
                }
                } else {
                    //Load the view with errors
                    $data["page_title"] = "ERROR";
                    $this->view("abantu/achievements", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);
            $achievements = $this->userModel->getAchievements($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION["id_yomntu"]) {
                redirect("abantu/achievements/$id");
            }
            //Update user
            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Achievements Zakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Achievements Zakho",
                "id_yomntu" => $id,
                "achievements" => $achievements,
                "achievement_name" => "",
                "company" =>"",
                "year" => "",
                "created_at" => date("Y-m-d H:i:s")
            ];
            $this->view("abantu/achievements", $data);
        }
        $this->view("abantu/achievements");
    }
    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Get existing job from model
            $umsebenzi = $this->postModel->getPostBySlug($id);

            //Check for owner
            if ($umsebenzi->id_yomntu != $_SESSION["id_yomntu"]) {
                redirect("abantu");
            }
            if ($this->postModel->deleteJob($id)) {
                flash("message_yomsebenzi", "Umsebenzi wakho has been deleted");
                redirect("abantu");
            } else {
                die("Ikhono into erongo eyenzekileyo");
            }
        } else {
            redirect("abantu");
        }
    }

    /************************************************
     *                                              *
     *          Set user"s job preferences          *
     *                                              *
     ************************************************/
    public function preference($id)
    {

        $jb_categories = $this->userModel->getJobCategories();

        $user = $this->userModel->getJobPreferences($id);

        if (!isset($_SESSION["id_yomntu"])) {
            redirect("abantu/login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    "id" => $id,
                    "igama" => $user[0]->igama,
                    "fani" => $user[0]->fani,
                    "role" => $user[0]->role,
                    "id_yomntu" => $_SESSION["id_yomntu"],
                    "job_title" => $_POST["job_title"],
                    "education" => $_POST["education"],
                    "experience" => $_POST["experience"],
                    "onjani" => $_POST["onjani"],
                    "categories" => $_POST["categories"],
                    "provinces" => $_POST["provinces"],
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                    "job_title_err" => "",
                    "education_err" => "",
                    "experience_err" => "",
                    "onjani_err" => "",
                    "categories_err" => "",
                    "province_err" => ""
                ];
            
            if (is_array($data["education"])) {

                $data["job_title"] = implode(", ", array_values($data["job_title"]));
                $data["education"] = implode(", ", array_values($data["education"]));
                $data["experience"] = implode(", ", array_values($data["experience"]));
                $data["onjani"] = implode(", ", array_values($data["onjani"]));
                $data["categories"] = implode(", ", array_values($data["categories"]));
                $data["provinces"] = implode(", ", array_values($data["provinces"]));

                // $sql = "INSERT INTO `fbdata`($columns) VALUES ($values)";
            }

            //Make sure there no errors
            if (empty($data["job_title_err"]) && empty($data["education_err"]) && empty($data["provinces_err"]) && empty($data["onjani_err"]) && empty($data["experience_err"]) && empty($data["categories_err"])) {
                
                //Validated
                if ($this->userModel->addJobPreferences($data)) {
                    flash("message_ye_profile", "Personal details zakho have been updated");
                    redirect("abantu/preference/$id");
                } else {
                    die("Ikhona into erongo");
                }
                } else {
                    //Load the view with errors

                    if (!empty($user)) {

                        $data = [
                            "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                            "page_description" => "Profile Yakho",
                            "page_type" => "website",
                            "page_url" => URLROOT . "/" . $_GET["url"],
                            "page_title" => "Preferences",
                            "id" => $id,
                            "igama" => $user->igama,
                            "fani" => $user->fani,
                            "role" => $user->role,
                            "job_title" => $user->job_title,
                            "experience" => $user->experience,
                            "categories" => $user->categories,
                            "province" => $user->provinces,
                            "onjani" => $user->onjani,
                            "job_categories" => $jb_categories,
                            "created_at" => date("Y-m-d H:i:s")
                        ];
                    } else {

                        $data = [
                            "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                            "page_description" => "Profile Yakho",
                            "page_type" => "website",
                            "page_url" => URLROOT . "/" . $_GET["url"],
                            "page_title" => " Tebu Profile Yakho",
                            "id" => $id,
                            "igama" => $user->igama,
                            "fani" => $user->fani,
                            "fani" => $user->fani,
                            "role" => $user->role,
                            "job_categories" => $jb_categories,
                            "created_at" => date("Y-m-d H:i:s")
                        ];
                    }
                    
                    $this->view("abantu/preference", $data);
                }
        } else {

            /********************************************
             *                                          *
             *  Default view for user job preferences   *
             *                                          *
             ********************************************/
            
            foreach($user as $ppl) {
                $user = $ppl;
            }

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($id != $_SESSION["id_yomntu"]) {
                redirect("abantu/preference/$id");
            }

            $data = [
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Profile Yakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Profile Yakho",
                "id" => $id,
                "igama" => $user->igama,
                "fani" => $user->fani,
                "role" => $user->role,
                "job_title" => "",
                "education" =>  "",
                "experience" => "",
                "categories" => "",
                "provinces" => "",
                "onjani" => "",
                "job_categories" => $jb_categories,
                "checked" => "",
                "created_at" => date("Y-m-d H:i:s")
            ];

            if (!empty($user)) {
                $data["job_title"] = $user->job_title;
                $data["education"] =  explode(", ", $user->education);
                $data["experience"] = explode(", ", $user->experience);
                $data["categories"] = explode(", ", $user->categories);
                $data["provinces"] = explode(", ", $user->provinces);
                $data["onjani"] = explode(", ", $user->onjani);

                $data["jb_education"] =  createString($data["education"]);
                $data["jb_provinces"] =  createString($data["provinces"]);
                $data["jb_experience"] =  createString($data["experience"]);
                $data["jb_categories"] =  createString($data["categories"]);
                $data["jb_onjani"] =  createString($data["onjani"]);

                $jobs = $this->userModel->getUserJobs($data);
                
                foreach($jobs as $job)  {
                    switch ($job->province) {
                        case 'Eastern Cape':
                            $province_slug = "easternCapeJobs";
                            break;
                        case 'Free State':
                            $province_slug = "freeStateJobs";
                            break;
                        case 'Gauteng':
                            $province_slug = "gautengJobs";
                            break;
                        case 'KwaZulu-Natal':
                            $province_slug = "kwaZuluNatalJobs";
                            break;
                        case 'Limpopo':
                            $province_slug = "limpopoJobs";
                            break;
                        case 'Mpumalanga':
                            $province_slug = "mpumalangaJobs";
                            break;
                        case 'North West':
                            $province_slug = "northWestJobs";
                            break;
                        case 'Northern Cape':
                            $province_slug = "northernCapeJobs";
                            break;
                        case 'Western Cape':
                            $province_slug = "westernCapeJobs";
                            break;
                    }
                }

                $data["user_preferences"][] = (object) [
                    "job_title" => $data["job_title"]
                ];
                
            }

           if (!isset($data["job_title"])) {

            $data["job_title"] = "";

           }
           
            $this->view("abantu/preference", $data);
        }
    }

   /*********************************
    *                               *
    *         Get a user"s CV       *
    *                               *
    *********************************/
    public function cv($id)
    {
        $user_cv = $this->userModel->getCV($id);
        $cv_comments = $this->userModel->getImpenduloById($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!empty($user_cv) ) {
                foreach ( $user_cv as $cv ) {
                    $data = [
                        "id" => $id,
                        "commenter_id" => $_SESSION["id_yomntu"],
                        "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                        "page_description" => "Profile Yakho",
                        "page_type" => "website",
                        "page_url" => URLROOT . "/" . $_GET["url"],
                        "page_title" => "Curriculum Vitae ka " . $cv->igama . " " . $cv->fani,
                        "igama" => $cv->igama,
                        "fani" => $cv->fani,
                        "email" => $cv->email,
                        "role" => $cv->role,
                        "province" => $cv->province,
                        "ndawoni" => $cv->ndawoni,
                        "zazise" => $cv->zazise,
                        "company" => $cv->company,
                        "job_title" => $cv->job_title,
                        "responsibilities" => $cv->responsibilities,
                        "uqale_nini" => $cv->uqale_nini,
                        "ugqibe_nini" => $cv->ugqibe_nini,
                        "grade" => $cv->grade,
                        "school" => $cv->school,
                        "year" => $cv->year,
                        "skill" => $cv->skill,
                        "level_passed" => $cv->level_passed,
                        "institution" => $cv->institution,
                        "year_passed" => $cv->year_passed,
                        "course" => $cv->course,
                        "comments" => $cv_comments,
                        "work_experience" => "",
                        "tertiary_education" => "",
                        "skills" => "",
                        "comment" => $_POST["comment"],
                        "comment_err" => "",
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s")
                    ];
                }
                
            } else {
                $user = $this->userModel->getUserById($id);
                
                $data = [
                    "id" => $id,
                    "commenter_id" => $_SESSION["id_yomntu"],
                    "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                    "page_description" => "Profile Yakho",
                    "page_type" => "website",
                    "page_url" => URLROOT . "/" . $_GET["url"],
                    "page_title" => "Curriculum Vitae ka " . $user->igama . " " . $user->fani,
                    "igama" => $user->igama,
                    "fani" => $user->fani,
                    "email" => $user->email,
                    "role" => $user->role,
                    "province" => $user->province,
                    "ndawoni" => $user->ndawoni,
                    "zazise" => $user->zazise,
                    "comments" => $cv_comments,
                    "company" => "",
                    "job_title" => "",
                    "responsibilities" => "",
                    "uqale_nini" => "",
                    "ugqibe_nini" => "",
                    "grade" => "",
                    "school" => "",
                    "year" => "",
                    "skill" => "",
                    "level_passed" => "",
                    "institution" => "",
                    "year_passed" => "",
                    "course" => "",
                    "work_experience" => "",
                    "tertiary_education" => "",
                    "skills" => "",
                    "comment" => $_POST["comment"],
                    "comment_err" => "",
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                ];
            }

            //Check if comment data is not empty
            if (empty($data["comment"]) ) {
                $data["comment_err"] = "Comment?";
            }

            if (empty($data["comment_err"]) ) {
                if ($user_comments = $this->userModel->addCVComment($data)) {
                    flash("message_ye_profile", "Personal details zakho have been updated");
                    redirect("abantu/cv/$id");
                } else {
                    die("Ikhona into erongo");
                }
            } else {
                //Load the view with errors

                        error("comment_error", "Ikhona into erongo");

                        $data["page_image"] = URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png";
                        $data["page_description"] = "Profile Yakho";
                        $data["page_type"] = "website";
                        $data["page_url"] = URLROOT . "/" . $_GET["url"];
                        $data["page_title"] = "ERROR";
            }
        
            /************************* Tertiary Education ***********************/
            
    
            $data["level_passed"] = explode(", ", $data["level_passed"]);
            $data["institution"] = explode(", ", $data["institution"]);
            $data["year_passed"] = explode(", ", $data["year_passed"]);
            $data["course"] = explode(", ", $data["course"]);
            
            for ( $x = 0; $x < count($data["course"]); $x++ ) {
                $tertiary_education[] = (object) [
                    "level_passed" => $data["level_passed"][$x],
                    "institution" => $data["institution"][$x],
                    "year_passed" => $data["year_passed"][$x],
                    "course" => $data["course"][$x]
                ];
            }
            
            $data["tertiary_education"] = $tertiary_education;
            
            /************************* Work Experience ***********************/
            
            $data["company"] = explode(", ", $data["company"]);
            $data["job_title"] = explode(", ", $data["job_title"]);
            $data["responsibilities"] = explode("</ul>, ", $data["responsibilities"]);
            $data["uqale_nini"] = explode(", ", $data["uqale_nini"]);
            $data["ugqibe_nini"] = explode(", ", $data["ugqibe_nini"]);
                
            for($i = 0; $i < count($data["company"]); $i++){
                $work_experience[] = (object) [
                    "id" => $data["id"],
                    "company" => $data["company"][$i],
                    "job_title" => $data["job_title"][$i],
                    "responsibilities" => $data["responsibilities"][$i],
                    "uqale_nini" => $data["uqale_nini"][$i],
                    "ugqibe_nini" => $data["ugqibe_nini"][$i]
                    ];
            }
            $data["work_experience"] = $work_experience;
            /************************* Skills ***********************/
    
            $data["skill"] = explode(", ", $data["skill"]);
            
            for ( $x = 0; $x < count($data["skill"]); $x++ ) {
                $skills[] = (object) [
                    "skill" => $data["skill"][$x]
                ];
            }
            
            $data["skills"] = $skills;
            $this->view("abantu/cv", $data);
        }

        if (!empty($user_cv) ) {
            foreach ( $user_cv as $cv ) {
                $data = [
                    "id" => $id,
                    "commenter_id" => $_SESSION["id_yomntu"],
                    "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                    "page_description" => "Profile Yakho",
                    "page_type" => "website",
                    "page_url" => URLROOT . "/" . $_GET["url"],
                    "page_title" => "Curriculum Vitae ka " . $cv->igama . " " . $cv->fani,
                    "igama" => $cv->igama,
                    "fani" => $cv->fani,
                    "email" => $cv->email,
                    "role" => $cv->role,
                    "province" => $cv->province,
                    "ndawoni" => $cv->ndawoni,
                    "zazise" => $cv->zazise,
                    "company" => $cv->company,
                    "job_title" => $cv->job_title,
                    "responsibilities" => $cv->responsibilities,
                    "uqale_nini" => $cv->uqale_nini,
                    "ugqibe_nini" => $cv->ugqibe_nini,
                    "grade" => $cv->grade,
                    "school" => $cv->school,
                    "year" => $cv->year,
                    "skill" => $cv->skill,
                    "level_passed" => $cv->level_passed,
                    "institution" => $cv->institution,
                    "year_passed" => $cv->year_passed,
                    "course" => $cv->course,
                    "comments" => $cv_comments,
                    "work_experience" => "",
                    "tertiary_education" => "",
                    "skills" => "",
                    "comment" => "",
                    "created_at" => date("Y-m-d"),
                    "updated_at" => date("Y-m-d")
                ];
            }
        } else {
            $user = $this->userModel->getUserById($id);
            
            $data = [
                "id" => $id,
                "commenter_id" => $_SESSION["id_yomntu"],
                "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
                "page_description" => "Profile Yakho",
                "page_type" => "website",
                "page_url" => URLROOT . "/" . $_GET["url"],
                "page_title" => "Curriculum Vitae ka " . $user->igama . " " . $user->fani,
                "igama" => $user->igama,
                "fani" => $user->fani,
                "email" => $user->email,
                "role" => $user->role,
                "province" => $user->province,
                "ndawoni" => $user->ndawoni,
                "zazise" => $user->zazise,
                "comments" => $cv_comments,
                "company" => "",
                "job_title" => "",
                "responsibilities" => "",
                "uqale_nini" => "",
                "ugqibe_nini" => "",
                "grade" => "",
                "school" => "",
                "year" => "",
                "skill" => "",
                "level_passed" => "",
                "institution" => "",
                "year_passed" => "",
                "course" => "",
                "work_experience" => "",
                "tertiary_education" => "",
                "skills" => "",
                "comment" => "",
                "created_at" => date("Y-m-d"),
                "updated_at" => date("Y-m-d")
            ];
        }
        
        /************************* Tertiary Education ***********************/
        

        $data["level_passed"] = explode(", ", $data["level_passed"]);
        $data["institution"] = explode(", ", $data["institution"]);
        $data["year_passed"] = explode(", ", $data["year_passed"]);
        $data["course"] = explode(", ", $data["course"]);
        
        for ( $x = 0; $x < count($data["course"]); $x++ ) {
            $tertiary_education[] = (object) [
                "level_passed" => $data["level_passed"][$x],
                "institution" => $data["institution"][$x],
                "year_passed" => $data["year_passed"][$x],
                "course" => $data["course"][$x]
            ];
        }
        
        $data["tertiary_education"] = $tertiary_education;
        
        /************************* Work Experience ***********************/
        
        $data["company"] = explode(", ", $data["company"]);
        $data["job_title"] = explode(", ", $data["job_title"]);
        $data["responsibilities"] = explode("</ul>, ", $data["responsibilities"]);
        $data["uqale_nini"] = explode(", ", $data["uqale_nini"]);
        $data["ugqibe_nini"] = explode(", ", $data["ugqibe_nini"]);
            
        for($i = 0; $i < count($data["company"]); $i++){
            $work_experience[] = (object) [
                "id" => $data["id"],
                "company" => $data["company"][$i],
                "job_title" => $data["job_title"][$i],
                "responsibilities" => $data["responsibilities"][$i],
                "uqale_nini" => $data["uqale_nini"][$i],
                "ugqibe_nini" => $data["ugqibe_nini"][$i]
                ];
        }
        $data["work_experience"] = $work_experience;
        
        /************************* Skills ***********************/

        $data["skill"] = explode(", ", $data["skill"]);
        
        for ( $x = 0; $x < count($data["skill"]); $x++ ) {
            $skills[] = (object) [
                "skill" => $data["skill"][$x]
            ];
        }
        
        $data["skills"] = ($skills);

        $this->view("abantu/cv", $data);
    }
    public function toets()
    {
        $results = $this->userModel->getAllUsers();
        $data = [
            'abantu' => $results
        ];
        $this->view('abantu/toets', $data);
    }
    
    public function beta()
    {
        $results = $this->userModel->getAllUsers();
        $data = [
            "page_image" => URLROOT . "/public/img/western-cape-jobs/westernCapeJobs.png",
            "page_description" => "Kufuneka uungene apha xa ufuna ukufaka imisebenzi, imibuzo, imithandazo, izaziso, cover letters, blogs nokuba yinxalenye ye Salary Magazine.",
            "page_type" => "website",
            "page_url" => URLROOT . "/" . $_GET["url"],
            "page_title" => "Beta",
            'abantu' => $results
        ];
        $this->view('abantu/beta', $data);
    }
    
    // All jobs by user
    public function umntu() {
        $data["id_yomntu"] = $_SESSION["id_yomntu"];

        $umntu_jb = $this->userModel->getJobsByUser($data);
        var_dump($umntu_jb);
        $this->view("abantu/umntu", $data);
    }



}