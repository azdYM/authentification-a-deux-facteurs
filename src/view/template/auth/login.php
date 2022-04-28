<?php $stylesheet="auth" ?>
<?php $title="Login !" ?>
<?php include ROOT . '/src/view/inc/_header.php' ?>
<div class="content">
    <div class="auth-content">
        <h1>Connexion</h1>
        <?php if (!empty($errors["user_incorrect"])) :?>
            <span class="error user-incorrect"><?= $errors["user_incorrect"] ?></span>
        <?php endif ?>
        
        <form class="form-auth" method="POST">
            <div class="field-input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''?>"  placeholder="exemple@exemple.com">
                <?php if (!empty($errors["email"])) :?>
                    <span class="error"><?= $errors["email"] ?></span>
                <?php endif ?>
            </div>
    
            <div class="field-input">
                <label for="email">Mot de passe</label>
                <input type="password" name="password" id="email" placeholder="Mot de passe">
                <?php if (!empty($errors["password"])) :?>
                    <span class="error"><?= $errors["password"] ?></span>
                <?php endif ?>
            </div>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</div>