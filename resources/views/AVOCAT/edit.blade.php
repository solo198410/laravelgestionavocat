@extends('layouts.app')

@section('title', 'Edition')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('avocats/'.$avocat->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
			@csrf
			<div class="form-group col-md-4">
					<label for="title">Titre</label>
					<input name="title" class="form-control @if($errors->get('title')) is-invalid @endif" value="{{ $avocat->title }}"></input>
					<div class="invalid-feedback">
					@if($errors->get('title'))
<ul>
@foreach($errors->get('title') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
				</div></div>

                <div class="form-group col-md-12">
					<label for="presentation">Presentation</label>
					<textarea name="presentation" class="form-control @if($errors->get('presentation')) is-invalid @endif">{{ $avocat->presentation }}</textarea>
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
                <div class="form-group col-md-4">
					<label for="adress">adresse</label>
					<input name="adress" class="form-control @if($errors->get('adress')) is-invalid @endif" value="{{ $avocat->adress }}"></input>
					<div class="invalid-feedback">
					@if($errors->get('adress'))
<ul>
@foreach($errors->get('adress') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
				</div></div>

				<div class="form-group col-md-3">
  <label  for="wilaya_id">Wilaya</label>
      <select  class="form-control @if ($errors->get('wilaya_id')) is-invalid @endif"
	  name="wilaya_id" id="wilaya_id">
      <option value="{{ $avocat->wilaya_id }}" selected>{{ $avocat->wilaya->name }}</option>
	  
	  @foreach(App\Wilaya::all() as $wilaya)
<option value = "{{ $wilaya->id }}"> {{ $wilaya->name }}</option> 
@endforeach

  </select>

  <div class="invalid-feedback">
  @if($errors->get('wilaya_id'))
<ul>
@foreach($errors->get('wilaya_id') as $message)
<li>{{ $message }}</li>
@endforeach
</ul>  
@endif
</div></div>
</div>


				<div class="row">
            <div class="form-group col-md-4">

            <label for="picture">Image</label>
            <input class="form-control" type="file" name="picture">
            </div>

            </div>

				<div class="form-group">
					<input type = "submit" class="form-control btn btn-danger" value="Modifier"></input>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection