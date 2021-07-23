@extends('layouts.app')

@section('title')
Edition Affaire {{ $affaire->numero_affaire }}
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('affaires/'.$affaire->id) }}" method="POST">
            @method('PUT')
            @csrf
			<div class="form-group col-md-4">
					<label for="numero_affaire">neméro de l'affaire</label>
					<input name="numero_affaire" class="form-control @if($errors->get('numero_affaire')) is-invalid @endif" value="{{ $affaire->numero_affaire }}"></input>
					@if($errors->get('numero_affaire'))
<ul>
@foreach($errors->get('{{ $affaire->numero_affaire }}') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>
@endif
				</div>
				<div class="form-group">
					<label for="presentation">Presentation</label>
					<textarea name="presentation" class="form-control @if($errors->get('presentation')) is-invalid @endif">{{ $affaire->presentation }}</textarea>
					@if($errors->get('presentation'))
<ul>
@foreach($errors->get('presentation') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>
@endif
				</div>
				
				
				<div class="form-row">
<div class="form-group col-md-3">
  <label  for="autoritesjudiciaire_id">l'autorité judiciaire compétente</label>
      <select  class="form-control @if ($errors->get('autoritesjudiciaire_id')) is-invalid @endif"
	  name="autoritesjudiciaire_id" id="autoritesjudiciaire_id">
      <option value="{{ $affaire->autoritesjudiciaire_id }}" selected>{{ $affaire->autoritesjudiciaire->name }}</option>
	  @foreach($autoritesjudiciaires as $autoritesjudiciaire)
<option value = "{{ $autoritesjudiciaire->id }}"> {{ $autoritesjudiciaire->name }}</option> 
@endforeach
  </select>

  <div class="invalid-feedback">
  @if($errors->get('autoritesjudiciaires_id'))
<ul>
@foreach($errors->get('autoritesjudiciaires_id') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
</div></div>

				<div class="form-group col-md-3">
					<label for="adresse">adresse</label>
					<input name="adresse" class="form-control @if($errors->get('adresse')) is-invalid @endif" value="{{ $affaire->adresse }}"></input>
					<div class="invalid-feedback">
					@if($errors->get('adresse'))
<ul>
@foreach($errors->get('adresse') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
</div></div>


</div>

				<!--<div class="form-group">
					<label for="autoritesjudiciaires_id">l'autorité judiciaire compétente</label>
					<input name="autoritesjudiciaires_id" class="form-control @if($errors->get('autoritesjudiciaires_id')) is-invalid @endif"
					value="{{ $affaire->autoritesjudiciaires_id }}"></input>
					@if($errors->get('autoritesjudiciaires_id'))
<ul>
@foreach($errors->get('autoritesjudiciaires_id') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
				</div>-->

				<!--<div class="form-row">
				<div class="form-group col-md-6">
				<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="type">Type</label>
  </div>
  <select value="autre" class="custom-select @if($errors->get('type')) is-invalid @endif" id="type" name="type">
    <option value ="">Choisissez...</option>
    <option <?php //if ($affaire->type == "social") echo("selected");?> value="social">social</option>
    <option <?php //if ($affaire->type == "pénal") echo("selected");?> value="pénal">pénal</option>
    <option <?php //if ($affaire->type == "civil") echo("selected");?> value="civil">civil</option>
	<option <?php //if ($affaire->type == "autre") echo("selected");?> value="autre">autre</option>
  </select>
  </div>
  @if($errors->get('type'))
<ul>
@foreach($errors->get('type') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
</div>			
<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="resultat">Résultat</label>
  </div>
  <select class="custom-select @if($errors->get('resultat')) is-invalid @endif" id="resultat" name="resultat">
    <option value = "">Choisissez...</option>
    <option <?php //if ($affaire->resultat == "gagnant") echo("selected");?> value="gagnant">gagnant</option>
    <option <?php //if ($affaire->resultat == "perdant") echo("selected");?> value="perdant">perdant</option>
    <option <?php //if ($affaire->resultat == "en cours") echo("selected");?> value="en cours">en cours</option>
	<option <?php //if ($affaire->resultat == "autre") echo("selected");?> value="autre">autre</option>
  </select></div>
  @if($errors->get('resultat'))
<ul>
@foreach($errors->get('resultat') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
</div></div>-->
				<!--<div class="form-group">
					<label for="">Type</label>
					<input type = "text" name="type" class="form-control @if($errors->get('type')) is-invalid @endif" value="{{ $affaire->type }}"></input>
					@if($errors->get('type'))
<ul>
@foreach($errors->get('type') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>
@endif
				</div>
				<div class="form-group">
					<label for="">Resultat</label>
					<input type = "text" name="resultat" class="form-control @if($errors->get('resultat')) is-invalid @endif" value="{{ $affaire->resultat }}"></input>
					@if($errors->get('resultat'))
<ul>
@foreach($errors->get('resultat') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>
@endif
				</div>-->
				<div class="form-group col-md-2">
					<label for="frais_affaire">Frais</label>
					<input type = "text" name="frais_affaire" class="form-control @if($errors->get('frais_affaire')) is-invalid @endif"
					value="{{ $affaire->frais_affaire }}"></input>
					@if($errors->get('frais_affaire'))
<ul>
@foreach($errors->get('frais_affaire') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>
@endif
				</div>
				<div class="form-group">
					<input type = "submit" class="form-control btn btn-danger" value="Modifier"></input>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection