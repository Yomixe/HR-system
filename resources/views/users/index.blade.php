@extends('layouts.app')
@section('title', 'Firmark')
@section('content')
<div class="container">
<br />
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
  </div><br />
@elseif (\Session::has('error'))
  <div class="alert alert-danger">
    <p>{{ \Session::get('error') }}</p>
  </div><br />
@endif
  <div class="panel-body">
    <div class="form-group">
    <input type="text" name="search" id="search" class="form-control" placeholder="Wyszukaj użytkownika" />
    </div>
  </div>



  <table class="table table-striped">
    <thead>
      <tr>
        <th>Imie</th>
        <th>Nazwisko</th>
        <th>Nick</th>
        <th>Email</th>
        <th> Role </th>
        <th> Status </th>
        <th> Wydział </th>
      </tr>
    
    </thead>
    <tbody>
       @foreach($users as $user)
 
      <tr>
      
        <td>{{$user['first_name']}}</td>
        <td>{{$user['last_name']}}</td>
        <td>{{$user['username']}}</td>
        <td>{{$user['email']}}</td>
        <td>
        @foreach($user->roles as $role)
          {{$role['name']}} </br>
        @endforeach
        </td> 
        <td>{{$user['status']? 'Aktywny' : 'Niekatywny'}}</td>
        <td>{{$user->departments['name']}}</td>

        <td><a href="{{action('UsersController@edit', $user['id'])}}" class="btn btn-warning">Edytuj</a></td>
      
        <td>
                <form action="{{ route('users.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Usuń</button>
                </form>
        </td>
        
      </tr>
      @endforeach
     
    </tbody> 
  </table>
   
</div>
@endsection
 
                        
