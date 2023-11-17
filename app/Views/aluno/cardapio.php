<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cardápio</title>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="shortcut icon" href="#" type="image/x-icon" />
  </head>
  <body>
    <nav class="menu">
      <a href="<?php echo site_url('aluno/', METHOD); ?>"
        ><img class="chevron-left" src="/img/chevron-left.svg" alt=""
      /></a>
      <span>Menu</span>
    </nav>
    <header>
      <img class="imagem" src="/img/Logo.jpeg" alt="logotipo" />
      <p class="cardapio">Cardápio do Dia</p>
    </header>
    <main>
      <?php foreach($comidas as $comida) : ?>
          <div class="alimento" style="padding-right: calc(100% / 2 - 500px);">
              <img class="comida-img" src="/img/-.jpeg" alt="foto da comida" />
              <h2><?php echo $comida['Comida']; ?></h2>
          </div>
      <?php endforeach ?>
    </main>
  </body>
</html>