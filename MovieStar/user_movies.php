<?php
    include_once("templates/header.php");
    include_once("dao/movieDAO.php");
    include_once("dao/reviewDAO.php");
    $reviewDAO = new ReviewDAO($conn, $baseURL, $message);
    $movieDAO = new MovieDAO($conn, $baseURL, $message);  
    
    $movies = $movieDAO->get_movies_by_user_id($user->id);
    
    $movie_counter = 0;
?>
   
   <main id="user-movies-container">
        <h1>Seus filmes</h1>
        <table class="user-movies-table">
            <thead>
                <th class="id-column" >#</th>
                <th class="title-column" >Título</th>
                <th class="rating-column" >Nota</th>
                <th class="actions-column" >Ações</th>
            </thead>
            <?php if(!empty($movies)):?>
                <?php foreach ($movies as $movie):
                    $movie_counter += 1;   
                    $rating = $reviewDAO->get_movie_rating_by_movie_id($movie->id);
                ?>
                    <tr>
                        <td class="id-column" ><?= $movie_counter?></td>
                        <td class="title-column" ><a href="<?= $baseURL?>/movie_page.php?id=<?=$movie->id?>"><?= $movie->title?></a></td>
                        <td class="rating-column" ><i class="fa-solid fa-star yellow"></i> <?=$rating?></td>
                        <td class="actions-column" >
                            <div class="user-movie-actions">
                                <a href="<?= $baseURL ?>/edit_movie.php?id=<?= $movie->id ?>" class="btn edit-btn user-movies-btn"> <i class="fa-solid fa-pencil"></i> Editar</a>
                                <form action="<?= $baseURL ?>/movie_process.php" method="post">
                                    <input type="hidden" name="operation" value="delete">
                                    <input type="hidden" name="movie_id" value="<?= $movie->id?>">
                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-times"></i> Deletar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach?>
            <?php endif;?>
        </table>
        <div class="btn-row">
            <a href="<?= $baseURL ?>/create_movie.php" class="btn yellow-btn add-movie-btn">Adicionar Filme</a>
        </div>
   </main>

<?php
    include_once("templates/footer.php");
?>