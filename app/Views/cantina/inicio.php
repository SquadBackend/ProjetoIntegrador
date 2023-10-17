<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Cantina</title>
</head>
<body>
    <div class="cantina">
        CANTINA
    </div>
    <div class="dir">
        <a href="<?php echo base_url() . 'cantina/cadastros/'; ?>">Acesso aos cadastros</a> <br>
        <a href="<?php echo base_url() . 'cantina/cardapio/'; ?>">CARDÁPIO DO DIA</a> <br>

        <a href="<?php echo base_url() . 'cantina/reservas/'; ?>">ACOMPANHAMENTO DE RESERVAS</a> <br>
        <a href="<?php echo base_url(); ?>">PAGAMENTOS</a> <br>
        <a href="<?php echo base_url() . 'sair/'; ?>">Sair</a>

    </div>
</body>
</html>
