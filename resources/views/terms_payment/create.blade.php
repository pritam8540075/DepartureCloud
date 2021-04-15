@extends('layouts.app')
@section('headSection')
@section('title', 'Departure List')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
 <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="js/bootstrap-datetimepicker.min.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection
@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection
  <div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
     <div class="widget-content widget-content-area br-6">
       <div class="content-wrapper">
       <section class="content-header">
      <h1>Terms Of Payments</h1>
    </section>
    <section class="content">
          <div class="box box-primary">
            <div class="steps clearfix text-center">
              @include('layouts/itinerary_menu')
            </div>
          </div>
        </div>
        <form action="{{url('/terms/payment/store/'.$id)}}" method="post">
             @csrf
               <div class="form-group">
                 <label for="email"><br>Terms of Payment:</label>
                  <textarea name="termspayment" class="form-control" id="termspayment" rows="5" required>{{$termsPayment->termspayment}}</textarea>
                  <div class="widget-content widget-content-area">
                 
                </div>
                </div>
                <button class="btn btn-primary" type="submit">@if(isset($termsPayment->termspayment)) Update @else Save @endif</button> 
                @if(\Session::has('msg'))
                <span class="text-success">{{\Session::get('msg')}}
                
                    @if($status->status == 0)
                    <button class="btn btn-primary status pull-right" data-id="{{ $status->id }}" data-status="{{ $status->status }}">Published</span>
                    @endif
                @endif
        </form> 
       
  </div>   
</div>
</div>
  <style type="text/css">
    .steps.clearfix{margin-top:10px}span.step-icon{padding-top:10px}.steps.clearfix>ul>li{display:inline-flex;margin-right:20px}.box.box-primary{border-top-color:#3c8dbc;background:0 0}.radio{display:inline}.radio>label{margin-right:30px}.validationError {color: #ff0c0c;}.button-submit{margin-top: 20px;margin-bottom: 20px}.autocomplete-items {z-index: 999;position: absolute;background: #fff;width: 94%;}.dest_badge{margin-right: 7px;margin-top: 7px;padding: 5px 10px;font-weight: 500;}.dest_badge i{margin-left:3px;color: #fff;}ul.search-list>li {display: inherit;border-bottom: 1px solid;margin: 1px;margin-left: -40px;padding: 6px;box-sizing: border-box;color: #444;white-space: nowrap;direction: ltr;vertical-align: middle;border-color: #d3d3d3;}.steps.clearfix.text-center{margin-top: 20px;padding-bottom: 20px;}.ui-datepicker-buttonpane.ui-widget-content {display: none !important;}div#ui-datepicker-div {width: 18% !important;}.itinerary_add span#select2-itinerary-container {padding: 0px 0px 0px 0px; line-height: 1.6;}.select2-search__field{padding-left: 5px !important}
  </style>
@endsection
@section('footerSection')
 <script type="text/javascript">
  $(".status").click(function () {
    if (confirm("Are you sure you published want this Departure?"))
    var id = $(this).data("id");
    var status = $(this).data("status");
    //var flag = (status == 0)?'Buyer':'Buyer & Supplier';
    var token = $("meta[name='csrf-token']").attr("content");
    if(id){
    $.ajax({
      url: '/departure-disable/' + id,
      type: 'POST',
      data: {
          "id": id,
          "_token": token,
      },
      success: function (data) {
        //console.log(data);
        window.location.href = "{{url('/my/departures')}}";
      }
    });
    }
  });
</script>
<script>
        $('#user').DataTable({
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