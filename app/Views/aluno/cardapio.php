<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/menu.css">
    <title>Cardápio</title>
</head>
<body>
    <div class="acess">
    <a href="<?php echo site_url('aluno/', METHOD); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <center>Menu</center>
    </div>
    <div class="card">
        <center>Cardápio do dia</center>
    </div>
    <div class="food">
        <?php foreach($comidas as $comida) : ?>
            <?php echo $comida['Comida']; ?>
            <br>
        <?php endforeach ?>
    </div>
</body>
</html>
