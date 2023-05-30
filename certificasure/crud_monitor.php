<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['id_rol'])){
        header("Location: inicio_sesion.php");
    }else{
        if ($_SESSION['id_rol'] != 1){
            header("Location: inicio_administrador.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    if (isset($_POST['submit_crear'])) {

        // Obtener los valores del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $grupo = $_POST['grupo'];
        $duracion_proceso = $_POST['duracion_proceso'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Validar si el correo electrónico o el nombre de la organización ya están registrados
        $validacion = "SELECT usuario.email, usuario_monitor.grupo
                    FROM usuario INNER JOIN usuario_monitor ON usuario.id_usuario = usuario_monitor.id_usuario
                    WHERE usuario.email = '$email' OR usuario_monitor.grupo = '$grupo'";
        $resultado = mysqli_query($enlace, $validacion);

        if (mysqli_num_rows($resultado) == 1) {
            $error_message = "El correo electrónico o el grupo ya se encuentran registrados.";
        } else {
            // Insertar el nuevo usuario en la tabla 'usuario'
            $consulta = "INSERT INTO usuario (id_rol, email, pass) VALUES (2, '$email', '$pass')";
            $resultUsuario = mysqli_query($enlace, $consulta);

            if ($resultUsuario) {
                // Obtener el ID de usuario recién insertado
                $idUsuario = mysqli_insert_id($enlace);

                // Insertar el registro en la tabla 'usuario_admin'
                $consulta2 = "INSERT INTO usuario_monitor (id_usuario, id_admin, nombre, apellido, grupo, duracion_proceso, estado)
                            VALUES ($idUsuario, '$id_admin', '$nombre', '$apellido', '$grupo', '$duracion_proceso' , 'Activo')";
                $resultMonitor = mysqli_query($enlace, $consulta2);

                if ($resultMonitor) {
                    // Redireccionar a la página de inicio
                    header("Location: crud_monitor.php?id_usuario=$id_usuario");
                    exit;
                } 
            } 
        }
    }

    if (isset($_POST['submit_inactivar'])) {
        $consulta = "UPDATE usuario_monitor SET estado = 'Inactivo' WHERE id_monitor = '$id_monitor'";
        mysqli_query($enlace, $consulta);
        mysqli_close($enlace);
        header("Location: crud_monitor.php?id_usuario=$id_usuario");
    }

?>

<!DOCTYPE html>

<html lang="es">
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

       <!-- DataTables CSS -->
        <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!--Para los estilos-->
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/estilo.css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link href="css/estilo2.css" rel="stylesheet">
        <script src="js/tools.js"></script>
        
        <title>CertificaSure</title>
    </head>
    <body id="page-top">
        <?php
            $consulta = "SELECT * FROM usuario 
                        INNER JOIN usuario_admin ON usuario_admin.id_usuario = usuario.id_usuario
                        INNER JOIN rol ON usuario.id_rol = rol.id_rol WHERE rol.id_rol = '1'";
            $resultado = mysqli_query($enlace, $consulta);
            $fila = mysqli_fetch_array($resultado)
        ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
            <!-- Sidebar - imagen -->
            <center>
                <a class="navbar-brand" href="inicio_administrador.php">
                    <img src="img/Logo.png" alt="" width="60" height="0" class="rounded img-fluid d-inline-block align-text-top">
                </a>
            </center>
            <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="cambiar_plan.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                    <i class="bi bi-basket-fill"></i>
                    <span>Actualizar Plan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="crud_monitor.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                <i class="bi bi-people-fill"></i>
                    <span>Grupos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="monitores_inactivos.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                
                <i class="bi bi-person-badge"></i>
                <span>Monitores Inactivos</span></a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <div class="navbar-nav mr-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSalir">Cerrar Sesión <i class="bi bi-box-arrow-right"></i></button>
                            <!-- Modal Salir-->
                            <div class="modal fade" id="modalSalir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: #FFFFFF; text-align: center;">Advertencia!!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <center><h4 style="color: #000000;">¿Está seguro de salir?</h4></center>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="salir.php">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Si</button>
                                            </a>
                                            <a href="inicio_administrador.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </nav>
                <br>
                <!--Mensaje crear-->

                <center>
                    <h1 class="h1 mb-4 text-gray-800">Administración de Monitores y Grupos</h1>
                </center>
                <!-- DataTable -->
                <div class="container-fluid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="text-center">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearMonitor<?php echo $fila['id_usuario']; ?>">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                    <!-- Modal Crear -->
                                    <div class="modal fade" id="modalCrearMonitor<?php echo $fila['id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: #FFFFFF; text-align: center;">Ingresa los datos del Monitor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" id="id_admin" name="id_admin" value="<?php echo $fila['id_admin']; ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Ingrese el Nombre del del encargado:</label>
                                                            <input type="text" id="nombre" class="form-control" name="nombre" class="form-control" placeholder="Ingresa el Nombre" required pattern="[A-Za-z-Zñóéí ]+" minlength="3" maxlength="30">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Ingrese los Apellidos el encargado:</label>
                                                            <input type="text" id="apellido" class="form-control" name="apellido" class="form-control" placeholder="Ingresa los apellidos" required pattern="[A-Za-z-Zñóéí ]+" minlength="3" maxlength="30">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Ingrese el Nombre del grupo que estara a cargo:</label>
                                                            <input type="text" id="grupo" class="form-control" name="grupo" class="form-control" placeholder="Ingresa nombre del grupo" required pattern="[A-Za-z-Zñóéí ]+" minlength="3" maxlength="30">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Cuanto durara el proceso:</label>
                                                            <input type="number" id="duracion_proceso" class="form-control" name="duracion_proceso" class="form-control" placeholder="Ingresa el tiempo que durara el proceso" pattern="[0-9]+" minlength="1" maxlength="3" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Ingrese el Correo electrónico:</label>
                                                            <input type="email" id="email" class="form-control" name="email" class="form-control" placeholder="Ingresa el Correo electrónico a registrar" minlength="10" maxlength="30" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Ingrese una Contraseña base:</label><br>
                                                            <input type="password" name="pass" placeholder="Ingresa una Contraseña" id="pass" class="form-control" maxlength="30" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="table-responsive">
                            <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Grupo</center>
                                        </th>
                                        <th>
                                            <center>Nombre del encargado</center>
                                        </th>
                                        <th>
                                            <center>Duracion del Proceso</center>
                                        </th>
                                        <th>
                                            <center>Cantidad de Personas a Cargo</center>
                                        </th>
                                        <th>
                                            <center>Opciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta2 = "SELECT usuario_admin.id_admin, usuario_monitor.id_monitor, usuario_monitor.nombre, usuario_monitor.apellido, 
                                    usuario_monitor.grupo, usuario_monitor.duracion_proceso, usuario_monitor.estado 
                                    FROM usuario_monitor 
                                    LEFT JOIN usuario ON usuario.id_usuario = usuario_monitor.id_usuario 
                                    LEFT JOIN usuario_admin ON usuario_admin.id_admin = usuario_monitor.id_admin 
                                    WHERE usuario_monitor.estado = 'Activo' AND usuario_admin.id_admin = '" . $fila['id_admin'] . "' GROUP BY usuario_monitor.id_monitor";
                      
                                    $resultado2 = mysqli_query($enlace, $consulta2);
                                    
                                    while ($fila2 = mysqli_fetch_array($resultado2)) {
                                        // Obtener el id_monitor actual
                                        $id_monitor = $fila2['id_monitor'];

                                        // Consultar la cantidad de estudiantes para el id_monitor actual
                                        $consulta3 = "SELECT COUNT(id_estudiante) AS cantidad_usuarios 
                                        FROM usuario_normal WHERE id_monitor = $id_monitor";

                                        $resultado3 = mysqli_query($enlace, $consulta3);

                                        $fila3 = mysqli_fetch_array($resultado3);
                                        ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $fila2['grupo']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fila2['nombre']; ?> <?php echo $fila2['apellido']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fila2['duracion_proceso']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fila3['cantidad_usuarios']; ?></center>
                                            </td>
                                            <td>
                                                <center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila2['id_monitor']; ?>"><i class="bi bi-trash-fill"></i></button></center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal Eliminar -->
                        <?php
                        $resultado2 = mysqli_query($enlace, $consulta2);

                        while ($fila2 = mysqli_fetch_array($resultado2)) {
                            
                            ?>
                            <div class="modal fade" id="modalEliminar<?php echo $fila2['id_monitor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: #FFFFFF; text-align: center;">¿Realmente desea Inactivar a <?php echo $fila2['nombre']; ?> <?php echo $fila2['apellido']; ?>?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_monitor" value="<?php echo $fila2['id_monitor']; ?>">
                                                <strong>
                                                    <h5 style="color: #000000;">
                                                        <center>Si continua el usuario perderá las credenciales de acceso a la aplicación.</center>
                                                    </h5>
                                                </strong>
                                                <div class="modal-footer">
                                                    <center><button type="submit" name="submit_inactivar" class="btn btn-danger">Inactivar Monitor</button></center>
                                                </div>
                                            </form>
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
        </div>
    </div>
    <!-- JavaScript de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Configuración de DataTable -->
    <script>
        $(document).ready(function() {
            $('#mytabla').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                }
            });
        });
    </script>
</body>

</html>