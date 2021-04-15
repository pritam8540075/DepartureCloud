
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="table-responsive">
         
            <table id="departureTable" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Dep. ID</th>
                    <th>Dep. Name</th>
                    <th>Dep. From</th>
                    <th>Dep. To</th>
                    <th>Dep. Date</th>
                    <th>No of N/D</th>
                    <th>Total Units</th>
                    <th>Avl Units</th>
                    <th>Price(Per PAX)</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                    </thead>
                    <tbody>
            @if(count($departures)> 0 )
            @foreach( $departures as $key => $departure )
                <?php 
                  $hold_till = DB::table('hold_departures')->where('departure_id',$departure->id)->get();
                  if(count($hold_till)>0){
                  foreach($hold_till as $row){
                    if($row->departure_id == $departure->id){
                    $hold = $row->hold_till;
                    }
                    }
                      }else{
                          $hold = 0;
                      }
      
                      $today = date("Y-m-d");
                      $date1=date_create($today);
                      $date2=date_create($departure->start_date);
                      $diff=date_diff($date1,$date2);
                      $date = $diff->format("%R%a");
      
                      if(($hold < $date) && ($departure->available_seat > 0)){
                          $popup = '.bd-example-modal-sm';
                      }
                      else{
                          $popup = 0;
                      }
                      ?>
                  <tr>
                      <td>{{ $departure->dep_id }}</td>
                      <td><a href="{{route('all_departure_details',$departure->id)}}" style="text-decoration:none">{{$departure->title}}</a></td>
                      <td>{{$departure->from}}</td>
                      <td>{{$departure->ending_at}}</td>
                      <td>{{date('d-M-Y', strtotime($departure->start_date))}}</td>
                      <td>{{$departure->no_of_nights}}/{{$departure->no_of_days}}</td>
                      <td>{{$departure->total_seat}}</td>
                      <td>{{($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)}}</td>
                     
                      @if(ucfirst(auth::user()->country) == 'India')
                            @if(auth::user()->main_user_type == 2 )
                              <td>
                              ₹ {{intval($departure->price_inr)}}
                              </td>
                              @elseif(($departure->user_id) == (Auth::user()->id))
                              <td>₹ {{intval($departure->price_inr)}}</td>
                              @else
                             @foreach($departure->OtherPrice as $row)
                              <td>
                              {{$row->symbol_inr}} {{intval($row->price_inr)}}
                              </td>
                              @endforeach
                            @endif
                      @else
                           @if(auth::user()->main_user_type == 2 )
                              <td>
                              {{intval($departure->price_usd)}}
                              </td>
                              @elseif(($departure->user_id) == (Auth::user()->id))
                              <td>₹ {{intval($departure->price_usd)}}</td>
                              @else
                             @foreach($departure->OtherPrice as $row)
                              <td>
                              {{intval($row->price_usd)}} $
                              </td>
                              @endforeach
                            @endif
                      @endif
                     
                      @if((($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)) > 0) 
                           <td> <span class="badge badge-success text-uppercase font-weight-bold">Open</span></td>
                      @else
                            <td><span class="badge badge-danger text-uppercase font-weight-bold">SoldOut</span></td>      
                      @endif
                      </td>
                      <td>
                     
                      
                      <div class="col-md-3 col-sm-3 col-3 mb-5">
                         <div class="dropdown  custom-dropdown-icon">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="btnDropLeftOutline">
                              <a href="{{route('all_departure_details',$departure->id)}}" class="dropdown-item">View Departure </a>    
                              @if(Auth::user()->main_user_type==2)
                              <!-- <a href="" class="edit-item dropdown-item" data-toggle="modal" data-target="#edit-price" data-id="{{ $departure->id }}">Update Price</a>   -->
                              <a href="{{route('departure_edit',$departure->id)}}" class="dropdown-item">Edit Departure</a>  
                              <a href="" class="dropdown-item"  data-toggle="modal" data-target="@if(isset($popup)){{$popup}}{{$departure->id}} @endif">Hold Departure</a>
                              <a href="" class="dropdown-item"   data-toggle="modal" data-target="@if((($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)) > 0).bd-example-modal-sm{{$departure->id}}b @endif">Book Departure</a> 
                              <a href="{{url('/departure/booking/history/'.$departure->id)}}" class="dropdown-item">Booking History</a> 
                              @else
                              <a href="" class="dropdown-item"  data-toggle="modal" data-target="@if(isset($popup)){{$popup}}{{$departure->id}} @endif">Hold Departure</a>
                              <a href="" class="dropdown-item"   data-toggle="modal" data-target="@if((($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)) > 0).bd-example-modal-sm{{$departure->id}}b @endif">Book Departure</a>
                              @endif

                            </div>
                          </div>
                      </div> 
                      <!----Modal-->
                      <div class="modal fade bd-example-modal-sm{{$departure->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
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
                                            <input type="hidden" class="form-control"  value="{{($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)}}"  readonly>
                                          
                                           </div> 
                                           <div class="col-md-3 coi-lg-3 col-sm-12">
                                           <div class="form-group">
                                            <label for="exampleFormControlInput1">Avl Units</label>
                                            <input type="text" class="form-control" id="" name="available" value="{{($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)}}" name="available" readonly>
                                           </div>
                                           </div>
                                           <div class="col-md-5 coi-lg-5 col-sm-12">
                                           <div class="form-group">
                                             <input type="hidden" name="id" value="{{$departure->id}}">
                                             <input type="hidden" name="current_hours" value="{{date('H')}}">
                                             <input type="hidden" name="current_minutes" value="{{date('i')}}">
                                           <label for="formGroupExampleInput">Hold Duration</label>
                                           <input type="hidden" class="form-control" id="exampleFormControlSelect2" name="hours" value="{{$departure->hold_duration}}" readonly>
                                           <input type="text" class="form-control" id="exampleFormControlSelect2"  value="{{date('d-M-Y H:i', strtotime("+{$departure->hold_duration} hours"))}}" readonly>
                                           </div>
                                           </div>
                                           <div class="col-md-4 coi-lg-4 col-sm-12">
                                           <div class="form-group">
                                            <label for="exampleFormControlInput1">Required Units</label>
                                            <input type="number" class="form-control" id="check{{$departure->id}}" name="hold"  required>
                                           </div> 
                                           </div>
                                           <span class="text-danger" id="message{{$departure->id}}"></span>
                                           <div class="col-md-12 coi-lg-12 col-sm-12">
                                           <div class="form-group">
                                            <label for="exampleFormControlInput1">Note</option></label>
                                            <textarea name="note" class="form-control" required></textarea>
                                           </div> 
                                          </div>
                                          </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button class="btn btn-md" data-dismiss="modal" id=""><i class="flaticon-cancel-12"></i> Close</button>
                                            <button type="submit" class="btn btn-primary btn-md m-2">Hold Departure</button>
                                          </div>
                                            </form>
                                      </div>
                               </div>
                            </div>
                             <!----End Modal--> 
                             
                              
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table> 
            </div>
      <!-- Modal -->
      @if(Auth::user()->email_verified_at == false)     
       <div class="modal fade" id="myModal" role="dialog" style="">
         <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-body">
            
            
                      <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                       <div class="card-body">
                           @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                              {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                           @endif
                               {{ __('Before proceeding, please check your email for a verification link.') }}
                               {{ __('If you did not receive the email') }},
                             <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                              <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                             </form>
                        </div>
                      </div>
             </div>
           </div>
         </div>
       </div>
      @endif 

      @if(Auth::user()->email_verified_at == true && Auth::user()->verified == 0) 
      <div class="modal fade" id="myModal" role="dialog" style="">
         <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-body">
                      <h3 style="text-align:center"> You are not varified.<br>
                      <!-- <button type="button" class="btn btn-info btn-sm mt-4 mb-2" data-dismiss="modal">OK -->
                      <!-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="btn btn-info btn-sm mt-4 mb-2">
                        OK
                      </a>  -->
                      <!-- </button> -->
                      <a class="btn btn-info btn-sm mt-4 mb-2"  href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> OK </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                      </form>
                      </h3>
             </div>
           </div>
         </div>
       </div>
       @endif
                 
<!-- end Modal-->
        

</div>
<div class="box-footer clearfix text-right">
  
</div>
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

@section('footerSection')
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$('#myModal').modal({
    backdrop: 'static',
    keyboard: false  // to prevent closing with Esc button (if you want this too)
})
</script>
<script>
        $('#departureTable').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": " Text Search...",
               "sLengthMenu": "",
            },
            "stripeClasses": [],
            
            "pageLength": 10 
        });
