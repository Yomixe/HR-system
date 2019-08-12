
@extends('layouts.app')
@section('title', 'HR-system')

@section('script')




<link  href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_pl.js"> </script>

@endsection
@section('content')
<div class="container">
<br />
<span id="result" ></span>  
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
  </div><br />
@elseif (\Session::has('error'))
  <div class="alert alert-danger">
    <p>{{ \Session::get('error') }}</p>
  </div><br />
@endif
 

<a href="javascript:void(0)" class="btn btn-primary   float-right  " id="create-new-leave">Dodaj @svg('solid/plus-circle')</a>


<a href="{{action('CalendarController@index')}}"  class="btn  float-right  btn-dark  " >  Widok kalendarza @svg('solid/calendar-alt') </a>

</br>
</br>
</br>
</br>
<div>
  <table class="table table-striped" id="leaveEmployeeTable">
    <thead>
      <tr>
        <th>Id </th>
        <th> </th>

        <th>Użytkownik</th>
        <th> Typ urlopu</th>
        <th> Data początkowa</th>
        <th> Data końcowa</th>
        <th>Potwierdzenie</th>
        <th> Komentarz</th>


        <th>Akcje</th>
      </tr>
    
    </thead>
   
  </table>
</div>
   <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">

   <div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <h4 class="modal-title" id="leaveModal"></h4>
    </div>
    <span id="form_result" ></span>  
    <div class="modal-body">
        <form id="leaveForm" name="leaveForm" class="form-horizontal">
           <input type="hidden" name="leave_id" id="leave_id">
           
           <div class="form-group ">
            <label for=type_of_leave_id" class="col-sm-2 control-label">Rodzaj urlopu</label>
            <div class="col-sm-12">
                 
            <label >  
           
                <select class="form-control" id="type_of_leave_id" name="type_of_leave_id"  value="" maxlength="50" required="">
                <option selected="selected" disabled="disabled"> Wybierz typ urlopu  </option>               
                @foreach($leavetypes as $leavetype)
                    <option value="{{$leavetype->id}}"> {{$leavetype->name}} </option>              
                @endforeach 
                </select>       
            </label> 
            </div>
                               
            </div>
         
              
            
           
            <div class="form-group">
            <label for="start_date" class="col-sm-2 control-label">Data początkowa</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="start_date" name="start_date" value="" required="">
                </div>
            </div>
            <div class="form-group">
            <label for="end_date" class="col-sm-2 control-label">Data końcowa</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="end_date" name="end_date"  value=""  required="">
                </div>
            </div>
            <div class="form-group">
            <label for="comment" class="col-sm-2 control-label">Komentarz</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="comment" name="comment"  value="" maxlength="255">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Zapisz
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>

<script>

     var table=$(document).ready(function () {  

               var table=$('#leaveEmployeeTable').DataTable({
               processing: false,
               responsive:true,
               serverSide: false,
               "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Polish.json"
            },
               ajax:{
               url: "{{ route('mojeurlopy.index') }}",
  },
 
               columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false},
                        { data: 'id', name: 'id', searchable: false, visible:false},
                        { data: 'user_id', name: 'user_id', searchable: false, visible:false},
                        { data: 'type_of_leave_id', name: 'type_of_leave_id'},
                        { data: 'start_date', name: 'start_date', searchable: false},
                        { data: 'end_date', name: 'end_date' ,searchable: false},
                        {data: 'confirm', name: 'confirm', searchable: false},
                        {data: 'comment', name: 'comment'},
                        {data: 'action', name: 'action', searchable: false, orderable: false},
                     ]
            });
       
         
            $.ajaxSetup({
            beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
    },
});
       
    $('#create-new-leave').click(function () {
        $('#btn-save').val("create-leave");
        $('#leave_id').val('');
        $('#leaveForm').trigger("reset");
        
        $('#leaveModal').html("Dodaj nowy  urlop");
        $('#ajax-crud-modal').modal('show');
        
    });
 
    $('body').on('click', '#edit-leave', function () {
       
      var leave_id = $(this).data('id');
      $.get('mojeurlopy/' + leave_id +'/edit', function (data) {
        $('#user_id-error').hide();
        $('#type_of_leave_id-error').hide();
        $('#start_date-error').hide();
        $('#end_date-error').hide();
        $('#comment-error').hide();
        $('#leaveModal').html("Edytuj urlop");
        $('#btn-save').val("edit-leave");
        $('#ajax-crud-modal').modal('show');
        $('#leave_id').val(data.id);
        $('#user_id').val(data.user_id);
        $('#type_of_leave_id').val(data.type_of_leave_id);
        $('#start_date').val(data.start_date);
        $('#end_date').val(data.end_date); 
        $('#comment').val(data.comment);
      })
   });
    $('body').on('click', '#delete-leave', function () {
 
        var leave_id = $(this).data("id");
        con=confirm("Jesteś pewny, że chcesz to usunąć ?!");
        if(con){
        $.ajax({
            type: 'DELETE',
            url: 'mojeurlopy/'+leave_id,
            success: function (data) {

        var html = '';     
        if(data.success)
     {
              html = '<div class="alert alert-success">' + data.success + '</div>';
            
              var oTable = $('#leaveEmployeeTable').dataTable(); 
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
    $('#btn-save').html('Zapisz');
              

            
    },
            error: function (data) {
                console.log('Error:', data);
            }
        }); }
    });   

   


   });
 


 
if ($("#leaveForm").length > 0) {
      $("#leaveForm").validate({
   
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Wysyłanie..');
      
      $.ajax({
        data: $('#leaveForm').serialize(),
         
        url: '/mojeurlopy',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
           
            var html = '';     
        if(data.success)
     {
              html = '<div class="alert alert-success">' + data.success + '</div>';
            
              window.setTimeout(function(){ 
     
             
              $('#leaveForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
           
           
              var oTable = $('#leaveEmployeeTable').dataTable();
              oTable.api().ajax.reload();
              },1500);
             
            
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
    $('#form_result').fadeIn(1500).html(html);
    $('#form_result').delay( 1500 ).fadeOut(1500).html(html);
    $('#btn-save').html('Zapisz');
              
        },
        error: function (data) {

            
            $('#btn-save').html('Zapisz');
              console.log('Error:', data);
          }
      });
    }
  })
}


</script>      
@endsection
 
                        