<div class="form-review">
<h2>Envie sua avaliação:</h2>
    <p>Escreva sua opinião e avalie o filme</p>
<form action="review_proccess.php" method="post">
    <input type="hidden" name="movie_id" value="<?= $movie->id?>">
    <div class="review-form-row">
    <label for="rating">Nota:</label>
        <select name="rating" class="review-rating" id="rating" required>
            <option value="">Selecione</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
    </div>
    <div class="review-form-row">
    <label for="review">Seu comentário:</label>
    </div>
    <div class="review-form-row">
        <textarea name="review" id="review" class="review-text" rows="6"></textarea>
    </div>
    <div class="review-form-row">
        <input type="submit" value="Enviar comentário" class="btn yellow-btn review-btn">
    </div>
</form>
</div>
