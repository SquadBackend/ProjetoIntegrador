<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/alunos.css">
    <title>Cadastros</title>
</head>
<body>
    <div class="acess">
        <a href="<?php echo base_url() . 'cantina/inicio/'; ?>"><img class="chevron-left" src="/chevron-left.svg" alt=""></a>
        <center>Acesso aos cadastros</center>
    </div>
    <div class="acess-1">
        <table>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Matrícula</th>
                <th>CPF</th>
                <th>Bolsista</th>
                <th>Turma</th>
            </tr>
            <?php foreach($usuarios as $usuario) :  ?>
                <tr>
                    <td><?php echo $usuario['Nome']; ?></td>
                    <td><?php echo $usuario['Email']; ?></td>
                    <td><?php echo $usuario['Matricula']; ?></td>
                    <td><?php echo $usuario['CPF']; ?></td>
                    <td>
                        <?php if($usuario['Tem_auxilio'] == 1) : ?>
                            <?php echo '100%'; ?>
                        <?php else: ?>
                            <?php echo 'Não'; ?>
                        <?php endif ?>
                    </td>
                    <td>3-A</td>
                </tr>
            <?php endforeach ?>
        </table>

    </div>
</body>
</html>
