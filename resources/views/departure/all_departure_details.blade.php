<?php
 
    if(ucfirst(auth::user()->country) == 'India'){
            if(isset($price2->price_inr)){
              $value = intval($price2->price_inr);
            }else{
              $value = intval($departure_details->price_inr);
            }
          $single_value=intval($departure_details->single_supplyment_price_inr);
    }else{
      if(isset($price2->price_usd)){
        $value = intval($price2->price_usd);
      }else{
        $value = intval($departure_details->price_use);
      }
      $single_value= intval($departure_details->single_supplyment_price_usd);
    }
?>
  
  @extends('layouts.app')
  @section('headSection')
  @section('title', 'Departure List')
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
  @endsection
  @section('content')
  @section('headnav') 
  <!-- <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{route('departure')}}"> Departure </li>
  <li class="breadcrumb-item active" aria-current="page"><span> / Details</span></li> -->
  @include('layouts.topnav')
  @endsection
  <div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
      <div class="widget-content widget-content-area br-6">
      <section class="content-header">
        <h1>View Departure
         <!-- <a href="" class="btn btn-primary pull-right"  data-toggle="modal" data-target=" @if(($hold) < ($date) && (($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum)) != 0 )#hold @endif">Hold Departure</a> -->
         @if(auth::user()->main_user_type==2)
            @if($departure_details->start_date >= date('Y-m-d'))
             <a href="{{url('/departure/basic-detail/edit/'.$departure_details->id)}}"class="btn btn-info btn-sm pull-right ml-2">Edit Departure</a>
            @endif
            @if($departure_details->approve == 1)
            <a href=""class="btn btn-info btn-sm pull-right ml-2"   data-toggle="modal" data-target="@if((($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)) > 0).bd-example-modal-sm{{$departure_details->id}} @endif">Book Departure</a>
             <a href=""class="btn btn-info btn-sm pull-right ml-2"   data-toggle="modal" data-target="@if((($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)) > 0).bd-example-modal-sm @endif">Hold Departure</a>
            @endif
          @else
          <a href=""class="btn btn-info btn-sm pull-right ml-2"   data-toggle="modal" data-target="@if((($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)) > 0).bd-example-modal-sm{{$departure_details->id}} @endif">Book Departure</a>
          <a href=""class="btn btn-info btn-sm pull-right"   data-toggle="modal" data-target="@if((($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)) > 0).bd-example-modal-sm @endif">Hold Departure</a>
          @endif
        </h1>            
      </section>
      <section class="content">
            <div class="box box-primary">
             <div class="container">
             <div class="row">
              <div class="col-md-6 col-lg-6 col-sm-12 p-4">
               <div class="card component-card_4 p-2">
                <div class="card-body">
                  <div class="user-info">
                      <h5 class="card-user_name"><b>Basic Dtails</b></h5>
                    <ul class="list-group ">
                      <li class="list-group-item"><b>Departure ID</b> : {{ $departure_details->dep_id }}</li>
                      <li class="list-group-item"><b>Departure Name</b> : {{$departure_details->title}}</li>
                      <li class="list-group-item"><b>Departure From</b> : {{$departure_details->from }}</li>
                      <li class="list-group-item"><b>Departure To</b> : {{$departure_details->ending_at }}</li>
                      <li class="list-group-item"><b>Destination (s) Covered</b> :
                       @foreach($departure_destination as $row)
                       {{$row->dest_name}}({{$row->country_name}}) &nbsp;
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
                      <li class="list-group-item"> <b>Flight No</b> : {{$departure_details->origin_flight_no}}</li>
                      <li class="list-group-item"><b>Date of Dep</b> : {{$departure_details->origin_flight_date}}</li>
                      <li class="list-group-item"><b>Departing Airport</b>: {{$departure_details->origin_flight_dep_airport }}</li>
                      <li class="list-group-item"><b>Dep Time</b> : {{$departure_details->origin_flight_dep_time}}</li>
                      <li class="list-group-item"><b>Arriving Airport</b>: {{$departure_details->origin_flight_arriving_airport}}</li>
                      <li class="list-group-item"><b>Arrival Time</b>: {{$departure_details->origin_flight_arrival_time }}</li>
                    </ul>
                    <h6 class="card-user_name font-weight-bold"><br>Returning Flight:</h6>
                    <ul class="list-group ">
                      <li class="list-group-item"><b>Airline</b> : {{$departure_details->return_flight}}</li>
                      <li class="list-group-item"><b>Flight No</b> : {{$departure_details->return_flight_no}}</li>
                      <li class="list-group-item"><b>Date of Dep</b> : {{$departure_details->return_flight_date}}</li>
                      <li class="list-group-item"><b>Departing Airport</b>: {{$departure_details->return_flight_dep_airport }}</li>
                      <li class="list-group-item"> <b>Dep Time</b> : {{$departure_details->return_flight_dep_time}}</li>
                      <li class="list-group-item"><b>Arriving Airport</b>: {{$departure_details->return_flight_arriving_airport}}</li>
                      <li class="list-group-item"><b>Arrival Time</b>: {{$departure_details->return_flight_arrival_time }}</li>
                    </ul>
                  </div>
                 </div>
               </div>
              </div>

              <div class="col-md-6 col-lg-6 col-sm-12 p-4">
               <div class="card component-card_4 p-2">
                <div class="card-body">
                  <div class="user-info">
                   <h5 class="card-user_name">Itineraries</h5>
                    <ul class="list-group ">
                    @if(isset($itinerary->title)) <li class="list-group-item"><b>Itinerary Finder Link:</b><a href="//{{$itinerary->title}}" style="text-decoration:none">{{$itinerary->title}}</a> </li>@endif
                      <!-- <li class="list-group-item"><b>Description</b> : @if(isset($itinerary->description)){!! $itinerary->description !!}@endif</li> -->
                      @if(isset($itinerary->pdf_file))<li class="list-group-item"><b>PDF File</b> :<a href="{{ asset('agentitinerary') . '/' . $itinerary->pdf_file }}" download>Download</a></li>@endif
                    </ul>
                  </div>
                 </div>
               </div>

               <div class="card component-card_4">
                <div class="card-body">
                  <div class="user-info">
                   <h5 class="card-user_name">Inclusions</h5>
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
                                <td>{{$row->name}}</td>
                                <td>{{$row->description}}</td>
                              </tr>
                              @endforeach
                            </tbody>            
                          </table>
                        </div>
                  </div>
                 </div>
               </div>
           
            @if(Auth::user()->main_user_type == 2)
              <div class="card component-card_4">
                <div class="card-body">
                  <div class="user-info">
                   <h5 class="card-user_name"><b>Price List</b>
                   @if($departure_details->start_date >= date('Y-m-d'))
                     <a href="" class="edit-item btn btn-info btn-sm pull-right ml-2" data-toggle="modal" data-target="#edit-price" data-id="{{$departure_details->id}}">Update Price</a>
                   @endif
                   </h5>
                   <ul class="list-group ">
                      <li class="list-group-item"><b>Price from Tenant(Per PAX)</b> : ₹ {{$departure_details->price_inr}}<br> {{$departure_details->price_usd}}$</li>
                      <li class="list-group-item"><b>Single Supplement Price (Per PAX):</b></li>
                    
                    @if(ucfirst(auth::user()->country) == 'India')
                    <li class="list-group-item"><b>INR</b>  {{intval($departure_details->single_supplyment_price_inr)}}</li>
                    @else
                    <li class="list-group-item"><b>USD</b>  {{intval($departure_details->single_supplyment_price_inr)}}</li>
                    @endif                   
                   </ul>
                   
                   <ul class="list-group ">
                      <li class="list-group-item"><b>Price For Agent Conect(Per PAX)</b> : @if(isset($price->price_inr)||isset($price_usd)) {{$price->symbol_inr}} {{intval($price->price_inr)}} <br> {{intval($price->price_usd)}} {{$price->symbol_usd}}@endif</li>
                      <li class="list-group-item"><b>Price For Dook International(Per PAX)</b> : @if(isset($price->price_inr)||isset($price_usd)){{$price1->symbol_inr}} {{intval($price1->price_inr)}}<br>  {{intval($price1->price_usd)}} {{$price1->symbol_usd}}@endif</li>
                      <li class="list-group-item"><b>Price For Other Agents(Per PAX)</b> :@if(isset($price->price_inr)||isset($price_usd)){{$price2->symbol_inr}} {{intval($price2->price_inr)}}<br>  {{intval($price2->price_usd)}}{{$price2->symbol_usd}}@endif</li>
                   </ul>  

                  </div>
                 </div>
               </div>
              </div>
              @elseif(Auth::user()->main_user_type == 1)
              <?php
              $compaire = DB::table('departures')->where('user_id',Auth::user()->id)->where('id',$departure_details->id)->first(); 
              ?>
              @if($compaire)
              <div class="card component-card_4">
                <div class="card-body">
                  <div class="user-info">
                   <ul class="list-group ">
                      @if(ucfirst(auth::user()->country) == 'India')
                      <li class="list-group-item"><b>{{$departure_details->company_name}} Price(PAX):</b>
                      <b>₹</b>  {{intval($departure_details->price_inr)}} 
                      </li>
                      @else
                      <li class="list-group-item">
                      <b>USD</b> :  {{intval($departure_details->price_usd)}}
                      </li>
                      @endif
                      
                    <!-- <li class="list-group-item"><b>Description</b> : {!! $itinerary->description !!}</li> -->
                    <li class="list-group-item"><b>Single Supplement Price (Per PAX):</b>
                    @if(ucfirst(auth::user()->country) == 'India')
                      <b>₹</b>  {{intval($departure_details->single_supplyment_price_inr)}}
                    @else
                    {{intval($departure_details->single_supplyment_price_usd)}} $
                    @endif
                    </li>
                   </ul>
                   
                  
                  </div>
                 </div>
               </div>
              </div>
                
              @else
              <div class="card component-card_4">
                <div class="card-body">
                  <div class="user-info">
                   <h5 class="card-user_name"><b>DOOK INTERNATIONAL Price (Per PAX):</b></h5>
                   <ul class="list-group ">
                      <li class="list-group-item">  
                        @if(isset($price2->price_inr) || isset($price2->price_usd))
                            @if(ucfirst(auth::user()->country) == 'India')
                            <b>INR</b> :{{intval($price2->price_inr)}}
                            @else
                            <b>USD</b> {{intval($price2->price_usd)}}
                            @endif
                        @else 
                            @if(ucfirst(auth::user()->country) == 'India')
                            <b>INR</b> :{{intval($departure_details->price_inr)}} 
                            @else
                            <b>USD</b> :  {{intval($departure_details->price_usd)}}
                            @endif
                        @endif
                      </li>
                   </ul>
                  </div>
                 </div>
               </div>
              </div>
              @endif
              @else
              <div class="card component-card_4">
                <div class="card-body">
                  <div class="user-info">
                   <h5 class="card-user_name"><b>DOOK INTERNATIONAL Price (Per PAX):</b></h5>
                   <ul class="list-group ">
                      <li class="list-group-item">  
                        @if(isset($price2->price_inr) || isset($price2->price_usd))
                            @if(ucfirst(auth::user()->country) == 'India')
                            <b>INR</b> :{{intval($price2->price_inr)}}
                            @else
                            <b>USD</b> {{intval($price2->price_usd)}}
                            @endif
                        
                        @endif
                      </li>
                   </ul>
                  </div>
                 </div>
               </div>
              </div>
             @endif
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
                    <h5 class="card-user_name">Hold Dtails  <a href="{{route('all_departure_hold_history')}}" class="btn btn-info btn-sm pull-right">All Hold</a></h5>
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
                             <td>{{date('d-M-Y', strtotime("+{$row->date}"))}}</td>
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
            </div>

            @if(count($departure_book)> 0 )
             <div class="col-md-12 col-lg-12 col-sm-12 p-3">
             <div class="card component-card_4 p-2">
              <div class="card-body">
                <div class="user-info">
                    <h5 class="card-user_name">Booked Dtails  <a href="{{route('all_departure_booking_history')}}" class="btn btn-info btn-sm pull-right">All Booking</a></h5>
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
                                    <a href="{{url('/departure/booking/history/details/'.$row->id)}}" class="dropdown-item">More Details</a> 
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



          @if(session('success'))
      <div class="modal fade" id="myModal" role="dialog" style="">
        <div class="modal-dialog modal-sm" >
          <div class="modal-content">
            <div class="modal-body text-center">
              <h3>{{session('success')}}</h3>
              <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Ok</button>
            </div>
          </div>
        </div>
      </div>
      @endif

    </div>
   </div>   
 <!--  </div>
  </div>  -->
           <!----Modal-->
             <div class="modal fade bd-example-modal-sm" id="hold" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-mb" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="mySmallModalLabel">Hold Departure</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="">
                                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                 </button>
                                            </div>
                                            
                                            <form action="{{route('departure_holdduration')}}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                            <div class="row">
                                            <div class="form-group">
                                              <!-- <label for="exampleFormControlInput1">Available Seat</label> -->
                                              <input type="hidden" class="form-control"  value="{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}" readonly>
                                            
                                             </div> 
                                             <div class="col-md-3 col-lg-3 col-sm-12">
                                             <div class="form-group">
                                              <label for="exampleFormControlInput1">Avl. Units</label>
                                              <input type="text" class="form-control" id="" name="available" value="{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}" readonly>
                                             </div>
                                             </div>
                                             <div class="col-md-5 col-lg-5 col-sm-12">
                                             <div class="form-group">
                                               <input type="hidden" name="id" value="{{$departure_details->id}}">
                                               <input type="hidden" name="current_hours" value="{{date('H')}}">
                                               <input type="hidden" name="current_minutes" value="{{date('i')}}">
                                             <label for="formGroupExampleInput">Hold Duration</label>
                                             <input type="hidden" class="form-control" id="exampleFormControlSelect2" name="hours" value="{{$departure_details->hold_duration}}" readonly>
                                             <input type="text" class="form-control" id="exampleFormControlSelect2"  value="{{date('d-M-Y H:i', strtotime("+{$departure_details->hold_duration} hours"))}}" readonly>
                                             </div>
                                             </div>
                                             <div class="col-md-4 col-lg-4 col-sm-12">
                                             <div class="form-group">
                                              <label for="exampleFormControlInput1">Required Units</label>
                                              <input type="number" class="form-control" id="hold{{$departure_details->id}}" name="hold"  required>
                                             </div>
                                             </div>
                                             <span id="message" class="text-danger"></span>
                                             <div class="col-md-12 col-lg-12 col-sm-12">
                                             <div class="form-group">
                                              <label for="exampleFormControlInput1">Note</option></label>
                                              <textarea name="note" class="form-control" required></textarea>
                                             </div> 
                                             </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button class="btn btn-sm p-2" data-dismiss="modal" id=""><i class="flaticon-cancel-12"></i> Close</button>
                                              <button type="submit" class="btn btn-primary btn-sm p-2">Hold Departure</button>
                                            </div>
                                            </div>
                                              </form>
                                        </div>
                                 </div>
                              </div>
                               <!----End Modal--> 
                               
                                <!----Modal-->
                                <div class="modal fade bd-example-modal-sm{{$departure_details->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-mb" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="mySmallModalLabel">Book Departure</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="">
                                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                 </button>
                                            </div>
                                            
                                            <form action="{{route('departure_book')}}" method="post">
                                            @csrf
                                            <div class="modal-body"> 
                                            <div class="form-group">
                                              <label for="exampleFormControlInput1">Available Units <span style="position:absolute; right:10%">Price(Per PAX)</span></label>
                                              <input type="text" style="width:60%" class="form-control" id="" name="available" value="{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}" readonly>
                                              <span style="position:absolute; right:10%; top:15%">
                                                @if(ucfirst(auth::user()->country) == 'India')
                                                    @if(isset($price2->price_inr))
                                                        {{intval($price2->price_inr)}}
                                                    @else
                                                      $value = intval($departure_details->price_inr)
                                                    @endif
                                                @else
                                                    @if(isset($price2->price_usd))
                                                          {{intval($price2->price_usd)}}
                                                    @else
                                                          {{intval($departure_details->price_use)}}
                                                    @endif
                                                @endif
                                              </span>
                                             </div> 
                                             <div class="form-group">
                                             <input type="hidden" name="id" value="{{$departure_details->id}}">
                                              <label for="exampleFormControlInput1">Required Units</label>
                                              <input type="number" style="width:60%" class="form-control" id="book" name="book" placeholder="Required Units" required>
                                              <span style="position:absolute; right:10%; top:35%" id="required_price">
                                              </span>
                                             </div>
                                             <div class="form-group">
                                              <label for="exampleFormControlInput1">Single supplyment 
                                              @if(ucfirst(auth::user()->country) == 'India')
                                              (INR {{intval($departure_details->single_supplyment_price_inr)}})
                                              @else
                                              (USD {{intval($departure_details->single_supplyment_price_usd)}})
                                              @endif
                                              </label> <input type="checkbox" id="isAgeSelected"/>
                                              <div id="txtAge" style="display:none">
                                              <input type="number" style="width:60%" class="form-control" id="single_book" name="single_book" placeholder="Required Units" style="display:none;" value="0">
                                              <span style="position:absolute; right:10%; top:55%" id="single_price">
                                              </span>
                                              </div>
                                             </div>
                                             <span style="position:absolute; right:22%; bottom:25%">Total Price</span>
                                              <span style="position:absolute; right:10%; bottom:25%" id="total_price">
                                              </span>
                                             <div class="form-group">
                                              <label for="exampleFormControlInput1">Note</label>
                                              <textarea name="note" class="form-control" required></textarea>
                                             </div> 
                                            </div>
                                            <div class="modal-footer">
                                              <button class="btn btn-sm p-2" data-dismiss="modal" id=""><i class="flaticon-cancel-12"></i>Close</button>
                                              <button type="submit" class="btn btn-primary btn-sm p-2">Book Departure</button>
                                              </div>
                                              </form>
                                        </div>
                                 </div>
                              </div>
                               <!----End Modal-->
              <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <form method="post" name="myEditForm" enctype="multipart/form-data" class="form-inline" id="myEditForm">
                    @csrf
                    <div class="modal-dialog modal-sm" role="document" style="width: 65%">
                        <div class="modal-content">
                            <div class="modal-header">
                              <span class="inlineFlax"><h5 class="modal-title" id="exampleModalLabel">Update Pricing</h5></span>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <div class="itinerary-setup m-t-20">
                                <input type="hidden" name="edit_id" id="edit_id">
                                <div id="pricingModule">
                                  
                                </div>
                              </div>
                            <div class="modal-footer">
                                <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="edit_send_form"><i class="fa fa-save"></i> Update</button>
                                <img src="{{ asset('images/loader.gif') }}" id="gif" style="width: 5%; display: none;">
                                <span id="mesegess"></span>
                            </div>
                        </div>
                    </div>
                </form>
              </div>

      @if(session('success'))
      <div class="modal fade" id="myModal" role="dialog" style="">
           <div class="modal-dialog modal-sm" >
            <div class="modal-content">
              <div class="modal-body text-center">
              <h3>{{session('success')}}</h3>
              <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Ok</button>
               </div>
             </div>
           </div>
         </div>
      @endif
    @endsection
