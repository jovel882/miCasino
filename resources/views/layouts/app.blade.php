<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME', 'DoubleVTest') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('includes')
</head>
<body>
    <!-- Cabezote -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('url') }}">
					<i class="fa-solid fa-people-group display-1"></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto text-info">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Generar Url</a>
                        </li>                        
                    </ul>
                </div>
            </div>			
        </nav>
    </header>

    <!-- Área de contenido -->
    <main class="content">
        <div class="container py-4">
            @yield('content')
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-6 text-center text-md-start align-self-center display-6">
                    <span class="author">John Fredy Velasco Bareño</span>
                </div>
                <div class="col-md-6 text-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center text-md-end py-3">
                                <a href="mailto:jovel882@gmail.com" target="_blank" class="text-info">
                                    <i class="fa-solid fa-square-envelope display-6"></i>
                                </a>
                            </div>
                            <div class="col-md-4 text-center text-md-end py-3">
                                <a href="https://github.com/jovel882" target="_blank" class="text-info">
                                    <i class="fa-brands fa-square-github display-6"></i>
                                </a>
                            </div>
                            <div class="col-md-4 text-center text-md-end py-3">
                                <a href="https://www.linkedin.com/in/jovel882/" target="_blank" class="text-info">
                                    <i class="fa-brands fa-linkedin display-6"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @stack('js')
</body>
</html>