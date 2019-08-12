@section('styles')
<style>
table {
  overflow: hidden;
}

td, th {
  padding: 10px;
  position: relative;
  outline: 0;
}

body:not(.nohover) tbody tr:hover {
  background-color: lightgrey;
}

td:hover::after,
thead th:not(:empty):hover::after,
td:focus::after,
thead th:not(:empty):focus::after { 
  content: '';  
  height: 10000px;
  left: 0;
  position: absolute;  
  top: -5000px;
  width: 100%;
  z-index: -1;
}

td:hover::after,
th:hover::after {
  background-color: lightgrey;
}

td:focus::after,
th:focus::after {
  background-color: lightblue;
}

/* Focus stuff for mobile */
td:focus::before,
tbody th:focus::before {
  background-color: lightblue;
  content: '';  
  height: 100%;
  top: 0;
  left: -5000px;
  position: absolute;  
  width: 10000px;
  z-index: -1;
}
</style>
@endsection
@extends('layouts.app')
@section('title', 'HR-system')
@section('content')
<div class="container">
@if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
@endif
@if($current->hasAnyRole('Admin') or $current->hasAnyRole('Admin'))
<a href="{{action('ScheduleController@create')}}" class="btn btn-secondary float-right  ">Dodaj @svg('solid/plus-circle')</a> 
@endif
<form method="get" action="{{ route('schedule.index')}}" > 
   

<select name="year" class="form-control" onchange='this.form.submit()' id="year">
  
@for($y=2019; $y <= 2099; $y++ )
  
@if($tempDates->year==$y){
<option value={{$y}} selected>{{$y}}</option>
@else
<option  value={{$y}}>{{$y}}</option>

@endif
@endfor
</select>
<select name="month" class="form-control" onchange='this.form.submit()' id="month" >
@for($m=1;$m<=12;$m++)

@if($tempDates->month==$m)
<option value={{$m}} selected>{{$tempDates->monthName}}</option>
@else
<option  value={{$m}}>{{$m}}</option>

@endif
@endfor
</select>

</form>
<br/>
<br/>
<div style="overflow-x:auto;" >
    <table id="dtHorizontalExample" class="table  table-hover table-bordered table-sm" cellspacing="0"
    width="100%">
      <thead  >
        <tr class="table-active " > 
          <th scope="col" >Pracownik</th>
       
          @for($i=1;$i<=$daysInMonth;$i++)
    
          <th >   
          {{$tempDates->minDayName}} <br />
          <p id="day">     {{ $tempDates->format('d') }}</p>
         
          {{  $tempDates->addDay()->format('')  }}
          </th>
    
          @endfor
       
          {{  $tempDates->subDay($daysInMonth)->format('')  }}
        
          
        </tr>
      </thead>
      <tbody >
      
      @foreach($users as $user) 

   
     
        <tr> 
      @foreach($current->roles as $role) 
      @if($role->name !='Admin')
      @if($user->departments)
      @if($current->departments)
      @if ( $current->departments->id==$user->departments->id )
      
        <td class="table-active">
         
         {{$user->first_name}}
         {{$user->last_name}}
     
        </td>
        @for($i=1;$i<=$daysInMonth;$i++)   
        <td >   
       
      
        @foreach($user->schedules as $sch)  
        @if($sch->start_date->lte($tempDates->subDay()) and $sch->end_date->addDay()->gte($tempDates->addDay()))              
        od {{substr($sch->start,1,4)}} do {{substr($sch->end,1,4)}} 
        @endif  
         
        @if(($sch->end_date->format('Y,m,d'))==($tempDates->format('Y,m,d')))
        @if($current->hasAnyRole('Admin') or$current->hasAnyRole('Admin'))
        <form action="{{ route('schedule.destroy', $sch->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn   sm" type="submit">@svg('solid/trash-alt')</button>
        </form>
        @endif
        @endif
        @endforeach 
        {{  $tempDates->addDay()->format('')  }}   
        </td> 
        @endfor  
        {{  $tempDates->subDay($daysInMonth)->format('')  }}     
 @endif
 @endif
 @endif
         @else
        <td class="table-active">
         
              {{$user->first_name}}
              {{$user->last_name}}
          
        </td>
         
        @for($i=1;$i<=$daysInMonth;$i++)   
        <td>   
       
      
        @foreach($user->schedules as $sch)  
        @if($sch->start_date->lte($tempDates) and $sch->end_date->addDay()->gte($tempDates))         
        od {{substr($sch->start,1,4)}} do {{substr($sch->end,1,4)}} 
        @endif   
        @if(($sch->end_date->format('Y,m,d'))==($tempDates->format('Y,m,d')))
        @if($current->hasAnyRole('Admin') or$current->hasAnyRole('Admin'))
        <form action="{{ route('schedule.destroy', $sch->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn sm" type="submit">@svg('solid/trash-alt')</button>
        </form>
        @endif
        @endif
        @endforeach 
        {{  $tempDates->addDay()->format('')  }}   
  </td> 
@endfor  
{{  $tempDates->subDay($daysInMonth)->format('')  }}

@endif

@endforeach
@endforeach    
 </tr>
         


</tbody> 
</table>
    
</div>
    
</div>  

 <script> 
 $('td').hover(function() {
 $(this).parents('table').find('col:eq('+$(this).index()+')').toggleClass('hover');
});
 </script>
@endsection
                        
