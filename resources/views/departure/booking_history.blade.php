@extends('layouts.app')

@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection
<div class="layout-px-spacing">
 <div class="chat-section layout-top-spacing">
  <div class="widget-content widget-content-area br-6">
   <div class="table-responsive mb-4 mt-4">
   <h1>Booking History</h1>
    <table class="table" id="booking" >
      <thead>
        <tr>
         <th>Sl.</th>
         <th>Buyers</th>
         <th>Buyers Email</th>
         <th>Buyers Phone</th>
         <th>Departure Name</th>
         <th>Departure Owner</th>
         <!-- <th>Days/Nights</th>
         <th>From - To</td>
         <th>Travel Date</th> -->
         <th>Booking Units</th>
         <th>Booking Date</th>
         <th>Price</th>
        </tr>
      </thead>
      <tbody>
       
        <?php
           $today = date("Y-m-d");
           $date1=date_create($today);
           $date2=date_create();
           $diff=date_diff($date1,$date2);
           $date = $diff->format("%R%a");
        ?>
       @foreach($book as $key => $row)
       <tr>
          <td>{{$key+1}}</td>
          @foreach($row->company as $value)
          <td>{{$value->company_name}}</td>
          <td>{{$value->email}}</td>
          <td>{{$value->mobile}}</td>
          @endforeach
          <td>{{$row->title}}</td>
          <td>{{$row->company_name}}</td>
          <!-- <td>{{$row->no_of_days}}/{{$row->no_of_nights}}</td>
          <td>{{$row->from}}/{{$row->ending_at}}</td>
          <td>{{$row->start_date}}</td> -->
          <td>{{$row->booked_seat}}</td>
          <td>{{date('d-M-Y', strtotime($row->date))}}</td>
          <td>Rs.{{$row->price_inr}}<br>{{$row->price_usd}} $</td>
       </tr>
       @endforeach
       
      </tbody>
      </table>
   </div>
   {{$book}}
   </div>
   </div>
 </div>
@endsection
@section('footerSection')

<script>
        $('#booking').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Text Search...",
               "sLengthMenu": "",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });
</script>
@endsection