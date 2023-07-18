@extends('layouts.main')

@section('title', 'Produtos Disponíveis')
@section('content-main')

  <h2>Tela dos Produtos</h2>

  @if($busca != '')
    <p>Usuário buscando por: {{ $busca }}</p>
  @endif

@endsection
