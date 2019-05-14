@extends('layouts.app')
@section('title', 'Firmark')
@section('content')

<div class="card uper">
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
      <form method="post" action="{{ route('departments.update',$department->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              
              <label for="name">Nazwa:</label>
              <input type="text" class="form-control" name="name" value="{{$department->name}}"/>
          </div>
          <div class="form-group">
              <label for="desription">Opis:</label>
              <input type="text" class="form-control" name="description" value="{{$department->description}}"/>
          </div>
 
          <div class="form-group">
              <button type="submit" class="btn btn-primary">Potwierdź</button>
              <a href='{{ route('departments.index') }}' class="btn btn-warning">Anuluj</a>
          </div>

      </form>
  </div>
</div>
@endsection