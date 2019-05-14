@extends('layouts.app')
 @section('title', 'Firmark')
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
        <th>Telefon</th>
      

      </tr>
    
    </thead>
    <tbody>
      
    @foreach($users as $user)
 
      <tr>
      <td>{{$user->first_name}}</td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->departments->name}}</td>
      <td>{{$user->email}}</td>
     <td>{{$user->contacts['phone_number']}}</td>
     
        <td><a class="btn btn-info" href="{{action('EmployeesController@show', $user->id)}}">Szczegóły</a></td>
       
      
       @endforeach

       
      </tr>
      </tr>
   
     
    </tbody> 
    </table>
    
 
  </div>

@endsection
                        
