@extends('layouts.app')
@section('headSection')
@section('title', 'Departure List')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
@endsection
@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection
<div class="layout-px-spacing">
   <div class="chat-section layout-top-spacing">
    <div class="widget-content widget-content-area br-6">
    <section class="content-header">
      <h1>View Departure
        <a href="{{route('departure_edit',$departure_details->id)}}" class="btn btn-info btn-sm pull-right ml-2">Edit Departure</a>
      </h1>
    </section>
    <section class="content">
          <div class="box box-primary">
           <div class="container">
           <div class="row">
             <!-- <div class="btn btn-info col-md-3 col-lg-3 col-sm-6   p-2 border">
             <h5 class="text-center">Total Units : {{$departure_details->total_seat}}</h5>
             </div>
             <div class="col-md-3 col-lg-3 col-sm-6 btn btn-success p-2 border">
             <h5 class="text-center">Booked Units : {{$book}}</h5>
             </div>
             <div class="col-md-3 col-lg-3 col-sm-6 btn btn-warning text-dark p-2 border">
             <h5 class="mr-5">Hold Units : {{$hold}}</h5>
             </div>
             <div class="col-md-3 col-lg-3 col-sm-6 btn btn-danger p-2 border">
             <h5 class="text-center">Available Unit : {{($departure_details->total_seat)-($hold + $book)}}</h5>
             </div> -->
            
            <div class="col-md-6 col-lg-6 col-sm-12 p-4">
             <div class="card component-card_4 p-2">
              <div class="card-body">
                <div class="user-info">
                    <h5 class="card-user_name font-weight-bold">Basic Dtails</h5>
                  <ul class="list-group ">
                    <li class="list-group-item"><b>Departure ID</b> : {{$departure_details->id}}</li>
                    <li class="list-group-item"><b>Departure Name</b> : {{$departure_details->title}}</li>
                    <li class="list-group-item"><b>Departure From</b>: {{$departure_details->from }}</li>
                    <li class="list-group-item"><b>Departure To</b>: {{$departure_details->ending_at}}</li>
                    <li class="list-group-item"><b>Destination (s) Covered</b> :
                     @foreach($departure_destination as $row)
                     {{$row->dest_name}} ({{$row->country_name}})&nbsp;
                     @endforeach
                    </li>
                    <li class="list-group-item"><b>No of Nights</b> : {{$departure_details->no_of_nights}}</li>
                  </ul>
                </div>
               </div>
             </div>

             <div class="card component-card_4 p-2"><h5 class="card-user_name font-weight-bold">Flight Details</h5>
              <div class="card-body">
                <div class="user-info">
                    <h6 class="card-user_name font-weight-bold">Originating Flight:</h6>
                  <ul class="list-group ">
                    <li class="list-group-item"><b>Airline</b> : {{$departure_details->flight}}</li>
                    <li class="list-group-item"><b>Flight No</b> : {{$departure_details->origin_flight_no}}</li>
                    <li class="list-group-item"><b>Date of Dep</b> : {{$departure_details->origin_flight_date}}</li>
                    <li class="list-group-item"><b>Departing Airport</b>: {{$departure_details->origin_flight_dep_airport }}</li>
                    <li class="list-group-item"> <b>Dep Time</b> : {{$departure_details->origin_flight_dep_time}}</li>
                    <li class="list-group-item"><b>Arriving Airport</b>: {{$departure_details->origin_flight_arriving_airport}}</li>
                    <li class="list-group-item"><b>Arrival Time</b>: {{$departure_details->origin_flight_arrival_time }}</li>
                  </ul>
                  <h6 class="card-user_name font-weight-bold"><br>Returning Flight:</h6>
                  <ul class="list-group ">
                    <li class="list-group-item"><b>Airline</b> : {{$departure_details->return_flight}}</li>
                    <li class="list-group-item"> <b>Flight No</b> : {{$departure_details->return_flight_no}}</li>
                    <li class="list-group-item"><b>Date of Dep</b> : {{$departure_details->return_flight_date}}</li>
                    <li class="list-group-item"><b>Dep Time</b> : {{$departure_details->return_flight_dep_time}}</li>
                    <li class="list-group-item"> <b>Departing Airport</b>: {{$departure_details->return_flight_dep_airport }}</li>
                    <li class="list-group-item"><b>Arriving Airport</b>: {{$departure_details->return_flight_arriving_airport}}</li>
                    <li class="list-group-item"><b>Arrival Time</b>: {{$departure_details->return_flight_arrival_time }}</li>
                  </ul>
                </div>
               </div>
             </div>

            </div>

            <div class="col-md-6 col-lg-6 col-sm-12 p-4">

            <div class="card component-card_4">
              <div class="card-body">
                <div class="user-info">
                 <h5 class="card-user_name"><b>Itineraries</b></h5>
                  <ul class="list-group ">
                  @if(isset($itinerary->title)) <li class="list-group-item"><b>Itinerary Finder Link</b> :<a href="//{{$itinerary->title}}" style="text-decoration:none">{{$itinerary->title}}</a> </li>@endif
                      <!-- <li class="list-group-item"><b>Description</b> : @if(isset($itinerary->description)){!! $itinerary->description !!}@endif</li> -->
                      @if(isset($itinerary->pdf_file))<li class="list-group-item"><b>PDF File</b> :<a href="{{ asset('agentitinerary') . '/' . $itinerary->pdf_file }}" download>Download</a></li>@endif
                  </ul>
                </div>
               </div>
             </div> 

            <div class="card component-card_4">
              <div class="card-body">
                <div class="user-info">
                 <h5 class="card-user_name"><b>Inclusions</b></h5>
                 <div class="table-responsive">
                        <table class="table table-bordered table-condensed mb-4">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Description</th> 
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($inclusion as $row)
                            <tr>
                              <td><b>{{$row->name}}</b></td>
                              <td>{{$row->description}}</td>
                            </tr>
                            @endforeach
                          </tbody>            
                        </table>
                 </div>
                </div>
               </div>
             </div>
             
             <div class="card component-card_4">
              <div class="card-body">
                <div class="user-info">
                 <h5 class="card-user_name"><b>Price</b></h5>
                  <ul class="list-group ">
                    <li class="list-group-item"><b>{{$departure_details->company_name}} Price(Per PAX):</b></li>
                    <!-- <li class="list-group-item"><b>Description</b> : {!! $itinerary->description !!}</li> -->
                    @if(ucfirst(auth::user()->country) == 'India')
                    <li class="list-group-item"><b>INR</b>  {{intval($departure_details->price_inr)}}</li>
                    @else
                    <li class="list-group-item"><b>USD</b>  {{intval($departure_details->price_usd)}}</li>
                    @endif

                    <li class="list-group-item"><b>Single Supplement Price(Per PAX):</b></li>
                    <!-- <li class="list-group-item"><b>Description</b> : {!! $itinerary->description !!}</li> -->
                    @if(ucfirst(auth::user()->country) == 'India')
                    <li class="list-group-item"><b>INR</b>  {{intval($departure_details->single_supplyment_price_inr)}}</li>
                    @else
                    <li class="list-group-item"><b>USD</b>  {{intval($departure_details->single_supplyment_price_inr)}}</li>
                    @endif
                  </ul>
                </div>
               </div>
             </div> 

            </div>
        
            </div>
           </div>
          </div>

          @if($hold !=0)
             <div class="col-md-12 col-lg-12 col-sm-12 p-3">
             <div class="card component-card_4 p-2">
             @if(session()->has('msg'))
            <div class="alert alert-success">
            {{ session()->get('msg') }}
           </div>
            @endif
              <div class="card-body">
                <div class="user-info">
                    <h5 class="card-user_name">Hold Dtails <a href="{{route('all_departure_hold_history')}}" class="btn btn-info btn-sm pull-right">All Hold</a></h5>
                    <div class="table-responsive">
                      <table class="table table-bordered mb-4">
                        <thead>
                          <tr>
                              <th>Company</th>
                              <th>Hold Unit</th>
                              <th>Auto Release</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($user_hold as $row)
                          <tr>
                             <td>{{$row->company_name}}</td>
                             <td>{{$row->hold_seat}} Unit</td>
                             <td>{{$row->date}}</td>
                             <td class="text-center">
                                      <div class="col-md-3 col-sm-3 col-3 mb-5">
                                        <div class="dropdown  custom-dropdown-icon">
                                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                          </a>
                                      <div class="dropdown-menu" aria-labelledby="btnDropLeftOutline">
                                        <a href="" data-id="{{ $row->id }}" class="dropdown-item disableDepartue">Release</a>
                                        <a href="{{url('/departure/hold/history/details/'.$row->id)}}" class="dropdown-item">View Details</a>
                                      </div>
                                      </div>
                                      </div>
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
            @endif




            @if(count($departure_book)> 0 )
             <div class="col-md-12 col-lg-12 col-sm-12 p-3">
             <div class="card component-card_4 p-2">
              <div class="card-body">
                <div class="user-info">
                    <h5 class="card-user_name">Booked Dtails <a href="{{route('all_departure_booking_history')}}" class="btn btn-info btn-sm pull-right">All Booking</a></h5>
                    <div class="table-responsive">
                      <table class="table table-bordered mb-4">
                      <table class="table table-bordered" id="booking">
                          <thead >
                          <tr>
                          <th>Sl.</th>
                          <th>Buyer Company</th>
                          <th>Buyer Name</th>
                          <th>Booking Date</th>
                          <th>Booking Units</th>
                          <th>Price(PAX)</th>
                          <th>Total Price</th>
                          <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($departure_book as $key=>$row)
                          <tr>
                          <td>{{$key+1}}</th>
                          <td>{{$row->company_name}}</td>
                          <td>{{$row->name}}</td>
                          <td>{{date('d-M-Y', strtotime($row->date))}}</td>
                          <td>{{$row->booked_seat}}</td>
                          <td>@if(ucfirst(auth::user()->country) == 'India')
                                  <b>₹</b>  {{intval($row->price_inr)}}
                                @else
                                {{intval($row->price_usd)}} $
                                @endif
                          </td>
                          <td>@if(ucfirst(auth::user()->country) == 'India')
                                  <b>₹</b>  {{intval($row->price_inr)*($row->booked_seat)}}
                                @else
                                {{intval($row->price_usd)*($row->booked_seat)}}$
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
                         
                        </tbody>
                     </table>
                   </div>
                </div>
               </div>
             </div>
            </div>
            @endif



            
           

</div>
</div>
</div>

  @endsection
  @section('footerSection')
  <script type="text/javascript">
    $(".disableDepartue").click(function () {
      if (confirm("Are you sure you want to release this Departure?"))
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      if(id){
      $.ajax({
        url: '/hold/departure/release/' + id,
        type: 'POST',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data) {
        window.location.reload();
        }
      });
      }
    });
  </script>
  @endsection