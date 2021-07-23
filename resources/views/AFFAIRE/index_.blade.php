@extends('layouts.app')

@section('title')
Liste des Affaires par numéro de l'affaire
@endsection

@section('content')

<div class="container">
    <div class="row">
    <div class="col-md-12">

    <div class="float-right">
        <a href="{{ url('affaires/create') }}" class="btn btn-success">Nouvelle Affaire</a></div>
        <form action="{{ url('affaire') }}" method="GET" class="form-inline my-2 my-lg-0">
                    @csrf
      <input name="numero_affaire" class="form-control mr-sm-2" type="text" placeholder="Numéro" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <br/>
    
    <table class="table table-striped">
            <thead>
            <tr>
                <th>n° Affaire</th>
                <th nowrap="nowrap">l'autorité judiciaire compétente</th>
                <th>clients</th>
                    <th>adversaires</th>
                    <th>Sort de l'Affaire</th>
                <th>Action</th>
            </tr>
            </thead>
            @isset($affaires)
            <tbody>
            @foreach($affaires as $affaire)
                 <tr>
                    <td>{{ $affaire->numero_affaire }}</td>
                    <td>{{ $affaire->autoritesjudiciaire->name }}</td>
                    
                    <td>@foreach ($affaire->clients as $client)
                    <?php if($client->is_adversaire == 0)
                    {
                        if ($client->is_moral == 0){
                            echo ($client->first_name ." ". $client->last_name. "<br/>");
                        } else echo ($client->moral_person_name. "<br/>");
                        
                    }?>          
                    @endforeach
                    </td>
                    
                    <td>@foreach ($affaire->clients as $client)
                    <?php if($client->is_adversaire == 1)
                    {
                        if ($client->is_moral == 0){
                            echo ($client->first_name ." ". $client->last_name. "<br/>");
                        } else echo ($client->moral_person_name. "<br/>");
                        
                    }?>          
                    @endforeach
                    </td>

                    
                    <td>@foreach ($affaire->decisions as $decision)
                    {{ $decision->summary }}<?php /*
                        echo ($decision->summary);
                    */?>        
                    @endforeach
                    </td>
                    
                    <td nowrap="nowrap">
                    <form action="{{ url('affaires/'.$affaire->id) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <a href="{{ url('affaires/'.$affaire->id) }}"><img src="{{ asset('assets/icons/icons8-volet-de-détails-25.png') }}" alt="Détail"></a>
                    <a href="{{ url('affaires/'.$affaire->id.'/edit') }}"><img src="{{ asset('assets/icons/icons8-modifier-13.png') }}" alt="Edit"></a>
                    @can('delete', $affaire)<button type="submit" onclick="return confirm('Voulez-vous supprimer cette Affaire?')" class="btn btn-link">
                    <img src="{{ asset('assets/icons/icons8-effacer-24.png') }}" alt="Delete"></button>
                    @endcan
                    </form>
                    </td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>
        @endisset
    </div>
    </div>
</div>

@endsection