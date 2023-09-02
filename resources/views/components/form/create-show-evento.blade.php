<form {{ $attributes->merge(['class' => 'row g-3']) }} enctype="multipart/form-data">
	@csrf
	{{ $method }}
	@isset ($evento)
	<div class="col-md-4">
		<img class="img-fluid" src="/imgs/eventos/{{ $evento->imagem }}" alt="{{ $evento->titulo }}">
	</div>
	@endisset
	<div class="col-md-12">
		<label for="imagem" class="form-label">Imagem do evento</label>
		<input type="file" class="form-control" name="imagem" id="imagem" placeholder="Imagem de capa do evento">
	</div>
	<div class="col-md-12">
		<label for="titulo" class="form-label">Nome</label>
		<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ex.: Evento de JavaScript" value="{{ $evento->titulo ?? '' }}">
	</div>
	<div class="col-md-12">
		<label for="cidade" class="form-label">Cidade</label>
		<input type="text" class="form-control" name="cidade" id="cidade" placeholder="Local do Evento" value="{{ $evento->cidade ?? '' }}">
	</div>
	<div class="col-md-12">
		<label for="data" class="form-label">Data</label>
		<input type="datetime-local" class="form-control" name="data" id="data" placeholder="Data" value="{{ $evento->data ?? '' }}">
	</div>
	<div class="col-md-12">
		<label for="privado" class="form-label">O evento é privado?</label>
		<select class="form-control" id="privado" name="privado">
			<option value="0">Não</option>
			<option value="1" {{ isset($evento->privado) && $evento->privado == 1 ? 'selected="selected"' : ""  }}>Sim</option>
		</select>
	</div>
	<div class="col-md-12">
		<label for="descricao" class="form-label">Descrição</label>
		<textarea class="form-control" name="descricao" id="descricao"
			placeholder="O que vai acontecer no evento?">{{ $evento->descricao ?? '' }}</textarea>
	</div>

	<div class="col-md-12">
		<input type="checkbox" name="items[]" id="item1" value="cadeiras"
		{{ isset($evento->items) && in_array('cadeiras', $evento->items) ? 'checked' : ''}}>
		<label for="item1">Cadeiras</label>
	</div>
	<div class="col-md-12">
		<input type="checkbox" name="items[]" id="item2" value="comida-livre"
		{{ isset($evento->items) && in_array('comida-livre', $evento->items) ? 'checked' : ''}}>
		<label for="item2">Comida Livre</label>
	</div>
	<div class="col-md-12">
		<input type="checkbox" name="items[]" id="item3" value="palco"
		{{ isset($evento->items) && in_array('palco', $evento->items) ? 'checked' : ''}}>
		<label for="item3">Palco</label>
	</div>
	<div class="col-md-12">
		<input type="checkbox" name="items[]" id="item4" value="brindes"
		{{ isset($evento->items) && in_array('brindes', $evento->items) ? 'checked' : ''}}>
		<label for="item4">Brindes</label>
	</div>

	<div class="col-12 submit-btn">
		<button type="submit" class="col-md-2 btn btn-primary">{{ $submitText }}</button>
	</div>
</form>
