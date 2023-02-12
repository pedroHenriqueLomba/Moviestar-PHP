<?php
    include_once("globals.php");
    include_once("database.php");
    include_once("models/message.php");
    include_once("models/user.php");
    include_once("dao/userDAO.php");

    $message = new Message($baseURL);
    $userDAO = new userDAO($conn, $baseURL, $message);
    
    $operation = filter_input(INPUT_POST,"operation");
    $email = filter_input(INPUT_POST,"email");
    $name = filter_input(INPUT_POST,"name");
    $last_name = filter_input(INPUT_POST,"last_name");
    $password = filter_input(INPUT_POST,"password");
    $confirm_password = filter_input(INPUT_POST,"confirm_password");

    print_r($_POST);

    switch ($operation) {
        case 'create':
            // Verificando dados mínimos
            if ($email && $name && $last_name && $password && $confirm_password) {
                if ($password === $confirm_password) {
                    $user = new User;
                    
                    $final_password = $user->generate_password($password);
                    $token = $user->generate_token();

                    $user->email = $email;
                    $user->name = $name;
                    $user->last_name = $last_name;
                    $user->password = $final_password;
                    $user->token = $token;
                    $userDAO->create_user($user);
                }
                else{
                    $message->set_message("As senhas não correspondem!", "fail", "login.php");
                }
            }
            else{
                $message->set_message("Preencha todos os campos!", "fail", "login.php");
            }
        break;
        
        case 'enter':
            // Verificando dados mínimos
            if ($email && $password) {
                $userDAO->auth_user($email, $password);
            }else{
                $message->set_message("Preencha todos os campos!", "fail", "login.php");
            }
        break;

        default:
                $message->set_message("Erro inexperado!", "fail", "login.php");
        break;
    }
?>