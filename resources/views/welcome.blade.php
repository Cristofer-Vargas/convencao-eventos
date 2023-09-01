@extends('layouts.main')

@section('title', 'Página Inicial')
@section('styles')
  @vite(['resources/scss/welcome.scss'])
@endsection

@section('content-main')

  <section class="main-fullsize">
    <section class="banner-eventos">
      <h1>Convenção de Eventos</h1>
    </section>
  </section>

  <section class="main-content">

    <div class="container-eventos" id="eventsContainer" class="col-12">
      
      @if (!empty($data['textBusca']) && $data['busca'] == true)
        <h2>Resultados para: </h2>
        <p class="next-events"><strong>{{ $data['textBusca'] }}</strong></p>
      @else
        <h2>Próximos Eventos</h2>
        <p class="next-events">Veja os eventos dos próximos dias</p>
      @endif

      <div id="cardsContainer" class="card-eventos row">

      @if ($data['res'] == false)
        <div class="alert alert-danger" role="alert">
          {{ $data['info'] }}
        </div>
      @elseif (count($data['eventos']) == 0)
        <div class="alert alert-info" role="alert">
          Não há eventos disponíveis!
        </div>
      @else
        @foreach ($data['eventos'] as $evento)
          <div class="card col-3">
            <img src="/imgs/eventos/{{ $evento->imagem }}" class="card-img-top" title="{{ $evento->titulo }}"
              alt="{{ $evento->titulo }}">
            <div class="card-body">
              <time class="card-date">{{ date('d/m/Y H:i', strtotime($evento->data)) }}</time>
              <h5 class="card-title">{{ $evento->titulo }}</h5>
              <p class="card-participants">{{ count($evento->users) == 1 ? '1 Participante' : count($evento->users) . ' Participantes' }}</p>
              <p class="card-text">{{ $evento->descricao }}</p>
              <a href="/evento/{{ $evento->id }}" class="btn btn-primary">Saber mais</a>
            </div>
          </div>
        @endforeach
      @endif

      </div>
      
    </div>
  </section>

@endsection
