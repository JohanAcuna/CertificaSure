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

    <!-- Para el footer -->
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>

    <!-- Para los estilos -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/venta.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/estilo2.css" rel="stylesheet">
    <script src="js/tools.js"></script>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="fonts/fonts.css" rel="stylesheet">

    <title>CertificaSure</title>
</head>
<body id="page-top">
    <?php
        $consulta = "SELECT * FROM usuario INNER JOIN rol ON usuario.id_rol = rol.id_rol WHERE rol.id_rol = '1'";
        $resultado = mysqli_query($enlace, $consulta);
        $fila = mysqli_fetch_array($resultado);
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
                            <!-- Modal Salir -->
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
                                            <a href="salir.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Si</button></a>
                                            <a href="inicio_administrador.php"><button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </nav>
                <b><center><font face="Times New Roman" size="8" color="Black">Mira nuestros Planes</font></center>
                <br><br><br>
                
        <!-- mitad -->
        <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="plan-card">
                    <h3 class="plan-name">Plan FREMIUM</h3>
                    <ul class="plan-features">
                        <li>Con publicidad</li>
                        <li>Solo 100 estudiantes</li>
                        <li>Soporte básico</li>
                    </ul>
                    <div class="plan-price">$0</div>
                    <a href="#" class="btn">Plan Actual</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="plan-card selected">
                    <h3 class="plan-name">Plan BÁSICO</h3>
                    <ul class="plan-features">
                        <li>Sin publicidad</li>
                        <li>Mayor velocidad</li>
                        <li>Hasta 200 usuarios</li>
                    </ul>
                    <div class="plan-price">$5 US</div>
                    <a href="#" class="btn">Comprar</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="plan-card">
                    <h3 class="plan-name">Plan GOLDEN</h3>
                    <ul class="plan-features">
                        <li>Sin publicidad</li>
                        <li>Mayor velocidad</li>
                        <li>Hasta 500 usuarios</li>
                    </ul>
                    <div class="plan-price">$10 US</div>
                    <a href="#" class="btn">Comprar</a>
                </div>
            </div>
        </div>
    </div>         
</body>
</html>
