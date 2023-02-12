<?php
    include_once("globals.php");

        $message = new Message($baseURL);

        if (!empty($_SESSION['msg'])) {
            $message_type = $message->get_message_type();
        }else{
            $_SESSION['msg'] = [];
        }

    class Message{
        private $baseURL;

        public function __construct($baseURL){
            $this->baseURL = $baseURL;
        }

        public function set_message($text, $type, $redirect = "index.php"){
            switch ($type) {
                case 'success':
                    $_SESSION['msg_type'] = 'success';
                    $_SESSION['msg'] = $text;
                    header("location:" . $this->baseURL . "/" . $redirect);
                break;
                
                case 'fail':
                    $_SESSION['msg_type'] = 'fail';
                    $_SESSION['msg'] = $text;    
                    header("location:" . $this->baseURL . "/" . $redirect);
                break;

                default:
                    header("location:" . $this->baseURL . "/index.php");
                break;
            }
        }

        public function get_message_type(){
            return $_SESSION['msg_type'];
        }

        public function clear_message(){
            $_SESSION['msg_type'] = false;
            $_SESSION['msg'] = false;
        }
    }
?>