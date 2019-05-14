@extends('layouts.app')
@section('title', 'Firmark')
@section('content')
<div class="container">
@if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif

    
    <form method="get" action="{{ route('schedule.index') }}"> 
   

  <select name="year" class="form-control" onchange="reload(this.form)" id="year">
  
  @for($y=2019; $y <= 2099; $y++ )
  
  @if($tempDates->year==$y){
<option value={{$y}} selected>{{$y}}</option>
@else
<option  value={{$y}}>{{$y}}</option>

  @endif

 


 @endfor
  </select>


  <select name="month" class="form-control" onchange="reload(this.form)" id="month" >
  @for($m=1;$m<=12;$m++)

  @if($tempDates->month==$m)
<option value={{$m}} selected>{{$tempDates->monthName}}</option>
@else
<option  value={{$m}}>{{$m}}</option>

  @endif
  @endfor
  </select>

</form>
<div style="overflow-x:auto;">
    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
      <thead  >
        <tr > 

          <th scope="col">Pracownik</th>
       
     @for($i=1;$i<=$daysInMonth;$i++)
    
       <th >   
          {{$tempDates->dayName}} <br />
    <p id="day">     {{ $tempDates->format('d') }}</p>
         
       {{  $tempDates->addDay()->format('')  }}
      </th>
    
        @endfor
       
        {{  $tempDates->subDay($daysInMonth)->format('')  }}
        
          
        </tr>
      </thead>
      <tbody>
      
      @foreach($users as $user) 

   
     
        <tr> 
    @foreach($current->roles as $role) 
  @if($user->departments)
    @if ( $current->departments->id==$user->departments->id )
        <td >
         
         {{$user->first_name}}
         {{$user->last_name}}
     
     </td>
     @for($i=1;$i<=$daysInMonth;$i++)   
          <td>   
       
      
         @foreach($user->schedules as $sch)  
             @if($sch->date->format('d m y')== $tempDates->format('d m y'))         
         {{$sch->start}}-{{$sch->end}} 
            @endif   
          @endforeach 
           {{  $tempDates->addDay()->format('')  }}   
  </td> 
  @endfor  
    {{  $tempDates->subDay($daysInMonth)->format('')  }}     
 
      @elseif($role->name == "Admin")
          <td >
         
              {{$user->first_name}}
              {{$user->last_name}}
          
          </td>
         
         @for($i=1;$i<=$daysInMonth;$i++)   
          <td>   
       
      
         @foreach($user->schedules as $sch)  
             @if($sch->date->format('d m y')== $tempDates->format('d m y'))         
         {{$sch->start}}-{{$sch->end}} 
            @endif   
          @endforeach 
           {{  $tempDates->addDay()->format('')  }}   
  </td> 
  @endfor  
    {{  $tempDates->subDay($daysInMonth)->format('')  }}

 @endif
@endif
         @endforeach
 
  @endforeach    
 
         </tr>
         


      </tbody> 
    </table>
    
</div>
    
  </div>  

  <script>
  function reload(form){
var year_val=document.getElementById('year').value;    
var month_val=document.getElementById('month').value



self.location='schedule?' + year_val +'&'+ month_val  ; 

}

 </script>
@endsection
                        
