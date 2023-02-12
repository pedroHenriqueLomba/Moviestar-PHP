<?php
    include_once("templates/header.php");
    include_once("globals.php");
?>
<main id="login-container">
    <div class="login-column">
        <h1>Entrar</h1>
        <form action="<?=$baseURL?>/login_process.php" method="post">
            <input type="hidden" name="operation" value="enter">
            <div class="data-box">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="input-box" placeholder="Digite seu e-mail">
            </div>
            <div class="data-box">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" class="input-box" placeholder="Digite sua senha">
            </div>
            <div class="btn-row">
                <input type="submit" value="Entrar" class="btn yellow-btn login-btn">
            </div>
        </form>
    </div>
    <div class="login-column">
        <h1>Registrar</h1>
        <form action="<?=$baseURL?>/login_process.php" method="post">
            <input type="hidden" name="operation" value="create">
            <div class="data-box">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="input-box" placeholder="Digite seu e-mail">
            </div>
            <div class="data-box">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" class="input-box" placeholder="Digite seu nome">
            </div>
            <div class="data-box">
                <label for="last-name">Sobrenome:</label>
                <input type="text" name="last_name" id="last_name" class="input-box" placeholder="Digite seu sobrenome">
            </div>
            <div class="data-box">
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" class="input-box" placeholder="Digite sua senha">
            </div>
            <div class="data-box">
                <label for="confirm-password">Confirmação de senha:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="input-box" placeholder="Confirme sua senha">
            </div>
            <div class="btn-row">
                <input type="submit" value="Registrar" class="btn yellow-btn login-btn">
            </div>
        </form>
    </div>
</main>
<?php
    include_once("templates/footer.php");
?>