@extends('layouts.app')

@section('content')


<div class="container">
@foreach($affaires as $affaire)
<div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>
        {{ $affaire->numero_affaire. ' dernier délai de recours le '. $affaire->date_recours }}
        </strong>
        </div>
        @endforeach

</div>

@endsection