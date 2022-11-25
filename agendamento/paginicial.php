<?php
require_once('system/conexao.php');

/* VERIFICANDO QUEM PODE ENTRAR E QUEM NÃO PODE*/

session_start();
$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
}



// FAZENDO HORARIO DO SISTEMA 


// $pesquisa = "SELECT * FROM tb_salas WHERE id = '$user_id'";

// $resultado = mysqli_query($link, $pesquisa);

// $mostrar = mysqli_fetch_assoc($resultado);


// $datasistema = date('d/m/Y', strtotime($mostrar['Datas']));
// $horariosistema = substr($mostrar['Horario'], 0, 5);
// $horariofinalsistema = substr($mostrar['HorarioFinal'], 0, 5);

// $agora = new DateTime(); // Pega o momento atual
// // $dataatual->format('d/m/Y H:i'); // Exibe no formato desejado

// if($agora> $datasistema and $horariofinalsistema ){

//     $atualizar = "UPDATE tb_salas SET status='1' WHERE id = '$sala_id'";
//     $atualizado = mysqli_query($link, $atualizar);

//     if ($atualizado == true) {
//         echo '<script>
//         alert("Sala agendada com sucesso");
//         location.href="paginicial.php"
//         </script>';
//     }
// }

// -----------------------------------------------------------------------------





$admin = mysqli_query($link, "SELECT * FROM `tb_usuarios` WHERE id = '$user_id' AND nivel > 1") or die('query failed');

if (mysqli_num_rows($admin) > 0) {
    $adminfetch = mysqli_fetch_assoc($admin);
}

/* AGENDANDO SALA */
// if (isset($_GET['acao']) && $_GET['acao'] == "validar") {
//     $usuario_id = $_GET['id'];
//     $atualizar = "UPDATE tb_salas SET status='2' WHERE id = '$user_id'";
//     $atualizado = mysqli_query($link, $atualizar);

//     if ($atualizado == true) {
//         echo '<script>
//         alert("Sala agendada com sucesso");
//         location.href="paginicial.php"
//         </script>';
//     }
// }



//BOTÃO VER
if (isset($_POST['editar']) && $_POST['editar'] == 'atualizar') {
    $user_id = (int) $_POST['usuario'];
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // exit;

    // echo "usuario a ser editado é" . $user_id;

    $pesquisa = "SELECT * FROM tb_salas WHERE id = '$user_id'";

    $resultado = mysqli_query($link, $pesquisa);

    $mostrar = mysqli_fetch_assoc($resultado);



    /* MOSTRAR A DATA

    $pesquisadois = "SELECT date_format(data, '%d/%m/%Y') as Datas FROM tb_salas WHERE id = '$user_id'";

    $resultadodois = mysqli_query($link, $pesquisadois);

    $mostrardois = mysqli_fetch_assoc($resultadodois);

    

    /* MOSTRAR BLOCO*/

    // $bloco = (int) $_POST['bloco'];

    // $pesquisabloco = "SELECT * FROM tb_bloco WHERE id = '$bloco'";

    // $resultadobloco = mysqli_query($link, $pesquisabloco);

    // $mostrarbloco = mysqli_fetch_assoc($resultadobloco);

    //


    $loginAntigo = $mostrar['nome'];

    $nome = $_POST['name'];
    $email = $_POST['email'];
    $nivel = $_POST['nivel'];

    if ($nome <> $loginAntigo) {

        $pesquisa = "SELECT * FROM tb_salas WHERE nome = '$nome'";
        $resultado = mysqli_query($link, $pesquisa);
        $registro = mysqli_num_rows($resultado);

        if ($registro > 0) {
            echo "Usuario Login já cadastrado no sistema";
        } else {
            $sql = "UPDATE tb_salas SET nome = '$nome', descricao = '$email', status = '$nivel' WHERE id = '$user_id' ";

            $query = mysqli_query($link, $sql);

            if ($query == true) {
                echo '<script>
                alert("Sala editada com sucesso");
                location.href="paginicial.php"
                </script>';
            } else {
                echo "Erro ao atualizar a sala";
            }
        }
    } else {
        $sql = "UPDATE tb_salas SET nome ='$nome', descricao ='$email', status ='$nivel' WHERE id = '$user_id'";

        $query = mysqli_query($link, $sql);

        if ($query == true) {
            echo '<script>
            alert("Sala editada com sucesso");
            location.href="paginicial.php"
            </script>';
        } else {
            echo "Erro ao atualizar a sala";
        }
    }
}

