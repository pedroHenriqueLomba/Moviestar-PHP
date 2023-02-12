<?php
    include_once("templates/header.php");
    include_once("dao/userDAO.php");
    include_once("dao/movieDAO.php");

    $userDAO = new UserDAO($conn, $baseURL, $message);
    $movieDAO = new MovieDAO($conn, $baseURL, $message);

    $user = $userDAO->find_by_id($_GET['id']);
    $movies = $movieDAO->get_movies_by_user_id($user->id);
?>

    <main id="profile-container">
        <div class="profile-row">
            <h1><?= $user->name?> <?= $user->last_name?></h1>
        </div>
        <div class="profile-row">
            <div class="profile-image" style="background-image: url('<?= $baseURL?>/<?= $user->image?>');"></div>
        </div>
        <div class="profile-row">
            <h2>Sobre:</h2>
        </div>
        <div class="profile-row">
            <p><?= $user->bio == "" ? "O usuário não escreveu nada ainda..." : $user->bio?></p>
        </div>
        <hr>
        <div id="profile-movies-container">
            <h1>Filmes enviados pelo usuário:</h1>
            <?php if(!empty($movies)):?>
                <?php foreach($movies as $movie):?>
                    <?php
                        require("templates/movie_card.php");
                    ?>
                <?php endforeach?>
            <?php endif; ?>
        </div>
    </main>

<?php
    include_once("templates/footer.php")
?>