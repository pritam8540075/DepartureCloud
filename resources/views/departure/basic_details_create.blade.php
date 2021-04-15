@extends('layouts.app')
@section('headSection')
@section('title', 'Departure List')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
 <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="js/bootstrap-datetimepicker.min.js"></script>
@endsection
@section('content')
@section('headnav') 
<!-- <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{route('departure')}}"> Departure </li>
<li class="breadcrumb-item active" aria-current="page"><span> / Basic Details</span></li> -->
@include('layouts.topnav')
@endsection
<div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
              <div class="widget-content widget-content-area br-6">
<div class="content-wrapper">
    <section class="content-header">
      <h1>Departure Create</h1>
    </section>
    <section class="content">
          <div class="box box-primary">
            <div class="steps clearfix text-center">
              @include('layouts/itinerary_menu')
            </div>
          </div>
        </div>
        <form role="form" id="DeparturForm" style="width:99%">
          @csrf
          <div class="box-body">
          <div class="row">
         <div class="col-md-12">
          <h3>Destination (s)</h3>
           <hr style="border-bottom: 2px solid #777">
         </div>
            <div class="col-6">
             <div class="form-group">
                <span class="validationError" id="destinations_error"></span>
                  <input type="hidden" name="destinations" id="destinationName" class="form-control destinationName">
                  <input type="text" id="destinations" class="form-control destinations" placeholder="Search destinations..">
                  <div class="autocomplete-items" style="display: none"></div>
                  <div id="dropdest">
                  </div>
                </div>
             </div>
              <div class="col-md-12 ">
                <h3>Basic Informations</h3>
                <hr style="border-bottom: 2px solid #777">
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Departure Name</label> <span class="validationError" id="title_error"></span>
                  <input type="text" class="form-control" name="title" id="title">
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Departure of Ownner</label> <span class="validationError" id="ownner_error" ></span>
                  <input type="text" class="form-control" name="ownner" id="ownner" value="{{Auth::user()->company_name}}" readonly>
                </div>
              </div>
              <div class="col-md-3 col-lg-1 col-sm-6">
                <div class="form-group">
                  <label>Nights</label> <span class="validationError" id="nights_error"></span>
                  <span class="validationError" id="night_error"></span>
                  <input type="text" class="form-control" name="nights" id="nights" oninput="this.value = (this.value.length > 8) ? this.value.slice(0,8) : this.value; /^[0-9]+(.[0-9]{1,3})?$/.test(this.value) ? this.value : this.value = this.value.slice(0,-1); get_no_of_days(event)">
                </div>
              </div>
              <div class="col-md-3 col-lg-1 col-sm-6">
                <div class="form-group">
                  <label>Days</label> <span class="validationError days_error" id="days_error"></span><span class="validationError" id="day_error"></span>
                  <input type="text" class="form-control" name="days" id="days">
                  <!-- <input type="hidden" class="form-control" name="days" id="days_text" > -->
                </div>
              </div>
              <div class="col-md-1 col-lg-1 col-sm-12">
                <div class="form-group">
                  <label>TotalUnit</label>
                  <input type="text" class="form-control" name="total_seat" id="total_seat">
                  <span class="validationError" id="total_seat_error">
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="form-group">
                  <label>Departure Date</label> 
                  <div class="input-group date">
                    <input type="text" class="form-control pull-right start_date12 fromdate" name="start_date" id="start_date12" onfocus="(this.type='date')">
                    
                  </div>
                  <span class="validationError" id="start_date_error"></span>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="form-group">
                  <label>Departure From</label> 
                  <select class="form-control  hotel" name="starting_from" id="starting_from">
                 
                  </select>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="form-group">
                  <label>Departure To</label> 
                  <select class="form-control  hotel"  name="ending_at" id="ending_at">
                 
                  </select>
                </div>
              </div>
              
             
              <div class="col-md-2 col-lg-2 col-sm-12">
                <div class="form-group">
                  <label>Hotel Category</label> 
                  <select class="form-control  hotel" name="hotel">
                  <option selected="selected">Choose</option>
                  @foreach($hotel as $row)
                  <option value="{{$row->hotel_category}}">{{$row->hotel_category}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="form-group">
                <label>Transport Type</label>
                  <select class="form-control transport_type" name="transport_type[]" id="transport_type">
                    <option value="SIC (Seat In Coach)">SIC (Seat In Coach)</option>
                    <option value="Private">Private</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="form-group">
                <label>Meals Plan</label>
                  <select class="form-control meal_plan" name="meal_plan[]" id="meal_plan" >
                    <option value="American Meal Plan">American Meal Plan</option>
                    <option value="Continent Meal Plan">Continent Meal Plan</option>
                    <option value="European Plan">European Plan</option>
                   <!--  <option value="Bermuda Plan">Bermuda Plan</option> -->
                  </select>
                </div>
              </div>
              <div class="col-md-3 col-lg-2 col-sm-12">
                <div class="form-group">
                  <label>Hold Duration</label> 
                  <select class="form-control" name="hold_time" id="hold_duration">
                  <!-- <option selected="selected">Choose</option> -->
                  @foreach($holdduration as $row)
                  <option value="{{$row->hours}}">{{$row->hours}} Hours</option>
                  @endforeach
                  </select>
                </div>
              </div>

            <div class="col-md-3 col-lg-2 col-sm-12">
                <div class="form-group">
                  <label>Hold till Date</label> 
                  <select class="form-control" name="hold_duration" id="hold_duration" onclick='showDays()'>
                  @foreach($holdtill as $row)
                  <option value="{{$row->days}}" @if($row->days == 14) selected @endif> D-{{$row->days}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label style="font-weight:bold" class="text-dark">{{Auth::user()->company_name}} Price(Per PAX):</label> 
                  <div style="white-space:nowrap">
                  <label>INR 
                  <input type="text" class="form-control"  name="price_inr" id="price_inr">
                  </label>
                  <label>USD
                  <input type="text" class="form-control" name="price_usd" id="price_usd">
                  </label>
                  </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label style="font-weight:bold" class="text-dark">Single Supplement Price(PAX)</label> 
                  <div style="white-space:nowrap">
                  <label>INR 
                  <input type="text" class="form-control"  name="single_price_inr" id="single_price_inr">
                  </label>
                  <label>USD
                  <input type="text" class="form-control" name="single_price_usd" id="single_price_usd">
                  </label>
                  </div>
                </div>
            </div>
            
            <div class="col-md-12 ">
                <h3><br>Flight Details:</h3>
                <hr style="border-bottom: 2px solid #777">
                <h4>Originating Flight</h4>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label>Airlines</label> 
                  <select class="form-control  flight" name="origin_flight" id="flight">
                  </select>
                </div>
              </div>
              <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Flight No.</label> 
                  <input type="text" class="form-control" name="o_flight_no" id="" >
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Date of Dep</label> 
                  <input type="text" class="form-control" name="o_flight_dep_date" onfocus="(this.type='date')">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Dep Time</label> 
                  <input type="time" class="form-control" name="o_flight_dep_time">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arrival Time</label> 
                  <input type="time" class="form-control" name="o_flight_arrival_time">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Departing Airport</label> 
                  <input type="text" class="form-control" name="o_flight_dep_airport">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arriving Airport</label> 
                  <input type="text" class="form-control" name="o_flight_arrival_airport">
                </div>
            </div>
            <div class="col-md-12 ">
                <h4>Returning Flight</h4>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label>Airlines</label> 
                  <select class="form-control  flight" name="r_flight" id="flight_return">
                  </select>
                </div>
              </div>
              <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Flight No.</label> 
                  <input type="text" class="form-control" name="r_flight_flight_no">
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Date of Dep</label> 
                  <input type="text" class="form-control" name="r_flight_dep_date" onfocus="(this.type='date')">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Dep Time</label> 
                  <input type="time" class="form-control" name="r_flight_dep_time">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arrival Time</label> 
                  <input type="time" class="form-control" name="r_flight_arrival_time">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Departing Airport</label> 
                  <input type="text" class="form-control" name="r_flight_dep_airport">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arriving Airport</label> 
                  <input type="text" class="form-control" name="r_flight_arrival_airport">
                </div>
            </div>
             
            </div>
            <!-- <span id="demo"></span> -->
            
            <div class="box-body">
              <div class="col-md-12 col-lg-12 col-sm-12 button-submit text-left">
                <button class="btn btn-primary active" type="button" id="store_form"><i class="fa fa-save"></i> Next </button>
                <img src="{{ asset('images/loader.gif') }}" id="gif" style="width: 3%; visibility: hidden;">
                <span class="text-success" id="mesegese" style="margin-left: 10px"></span>
              </div>
              </div> 
         
        </form>
  </div>   
</div>
</div>
</div>
  <style type="text/css">
    .steps.clearfix{margin-top:10px}span.step-icon{padding-top:10px}.steps.clearfix>ul>li{display:inline-flex;margin-right:20px}.box.box-primary{border-top-color:#3c8dbc;background:0 0}.radio{display:inline}.radio>label{margin-right:30px}.validationError {color: #ff0c0c;}.button-submit{margin-top: 20px;margin-bottom: 20px}.autocomplete-items {z-index: 999;position: absolute;background: #fff;width: 94%;}.dest_badge{margin-right: 7px;margin-top: 7px;padding: 5px 10px;font-weight: 500;}.dest_badge i{margin-left:3px;color: #fff;}ul.search-list>li {display: inherit;border-bottom: 1px solid;margin: 1px;margin-left: -40px;padding: 6px;box-sizing: border-box;color: #444;white-space: nowrap;direction: ltr;vertical-align: middle;border-color: #d3d3d3;}.steps.clearfix.text-center{margin-top: 20px;padding-bottom: 20px;}.ui-datepicker-buttonpane.ui-widget-content {display: none !important;}div#ui-datepicker-div {width: 18% !important;}.itinerary_add span#select2-itinerary-container {padding: 0px 0px 0px 0px; line-height: 1.6;}.select2-search__field{padding-left: 5px !important}
  </style>
  @endsection
  @section('footerSection')
  <!-- <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script> -->
  
  <script src="{{asset('js/select2.full.min.js')}}"></script>
  <script src="{{asset('js/customJS/basic-details.js')}}"></script>
   
    <script>
    var default_inr = "<?php echo $inr; ?>";
    $('#price_inr').keyup(function(){
    var price_inr;
    //alert(default_inr);
    price_inr = parseFloat($('#price_inr').val());
    if(price_inr){
        var result = Math.round(price_inr / default_inr);
        if($("#price_usd").val(result))
        {
            $("#price_usd").val(result)
            $("#price_usd").prop("readonly", true);
        }
    }else{
      $("#price_usd").val('')
            $("#price_usd").prop("readonly", false);
    }
    });
  $('#price_usd').keyup(function(){
    var price_usd;
    price_usd = parseFloat($('#price_usd').val());
    if(price_usd){
    var result = Math.round(price_usd * default_inr);
         if($("#price_inr").val(result))
        {
         $("#price_inr").val(result)
         $("#price_inr").prop("readonly", true);
        }
    }else{
      $("#price_inr").val('')
            $("#price_inr").prop("readonly", false);
    }
  });

  $('#single_price_inr').keyup(function(){
    var price_inr;
    price_inr = parseFloat($('#single_price_inr').val());
    if(price_inr){
        var result = Math.round(price_inr / default_inr);
        if($("#single_price_usd").val(result))
        {
            $("#single_price_usd").val(result)
            $("#single_price_usd").prop("readonly", true);
        }
    }else{
      $("#single_price_usd").val('')
            $("#single_price_usd").prop("readonly", false);
    }
    });
  $('#single_price_usd').keyup(function(){
    var price_usd;
    price_usd = parseFloat($('#single_price_usd').val());
    if(price_usd){
    var result = Math.round(price_usd * default_inr);
         if($("#single_price_inr").val(result))
        {
         $("#single_price_inr").val(result)
         $("#single_price_inr").prop("readonly", true);
        }
    }else{
      $("#single_price_inr").val('')
            $("#single_price_inr").prop("readonly", false);
    }
  });
</script>
  <script>
  function showDays(){

     var end = $('.fromdate').val();
     var start = new Date();

     var startDay = new Date(start);
     var endDay = new Date(end);
     var millisecondsPerDay = 1000 * 60 * 60 * 24;

     var millisBetween = endDay.getTime() - startDay.getTime();
     var days = millisBetween / millisecondsPerDay;
      // Round down.
      // alert( Math.floor(days));
       if ( Math.floor(days) < 21) {
        document.getElementById("demo").innerHTML = Math.floor(days);
      }
     }
    </script>
  <script>
  var h = $(".hotel").select2({
    tags: true,
   });
   var f = $(".flight").select2({
    tags: true,
   });
   var s = $(".start").select2({
    tags: true,
   });
   var e = $(".end").select2({
    tags: true,
   });
</script>
  <script>
   $('#meal_plan').select2({
      placeholder: 'Select Meals Plan',
    });
    $('#transport_type').select2({
      placeholder: 'Select Transport Type',
    });
    $('#tags').select2({
        placeholder: 'Add Tag(s)',
        tags: true,
    });
    </script>
    
  <script type="text/javascript">
    $(document).ready(function () {
            $('#store_form').click(function (e) {
                e.preventDefault();
                $('#gif').show();

                var destinationName = $('#destinationName').val();
                if (destinationName == "") {
                    $("span#description_error").hide();
                    $("span#destinations_error").html('This field is required!');
                    $("input#destinations").focus();
                    return false;
                }

                var title = $('#title').val();
                if (title == "") {
                    $("span#title_error").html('This field is required!');
                    $("input#title").focus();
                    return false;
                }
                var nights = $('#nights').val();
                if (nights == "") {
                    $("span#days_error").hide();
                    $("span#nights_error").html('This field is required!');
                    $("input#nights").focus();
                    return false;
                }
                var days = $('#days').val();
                if (days == "") {
                    $("span#sub_title_error").hide();
                    $("span#days_error").html('This field is required!');
                    $("input#days").focus();
                    return false;
                }
                var start_date = $('#start_date').val();
                if (start_date == "") {
                    $("span#nights_error").hide();
                    $("span#start_date_error").html('This field is required!');
                    $("input#start_date").focus();
                    return false;
                }
                var team_size = $('#team_size').val();
                if (team_size == "") {
                    $("span#place_error").hide();
                    $("span#team_size_error").html('This field is required!');
                    $("input#team_size").focus();
                    return false;
                }
                var transport_type = $('#transport_type').val();
                if (transport_type == "") {
                    $("span#team_size_error").hide();
                    $("span#transport_type_error").html('This field is required!');
                    $("input#transport_type").focus();
                    return false;
                }

                $('#gif').css('visibility', 'visible');
                var formDatas = new FormData(document.getElementById('DeparturForm'));
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{ route('departure_store') }}",
                    data: formDatas,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#gif').hide();
                        $('#mesegese').html("<span class='sussecmsg'>Success!</span>");
                        window.location = data.url;
                    },
                    errors: function () {
                      $('#gif').hide();
                      $('#mesegese').html("<span class='sussecmsg'>Something went wrong!</span>");
                    }

                });
            });
        });
  </script>
  <script>
    $(function(){
      var $j = jQuery.noConflict();
      //$("#start_date12").datepicker();
      //   changeMonth: true,
      //   changeYear: true,
      //   showButtonPanel: true,
      //   dateFormat: 'dd-M-yy',
      //   minDate: 0,
      // });
    });
    /*$(document).ready(function(){

     $('#start_date12').datetimepicker();
   });*/
    $('.start-calendar').click(function () {
      $("#start_date").focus();
    });

    $("li a").each(function() {   
      //alert(this.href);
        if (this.href == window.location.href) {
            $(this).addClass("active");
        }
    });
    
  </script>
  <script> 
  // Departure From Destinations
    $('#starting_from').select2({
      placeholder: 'Select Destination',
      ajax: {
          url: "/start_from_destination",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.destination,
                          id: item.destination
                      }
                  })
              };
          },
          cache: true
      }
  });
  
  // Departure From To Destinations
  $('#ending_at').select2({
      placeholder: 'Select Destination',
      ajax: {
          url: "/start_from_destination",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.destination,
                          id: item.destination
                      }
                  })
              };
          },
          cache: true
      }
  });

  // Departure Airline
  $('#flight').select2({
      placeholder: 'Select Airline',
      ajax: {
          url: "/departure_airline",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.airline,
                          id: item.airline
                      }
                  })
              };
          },
          cache: true
      }
  });
  // Return Airline
  $('#flight_return').select2({
      placeholder: 'Select Airline',
      ajax: {
          url: "/departure_airline_return",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.airline,
                          id: item.airline
                      }
                  })
              };
          },
          cache: true
      }
  });
  </script>
  
 
  @endsection