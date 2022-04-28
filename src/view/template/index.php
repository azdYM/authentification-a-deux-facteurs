<?php

 $stylesheet="home" ?>
<?php include ROOT . '/src/view/inc/_header.php'?>

<div class="container">
    <div class="home-content">
        <?php if (!empty($auth)) : ?>

            <?php if ($auth->totp_key == '') :?>
                <div class="auth-info">
                    <p>l'autentification a deux facteurs n'est pas activer sur ce compte</p>
                    <span>Veuillez l'activer sur les parametres de votre <a href="/account">compte</a></span>
                </div>
            <?php endif ?>

        <?php else : ?>
            <h1>Veuillez vous connecter</h1>
        <?php endif ?>
    </div>

</div>