<?php
require_once('system/conexão.php');
session_start();

if (isset($_POST['acao']) && $_POST['acao'] == "entrar") {

  $email = $_POST['email'];
  $senha = MD5($_POST['password']);

  $select = mysqli_query($link, "SELECT * FROM `tb_usuarios` WHERE email = '$email' AND senha = '$senha' AND nivel > 0") or die('query failed');

  if (mysqli_num_rows($select) > 0) {
    $row = mysqli_fetch_assoc($select);
    $_SESSION['id'] = $row['id'];
    header('location:paginicial.php');
  } else {
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/login.css">
  <link rel="icon" href="assets/img/Sesi_positivo.svg">
  <title>Login - Ambientes Senai</title>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom" id="caixa-principal">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="./assets/img/Humaaans - 1 Character.png" class="img-fluid" alt="Sample image" id="caixa-imagem" width="100%">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" id="borda">
          <form id="caixa-form" method="POST">

            <h1>Faça seu login</h1>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form3Example3" name="email" class="form-control form-control-lg" placeholder="Coloque seu email" />
              <label class="form-label" for="form3Example3">Email </label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="form3Example4" name="password" class="form-control form-control-lg" placeholder="Coloque sua senha" />
              <label class="form-label" for="form3Example4">Senha</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->

              <a href="#!" class="text-body">Esqueci minha senha</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <input type="hidden" name="acao" value="entrar" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
              <input type="submit" class="btn btn-primary btn-lg btnn" value="Entrar">
              <p class="small fw-bold mt-2 pt-1 mb-0">Não tenho cadastro ainda! <a href="cadastro.php" class="link-danger">Registre-se</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-dark navbar-fixed-bottom">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        <img src="assets/img/Sesi_positivo.svg">
      </div>
      <!-- Right -->
      <div>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
      <!-- Right -->
    </div>
  </section>

  <footer class="text-muted py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#">Voltar ao inicio</a>
      </p>
      <div class="text-white mb-3 mb-md-0">
        <img class="w-25" src="assets/img/senai-logo-1.png">
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>


</html>