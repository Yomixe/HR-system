
@extends('layouts.app')
@section('title', 'HR-system')
@section('content')
<div class="container">
@if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nazwa</th>
        <th>Opis</th>
        <th>Kierownik</th>
        <th>Pracownicy</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($departments as $department)
 
      <tr>
        <td>{{$department['name']}}</td>
        <td>{{$department['description']}}</td>
        
        <td>
  
        @foreach($department->users as $user) 

            @foreach($user->roles as $role)

                @if( $role->name == "Kierownik")
                    {{$user->first_name}} 
                    {{$user->last_name}} 
                @endif

            @endforeach

            @endforeach
</td>
<td>
        @foreach($department->users as $user) 

            @foreach($user->roles as $role)
            
                @if( $role->name == "Pracownik")
                    {{$user->first_name}} 
                    {{$user->last_name}} </br>
                @endif
            
            @endforeach
            
            @endforeach
        </td>
        <td><a href="{{action('DepartmentsController@edit', $department['id'])}}" class="btn btn-warning">Edytuj</a></td>
        <td>
                <form action="{{ route('departments.destroy', $department->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Usuń</button>
                </form>
        </td> 
        @endforeach
        </tr>
      
    
    </tbody> 
  </table>

    <button><a href="{{action('DepartmentsController@create')}}" class="btn btn-warning">Dodaj</a> </button>
</div>

@endsection
                        
