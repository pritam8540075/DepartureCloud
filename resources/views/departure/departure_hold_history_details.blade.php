
  
  @extends('layouts.app')
  @section('headSection')
  @section('title', 'Departure List')
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
  @endsection
  @section('content')
 
<div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
      <div class="widget-content widget-content-area br-6">
      <section class="content-header">
        <h1>Hold Details</h1>            
      </section>
                <div class="box box-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 p-4">
                        <div class="card component-card_4 p-2">
                                <div class="card-body">
                                <div class="user-info">
                                        <h5 class="card-user_name"><b>Departure Details</b></h5>
                                            <ul class="list-group ">
                                            <li class="list-group-item"><b>Departure ID</b> : {{ $departure->dep_id }}</li>
                                            <li class="list-group-item"><b>Departure Name</b> : {{$departure->title}}</li>
                                            <li class="list-group-item"><b>Departure From</b> : {{$departure->from }}</li>
                                            <li class="list-group-item"><b>Departure To</b> : {{$departure->ending_at }}</li>
                                            <li class="list-group-item"><b>Destination (s) Covered</b> :
                                            @foreach($destination as $row)
                                            {{$row->dest_name}}({{$row->country_name}}) &nbsp;
                                            @endforeach
                                            </li>
                                            <li class="list-group-item"><b>No of Nights</b> : {{$departure->no_of_nights}}</li>
                                            <li class="list-group-item"><b>Price(PAX)</b> :
                                                @if(ucfirst(auth::user()->country) == 'India')
                                                    @if(isset($departure->price_inr))
                                                        <b>₹</b>{{intval($departure->price_inr)}}
                                                    @endif
                                                @else
                                                        @if(isset($departure->price_usd))
                                                        {{intval($departure->price_usd)}} $
                                                        @endif
                                                @endif
                                            </li>
                                            <li class="list-group-item"><b>Single Supplement(PAX)</b> :
                                            @if(ucfirst(auth::user()->country) == 'India')
                                                    @if(isset($departure->price_inr))
                                                        <b>₹</b>{{intval($departure->single_supplyment_price_inr)}}
                                                    @endif
                                                @else
                                                        @if(isset($departure->price_usd))
                                                        {{intval($departure->single_supplyment_price_usd)}} $
                                                        @endif
                                                @endif
                                            </li>
                                           
                                            </ul>
                                </div>
                                </div>
                        </div>        
                        </div>


                        <div class="col-md-6 col-lg-6 col-sm-12 p-4">
                        <div class="card component-card_4 p-2">
                                <div class="card-body">
                                <div class="user-info">
                                        <h5 class="card-user_name"><b>Hold Details</b></h5>
                                            <ul class="list-group ">
                                            <li class="list-group-item"><b>Hold Unit</b> : {{$hold->hold_seat}}</li>
                                            <li class="list-group-item"><b>Extra Request Hold Unit</b> : {{$hold->extra_hold_seat}}</li>
                                            <li class="list-group-item"><b>Hold Date</b> : {{date('d-M-Y', strtotime($hold->date))}}</li>
                                            <li class="list-group-item"><b>Note</b> :@if(isset($hold->note)) {{($hold->note)}}@endif</li>
                                            </ul>
                                </div>
                                <div class="card-body">
                                <div class="user-info">
                                        <h5 class="card-user_name"><b>User Details</b></h5>
                                            <ul class="list-group ">
                                            <li class="list-group-item"><b>Company</b> : {{$user->company_name}}</li>
                                            <li class="list-group-item"><b>Name</b> : {{$user->name}}</li>
                                            <li class="list-group-item"><b>Contact</b> : {{$user->mobile}}</li>
                                            <li class="list-group-item"><b>Email</b> : {{$user->email}}</li>
                                            </ul>
                                </div>
                                <div>
                                
                                </div>
                        </div>        
                        </div>

                    </div>   
                </div>
                </div>

      </div>
    </div>
</div>  
  
 @endsection
@section('footerSection')
   
@endsection