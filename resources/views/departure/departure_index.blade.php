
@extends('layouts.app')
@section('headSection')
@section('title', 'Departure Edit')
@endsection
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection
  <div class="layout-px-spacing">
  <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
     <div class="widget-content widget-content-area br-6">
        <div class="table-responsive mb-4 mt-4">
     <div class="content-wrapper">
     <section class="content-header">
              <h1>My Departures
              <span class="btn btn-info btn-sm">Total Departure <span style="color:#ffeb00">{{$total}}</span> </span>
              <!-- <span class="btn btn-info btn-sm">Total Active <span style="color:#ffeb00">{{$active}}</span></span>
              <span class="btn btn-info btn-sm">Total Pending <span style="color:#ffeb00">{{$pending}}</span></span>
              <span class="btn btn-info btn-sm">Total Inactive <span style="color:#ffeb00">{{$inactive}}</span></span> -->
              <a class="btn btn-primary" href="{{route('departure_create')}}" style="position:absolute; right:1%">Add New Departure</a>
              </h1>
     </section>

    
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

    
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              

              <!-- <span class="display"><b style="margin: 5px 5px 0px 10px;">Filter by Date </b> 
              <form action="{{route('departure')}}" method="get" style="display: inline-flex;">
                
                <div class="input-group date" style="margin-right:5px">
                    <input type="date" class="form-control pull-right" name="from" id="from_date" placeholder="From date" autocomplete="off" value="{{$from_date}}">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar start-calendar"></i>
                    </div>
                </div>
                <div class="input-group date">
                    <input type="date" class="form-control pull-right" name="to" id="to_date" placeholder="To date" autocomplete="off" value="{{$to_date}}">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar start-calendar"></i>
                    </div>
                </div>
              <button type="submit" class="btn btn-info" style="margin-left: 10px;">Search</button>
              </form>
              </span> -->
            </div>
            <!-- /.box-header -->
            <div class="dataIndex" id="dataIndex">
              @include('departure/departure_index_data')
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </div>
  </div>
</div>
</div>
</div>
  <style type="text/css">
    table.loading>tbody{position:relative}table.loading>tbody:after{position:absolute;top:0;left:0;right:0;bottom:0;background-color:rgba(0,0,0,.1);background-image:url("{{ asset('images/loaders.gif') }}");background-position:center;background-repeat:no-repeat;background-size:65px 65px;content:""}.box-header.with-border{border-bottom:none}a.dropdown-item.edit {padding-left: 10px !important;display: inline-block;padding: 5px;}.btn-group-sm>.btn, .btn-sm {padding: 1px 3px !important;}.inlineFlax{display: inline-flex;}.display {display: inline-flex;}.ui-datepicker-buttonpane.ui-widget-content {display: none !important;}div#ui-datepicker-div {width: 18% !important;}.edit_dest span#select2-destinations-container {padding: 0px 0px 0px 0px;line-height: 1.6;}input.select2-search__field {padding-left: 10px !important;}.validationError {color: #ff0c0c;margin-left: 16px;}.button-submit{margin-top: 20px;margin-bottom: 20px}.autocomplete-items {z-index: 999;position: absolute;background: #fff;width:94%;}.steps.clearfix.text-center{margin-top: 20px;padding-bottom: 20px;}span#select2-pull-container {padding: 0px;margin-top: -8px;}.labelClass{margin-bottom: 12px;}
  </style>
  <script>
$('#myModal').modal({
    backdrop: 'static',
    keyboard: false  // to prevent closing with Esc button (if you want this too)
})
</script>
  @endsection
  @section('footerSection')
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
   <form method="post" name="myEditForm" enctype="multipart/form-data" id="myEditForm">
       @csrf
       <div class="modal-dialog modal-xl" role="document" style="width: 65%">
           <div class="modal-content">
               <div class="modal-header">
                 <span class="inlineFlax"><h5 class="modal-title" id="exampleModalLabel">Update Pricing</h5></span>
                 <span class="inlineFlax" style="float: right"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <i class="fa fa-close"></i></button></span>
               </div>
               <div class="modal-body">
                 <div class="itinerary-setup m-t-20">
                   <input type="hidden" name="edit_id" id="edit_id">
                   <div id="pricingModule">
                     
                   </div>
                 </div>
               <div class="modal-footer">
                  <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                   <button type="submit" class="btn btn-primary" id="edit_send_form"><i class="fa fa-save"></i> Update</button>
                   <img src="{{ asset('images/loader.gif') }}" id="gif" style="width: 5%; display: none;">
                   <span id="mesegess"></span>
               </div>
           </div>
       </div>
   </form>
 </div>
   <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script type="text/javascript">
     $('.edit-item').click(function(){
         var id = $(this).data("id");
         $('#editModal').modal('show');
       });
   </script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $('.edit-item').click(function(){
          var id = $(this).data("id");
          $('#editModal').modal('show');
        });
    </script>
 <script>
   $( document ).ready(function() {
      $('#from_date').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd-M-yy',
      });
      $('#to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd-M-yy',
      });
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
                   html+='<div class="row"><div class="col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 20px;"><label class="labelClass">'+data.type+' ('+data.name+')</label><span class="validationError days_error" id="error_price_inr_'+data.id+'"></span><div class="form-group"><div class="col-md-1 col-lg-1 col-xl-1"><input type="text" class="form-control" name="symbol_inr[]" value="'+data.symbol_inr+'"><input type="hidden" class="form-control" name="price_type_id[]" value="'+data.id+'"></div><div class="col-md-5 col-lg-5 col-xl-5"><input type="text" class="form-control" name="price_inr['+data.id+']" id="price_inr_'+data.id+'" value="'+priceInr+'"></div><div class="col-md-1 col-lg-1 col-xl-1"><input type="text" class="form-control" name="symbol_usd[]" value="'+data.symbol_usd+'"></div><div class="col-md-5 col-lg-5 col-xl-5"><input type="text" class="form-control" name="price_usd['+data.id+']" id="price_usd_'+data.id+'" value="'+priceUsd+'"></div></div></div></div>';
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
  $( document ).ready(function() {
    $(".disableDepartue").click(function () {
      var id = $(this).data("id");
       var status = $(this).data("status");
       var flag = (status == 2)?'inactive':'active';
        var token = $("meta[name='csrf-token']").attr("content");
        if (confirm("Are you sure you want to "+flag+" this departure?"))
          $.ajax(
          {
            url: '/departure-disable/' + id,
            type: 'POST',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (data) {
              window.location.reload();
            }
          });
        });
    });
</script>
<script>
  $(window).on('hashchange', function() {
      if (window.location.hash) {
          var page = window.location.hash.replace('#', '');
          if (page == Number.NaN || page <= 0) {
              return false;
          }else{
              getData(page);
          }
      }
  });
  
  $(document).ready(function()
  {
      $(document).on('click', '.pagination a',function(event)
      {
        $('#departureListData').addClass('loading');
          event.preventDefault();

          $('li').removeClass('active');
          $(this).parent('li').addClass('active');

          var myurl = $(this).attr('href');
          var page=$(this).attr('href').split('page=')[1];

          getData(page);
      });

  });

  function getData(page){
      $.ajax(
      {
          url: '?page=' + page+'&from='+'<?php echo $from_date;?>'+'&to='+'<?php echo $to_date;?>',
          type: "get",
          datatype: "html"
      }).done(function(data){
        $('#departureListData').removeClass('loading');
          $("#dataIndex").empty().html(data);
      }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
      });
  }
</script>

  @endsection