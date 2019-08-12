
@extends('layouts.app')
@section('title', 'HR-system')
@section('content')
 <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Wydział</th>
        <th>E-mail</th>
        <th>Telefon służbowy</th>
      

      </tr>
    
    </thead>
    <tbody>
      
    @foreach($users as $user)
    @foreach($current->roles as $role) 
  @if(isset($user->departments))
  @if(isset($current->departments))
     @if($current->departments->id==$user->departments->id)
      <tr>
      <td>{{$user->first_name}}</td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->departments->name}}</td>
      <td>{{$user->email}}</td>
     <td>{{$user->contacts['phone_number']}}</td>
     
        <td><a class="btn btn-info" href="{{action('EmployeesController@show', $user->id)}}">Szczegóły</a></td>
      
       
      </tr>
      </tr>
    @endif
       @endif
       @endif
       @endforeach
       @endforeach
     
    </tbody> 
    </table>
    
 
  </div>

@endsection
                        
