<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
     
     //Conexao
     require_once 'dbConnect.php';

     //Sessao
     session_start(); 
 
    //botao de enviar
        if(isset($_POST['btn-entrar'])){
            $erros = array();
            $login = mysqli_escape_string($connect, $_POST['login']);
            $senha = mysqli_escape_string($connect, $_POST['senha']);


            if (empty($login) or (empty($senha))) {
                $erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
            } else {
                $senha = md5($senha);
                $sql = "SELECT login FROM usuaruis WHERE login = '$login'";
                $resultado = mysqli_query($connect, $sql);
            }

                if(mysqli_num_rows($resultado) > 0) {
                    $sql = "SELECT * FROM usuaruis WHERE login = '$login' AND senha = '$senha'";
                    $resultado = mysqli_query($connect, $sql);


                    if(mysqli_num_rows($resultado) == 1){
                        $dados = mysqli_fetch_array($resultado);
                        $_SESSION['logado'] = true;
                        $_SESSION['id_usuario'] = $dados['id'];
                        header('Location: home.php');
                    } else {
                        $erros[] = "<li> Usuario e senha nao conferem </li>";
                    }
                    
                    
                } else {
                    $erros[] = "<li> Usuario inexistente </li>";
                }
        }
    ?>
    
    <main>
    
        <h1>Login</h1>
        
        <?php 
            if(!empty($erros)) {
                foreach($erros as $erro) {
                    echo $erro . "<br>";
                }
            }
        ?>
        
        <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
            <label for="login">Login</label>
            <input type="text" name="login">
            <label for="senha">Senha</label>
            <input type="password" name="senha">
            <input type="submit" name="btn-entrar" value="Entrar">
        
        </form>
        
    </main>
</body>
</html>
