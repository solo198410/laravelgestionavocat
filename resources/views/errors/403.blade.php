@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2 text-center">
        <h2>Cette page est non autorisée</h2>
        <a href="{{ url('affaires') }}">Retour</a>
        </div>
    </div>
</div>
@endsection