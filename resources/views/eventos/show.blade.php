@extends('layouts.main')

@section('title', $evento->titulo)

@section('styles')

  <style>
    .banner-evento {
      background-image: url('/imgs/eventos/{{ $evento->imagem }}');
    }
  </style>

  @vite(['resources/scss/eventos/show.scss'])
@endsection

@section('content-main')

  <section class="main-fullsize d-none d-lg-block">
    <section class="banner-evento">
    </section>
  </section>

  <section class="main-content">

    <div class="row">
      <div class="col-md-6">
        @if ($evento->imagem != null)
          <img class="img-fluid rounded" src="/imgs/eventos/{{ $evento->imagem }}" alt="{{ $evento->titulo }}">
        @else
          <img class="img-fluid rounded" src="/imgs/default-event-image.jpg" alt="Evento não possue imagem, imagem padrão">
        @endif
      </div>
      <div class="col-md-6">
        <h1>{{ $evento->titulo }}</h1>
        <p><i class="fa-solid fa-location-dot"></i> {{ $evento->cidade }}</p>
        <p>
          <i class="fa fa-users" aria-hidden="true"></i>
          {{ count($evento->users) == 1 ? '1 participante' : count($evento->users) . ' participantes' }} 
            <span class="text-success">
              {{ $asParticipant != null ? '- ' . $asParticipant : '' }}
            </span>
        </p>
        <p><i class="fa fa-user" aria-hidden="true"></i> {{ $user->name }}</p>
        <p><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('d/m/Y H:i', strtotime($evento->data)) }}</p>
        <p>Sobre o Evento: <br>{{ $evento->descricao }}<p>

        <form action="/evento/entrar/{{ $evento->id }}" method="post">
          @csrf
          <button type="submit1" class="btn btn-primary" role="button">{{ $btn }}</button>
        </form>

        @if (!empty($evento->items))
          <h3>O evento conta com:</h3>
          <ul class="items-evento">
            @foreach($evento->items as $item)
              <li>
                <i class="fa-solid fa-caret-right"></i>
                {{ $item }}
              </li>
            @endforeach
          </ul>
        @endif
      </div>

    </div>

  </section>

@endsection