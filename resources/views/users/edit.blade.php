@extends('layouts.app')
@section('title', 'Firmark')
@section('content')

<div class="card uper">
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
  </div><br />
    
@endif
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
      <form method="POST" action="{{ route('users.update',$user->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
             
              <label for="first_name">Imie:</label>
              <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}"/>
          </div>
          <div class="form-group">
              <label for="last_name">Nazwisko:</label>
              <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}"/>
          </div>
          <div class="form-group">
              <label for="username">Nick :</label>
              <input type="text" class="form-control" name="username" value="{{$user->username}}"/>
          </div>
          <div class="form-group">
              <label for="email">E-mail :</label>
              <input type="text" class="form-control" name="email" value="{{$user->email}}"/>
          </div>
    
          <div class="form-group ">
              <label for="status" >{{_('Status')}}</label>

                <select name="status" class="form-control" name="status" value="{{$user->status}}">
                  <option value=1 > Aktywny </option>
                  <option value=0 > Niekatywny </option>
                </select>
              </label>
   
          </div>
    

          <div class="form-group">
                <label for="rola" >{{_('Rola')}}</label>
                <div class="row">
                  @foreach ($roles as $role)
                      <div class="col-lg-3">
                        <div class="checkbox">
                          <label ><input type="checkbox" name="role[]" value="{{ $role->id }}"
                          @foreach ($user->roles as $user_role)
                            @if ($user_role->id == $role->id)
                              checked
                            @endif
                          @endforeach> {{ $role->name }}</label>
                        </div>  
                      </div>
                  @endforeach  
                </div>
            
          </div>
            
          <div class="form-group">
              <label for="department_id">Wydział :</label>
              <select name="department_id" class="form-control" name="department_id" value="{{$user->department_id}}"/>
              @foreach ($departments as $department)
                <option value="{{$department-> id}}" > {{$department->name}} </option>
              @endforeach
              </select>
          </div>

                
          <div class="form-group">
             <button type="submit" class="btn btn-primary">Potwierdź</button>
             <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Uzupełnij dane</button></td>
             <a href='{{ route('users.index') }}' class="btn btn-warning">Anuluj</a>
          </div>
                
        </div>




      </form>
  </div>
</div>

@include('users.create')

@endsection