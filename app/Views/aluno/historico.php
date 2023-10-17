<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/historico.css">
    <title>Histórico</title>
</head>
<body>
    <div class="header">
        <a href="<?php echo base_url() . 'aluno/inicio/'; ?>"><img class="chevron-left" src="/chevron-left.svg" alt=""></a>
        <span class="header title">HISTÓRICO</span>
    </div>
    <div class="main">
        <p class="main-title">O QUE VOCÊ PEDIU RECENTEMENTE</p>

        <div class="food-list">
            <?php foreach($reservas as $reserva) : ?>
            <hr>
            <div class="food-container">
                <div class="food-picture">
                    <img src="https://saude.abril.com.br/wp-content/uploads/2022/06/nutricao-comida-brasileiro-prato.png?w=680&resize=1200,800" alt="">
                </div>
                <div class="food-description">
                    <p class="food-message">Você pediu isso!</p>
                    <p class="food-name">COMIDA 1</p>
                    <p class="food-date"><?php echo  date("d/m/Y", strtotime($reserva['Data']));  ?></p>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>

</body>
</html>
