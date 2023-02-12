<?php
    include_once("globals.php");
    include_once("database.php");
    include_once("models/message.php");
    include_once("models/user.php");
    include_once("dao/userDAO.php");

    $message = new Message($baseURL);
    $userDAO = new userDAO($conn, $baseURL, $message);
    $user = new User;
    $user_info = $userDAO->verify_token($_SESSION['token']);

    $operation = $_POST['operation'];

    if ($operation == 'edit-profile'){
        if (!empty($_FILES['image']['tmp_name'])) {
            // Transformar a variável global em local
            $image_array = $_FILES['image'];

            // Escolher os tipos de imagens suportadas
            if ($image_array['type'] == "image/jpg"  || $image_array['type'] == "image/jpeg") { //JPG ou JPEG
                
                $image_file = imagecreatefromjpeg($image_array['tmp_name']);

            } else if($image_array['type'] == "image/png"){ // PNG

                $image_file = imagecreatefrompng($image_array['tmp_name']);

            } else{
                $message->set_message("Formato da foto não suportado", "fail", "edit_profile.php");
            }

            $image_name = $user->generate_image_name();

            imagejpeg($image_file, "./img/users/" . $image_name, 100);

            $user->image = "img/users/" .$image_name;

        }else{
            if ($user_info->image != "img/users/user.png") {
                $user->image = $user_info->image;
            }else{
                $user->image = "img/users/user.png";
            }
        }
        $user->name = $_POST['name'];
        $user->last_name = $_POST['last_name'];
        $user->bio = $_POST['bio'];
        $user->token = $_SESSION['token'];
    } elseif ($operation == 'edit-password') {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];
    } else{
        $message->set_message("Erro de autenticação, por gentileza, entre novamente.", "fail", "login.php");
    }

    switch ($operation) {
        case 'edit-profile':
            // Verificar se o usuário preencheu nome e sobrenome
            if($user->name != "" && $user->last_name != ""){
                $userDAO->update_profile($user);
            }else{
                $message->set_message("Os campos de nome e sobre nome são obrigatórios!", "fail", "edit_profile.php");
            }
        break;

        case 'edit-password':
            //Verificar se a senha foi preenchida
            if (!empty($new_password)) {
                //Verificar se a nova senha corresponde
                if ($new_password == $confirm_new_password ) {
                    // Verifica se a senha inserida é a  mesma atual
                    if (password_verify($current_password, $user_info->password)) {
                        $userDAO->update_password($user_info->token, $new_password);
                    }else{
                        $message->set_message("Senha atual incorreta!", "fail", "edit_profile.php");
                    }
                }else{
                    $message->set_message("As senhas não correspondem!", "fail", "edit_profile.php");
                }
            }else{
                $message->set_message("A senha não pode estar em branco!", "fail", "edit_profile.php");
            }
        break;
        
        default:
            
        break;
    }
?>