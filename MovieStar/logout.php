<?php
    include_once("globals.php");
    include_once("models/message.php");
    $message = new Message($baseURL); 

    $_SESSION['token'] = null;

    $message->set_message("Você saiu com sucesso!", "success", "index.php");   
?>