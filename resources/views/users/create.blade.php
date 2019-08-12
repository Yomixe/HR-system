<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="container">
 <div class="row justify-content-right">
        <div class="col-md-12">
            <div class="card">

<div class="card-header">
   Edytuj
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <form method="POST" action="{{ route('users.storeDetails',$user->id)}}" >
          <div class="form-group">
              @csrf
              @method('PATCH')
             
        
                   
                      <div >  {{$user->first_name}} {{$user->last_name}} </div>
                        <div class="form-group row">
                      
                      
                            <label for="start_job_date" class="col-md-4 col-form-label text-md-right">{{ __('Data rozpoczęcia pracy') }}</label>
  
                            <div class="col-md-6">
                            <input id="start_job_date" type="date" class="form-control{{ $errors->has('start_job_date') ? ' is-invalid' : '' }}" name="start_job_date" 
                            @if($user->employees and $user->contacts) value="{{$user->employees->start_job_date}}"  @else value="{{ old('start_job_date') }}"  @endif required />

                                @if ($errors->has('start_job_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ dd($errors->first('start_job_date')) }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Wynagrodzenie') }}</label>

                            <div class="col-md-6">
                                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" name="salary" 
                                @if($user->employees and $user->contacts) value="{{$user->employees->salary}}"  @else value="{{ old('salary') }}"  @endif required />

                                @if ($errors->has('salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="working_hours" class="col-md-4 col-form-label text-md-right">{{_('Wymiar etatu')}}</label>
                           
                            <div class="col-md-6">
                    
                            <label >  
                                    <select name="working_hours" class="form-control{{ $errors->has('working_hours') ? ' is-invalid' : '' }}" name="working_hours" 
                                    @if($user->employees and $user->contacts)  value="{{$user->employees->working_hours}}" @else value="{{ old('working_hours') }}" @endif required >
                                    
                                    @foreach((config('enum.working_hours')) as $et)
                                        <option value="{{$et}}"> {{$et}} </option>   
                                    @endforeach   
                                    @if($user->employees and $user->contacts) 
                                    <option selected value="{{$user->employees->working_hours}}">{{$user->employees->working_hours}}  </option>
                                    @endif
                                    </select>
                                  
                                    @if ($errors->has('working_hours'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('working_hours') }}</strong>
                                    </span>
                                    @endif
                            </label> 
                            </div>
                            
                        </div>


                        <div class="form-group row">
                            <label for="tax_office" class="col-md-4 col-form-label text-md-right">{{_('Urząd skarbowy')}}</label>
                           
                            <div class="col-md-6">
                    
                            <label >  
                                    <select name="tax_office" class="form-control{{ $errors->has('tax_office') ? ' is-invalid' : '' }}" name="tax_office"
                                    @if($user->employees and $user->contacts) value="{{$user->employees->tax_office}}" @else value="{{ old('tax_offfice') }}" @endif    required >
                                    @foreach((config('enum.tax_office')) as $office)
                                    <option value="{{$office}}"> {{$office}} </option>
                                    @endforeach 
                                    @if($user->employees and $user->contacts) 
                                    <option selected value="{{$user->employees->tax_office}}">{{$user->employees->tax_office}}  </option>
                                    @endif
                                    </select>
                                   
                            </label> 
                            </div>
                            
                        </div>

                      
                        <div class="form-group row">
                            <label for="health_exam_from" class="col-md-4 col-form-label text-md-right">{{ __('Data ostatnich badania lekarskiego') }}</label>

                            <div class="col-md-6">
                                <input id="health_exam_from" type="date" class="form-control{{ $errors->has('health_exam_from') ? ' is-invalid' : '' }}" name="health_exam_from" 
                                @if($user->employees and $user->contacts) value="{{$user->employees->health_exam_from}}"  @else value="{{ old('health_exam_from') }}"  @endif required />

                                @if ($errors->has('health_exam_from'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('health_exam_from') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
 
                        <div class="form-group row">
                            <label for="health_exam_to" class="col-md-4 col-form-label text-md-right">{{ __('Data nastęnego okresowego badania lekarskiego') }}</label>

                            <div class="col-md-6">
                                <input id="health_exam_to" type="date" class="form-control{{ $errors->has('health_exam_to') ? ' is-invalid' : '' }}" name="health_exam_to"
                                @if($user->employees and $user->contacts) value="{{$user->employees->health_exam_to}}"  @else value="{{ old('health_exam_to') }}"  @endif required />

                                @if ($errors->has('health_exam_to'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('health_exam_to') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>      
                        
                        
                        
                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Stanowisko') }}</label>

                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position"
                                @if($user->employees and $user->contacts) value="{{$user->employees->position}}"  @else value="{{ old('position') }}"  @endif required />

                                @if ($errors->has('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_account" class="col-md-4 col-form-label text-md-right">{{ __('Konto bankowe') }}</label>

                            <div class="col-md-6">
                                <input id="bank_account" type="text" class="form-control{{ $errors->has('bank_account') ? ' is-invalid' : '' }}" name="bank_account"
                                @if($user->employees and $user->contacts) value="{{$user->employees->bank_account}}"  @else value="{{ old('bank_account') }}"  @endif required />

                                @if ($errors->has('bank_account'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_account') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="card-body">
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Państwo') }}</label>

                            <div class="col-md-6">
                 
                            <label >  
                                    <select id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country"
                                    @if($user->employees and $user->contacts) value="{{$user->contacts->country}}"  @else value="{{ old('country') }}"  @endif  required />
                                  
                                    @foreach((config('enum.country')) as $coun)
                                        <option value="{{$coun}}"> {{$coun}} </option>   
                                    @endforeach 
                                    @if($user->employees and $user->contacts) 
                                    <option selected value="{{$user->contacts->country}}">{{$user->contacts->country}}  </option>
                                    @endif
                                    </select>
                                    @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                            </label> 
                            </div>
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Kod pocztowy') }}</label>

                            <div class="col-md-6">
                                <input id="postal_code" type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code"
                                @if($user->employees and $user->contacts) value="{{$user->contacts->postal_code}}"  @else value="{{ old('postal_code') }}"  @endif required />

                                @if ($errors->has('postal_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Miejscowość') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" 
                                @if($user->employees and $user->contacts) value="{{$user->contacts->city}}"  @else value="{{ old('city') }}"  @endif required />

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Ulica') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" name="street" 
                                @if($user->employees and $user->contacts) value="{{$user->contacts->street}}"  @else value="{{ old('street') }}"  @endif required />

                                @if ($errors->has('street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Numer') }}</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" 
                                @if($user->employees and $user->contacts) value="{{$user->contacts->number}}"  @else value="{{ old('number') }}"  @endif required />

                                @if ($errors->has('number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="flat_number" class="col-md-4 col-form-label text-md-right">{{ __('Numer lokalu') }}</label>

                            <div class="col-md-6">
                                <input id="flat_number" type="text" class="form-control{{ $errors->has('flat_number') ? ' is-invalid' : '' }}" name="flat_number" 
                                @if($user->employees and $user->contacts) value="{{$user->contacts->flat_number}}"  @else value="{{ old('flat_number') }}"  @endif  />

                                @if ($errors->has('flat_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('flat_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Numer telefonu') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" 
                                @if($user->employees and $user->contacts) value="{{$user->contacts->phone_number}}"  @else value="{{ old('phone_number') }}"  @endif required />

                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="phone_number2" class="col-md-4 col-form-label text-md-right">{{ __('Numer telefonu 2') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number2" type="text" class="form-control{{ $errors->has('phone_number2') ? ' is-invalid' : '' }}" name="phone_number" 
                                @if($user->employees and $user->contacts) value="{{$user->contacts->phone_number2}}"  @else value="{{ old('phone_number2') }}"  @endif required />

                                @if ($errors->has('phone_number2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number2') }}</strong>
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
</div>
</div>
  </div>
</div>

