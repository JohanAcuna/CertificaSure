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

        <!-- para el pdf -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

        <!--Para los estilos-->
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/estilo.css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link href="css/estilo2.css" rel="stylesheet">
        <script src="js/tools.js"></script>

        <style>
            .custom-card {
                border-radius: 10px;
                background-color: #ffffff;
                padding: 20px;
                margin-bottom: 20px;
            }
        </style>
        
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
                <a class="nav-link" href="inicio_estudiante_finalizado.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
                    <i class="bi bi-person-bounding-box"></i>
                    <span>Mis Datos </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reporte_estudiante_finalizado.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
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
                                            <a href="inicio_estudiante.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
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
                <?php
                $consulta2 = "SELECT usuario_normal.id_estudiante, usuario_normal.nombre, usuario_normal.apellido, usuario_normal.documento, usuario_normal.estado,
                            usuario_normal.celular, usuario.email, usuario_monitor.duracion_proceso, usuario_monitor.grupo, SUM(reporte.horas) AS total_horas
                            FROM usuario_normal
                            LEFT JOIN usuario ON usuario.id_usuario = usuario_normal.id_usuario
                            LEFT JOIN usuario_monitor ON usuario_monitor.id_monitor = usuario_normal.id_monitor
                            LEFT JOIN reporte ON reporte.id_estudiante = usuario_normal.id_estudiante
                            WHERE usuario.id_usuario = '$id_usuario'";
                $resultado2 = mysqli_query($enlace, $consulta2);

                $fila2 = mysqli_fetch_array($resultado2);

                ?>

                <center>
                    <h1 class="h1 mb-4 text-gray-800">Estos son tus datos</h1>
                </center>
                <!-- Mitad -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <p><strong>Nombre:</strong> <?php echo $fila2['nombre']; ?> <?php echo $fila2['apellido']; ?></p>
                                    <p><strong>Documento:</strong> <?php echo $fila2['documento']; ?></p>
                                    <p><strong>Celular:</strong> <?php echo $fila2['celular']; ?></p>
                                    <p><strong>Email:</strong> <?php echo $fila2['email']; ?></p>
                                    <p><strong>Estado Actual:</strong> <?php echo $fila2['estado']; ?></p>
                                    <p><strong>Horas Actuales:</strong> <?php echo $fila2['total_horas']; ?></p>
                                    <!-- Mensaje -->
                                    <div class="alert alert-success rounded-10 rounded" role="alert">
                                        Felicidades!!! Ha culminado su proceso correctamente. Ya puedes descargar tu certificado aqui abajo.
                                    </div>
                                    <!-- button -->
                                    <center>
                                        <button type="button" class="btn btn-primary" style="border-radius: 5px;" onclick="generatePDF('<?php echo $fila2['id_estudiante']; ?>', 
                                            '<?php echo $fila2['nombre']; ?>', '<?php echo $fila2['apellido']; ?>', 
                                            '<?php echo $fila2['grupo']; ?>', '<?php echo $fila2['duracion_proceso']; ?>', 
                                            '<?php echo $fila2['documento']; ?>')">Descargar Certificado
                                        </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to generate and download the PDF
        function generatePDF(id_estudiante, nombre, apellido, grupo, duracion_proceso, documento) {
            const doc = new jsPDF();

            // Cargar el logo
            var logoImg = new Image();
            logoImg.src = 'img/Certificasure.png';

            // Cargar la imagen "approved.png"
            var approvedImg = new Image();
            approvedImg.src = 'img/approved.png';

            var imagesLoaded = 0;

            // Función para comprobar si todas las imágenes están cargadas
            function checkAllImagesLoaded() {
                imagesLoaded++;
                if (imagesLoaded === 2) {
                    // Ambas imágenes cargadas, generar el PDF
                    generatePDFContent();
                }
            }

            logoImg.onload = checkAllImagesLoaded;
            approvedImg.onload = checkAllImagesLoaded;

            // Generar el contenido del PDF
            function generatePDFContent() {
                // Configuración de estilo
                doc.setFillColor(235, 232, 225); // Color de fondo
                doc.setFont('Helvetica', 'bold');
                doc.setFontSize(30);

                // Agregar contorno decorativo alrededor de la página
                doc.setDrawColor(173, 216, 230); // Color del contorno
                doc.setLineWidth(2); // Grosor del contorno
                doc.roundedRect(20, 20, doc.internal.pageSize.width - 40, doc.internal.pageSize.height - 40, 10, 10, 'S');

                // Agregar fondo y título
                doc.rect(30, 30, doc.internal.pageSize.width - 60, 40, 'F');
                doc.setTextColor(0, 0, 0); // Color de texto
                doc.text('Felicidades', doc.internal.pageSize.width / 2, 55, { align: 'center' });

                // Agregar logo
                doc.addImage(logoImg, 'PNG', 30, 30, 40, 40); // Cambiar la posición del logo

                // Configuración de estilo para el contenido
                doc.setFont('Helvetica', 'normal');
                doc.setFontSize(14);
                doc.setTextColor(0, 0, 0); // Color de texto

                // Agregar contenido
                doc.setFontSize(12);
                doc.text('Se certifica que ' + nombre + ' ' + apellido + ' del grupo ' + grupo, 54, 100);
                doc.text('he identificado con el documento No. ' + documento, 60, 110);
                doc.text('que ha culminado con éxito su proceso con una duración de ' + duracion_proceso + ' horas.', 45, 120);

                // Agregar mensaje de acreditación
                var fecha = new Date();
                var dia = fecha.getDate();
                var mes = fecha.toLocaleString('default', { month: 'long' });
                var anio = fecha.getFullYear();
                var mensaje = 'Siendo el día ' + dia + ' del mes de ' + mes + ' del año ' + anio + ' se acredita el documento.';
                doc.text(mensaje, 40, 170);

                // Calcular la longitud de las líneas horizontales con incremento de 20 unidades
                var lineLength = doc.internal.pageSize.width / 4 - 10;

                // Agregar líneas horizontales
                doc.setLineWidth(0.5);
                doc.line(50, 200, 50 + lineLength, 200); // Línea horizontal arriba de "Firma Monitor"
                doc.line(doc.internal.pageSize.width - lineLength - 50, 200, doc.internal.pageSize.width - 50, 200); // Línea horizontal arriba de "Firma Director"

                // Agregar textos de las firmas
                doc.setFont('Helvetica', 'bold');
                doc.text('Firma Director', doc.internal.pageSize.width - lineLength - 50, 210); // Ajustar la posición del texto "Firma Director"
                doc.text('Firma Monitor', 50, 210); // Ajustar la posición del texto "Firma Monitor"

                // Agregar la imagen "approved.png"
                doc.addImage(approvedImg, 'PNG', doc.internal.pageSize.width - 50, doc.internal.pageSize.height - 50, 20, 20); // Colocar la imagen debajo a la derecha

                // Descargar el PDF
                doc.save('certificado.pdf');
            }
        }
    </script>
</body>

</html>