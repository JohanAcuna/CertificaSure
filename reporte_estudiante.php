<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['id_rol'])){
        header("Location: inicio_sesion.php");
    }else{
        if ($_SESSION['id_rol'] != 3){
            header("Location: inicio_estudiante.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
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
            $consulta = "SELECT usuario.id_usuario, usuario_normal.id_estudiante FROM usuario_normal
                        INNER JOIN usuario ON usuario_normal.id_usuario = usuario.id_usuario
                        INNER JOIN rol ON usuario.id_rol = rol.id_rol 
                        WHERE usuario.id_usuario = '$id_usuario' AND rol.id_rol = '3'";
            $resultado = mysqli_query($enlace, $consulta);

            $fila = mysqli_fetch_array($resultado)
        ?>
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
                <!-- Sidebar - imagen -->
                <center>
                    <a class="navbar-brand" href="inicio_estudiante.php">
                        <img src="img/Logo.png" alt="" width="60" height="0" class="rounded img-fluid d-inline-block align-text-top">
                    </a>
                </center>
                <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['id_usuario']; ?>">
                        <i class="bi bi-gear-fill"></i>
                        <span>Editar Contraseña</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inicio_estudiante.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                        <i class="bi bi-person-bounding-box"></i>
                        <span>Mis Datos </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reporte_estudiante.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                        <i class="bi bi-person-rolodex"></i>
                        <span>Mis reportes </span>
                    </a>
                </li>
            </ul>
            <!-- Modal Editar -->
            <div class="modal fade" id="modalEditar<?php echo $fila['id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: #FFFFFF; text-align: center;">Edita tu contraseña de ingreso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label" style="color: #000000;">Ingresa la nueva contraseña:</label><br>
                                    <input type="password" name="pass" placeholder="Ingresa una Contraseña" id="pass" class="form-control" maxlength="30" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                                <a href="inicio_estudiante.php">
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
                    <br>
                <center>
                <h1 class="h1 mb-4 text-gray-800">Listado de tus Reportes</h1>
                </center>
                <!-- DataTable -->
                <div class="container-fluid">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Grupo</center>
                                        </th>
                                        <th>
                                            <center>Monitor que realizo el reporte</center>
                                        </th>
                                        <th>
                                            <center>Cantidad de horas informadas</center>
                                        </th>
                                        <th>
                                            <center>Fecha del Informe</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta2 = "SELECT usuario_normal.id_usuario, usuario_normal.id_estudiante, usuario_monitor.nombre, 
                                                    usuario_monitor.apellido, usuario_monitor.grupo, reporte.horas, reporte.fecha FROM usuario_normal
                                                    LEFT JOIN usuario ON usuario.id_usuario = usuario_normal.id_usuario
                                                    LEFT JOIN usuario_monitor ON usuario_monitor.id_monitor = usuario_normal.id_monitor
                                                    LEFT JOIN reporte ON reporte.id_estudiante = usuario_normal.id_estudiante
                                                    WHERE  usuario_normal.id_estudiante = '" . $fila['id_estudiante'] . "' GROUP BY reporte.id_reporte";

                                    $resultado2 = mysqli_query($enlace, $consulta2);

                                    while ($fila2 = mysqli_fetch_array($resultado2)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $fila2['grupo']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fila2['nombre']; ?> <?php echo $fila2['apellido']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fila2['horas']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fila2['fecha']; ?></center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>            

                </div>
            </div>
        </div>
    </body>
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
</html>