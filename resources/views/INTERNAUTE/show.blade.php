@extends('layouts.app')

@section('title', $avocat->title)

@section('content')


<div class="container">

    
    
        <div class="row mb-2">
    @isset($avocat)
            
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
          
                
        </div>
        <div class="col-auto d-none d-lg-block">
        <img src="{{ asset($avocat->picture) }}" width="200" height="250" class="rounded-circle" alt=""><!--img-thumbnail-->

        
        

        </div>
      </div>
    </div>

            @endisset

</div>
  
        </div>
    </div>
</div>


@endsection