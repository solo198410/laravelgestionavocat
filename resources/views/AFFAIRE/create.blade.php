@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('affaires') }}" method="post">
			@csrf
			<div class="form-group col-md-4">
					<label for="numero_affaire">neméro de l'affaire</label>
					<input name="numero_affaire" class="form-control @if($errors->get('numero_affaire')) is-invalid @endif" value="{{ old('numero_affaire') }}"></input>
					@if($errors->get('numero_affaire'))
<ul>
@foreach($errors->get('numero_affaire') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
				</div>
				<div class="form-group">
					<label for="">Presentation</label>
					<textarea name="presentation" class="form-control @if($errors->get('presentation')) is-invalid @endif">{{ old('presentation') }}</textarea>
					@if($errors->get('presentation'))
<ul>
@foreach($errors->get('presentation') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
				</div>

				<div class="form-group">
					<label for="autorite_jud_comp">l'autorité judiciaire compétente</label>
					<input name="autorite_jud_comp" class="form-control @if($errors->get('autorite_jud_comp')) is-invalid @endif" value="{{ old('autorite_jud_comp') }}"></input>
					@if($errors->get('autorite_jud_comp'))
<ul>
@foreach($errors->get('autorite_jud_comp') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
				</div>
				<!--<div class="form-row">
				<div class="form-group col-md-6">
				<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="type">Type</label>
  </div>
  <select class="custom-select @if($errors->get('type')) is-invalid @endif" id="type" name="type">
    <option value ="" selected>Choisissez...</option>
    <option value="social">social</option>
    <option value="pénal">pénal</option>
    <option value="civil">civil</option>
	<option value="autre">autre</option>
  </select></div>
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
    <option value = "" selected>Choisissez...</option>
    <option value="gagnant">gagnant</option>
    <option value="perdant">perdant</option>
    <option value="en cours">en cours</option>
	<option value="autre">autre</option>
  </select></div>
  @if($errors->get('resultat'))
<ul>
@foreach($errors->get('resultat') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
</div></div>-->
<div class="form-group col-md-4">
					<label for="frais_affaire">Frais</label>
					<input type = "text" name="frais_affaire" class="form-control @if($errors->get('frais_affaire')) is-invalid @endif" value="{{ old('frais_affaire') }}"></input>
					@if($errors->get('frais_affaire'))
<ul>
@foreach($errors->get('frais_affaire') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>
@endif
				</div>
				<div class="form-group">
					<input type = "submit" class="form-control btn btn-primary" value="Enregistrer"></input>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection