@extends('layouts.app')

@section('title', 'Mon espace')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="float-right">
        <a href="{{ url('avocats/create') }}" class="btn btn-success">Nouveau</a></div>
        <h3>Ajoutez votre entreprise à l’annuaire
        <span class="badge badge-secondary">Donnez de la visibilité à votre activité en vous inscrivant
             dans l'annuaire des Avocats</span></h3>
        <!--<table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Présentation</th>
                <th>adresse</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @isset($listavocat)
            @foreach($listavocat as $avocat)
            <tr>
                <td>{{ $avocat->title }} <br>{{ $avocat->user->name }}</td>
                <td>{{ $avocat->presentation }}</td>
                <td>{{ $avocat->adress }}</td>
                <td>
                
                <form action="{{ url('avocats/'.$avocat->id) }}" method="post">
                @csrf
                {{ method_field('DELETE') }}

                <a href="" class="btn btn-primary">Détail</a>
                <a href="{{ url('avocats/'.$avocat->id.'/edit') }}" class="btn btn-default">Editer</a>
                <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                
                </td>
            </tr>
            @endforeach
            @endisset
            </tbody>
        </table>-->
    
        <div class="row mb-2">
    @isset($listavocat)
            @foreach($listavocat as $avocat)
    <div class="col-md-12">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <!-- <strong class="d-inline-block mb-2 text-success">Design</strong> -->
          <h3 class="mb-0">{{ $avocat->title }}</h3>
          <div class="mb-1 text-muted">{{ $avocat->user->name }}</div>
          <p class="mb-auto">{{ $avocat->presentation }}</p>
          <strong class="d-inline-block mb-2 text-success">Compétences</strong>
          @foreach($avocat->skills as $skill)
          <li>{{ $skill->description }}</li>
          @endforeach
          <strong class="d-inline-block mb-2 text-success">adresse</strong>
          <div class="mb-1 text-muted">{{ $avocat->adress }}, wilaya {{ $avocat->wilaya->name}}</div>
          <strong class="d-inline-block mb-2 text-success">coordonnées</strong>
          @foreach($avocat->details as $detail)
          <li>{{ $detail->typedetail->type }}:  {{ $detail->value }}</li>
          @endforeach
          
          <form action="{{ url('avocats/'.$avocat->id) }}" method="post">
                @csrf
                {{ method_field('DELETE') }}

                <a href="{{ url('avocats/'.$avocat->id) }}" class="btn btn-primary">Détail</a>
                <a href="{{ url('avocats/'.$avocat->id.'/edit') }}" class="btn btn-default">Editer</a>
                @can('delete', $avocat)<button type="submit" class="btn btn-danger">Supprimer</button>
                @endcan
                </form>
                
        </div>
        <div class="col-auto d-none d-lg-block">
        <img src="{{ asset($avocat->picture) }}" width="200" height="250" class="card-img-top" alt="">

        
        

        </div>
      </div>
    </div>
    @endforeach
            @endisset

</div>
  
        </div>
    </div>
</div>

@endsection