<?php
    include_once("dao/reviewDAO.php");
    $reviewDAO = new ReviewDAO($conn, $baseURL, $message);
    $rating = $reviewDAO->get_movie_rating_by_movie_id($movie->id);
?>
<div class="movie-card">
                <div class="movie-image-card" style="background-image: url('<?=$baseURL?>/<?=$movie->image?>')"></div> <!-- Imagem do filme-->
                <div class="movie-rating-card">
                    <i class="fa-solid fa-star yellow"></i> <?= $rating ?>
                </div>
                <div class="movie-title-card">
                    <?= $movie->title ?>
                </div>
                <div class="btn-row-card">
                    <a href="movie_page.php?id=<?= $movie->id ?>" class="btn-blue-card">Avaliar</a>
                </div>
                <div class="btn-row-card">
                    <a href="movie_page.php?id=<?= $movie->id ?>" class="btn-yellow-card">Conhecer</a>
                </div>
</div>