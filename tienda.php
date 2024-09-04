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

    <div class="container-fluid py-4" id="tienda">
        <!-- <div class="d-flex py-2 align-items-center">
            <div class="form-outline me-3" data-mdb-input-init>
                <input type="search" id="form1" class="form-control" placeholder="Buscar" aria-label="Search" />
            </div>

            <span class="mx-4">Mostrar todos los productos (número)</span>
            <span class="mx-4">Ordenar</span>
        </div> -->

        <div class="row">
            <div class="col-2 col-sm-3 col-md-2 slide-in">
                <div class="container-fluid container">

                    <!-- Categorías -->
                    <form id="categories-form" class="py-1">

                        <div class="d-flex py-2 justify-content-between align-items-center">
                            <h5 class="mb-1 font-weight-bold">Categorías</h5>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>

                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input category-filter-check" type="checkbox" value=""
                                    id="category-check" data-category="Deportivos">
                                <span class="check">Deportivos</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input category-filter-check" type="checkbox" value=""
                                    id="category-check" data-category="Casuales">
                                <span class="check">Casuales</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input category-filter-check" type="checkbox" value=""
                                    id="category-check" data-category="Formal">
                                <span class="check">Formal</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input category-filter-check" type="checkbox" value=""
                                    id="category-check" data-category="Botas">
                                <span class="check">Botas</span>
                            </label>
                        </div>
                    </form>

                    <!-- Género -->
                    <form id="genders-form" class="py-1">

                        <div class="d-flex py-2 justify-content-between align-items-center">
                            <h5 class="mb-1 font-weight-bold">Género</h5>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>

                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input gender-filter-check" type="checkbox" value=""
                                    id="gender-check" data-gender="Hombres">
                                <span class="check">Hombres</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input gender-filter-check" type="checkbox" value=""
                                    id="gender-check" data-gender="Mujeres">
                                <span class="check">Mujeres</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input gender-filter-check" type="checkbox" value=""
                                    id="gender-check" data-gender="Unisex">
                                <span class="check">Unisex</span>
                            </label>
                        </div>
                    </form>

                    <!-- Marcas -->
                    <form id="brands-form" class="py-1">

                        <div class="d-flex py-2 justify-content-between align-items-center">
                            <h5 class="mb-1 font-weight-bold">Marcas</h5>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>

                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input brand-filter-check" type="checkbox" value=""
                                    id="brand-check" data-brand="Nike">
                                <span class="check">Nike</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input brand-filter-check" type="checkbox" value=""
                                    id="brand-check" data-brand="Adidas">
                                <span class="check">Adidas</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input brand-filter-check" type="checkbox" value=""
                                    id="brand-check" data-brand="Puma">
                                <span class="check">Puma</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input brand-filter-check" type="checkbox" value=""
                                    id="brand-check" data-brand="Reebok">
                                <span class="check">Reebok</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="tick" style="margin-bottom: 0.2rem;">
                                <input class="form-check-input brand-filter-check" type="checkbox" value=""
                                    id="brand-check" data-brand="Vans">
                                <span class="check">Vans</span>
                            </label>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-10 col-sm-9 col-md-10">
                <div class="container-fluid">
                    <div class="card-body">
                        <div class="row fade-in" id="display-items-div">

                        </div>
                    </div>
                </div>
                <hr class="fade-in">
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <script src="js/navbar-es.js"></script>
    <script src="https://kit.fontawesome.com/91728c998d.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/tienda.js"></script>
</body>

</html>