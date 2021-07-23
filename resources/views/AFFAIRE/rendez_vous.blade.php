@extends('layouts.app')

@section('title')
Rendez Vous
@endsection

@section('content')


<div class="container">


@foreach($seances as $seance)
<a href="{{ url('affaires/'.$seance->affaire_id) }}">
<div class="alert alert-success alert-block">

        <button type="button" class="close" data-dismiss="alert">×</button>
        
        <strong>
        
        affaire n° {{ $seance->numero_affaire. ' '. $seance->subject. ' séance programmé le '. $seance->date_seance }}
        </strong>
        </div>
        </a>
        @endforeach

</div>

@endsection