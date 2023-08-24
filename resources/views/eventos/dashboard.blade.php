@extends('layouts.main')

@section('title', 'Dashboard')

@section('styles')
@endsection

@section('content-main')

  <section class="main-content">
    <h1>Meus Eventos</h1>
    @if(!empty($msg))
      <div class="alert alert-success" role="alert">
        {{ $msg }}
      </div>    
    @endif
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
            <td>
							<abbr title="{{ $evento->descricao }}">{{ $evento->titulo }}</abbr>
							<a target="_blank" href="/evento/{{ $evento->id }}">Evento...</a>
						</td>
            <td>X</td>
            <td>
              <a href="/evento/editar/{{ $evento->id }}" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>
							<form class="d-inline" action="/evento/excluir/{{ $evento->id }}" method="POST">
                @csrf
                @method('DELETE')
								<button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Excluir</button>
							</form>
						</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>

@endsection
