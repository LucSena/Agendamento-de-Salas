<?php
require_once("system/conexao.php");

//http://localhost/segundobimestre/Estudo/CrudBasico/editar.php?usuario=9

$user_id = (int) $_GET['usuario'];

// echo "usuario a ser editado é" . $user_id;

$pesquisa = "SELECT * FROM tb_usuarios WHERE id = '$user_id'";

$resultado = mysqli_query($link, $pesquisa);

$mostrar = mysqli_fetch_assoc($resultado);

$loginAntigo = $mostrar['email'];

//continuar update

if (isset($_POST['acao']) && $_POST['acao'] == 'atualizar') {
  $user_nome = $_POST['name'];
  $user_login = $_POST['email'];
  $user_senha = $_POST['password'];
  $usuario_nivel = $_POST['nivel'];
  $inst = $_POST['inst'];

  if ($user_login <> $loginAntigo) {

    $pesquisa = "SELECT * FROM tb_usuarios WHERE email = '$user_login'";
    $resultado = mysqli_query($link, $pesquisa);
    $registro = mysqli_num_rows($resultado);

    if ($registro > 0) {
      echo "Usuario Login já cadastrado no sistema";
    } else {
      $sql = "UPDATE tb_usuarios SET nome ='$user_nome', email ='$user_login', senha ='$user_senha', instituicao = '$inst', nivel ='$usuario_nivel' WHERE id = '$user_id' ";

      $query = mysqli_query($link, $sql);

      if ($query == true) {
        $script = "<script>alert('Usuario editado com sucesso!');location.href='administrador.php'</script>'";

        echo $script;
      } else {
        echo "erro ao atualizar o usuario";
      }
    }
  } else {
    $sql = "UPDATE tb_usuarios SET nome ='$user_nome', email ='$user_login', senha ='$user_senha', instituicao = '$inst', nivel ='$usuario_nivel' WHERE id = '$user_id' ";;

    $query = mysqli_query($link, $sql);

    if ($query == true) {
      $script = "<script>alert('Usuario editado com sucesso!');location.href='administrador.php'</script>'";

      echo $script;
    } else {
      echo "erro ao atualizar o usuario";
    }
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
  <link rel="stylesheet" href="./assets/css/editar.css">
  <link rel="icon" href="assets/img/Sesi_positivo.svg">
  <title>Editando - Ambientes Senai</title>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom" id="caixa-principal">
      <div class="row d-flex justify-content-center align-items-center h-100">


        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form id="caixa-form" method="POST">

            <h1>Edite um usuario</h1>
            <div class="form-outline mb-4">
              <input type="text" id="form3Example3" name="name" class="form-control form-control-lg" placeholder="Coloque seu nome completo" value="<?php echo $mostrar['nome']; ?>" />
              <label class="form-label" for="form3Example3">Nome </label>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form3Example3" name="email" class="form-control form-control-lg" placeholder="Edite o email" value="<?php echo $mostrar['email']; ?>" />
              <label class="form-label" for="form3Example3">Email </label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="form3Example4" name="password" class="form-control form-control-lg" placeholder="Edite a senha" value="<?php echo $mostrar['senha']; ?>" />
              <label class="form-label" for="form3Example4">Senha</label>
            </div>


            <div class="gender-inputs">
              <div class="gender-title">
                <h6>Instituição</h6>
              </div>

              <div class="gender-group">
                <div class="gender-input">
                  <input id="female" type="radio" name="inst" value='1' <?php if ($mostrar['instituicao'] == 1) {
                                                                          echo "checked";
                                                                        } ?>>
                  <label for="female">Sesi</label>
                </div>

                <div class="gender-input">
                  <input id="male" type="radio" name="inst" value='2' <?php if ($mostrar['instituicao'] == 2) {
                                                                        echo "checked";
                                                                      }  ?>>
                  <label for="male">Senai</label>
                </div>

                <div class="gender-input">
                  <input id="others" type="radio" name="inst" value='3' <?php if ($mostrar['instituicao'] == 3) {
                                                                          echo "checked";
                                                                        }  ?>>
                  <label for="others">Outros</label>
                </div>

              </div>
            </div>
            <br>
            <div class="gender-inputs">
              <div class="gender-title">
                <h6>Nivel</h6>
              </div>

              <div class="gender-group">
                <div class="gender-input">
                  <input id="female" type="radio" name="nivel" value='0' <?php if ($mostrar['nivel'] == 0) {
                                                                            echo "checked";
                                                                          } ?>>
                  <label for="female">Não Validado</label>
                </div>

                <div class="gender-input">
                  <input id="male" type="radio" name="nivel" value='1' <?php if ($mostrar['nivel'] == 1) {
                                                                          echo "checked";
                                                                        }  ?>>
                  <label for="male">Usuario</label>
                </div>

                <div class="gender-input">
                  <input id="others" type="radio" name="nivel" value='2' <?php if ($mostrar['nivel'] == 2) {
                                                                            echo "checked";
                                                                          }  ?>>
                  <label for="others">Administrador</label>
                </div>

              </div>
            </div>


            <div class="text-center text-lg-start mt-4 pt-2">

              <input type="hidden" name="acao" value="atualizar" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
              <input type="submit" class="btn btn-primary btn-lg btnn" value="Editar">
              <p class="small fw-bold mt-2 pt-1 mb-0">Já tenho login! <a href="login.php" class="link-danger">Logue-se</a></p>
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