//BOTÃO EDITAR


// AGENDANDO UMA SALA
if (isset($_POST['agendar']) && $_POST['agendar'] == 'agendando') {
    $sala_id = (int) $_POST['usuario'];

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // exit;

    $pesquisa = "SELECT * FROM tb_salas WHERE id = '$sala_id'";
    $resultado = mysqli_query($link, $pesquisa);
    $mostrar = mysqli_fetch_assoc($resultado);

    $time = $_POST['time'];
    $timefinal = $_POST['timefinal'];
    $data = $_POST['data'];

    $atualizar = "UPDATE tb_salas SET status='2', Horario = '$time', Datas = '$data', HorarioFinal = '$timefinal' WHERE id = '$sala_id'";
    $atualizado = mysqli_query($link, $atualizar);

    if ($atualizado == true) {
        echo '<script>
        alert("Sala agendada com sucesso");
        location.href="paginicial.php"
        </script>';
    }
}

/* ADICIONANDO SALAS*/

if (isset($_POST['acao']) && $_POST['acao'] == "cadastrar") {
    //Código para cadastro no banco de dados

    //Resgatando os valores dos inputs do formulario
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $nivel = $_POST['nivel'];
    $andar = $_POST['andar'];
    $bloco = $_POST['bloco']; {
        $insert = mysqli_query($link, "INSERT INTO `tb_salas`(nome, descricao, status, fk_andar, fk_bloco) VALUES('$nome','$email','$nivel','$andar','$bloco')") or die('query failed');

        if ($insert) {
            $message[] = 'registered successfully!';
            header('location:paginicial.php');
        } else {
            $message[] = 'erro no registro!';
        }
    }
}

/* ADICIONANDO ANDAR*/

if (isset($_POST['acao']) && $_POST['acao'] == "cadandar") {
    //Código para cadastro no banco de dados

    //Resgatando os valores dos inputs do formulario
    $nome = $_POST['name']; {
        $insert = mysqli_query($link, "INSERT INTO `tb_andar`(andar) VALUES('$nome')") or die('query failed');

        if ($insert) {
            $message[] = 'registered successfully!';
            header('location:paginicial.php');
        } else {
            $message[] = 'erro no registro!';
        }
    }
}

/* ADICIONANDO BLOCOS*/

if (isset($_POST['acao']) && $_POST['acao'] == "cadbloco") {
    //Código para cadastro no banco de dados

    //Resgatando os valores dos inputs do formulario
    $nome = $_POST['name'];
    $email = $_POST['email']; {
        $insert = mysqli_query($link, "INSERT INTO `tb_bloco`(bloco, descricao) VALUES('$nome','$email')") or die('query failed');

        if ($insert) {
            $message[] = 'registered successfully!';
            header('location:paginicial.php');
        } else {
            $message[] = 'erro no registro!';
        }
    }
}

// Excluindo a sala

if (isset($_GET['excluir']) && $_GET['excluir'] == "excluindo") {


    $sala_id = (int) $_GET['id'];

    $pesquisa = "SELECT * FROM tb_salas WHERE id = '$sala_id'";

    $resultado = mysqli_query($link, $pesquisa);

    $mostrar = mysqli_fetch_assoc($resultado);

    $apagar = "DELETE FROM tb_salas WHERE id = '$sala_id'";

    $apagado = mysqli_query($link, $apagar);

    if ($apagado == true) {
        echo '<script>
                alert("Sala excluida com sucesso");
                location.href="paginicial.php"
              </script>';
    } else {
        echo '<script>
                alert("Erro ao excluir a sala");
                location.href="paginicial.php"
              </script>';
    }
}

