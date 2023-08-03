@extends('layouts.main')

@section('title', 'Página Inicial')
@section('styles')
  @vite(['resources/scss/welcome.scss'])
@endsection

@section('content-main')

  <section class="main-fullsize">
    <section class="banner-eventos">
      <h1>Eventos</h1>
    </section>
  </section>

  <section class="main-content">

    <div class="container-eventos" id="eventsContainer" class="col-12">
      <h2>Próximos Eventos</h2>
      <p class="next-events">Veja os eventos dos próximos dias</p>

      @if (session('msg'))

        <div class="alert alert-success" role="alert">
          {{ session('msg') }}
        </div>

      @endif

      <div id="cardsContainer" class="card-eventos row">

      @if ($data['res'] == false)
        <p>{{ $data['info'] }}</p>
      @else
        @foreach ($data['eventos'] as $evento)
          <div class="card col-3">
            <img src="/imgs/eventos/{{ $evento->imagem }}" class="card-img-top" title="{{ $evento->titulo }}"
              alt="{{ $evento->titulo }}">
            <div class="card-body">
              <time class="card-date">23/07/2023</time>
              <h5 class="card-title">{{ $evento->titulo }}</h5>
              <p class="card-participants">X Participantes</p>
              <p class="card-text">{{ $evento->descricao }}</p>
              <a href="#" class="btn btn-primary">Saber mais</a>
            </div>
          </div>
        @endforeach
      @endif

      </div>
      
    </div>
  </section>

@endsection
