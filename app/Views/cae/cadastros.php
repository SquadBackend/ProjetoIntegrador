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
        <a href="<?php echo site_url('/', METHOD); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <center>Acesso aos cadastros</center>
    </div>
    <div id="back">
        <dialog id="deletarDialog" class="MiniDialog">
            <header>
                <p>Confirmação</p>
            </header>
            <article>   
                <p>Você tem certeza se quer deletar este usuário?</p>    
            </article>
            <footer>
                <button autofocus onclick="this.closest('dialog').close('cancel');document.querySelector('#back').style.display = 'none';">Cancelar</button>
                <button onclick="Deletar(event);">Deletar</button>
            </footer>
        </dialog>
    </div>
    <div class="info" id="info">
        
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
                    <td id="functions-<?= $usuario['id']; ?>"> 
                        <?php if($usuario['Verificado'] == 0) : ?>
                            <a class="button" onclick="Confirmar(<?= $usuario['id']; ?>);">Confirmar</a>
                        <?php else : ?>
                            <a class="button" onclick="MostrarDeletar(<?= $usuario['id']; ?>);">Deletar</a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <script>
        async function Confirmar(id){
            try {
                document.querySelector("#info").innerHTML = '<div class="info" id="info"></div>';
                const res = await axios.post('/api/usuarios/' + id, {
                    "Verificado" : 1
                });
                res.status;
                if(res.status == 200){
                    console.log("Confirmado com sucesso!");
                    document.querySelector("#info").innerHTML = '<div class="info" id="info"></div>';
                    document.querySelector("#functions-" + id).innerHTML = '<a class="button" id="verify-button" onclick="Deletar(' + id + ');">Deletar</a>';
                }else{
                    console.log("Ocorreu um erro!");
                    document.querySelector("#info").innerHTML = '<div class="info" id="info"><div class="message erro"><p>Ocorreu um erro ao confirmar o usuário.</p></div></div>';
                }    
            } catch (error) {
                document.querySelector("#info").innerHTML = '<div class="info" id="info"><div class="message erro"><p>Ocorreu um erro ao confirmar o usuário.</p></div></div>';
            }
        }

        const Back = document.querySelector('#back');
        const DeletarDialog = document.querySelector('#deletarDialog');
        var target_id;

        function MostrarDeletar(id){
            Back.style.display = 'block';
            DeletarDialog.showModal();
            //AlterarDialog.style.top = ((window.innerHeight/2) - (AlterarDialog.offsetHeight/2))+'px';
            //AlterarDialog.style.left = ((window.innerWidth/2) - (AlterarDialog.offsetWidth/2))+'px';
            target_id = id;
        }

        async function Deletar()
        {
            
            try {
                document.querySelector("#info").innerHTML = '<div class="info" id="info"></div>';
                const res = await axios.delete('/api/usuarios/' + target_id);
                res.status;
                if(res.status == 200){
                    console.log("deletado com sucesso!");
                    document.querySelector("#info").innerHTML = '<div class="info" id="info"></div>';
                    document.querySelector("#row-" + target_id).remove();
                    DeletarDialog.close();
                    Back.style.display = "none";
                }else{
                    console.log("Ocorreu um erro!");
                    document.querySelector("#info").innerHTML = '<div class="info" id="info"><div class="message erro"><p>Ocorreu um erro ao deletar o usuário.</p></div></div>';
                }    
            } catch (error) {
                document.querySelector("#info").innerHTML = '<div class="info" id="info"><div class="message erro"><p>Ocorreu um erro ao deletar o usuário.</p></div></div>';
            }
                
                      
        }
    </script>
</body>
</html>
