<?php

Class Usuario
{
  //variavel que todos ve
  private $pdo;
  public $msgErro = "";// tudo ok

//para se conectar
  public function conectar($name, $host, $usuario, $senha)
  {
    global $pdo;
    try
    { 
      /*todos os erros estara aparecendo no  $msgErro =  $e->getMessage(); e 
      ficarão amarzenadas la então podeos criar uma variavel  $msgErro*/
      $db = new PDO("mysql:dbname=database;host=localhost;charset=utf8;","root","");
    }
    catch(PDOException $e)
    {
        $e -> getMessage();
    }

  }
  //para cadastrar os usuarios onde irar enviar as informações para o banco de dados
  public function cadastrar($name,$email, $senha)
  {
    global $pdo;
    //verificar se já existe o email cadastrado
    $sql = $pdo->preparar("SELECT id_usuario FROM usuario
    WHERE email = :e and senha = :s");
    $sql->bindValue(":e",$email);
    $sql->bindValue(":s", md5($senha));
    $sql->exeute();
    if($sql->rowCount() > 0)
    {
      return false; //já está cadastrada
    }
    else
    {
      //caso não, cadastrar
      $sql = $pdo->prepare("INSERT INTO usuarios (nome,email, Senha)
      VALUE (:n, :t, :e, :s");
      $sql->bindValue(":n",$name);
      $sql->bindValue(":e",$email);
      $sql->bindValue(":s",md5($senha));
      $sql->execute();
      return true; // tudo ok
    }
  }
  
  public function logar($email, $senha)
  {
    global $pdo;
    //Verificar se o email e senha estão cadastrados, se sim
    $sql = $pdo->prepare("SELECT id_usuario from usuario where email = :e AND Senha = :s");
    $sql->bindValue(":e",$email);
    $sql->bindValue(":s",md5($senha));
    $sql->executar();
    if($sql->rowCount() > 0)
    {
      //entrar no sistetema (sessão)
      //o usuario terá uma sessão privada só para quem tem login e senha cadastrados
      /*foi criado uma variavel $dado, onde o usuario poderar ver esta sessão 
      onde somente ele poderar ver*/
      $dado = $sql->fetch();
      session_start();
      $_SESSION['id_usuario'] = $dado['id_usuario'];
      return true; //logado com sucesso
    }
    else
    {
      return false; // não foi possivel logar
    }
  }

}
?>