@section('footerSection')
    <script>
  $('#myModal').modal({
      backdrop: 'static',
      keyboard: false  // to prevent closing with Esc button (if you want this too)
  })
  </script>
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
    <script>
      // $('#book').keyup(function(){
      //     var value = $(this).val();
      //     var total = '{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}';
      //     if($(this).val()>{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}){
      //       alert('Value can not be greater than '  +total+ );
      //     }
      //   });
        </script>
        <script>
             $('#book').keyup(function(){
              if($(this).val()>{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}){
                alert('Value can not be greater than {{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}');
                $(this).val('')
              }
            });
        </script>
    
        <script>
        $("#book").keyup(function () {
            var required = $("#book").val();
            var price = '{{$value}}';
            var price1 = '{{$single_value}}';
            var required1 = $("#single_book").val();
            if(required){
            
                var sum = parseInt(required) * parseInt(price);
                var sum1 = parseInt(required1) * parseInt(price1);
                var total = sum+sum1;
                $("#required_price").html(sum);
                $("#total_price").html(total);
            }
            else{
              var sum = 0;
                var sum1 = parseInt(required1) * parseInt(price1);
                var total = sum+sum1;
                $("#required_price").html(sum);
                $("#total_price").html(total);
            }
        });
          $("#single_book").keyup(function () {
            var required = $("#single_book").val();
              var price = '{{$single_value}}'
              var sum = parseInt(required) * parseInt(price);
              //alert(sum);
              $("#single_price").html(sum);

              var required1 = $("#book").val();
              var price1 = '{{$value}}'
              var sum1 = parseInt(required1) * parseInt(price1);
              var total = sum+sum1;
              $("#total_price").html(total);
          });
