@extends('layouts.app')
@section('title', 'Firmark')
@section('script')


    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

           @endsection
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
  



  <table class="table table-striped" id="leaveTypesTable">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nazwa</th>
        <th>Przysługujące dni</th>
        <th> Data początkowa</th>
        <th> Data końcowa</th>
<th> Akcje </th>
      </tr>
    
    </thead>
   
  </table>
   
</div>
<script>
 $.fn.dataTable.ext.errMode = 'throw';
      var table=$(document).ready(function () { 
               var table=$('#leaveTypesTable').DataTable({
               processing: true,
               serverSide: true,
               ajax:{
   url: "{{ route('leavetype.index') }}",
  },
               columns: [
               
                        { data: 'id', name: 'id', searchable: false},
                        { data: 'name', name: 'name' },
                        { data: 'avaible_day', name: 'avaible_day', searchable: false},
                        { data: 'start_date', name: 'start_date', searchable: false},
                        { data: 'end_date', name: 'end_date' ,searchable: false},
                        { data: 'action', name: 'action' , orderable: false, searchable: false}
                     ]
            });
         });
         </script>      
@endsection
 
                        
