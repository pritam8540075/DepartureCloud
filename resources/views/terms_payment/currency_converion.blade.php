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
      <h1>Currency Conversion(Rs. to $)</h1>

      <form action="{{route('currency_converion_update')}}" method="post">
      @csrf
               <div class="form-group">
               <input type="hidden" name="id" value="{{$data->id}}">
                 <label for="email">Indian Currency:</label>
                  <input type="number" name="currency_conversion" class="form-control" style="width:30%" value="{{$data->indian_currency}}" required> 
                </div>
                <button class="btn btn-primary" type="submit"> Update</button> 
                @if(\Session::has('msg'))
                <span class="text-success">{{\Session::get('msg')}}
                <!-- <button class="btn btn-primary user-change pull-right" data-id="" data-status=""> Approve</span> -->
                @endif
        </form> 
    </section>
  </div>   
</div>
</div>
  
@endsection
@section('footerSection')

@endsection