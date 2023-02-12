<?php
    include_once("dao/userDAO.php");
    include_once("dao/reviewDAO.php");
    $userDAO = new UserDAO($conn, $baseURL, $message);
    $reviewDAO = new ReviewDAO($conn, $baseURL, $message);

    $review_user = $userDAO->find_by_id($review->users_id);
    $rating = $reviewDAO->get_movie_rating_by_movie_id($movie->id);
?>

<div class="review">
    <div class="review-row">
        <div class="review-profile-image" style="background-image: url('<?= $baseURL?>/<?= $review_user->image ?>');"></div>
        <div class="review-profile-info">
            <div class="review-profile-info-row"><h2><a href="<?= $baseURL?>/profile.php?id=<?= $review->users_id ?>"><?= $review_user->name?> <?= $review_user->last_name?></a></h2></div>
            <div class="review-profile-info-row"><i class="fa-solid fa-star yellow"></i> <?= $rating?></div>
        </div>
    </div>
    <div class="review-row">
        <h3>Comentário:</h3>
        <p><?= $review->review ?></p>
    </div>
</div>