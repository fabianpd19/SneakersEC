<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakersEC</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="img/favicon/image.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>

<body>

    <!-- NAVBAR -->
    <!-- <div id="navbar"></div> -->
    <?php include 'navbar.php'; ?>

    <div id="weather" class="hidden toggle-weather">
        <h5>Clima local</h5>
        <div id="weather-data">Obteniendo datos del clima...</div>
    </div>

    <div id="shoeCarousel" class="carousel slide fade-in" data-ride="carousel">
        <div class="carousel-inner">

            <!-- Slider 1 -->
            <div class="carousel-item active">
                <div id="principal-index" class="container py-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 text-start">
                            <h2 class="font-weight-bold text-start">NIKE DUNK LOW 'AE86' TOYOTA</h2>
                            <p class="text-start" style="font-size: 27px;">
                                The Dunk Low concept features black and white leather uppers with a purple panel on the
                                heel and an orange tag on the end of the Swoosh resembling the car's blinkers.
                            </p>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <img src="img/nike-airfoce.png" alt="Nike Air Force" width="400"
                                class="auspiciante img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider 2 -->
            <div class="carousel-item">
                <div id="principal-index" class="container py-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 text-start">
                            <h2 class="font-weight-bold text-start">ADIDAS YEEZY BOOST 350 V2</h2>
                            <p class="text-start" style="font-size: 27px;">
                                The Yeezy Boost 350 V2 features a primeknit upper and distinct center stitching,
                                complete with Boost cushioning and a translucent side stripe.
                            </p>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <img src="img/adidas-yeezy.png" alt="Adidas Yeezy" width="350"
                                class="auspiciante img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider 3 -->
            <div class="carousel-item">
                <div id="principal-index" class="container py-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 text-start">
                            <h2 class="font-weight-bold text-start">PUMA RS-X REINVENTION</h2>
                            <p class="text-start" style="font-size: 27px;">
                                The RS-X Reinvention is all about retro featuring a chunky silhouette and a mix of
                                mesh
                                and suede for a bold, nostalgic look.
                                <br>
                                <br>
                            </p>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <img src="img/puma-rsx.png" alt="Puma RS-X" width="250" class="auspiciante img-fluid">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Controles del carousel -->
        <a class="carousel-control-prev" href="#shoeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#shoeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div id="simple-carousel" class="container py-3 fade-in">
        <div class="row align-items-center">
            <div class="col-6 col-sm-4 text-center">
                <img src="img/sneakers-in-carousel/image.png" class="rounded-circle border img-fluid" alt="Cinque Terre"
                    height="200px">

                <hr>
            </div>
            <div class="col-6 col-sm-4 text-center">
                <img src="img/sneakers-in-carousel/image copy.png" class="rounded-circle border img-fluid"
                    alt="Cinque Terre" height="200px">

                <hr>
            </div>
            <div class="col-6 col-sm-4 text-center">
                <img src="img/sneakers-in-carousel/image.png" class="rounded-circle border img-fluid" alt="Cinque Terre"
                    height="200px">

                <hr>
            </div>

        </div>
    </div>

    <div class="container py-2 fade-in">
        <div class="row py-3">
            <div class="col-12 col-sm-12">
                <h1 class="font-weight-bold text-center display-3">NEW THIS WEEK</h1>
                <div class="text-center">
                    <a href="tienda.php" type="button" class="custom-btn btn btn-dark">Shop
                        New Arrivals</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-lg-6 text-right">
                <img src="img/index-images/image.png" data-mdb-img="https://mdbcdn.b-cdn.net/img/Photos/Vertical/1.webp"
                    alt="Dark Roast Iced Coffee" class="w-75 shadow-1-strong rounded-lg animacion_hover img-fluid" />
            </div>

            <div class="col-6 col-lg-6 text-left">
                <img src="https://ca-times.brightspotcdn.com/dims4/default/15a30ea/2147483647/strip/true/crop/6122x4081+0+1/resize/1440x960!/quality/75/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2Fb3%2F10%2F10c245034893adf233fc1cf3071a%2F1351750-fi-sneaker-buyer-coolkicks-jlc-16185-021.jpg"
                    data-mdb-img="https://mdbcdn.b-cdn.net/img/Photos/Slides/1.webp" alt="Table Full of Spices"
                    class="w-75 mb-2 mb-md-4 shadow-1-strong rounded animacion_hover img-fluid" />
                <img src="https://admin.digitalsport.com.ar/files/uploads/DIO%20AGOSTO%2021/Jordan%201%20Retro%20AJKO%20Chicago%20.jpg"
                    data-mdb-img="https://mdbcdn.b-cdn.net/img/Photos/Square/1.webp" alt="Coconut with Strawberries"
                    class="w-75 shadow-1-strong rounded animacion_hover img-fluid" />
            </div>
        </div>

    </div>

    <div id="acordeon" class="container py-4">
        <div class="row py-3">
            <div class="col col-sm-12">
                <h2 class="font-weight-bold text-center display-3">Más información</h2>
            </div>
        </div>
        <button class="accordion">Preguntas frecuentes</button>
        <div class="panel">
            <div>
                <h5>¿Cuál es el tiempo de envío?</h5>
                <p>El tiempo de envío varía entre 3 a 7 días hábiles dependiendo de tu ubicación.</p>
            </div>
            <div>
                <h5>¿Puedo devolver un producto?</h5>
                <p>Sí, ofrecemos devoluciones dentro de los 30 días posteriores a la compra. Asegúrate de que el
                    producto esté en su estado original.</p>
            </div>
            <div>
                <h5>¿Ofrecen garantía en los productos?</h5>
                <p>Todos nuestros productos vienen con una garantía de 1 año contra defectos de fabricación.</p>
            </div>

        </div>

        <button class="accordion">Ofertas y descuentos</button>
        <div class="panel">
            <p>Actualmente tenemos las siguientes ofertas:</p>
            <ul>
                <li><strong>Descuento del 10%:</strong> Usa el código <strong>SUMMER10</strong> al finalizar la compra.
                </li>
                <li><strong>Envío gratuito:</strong> En pedidos superiores a $100.</li>
            </ul>
            <p>Para más información sobre nuestras promociones, consulta nuestra sección de ofertas en la tienda.</p>
        </div>

        <button class="accordion">Compromiso y sostenibilidad</button>
        <div class="panel">
            <h4>Compromiso con la Sostenibilidad</h4>
            <p>En nuestra tienda, estamos dedicados a reducir nuestro impacto ambiental y promover prácticas
                sostenibles. Aquí te contamos cómo lo estamos logrando:</p>
            <ul>
                <li><strong>Productos Ecológicos:</strong> Ofrecemos una selección de calzado fabricado con materiales
                    reciclados y sostenibles.</li>
                <li><strong>Empaque Sostenible:</strong> Utilizamos empaques reciclables y minimizamos el uso de
                    plásticos.</li>
                <li><strong>Donaciones y Reciclaje:</strong> Trabajamos con organizaciones para donar calzado usado y
                    reciclamos productos fuera de uso.</li>
            </ul>
            <p>Queremos que cada compra que realices no solo te beneficie a ti, sino también al planeta. Gracias por
                apoyar nuestras iniciativas de sostenibilidad.</p>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <script src="js/navbar-es.js"></script>
    <script src="https://kit.fontawesome.com/91728c998d.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/acordeon.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>