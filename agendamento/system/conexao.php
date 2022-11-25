<?php
 require_once('config.php');

 $link = mysqli_connect(HOST, USER, PASS, BANCO)
    or die("Erro na conexão com o banco de dados");

mysqli_select_db($link, BANCO);
?>