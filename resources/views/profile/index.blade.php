@extends('layouts.app')

@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection

  <div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
      <div class="widget-content widget-content-area br-6">
                <div class="row layout-spacing">

                    <!-- Content -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 m-4 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                               
                                    <h2 class="mb-5">Company Profile
                                    <a href="{{route('edit_profile')}}" class="btn btn-info btn-sm pull-right"><i class="fa fa-edit"></i>Edit Profile</a>
                                    </h2>
                                    
                                
                                <div class=" user-info"> 
                                <div class="row">  
                                <div class="col-lg-6 col-mb-6 col-sm-12">
                                <ul class="list-group">
                                <li class="list-group-item"><b>Company ID</b> : {{Auth::user()->tenant_id}}</li>
                                <li class="list-group-item"><b>Company Name</b> : {{Auth::user()->company_name}}</li>
                                <li class="list-group-item"><b>Contact Name</b> : {{ucfirst(Auth::user()->name)}}</li>
                                </ul>
                                </div>
                                <div class="col-lg-6 col-mb-6 col-sm-12">
                                <ul class="list-group">
                                <div class="text-center user-info">
                                
                                    <img src="@if(isset(Auth::user()->logo)){{ asset('companyLogo/' . Auth::user()->logo) }} @else {{asset('images/no-image.png')}} @endif" alt="avatar" style="width:100px"><br>
                                    <li class="list-group-item">Website : <a href="{{Auth::user()->website}}" style="text-decoration:none">{{Auth::user()->website}}</a></li>
                               
                                </div>
                                </ul>
                                </div>
                                <div class="col-lg-6 col-mb-6 col-sm-12">
                                    <br>
                                <h4>Address</h4>
                                <ul class="list-group">
                                <!-- <li class="list-group-item"><b>Company No.</b> : {{Auth::user()->tenant_id}}</li> -->
                                <li class="list-group-item"><b>City</b> : {{ucfirst(Auth::user()->city)}}</li>
                                <li class="list-group-item"><b>State</b> : {{ucfirst(Auth::user()->state)}}</li>
                                <li class="list-group-item"><b>Country</b> : {{ucfirst(Auth::user()->country)}}</li>
                                <li class="list-group-item"><b>Pin</b> : {{Auth::user()->pin}}</li>
                                <li class="list-group-item"><b>Contact No.</b> : {{Auth::user()->mobile}}</li>
                                <li class="list-group-item"><b>Email Id</b> : {{Auth::user()->email}}</li>
                                </ul>
                                </div>
                                <div class="col-lg-6 col-mb-6 col-sm-12">
                                @if(count($user_destination)> 0)
                                <br> <h5>Destination (s) Covered :</h5>
                                @foreach($user_destination as $row)
                                <ul class="list-group">
                                <li class="list-group-item">{{$row->destination_name}}</li>
                                </ul>
                                @endforeach
                                @endif
                                </div>
                                </div>
                                </div>
                                <div class="user-info-list">

                                    <!-- <div class="">
                                        <ul class="contacts-block list-unstyled">
                                      
                                         
                                            <li class="contacts-block__item">
                                                <br><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{Auth::user()->email}}</a>
                                            </li>
                                            <li class="contacts-block__item">
                                                <br><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> {{Auth::user()->mobile}}
                                            </li>
                                     
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>                                     -->
                                </div>
                            </div>
                        </div>

                    

                            
                         
                        </div>

                        <div class="work-experience layout-spacing ">
                    </div>


                </div>
       </div>
    </div>
</div>


@if(session('message'))
      <div class="modal fade" id="myModal" role="dialog" style="">
        <div class="modal-dialog modal-sm" >
          <div class="modal-content">
            <div class="modal-body text-center">
              <h5>{{session('message')}}</h5>
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
@endsection