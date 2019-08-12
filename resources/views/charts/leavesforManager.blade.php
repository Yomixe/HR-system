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

<div>
  <table class="table table-striped" id="leaveTypesTable">
    <thead>
      <tr>
 
          <th></th>
        <th>Id</th>
        <th> Pracownik </th>
        <th>Typ urlopu</th>
        <th> Przysługujące dni urlopu</th>
        <th> Pozostało </th>
      </tr>
  
    </thead>
   
  </table>
</div>
   
<script>
 var currentId = $(this).attr("currentId");  
     var table=$(document).ready(function () {  

               var table=$('#leaveTypesTable').DataTable({
               processing: false,
                responsive: true,
               serverSide: false,
               "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Polish.json",
            },


               ajax:{
   url: "{{ route('wykresy.urlopypracownikow') }}",
  },
  
               columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false},
                        { data: 'id', name: 'id', searchable: false, visible:false},
                        { data: 'user_id', name: 'user_id' },
                        { data: 'type_of_leave_id', name: 'type_of_leave_id'},
                        { data: 'available_days', name: 'leavetype.available_days' ,searchable: false},
                        { data: 'available', name: 'available' ,searchable: false},
                      
                     ],
           
                
            
            }); 
          
           
        
        });
</script>
@endsection