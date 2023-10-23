<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/alunos.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Cadastros</title>
</head>
<body>
    <div class="acess">
        <a href="<?php echo site_url('cantina/inicio','https'); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
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
                <th></th>
            </tr>
            <?php foreach($usuarios as $usuario) :  ?>
                <tr id="row-<?= $usuario['id']; ?>">
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
                    <td><a class="buttonDelete" onclick="deletar(<?= $usuario['id']; ?>);">Deletar</a></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <script>
        async function deletar(id)
        {
            const res = await axios.delete('/api/usuarios/' + id);
            res.status;
            if(res.status == 200){
                console.log("deletado com sucesso!");
                document.querySelector("#row-" + id).remove();
            }else{
                console.log("Ocorreu um erro!");
            }
        }
    </script>
</body>
</html>
