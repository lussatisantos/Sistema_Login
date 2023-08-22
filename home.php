<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina restrita</title>
</head>
<body>
    <?php 
        //Conexao
        require_once 'dbConnect.php';

        //Sessao
        session_start();

        /* // Verificacao
        if(isset($_SESSION['logado'])) {
            header('Location: index.php');
        } */

        //Dados
        $id = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM usuaruis WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    ?>
    <h1>Seja bem-vindo <?= $dados['nome']?></h1>

    <a href="logout.php">Sair</a>
</body>
</html>