<?php
include("view/header.php")
?>
<main class="bg-white">
    <div class="d-block w-100 banner-buscador">
        <!-- /////////////////////// Slider //////////////////////////// -->
        <div class="w-100 main-slider">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="public/luna.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="public/luna.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="public/luna.jpg" class="img-fluid" alt="...">
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
        <!-- /////////////////////// Buscador //////////////////////////// -->
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
                            <!-- Fields -->
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
                    <img src="public/luna.jpg" class="card-img-top" alt="...">
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
                    <img src="public/luna.jpg" class="card-img-top" alt="...">
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
                    <img src="public/luna.jpg" class="card-img-top" alt="...">
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
                    <img src="public/luna.jpg" class="card-img-top" alt="...">
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

<?php
include("view/footer.php");
?>