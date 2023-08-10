<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>@yield('title')</title>

  @vite(['resources/scss/app.scss', 'resources/js/app.js'])

  {{-- Styles --}}
  @yield('styles')

</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <i class="fa-solid fa-calendar"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">
                Eventos
              </a>
            </li>

            @auth
              <li class="nav-item">
                <a class="nav-link" href="/eventos/criar">
                  Criar Eventos
                </a>
              </li>
            @endauth

            <li class="nav-item">
              <a class="nav-link" href="/estudos-laravel">
                Documentação de Estudos
              </a>
            </li>

            @guest
              <li class="nav-item">
                <a class="nav-link" href="/register">
                  Criar Conta
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/login">
                  Entrar
                </a>
              </li>
            @endguest

            @auth
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Conta
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">
                      Editar Conta
                    </a></li>
                  <li><a class="dropdown-item" href="/dashboard">
                      Meus eventos
                    </a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li class="text-center">
                    <form action="/logout" method="POST">
                      @csrf
                      <button type="submit" class="btn w-full">Sair</button>
                    </form>
                  </li>
                </ul>
              </li>
            @endauth

          </ul>
          <form class="d-flex" role="search" action="/" method="GET">
            <input class="form-control me-2" name="busca" type="search" placeholder="Procurar..." aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main>
    @yield('content-main')
  </main>

  <footer class="text-center text-white bg-dark">
    <div class="text-center p-3">
      &copy; 2023 Cristofer Vargas:
      <a class="text-white" href="https://github.com/Cristofer-Vargas" target="_blank">github</a>
    </div>
  </footer>

  {{-- Scripts --}}
  @yield('script')
</body>

</html>
