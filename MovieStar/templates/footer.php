<?php
    include_once("globals.php");
?>
    <footer>
        <div class="footer-row">
            <a href="https://www.facebook.com/pedrohenrique.lomba.5" class="footer-item social-icon"><i class="fa-brands fa-square-facebook"></i></a>
            <a href="https://www.instagram.com/_pedro.lomba_/" class="footer-item social-icon"><i class="fa-brands fa-instagram"></i></a>    
            <a href="https://www.linkedin.com/in/pedro-henrique-lomba-584bbb23a/" class="footer-item social-icon"><i class="fa-brands fa-linkedin"></i></a>            
        </div>
        <div class="footer-row actions">
            <?php if(!empty($user)): ?>
                <a href="<?= $baseURL ?>/create_movie.php" class="footer-item">Adicionar Filme</a>
                <a class="footer-item" href="<?=$baseURL?>/edit_profile.php">Editar Conta</a></span>
            <?php else: ?>
                <a class="footer-item" href="<?=$baseURL?>/login.php">Entrar/Cadastrar</a></span>
            <?php endif?>
        </div>
        <div class="footer-row">
            &#169 Hora de Codar 2020
        </div>
    </footer>
</body>
</html>