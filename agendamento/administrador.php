<?php
require_once('system/conexao.php');

session_start();

$user_id = $_SESSION['id'];

$select = mysqli_query($link, "SELECT * FROM `tb_usuarios` WHERE id = '$user_id' AND nivel > 1") or die('query failed');


if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
}

if ($fetch['nivel'] < 1) {
    header('location:paginicial.php');
} elseif (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
}


//Validando Usuario

if (isset($_GET['acao']) && $_GET['acao'] == "validar") {
    $usuario_id = $_GET['id'];
    $atualizar = "UPDATE tb_usuarios SET nivel='1' WHERE id = '$usuario_id'";
    $atualizado = mysqli_query($link, $atualizar);

    if ($atualizado == true) {
        echo '<script>
        alert("Usuário validado com sucesso");
        location.href="administrador.php"
        </script>';
    }
}

if (isset($_GET['acao']) && $_GET['acao'] == "excluir") {
    $usuario_id = $_GET['id'];
    $excluir = "DELETE FROM tb_usuarios WHERE id = '$usuario_id'";
    $excluido = mysqli_query($link, $excluir);

    if ($excluido == true) {
        echo '<script>
        alert("Usuário excluido com sucesso");
        location.href="administrador.php"
        </script>';
    }
}


?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Inicio - Ambientes Senai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/paginainicial.css">
    <link rel="stylesheet" href="./assets/css/select.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <link rel="icon" href="assets/img/Sesi_positivo.svg">





    <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
    </script>

    <!-- CDN link used below is compatible with this example -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

    <header>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="paginicial.php" class="navbar-brand d-flex align-items-center">
                    <!-- <img src="./assets/img/Sesi_positivo.svg" class="img-fluid" alt="Sample image" id="caixa-imagem" width="100%">   -->
                    <strong>Ambientes Senai</strong>
                </a>
                <nav class="sidenav" data-mdb-right="true">
                </nav>
                <?php
                $select = mysqli_query($link, "SELECT * FROM `tb_usuarios` WHERE id = '$user_id'") or die('query failed');
                if (mysqli_num_rows($select) > 0) {
                    $fetch = mysqli_fetch_assoc($select);
                }

                if ($fetch['nivel'] == 1) {
                    $funcao = 'Professor(a)';
                } elseif ($fetch['nivel'] == 2) {
                    $funcao = 'Administrador(a)';
                }

                ?>
                <div>
                    <a href="#myModalBloco"><button type="button" class="btn btn-md btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModalBloco">
                            <?php echo $fetch['nome']; ?>
                        </button></a>

                    <!-- Modal -->
                    <div class="modal fade" id="myModalBloco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-left:600px;">

                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Seu perfil</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>


                                <div class="modal-body">
                                    <div class="text-center">
                                        <h5 class="mb-3 line"><?php echo $funcao;
                                                                echo $fetch['nome']; ?></h5>
                                        <h6 class="mb-3 line">Seu email: <?php echo $fetch['email']; ?></h6>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="paginicial.php?logout=<?php echo $user_id; ?>" class="btn btn-primary btn-lg btnn">Sair de sua conta</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($fetch['nivel'] > 1) {
                    ?>
                        <a href="paginicial.php" class="btn btn-md btn-outline-primary">Pagina Inicial</a>

                    <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </header>

    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Validação</h1>
                    <p class="lead text-muted">Seja bem-vindo a pagina de Validação, um local para validar os cadastros do Sesi/Senai.</p>
                    <p>
                        <a href="sobre.html" class="btn btn-primary my-2">Como funciona? </a>
                        <a href="paginicial.php" class="btn btn-secondary my-2">Agendar um ambiente</a>
                    </p>
                    <a href="todosusuarios.php" class="btn btn-success my-2">Todos os usuarios</a>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">

            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 salas">
                    <h4>Usuarios não validados:</h4>
                    <?php
                    $pesquisa = "SELECT * FROM tb_usuarios WHERE nivel < 1 ORDER BY id DESC";
                    $resultado = mysqli_query($link, $pesquisa);
                    $registro = mysqli_num_rows($resultado);


                    while ($mostrar = mysqli_fetch_assoc($resultado)) {
                    ?>
                        <div class="col-md-12">
                            <div class="card shadow-sm">

                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?php
                                        if ($mostrar['instituicao'] == 1) {
                                            $instituicao = 'Sesi';
                                        } elseif ($mostrar['instituicao'] == 2) {
                                            $instituicao = 'Senai';
                                        } else {
                                            $instituicao = 'Outros';
                                        }

                                        ?>
                                        <small class="text-muted"> <?php echo $mostrar['nome']; ?></small>
                                        <small class="text-muted"> <?php echo $mostrar['email']; ?></small>
                                        <small class="text-muted"> <?php echo $instituicao; ?></small>
                                        <div class="btn-group">
                                            <a href="?acao=validar&id=<?php echo $mostrar['id']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Validar</button></a>
                                            <a href="editar.php?usuario=<?php echo $mostrar['id']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                                                <a href="?acao=excluir&id=<?php echo $mostrar['id']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Excluir</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Voltar ao inicio</a>
            </p>
            <div class="text-white mb-3 mb-md-0">
                <img class="float-left w-25" src="assets/img/senai-logo-1.png">
            </div>
        </div>
    </footer>


    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


</body>

</html>