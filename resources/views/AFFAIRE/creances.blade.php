@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <div class="col-md-12">
    
    <form action="{{ url('creances') }}" method="GET" class="form-inline my-2 my-lg-0">
                    @csrf
      <div class="form-group col-md-4">
      <label for="date_debut">Début </label>
      <input type="date" class="form-control" name="date_debut">
    </div>

    <div class="form-group col-md-3">
      <label for="date_fin">Fin </label>
      <input type="date" class="form-control" name="date_fin">
    </div>
    <div class="form-group col-md-4">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button></div>
    </form>
    <br/>

    <table class="table table-striped">
            <thead>
            <tr>
                <th>n° Affaire</th>
                <th nowrap="nowrap">date décision</th>
                <th>frais affaire</th>
                    <th>versement</th>
            </tr>
            </thead>
            @isset($creances)
            <tbody>
            @foreach($creances as $creance)
                 <tr>
                    <td>{{ $creance->numero_affaire }}</td>
                    <td>{{ $creance->date_decision }}</td>
                    <td>{{ $creance->frais_affaire }}</td>
                    <td>{{ $creance->total_versement }}</td>
                    
                    </tr>
                
                @endforeach
            </tbody>
        </table>
        @endisset
    </div>
    </div>
</div>

@endsection