/* SELECT DOS ANDARES*/

$query = $link->query("SELECT id, andar FROM tb_andar");

/* SELECT DOS BLOCOS*/

$querybloco = $link->query("SELECT id, bloco FROM tb_bloco");

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
                    <a href="#myModalUsuario"><button type="button" class="btn btn-md btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModalUsuario">
                            <?php echo $fetch['nome']; ?>
                        </button></a>

                    <!-- Modal -->
                    <div class="modal fade" id="myModalUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-left:600px;">

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
                        <a href="administrador.php" class="btn btn-md btn-outline-primary">Administrador</a>

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
                    <h1 class="fw-light">Ambiente Senai</h1>
                    <p class="lead text-muted">Seja bem-vindo ao Ambiente Senai, um local especializado em agendamentos
                        de salas da instituição Sesi/Senai.</p>
                    <p>
                        <a href="sobre.html" class="btn btn-primary my-2">Como funciona? </a>
                        <a href="#" class="btn btn-secondary my-2">Agendar um ambiente</a>
                    </p>
                </div>
            </div>
        </section>

        <section class="text-left container">


        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <!-- FILTRAGEM ()-->
                <!-- <form id="form-select" method="POST">
                    <div class="filtrar">

                        <h4>Filtros:</h4>

                        <select class="selectpicker" data-style="btn-primary">
                            <option value="" disabled selected>Andar</option>
                            <option>Primeiro Andar</option>
                            <option>Segundo Andar</option>
                            <option>Terceiro Andar</option>
                        </select>
                        <select class="selectpicker" data-style="btn-primary">
                            <option value="" disabled selected>Bloco</option>
                            <option>Bloco A</option>
                            <option>Bloco B</option>
                            <option>Bloco C</option>
                        </select>
                        <select class="selectpicker" data-style="btn-primary">
                            <option value="" disabled selected>Salas</option>
                            <option>Disponivel</option>
                            <option>Reservada</option>
                            <option>Manutenção</option>
                        </select>

                        <input type="hidden" name="acao" value="filtrar" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
                        <input type="submit" class="btn btn-primary btn-md btnn" value="Filtrar">
                    </div>
                </form> -->
                <?php
                if ($fetch['nivel'] > 1) {
                ?>

                    <div class="row filtrar">

                        <h4>Editar a página(Administrador):</h4>
                        <div class="col-sm-4" style="width: 13%;">
                            <form id="form-andar" method="POST">
                                <div>
                                    <a href="#myModalAndar"><button type="button" class="btn btn-md btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModalAndar">
                                            Adicione um Andar
                                        </button></a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModalAndar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Adicione um andar</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="form3Example3" name="name" class="form-control form-control-lg" placeholder="Nome do Andar (Primeiro Andar)" />
                                                        <label class="form-label" for="form3Example3">Nome da Andar</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="acao" value="cadandar" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
                                                    <input type="submit" class="btn btn-primary btn-lg btnn" value="Editar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4" style="width: 13%;">
                            <form id="form-andar" method="POST">
                                <div>
                                    <a href="#myModalBloco"><button type="button" class="btn btn-md btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModalBloco">
                                            Adicione um Bloco
                                        </button></a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModalBloco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Adicione um bloco</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>



                                                <div class="modal-body">
                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="form3Example3" name="name" class="form-control form-control-lg" placeholder="Nome do bloco (Bloco A)" />
                                                        <label class="form-label" for="form3Example3">Nome do Bloco</label>
                                                    </div>

                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="form3Example3" name="email" class="form-control form-control-lg" placeholder="Coloque uma pequena descrição sobre o bloco" />
                                                        <label class="form-label" for="form3Example3">Descrição</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="acao" value="cadbloco" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
                                                    <input type="submit" class="btn btn-primary btn-lg btnn" value="Editar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4" style="width: 13%;">
                            <form id="form-salas" method="POST">
                                <div>
                                    <a href="#myModal"><button type="button" class="btn btn-md btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModal">
                                            Adicione Salas
                                        </button></a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Adicione uma sala</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="form3Example3" name="name" class="form-control form-control-lg" placeholder="Coloque o nome da sala (M-14)" />
                                                        <label class="form-label" for="form3Example3">Nome da Sala</label>
                                                    </div>

                                                    <!-- Email input -->
                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="form3Example3" name="email" class="form-control form-control-lg" placeholder="Coloque uma pequena descrição sobre a sala" />
                                                        <label class="form-label" for="form3Example3">Descrição </label>
                                                    </div>
                                                    <hr>
                                                    <div class="gender-inputs">
                                                        <div class="gender-title">
                                                            <h6>Status:</h6>
                                                        </div>

                                                        <div class="gender-group">
                                                            <div class="gender-input">
                                                                <input id="female" type="radio" name="nivel" value='1'>
                                                                <label for="female">Disponivel</label>
                                                            </div>

                                                            <div class="gender-input">
                                                                <input id="male" type="radio" name="nivel" value='2'>
                                                                <label for="male">Ocupada</label>
                                                            </div>

                                                            <div class="gender-input">
                                                                <input id="others" type="radio" name="nivel" value='3'>
                                                                <label for="others">Manutenção</label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="gender-inputs">
                                                        <div class="gender-title">
                                                            <h6>Andar:</h6>
                                                        </div>

                                                        <div class="gender-group">
                                                            <select name="andar">
                                                                <?php while ($reg = $query->fetch_array()) { ?>
                                                                    <option value="<?php echo $reg['id']; ?>">
                                                                        <?php echo $reg['andar']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>

                                                        <div class="gender-title">
                                                            <h6>Bloco:</h6>
                                                        </div>

                                                        <div class="gender-group">
                                                            <select name="bloco">
                                                                <?php while ($reg = $querybloco->fetch_array()) { ?>
                                                                    <option value="<?php echo $reg['id']; ?>">
                                                                        <?php echo $reg['bloco']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="acao" value="cadastrar" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
                                                    <input type="submit" class="btn btn-primary btn-lg btnn" value="Editar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php
                }
                ?>


                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 salas">

                    <?php
                    $pesquisa = "SELECT * FROM tb_salas ORDER BY nome DESC";
                    $resultado = mysqli_query($link, $pesquisa);
                    $registro = mysqli_num_rows($resultado);


                    while ($mostrar = mysqli_fetch_assoc($resultado)) {
                    ?>

                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <?php
                                if ($mostrar['status'] == 1) {
                                    $status = 'Disponivel';
                                    $classe = '#228B22';
                                } elseif ($mostrar['status'] == 2) {
                                    $status = 'Ocupada';
                                    $classe = '#B22222';
                                } else {
                                    $status = 'Manutenção';
                                    $classe = '#EDC111';
                                }

                                ?>
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="<?php echo $classe; ?>" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">
                                        <?php echo $status; ?>
                                    </text>
                                </svg>

                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <!-- Botão VER -->
                                            <a href="#myModalVer<?php echo $mostrar['id']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModalVer<?php echo $mostrar['id']; ?>">
                                                    Ver
                                                </button></a>

                                            <!-- Modal VER -->
                                            <div class="modal fade" id="myModalVer<?php echo $mostrar['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                                <div class="modal-dialog modal-sm" role="document">

                                                    <form action="" method="post">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Sala <?php echo $mostrar['nome']; ?> </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="text-center">
                                                                                <a href="#" class="share"><span class="icon-share"></span></a>
                                                                                <h3 class="mb-3 line">Sala <?php echo $mostrar['nome']; ?></h3>
                                                                                <p class="mb-3 line py-3 border-bottom">
                                                                                    <strong>
                                                                                        <span class="icon-star"><?php echo $status; ?>
                                                                                        </span>
                                                                                        <br>
                                                                                        <span class="icon-star"><?php echo date('d/m/Y', strtotime($mostrar['Datas'])) . ' - ' . substr($mostrar['Horario'], 0, 5) . ' - ' . substr($mostrar['HorarioFinal'], 0, 5); ?>
                                                                                        </span>
                                                                                    </strong>
                                                                                </p>

                                                                                <p class="mb-5"><?php echo $mostrar['descricao']; ?></p>

                                                                                <?php
                                                                                if ($mostrar['fk_bloco'] == 1) {
                                                                                    $nomebloco = 'Bloco A';
                                                                                } elseif ($mostrar['fk_bloco'] == 2) {
                                                                                    $nomebloco = 'Bloco B';
                                                                                } elseif ($mostrar['fk_bloco'] == 3) {
                                                                                    $nomebloco = 'Bloco C';
                                                                                } elseif ($mostrar['fk_bloco'] == 4) {
                                                                                    $nomebloco = 'Bloco D';
                                                                                } elseif ($mostrar['fk_bloco'] == 5) {
                                                                                    $nomebloco = 'Bloco E';
                                                                                } else {
                                                                                    $status = 'Manutenção';
                                                                                    $classe = '#EDC111';
                                                                                }

                                                                                if ($mostrar['fk_andar'] == 1) {
                                                                                    $nomeandar = 'Primeiro Andar';
                                                                                } elseif ($mostrar['fk_andar'] == 2) {
                                                                                    $nomeandar = 'Segundo Andar';
                                                                                } elseif ($mostrar['fk_andar'] == 3) {
                                                                                    $nomeandar = 'Terceiro Andar';
                                                                                } elseif ($mostrar['fk_andar'] == 4) {
                                                                                    $nomeandar = 'Quarto Andar';
                                                                                } elseif ($mostrar['fk_andar'] == 5) {
                                                                                    $nomeandar = 'Quinto Andar';
                                                                                } else {
                                                                                    $status = 'Manutenção';
                                                                                    $classe = '#EDC111';
                                                                                }

                                                                                ?>
                                                                                <hr>
                                                                                <div class="text-center">
                                                                                    <p class="text-nowrap">Essa sala pertence ao <?php echo $nomebloco; ?>
                                                                                        <br> E está localizada no <?php echo $nomeandar; ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <?php
                                                                if ($mostrar['status'] <= 1) {
                                                                ?>
                                                                    <a href="#myModalAgendar<?php echo $mostrar['id']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModalAgendar<?php echo $mostrar['id']; ?>">
                                                                            Agendar
                                                                        </button></a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                </div>
                                                </form>
                                            </div>


                                            <?php
                                            if ($fetch['nivel'] > 1) {
                                            ?>
                                                <!-- Botão EDITAR -->
                                                <a href="#myModal<?php echo $mostrar['id']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $mostrar['id']; ?>">
                                                        Editar
                                                    </button></a>
                                            <?php
                                            }
                                            ?>

                                            <!-- Modal EDITAR -->
                                            <div class="modal fade" id="myModal<?php echo $mostrar['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                                <div class="modal-dialog" role="document">

                                                    <form action="" method="post">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Edite a sala</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="form-outline mb-4">
                                                                    <input type="text" id="form3Example3" name="name" value="<?php echo $mostrar['nome']; ?>" class="form-control form-control-lg" placeholder="Coloque o nome da sala (M-14)" />
                                                                    <label class="form-label" for="form3Example3">Nome da Sala</label>
                                                                </div>

                                                                <!-- Email input -->
                                                                <div class="form-outline mb-4">
                                                                    <input type="text" id="form3Example3" name="email" value="<?php echo $mostrar['descricao']; ?>" class="form-control form-control-lg" placeholder="Coloque uma pequena descrição sobre a sala" />
                                                                    <label class="form-label" for="form3Example3">Descrição </label>
                                                                </div>

                                                                <div class="gender-inputs">
                                                                    <div class="gender-title">
                                                                        <h6>Instituição</h6>
                                                                    </div>

                                                                    <div class="gender-group">
                                                                        <div class="gender-input">
                                                                            <input id="female" type="radio" name="nivel" value='1' <?php if ($mostrar['status'] == 1) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                            <label for="female">Disponivel</label>
                                                                        </div>

                                                                        <div class="gender-input">
                                                                            <input id="male" type="radio" name="nivel" value='2' <?php if ($mostrar['status'] == 2) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                            <label for="male">Ocupada</label>
                                                                        </div>

                                                                        <div class="gender-input">
                                                                            <input id="others" type="radio" name="nivel" value='3' <?php if ($mostrar['status'] == 3) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                                            <label for="others">Manutenção</label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col modal-footer">
                                                                <input type="hidden" name="excluir" value="excluindo" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
                                                                <input type="hidden" name="usuario" value="<?php echo $mostrar['id']; ?>">





                                                                <a href="?excluir=excluindo&id=<?php echo $mostrar['id']; ?>" class="col-4 btn btn-primary btn-lg btnn"> Deletar a Sala</a>





                                                                <input type="hidden" name="editar" value="atualizar" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
                                                                <input type="hidden" name="usuario" value="<?php echo $mostrar['id']; ?>">
                                                                <input type="submit" class="col-4 btn btn-primary btn-lg btnn" value="Editar">
                                                            </div>
                                                        </div>
                                                </div>
                                                </form>
                                            </div>

                                            <?php
                                            if ($mostrar['status'] <= 1) {
                                            ?>
                                                <a href="#myModalAgendar<?php echo $mostrar['id']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModalAgendar<?php echo $mostrar['id']; ?>">
                                                        Agendar
                                                    </button></a>
                                            <?php
                                            }
                                            ?>
                                            <!-- Modal AGENDAR -->
                                            <div class="modal fade" id="myModalAgendar<?php echo $mostrar['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                                <div class="modal-dialog" role="document">

                                                    <form action="" method="post">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Agende essa sala</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <h3 class="mb-3 line text-center">Sala <?php echo $mostrar['nome']; ?></h3>
                                                                <hr>
                                                                <!-- Email input -->
                                                                <h5 class="mb-3 line text-center">Selecione o horario que você deseja agendar</h5>
                                                                <div class="gender-inputs">
                                                                    <div class="text-center gender-title">
                                                                        <h6>Horarios Disponiveis</h6>
                                                                    </div>

                                                                    <div class="row gender-group">

                                                                          
                                                                        <div class="text-center col gender-input">
                                                                            <h9>Horario de Inicio</h9>
                                                                            <input type="time" name="time" name="time">
                                                                        </div>

                                                                        <div class="text-center col gender-input">
                                                                            <h9>Horario Final</h9>
                                                                            <input type="time" name="timefinal" name="timefinal">
                                                                        </div>

                                                                        <div class="text-center col gender-input">
                                                                            <h9>Data</h9>
                                                                            <input type="date" name="data" value="data">
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="agendar" value="agendando" class="btn btn-primary btn-lg btnn" style="padding-left: 2.5rem; padding-right: 2.5rem; ">
                                                                <input type="hidden" name="usuario" value="<?php echo $mostrar['id']; ?>">
                                                                <input type="submit" class="btn btn-primary btn-lg btnn" value="Agendar">
                                                            </div>
                                                        </div>
                                                </div>
                                                </form>
                                            </div>



                                        </div>
                                        <small class="text-muted">
                                            <?php echo $mostrar['nome']; ?>
                                        </small>
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
                <img class="w-25" src="assets/img/senai-logo-1.png">
            </div>
        </div>
    </footer>


    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="script.js"></script>


</body>

</html>