</script>
<script>
$('#hold{{$departure_details->id}}').keyup(function(){
  var value = $(this).val();
  var total = '{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}';
  var subtotal = value-total;
  if($(this).val()>{{($departure_details->total_seat)-($departure_details->hold_sum + $departure_details->book_sum + $departure_details->single_book_sum)}}){
    //alert('Your are Request ' +subtotal  + 'Extra Departure');

    $("#message").text('Your are Request ' +subtotal+" Extra Departure");
   //$(this).val('')
  }
});
</script>


<script>
 $('.edit-item').click(function(){
   $("#pricingModule").html('');
   var id = $(this).data("id");
   $('#editModal').modal('show');
   if(id){
     $('#edit_id').val(id);
       $.ajax({
          type:"GET",
          url:"{{url('/get_pricing_ajax')}}?departure_id="+id,
          success:function(res){
           if(res && res.length > 0){  
             var html = '';
                 for(data of res){
                   if(data.pricing && data.pricing.price_inr){
                     var priceInr = data.pricing.price_inr?data.pricing.price_inr:'';
                     var priceUsd = data.pricing.price_usd?data.pricing.price_usd:'';
                   }else{
                     var priceInr = '';
                     var priceUsd = '';
                   }
                   html+='<div class="row"><div class="col-md-12 col-lg-12 col-xl-12 pl-4" style="marg><label class="labelClass">'+data.type+' ('+data.name+')</label><span class="validationError days_error" id="error_price_inr_'+data.id+'"></span><div class="form-group"><div class="row"><div class="col-md-1 col-lg-1 col-xl-1"><input type="text" class="form-control" name="symbol_inr['+data.id+']" value="'+data.symbol_inr+'" readonly><input type="hidden" class="form-control" name="price_type_id[]" value="'+data.id+'"></div><div class="col-md-2 col-lg-2 col-xl-2"><input type="text" class="form-control" name="price_inr['+data.id+']" id="price_inr_'+data.id+'" value="'+priceInr+'"></div></div><div class="row"><div class="col-md-1 col-lg-1 col-xl-1"><input type="text" class="form-control" name="symbol_usd['+data.id+']" value="'+data.symbol_usd+'" readonly></div><div class="col-md-2 col-lg-2 col-xl-2"><input type="text" class="form-control" name="price_usd['+data.id+']" id="price_usd_'+data.id+'" value="'+priceUsd+'"></div></div></div></div></div>';
                 }  
                 $("#pricingModule").html(html);

           }else{
              $("#pricingModule").empty();
           }
          }
       });
   }else{
       $("#pricingModule").empty();
   }
 })    
