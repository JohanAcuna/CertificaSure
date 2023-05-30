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
    
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            margin-bottom: 20px;
        }

        .rating {
            color: #ffd700;
            margin-top: 10px;
        }

        .rating i {
            font-size: 18px;
            margin-right: 3px;
        }


        .grupo-1 {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .box {
            flex-basis: 30%;
            max-width: 300px;
            margin-bottom: 30px;
        }

        .box h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .box p {
            margin-bottom: 10px;
        }

        .red-social a {
            color: #ffffff;
            font-size: 24px;
            margin-right: 10px;
        }

        .red-social a:hover {
            color: #ffd700;
        }

        .grupo-2 {
            text-align: center;
            margin-top: 30px;
        }
    </style>

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
                        <a class="nav-link" href="index.php" style="color: #ffffff">Inicio<i class="bi bi-arrow-bar-right"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calificaciones.php" style="color: #ffffff">Calificaciones <i class="bi bi-star-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="crear_cuenta.php" style="color: #ffffff">Crear cuenta <i class="bi bi-person-plus-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inicio_sesion.php" style="color: #ffffff">Iniciar sesión <i class="bi bi-person-circle"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- medio -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <img src="img/persona.jpg" alt="Icono" width="200" height="200" class="me-3">
                        <div>
                            <h5 class="card-title">Esta es una gran aplicación</h5>
                            <p class="card-text">Me ayudó a reducir trabajo y estrés. Además, ayudó a mis estudiantes a certificarse.</p>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <img src="img/grado.jpg" alt="Icono" width="150" height="150" class="me-3">
                        <div>
                            <h5 class="card-title">Evitó errores en la certificación de empleados</h5>
                            <p class="card-text">Esta aplicación nos permitió evitar errores en la certificación de empleados y mejorar nuestra eficiencia.</p>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <img src="img/grado2.jpg" alt="Icono" width="185" height="185" class="me-3">
                        <div>
                            <h5 class="card-title">Redució el estrés y facilitó el trabajo</h5>
                            <p class="card-text">Esta aplicación nos permitió reducir el estrés y facilitar nuestro trabajo diario. ¡Increíble!</p>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <img src="img/calificacion.jpg" alt="Icono" width="200" height="200" class="me-3">
                        <div>
                            <h5 class="card-title">Pruebala y te sorprenderas</h5>
                            <p class="card-text">Es facil de usar, ademas tendras todos los registros en la nube.</p>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <img src="img/calificacion2.jpg" alt="Icono" width="200" height="200" class="me-3">
                        <div>
                            <h5 class="card-title">He visto cambios en el trabajo</h5>
                            <p class="card-text">Encontre una aplicacion que me cuenta las horas de manera automatica.</p>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <img src="img/calificacion.avif" alt="Icono" width="200" height="200" class="me-3">
                        <div>
                            <h5 class="card-title">Han facilitado mi trabajo</h5>
                            <p class="card-text">Al mantener todo registrado dentro de una pagina han evitado que cometa errores.</p>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</body>
</html>
