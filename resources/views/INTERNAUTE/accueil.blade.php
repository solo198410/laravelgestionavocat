@extends('layouts.app')

@section('title', 'Annauaire des Avocats')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

        <form action="{{ url('/') }}" method="GET" class="form-inline my-2 my-lg-0">
                    @csrf
      <div class="form-group col-md-4">
      <label for="title">Titre/Nom </label>
      <input type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group col-md-3">
  <label  for="wilaya_id">Wilaya</label>
      <select  class="form-control" name="wilaya_id" id="wilaya_id">
      <option value="" selected>Choisissez...</option>
	  @foreach(App\Wilaya::all() as $wilaya)
<option value = "{{ $wilaya->id }}"> {{ $wilaya->name }}</option> 
@endforeach
  </select>

  </div>
    <div class="form-group col-md-4">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button></div>
    </form>

<br>

<h1><span class="badge badge-secondary">L'annuaire des avocats</span></h1>
<div class="card-group">
     
    <div class="row row-cols-1 row-cols-md-3">
            @isset($listavocat)
            @foreach($listavocat as $avocat)

  <div class="col mb-4">
    <div class="card h-100">
      <img src="{{ asset($avocat->picture) }}" height="250" class="card-img-top" alt="...">
      <div class="card-body">
      <a href="{{ url('detail/'.$avocat->id) }}">
      <h5 class="card-title">{{ $avocat->title }}</h5></a>
        <p class="card-text">{{ $avocat->presentation }}</p>
      </div>
    </div>
  </div>

  @endforeach
            @endisset
</div>
</div>     
  
        </div>
    </div>
</div>


@endsection