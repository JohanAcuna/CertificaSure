<?php
    require 'conexion.php';
    session_start();

    if (isset($_POST['email']) && isset($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $consulta = "SELECT * FROM usuario WHERE email='$email' AND pass='$pass'";
        $ejecutar = mysqli_query($enlace, $consulta);
        $row = mysqli_fetch_array($ejecutar);

        if ($row) {
            $id_usuario = $row[0];
            $id_rol = $row[1];

            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['id_rol'] = $id_rol;

            switch ($id_rol) {
                case 1:
                    header("Location: inicio_administrador.php?id_usuario=$id_usuario");
                    exit();
                case 2:
                    $consulta_monitor = "SELECT * FROM usuario_monitor WHERE id_usuario='$id_usuario' AND estado='Activo'";
                    $ejecutar_monitor = mysqli_query($enlace, $consulta_monitor);
                    $row_monitor = mysqli_fetch_array($ejecutar_monitor);
                    if ($row_monitor) {
                        header("Location: inicio_monitor.php?id_usuario=$id_usuario");
                        exit();
                    } else {
                        $error_message = 'El usuario se encuentra inactivo';
                    }
                    
                case 3:
                    $consulta_estudiante = "SELECT * FROM usuario_normal WHERE id_usuario='$id_usuario' AND (estado='Activo' OR estado='Finalizo')";
                    $ejecutar_estudiante = mysqli_query($enlace, $consulta_estudiante);
                    $row_estudiante = mysqli_fetch_array($ejecutar_estudiante);
                    if ($row_estudiante) {
                        $estado = $row_estudiante['estado'];
                        if ($estado === 'Activo') {
                            header("Location: inicio_estudiante.php?id_usuario=$id_usuario");
                            exit();
                        } elseif ($estado === 'Finalizo') {
                            header("Location: inicio_estudiante_finalizado.php?id_usuario=$id_usuario");
                            exit();
                        }
                    } else {
                        $error_message = 'El usuario se encuentra inactivo';
                    }
   
            default:
                break;
            }
        } else {
            $error_message = 'Error de autenticación';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        
        <!-- Icons -->
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        
        <!--Para el footer-->
        <link rel="stylesheet" href="css/footer.css">
        <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
        
        <!--Para los estilos-->
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/estilo.css">
        
        <title>CertificaSure</title>
    </head>
    <body>

        <!-- Barra de navegacion-->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #000DD3;">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/Logo.png" alt="Logo" width="50" height="50"> 
                <a class="navbar-brand" style="color: #ffffff">Certifica<strong>Sure</a></strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="crear_cuenta.php" style="color: #ffffff">Crear cuenta <i class="bi bi-person-plus-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: #ffffff">Volver <i class="bi bi-box-arrow-right"></i></a>
                </li>
                </ul>
            </div>
            </div>
        </nav>

    <!-- medio -->
    </div>
    <div class="contenedorCuadro col-sm-12 col-lg-3">
        <p style="text-align: center;">
            <img src="img/Logo.png" alt="" width="150" height="150" class="rounded img-fluid d-inline-block align-text-top">
        </p>
        <div class="contenedorFormulario">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" name="Formulario">
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" required placeholder="Correo electrónico o usuario">
            </div>
            <div class="mb-3">
                <input type="password" name="pass" id="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <br>
            <center><button type="submit" class="btn btn-primary">Iniciar Sesión</button></center>
        </form>
        </div>
        <div class="contenedorReferencias">
            <p style="font-size: small;">
                <a href="crear_cuenta.php" style="text-align: left;">Crear Cuenta </a>
                <a href="#" style="margin-left: 11%;">¿Olvidaste tu contraseña? </a>
            </p>
        </div>
    </div>
    <br><br>

    <!-- final -->
    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Somo una empresa dedicada a brindar soluciones tecnologicas para facilitar el trabajo de las personas.</p>
            </div>
            <div class="box">
                <h2>CONTACTENOS</h2>
                <p>Pereira, carrera 42 # 5 sur 47, piso 16</p>
                <p>Telefono: 2093971</p>
                <p>Celular: +57 3124567899</p>
                <p>Código postal 050022</p>
                <p>info@certificasure.com.co</p>
            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="https://www.facebook.com/Certificasure-158318101032576" class="fa fa-facebook"></a>
                    <a href="https://www.instagram.com/certificasure/" class="fa fa-instagram"></a>
                    <a href="https://twitter.com/CertificaSure" class="fa fa-twitter"></a>
                    <a href="https://www.youtube.com/channel/UC2bqtuQZUgZxoWBc0Wjk_XQ" class="fa fa-youtube"></a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2023 <b>CertificaSure</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</html>