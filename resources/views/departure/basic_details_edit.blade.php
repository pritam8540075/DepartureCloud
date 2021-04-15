@extends('layouts.app')
@section('headSection')
@section('title', 'Departure Create')
@endsection

@section('content')
@section('headnav') 
<!-- <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{route('departure')}}"> Departure </li>
<li class="breadcrumb-item active" aria-current="page"><span> / Basic Detail Edit</span></li> -->
@include('layouts.topnav')
@endsection


<div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
      <div class="widget-content widget-content-area br-6">
        <div class="content-wrapper">
    <section class="content-header">
      <h1>Departure Edit</h1>
    </section>
    <section class="content">
          <div class="box box-primary">
            <div class="steps clearfix text-center">
              @include('layouts/itinerary_menu')
            </div>
        </div>
        <form role="form" id="DeparturForm" style="width:99%">
          @csrf
          <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h3>Destinations</h3>
              <hr style="border-bottom: 2px solid #777">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Destinations</label> <span class="validationError" id="destinations_error"></span>
                  <input type="hidden" name="destinations" id="destinationName" class="form-control destinationName">
                  <input type="text" id="destinations" class="form-control destinations" placeholder="Search destinations..">
                  <div class="autocomplete-items" style="display: none"></div>
                  <div id="dropdest">
                     
                  </div>
               </div>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <h3>Basic Informations</h3>
                <hr style="border-bottom: 2px solid #777">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
               <div class="form-group">
                  <label>Name of the Departure</label> <span class="validationError" id="title_error"></span>
                  <input type="text" class="form-control" name="title" id="title" value="{{$departures->title}}">
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Departure of Ownner</label> <span class="validationError" id="ownner_error"></span>
                  <input type="text" class="form-control" name="ownner" id="ownner" value="{{$departures->departure_ownner}}">
                </div>
              </div>
            <div class="col-md-6 col-lg-1 col-sm-12">
                <div class="form-group">
                  <label>Nights</label> <span class="validationError" id="nights_error"></span>
                  <span class="validationError" id="night_error"></span>
                  <input type="text" class="form-control" name="nights" id="nights" value="{{$departures->no_of_nights}}" oninput="this.value = (this.value.length > 8) ? this.value.slice(0,8) : this.value; /^[0-9]+(.[0-9]{1,3})?$/.test(this.value) ? this.value : this.value = this.value.slice(0,-1); get_no_of_days(event)">
                </div>
            </div>
            <div class="col-md-6 col-lg-1 col-sm-12">
            <div class="form-group">
                  <label>Days</label> <span class="validationError days_error" id="days_error"></span><span class="validationError" id="day_error"></span>
                  <input type="text" class="form-control" name="days" id="days" value="{{$departures->no_of_days}}" >
            </div>
            </div>
            <div class="col-md-1 col-lg-1 col-sm-12">
            <div class="form-group">
                  <label>TotalUnit</label>
                  <input type="text" class="form-control" name="total_seat" id="total_seat" value="{{$departures->total_seat}}">
                  <span class="validationError" id="total_seat_error">
            </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
             <div class="form-group">
                  <label>Departure Date</label> 
                  <div class="input-group date">
                    <input type="text" class="form-control pull-right" name="start_date" id="start_date" value="{{$departures->start_date}}" onfocus="(this.type='date')">
                    <!-- <div class="input-group-addon">
                        <i class="fa fa-calendar start-calendar"></i>
                    </div> -->
                  </div>
                  <span class="validationError" id="start_date_error"></span>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="form-group">
                  <label>Departure From</label> 
                  <select class="form-control  hotel" name="starting_from" id="starting_from">
                  <option value="{{$departures->from}}" selected >{{$departures->from}}</option>
                  
                  </select>
                  <span class="validationError" id="from_error"></span>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
            <div class="form-group">
                  <label>Departure To</label> 
                  <select class="form-control  hotel" name="ending_at" id="ending_at">
                  
                  <option value="{{$departures->ending_at}}" selected >{{$departures->ending_at}}</option>
                 
                  </select>
            </div>
            </div>
            
            <div class="col-md-2 col-lg-2 col-sm-12">
            <div class="form-group">
                  <label>Hotel Category</label> 
                  <select class="form-control  hotel" name="hotel" id="hotel">
                  @foreach($hotel as $row)
                  <option value="{{$row->hotel_category}}" @if($departures->hotel_category == $row->hotel_category) selected @endif>{{$row->hotel_category}}</option>
                  @endforeach
                  </select>
            </div>
            </div> 
            <div class="col-md-3 col-lg-3 col-sm-12">
               <div class="form-group">
                <label>Transport Type</label>
                  <select class="form-control transport_type" name="transport_type" id="transport_type">
                    <option value="SIC (Seat In Coach)" @foreach($departures->transport_type as $tt) @if($tt == "SIC (Seat In Coach)") selected @endif @endforeach>SIC (Seat In Coach)</option>
                    <option value="Private" @foreach($departures->transport_type as $tt1) @if($tt1 == "Private") selected @endif @endforeach>Private</option>
                  </select>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
            <div class="form-group">
                <label>Meals Plan</label>
                  <select class="form-control meal_plan" name="meal_plan" id="meal_plan">
                    <option value="American Meal Plan" @foreach($departures->meal_type as $mt) @if($mt == "American Meal Plan") selected @endif @endforeach>American Meal Plan</option>
                    <option value="Continent Meal Plan" @foreach($departures->meal_type as $mt1) @if($mt1 == "Continent Meal Plan") selected @endif @endforeach>Continent Meal Plan</option>
                    <option value="European Plan" @foreach($departures->meal_type as $mt2) @if($mt2 ==  "European Plan") selected @endif @endforeach>European Plan</option>
                  </select>
            </div>
            </div>
            <div class="col-md-3 col-lg-2 col-sm-12">
                <div class="form-group">
                  <label>Hold Duration</label> 
                  <select class="form-control" name="hold_time" id="hold_duration">
                  <option selected="selected">Choose</option>
                  @foreach($holdduration as $row)
                  <option value="{{$row->hours}}"  @if($departures->hold_duration == $row->hours) selected @else @endif>{{$row->hours}} Hours</option>
                  @endforeach
                  </select>
                </div>
              </div>

            <div class="col-md-3 col-lg-2 col-sm-12">
                <div class="form-group">
                  <label>Hold Till</label> 
                  <select class="form-control" name="hold_duration" id="hold_duration" onclick='showDays()'>
                  <option selected="selected">Choose</option>
                  @foreach($holdtill as $row)
                  <option value="{{$row->days}}"  @if($hold_departure->hold_till == $row->days) selected @else @endif>D-{{$row->days}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label style="font-weight:bold" class="text-dark">{{$departures->company_name}} Price (Per PAX):</label> 
                  <div style="white-space:nowrap">
                  <label>INR 
                  <input type="text" class="form-control"  name="price_inr" id="price_inr" value="{{$departures->price_inr}}">
                  </label>
                  <label>USD
                  <input type="text" class="form-control" name="price_usd" id="price_usd" value="{{$departures->price_usd}}"> 
                  </label>
                  </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group">
                  <label style="font-weight:bold" class="text-dark">Single Supplement Price(PAX)</label> 
                  <div style="white-space:nowrap">
                  <label>INR 
                  <input type="text" class="form-control"  name="single_price_inr" id="single_price_inr" value="{{$departures->single_supplyment_price_inr}}">
                  </label>
                  <label>USD
                  <input type="text" class="form-control" name="single_price_usd" id="single_price_usd" value="{{$departures->single_supplyment_price_usd}}">
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
                  <select class="form-control  flight" name="flight" id="flight">
                 
                  <option value="{{$departures->flight}}" selected>{{$departures->flight}}</option>
                 
                  </select>
                  <span class="validationError" id="flight_error"></span>
                </div>
              </div>
              <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Flight No.</label> 
                  <input type="text" class="form-control" name="o_flight_no" id="" value="{{$departures->origin_flight_no}}">
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Date of Dep</label> 
                  <input type="text" class="form-control" name="o_flight_dep_date" value="{{$departures->origin_flight_date}}" onfocus="(this.type='date')">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Dep Time</label> 
                  <input type="time" class="form-control" name="o_flight_dep_time" value="{{$departures->origin_flight_dep_time}}">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arrival Time</label> 
                  <input type="time" class="form-control" name="o_flight_arrival_time" value="{{$departures->origin_flight_arrival_time}}">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Departing Airport</label> 
                  <input type="text" class="form-control" name="o_flight_dep_airport" value="{{$departures->origin_flight_dep_airport}}">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arriving Airport</label> 
                  <input type="text" class="form-control" name="o_flight_arrival_airport" value="{{$departures->origin_flight_arriving_airport}}">
                </div>
            </div>
            <div class="col-md-12 ">
                <h4>Returning Flight</h4>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label>Airlines</label> 
                  <select class="form-control  flight" name="r_flight" id="flight_return">
                  <option value="{{$departures->return_flight}}" selected>{{$departures->return_flight}}</option>
                  </select>
                  <span class="validationError" id="flight_error"></span>
                  </select>
                </div>
              </div>
              <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Flight No.</label> 
                  <input type="text" class="form-control" name="r_flight_flight_no" value="{{$departures->return_flight_no}}">
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Date of Dep</label> 
                  <input type="text" class="form-control" name="r_flight_dep_date" value="{{$departures->return_flight_date}}" onfocus="(this.type='date')">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Dep Time</label> 
                  <input type="time" class="form-control" name="r_flight_dep_time" value="{{$departures->return_flight_dep_time}}">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arrival Time</label> 
                  <input type="time" class="form-control" name="r_flight_arrival_time" value="{{$departures->return_flight_arrival_time}}">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Departing Airport</label> 
                  <input type="text" class="form-control" name="r_flight_dep_airport" value="{{$departures->return_flight_dep_airport}}">
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-6">
                <div class="form-group">
                  <label style="font-size:14px">Arriving Airport</label> 
                  <input type="text" class="form-control" name="r_flight_arrival_airport" value="{{$departures->return_flight_arriving_airport}}">
                </div>
            </div>

                <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="form-group">
                    <label>Description</label> <span class="validationError" id="description_error"></span>
                    <textarea class="form-control" name="description" id="description" style="height: 120px">{{$departures->description}}</textarea>
                </div>
                </div>
              </div>
            </div>
            <div class="box-body">
            <div class="col-md-12 col-lg-12 col-sm-12 button-submit">
                <button class="btn btn-primary active" type="button" id="store_form"><i class="fa fa-save"></i> Next </button>
                <img src="{{ asset('images/loader.gif') }}" id="gif" style="width: 3%; visibility: hidden;">
                <span class="text-success" id="mesegese" style="margin-left: 10px"></span>
            </div> 
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
  <style type="text/css">
    .steps.clearfix{margin-top:10px}span.step-icon{padding-top:10px}.steps.clearfix>ul>li{display:inline-flex;margin-right:20px}.box.box-primary{border-top-color:#3c8dbc;background:0 0}.radio{display:inline}.radio>label{margin-right:30px}.validationError {color: #ff0c0c;}.button-submit{margin-top: 20px;margin-bottom: 20px}.dest_badge {margin-right: 7px;margin-top: 7px;padding: 5px 10px;font-weight: 500;}.dest_badge i{margin-left: 3px;color: #fff;}ul.search-list>li {display: inherit;border-bottom: 1px solid;margin: 1px;margin-left: -40px;padding: 6px;box-sizing: border-box;color: #444;white-space: nowrap;direction: ltr;vertical-align: middle;border-color: #d3d3d3;}.autocomplete-items {z-index: 999;position: absolute;background: #fff;width: 94%;}.steps.clearfix.text-center{margin-top: 20px;padding-bottom: 20px;}.ui-datepicker-buttonpane.ui-widget-content {display: none !important;}div#ui-datepicker-div {width: 18% !important;}.itinerary_add span#select2-itinerary-container {padding: 0px 0px 0px 0px; line-height: 1.6;}.select2-search__field{padding-left: 5px !important}
  </style>
  @endsection
  @section('footerSection')
  <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{asset('js/select2.full.min.js')}}"></script>
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
    $(document).ready(function () {
            $('#store_form').click(function (e) {
                e.preventDefault();
                $('#gif').show();
                var destinationName = $('#destinationName').val();
                if (destinationName == "") {
                    $("span#destinations_error").html('This field is required!');
                    $("select#destinations").focus();
                    return false;
                }
                var title = $('#title').val();
                if (title == "") {
                    $("span#destinations_error").hide();
                    $("span#title_error").html('This field is required!');
                    $("input#title").focus();
                    return false;
                }
                var days = $('#days').val();
                if (days == "") {
                    $("span#sub_title_error").hide();
                    $("span#days_error").html('This field is required!');
                    $("input#days").focus();
                    return false;
                }
                var nights = $('#nights').val();
                if (nights == "") {
                    $("span#days_error").hide();
                    $("span#nights_error").html('This field is required!');
                    $("input#nights").focus();
                    return false;
                }
                var start_date = $('#start_date').val();
                if (start_date == "") {
                    $("span#nights_error").hide();
                    $("span#start_date_error").html('This field is required!');
                    $("input#start_date").focus();
                    return false;
                }
                
                var price_inr = $('#price_inr').val();
                if (price_inr == "") {
                    $("span#price_inr_error").hide();
                    $("span#price_inr_error").html('This field is required!');
                    $("input#price_inr").focus();
                    return false;
                }
                var hotel = $('#hotel').val();
                if (hotel == "") {
                    $("span#price_usd_error").hide();
                    $("span#price_usd_error").html('This field is required!');
                    $("input#price_usd").focus();
                    return false;
                }
                
                // var hold = $('#hold_duration').val();
                // if (hold_duration == "") {
                //     $("span#hold_duration_error").hide();
                //     $("span#hold_duration_error").html('This field is required!');
                //     $("input#hold_duration").focus();
                //     return false;
                // }
                
                // var team_size = $('#team_size').val();
                // if (team_size == "") {
                //     $("span#place_error").hide();
                //     $("span#team_size_error").html('This field is required!');
                //     $("input#team_size").focus();
                //     return false;
                // }
                var transport_type = $('#transport_type').val();
                if (transport_type == "") {
                    $("span#team_size_error").hide();
                    $("span#transport_type_error").html('This field is required!');
                    $("input#transport_type").focus();
                    return false;
                }
                var description = $('#description').val();
                if (description == "") {
                    $("span#transport_type_error").hide();
                    $("span#description_error").html('This field is required!');
                    $("textarea#description").focus();
                    return false;
                }
                

                $('#gif').css('visibility', 'visible');
                var formDatas = new FormData(document.getElementById('DeparturForm'));
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{ route('departure_update',request()->route('id')) }}",
                    data: formDatas,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#gif').hide();
                        $('#mesegese').html("<span class='sussecmsg'>Success!</span>");
                        window.location = data.url;
                        //location.reload();
                    },
                    errors: function () {
                      $('#gif').hide();
                      $('#mesegese').html("<span class='sussecmsg'>Something went wrong!</span>");
                    }

                });
            });
        });
  </script>
  <script src="{{asset('js/customJS/basic-details_edit.js')}}"></script>
  <script type="text/javascript">
    function initDestinationAll(Lat, Long, dest_name, country, actual_names, regions, iso2s, iso3s, descriptionz, destId, countLat, countLong, officeName, capital, largeCity, continent, countDesc, subCountinent, countIso2, countIso3, isdCode, internetTld, currency, cointryId, currencySymbol, currencyCode, driveOn, area, areaUnit, population) {

            dest_selected.push(
                {
                  'name':dest_name,
                  'actual_name':actual_names,
                  'country':country,
                  'id':destId,
                  'lat':Lat,
                  'long':Long,
                  'region':regions,
                  'iso2':iso2s,
                  'iso3':iso3s,
                  'description':descriptionz,
                  'country_id':cointryId,
                  'country_lat':countLat,
                  'country_long':countLong,
                  'official_name':officeName,
                  'capital':capital,
                  'largest_city':largeCity,
                  'continent':continent,
                  'sub_continent':subCountinent,
                  'count_description':countDesc,
                  'count_iso2':countIso2,
                  'count_iso3':countIso3,
                  'isd_code':isdCode,
                  'internet_tld':internetTld,
                  'currency':currency,
                  'currency_symbol':currencySymbol,
                  'currency_code':currencyCode,
                  'drive_on':driveOn,
                  'area':area,
                  'area_unit':areaUnit,
                  'population':population,
                }
                );
            $('#destinationName').val(JSON.stringify(dest_selected));
            set_dest_html();
        }
  </script>
  <?php
    if(count($destinations) > 0){
      //print_r($imagePath);
    foreach($destinations as $destination){  ?>
        <script type="text/javascript">
          var dest_name='<?php  echo $destination->name; ?>';
          var actual_names ='<?php  echo $destination->actualname; ?>';
          var country='<?php  echo $destination->country; ?>';
          var destId='<?php  echo $destination->id; ?>';
          var Lat='<?php  echo $destination->lat; ?>';
          var Long='<?php  echo $destination->long; ?>';
          var regions='<?php  echo $destination->region; ?>';
          var iso2s='<?php  echo $destination->iso2; ?>';
          var iso3s='<?php  echo $destination->iso3; ?>';
          var descriptionz='<?php  echo $destination->description; ?>';
          //alert(s3name);
          var cointryId='<?php  echo $destination->count_id; ?>';
          var officeName='<?php  echo $destination->official_name; ?>';
          var capital='<?php  echo $destination->capital; ?>';
          var largeCity='<?php  echo $destination->largest_city; ?>';
          var continent='<?php  echo $destination->continent; ?>';
          var countDesc='<?php  echo $destination->count_des; ?>';
          var subCountinent='<?php  echo $destination->sub_continent; ?>';
          var countIso2='<?php  echo $destination->iso_2; ?>';
          var countIso3='<?php  echo $destination->iso_3; ?>';
          var isdCode='<?php  echo $destination->isd_code; ?>';
          var countLat='<?php  echo $destination->count_lat; ?>';
          var countLong='<?php  echo $destination->count_long; ?>';
          var internetTld='<?php  echo $destination->internet_tld; ?>';
          var currency='<?php  echo $destination->currency; ?>';
          var currencySymbol='<?php  echo $destination->currency_symbol; ?>';
          var currencyCode='<?php  echo $destination->currency_code; ?>';
          var driveOn='<?php  echo $destination->drives_on; ?>';
          var area='<?php  echo $destination->area; ?>';
          var areaUnit='<?php  echo $destination->area_unit; ?>';
          var population='<?php  echo $destination->population; ?>';
          initDestinationAll(Lat, Long, dest_name, actual_names, country, regions, iso2s, iso3s, descriptionz, destId, countLat, countLong, officeName, capital, largeCity, continent, countDesc, subCountinent, countIso2, countIso3, isdCode, internetTld, currency, cointryId, currencySymbol, currencyCode, driveOn, area, areaUnit, population)
          
  </script>
  <?php }} ?>
  <script>
    $( document ).ready(function() {
       $("#start_date12").datepicker();
    //     changeMonth: true,
    //     changeYear: true,
    //     showButtonPanel: true,
    //     dateFormat: 'dd-M-yy',
    //     minDate: 0,
    //   });
    });
    $('.start-calendar').click(function () {
      $("#start_date").focus();
    });
    $("li a").each(function() {   
      //alert(this.href);
        if (this.href == window.location.href) {
            $(this).addClass("active");
        }
    })   
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
  // Departure To Destinations
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
<script>
var default_inr = "<?php echo $inr; ?>"
    $('#price_inr').keyup(function(){
    var price_inr;
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
  @endsection