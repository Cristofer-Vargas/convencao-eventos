@extends('layouts.main')

@section('title', 'Criar Evento')
@section('styles')
  @vite(['resources/scss/eventos/evento-create.scss'])
@endsection

@section('content-main')

  <section class="main-content">


    <h1 class="text-center">Crie seu evento</h1>

    <form class="row g-3" action="/eventos" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="col-md-12">
        <label for="imagem" class="form-label">Imagem do evento</label>
        <input type="file" class="form-control" name="imagem" id="imagem" placeholder="Imagem de capa do evento">
      </div>
      <div class="col-md-12">
        <label for="titulo" class="form-label">Nome</label>
        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ex.: Evento de JavaScript">
      </div>
      <div class="col-md-12">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Local do Evento">
      </div>
      <div class="col-md-12">
        <label for="data" class="form-label">Data</label>
        <input type="datetime-local" class="form-control" name="data" id="data" placeholder="Data">
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

      <div class="col-md-12">
        <input type="checkbox" name="items[]" id="item1" value="cadeiras">
        <label for="item1">Cadeiras</label>
      </div>
      <div class="col-md-12">
        <input type="checkbox" name="items[]" id="item2" value="comida-livre">
        <label for="item2">Comida Livre</label>
      </div>
      <div class="col-md-12">
        <input type="checkbox" name="items[]" id="item3" value="palco">
        <label for="item3">Palco</label>
      </div>
      <div class="col-md-12">
        <input type="checkbox" name="items[]" id="item4" value="brindes">
        <label for="item4">Brindes</label>
      </div>

      <div class="col-12 submit-btn">
        <button type="submit" class="col-md-2 btn btn-primary">Criar Evento</button>
      </div>
    </form>

  </section>

@endsection
