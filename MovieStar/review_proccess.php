<?php
    include_once("globals.php");
    include_once("database.php");
    include_once("models/review.php");
    include_once("dao/reviewDAO.php");
    include_once("dao/userDAO.php");
    include_once("models/message.php");

    $message = new Message($baseURL);
    $userDAO = new userDAO($conn, $baseURL, $message);
    $reviewDAO = new reviewDAO($conn, $baseURL, $message);
    $review = new Review;

    $user = $userDAO->verify_token($_SESSION['token']);

    $review->rating = $_POST['rating'];
    $review->review = $_POST['review'];
    $review->users_id = $user->id;
    $review->movies_id = $_POST['movie_id'];

    // Verificação de dados mínimos
    if(!empty($review->rating) && !empty($review->review)){
        $reviewDAO->create_review($review);
    }else{
        $message->set_message("Preencha todos os campos do comentário", "fail", "movie_page.php?id=$review->movies_id");
    }

?>