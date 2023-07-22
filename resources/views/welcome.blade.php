@extends('layouts.main')

@section('title', 'Página Inicial')
@section('content-main')
  <h1>Página Inicial</h1>

	<ul>
		@foreach ($eventos as $evento)
			<li>
				Título :: {{ $evento->titulo }} <br>
				Descrição :: {{ $evento->descricao }} <br>
				Cidade :: {{ $evento->cidade }} <br>
			</li> <br>
		@endforeach
	</ul>

@endsection
