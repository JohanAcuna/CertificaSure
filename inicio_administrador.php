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
        <link rel="stylesheet" href="css/ini.css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link href="css/estilo2.css" rel="stylesheet">
        <script src="js/tools.js"></script>

        <title>CertificaSure</title>
    </head>
    <body id="page-top">
        <?php
            $consulta = "SELECT * FROM usuario INNER JOIN rol ON usuario.id_rol = rol.id_rol WHERE rol.id_rol = '1'";
            $resultado = mysqli_query($enlace, $consulta);
            $fila = mysqli_fetch_array($resultado)
        ?>
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
                <!-- Sidebar - imagen -->
                <center><a class="navbar-brand" href="inicio_administrador.php"><img src="img/Logo.png" alt="" width="60" height="0" class="rounded img-fluid d-inline-block align-text-top"></a></center>
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
                                    <div class="modal-dialog modal-dialog-centered" >
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="exampleModalLabel" style="color: #FFFFFF; text-align: center;">Advertencia!!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        <div class="modal-body">
                                            <center><h4 style="color: #000000;">¿Está seguro de salir?</h4></center>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="salir.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Si</button></a>
                                            <a href="inicio_administrador.php"><button type="button" class="btn btn-success" data-bs-dismiss="modal" >No</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </nav>
                    <!-- medio -->
                    <?php
                        $consulta = "SELECT COUNT(id_monitor) AS cantidad_monitor FROM usuario_monitor WHERE estado = 'Activo'";
                        $resultado = mysqli_query($enlace, $consulta);
                        $fila = mysqli_fetch_array($resultado)
                    ?>
                    <?php
                        $consulta2 = "SELECT COUNT(id_estudiante) AS cantidad_estudiante FROM usuario_normal WHERE estado = 'Activo'";
                        $resultado2 = mysqli_query($enlace, $consulta2);
                        $fila2 = mysqli_fetch_array($resultado2)
                    ?>
                    <?php
                        $consulta3 = "SELECT COUNT(id_monitor) AS cantidad_estudiante FROM usuario_normal WHERE estado = 'Finalizo'";
                        $resultado3 = mysqli_query($enlace, $consulta3);
                        $fila3 = mysqli_fetch_array($resultado3)
                    ?>
                    <br><br>
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de grupos Activos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $fila['cantidad_monitor']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-university fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Monitores Activos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $fila['cantidad_monitor']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="bi bi-person-workspace fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Estudiantes o empleados Activos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $fila2['cantidad_estudiante']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de personas que han completado el proceso</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $fila3['cantidad_estudiante']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-graduation-cap fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr><!-- medio Abajo -->
                    <center>
                        <h1 class="h1 mb-4 text-gray-800">Datos de Interes</h1>
                    </center>
                    <br>
                    <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-primary-gradient">
                                <img src="img/tiempo.png" alt="Imagen 1">
                                <div class="card-body">
                                    <h5 class="card-title">¿Necesitas ahorrar tiempo al momento de registrar datos?</h5>
                                    <p class="card-text">CertificaSure te ayuda a generar certificados automáticos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-secondary-gradient">
                                <img src="img/mente.png" alt="Imagen 2">
                                <div class="card-body">
                                    <h5 class="card-title">¿Quieres reducir el estrés por un mal manejo de datos?</h5>
                                    <p class="card-text">CertificaSure mantiene todo en la nube para un fácil acceso y gestión.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-info-gradient">
                                <img src="img/diploma.png" alt="Imagen 4">
                                <div class="card-body">
                                    <h5 class="card-title">¿Deseas destacarte con certificados profesionales?</h5>
                                    <p class="card-text">CertificaSure te brinda diseños modernos y personalizables para tus certificados.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </body>
</html>