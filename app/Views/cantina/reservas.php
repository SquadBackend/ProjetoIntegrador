<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="/css/acompreservas.css">
    <title>Acompanhamento de Reservas</title>
</head>
<body>
    <header>
    <div class="titulo">
        <div class="setaborda">
            <section class="borda" id="id2">
           <img class="bd" src="/img/borda.png" alt="borda">
        </section>
            <section class="borda" id="id1">
            <a href="<?php echo site_url('cantina/inicio','https'); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt="seta"></a>
           </section>
        </div>
        <p class="text1">Acompanhamento de reservas</p>
        <div class="l"><img src="/img/linha.png" alt="yellow" class="linha"></div>
    </div>


</header>
    <div class="gg">
    <table>
        <tr>
          <th></th>
          <th>TOTAL DE RESERVAS: <?php echo $total; ?></th>
          <th><div class="table"><p>Classificar por tempo</p><img src="/img/seta.png" alt="seta" class="seta"></div></th>
        </tr>
        <?php foreach ($reservas as $reserva) : ?>
          <tr>
            <td><img src="/img/fotoperfil.png" alt="foto" class="perfil"></td>
            <td><div class="desc"> <b><p><?php echo $reserva->Nome; ?></p></b> <p>Reserva realizada</p></div></td>
             <td><div class="pt"><img src="/img/pontos.png" alt="pontos" class="ponto"><p>3min atrás</p></div></td>
          </tr>
        <?php endforeach ?>
      </table>
    </div>
</div>
</body>
</html>
