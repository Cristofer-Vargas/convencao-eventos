<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>@yield('title')</title>

  @vite(['resources/scss/app.scss', 'resources/js/app.js'])

  {{-- Styles --}}
  @yield('styles')

</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <i class="fa-solid fa-calendar"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">
                <i class="fa-solid fa-house"></i>
                Página Inicial
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/">
                <i class="fa-solid fa-people-roof"></i>
                Eventos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/">
                <i class="fa-solid fa-users-gear"></i>
                Criar Eventos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/">
                <i class="fa-solid fa-user"></i>
                Entrar
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/">
                <i class="fa-solid fa-user-plus"></i>
                Criar conta
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <section class="content-main">
    <main>
      @yield('content-main')
    </main>
  </section>

  <footer>
  </footer>
  
</body>

</html>
