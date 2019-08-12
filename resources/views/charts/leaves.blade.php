@extends('layouts.app')
 @section('title', 'HR-system')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default"> 
                <div class="card-header">
                <div class="panel-heading">Statystyki</div>
                </div>
             
                @if(isset($status[0]))
             
                <div class="card">
                <div class="card-body">
                    {!! $chart->html() !!}
                </div>
                </div>
    @else     

                <div class="card">
                <div class="card-body">
                 Nie masz przypisanych żadnych urlopów!
                </div>
                </div>
    @endif
              
            </div>
        </div>
    </div>
</div>

{!! Charts::scripts() !!}

{!! $chart->script() !!}

          
      
@endsection