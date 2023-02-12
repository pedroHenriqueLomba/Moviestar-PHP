<?php
    include_once("globals.php");
    include_once("database.php");
    include_once("models/message.php");
    include_once("dao/userDAO.php");

    $message = new Message($baseURL); 

    $userDAO = new UserDAO($conn, $baseURL, $message);
    
    // Verifica se o usuário está logado
    if (!empty($_SESSION['token'])) {
        $user = $userDAO->verify_token($_SESSION['token']);   
    }else{
        $_SESSION['token'] = "";
    }

    // Verifica se alguma mensagem precisa ser exibida
    if (!empty($_SESSION['msg'])) {
        $message_type = $message->get_message_type();
    }else{
        $message_type = "";
        $_SESSION['msg'] = [];
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Linkando CSS -->
    <link rel="stylesheet" href="<?=$baseURL?>/styles/style.css">
    <!-- Ícone da página -->
    <link rel="shortcut icon" href="img/moviestar.ico">
    <!-- Título da página -->
    <title>MovieStar</title>
</head>
<body>
    <header>
        <div id="logo"> 
            <a href="<?= $baseURL?>/index.php" id="home-link">
                <img class="logo" src="<?=$baseURL?>/img/moviestar.ico" alt="MovieStar">
                <span class="title">MovieStar</span>    
            </a>
        </div>
        <div id="search">
            <form action="<?=$baseURL?>/search.php" method="get">
                <input type="text" name="search" class="search-box" placeholder="Buscar filme...">
                <button type="submit" class="search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <?php if(!empty($user)): ?>
        <div class="actions">
                <span><a href="<?=$baseURL?>/create_movie.php"><i class="fa-regular fa-square-plus"></i> Adicionar Filme</a></span>
                <span><a href="<?=$baseURL?>/user_movies.php">Meus Filmes</a></span>
                <span><a href="<?=$baseURL?>/edit_profile.php"><?= $user->name?></a></span>
                <span><a href="<?=$baseURL?>/logout.php">Sair</a></span>
        </div>
        <?php else: ?>
            <div class="one-action">
                <span class=""><a href="<?=$baseURL?>/login.php">Entrar/Cadastrar</a></span>
            </div>
        <?php endif?>
    </header>
    <?php if ($message_type == 'success'):?>
    <div class="message-success">
        <?= $_SESSION['msg']; ?>
    </div>
    <?php elseif ($message_type == 'fail'):?>
    <div class="message-fail">
        <?= $_SESSION['msg']; ?>
    </div>
    <?php endif?>

    <?php     
        $message->clear_message();
    ?>