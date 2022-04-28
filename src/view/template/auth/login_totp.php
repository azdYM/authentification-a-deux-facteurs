<?php $title="Login totp !" ?>
<?php $stylesheet="auth" ?>
<?php include ROOT . '/src/view/inc/_header.php' ?>

<div class="container">
    <div class="auth-content">
        <h1>Se connecter</h1>
        <p>Ce compte a activé l'authentification à deux facteur à parrtir d'un code temporaire</p>

        <form method="POST">
            <div class="field-input">
                <label for="code">code</label>
                <input type="text" placeholder="code" name="code" id="code">
            </div>
            <input type="submit" value="Envoyer">
        </form>
    </div>
</div>