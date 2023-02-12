<?php
    include_once("templates/header.php");
    include_once("database.php");
    include_once("dao/movieDAO.php");
    include_once("dao/reviewDAO.php");

    $reviewDAO = new ReviewDAO($conn, $baseURL, $message); 
    $movieDAO = new MovieDAO($conn, $baseURL, $message);

    $movie = $movieDAO->get_movie_by_movie_id($_GET['id']);
    $reviews = $reviewDAO->get_reviews_by_movie_id($_GET['id']);
    
    if(isset($user)){
        $already_reviewed = $reviewDAO->already_reviewed($reviews,$user->id);
    }else{
        $already_reviewed = false;
    }

    $movie_rating = $reviewDAO->get_movie_rating_by_movie_id($movie->id);
?>
    
    <main id="movie-page-container">
        <div class="movie-page-info">
            <div class="movie-page-column-1">
                <h1><?= $movie->title?></h1>
                <div class="movie-details">
                    <div>Duração: <?= $movie->length?></div>
                    <div>|</div>
                    <div><?= $movie->category?></div>
                    <div>|</div>
                    <div><i class="fa-solid fa-star yellow"></i> <?= $movie_rating?></div>
                </div>
                <div class="yt-div">
                    <iframe width="80%" height="315" src="<?= $movie->trailer?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                    <p class="movie-description">
                        Descrição: <?= $movie->description ?>
                    </p>
                </div>
            <div class="movie-page-column-2">
                <div class="movie-page-image" style="background-image: url('<?=$baseURL?>/<?=$movie->image?>')"></div>
            </div>
        </div>
        <h1 class="rating-title">Avaliações:</h1>
            <?php if($already_reviewed && $user->id != $movie->users_id):?>
                <?php
                    require("templates/form_review.php");
                ?>
            <?php endif;?>
            <?php if(!empty($reviews)):?>
                <?php foreach($reviews as $review):?>
                    <?php
                        require("templates/review.php");
                    ?>
                <?php endforeach ?>
            <?php else: ?>
                <div class="no-review">
                    <p>Ainda não existem avaliações</p>
                </div>
            <?php endif; ?>
    </main>
<?php
    include_once("templates/footer.php");
?>