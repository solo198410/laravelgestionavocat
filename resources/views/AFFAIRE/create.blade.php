@extends('layouts.app')

@section('title')
Création nouvelle affaire
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('affaires') }}" method="post">
			@csrf
			<div class="form-group col-md-4">
					<label for="numero_affaire">neméro de l'affaire</label>
					<input name="numero_affaire" class="form-control @if($errors->get('numero_affaire')) is-invalid @endif" value="{{ old('numero_affaire') }}"></input>
					<div class="invalid-feedback">
					@if($errors->get('numero_affaire'))
<ul>
@foreach($errors->get('numero_affaire') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
				</div></div>
				<div class="form-group col-md-12">
					<label for="presentation">Presentation</label>
					<textarea name="presentation" class="form-control @if($errors->get('presentation')) is-invalid @endif">{{ old('presentation') }}</textarea>
					<div class="invalid-feedback">
					@if($errors->get('presentation'))
<ul>
@foreach($errors->get('presentation') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
</div></div>


<div class="form-row">
<div class="form-group col-md-3">
  <label  for="autoritesjudiciaire_id">l'autorité judiciaire compétente</label>
      <select  class="form-control @if ($errors->get('autoritesjudiciaire_id')) is-invalid @endif"
	  name="autoritesjudiciaire_id" id="autoritesjudiciaire_id">
      <option value="" selected>Choisissez...</option>
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
					<input name="adresse" class="form-control @if($errors->get('adresse')) is-invalid @endif" value="{{ old('adresse') }}"></input>
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

<div class="form-group col-md-2">
					<label for="frais_affaire">Frais</label>
					<input type = "text" name="frais_affaire" class="form-control @if($errors->get('frais_affaire')) is-invalid @endif" value="{{ old('frais_affaire') }}"></input>
					<div class="invalid-feedback">
					@if($errors->get('frais_affaire'))
<ul>
@foreach($errors->get('frais_affaire') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>
@endif
</div></div>
				<div class="form-group">
					<input type = "submit" class="form-control btn btn-primary" value="Enregistrer"></input>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection