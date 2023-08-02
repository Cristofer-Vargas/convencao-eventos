@extends('layouts.main')

@section('title', 'Criar Evento')
@section('styles')
  @vite(['resources/scss/evento-create.scss'])
@endsection

@section('content-main')

  <section class="main-content">


    <h1 class="text-center">Crie seu evento</h1>

    <form class="row g-3" action="/eventos/" method="POST">
      @csrf
      <div class="col-md-12">
        <label for="titulo" class="form-label">Nome</label>
        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ex.: Evento de JavaScript">
      </div>
      <div class="col-md-12">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Local do Evento">
      </div>
      <div class="col-md-12">
        <label for="privado" class="form-label">O evento é privado?</label>
        <select class="form-control" id="privado" name="privado">
          <option value="0">Não</option>
          <option value="1">Sim</option>
        </select>
      </div>
      <div class="col-md-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao"
          placeholder="O que vai acontecer no evento?"></textarea>
      </div>
      <div class="col-12 submit-btn">
        <button type="submit" class="col-md-2 btn btn-primary">Criar Evento</button>
      </div>
    </form>

  </section>

@endsection
