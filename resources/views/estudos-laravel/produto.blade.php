@extends('layouts.main')

@section('content-main')

  @if ($id != null)
    @section('title', 'Produto {{ $id }}')
    <h2>
      Produto de ID :: {{ $id }}
    </h2>
  @else
    @section('title', 'Produto Não Encontrado!')
    <h2>
      Produto não informado!
    </h2>

    <p> Informe um produto na URL da requisição. Exemplo:</p>

    <pre>
~/produto/2
</pre>
  @endif

@endsection
