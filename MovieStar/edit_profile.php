<?php
    include_once("globals.php");
    include_once("templates/header.php");
    include_once("models/message.php");
    include_once("dao/userDAO.php");
    
    $userDAO = new UserDAO($conn, $baseURL, $message);

    $message = new Message($baseURL); 

    if (!empty($_SESSION['token'])) {
        $user = $userDAO->verify_token($_SESSION['token']);
    }else{
        $message->set_message("Erro de autenticação, faça o login novamente!", "fail", "index.php");
    }
    
?>

    <div id="edit-profile-container">
        <div class="edit-profile-column">
            <h1>Editar Perfil</h1>
            <form action="<?=$baseURL?>/edit_profile_process.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="operation" value="edit-profile">
                <div class="edit-profile-row">
                <div class="edit-profile-image" style="background-image: url('<?= $baseURL?>/<?= $user->image?>');"></div>
                    <input class="input-box" type="file" name="image" id="user_img">
                </div>
                <div class="edit-profile-row">
                    <label for="email">E-mail:</label>
                    <input class="input-box disabled" type="email" name="email" id="email" value="<?= $user->email?>" disabled>
                </div>
                <div class="edit-profile-row">
                    <label for="name">Nome:</label>
                    <input class="input-box" type="text" name="name" id="name" value="<?= $user->name?>">
                </div>
                <div class="edit-profile-row">
                    <label for="last_name">Sobrenome:</label>
                    <input class="input-box" type="text" name="last_name" id="last_name" value="<?= $user->last_name?>">
                </div>
                <div class="edit-profile-row">
                    <label for="bio">Biografia:</label>
                    <textarea name="bio" id="bio" class="bio-box" placeholder="Escreva sobre você" rows="3"><?= $user->bio?></textarea>
                </div>
                <div class="btn-row">
                    <input type="submit" value="Salvar alterações" class="btn yellow-btn edit-profile-btn">
                </div>
            </form>
        </div>
        <div class="edit-profile-column">
            <h1>Alterar senha</h1>
            <form action="<?=$baseURL?>/edit_profile_process.php" method="post">
                <input type="hidden" name="operation" value="edit-password">
                <div class="edit-profile-row">
                    <label for="name">Senha atual:</label>
                    <input class="input-box" type="password" name="current_password" id="current-password">
                </div>
                <div class="edit-profile-row">
                    <label for="name">Nova senha:</label>
                    <input class="input-box" type="password" name="new_password" id="new-password">
                </div>
                <div class="edit-profile-row">
                    <label for="name">Senha atual:</label>
                    <input class="input-box" type="password" name="confirm_new_password" id="current-password">
                </div>
                <div class="btn-row">
                    <input type="submit" value="Atualizar senha" class="btn yellow-btn edit-profile-btn">
                </div>
            </form>
        </div>
    </div>

<?php
    include_once("templates/footer.php");
?>