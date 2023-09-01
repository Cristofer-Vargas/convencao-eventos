@extends('layouts.main')

@section('title', 'Dashboard')

@section('styles')
  @vite(['resources/scss/eventos/dashboard.scss'])
@endsection

@section('content-main')

  <section class="main-content">

    <section>
      <h1>Meus Eventos</h1>

      @if (!empty($msg))
        <div class="alert alert-success" role="alert">
          {{ $msg }}
        </div>
      @endif

      @if (count($eventos))
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col"><i class="fa fa-id-card" aria-hidden="true"></i></th>
              <th scope="col"><i class="fa fa-envelope-open" aria-hidden="true"></i> Evento</th>
              <th scope="col"><i class="fa fa-users" aria-hidden="true"></i> Participantes</th>
              <th scope="col"><i class="fa fa-edit" aria-hidden="true"></i> Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($eventos as $evento)
              <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $evento->titulo }}</td>
                <td>{{ count($evento->users) }}</td>
                <td>
                  <a class="btn btn-info" target="_blank" href="/evento/{{ $evento->id }}"><i
                      class="fa-solid fa-arrow-up-right-from-square"></i> Acessar Evento</a>
                  <a href="/evento/editar/{{ $evento->id }}" class="btn btn-info"><i class="fa fa-edit"
                      aria-hidden="true"></i> Editar</a>
                  <form class="d-inline" action="/evento/excluir/{{ $evento->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>
                      Excluir</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="alert alert-danger" role="alert">
          Você não possui eventos!
        </div>
      @endif
    </section>

    <section>
      <h1>Presenças confirmadas</h1>

      @if (count($eventoParticipacao))
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col"><i class="fa fa-id-card" aria-hidden="true"></i></th>
              <th scope="col"><i class="fa fa-envelope-open" aria-hidden="true"></i> Evento</th>
              <th scope="col"><i class="fa fa-users" aria-hidden="true"></i> Participantes</th>
              <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Data do evento</th>
              <th scope="col"><i class="fa fa-edit" aria-hidden="true"></i> Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($eventoParticipacao as $evento)
              <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $evento->titulo }}</td>
                <td>{{ count($evento->users) }}</td>
                <td>{{ $evento->data }}</td>
                <td>
                  <a class="btn btn-info" href="/evento/{{ $evento->id }}" target="_blank">Ver evento</a>
                  <form class="d-inline" action="/evento/entrar/{{ $evento->id }}" method="post">
                    @csrf
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Remover
                      Presença</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="alert alert-danger" role="alert">
          Você não está participando de nenhum evento!
        </div>
      @endif
    </section>
  </section>

@endsection
