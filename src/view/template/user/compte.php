<?php $stylesheet="compte" ?>
<?php $title="Mon compte" ?>

<?php include ROOT . '/src/view/inc/_header.php' ?>

<div class="container">
    <div class="home-content">
    <?php if ($auth->totp_key == '') : ?>
        <a class="btn-auth-2fateur" href="/active-totp">Activer l'authentification a deux facteur</a>
    <?php else : ?>
        <p>L'authentification a deux facteur est activer sur ce compte</p>
        <a class="btn-rem-2fateur" href="/remove-totp">supprimer l'authentification a deux facteur</a>

    <?php endif ?>
    </div>

</div>