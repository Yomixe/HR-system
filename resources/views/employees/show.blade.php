
@extends('layouts.app')
@section('title', 'HR-system')
@section('content')
 <div class="d-flex flex-row my-flex-container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
 <div class="card">
            <div class="card-body">
   
     <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"> 
           
            <h2 class="card-title">Dane podstawowe</h2>
         
            <div class="pull-right">
                
            </div>
        </div>
    </div>
   
    <div class="p-2 my-flex-item">
         <div class="card-text">    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
       
                <strong>Użytkownik:</strong>
                {{ $user->first_name }}  {{ $user->last_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nick:</strong>
                {{ $user->username }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>E-mail:</strong>
                {{ $user->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                @foreach($user->roles as $role)
                {{ $role->name }} </br>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{$user->status? 'Aktywny' : 'Niekatywny'}} 
            </div>
        </div>
</div>
</div>
</div>
</div>
</div>



@if($user->contacts)
<div class="card">
<div class="card-body">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <div>
                <h2 class="card-title"> Dane kontaktowe</h2>
            </div>
            <div class="pull-right">
                
            </div>
        </div>
    </div>
    <div class="p-2 my-flex-item">
    <div class="card-text">    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
    
                
                <strong>Adres zamieszkania:</strong>
               <br />
                {{ $user->contacts->street }}
                {{ $user->contacts->number }}
                {{ $user->contacts->flat_number }}
                 <br />
                {{$user->contacts->postal_code}}
                {{ $user->contacts->city }}
                <br />
                {{ $user->contacts->country }}
                
            </div>
</div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
    
                <strong>Służbowy numer telefonu:</strong>
             
                {{ $user->contacts->phone_number }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
    
                <strong>Prywatny numer telefonu:</strong>
             
                {{ $user->contacts->phone_number2 }}
            </div>
        </div>
</div>
</div>
</div>
</div>
</div>
@endif
@if($user->employees)
<div class="card">
<div class="card-body">

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <div>
                <h2 class="card-title"> Dane umowy</h2>
            </div>
            <div class="pull-right">
                
            </div>
        </div>
    </div>
    <div class="p-2 my-flex-item">
    <div class="card-text">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Data podpisania umowy</strong>
                
                {{ $user->employees->start_job_date}}
                </div>
</div>         
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                <strong>Wynagrodzenie</strong>  
                {{$user->employees->salary}}

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                <strong>Urząd skarbowy</strong>  
                {{$user->employees->tax_office}}

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                <strong>Wymiar etatu</strong>  
                {{$user->employees->working_hours}}

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                <strong>Stanowisko</strong>  
                {{$user->employees->position}}

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                <strong>Numer konta</strong>  
                {{$user->employees->bank_account}}

            </div>
        </div>

    </div>
    </div>
</div>
</div>
</div>
</div>
@endif
   <a class="btn btn-warning" href="{{ route('pracownicy.index') }}"> Wróć</a> 
           
          
</div>

@endsection
                        
