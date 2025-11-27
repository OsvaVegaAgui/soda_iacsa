<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menú Semanal</title>

    <link rel="icon" type="image/png" href="{{ asset('site/img/breakfast.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos FontAwesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Font NUEVA -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Laravel -->
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
</head>

<body>
    <div id="page-loader">
        <img src="{{ asset('site/img/menu.gif') }}" alt="Cargando...">
    </div>

    <!-- NAVBAR NUEVO -->
    <nav class="navbar navbar-expand-lg modern-nav" id="mainNav">
        <div class="container">
            <a href="#home" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('site/img/logo etai.png') }}" alt="logo">
                <span class="ms-2 fw-bold brand-text"></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#menu-section">Menú</a>
                    </li>
                </ul>

                <!-- Redes sociales -->
                <div class="d-flex social-icons">
                    <a href="#" class="me-3 social-link"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="me-3 social-link"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>

            </div>
        </div>
    </nav>

    <!-- SECCIÓN MENÚ -->
    <section id="menu-section" class="py-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- TABS -->
                    <ul class="nav new-menu-tabs mb-4 justify-content-center" id="menuTabs" role="tablist">
                        
                        <li class="nav-item">
                            <button class="nav-link tab-card active" data-bs-toggle="tab" data-bs-target="#desayuno">
                                <i class="fa-solid fa-mug-hot me-2"></i> Desayuno
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link tab-card" data-bs-toggle="tab" data-bs-target="#almuerzo">
                                <i class="fa-solid fa-utensils me-2"></i> Almuerzo
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link tab-card" data-bs-toggle="tab" data-bs-target="#refrigerio">
                                <i class="fa-solid fa-apple-whole me-2"></i> Refrigerio
                            </button>
                        </li>

                    </ul>

                    <!-- CONTENIDO -->
                    <div class="tab-content" id="menuTabsContent">

                        <!-- DESAYUNO -->
                        <div class="tab-pane fade show active" id="desayuno">
                            @foreach($desayunos as $item)
                            <div class="menu-item">
                                <p class="fw-bold mb-0">{{ $item->dia }}</p>
                                <p>{{ $item->platillo }}</p>
                            </div>
                            @endforeach
                        </div>

                        <!-- ALMUERZO -->
                        <div class="tab-pane fade" id="almuerzo">
                            @foreach($almuerzos as $item)
                            <div class="menu-item">
                                <p class="fw-bold mb-0">{{ $item->dia }}</p>
                                <p>{{ $item->platillo }}</p>
                            </div>
                            @endforeach
                        </div>

                        <!-- REFRIGERIO -->
                        <div class="tab-pane fade" id="refrigerio">
                            @foreach($refrigerios as $item)
                            <div class="menu-item">
                                <p class="fw-bold mb-0">{{ $item->dia }}</p>
                                <p>{{ $item->platillo }}</p>
                            </div>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER DISTINGUIDO -->
    <footer class="main-footer text-center">
        <p class="footer-title"><i></i> Soda-Iacsa 2025</p> <br>
        <p class="footer-sub">¡Gracias por visitarnos!</p>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('site/js/menuSemanal.js') }}"></script>
</body>
</html>