</script>
   <script type="text/javascript">
     $('.edit-item').click(function(){
         var id = $(this).data("id");
         $('#editModal').modal('show');
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

@foreach( $departures as $row )


<?php         
     foreach($row->OtherPrice as $price){
    if(ucfirst(auth::user()->country) == 'India'){
      $value = intval($price->price_inr);
      $single_value=intval($row->single_supplyment_price_inr);
    }else{
      $value= intval($price->price_usd);
      $single_value=intval($row->single_supplyment_price_usd);
    }
  }             
?>

<!----Modal-->
<div class="modal fade bd-example-modal-sm{{$row->id}}b" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                  <label for="exampleFormControlInput1">Available Units<span style="position:absolute; right:10%">Price(PAX)</span></label>
                  <input type="text" class="form-control" id="" style="width:60%" name="available" value="{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}" readonly>
                  <span style="position:absolute; right:10%; top:15%">
                   @foreach($row->OtherPrice as $price)
                        @if(ucfirst(auth::user()->country) == 'India')
                        ₹ {{intval($price->price_inr)}}
                        @else
                          {{intval($price->price_usd)}} $
                        @endif
                    @endforeach
                    </span>
                  </div> 
                  <div class="form-group">
                  <input type="hidden" name="id" value="{{$row->id}}">
                  <label for="exampleFormControlInput1">Required Units</label>
                  <input type="number" class="form-control" style="width:60%" id="book{{$row->id}}" name="book" placeholder="" required>
                  <span style="position:absolute; right:10%; top:35%" id="required_pricebook{{$row->id}}"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Single Supplement 
                    @if(ucfirst(auth::user()->country) == 'India')
                    (INR {{intval($row->single_supplyment_price_inr)}})
                    @else
                    (USD {{intval($row->single_supplyment_price_usd)}})
                    @endif
                    </label>
                    <input type="checkbox" id="isAgeSelected{{$row->id}}"/>
                    <div id="txtAge{{$row->id}}" style="display:none">
                    <input type="number" style="width:60%" class="form-control" id="single_bookbook{{$row->id}}" name="single_book" placeholder="Required Units">
                    <span style="position:absolute; right:10%; top:55%" id="single_pricebook{{$row->id}}">
                    </span>
                    
                    </div>
                    </div>
                    <span style="position:absolute; right:22%; bottom:25%" id="msg">Total Price</span>
                    <span style="position:absolute; right:10%; bottom:25%" id="total_pricebook{{$row->id}}">
                    </span>
                  <div class="form-group">
                  <label for="exampleFormControlInput1">Note</label>
                  <textarea name="note" class="form-control" required></textarea>
                  </div> 
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" id=""><i class="flaticon-cancel-12"></i> Close</button>
                  <button type="submit" class="btn btn-primary">Book Departure</button>
                  </div>
                  </form>
            </div>
      </div>
  </div>
    <!----End Modal-->

<script>
$('#check{{$row->id}}').keyup(function(){
  var value = $(this).val();
  var total = '{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}';
  var subtotal = value-total;
  if($(this).val()>{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}){
    //alert('Your are Request ' +subtotal + ' Extra Departure');
   //$(this).val('')
   $("#message{{$row->id}}").text('Your are Request ' +subtotal+" Extra Departure");
  }
});

</script>
   
<script>
$('#book{{$row->id}}').keyup(function(){
  if($(this).val()>{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}){
    alert('Value can not be greater than {{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}');
    $(this).val('')
  }
});
$("#book{{$row->id}}").keyup(function () {
    var required = $("#book{{$row->id}}").val();
    var price = '{{$value}}'
    var sum = parseInt(required) * parseInt(price);

    var required1 = $("#single_bookbook{{$row->id}}").val();
    var price1 = '{{$single_value}}'
    var sum1 = parseInt(required1) * parseInt(price1);
    var total = sum+sum1;

    //alert(sum);
    $("#msg").html('Total')
    $("#required_pricebook{{$row->id}}").html(sum);

    $("#total_pricebook{{$row->id}}").html(sum);
})
$("#single_bookbook{{$row->id}}").keyup(function () {
    var required = $("#single_bookbook{{$row->id}}").val();
    var price = '{{$single_value}}'
    var sum = parseInt(required) * parseInt(price);
    //alert(sum);
    $("#single_pricebook{{$row->id}}").html(sum);

    var required1 = $("#book{{$row->id}}").val();
    var price1 = '{{$value}}'
    var sum1 = parseInt(required1) * parseInt(price1);
    var total = sum+sum1;
    $("#total_pricebook{{$row->id}}").html(total);
})
</script>
<script>
  // $(document).ready(function(){
  //   $("#1{{$row->id}}").click(function(){
  //     location.reload(true);
  //   });
  // });
  // $(document).ready(function(){
  //   $("#2{{$row->id}}").click(function(){
  //     location.reload(true);
  //   });
  // });
  // $(document).ready(function(){
  //   $("#3{{$row->id}}").click(function(){
  //     location.reload(true);
  //   });
  // });
  // $(document).ready(function(){
  //   $("#1{{$row->id}}").click(function(){
  //     location.reload(true);
  //   });
  // });
  
 
</script>
<script>
$('#isAgeSelected{{$row->id}}').click(function() {
    $("#txtAge{{$row->id}}").toggle(this.checked);
});
</script>
@endforeach

@endsection