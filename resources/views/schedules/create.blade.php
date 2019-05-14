
@extends('layouts.app')
@section('title', 'Firmark')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dodaj ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('schedule.store', $schedule->id) }}">
                        @csrf
                        <div class="form-group row">

                        <div class="form-group">
                <label for="user" >{{_('Pracownik')}}</label>
                <div class="row">
                  @foreach ($users as $user)
                      <div class="col-lg-3">
                        <div class="checkbox">
                           
                          <label ><input type="checkbox" name="user[]" value="{{$user->id}}"
                          @foreach ($user->schedules as $user_sch)
                          
                            @if ($user_sch->id == $user->id)
                              checked
                            @endif
                          @endforeach> {{ $user->first_name }}</label>
                        </div>  
                      </div>
                  @endforeach  
                </div>
            
          </div>
                        
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Data') }}</label>

                            <div class="col-md-6">
                            <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" required>

                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
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

                        <div class="form-group row">
                            <label for="type_of_day" class="col-md-4 col-form-label text-md-right">{{ __('Typ dnia') }}</label>

                            <div class="col-md-6">
                                <input id="type_of_day" type="text" class="form-control{{ $errors->has('type_of_day') ? ' is-invalid' : '' }}" name="type_of_day" value="{{ old('type_of_day') }}" required>

                                @if ($errors->has('type_of_day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type_of_day') }}</strong>
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
