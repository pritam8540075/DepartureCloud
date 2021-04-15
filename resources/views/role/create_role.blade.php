@extends('layouts.app')
@section('headSection')
@section('title', 'Departure Edit')
@endsection
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
@section('content')
@section('headnav') 
<!-- <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><span> / Departure</span></li> -->
@endsection
<div id="content" class="main-content">
  <div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
              <div class="widget-content widget-content-area br-6">
    <div class="row">
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
<div class="content-wrapper">
    <section class="content-header">
      <h1>Role List <a href=""  class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal" style="position:absolute; right:5%">Create New Role</a></h1>
    </section>
    
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
             
            </div>
            <!-- /.box-header -->
            @if(\Session::has('msg'))
            <div class="alert alert-success">
            {{\Session::get('msg')}}
            </div>
            @endif
          </div>
          @if($errors->any())
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            {{$error}}
            @endforeach
            </div>
          @endif
          <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="modal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Create Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                         <form action="{{route('role_create')}}" method="post">
                         @csrf
                           <div class="form-group">
                               <label for="exampleFormControlInput1">Role </label>
                               <input type="text" class="form-control" id="exampleFormControlInput1" name="role" required>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
           </div>
        </div>
      </div>
      </div>
    </section>
<div class="container">
<ul class="list-group">
    @foreach($role as $row)
    <span class="p-3 border rounded m-1">{{ucfirst($row->name)}} Permissions<button class="btn btn-defalut btn-sm show_hide{{$row->id}}" style="position:absolute; right:10%; font-size:15px; font-weight:bold">+</button></span>
    <div class="slidingDiv{{$row->id}}">
      <form method="post" action="{{route('role_permission')}}">
        @csrf
        <input type="hidden" value="{{$row->id}}" name="role_id" > 
     @foreach($permission as $row)
     
     <li><span style="font-weight:bold; font-size:18px;">{{ucfirst($row->module)}}</span></li>
    
     @foreach($row->sub_module as $value)
    <label class="checkbox-inline p-4 text-dark">
      <input type="checkbox" value="{{$value->id}}" name="permission_id[]">&nbsp;{{ucfirst($value->name)}}
    </label>
     @endforeach
     @endforeach
     <input type="submit" class="btn btn-primary" value="Submit" style="position:absolute; right:10%;">
     </form>
    </div>
   @endforeach
</ul>
</div>
  </div>
  
  @endsection
  @section('footerSection')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  @foreach($role as $row)
 <script>
   $(document).ready(function() {
  $(".slidingDiv{{$row->id}}").hide();
  $('.show_hide{{$row->id}}').click(function(e) {
    $(".slidingDiv{{$row->id}}").slideToggle("fast");
    var val = $(this).text() == "-" ? "+" : "-";
    $(this).hide().text(val).fadeIn("fast");
    e.preventDefault();
  });
});
</script>
@endforeach
  @endsection
