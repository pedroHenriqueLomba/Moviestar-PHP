<?php

    class User{

        public $id;
        public $name;
        public $last_name;
        public $email;
        public $password;
        public $image;
        public $bio;
        public $token;

        public function generate_token(){
            return bin2hex(random_bytes(60));
        }

        public function generate_password($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }

        public function generate_image_name(){
            return bin2hex(random_bytes(60)) . ".jpg";
        }
    
    }

    

?>