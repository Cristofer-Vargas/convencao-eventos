@extends('layouts.main')

@section('title', 'Criar Evento')
@section('styles')
  @vite(['resources/scss/eventos/evento-create.scss'])
@endsection

@section('content-main')

  <section class="main-content">

    <h1 class="text-center">Crie seu evento</h1>

		<x-form.create-show-evento action="/eventos" method="POST">
			<x-slot:method>@method('POST')</x-slot>
			<x-slot:submitText>Criar Evento</x-slot:submitText>
		</x-form>

  </section>

@endsection
