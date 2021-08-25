<?php

/**
 * User model
 */
class Umntu
{
    private $db;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Register user
     *
     * @param [type] $email
     * @return void
     */
    public function registerUser($data)
    {

        $this->db->query(
            "INSERT INTO `registration` (
                `first_name`,
                `last_name`,
                `user_slug`,
                `email`,
                `role`,
                `password`,
                `registration_date`
                ) VALUE (
                    :first_name,
                    :last_name,
                    :user_slug,
                    :email,
                    :role,
                    :password,
                    now())"
        );

        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':user_slug', $data['user_slug']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':password', $data['password']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Insert verification details
     *
     * @param [type] $email
     * @return void
     */
    public function insertVerification($data)
    {
        $this->db->query(
            "INSERT INTO `user_verification` (
                `user_id`,
                `verification_key`,
                `verified`
            ) 
            VALUES (
                :user_id,
                :verification_key,
                :verified
            )"
        );

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':verification_key', $data['verification_key']);
        $this->db->bind(':verified', $data['verified']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Update user verified status
     *
     * @param [type] $verification_key
     * @return void
     */
    public function getvKey($verification_key)
    {

        $this->db->query(
            "UPDATE `user_verification`
            SET verified = 1
            WHERE verification_key = :verification_key"
        );

        $this->db->bind(':verification_key', $verification_key);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Record date user is verified
     *
     * @param [type] $data
     * @return void
     */
    public function updateVerification($data)
    {

        $this->db->query(
            "INSERT INTO `verified_user` (`user_id`, `date`)
            VALUES (:user_id, now())"
        );
        
        $this->db->bind(':user_id', $data["user_id"]);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Verify umntu after confirming password
     *
     * @param [type] $verification_key
     * @return void
     */
    public function verifyUmntu($verification_key)
    {

        $this->db->query(
            "SELECT *
            FROM user_verification
            WHERE verification_key = :verification_key"
        );
        
        $this->db->bind(':verification_key', $verification_key);

        $row = $this->db->single();
        return $row;

    }
    
    /**
     * Log user in
     *
     * @param [type] $email
     * @param [type] $password
     * @return void
     */
    public function login($email, $password)
    {

        $this->db->query(
            'SELECT `user_verification`.`verified`, `user_verification`.`verification_key`, `registration`.`password`, `registration`.`id`, `registration`.`email`, `registration`.`role`, `registration`.`first_name`, `registration`.`last_name`
            FROM user_verification
            INNER JOIN `registration`
            ON  `user_verification`.`user_id` = `registration`.`id`
            WHERE `registration`.`email` = :email');

        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        $hashed_password = $row->password;
        
        if (password_verify($password, $hashed_password)) {

            return $row;

        } else {

            return false;

        }

    }

    /**
     * Update umntu
     */
    public function updateUmntu($data)
    {
        $this->db->query(
            "UPDATE abantu SET
                igama = :igama,
                fani = :fani,
                email = :email,
                province = :province,
                ndawoni = :ndawoni,
                uyasebenza = :uyasebenza,
                gender = :gender,
                zazise = :zazise,
                phone_number = :phone_number,
                updated_at = :updated_at
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':igama', $data['igama']);
        $this->db->bind(':fani', $data['fani']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':ndawoni', $data['ndawoni']);
        $this->db->bind(':uyasebenza', $data['uyasebenza']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':zazise', $data['zazise']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by user_slug
    public function findUserBySlug($data)
    {
        $this->db->query(
            'SELECT *
            FROM registration
            INNER JOIN user_verification
            ON `registration`.`id` = `user_verification`.`user_id`
            WHERE user_slug = :user_slug AND `verified` = :verified'
        );
        
        $this->db->bind(':user_slug', $data["user_slug"]);
        $this->db->bind(':verified', 1);

        $results = $this->db->rowCount();
        return $results;
    }

    // Find new registered user
    public function findNewUser($data)
    {
        $this->db->query(
            'SELECT `id`
            FROM registration
            WHERE `email` = :email');
        $this->db->bind(':email', $data["email"]);

        $results = $this->db->single();
        return $results;
    }
    //Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM `registration` WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $this->db->query(
            "SELECT igama, fani, email, province, ndawoni, CONCAT(LEFT(igama, 1),LEFT(fani, 1)) AS initials, role, zazise, phone_number, phone_number_yesibini, uyasebenza, gender
            FROM abantu
            WHERE id = :id
            ");
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    /**
     * Get all users
     */
    public function getAllUsers()
    {
        $this->db->query(
            'SELECT id, igama, fani, email, province, ndawoni, bhalise_nini FROM abantu'
        );
        $results = $this->db->resultSet();
        return $results;
    }
    /**
     * Check Reset Password
     */
     public function checkResetEmail($email)
     {
         $this->db->query("SELECT email FROM abantu WHERE email = :email");
         $this->db->bind(":email", $email);
            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
     }
    
    /**
     * Reset Password
     */
     public function deletePassword($email)
     {
         $this->db->query("DELETE FROM password_reset WHERE password_reset_email = :email");
         $this->db->bind(":email", $email);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
     }
    
    /**
     * Insert New Password
     */
     public function insertPassword($data)
     {
         $this->db->query(
             "INSERT INTO password_reset (
                 password_reset_email,
                 password_reset_selector,
                 password_reset_token,
                 password_reset_expires
             ) VALUES (
                 :email,
                 :selector,
                 :token,
                 :expires
                 )"
             );
         $this->db->bind(":email", $data['email']);
         $this->db->bind(":selector", $data['selector']);
         $this->db->bind(":token", password_hash($data['token'], PASSWORD_DEFAULT));
         $this->db->bind(":expires", $data['expires']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
     }
    
    /**
     * Reset Password
     */
     public function resetPassword($selector)
     {
        $current_date = date("U");
        
         $this->db->query("SELECT * FROM password_reset WHERE password_reset_selector = :selector AND password_reset_expires >= $current_date");
         $this->db->bind(":selector", $selector);

        $row = $this->db->single();
        return $row;
     }
    
    /**
     * Update Password
     */
     public function updatePassword($email, $new_password)
     {
        
         $this->db->query("UPDATE abantu SET password = :new_password WHERE email = :email_yomntu");
         $this->db->bind(":email_yomntu", $email);
         $this->db->bind(":new_password", $new_password);
    
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
     }

    /**
     * Eduction
     */
    public function addEducation($data)
    {
        $this->db->query(
            "INSERT INTO primary_secondary_education (
                id_yomntu,
                grade,
                school,
                year,
                created_at,
                updated_at
                ) VALUE (
                    :id_yomntu,
                    :grade,
                    :school,
                    :year,
                    :created_at,
                    :updated_at
                )
                ON DUPLICATE KEY UPDATE
                grade = :grade,
                school = :school,
                year = :year,
                updated_at = :updated_at
                "
        );
        $this->db->bind(':grade', $data['grade']);
        $this->db->bind(':school', $data['school']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':id_yomntu', $data['id']);
        $this->db->bind(':created_at', $data['created_at']);
        $this->db->bind(':updated_at', $data['created_at']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get Education
     */
     public function getEducation($id)
     {
         $this->db->query(
             "SELECT *,
             primary_secondary_education.id as primary_secondary_education_id, igama, fani
             FROM primary_secondary_education
             INNER JOIN abantu
             ON primary_secondary_education.id_yomntu = abantu.id
             WHERE primary_secondary_education.id_yomntu = :id
             ORDER BY primary_secondary_education.created_at DESC"
             );
             
             $this->db->bind(":id", $id);

             $row = $this->db->single();
             return $row;
     }

     public function addTertiaryEducation($data)
     {
         $this->db->query(
             "INSERT INTO tertiary_education (
                 id_yomntu,
                 level_passed,
                 course,
                 institution,
                 year_passed,
                 created_at,
                 updated_at
                 ) VALUE (
                     :id_yomntu,
                     :level_passed,
                     :course,
                     :institution,
                     :year_passed,
                     :created_at,
                     :updated_at
                 )
                ON DUPLICATE KEY UPDATE
                id_yomntu = :id_yomntu,
                level_passed = :level_passed,
                course = :course,
                institution = :institution,
                year_passed = :year_passed,
                updated_at = :updated_at
        ");
         $this->db->bind(':level_passed', $data['level_passed']);
         $this->db->bind(':course', $data['course']);
         $this->db->bind(':institution', $data['institution']);
         $this->db->bind(':year_passed', $data['year_passed']);
         $this->db->bind(':id_yomntu', $data['id']);
         $this->db->bind(':created_at', $data['created_at']);
         $this->db->bind(':updated_at', $data['created_at']);
 
         //Execute
         if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
     }

     public function getTertiaryEducation($id)
     {

        $this->db->query(
            "SELECT id_yomntu, level_passed, course, institution, year_passed, igama, fani
            FROM tertiary_education
            INNER JOIN abantu
            ON tertiary_education.id_yomntu = abantu.id
            WHERE tertiary_education.id_yomntu = :id
            ORDER BY tertiary_education.created_at DESC"
            );
            
            $this->db->bind(":id", $id);
            $results = $this->db->resultSet();
    
            return $results;

     }

    /**
     * Experience
     */
    public function addExperience($data)
    {
        $this->db->query(
            "INSERT INTO experience (
                id_yomntu,
                company,
                job_title,
                responsibilities,
                uqale_nini,
                ugqibe_nini,
                reason_for_leaving,
                usasebenza_apha,
                created_at,
                updated_at
                ) VALUE (
                    :id_yomntu,
                    :company,
                    :job_title,
                    :responsibilities,
                    :uqale_nini,
                    :ugqibe_nini,
                    :reason_for_leaving,
                    :usasebenza_apha,
                    :created_at,
                    :updated_at
                ) ON DUPLICATE KEY UPDATE
                company = :company,
                job_title = :job_title,
                responsibilities = :responsibilities,
                uqale_nini = :uqale_nini,
                usasebenza_apha = :usasebenza_apha,
                ugqibe_nini = :ugqibe_nini,
                reason_for_leaving = :reason_for_leaving,
                updated_at = :created_at"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':company', $data['company']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':responsibilities', $data['responsibilities']);
        $this->db->bind(':uqale_nini', $data['start_year']);
        $this->db->bind(':ugqibe_nini', $data['ugqibe_nini']);
        $this->db->bind(':reason_for_leaving', $data['reason_for_leaving']);
        $this->db->bind(':usasebenza_apha', $data['usasebenza_apha']);
        $this->db->bind(':created_at', $data['created_at']);
        $this->db->bind(':updated_at', $data['created_at']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get experience
     */
     public function getExperience($id)
     {
         $this->db->query(
             "SELECT id_yomntu, igama, fani, company, job_title, responsibilities, uqale_nini, ugqibe_nini, reason_for_leaving, usasebenza_apha, experience.updated_at
             FROM experience
             INNER JOIN abantu
             ON experience.id_yomntu = abantu.id
             WHERE experience.id_yomntu = :id
             ORDER BY experience.created_at DESC"
             );
             
             $this->db->bind(":id", $id);
             $results = $this->db->resultSet();
             return $results;
     }
    
     /**
      * Get all experience
      */
      public function getUsersExperiences()
      {
          $this->db->query(
              "SELECT id_yomntu, company, job_title, responsibilities, uqale_nini, ugqibe_nini, reason_for_leaving, usasebenza_apha, experience.updated_at
              FROM experience
              INNER JOIN abantu
              ON experience.id_yomntu = abantu.id
              ORDER BY experience.created_at DESC"
              );
              
              $results = $this->db->resultSet();
              return $results;
      }

    /**
     * Skills
     */
    public function addSkills($data)
    {
        $this->db->query(
            "INSERT INTO skills (
                id_yomntu,
                skill,
                created_at,
                updated_at
                ) VALUE (
                    :id_yomntu,
                    :skill,
                    :created_at,
                    :updated_at
                ) ON DUPLICATE KEY UPDATE
                    skill = :skill,
                    created_at = :updated_at
                "
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':skill', $data['skill']);
        $this->db->bind(':created_at', $data['created_at']);
        $this->db->bind(':updated_at', $data['created_at']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get skills
     */
     public function getSkills($id)
     {
         $this->db->query(
             "SELECT id_yomntu, igama, fani, skill, skills.created_at, skills.updated_at
             FROM skills
             INNER JOIN abantu
             ON skills.id_yomntu = abantu.id
             WHERE skills.id_yomntu = :id
             ORDER BY skills.created_at DESC"
             );
             
             $this->db->bind(":id", $id);
             $results = $this->db->resultSet();
             return $results;
     }

    /**
     * Achievements
     */
    public function addAchievements($data)
    {
        $this->db->query(
            "INSERT INTO achievements (
                id_yomntu,
                achievement_name,
                company,
                year
                ) VALUE (
                    :id_yomntu,
                    :achievement_name,
                    :company,
                    :year
                )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':achievement_name', $data['achievement_name']);
        $this->db->bind(':company', $data['company']);
        $this->db->bind(':year', $data['year']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get achievements
     */
     public function getAchievements($id)
     {
         $this->db->query(
             "SELECT *,
             achievements.id as achievements_id,
             abantu.id as userId
             FROM achievements
             INNER JOIN abantu
             ON achievements.id_yomntu = abantu.id
             WHERE achievements.id_yomntu = :id
             ORDER BY achievements.created_at DESC"
             );
             
             $this->db->bind(":id", $id);
             $results = $this->db->resultSet();
             return $results;
     }
    
     /**
      * Get achievements
      */
      public function getJobCategories()
      {
          $this->db->query(
              "SELECT ngowantoni FROM imisebenzi GROUP BY ngowantoni"
              );

              $results = $this->db->resultSet();
              return $results;
      }

    public function addJobPreferences($data)
    {

        $this->db->query(
            "INSERT INTO user_job_preferences (
                id_yomntu,
                job_title,
                education,
                experience,
                onjani,
                categories,
                provinces,
                created_at,
                updated_at
                ) VALUE (
                    :id_yomntu,
                    :job_title,
                    :education,
                    :experience,
                    :onjani,
                    :categories,
                    :provinces,
                    :created_at,
                    :updated_at
                )
                ON DUPLICATE KEY UPDATE
                job_title = :job_title,
                education = :education,
                experience = :experience,
                onjani = :onjani,
                categories = :categories,
                provinces = :provinces,
                created_at = :created_at,
                updated_at = :updated_at
        ");
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':education', $data['education']);
        $this->db->bind(':experience', $data['experience']);
        $this->db->bind(':onjani', $data['onjani']);
        $this->db->bind(':categories', $data['categories']);
        $this->db->bind(':provinces', $data['provinces']);
        $this->db->bind(':created_at', $data['created_at']);
        $this->db->bind(':updated_at', $data['updated_at']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get achievements
     */
     public function getJobPreferences($id)
     {
         $this->db->query(

             "SELECT id_yomntu, job_title, education, experience, onjani, categories, provinces, igama, fani, role
             FROM user_job_preferences
             INNER JOIN abantu
             ON user_job_preferences.id_yomntu = abantu.id
             WHERE user_job_preferences.id_yomntu = :id
             ORDER BY user_job_preferences.created_at DESC"

             );
             
             $this->db->bind(":id", $id);

             $results = $this->db->resultSet();
             return $results;
     }
    
     /**
      * Get achievements
      */
      public function getUserJobs($data)
      {
          $this->db->query(
 
              "SELECT label, requirements, slug, province
              FROM imisebenzi
              WHERE mfundo IN (" . $data['jb_education'] . ")
              AND province IN (" . $data["jb_provinces"] . ")
              AND experience IN (" . $data["jb_experience"] . ")
              AND ngowantoni IN (" . $data["jb_categories"] . ")
              AND msebenzi_onjani IN (" . $data["jb_onjani"] . ")
              AND imisebenzi.closing_date = '0000-00-00' AND timestampdiff(day, imisebenzi.created_at, now()) <= 7
              OR mfundo IN (" . $data['jb_education'] . ")
              AND province IN (" . $data["jb_provinces"] . ")
              AND experience IN (" . $data["jb_experience"] . ")
              AND ngowantoni IN (" . $data["jb_categories"] . ")
              AND msebenzi_onjani IN (" . $data["jb_onjani"] . ")
              AND closing_date >= :namhlanje
              ORDER BY created_at DESC LIMIT 10"
              );
              $this->db->bind(":namhlanje", date("Y-m-d"));
              
              $results = $this->db->resultSet();
              return $results;
      }

    /*********************************
     *                               *
     *         Get a user's CV       *
     *                               *
     *********************************/
    public function getCV($id)
    {
        $this->db->query(
            "SELECT * FROM abantu
            LEFT JOIN experience
            ON abantu.id = experience.id_yomntu
            LEFT JOIN skills
            ON abantu.id = skills.id_yomntu
            LEFT JOIN primary_secondary_education
            ON abantu.id = primary_secondary_education.id_yomntu
            LEFT JOIN tertiary_education
            ON abantu.id = tertiary_education.id_yomntu
            WHERE abantu.id = :id"
        );

        $this->db->bind("id", $id);
        $results = $this->db->resultSet();
        return $results;
    }

    /**********************************
     *                                *
     *         Add CV Comments        *
     *                                *
     ***********************************/
    public function addCVComment($data)
    {
        $this->db->query(
            "INSERT INTO cv_comments (id_yomntu, commenter_id, comment, created_at, updated_at)
            VALUES (:id_yomntu, :commenter_id, :comment, :created_at, :updated_at)"
        );

        $this->db->bind(":id_yomntu", $data["id"]);
        $this->db->bind(":commenter_id", $data["commenter_id"]);
        $this->db->bind(":comment", $data["comment"]);
        $this->db->bind(":created_at", $data["created_at"]);
        $this->db->bind(":updated_at", $data["updated_at"]);
        
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get comments                                *
     *                                                                  *
     ********************************************************************/
    
    public function getImpenduloById($id)
    {
        $this->db->query(
            "SELECT comment, commenter_id, id_yomntu, cv_comments.updated_at, igama, fani, zazise
            FROM cv_comments
            INNER JOIN abantu
            ON cv_comments.id_yomntu = abantu.id WHERE cv_comments.id_yomntu = :id
            ORDER BY created_at DESC
            ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        
        return ($results);

    }
    
    /********************************************************************
     *                                                                  *
     *                      Get comments                                *
     *                                                                  *
     ********************************************************************/
    
    public function getUserEmail($data)
    {
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
    }
    
    /********************************************************************
     *                                                                  *
     *                      Get comments                                *
     *                                                                  *
     ********************************************************************/
    
    public function getJobsByUser($data)
    {
        $this->db->query(
            "SELECT * FROM `imisebenzi` WHERE `id_yomntu` = :id LIMIT 12
            ");
        $this->db->bind(':id', $data['id_yomntu']);
        $results = $this->db->resultSet();

        return $results;
    }
    
    /********************************************************************
     *                                                                  *
     *                  Log user ip and login time                      *
     *                                                                  *
     ********************************************************************/

    public function updateIp($data) {
        $this->db->query(
            "INSERT INTO `last_login`(`verification_key`, `ip`, `province`, `city`, `token`, `time`)
            VALUES(:verification_key, :ip, :province, :city, :token, now())"
        );

        $this->db->bind(":verification_key", $data["verification_key"]);
        $this->db->bind(":ip", $data["ip"]);
        $this->db->bind(":province", $data["province"]);
        $this->db->bind(":city", $data["city"]);
        $this->db->bind(":token", $data["token"]);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function fetchUserByToken($verification_key) {
        $this->db->query(
            "SELECT `token` FROM last_login WHERE `verification_key` = :verification_key"
        );

        $this->db->bind(":verification_key", $verification_key);
        $results = $this->db->resultSet();
        return $results;
    }

    // Move data from abantu to registration
    public function moveFromAbantu() {
        $this->db->query(
            "SELECT 
            id, igama, fani, display_name,, email, `role`, `password`, `verification_key`, `verification_key`, `created_at`
            FROM abantu"
        );

        $results = $this->db->resultSet();
        die($results);
    }
}