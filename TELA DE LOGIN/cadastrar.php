<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
  require_once 'CLASSES/usuarios.php';
  $Usuario = new Usuario;
?>

<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <!--http-equiv é para a pagina atualizar automaticamente-->
    <meta http-equiv="refresh" content="tempo">
    <title> projeto anime</title>
    <link rel="stylesheet" href="CSS/style.css">

  </head>

  <body>
    <!--<div id="body-form-Can este é caso estivesse com o formulario errado no
    style.css">-->
    <div id="body-form">
      <h1>Cadastrar Otaku</h1>
      <!--será feito tres input-->
      <form method="POST"> 
          <!--login-->
        <input type="text" name="nome" placeholder="name" maxlength="30">
         <!--login-->
         <input type="email" name="email" placeholder="email" maxlength="40"> 
          <!--senha-->
        <input type="password" name="Senha" placeholder="Senha" maxlength="15">
         <!--senha-->
        <input type=" password" name="ConfSenha" placeholder="ConfSenha" maxlength="15">
          <!--botão-->
        <input type="submit" value="Cadastrar">
      </form>
    </div>
    <?php
      //Verificar se clicou no botão
      if(isset($_POST['nome']))
      {
        // o addslashes serve para poder inibir um rackeamento e poder usar o site
        $nome = addslashes($_POST['nome']);
        //$telephone = addslashes($_POST['telephone']);//
        $email = addslashes($_POST['email']);
        $Senha = addslashes($_POST['Senha']);
        $ConfSenha = addslashes($_POST['ConfSenha']);
        //Verificar se esta preenchido
        if(!empty($nome) && !empty($email) && !empty($Senha) && !empty($ConfSenha))
        {
          //talve tenha que mudar o nome que esta no banco de dados se não for este
          $Usuario->conectar("projeto_SiteAnime","localhost","root","");
          if($Usuario->msgErro == "")//se esta tudo ok
          {
            if($Senha == $ConfSenha)
            {
              if($Usuario->cadastrar($nome,$email, $Senha))
              {
                ?>
                <div id="msg-sucesso">
                cadastrado com sucesso! acesse para entrar!
                </div>
                <?php
              }
              else
              {
                ?>
                <div class="msg-erro">
                Email já cadastrado!
                </div>
                <?php
              }
            }
            else
            {
              ?>
              <div class="msg-erro">
              Senha e confirmar senha não correspondem!
              </div>
              <?php
              
            }
          }
          else
          {
            ?>
              <div class="msg-erro">
              <?php echo "Erro: ".$u->msgErro;?>
              </div>
              <?php
          }
        }else
        {
          ?>
          <div class="msg-erro">
          preencha todos os campos!
          </div>
          <?php
        }
      }
    
    ?>
  </body>
</html>