<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objetivos de Planificación</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
    background-color: #f0f2f5;
}

.sidebar {
    height: 100vh;
    padding-top: 20px;
}

.sidebar h4 {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.sidebar .nav-link {
    font-size: 1.2rem;
    padding: 10px;
}

.content {
    margin-top: 20px;
}

.card {
    background-color: #e3e4e6;
}

.card-header {
    background-color: #5f9ea0;
    color: white;
    font-weight: bold;
    font-size: 1.2rem;
    text-align: center;
}
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="row">
            <div class="col-md-2 bg-dark sidebar">
                <h4 class="text-white p-3">EMPRESA TIS</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">MENU PRINCIPAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Objetivos de Planificación</a>
                    </li>
                </ul>
            </div>
            
            <!-- Main content -->
            <div class="col-md-10">
                <nav class="navbar navbar-light bg-light">
                    <span class="navbar-brand mb-0 h1">Docente</span>
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </nav>

                <div class="content p-4">
                    <h2 class="text-center">Objetivos de Planificación</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">Nombre de Objetivo</div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li>Actividad 1</li>
                                        <li>Actividad 2</li>
                                        <li>Actividad 3</li>
                                        <li>Actividad 4</li>
                                        <li>Actividad 5</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">Nombre de Objetivo</div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li>Actividad 1</li>
                                        <li>Actividad 2</li>
                                        <li>Actividad 3</li>
                                        <li>Actividad 4</li>
                                        <li>Actividad 5</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">Nombre de Objetivo</div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li>Actividad 1</li>
                                        <li>Actividad 2</li>
                                        <li>Actividad 3</li>
                                        <li>Actividad 4</li>
                                        <li>Actividad 5</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">Nombre de Objetivo</div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li>Actividad 1</li>
                                        <li>Actividad 2</li>
                                        <li>Actividad 3</li>
                                        <li>Actividad 4</li>
                                        <li>Actividad 5</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>