</script>
<script type="text/javascript">
 $(document).ready(function () {
   $('#edit_send_form').click(function (e) {
     e.preventDefault();
     $('#gif').show();
     var price_inr_1 = $('#price_inr_1').val();
     if (price_inr_1 == "") {
         $("span#error_price_inr_1").html('This field is required!');
         $("input#price_inr_1").focus();
         return false;
     }

     $('#gif').css('visibility', 'visible');
     var formDatas = new FormData(document.getElementById('myEditForm'));
     $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       method: 'POST',
       url: "{{ route('price_update') }}",
       data: formDatas,
       contentType: false,
       processData: false,
       success: function (data) {
         $('#gif').hide();
         $('#mesegese').html("<span class='sussecmsg'>Price has been updated successfully!</span>");
         //location.reload();
       },
       statusCode:{
         504:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         500:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         502:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         400:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Bad request please try again later!</span>");
         },
         422:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         404:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Not Found please try again later!</span>");
         },
         401:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Not authorized wrong please try again later!</span>");
         }
       },
       errors: function () {
         $('#gif').hide();
         $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
       }
     });
   });
 });
</script>
<script type="text/javascript">
 $(document).ready(function () {
   $('#edit_send_form').click(function (e) {
     e.preventDefault();
     $('#gif').show();
     var price_inr_1 = $('#price_inr_1').val();
     if (price_inr_1 == "") {
         $("span#error_price_inr_1").html('This field is required!');
         $("input#price_inr_1").focus();
         return false;
     }

     $('#gif').css('visibility', 'visible');
     var formDatas = new FormData(document.getElementById('myEditForm'));
     $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       method: 'POST',
       url: "{{ route('price_update') }}",
       data: formDatas,
       contentType: false,
       processData: false,
       success: function (data) {
         $('#gif').hide();
         $('#mesegese').html("<span class='sussecmsg'>Price has been updated successfully!</span>");
         //location.reload();
       },
       statusCode:{
         504:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         500:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         502:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         400:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Bad request please try again later!</span>");
         },
         422:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
         },
         404:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Not Found please try again later!</span>");
         },
         401:function(){
           $('#gif').hide();
           $('#mesegese').html("<span class='sussecmsg'>Not authorized wrong please try again later!</span>");
         }
       },
       errors: function () {
         $('#gif').hide();
         $('#mesegese').html("<span class='sussecmsg'>Something went wrong please try again later!</span>");
       }
     });
   });
 });
</script>
<script>
$('#isAgeSelected').click(function() {
    $("#txtAge").toggle(this.checked);
});
</script>
@endsection