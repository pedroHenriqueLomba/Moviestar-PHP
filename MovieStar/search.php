<?php
    include_once("templates/header.php");
    include_once("dao/movieDAO.php");

    $movieDAO = new MovieDAO($conn, $baseURL, $message);

    $movies = $movieDAO->search_movies($_GET['search']);
?>
        <main id="movies-container">
            <h1>Você está buscando por: <?= $_GET['search']?> </h1>
            <h2></h2>
            <div class="movies-row">
                <?php if(!empty($movies)): ?>
                    <?php
                        foreach($movies as $movie){
                            require('templates/movie_card.php');
                        }
                    ?>
                <?php else:?>
                    <div class="movies-empty">
                        Ainda não foram adicionados filmes com esse título!
                    </div>    
                <?php endif?>
            </div>
        </main>
<?php
    include_once("templates/footer.php")
?>