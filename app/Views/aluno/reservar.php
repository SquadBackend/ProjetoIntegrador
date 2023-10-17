<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reservar.css">
    <title>Reservar</title>
</head>
<body>
    <div class="header">
        <a href="<?php echo base_url() . 'aluno/inicio/'; ?>"><img class="chevron-left" src="/chevron-left.svg" alt=""></a>
        <span class="header title">RESERVAR</span>
    </div>
    <div class="main">
        <div class="form-group">
            <form action="<?php echo base_url() . 'aluno/reservar/'; ?>" method="post">
                <label for="date">ESCOLHA O DIA:</label>
                <input type="date" name="date" id="date">

                <label for="turno">QUAL TURNO:</label>
                <input type="text" name="turno">

                <label for="login">LOGIN:</label>
                <input type="text" name="login" id="login">
                <p>uso do login para confirmar a reserva</p>
                </div>
                <button type="submit" class="reservar-button">reservar</button>
                <!--<div class="reservar-button">
                    reservar
                </div> -->
                <input type="hidden" name="userId" value="<?php echo session()->get('id'); ?>">
        </form>
    </div>

</body>
</html>
