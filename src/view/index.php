<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- definition des css -->
    <link rel="stylesheet" href="css/style.css">
    <?php if (!empty($stylesheet)) : ?>
        <link rel="stylesheet" href="css/<?=$stylesheet?>.css">
    <?php endif ?>

    <!-- definition du titre -->
    <title><?= !empty($title) ? $title : "Welcome !" ?></title> 
        
</head>
<body>
    <?= $content ?>
</body>
</html>