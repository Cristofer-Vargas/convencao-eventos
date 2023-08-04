@extends('layouts.main')

@section('title', $evento->titulo)

@section('styles')
  @vite(['resources/scss/eventos/show.scss'])
@endsection
@section('content-main')

  <section class="main-fullsize">
    <section class="banner-evento">
      <img class="img-fluid" src="/imgs/eventos/{{ $evento->imagem }}" alt="{{ $evento->titulo }}">
    </section>
  </section>

  <section class="main-content">

    <div class="row">
      <div class="col-md-6">
        <img class="img-fluid rounded" src="/imgs/eventos/{{ $evento->imagem }}" alt="{{ $evento->titulo }}">
      </div>
      <div class="col-md-6">
        <h1>{{ $evento->titulo }}</h1>
        <p><i class="fa-solid fa-location-dot"></i> {{ $evento->cidade }}</p>
        <p><i class="fa fa-users" aria-hidden="true"></i> X participantes</p>
        <p><i class="fa fa-user" aria-hidden="true"></i> Dono do Evento</p>
        <p>Sobre o Evento: <br>{{ $evento->descricao }}<p>

        <a class="btn btn-primary" href="#" role="button">Confirmar presença</a>
      </div>

    </div>

  </section>

@endsection