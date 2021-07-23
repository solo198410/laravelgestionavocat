@extends('layouts.app')

@section('title')
Détails Affaire {{ $id }}
@endsection

@section('content')

<div class="container" id="app">
  <div class="row">
    <div class="col-md-12">
      
@include('partials.client')
<br>      
@include('partials.adversaire')
<br>
@include('partials.seance')
<br>
@include('partials.decision')
<br/>
@include('partials.frai')

      </div>
	  </div>
	  </div>


@endsection

@section('javascripts')

<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/veeValidate.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

Vue.use(VeeValidate);


window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
      'idAffaire' => $id,
      'url' => url('/')
      //'url_'        => url()->previous(),
      //'user_id'     =>auth()->user()->id
    ]) !!};
    
</script>

<script src="{{ asset('js/script.js') }}"></script>
@endsection