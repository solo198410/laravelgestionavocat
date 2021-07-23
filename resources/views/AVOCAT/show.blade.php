@extends('layouts.app')

@section('title', $avocatTitle)

@section('content')

<div class="container" id="app">
  <div class="row">
    <div class="col-md-12">
      
@include('partials.skill')
<br>      
@include('partials.detail')

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
      'idAvocat' => $id,
      'url' => url('/')
      //'url_'        => url()->previous(),
      //'user_id'     =>auth()->user()->id
    ]) !!};
    
</script>
<script src="{{ asset('js/scriptAvocat.js') }}"></script>
@endsection