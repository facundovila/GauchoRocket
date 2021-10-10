<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gaucho Rocket</title>
   -- ESTILOS --
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/styles.css" type="text/css">
    <link rel="stylesheet" href="../public/css/home.css" type="text/css">
    -- GOOGLE FONTS --
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    -- SCRIPT --
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    -- /////////////////////// Header //////////////////////////// --
    <header>
        <nav class="navbar navbar-expand">
            <div class="container-md">
                <a href="../index.php ">
                    <h1>Gaucho Rocket</h1>
                </a>
                <div class="collapse navbar-collapse justify-content-end">
                    <div class="navbar-nav">
                        <a href="" class="nav-link">Mi reserva</a>
                        <a href="" class="nav-link">Servicios</a>
                        <a href="" class="nav-link">Información</a>
                        <a href="" class="nav-link">Registrarse</a>
                        <a href="" class="nav-link">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    -- /////////////////////// Main //////////////////////////// --
    <main class="bg-white">
        <div class="d-block w-100 banner-buscador">
            -- /////////////////////// Slider //////////////////////////// --
            <div class="w-100 main-slider">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/luna.jpg" class="img-fluid" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/luna.jpg" class="img-fluid" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/luna.jpg" class="img-fluid" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            -- /////////////////////// Buscador //////////////////////////// --
            <div class="w-100 d-flex justify-content-center" style="position: absolute; bottom: 0;">
                <div class="p-3 card bg-primary container">
                    <div class="card p-3 container">
                        <form>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipo-viaje" id="ida">
                                <label class="form-check-label" for="ida">Ida</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipo-viaje" id="ida-y-vuelta">
                                <label class="form-check-label" for="ida-y-vuelta">Ida y vuelta</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipo-viaje" id="multidestino">
                                <label class="form-check-label" for="multidestino">Multidestino</label>
                            </div>
                            <div class="row mt-3">
                                -- Fields --
                                <div class="col-lg col-6">
                                    <label for="input-origen" class="form-label">Origen</label>
                                    <input type="text" class="form-control" id="input-origen">
                                </div>
                                <div class="col-lg col-6">
                                    <label for="field-destino" class="form-label">Destino</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg col-3">
                                    <label for="field-destino" class="form-label">Partida</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg col-3">
                                    <label for="field-destino" class="form-label">Regreso</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg col-4">
                                    <label for="clase" class="form-label">Clase</label>
                                    <select name="clase" id="clase" class="form-select">
                                        <option selected>Selecione un opción</option>
                                        <option value="1">...</option>
                                    </select>
                                </div>
                            </div>
    
                            <button class="btn btn-primary mt-3">Buscar vuelos</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="card col mb-5" style="width: 18rem;">
                        <img src="img/luna.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card col mb-5" style="width: 18rem;">
                        <img src="img/luna.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card col mb-5" style="width: 18rem;">
                        <img src="img/luna.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card col mb-5" style="width: 18rem;">
                        <img src="img/luna.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    -- /////////////////////// Footer //////////////////////////// --
    <footer>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
              <p class="col-md-4 mb-0 text-muted">&copy; 2021 Gaucho Rocket</p>
          
              --<a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
              </a>--
          
              <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Inicio</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Reservas</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Servicios</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Nosotros</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Información</a></li>
              </ul>
            </footer>
          </div>
    </footer>
</body>

</html>