@if(session()->has('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}
        </div>
        @endif
<!---->
        <!--@if(session()->has('rendez_vous'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>
        {{ session()->get('rendez_vous') }}
        </strong>
        </div>
        @endif
        
        
        @if(session()->has('rendez_vous'))
        <div class="alert alert-warning alert-block fade show" role="alert">
        {{ session()->get('rendez_vous') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        @endif
        -->


        <!--<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>-->