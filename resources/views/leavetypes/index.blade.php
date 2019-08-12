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
<span id="result" ></span>  


<a href="javascript:void(0)" class="btn    float-right btn-dark " id="create-new-type">Dodaj @svg('solid/plus-circle')</a>
</br>
</br>

<div>
  <table class="table table-striped" id="leaveTypesTable">
    <thead>
      <tr>
        <th>Id</th>
        <th> </th>
        <th>Nazwa</th>
        <th>Przysługujące dni</th>
        <th> Data początkowa</th>
        <th> Data końcowa</th>
        <th>Akcje</th>
      </tr>
    
    </thead>
   
  </table>
</div>
   <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">

   <div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="typeCrudModal"></h4>
    </div>
    <span id="form_result" ></span>  
    <div class="modal-body">
        <form id="typeForm" name="typeForm" class="form-horizontal">
           <input type="hidden" name="type_id" id="type_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nazwa</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Wpisz nazwę" value="" maxlength="50" required="">
                </div>
            </div>
            <div class="form-group">
            <label for="available_days" class="col-sm-2 control-label">Przysługujące dni</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="available_days" name="available_days" placeholder="Wpisz ilość dni przysługujących urlopowi" value="" maxlength="50" required="">
                </div>
            </div>
            <div class="form-group">
            <label for="start_date" class="col-sm-2 control-label">Data początkowa</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="start_date" name="start_date" value="" maxlength="50" required="">
                </div>
            </div>
            <div class="form-group">
            <label for="end_date" class="col-sm-2 control-label">Data końcowa</label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="end_date" name="end_date"  value="" maxlength="50" required="">
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

               var table=$('#leaveTypesTable').DataTable({
               processing: false,

               serverSide: false,
               "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Polish.json",
            },
               ajax:{
   url: "{{ route('typurlopu.index') }}",
  },
 
               columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false},
                        { data: 'id', name: 'id', searchable: false, visible:false},
                        { data: 'name', name: 'name' },
                        { data: 'available_days', name: 'available_days', searchable: false},
                        { data: 'start_date', name: 'start_date', searchable: false},
                        { data: 'end_date', name: 'end_date' ,searchable: false},
                        {data: 'action', name: 'action', orderable: false}
                     ]
            });
            $.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});
       
    $('#create-new-type').click(function () {
        $('#btn-save').val("create-type");
        $('#type_id').val('');
        $('#typeForm').trigger("reset");
        $('#typeCrudModal').html("Dodaj nowy rodzaj urlopu");
        $('#ajax-crud-modal').modal('show');
    });
 
    $('body').on('click', '.edit-type', function () {
      var type_id = $(this).data('id');
      $.get('typurlopu/' + type_id +'/edit', function (data) {
         $('#name-error').hide();
         $('#available_days-error').hide();
         $('#start_date-error').hide();
         $('#end_date-error').hide();
         $('#typeCrudModal').html("Edytuj rodzaj urlopu");
          $('#btn-save').val("edit-type");
          $('#ajax-crud-modal').modal('show');
          $('#type_id').val(data.id);
          $('#name').val(data.name);
          $('#available_days').val(data.available_days);
          $('#start_date').val(data.start_date);
          $('#end_date').val(data.end_date);
      })
   });
    $('body').on('click', '#delete-type', function () {
 
        var type_id = $(this).data("id");
        var con=confirm("Jesteś pewny, że chcesz to usunąć ?!");
        if(con){
        $.ajax({
            type: 'DELETE',
            url: 'typurlopu/'+type_id,
            success: function (data) {
           
        var html = '';     
        if(data.success)
     {
            html = '<div class="alert alert-success">' + data.success + '</div>';
            
            var oTable = $('#leaveTypesTable').dataTable(); 
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
 
if ($("#typeForm").length > 0) {
      $("#typeForm").validate({
 
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Wysyłanie..');
      
      $.ajax({
          data: $('#typeForm').serialize(),
       
         url: '/typurlopu',
           method:'POST', 
         dataType: 'json',
             success: function (data) {
 
            var html = '';     
        if(data.success)
     {
        html = '<div class="alert alert-success">' + data.success + '</div>';
            
            window.setTimeout(function(){ 
   
           
            $('#leaveForm').trigger("reset");
            $('#ajax-crud-modal').modal('hide');
         
         
            var oTable = $('#leaveTypesTable').dataTable();
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
    $('#form_result').fadeIn(1000).html(html);
    $('#form_result').delay( 1000 ).fadeOut(1500).html(html);
    $('#btn-save').html('Zapisz');
              
            
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Zapisz zmiany');
          }
      });
    }
  })
}
         </script>      
@endsection
 
                        
