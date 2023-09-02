@extends('layouts.main')

@section('title', 'Editando ' . $evento->titulo)
@section('styles')
  @vite(['resources/scss/eventos/evento-create.scss'])
@endsection

@section('content-main')

  <section class="main-content">

    <h1 class="text-center">Edite seu evento</h1>

		<x-form.create-show-evento action="/evento/editar/{id}" method="POST" :$evento>
			<x-slot:method>@method('PUT')</x-slot>
			<x-slot:submitText>Editar Evento</x-slot:submitText>
		</x-form>

  </section>

@endsection
