<?php
    include_once("templates/header.php");
    include_once("dao/movieDAO.php");

    $movieDAO = new MovieDAO($conn, $baseURL, $message);
    $movies = $movieDAO->get_latest_movies();
    $actionMovies = $movieDAO->get_movies_by_category('Ação');
    $comedyMovies = $movieDAO->get_movies_by_category('Comédia');
    $dramaMovies = $movieDAO->get_movies_by_category('Drama');
    $fictionMovies = $movieDAO->get_movies_by_category('Ficção');
    $romanceMovies = $movieDAO->get_movies_by_category('Romance');
    $horrorMovies = $movieDAO->get_movies_by_category('Terror');

?>

    <main id="movies-container">
        <h1><a href="" class="categories-movies-link">Todos os filmes</a></h1>
        <h2>Os últimos filmes adicionados ao MovieStar</h2>
        <div class="movies-row">
            <?php if(!empty($movies)): ?>
                <?php
                    foreach($movies as $movie){
                        require('templates/movie_card.php');
                    }
                ?>
            <?php else:?>
                <div class="movies-empty">
                    Ainda não foram adicionados filmes!
                </div>    
            <?php endif?>
        </div>
        <h1><a href="" class="categories-movies-link">Ação</a></h1>
        <h2>Os últimos filmes de Ação adicionados ao MovieStar</h2>
        <div class="movies-row">
            <?php if(!empty($actionMovies)): ?>
                <?php
                    foreach($actionMovies as $movie){
                        require('templates/movie_card.php');
                    }
                ?>
                <?php else:?>
                <div class="movies-empty">
                    Ainda não foram adicionados filmes de Ação!
                </div>        
            <?php endif?>
        </div>
        <h1><a href="" class="categories-movies-link">Comédia</a></h1>
        <h2>Os últimos filmes de Comédia adicionados ao MovieStar</h2>
        <div class="movies-row">
            <?php if(!empty($comedyMovies)): ?>
                <?php
                    foreach($comedyMovies as $movie){
                        require('templates/movie_card.php');
                    }
                ?>
                <?php else:?>
                <div class="movies-empty">
                    Ainda não foram adicionados filmes de comédia!
                </div>        
            <?php endif?>
        </div>
        <h1><a href="" class="categories-movies-link">Drama</a></h1>
        <h2>Os últimos filmes de Drama adicionados ao MovieStar</h2>
        <div class="movies-row">
            <?php if(!empty($dramaMovies)): ?>
                <?php
                    foreach($dramaMovies as $movie){
                        require('templates/movie_card.php');
                    }
                ?>
                <?php else:?>
                <div class="movies-empty">
                    Ainda não foram adicionados filmes de Drama!
                </div>        
            <?php endif?>
        </div>
        <h1><a href="" class="categories-movies-link">Ficção</a></h1>
        <h2>Os últimos filmes de Ficção adicionados ao MovieStar</h2>
        <div class="movies-row">
            <?php if(!empty($fictionMovies)): ?>
                <?php
                    foreach($fictionMovies as $movie){
                        require('templates/movie_card.php');
                    }
                ?>
                <?php else:?>
                <div class="movies-empty">
                    Ainda não foram adicionados filmes de Ficção!
                </div>        
            <?php endif?>
        </div>
        <h1><a href="" class="categories-movies-link">Romance</a></h1>
        <h2>Os últimos filmes de Romance adicionados ao MovieStar</h2>
        <div class="movies-row">
            <?php if(!empty($romanceMovies)): ?>
                <?php
                    foreach($romanceMovies as $movie){
                        require('templates/movie_card.php');
                    }
                ?>
                <?php else:?>
                <div class="movies-empty">
                    Ainda não foram adicionados filmes de Romance!
                </div>        
            <?php endif?>
        </div>
        <h1><a href="" class="categories-movies-link">Terror</a></h1>
        <h2>Os últimos filmes de Terror adicionados ao MovieStar</h2>
        <div class="movies-row">
            <?php if(!empty($horrorMovies)): ?>
                <?php
                    foreach($horrorMovies as $movie){
                        require('templates/movie_card.php');
                    }
                ?>
                <?php else:?>
                <div class="movies-empty">
                    Ainda não foram adicionados filmes de Terror!
                </div>        
            <?php endif?>
        </div>
    </main>

<?php
    include_once("templates/footer.php");
?>