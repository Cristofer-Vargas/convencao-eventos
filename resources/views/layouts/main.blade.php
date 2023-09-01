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
              <a class="nav-link" aria-current="page" href="/">
                Eventos
              </a>
            </li>
            
            @auth
            <li class="nav-item">
              <a class="nav-link" href="/dashboard">
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/eventos/criar">
                Criar Eventos
              </a>
            </li>
            @endauth

            @auth
            <li class="nav-item">
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="nav-link">Sair</button>
              </form>
            </li>

              @if(auth()->user()->id == 1 && auth()->user()->name == 'Cristofer')
              <li class="nav-item">
                <a class="nav-link" href="/estudos-laravel">
                  Documentação de Estudos
                </a>
              </li>
              @endif
              
            @endauth


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
    @if (session('msg'))
      <section class="main-content">
        <div class="alert alert-success" role="alert">
          {{ session('msg') }}
        </div>
      </section>
    @endif

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
