@extends('layouts.app')
@section('headSection')
@section('title', 'Departure List')
@endsection
@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection
<div class="layout-px-spacing">
   <div class="chat-section layout-top-spacing">
    <div class="widget-content widget-content-area br-6">
    <section class="content-header">
      <h1>Inclusions Edit</h1>
    </section>
    <section class="content">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="steps clearfix text-center">
              @include('layouts/itinerary_menu')
            </div>
          </div>
        </div>
        <form id="InclusionForm">
          @csrf
            <div class="box-body">
            <div class="inclusion-checkbox" style="margin-bottom: 10px">
            <span class="checkbox_error"></span>
              <div class="col-md-10 col-lg-10 col-xl-10 col-sm-12 col-xs-12">
                @foreach($inclusionedits as $inclusionedit)
                <div class="row">
                  <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" class="checkbox_name" name="names[]" value="{{$inclusionedit['name']}}{{$loop->index}}" @foreach($inclusione as $inclupkg) @if ($inclusionedit['name'] == $inclupkg->name) {{'checked'}} @endif  @endforeach>
                            {{$inclusionedit['name']}} 
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 col-lg-9 col-xl-9 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <input type="text" id="descriptions" name="descriptions[]" class="form-control" value="{{$inclusionedit['description']}}" placeholder=" ">
                      </div>
                  </div>
                  </div>
                @endforeach
              </div>
            </div>
            </div>
            <div class="box-body wrappers">
              <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
                <h4 style="padding-bottom: 20px;">Not in list? Add More</h4>
              </div>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input id="name" name="name[]" class="form-control" type="text" placeholder=" " value="">
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" id="description" name="description[]" class="form-control" placeholder=" ">
                  </div>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 col-xs-12" style="margin-top: 25px;">
                  <div class="floating-label">
                    <a href="javascript:void(0);" class="add_button" title="Add field"><img class="ImgWidth" src="{{asset('images/add-icon.png')}}"></a>
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
          </form>
    </section>
  </div>
  </div>   
              
</div>
  <style type="text/css">
    .steps.clearfix{margin-top:10px}span.step-icon{padding-top:10px}.steps.clearfix>ul>li{display:inline-flex;margin-right:20px}.box.box-primary{border-top-color:#3c8dbc;background:0 0}.button-submit{margin-top: 20px;margin-bottom: 20px}.steps.clearfix.text-center{margin-top: 20px;padding-bottom: 20px;}
  </style>
  @endsection
  @section('footerSection')
  <script type="text/javascript">
  $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
            }
            else if($(this).prop("checked") == false){
            }
        });
    });
  $(document).ready(function(){
    var maxFields = 20; //Input fields increment limitation
    var addButtons = $('.add_button'); //Add button selector
    var wrappers = $('.wrappers'); //Input field wrapper
    var fieldHTMLs = '<div class="rowes"><div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12"><label>Name</label><div class="form-group"><input name="name[]" id="name" class="form-control" type="text"></div></div><div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12"><label>Description</label><div class="form-group"><input type="text" name="description[]" id="description" class="form-control"></div></div><div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 col-xs-12" style="margin-top: 25px;"><div class="floating-label"><a href="javascript:void(0);" class="remove_button"><img class="ImgWidth" src="{{ asset("images/remove-icon.png")}}"/></a></div></div></div>';  
    var x = 1;
    
    $(addButtons).click(function(){
        if(x < maxFields){ 
            x++;
            $(wrappers).append(fieldHTMLs);
        }
    });
    $(wrappers).on('click', '.remove_button', function(e){
        e.preventDefault();
         $(".rowes").last().remove();
        
        x--;
    });
  });

  // Form Submit 

    $(document).ready(function () {
            $('#store_form').click(function (e) {
                e.preventDefault();
                $('#gif').show();
                var checkbox = $("input[type='checkbox']").val();
                //alert(checkbox);
                if (checkbox == "") {
                    $("span#checkbox_error").html('Please select atleast 1 checkbox');
                    $(".inclus").focus();
                    return false;
                }
                

                $('#gif').css('visibility', 'visible');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{ route('inclusion_update',request()->route('id')) }}",
                    data: $('#InclusionForm').serialize(),
                    success: function (data) {
                        $('#gif').hide();
                        $('#mesegese').html("<span class='sussecmsg'>Success!</span>");
                        window.location.href = "{{ route('pdf_itinerary',request()->route('id')) }}";
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
<script>

    $("li a").each(function() {   
      //alert(this.href);
        if (this.href == window.location.href) {
            $(this).addClass("active");
        }
    })
  </script>
  @endsection