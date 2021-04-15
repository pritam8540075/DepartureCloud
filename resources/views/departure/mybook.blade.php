@extends('layouts.app')

@section('content')
@section('headnav') 
<link href="{{('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
@include('layouts.topnav')
@endsection
<div class="layout-px-spacing">
   <div class="chat-section layout-top-spacing">
    <div class="widget-content widget-content-area br-6">
     <div class="table-responsive mb-4 mt-4">
     <h2>My Booking
     <span class="btn btn-info btn-sm pull-right">My Booking <span style="color:#ffeb00">{{count($mybook)}}</span></span>
     </h2>
      <div class="content-wrapper">
      <table class="table" id="booking">
        <thead>
          <tr>
           <th>Dep. ID</th>
           <th>Dep. Name</th>
           <th>Dep. From</td>
           <th>Dep. To</td>
           <th>No. of D/N</th>
           <th>Booking Date</th>
           <th>Booked Unit</th>
           <th>Price(Per PAX)</th>
           <th>Sgl Sp Price(Per PAX)</th>
           <th>Total Price</th>
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
         @foreach($mybook as $key => $row)
         <tr>
            <td>{{ $row->dep_id }}</td>
            
            <td>{{$row->title}}</td>
            <td>{{$row->from}}</td>
            <td>{{$row->ending_at}}</td>
            <td>{{$row->no_of_days}}/{{$row->no_of_nights}}</td>
            <td>{{date('d-M-Y', strtotime($row->date))}}</td>
            <td>{{$row->booked_seat}}
            @if($row->single_supplement_booked_seat>0)
             + {{$row->single_supplement_booked_seat}}(single supllement)
            @endif
            </td>
            <td> @if(ucfirst(auth::user()->country) == 'India')
                   ₹ {{$row->booking_price->price_inr}}
                 @else
                    {{$row->booking_price->price_usd}} $
                 @endif
            </td>
            <td> @if(ucfirst(auth::user()->country) == 'India')
                   ₹ {{$row->single_supplyment_price_inr}}
                 @else
                    {{$row->single_supplyment_price_usd}} $
                 @endif
            </td>
            
            <td> @if(ucfirst(auth::user()->country) == 'India')
                   ₹ {{(($row->booking_price->price_inr) * ($row->booked_seat))+(($row->single_supplement_booked_seat)*($row->single_supplyment_price_inr))}}
                 @else
                    {{($row->booking_price_usd) * $row->booked_seat}} $
                 @endif
            </td>
         </tr>
         @endforeach
         
        </tbody>
      </table>
     </div>
     </div>
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
            //"stripeClasses": [],
            //"lengthMenu": [7, 10, 20, 50],
            "pageLength": 10 
        });
</script>
@endsection