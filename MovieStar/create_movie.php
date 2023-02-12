<?php
    include_once("templates/header.php");
?>

    <main id="create-movie-container">
        <h1>Adicionar Filme</h1>
        <form action="<?=$baseURL?>/movie_process.php" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="operation" value="create">
            <div class="create-movie-row">
                <label for="title">Título:</label>
                <input type="text" name="title" class="input-box" placeholder="Título do filme" id="title" required>
            </div>
            <div class="create-movie-row">
                <label for="img">Imagem:</label>
                <input type="file" name="img" id="img">
            </div>
            <div class="create-movie-row">
                <label for="length">Duração (minutos):</label>
                <input type="number" name="length" class="input-box" placeholder="Duração do filme em minutos" id="length" required>
            </div>
            <div class="create-movie-row">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="input-box" required>
                    <option value="">Selecione</option>
                    <option value="Ação">Ação</option>
                    <option value="Comédia">Comédia</option>
                    <option value="Drama">Drama</option>
                    <option value="Ficção">Ficção</option>
                    <option value="Romance">Romance</option>
                    <option value="Terror">Terror</option>
                </select>
            </div>
            <div class="create-movie-row">
                <label for="trailer">Trailer:</label>
                <input type="text" name="trailer" class="input-box" placeholder="Link do trailer do filme no youtube" id="trailer">
            </div>
            <div class="create-movie-row">
                <label for="descrirption">Descrição:</label>
                <textarea name="description" id="description" class="description-box" placeholder="Escreva sobre o filme" rows="5"></textarea>
            </div>
            <div class="btn-row">
                <input type="submit" class="btn yellow-btn create_movie_btn" value="Criar filme">
            </div>
        </form>
    </main>

<?php
    include_once("templates/footer.php");
?>