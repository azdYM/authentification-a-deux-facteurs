<?php include ROOT . '/src/view/inc/_header.php' ?>

<div class="container">
    <h1>Activer l'authentification a 2 facteur</h1>
    
    <?php if (!empty($_SESSION['error_code'])) :?>
        <span class="error"><?=$_SESSION['error_code'] ?></span>
    <?php endif ?>
    <div>
        <img width="250" height="250" src="<?= $qrcode ?>" alt="">
    </div>
    <form method="POST">
        <div class="field-input">
            <label for="code">Code</label>
            <input type="text" name="code" autofocus id="code">
        </div>
        <input type="submit" value="activer">
    </form>
</div>