<?php
session_start(); //INICIANDO A SESSAO
//session_destroy() PARA DESTRUIR A SESSAO.. NORMALMENTE QUANDO SAI DO PAINEL DO SITE ONDE VC ESTAVA LOGADO

extract($_POST);

if (isset($login) && isset($senha)) {
    // header('Location: http://localhost/session/ ');


  if (($login == 'ADMIN') && ($senha == 'bookstan')) {
    $_SESSION['AUTORIZADO'] = true;  //CRIANDO A VARIAVEL E ATRIBUINDO TRUE A MESMA
    echo 'Autorizado';
  } else {
    $_SESSION['AUTORIZADO'] = false;
    echo 'Nao Autorizado';
    exit;
  }
}

if (empty($_SESSION)) {
  header('Location: http://localhost/session/ ');
}


?>

<br>
<br>

<a href="http://localhost/pagina2.php">Cadastro</a>