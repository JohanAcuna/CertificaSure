<?php
    include('conexion.php');

    // Verificar si se envió el formulario
    if (isset($_POST['submit'])) {
        // Obtener los valores del formulario
        $nombre_organizacion = $_POST['nombre_organizacion'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Validar si el correo electrónico o el nombre de la organización ya están registrados
        $validacion = "SELECT usuario.email, usuario_admin.nombre_organizacion
                    FROM usuario INNER JOIN usuario_admin ON usuario.id_usuario = usuario_admin.id_usuario
                    WHERE usuario.email = '$email' OR usuario_admin.nombre_organizacion = '$nombre_organizacion'";
        $resultado = mysqli_query($enlace, $validacion);

        if (mysqli_num_rows($resultado) == 1) {
            $error_message = "El correo electrónico o el nombre de la organización ya están registrados.";
        } else {
            // Insertar el nuevo usuario en la tabla 'usuario'
            $consulta = "INSERT INTO usuario (id_rol, email, pass) VALUES (1, '$email', '$pass')";
            $resultUsuario = mysqli_query($enlace, $consulta);

            if ($resultUsuario) {
                // Obtener el ID de usuario recién insertado
                $idUsuario = mysqli_insert_id($enlace);

                // Insertar el registro en la tabla 'usuario_admin'
                $consulta2 = "INSERT INTO usuario_admin (id_usuario, id_contrato, nombre_organizacion) VALUES ($idUsuario, 1, '$nombre_organizacion')";
                $resultAdmin = mysqli_query($enlace, $consulta2);

                if ($resultAdmin) {
                    // Redireccionar a la página de inicio
                    header("Location: index.php");
                    exit;
                } 
            } 
        }
    }
    mysqli_close($enlace);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

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
    <!-- Barra de navegacion -->
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
                        <a class="nav-link" href="inicio_sesion.php" style="color: #ffffff">Iniciar Sesion <i class="bi bi-person-circle"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: #ffffff">Volver <i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Formulario -->
    <div class="contenedorCuadro col-sm-12 col-lg-4">
        <p style="text-align: center;">
            <img src="img/Logo.png" alt="" width="150" height="150" class="rounded img-fluid d-inline-block align-text-top">
        </p>
        <div class="contenedorFormulario">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" name="Formulario">
                <div class="mb-3">
                    <label for="nombre_organizacion" class="form-label fw-bold">Ingresa nombre de la institución educativa o empresa</label>
                    <input type="text" id="nombre_organizacion" class="form-control" name="nombre_organizacion" placeholder="Nombre de la institución educativa o empresa" required pattern="[A-Za-z-Zñóéí ]+" minlength="3" maxlength="30">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Ingresa correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Correo electrónico o usuario">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Ingresa contraseña</label>
                    <input type="password" name="pass" id="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Crear Cuenta</button>
                </div>
            </form>
        </div>
    </div>
    <br><br>

    <!-- Pie de página -->
    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Somos una empresa dedicada a brindar soluciones tecnológicas para facilitar el trabajo de las personas.</p>
            </div>
            <div class="box">
                <h2>CONTÁCTENOS</h2>
                <p>Pereira, carrera 42 # 5 sur 47, piso 16</p>
                <p>Teléfono: 2093971</p>
                <p>Celular: +57 3124567899</p>
                <p>Código postal 050022</p>
                <p>info@certificasure.com.co</p>
            </div>
            <div class="box">
                <h2>SÍGUENOS</h2>
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
</body>
</html>

