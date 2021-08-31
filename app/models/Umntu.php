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
            'SELECT
            `user_verification`.`verified`,
            `user_verification`.`verification_key`,
            `registration`.`password`,
            `registration`.`id`,
            `registration`.`email`, 
            `registration`.`role`,
            `registration`.`first_name`,
            `registration`.`last_name`
            FROM user_verification
            INNER JOIN `registration`
            ON  `user_verification`.`user_id` = `registration`.`id`
            WHERE `registration`.`email` = :email'
        );

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
     * Check is admin
     *
     * @param [type] $id
     * @return void
     */
    public function check_is_admin($id)
    {
        $this->db->query(
            "SELECT `id` FROM `admins` WHERE id = :id"
        );

        $this->db->bind(":id", $id);

        $row = $this->db->single();
        
        if ($row != false) {
            return true;
        }

        return $row;
    }
    
    /**
     * Log user in
     *
     * @param [type] $email
     * @param [type] $password
     * @return void
     */
    public function verifyLoginPass($email, $password)
    {

        $this->db->query(
            'SELECT `password`
            FROM `registration`
            WHERE `email` = :email'
        );

        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        $hashed_password = $row->password;
        
        if (password_verify($password, $hashed_password)) {

            return true;

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
     * Check Reset Password
     */
     public function checkResetEmail($email)
     {
         $this->db->query("SELECT `email` FROM `registration` WHERE email = :email");
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
     *
     * @param [type] $selector
     * @return void
     */
    public function resetPassword($selector)
    {
        $current_date = date("U");
        
        $this->db->query(
            "SELECT * FROM password_reset
            WHERE password_reset_selector = :selector
            AND password_reset_expires >= $current_date"
        );
        
        $this->db->bind(":selector", $selector);
        $row = $this->db->single();
        return $row;
    }
    
    /**
     * Update Password
     *
     * @param  [type] $email
     * @param  [type] $new_password
     * 
     * @return void
     */
    public function updatePassword($email, $new_password)
    {
        $this->db->query(
            "UPDATE abantu SET password = :new_password WHERE email = :email_yomntu"
        );

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
     * Log user ip and login time
     *
     * @param [type] $data
     * @return void
     */
    public function updateIp($data)
    {
        $this->db->query(
            "INSERT INTO `last_login`(
                `verification_key`, `ip`, `province`, `city`, `token`, `time`
            )
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
}