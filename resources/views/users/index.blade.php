@extends('layouts.app')
@section('title', 'HR-system')

@section('script')


<link  href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_pl.js"> </script> 

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
<span id="result" ></span>  


  <table class="table table-striped" id="userTable">
    <thead>
      <tr>
        <th></th>
        <th>Id</th>
        <th>Imie</th>
        <th>Nazwisko</th>
        <th>Nick</th>
        <th>Email</th>
        <th> Role </th>
        <th> Status </th>
        <th> Wydział </th>
        <th> Akcje </th>
      
      </tr>
    
    </thead>
    
  </table>
   
</div>
<script>

 
var table=$(document).ready(function () {  

var table=$('#userTable').DataTable({
responsive:true,
processing: false,
   
serverSide: false,
   "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Polish.json"
},
ajax:{
url: "{{ route('users.index') }}",
},

columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false},
            { data: 'id', name: 'id', searchable: false, visible:false, searchable: false},
            { data: 'first_name', name: 'first_name'},
            { data: 'last_name', name: 'last_name'},
            { data: 'username', name: 'username'},
            { data: 'email', name: 'email' },
            {data: 'roles', name: 'roles.name', searchable: false},
            {data: 'status', name: 'status', searchable:false },
            {data: 'department_id', name: 'department_id', searchable:false},
            {data: 'action', name: 'action', orderable: false,searchable: false},
         ]
});

$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});
$('body').on('click', '#delete-user', function () {
 
 var user_id = $(this).data("id");
 var con=confirm("Jesteś pewny, że chcesz to usunąć ?!");
 if(con){
 $.ajax({
     type: 'DELETE',
     url: 'users/'+user_id,
     success: function (data) {
    
 var html = '';     
 if(data.success)
{
     html = '<div class="alert alert-success">' + data.success + '</div>';
     
     var oTable = $('#userTable').dataTable(); 
     oTable.api().ajax.reload();
      
     
}
 if(data.errors){
 var html = '';   
 html = '<div class="alert alert-danger">';
 for(var count = 0; count < data.errors.length; count++)
 {
 html += '<p>' + data.errors[count] + '</p>';
 }
 html += '</div>';

}  
$('#result').fadeIn(1000).html(html);
$('#result').delay( 1000 ).fadeOut(1500).html(html);

     },
     error: function (data) {
         console.log('Error:', data);
     }
 });}
});   
});

</script>
@endsection
 
                        
