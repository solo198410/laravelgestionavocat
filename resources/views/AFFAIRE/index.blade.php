@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="float-right">
        <a href="{{ url('affaires/create') }}" class="btn btn-success">Nouvelle Affaire</a></div>
        
        <form action="{{ url('affaires') }}" method="GET" class="form-inline my-2 my-lg-0">
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
                <!--<th>Présentation</th>-->
                <th nowrap="nowrap">l'autorité judiciaire compétente</th>
                <!--<th>Résultat</th>-->
                <th>clients</th>
                    <th>adversaires</th>
                    <th>Sort de l'Affaire</th>
                    <!--<th>Frais</th>-->
                <th>Action</th>
            </tr>
            </thead>
            @isset($affaires)
            <tbody>
            @foreach($affaires as $affaire)
                <!--<tr class=<?php /*if ($affaire->resultat == "gagnant") {echo("bg-success");}
                 elseif($affaire->resultat == "perdant") {echo("bg-warning");}
                 /*else {
                    echo("table-light");
                 }*/?>>-->
                 <tr>
                 <td>{{ $affaire->numero_affaire }}</td>
                    <!--<td>{{ $affaire->presentation }}</td>-->
                    <td>{{ $affaire->autorite_jud_comp }}</td>
                    <td  nowrap="nowrap">@foreach($clients as $client)
                    <?php if($client->affaire_id == $affaire->id && $client->is_adversaire == 0)
                    {
                        if ($client->is_moral == 0){
                            echo ($client->first_name ." ". $client->last_name. "<br/>");
                        } else echo ($client->moral_person_name. "<br/>");
                        
                    }?>
                    @endforeach</td>
                    <td  nowrap="nowrap">@foreach($clients as $client)
                    <?php if($client->affaire_id == $affaire->id && $client->is_adversaire == 1)
                    {
                        if ($client->is_moral == 0){
                            echo ($client->first_name ." ". $client->last_name. "<br/>");
                        } else echo ($client->moral_person_name. "<br/>");
                    }?>
                    @endforeach</td>
                    <td  nowrap="nowrap">@foreach($decisions as $decision)
                    <?php if($decision->affaire_id == $affaire->id)
                    {
                        echo ($decision->summary ."<br/>". $decision->type. " du ". $decision->date_decision. "<br/>");
                    }?>
                    @endforeach</td>
                    <!--<td>{{ $affaire->resultat}}</td>-->
                    <!--<td>{{ $affaire->frais}}</td>-->
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
            @endisset
            </table>
        </div>
    </div>
</div>

@endsection