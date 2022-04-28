<nav class="navbar">
    <h3 class="logo">LOGO</h3>
    <div class="link-navigation">
        <?php if (empty($auth)) : ?>
            <a href="/login">Se connecter</a>
            <a href="/register">S'inscrire</a>
        <?php else : ?>
            <a href="/account">Mon compte</a>
            <a href="/logout">Se deconnecter</a>
        <?php endif ?>
    </div>
</nav>