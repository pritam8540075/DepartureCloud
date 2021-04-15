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
                <h1>All Hold History <a href="" class="btn btn-info btn-sm pull-right">Total Booked {{$total}}</a></h1>
                <table class="table table-bordered" id="booking"> 
                <thead>
                <tr>
                <th>Sl.</th>
                <th>Deparute Name</th>
                <th>Company Name</th>
                <th>Name</th>
                <th>hold Date</th>
                <th>Hold Units</th>
                <th>Price(PAX)</th>
                <th>Total Price</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($hold)> 0 )
                @foreach($hold as $key=>$row)
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$row->title}}</td>
                <td>{{$row->company_name}}</td>
                <td>{{$row->name}}</td>
                <td>{{date('d-M-Y', strtotime($row->date))}}</td>
                <td>{{$row->hold_seat}}</td>
                <td>@if(ucfirst(auth::user()->country) == 'India')
                <b>₹</b> {{intval($row->price_inr)}}
                @else
                {{intval($row->price_usd)}} $
                @endif
                </td>
                <td>@if(ucfirst(auth::user()->country) == 'India')
                <b>₹</b> {{intval($row->price_inr)*($row->hold_seat)}}
                @else
                {{intval($row->price_usd)*($row->hold_seat)}}$
                @endif
                </td>
                <td>
                  <div class="col-md-3 col-sm-3 col-3 mb-5">
                        <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="btnDropLeftOutline">
                        <a href="{{url('/departure/booking/history/details/'.$row->id)}}" class="dropdown-item">View Details</a> 
                        </div>
                        </div>
                 </div>
              </td>
                </tr>
                @endforeach
                @else 
                <tr>
                <td colspan="7">No Booking</td>
                </tr>
                @endif
                </tbody>
                </table>
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