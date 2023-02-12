<?php

    class Movie{

        private $baseURL;
        private $message;

        public $id;
        public $title;
        public $description;
        public $image;
        public $trailer;
        public $category;
        public $length;
        public $users_id;

        public function __construct($baseURL, $message){
            $this->baseURL = $baseURL;
            $this->message = $message;
        }

        public function generate_image_name(){
            return bin2hex(random_bytes(60)) . ".jpg";
        }
        
        public function image_prepare($image_array){

            // Escolher os tipos de imagens suportadas
            if ($image_array['type'] == "image/jpg"  || $image_array['type'] == "image/jpeg") { //JPG ou JPEG
                
                $image_file = imagecreatefromjpeg($image_array['tmp_name']);

            } else if($image_array['type'] == "image/png"){ // PNG

                $image_file = imagecreatefrompng($image_array['tmp_name']);

            } else{
                $this->message->set_message("Formato da foto não suportado", "fail", "edit_profile.php");
            }

            $image_name = $this->generate_image_name();

            imagejpeg($image_file, "./img/movies/" . $image_name, 100);

            $image_path = "img/movies/" .$image_name;

            return $image_path;

        }

        // Função que converte o link do youtube para deixá-lo incorporado
        public function yt_link_conversor($yt_link){
            $yt_link_array = explode('=', $yt_link);

            $yt_link_array['0'] = "https://www.youtube.com/embed/";
        
            if(count($yt_link_array) > 1){
            $yt_link_correct = implode( "", $yt_link_array);
        
            return $yt_link_correct;
            }else{
                return $yt_link;
            }
        }

    }

?>

