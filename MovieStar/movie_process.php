<?php
    include_once("globals.php");
    include_once("database.php");
    include_once("models/movie.php");
    include_once("models/message.php");
    include_once("dao/userDAO.php");
    include_once("dao/movieDAO.php");

    $message = new Message($baseURL); 
    $movieDAO = new MovieDAO($conn, $baseURL, $message);
    $movie = new Movie($baseURL, $message);
    $userDAO = new userDAO($conn, $baseURL, $message);

    $operation = $_POST['operation'];
    $user = $userDAO->verify_token($_SESSION['token']);

    switch ($operation) {
        case 'create':
            // Definindo variáveis
            $movie->title = $_POST['title'];
            $movie->length = $_POST['length'];
            $movie->category = $_POST['category'];
            $movie->trailer = $movie->yt_link_conversor($_POST['trailer']);
            $movie->description = $_POST['description'];
            $movie->users_id = $user->id;

            // Verificando atributos obrigatórios
            if (isset($movie->title) && isset($movie->length) && isset($movie->category) && isset($movie->users_id)) {
                // Verificar se alguma imagem foi enviada e salvá-la na pasta
                if (!empty($_FILES['img']['name'])) {
                    $movie->image = $movie->image_prepare($_FILES['img']);
                }else{
                    $movie->image = "img/movies/movie_cover.jpg";
                }
                $movieDAO->create_movie($movie);
            }
        break;

        case 'edit':
            // Definindo variáveis
            $movie->id = $_POST['id'];
            $movie->title = $_POST['title'];
            $movie->length = $_POST['length'];
            $movie->category = $_POST['category'];
            $movie->trailer = $movie->yt_link_conversor($_POST['trailer']);
            $movie->description = $_POST['description'];
            $movie->users_id = $_POST['users_id'];
            
            // Verifica se o filme pertence ao usuário
            if ($movie->users_id == $user->id) {
                // Verificando atributos obrigatórios
                if (isset($movie->title) && isset($movie->length) && isset($movie->category) && isset($movie->users_id)) {
                    // Verificar se alguma imagem foi enviada e salvá-la na pasta
                    if (!empty($_FILES['img']['name'])) {
                        $movie->image = $movie->image_prepare($_FILES['img']);
                    }
                    $movieDAO->update_movie($movie);
                }
            }else{
                $movieDAO->message->set_message("Erro inesperado!", "fail", "index.php");
            }
        break;

        case 'delete':
            // Retorna o usuário que deseja deletar o filme
            $movie_id = $_POST['movie_id'];
            $movieDAO->destroy_movie($movie_id);
        break;
        
        default:
            $movieDAO->message->set_message("Erro inesperado!", "fail", "index.php");
        break;
    }

?>