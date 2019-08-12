
@extends('layouts.app')
@section('title', 'HR-system')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dodaj ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('schedule.store') }}">
                        @csrf
                        <div class="form-group row">

                        
     
     <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Pracownik') }}</label>
     <div class="col-md-6">
     <select id="user"   class=" form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" name="user" value="{{ old('user') }}" required>
     <option value="" selected="selected" disabled="disabled">{{ __('Wybierz...') }}</option>     

     @foreach($users as $user)
     
     @foreach($current->roles as $role) 
     @if($role->name!="Admin")
     @if($user->departments)
     @if($current->departments)
     @if ( $current->departments->id==$user->departments->id )
     <option value="{{$user->id}}"> {{$user->first_name}} {{$user->last_name}} </option>  
     @endif
     @endif     
     @endif          
     
     @else
     <option value="{{$user->id}}"> {{$user->first_name}} {{$user->last_name}} </option>  
     @endif 
     @endforeach 
     @endforeach
     
     </select>       
 
 </div>
</div> 
                            <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Data początkowa') }}</label>

                            <div class="col-md-6">
                            <input id="start_date" type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" required>

                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                         <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('Data końcowa') }}</label>

                            <div class="col-md-6">
                            <input id="end_date" type="date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}" required>

                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">

                        
                            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Rozpoczęcie pracy') }}</label>

                            <div class="col-md-6">
                            <input id="start" type="time" class="form-control{{ $errors->has('start') ? ' is-invalid' : '' }}" name="start" value="{{ old('start') }}" required>

                                @if ($errors->has('start'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end" class="col-md-4 col-form-label text-md-right">{{ __('Zakończenie pracy') }}</label>

                            <div class="col-md-6">
                                <input id="end" type="time" class="form-control{{ $errors->has('end') ? ' is-invalid' : '' }}" name="end" value="{{ old('end') }}" required>

                                @if ($errors->has('end'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
            
               
 
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zapisz') }}
                                </button>

                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
