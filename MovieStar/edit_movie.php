<?php
    include_once("templates/header.php");
    include_once("database.php");
    include_once("dao/movieDAO.php");
    include_once("dao/userDAO.php");

    $movieDAO = new MovieDAO($conn, $baseURL, $message);
    $userDAO = new userDAO($conn, $baseURL, $message);

    $user = $userDAO->verify_token($_SESSION['token']);
    $movie_id = $_GET['id'];

    $movie = $movieDAO->get_movie_by_movie_id($movie_id);
?>
    
    <main id="edit-movie-container">
    <h1>Editar Filme</h1>
        <form action="<?=$baseURL?>/movie_process.php" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="operation" value="edit">
            <input type="hidden" name="id" value="<?= $movie->id?>">
            <input type="hidden" name="users_id" value="<?=$movie->users_id?>">
                <label for="title">Título:</label>
                <input type="text" name="title" class="input-box" placeholder="Título do filme" value="<?=$movie->title?>" id="title" required>
            </div>
            <div class="edit-movie-row">
                <label for="img">Imagem:</label>
                <!-- <?php
                print_r($movie);
                ?> -->
                <div class="edit-movie-image" style="background-image: url('<?=$baseURL?>/<?=$movie->image?>')"></div>
                <input type="file" name="img" id="img">
            </>
            <div class="edit-movie-row">
                <label for="length">Duração (minutos):</label>
                <input type="number" name="length" class="input-box" value="<?=$movie->length?>" placeholder="Duração do filme em minutos" id="length" required>
            </div>
            <div class="edit-movie-row">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="input-box" value="<?=$movie->category?>" required>
                    <option value="Ação" <?= $movie->category == 'Ação' ? "selected" : "" ?> >Ação</option>
                    <option value="Comédia" <?= $movie->category == 'Comédia' ? "selected" : "" ?> >Comédia</option>
                    <option value="Drama" <?= $movie->category == 'Drama' ? "selected" : "" ?>>Drama</option>
                    <option value="Ficção" <?= $movie->category == 'Ficção' ? "selected" : "" ?>>Ficção</option>
                    <option value="Romance" <?= $movie->category == 'Romance' ? "selected" : "" ?>>Romance</option>
                    <option value="Terror" <?= $movie->category == 'Terror' ? "selected" : "" ?>>Terror</option>
                </select>
            </div>
            <div class="edit-movie-row">
                <label for="trailer">Trailer:</label>
                <div style="<?= $movie->trailer == '' ? "display:none" : "" ?>"> <!-- Verifica se o filme já possui trailer-->
                    <iframe width="100%" height="315" src="<?= $movie->trailer?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <input type="text" name="trailer" class="input-box" value="<?=$movie->trailer?>" placeholder="Link do trailer do filme no youtube" id="trailer">
            </div>
            <div class="edit-movie-row">
                <label for="descrirption">Descrição:</label>
                <textarea name="description" id="description" class="description-box" placeholder="Escreva sobre o filme" rows="5"><?=$movie->description?></textarea>
            </div>
            <div class="btn-row">
                <input type="submit" class="btn yellow-btn create_movie_btn" value="Editar Filme">
            </div>
        </form>
    </main>

<?php
    include_once("templates/footer.php");
?>