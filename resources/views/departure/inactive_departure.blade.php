@extends('layouts.app')

@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection

            <div class="layout-px-spacing">
             <div class="chat-section layout-top-spacing">
              <div class="widget-content widget-content-area br-6">
               <div class="table-responsive mb-4 mt-4">
               <h1>Inactive Deparute(Expaire) <span class="btn btn-info btn-sm pull-right">Total Inactive <span style="color:#ffeb00">{{$inactive}}</span></span></h1>
               <table id="departureListData" class="table table-bordered">
                 <thead>
                  <tr>
                    <th style="width: 5%">Dep. Id</th>
                    <th style="width: 30%">Name of Departure</th>
                    <!-- <th style="width: 5%">Destination</th> -->
                    <th style="width: 5%">Departure Date</th>
                    <th style="width: 5%">Nights/Days</th>
                    <th style="width: 20%">Departure From</th>
                    <th style="width: 5%">Departure To</th>
                    <th style="width: 5%">Total Units</th>
                    <th style="width: 5%">Avalable units</th>
                    <!-- <th style="width: 5%">Update Price</th> -->
                    <th style="width: 5%">Status</th>
                    <th style="width: 5%">Action</th>
                  </tr>
                </thead>
                </tbody>
                 @if(count($departures)> 0 )
                  @foreach( $departures as $key => $departure )
                    <tr>
                      <td>{{ $departure->dep_id }}</td>
                      <td>{{$departure->title}}</td>
                      
                      <td>
                      {{date('d-M-Y', strtotime($departure->start_date))}}
                      </td>
                      <td>{{$departure->no_of_nights}}N/{{$departure->no_of_days}}D</td>
                      <td>{{$departure->from}}</td>
                      <td>{{$departure->ending_at}}</td>
                      <td>{{$departure->total_seat}}</td>
                      <td>{{$departure->total_seat}}</td>
                      
                      <!-- <td><a data-toggle="modal" data-target="#edit-price" data-id="{{ $departure->id }}" class="edit-item" title="Update Price" style="margin-left: 5px;cursor: pointer;">Update Price</a></td> -->
                      <td>
                      <a class="badge badge-danger text-light" data-id="{{ $departure->id }}" data-status="{{ $departure->approve }}" style="cursor: pointer; color: #2f8263;">Inactive
                      </a>
                      </td>
                      <td>
                      <div class="col-md-3 col-sm-3 col-3 mb-5">
                         <div class="dropdown  custom-dropdown-icon">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="btnDropLeftOutline">
                            <a href="{{route('all_departure_details',$departure->id)}}" class="dropdown-item">View Departure</a>
                              <!-- <a href="{{route('departure_edit',$departure->id)}}" class="dropdown-item">Edit Departure</a> -->
                              <!-- <a href="" class="edit-item dropdown-item" data-toggle="modal" data-target="#edit-price" data-id="{{ $departure->id }}">Update Price</a>   -->
                            </div>
                          </div>
                      </div> 
                      </td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
                </table>   
               </div>
               </div>
               </div>
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
                   <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" style="background:#dc3545">Close</button>
                   <button type="submit" class="btn btn-primary btn-sm" id="edit_send_form"><i class="fa fa-save"></i> Update</button>
                   <img src="{{ asset('images/loader.gif') }}" id="gif" style="width: 5%; display: none;">
                   <span id="mesegess"></span>
               </div>
           </div>
       </div>
   </form>
 </div>
@endsection
@section('footerSection')
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
  $(".disableDepartue").click(function () {
    if (confirm("Are you sure you want to approve this departure?"))
    var id = $(this).data("id");
    var status = $(this).data("status");
    var flag = (status == 1)?'Unapproved':'Approved';
    var token = $("meta[name='csrf-token']").attr("content");
    if(id){
    $.ajax({
      url: '/departure-approve/' + id,
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
        $('#departureListData').DataTable({
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