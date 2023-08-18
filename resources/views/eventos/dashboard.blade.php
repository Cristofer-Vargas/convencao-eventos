@extends('layouts.main')

@section('title', 'Dashboard')

@section('styles')
@endsection

@section('content-main')

  <section class="main-content">
    <h1>Teste</h1>
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
							<a href="/evento/{{ $evento->id }}">Evento...</a>
						</td>
            <td>X</td>
            <td>
							<form action="/evento/editar" method="POST">
								<button type="submit">Editar</button>
							</form>
							<form action="/evento/excluir" method="POST">
								<button type="submit">Excluir</button>
							</form>
						</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>

@endsection
