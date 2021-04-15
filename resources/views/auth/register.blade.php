<?php
    $alpha = substr(str_shuffle("abcdefghijklmnopqrstvwxyz"), 0, 11);
    $number = substr(str_shuffle("0123456789"), 0, 10);
?> 

<html lang="en">
<head>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Register</title>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<!-- Fonts -->
<!-- <link rel="icon" type="image/x-icon" href=""/> -->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

<div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Register</h1>
                        <p class="signup-link register">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                        <form class="text-left" method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="form">
                                <div class="row">
                                <div class="col-lg-6">
                                <input type="hidden" name="tenant_id" value="{{$alpha.$number}}">
                                <div id="username-field" class=" mb-2">
                                    <label for="username">{{ __('Contact Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>
                                
                                <div class="col-lg-6">
                                <div id="email-field" class=" mb-2">
                                    <label for="email">{{ __('E-Mail ID') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                     <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                                </div>
                                  
                                <div class="col-lg-6">
                                <div id="password-field" class=" mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">{{ __('Password') }}</label>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                     <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                                </div>

                                <div class="col-lg-6">
                                <div id="password-field" class=" mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">{{ __('Confirm Password') }}</label>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                </div>

                                <div class="col-lg-6">
                                <div id="username-field" class="">
                                    <label for="username">{{ __('Mobile No.') }}</label>
                                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div id="username-field" class=" mb-2">
                                    <label for="username">{{ __('Company Name') }}</label>
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>

                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>
                                <div class="col-lg-12">
                                <div id="username-field" class=" mb-2">
                                    <label for="username">{{ __('Address') }}</label>
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div id="username-field" class=" mb-2">
                                    <label for="username">{{ __('City') }}</label>
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('company_name') }}" required autocomplete="city" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>

                                <div class="col-lg-6">
                                <div id="username-field" class=" mb-2">
                                    <label for="username">{{ __('State') }}</label>
                                    <input id="city" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state" autofocus>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>
                               
                                <div class="col-lg-6">
                                <div id="username-field" class=" mb-2">
                                    <label for="username">{{ __('Country') }}</label>
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div id="username-field" class=" mb-2">
                                    <label for="username">{{ __('Pin Code') }}</label>
                                    <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin') }}" required autocomplete="pin" autofocus>

                                @error('pin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>

                                <div class="col-lg-12">
                                <div id="username-field" class=" m-2">
                                Are you a 
                                 
                                 <label for="male"> Buyer </label> 
                                 <input type="radio" id="buyer" name="user" value="0" checked>
                                 <label for="female"> Supplier </label> 
                                 <input type="radio" id="supplier" name="user" value="1">
                                
                                <!-- <select class="form-control col-lg-10 col-md-10 col-sm-10" name="destination[]" id="destination" multiple="multiple">
                                
                                </select> -->
                                <div id="supplier_select" style="display:none">
                                <select class="form-control" name="destination[]" id="destination" style="display:none" multiple>
                    
                                </select>
                
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                
                                </div>
                                </div>
                                

                                <div class="d-sm-flex justify-content-between p-4">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Register</button>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
    
    <script src="https://momentjs.com/downloads/moment.js"></script>
   
    
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- <script src="{{asset('assets/js/apps/mailbox-chat.js')}}"></script> -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <!-- <script src="{{asset('plugins/editors/markdown/simplemde.min.js')}}"></script> -->
    <!-- <script src="{{asset('plugins/editors/markdown/custom-markdown.js')}}"></script> -->
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
  <!-- <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script> -->
  <script src="{{asset('js/select2.full.min.js')}}"></script>
    
    <!-- <script src="{{asset('morris.min.js')}}"></script> -->
    <script src="{{asset('js/select2.full.min.js')}}"></script>
  <script src="{{asset('js/customJS/basic-details.js')}}"></script>
 <script>
//    $('#destination').select2({
//       placeholder: 'Select Destination',
//       ajax: {
//           url: "/start_from_destination",
//           dataType: 'json',
//           delay: 250,
//           processResults: function (data) {
//               return {
//                   results: $.map(data, function (item) {
//                       return {
//                           text: item.destination,
//                           id: item.destination
//                       }
//                   })
//               };
//           },
//           cache: true
//       }
//   });
  $('#destination').select2({
      placeholder: 'Select Destinatins',
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
  </script>

 <script>
    $(document).ready(function(){
        // var radioinput = $("#username-field input[type='radio']")
      $("input[type='radio']").change(function(){
        //   alert("radioinput");
        if($(this).val()== 1)
        {
        $("#supplier_select").show();
        
        $("#supplier_select .select2").css('width','100%');
        $("#destination").show();
        }
        else
        {
            $("#supplier_select").hide();
        $("#destination").hide(); 
        }
      });
    });
 </script>
</body>
</html>

 
 