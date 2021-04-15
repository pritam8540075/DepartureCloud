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
      <h1>User List <a href=""  class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal" style="position:absolute; right:3%">Create New User</a></h1>
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
    </section>
    <div class="container">
      <table class="table table-bordered">
         <thead>
            <tr>
             <th>Sl</th>
             <th>User Name</th>
             <th>Email</th>
             <th>Mobile</th>
             <th>Role</th>
             <th>Status</th>
             <th>Action</th>
            </tr>
         </head>
         <tbody>
             @foreach($user as  $key => $row)
            <tr>
             <td>{{$key + 1}}</td>
             <td>{{$row->name}}</td>
             <td>{{$row->email}}</td>
             <td>{{$row->mobile}}</td>
             <td>
             @foreach($row->sub_name as $value)
             <span class="badge badge-success text-light p-1"> {{$value->name}}</span>
             @endforeach
             </td>
             <td>@if($row->status == 0)
                  <a class="userdiasable badge badge-danger text-light" data-id="{{ $row->id }}" data-status="{{ $row->status }}" style="cursor: pointer; color: #2f8263;">Deactive
                  </a>
                  @else
                  <a class="userdiasable badge badge-success text-light" data-id="{{ $row->id }}" data-status="{{ $row->status }}" style="cursor: pointer; color: #F9423C;">
                  Active
                  </a>
                @endif
             <td>
             
             <div class="col-md-3 col-sm-3 col-3 mb-5">
                         <div class="dropdown  custom-dropdown-icon">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="btnDropLeftOutline">
                              <a href="" class="dropdown-item"   data-toggle="modal" data-target="#modal{{$row->id}}" >Edit</a>
                              <!-- <a href="" class="dropdown-item"   data-toggle="modal" data-target="">Email Send Again</a>          -->
                            </div>
                          </div>
                      </div> 
                      <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="modal{{$row->id}}" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Update User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                         <form action="{{route('user_create')}}" method="post">
                         @csrf
                         <div class="row">
                         <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">User Name </label>
                               <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{$row->name}}" required>
                           </div>
                          </div>
                          <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">Email </label>
                               <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{$row->email}}" required>
                           </div>
                          </div>
                          <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">Phone </label>
                               <input type="text" class="form-control" id="exampleFormControlInput1" name="phone" value="{{$row->mobile}}" required>
                           </div>
                          </div>
                          <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">Role</label>
                               <select class="form-control" name="role">
                                    @foreach($role as $row)
                                    <option value="{{$row->id}}" >{{$row->name}}</option>
                                   @endforeach 
                               </select>
                           </div>
                          </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                  </div>
               </div>
              </div>
             </div>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
  </div>

  

  <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="modal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Create User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                         <form action="{{route('user_create')}}" method="post">
                         @csrf
                         <div class="row">
                         <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">User Name </label>
                               <input type="text" class="form-control" id="exampleFormControlInput1" name="name" required>
                           </div>
                          </div>
                          <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">Email </label>
                               <input type="email" class="form-control" id="exampleFormControlInput1" name="email" required>
                           </div>
                          </div>
                          <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">Phone </label>
                               <input type="text" class="form-control" id="exampleFormControlInput1" name="phone" required>
                           </div>
                          </div>
                          <div class="col-6"> 
                           <div class="form-group">
                               <label for="exampleFormControlInput1">Role</label>
                               <select class="form-control" name="role">
                                    @foreach($role as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                   @endforeach 
                               </select>
                           </div>
                          </div>
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

  @endsection
  @section('footerSection')
  <script type="text/javascript">
  $(".userdiasable").click(function () {
    var flag = (status == 0)?'active':'inactive';
    if (confirm("Are you sure you want to "+flag+" this User?"))
    var id = $(this).data("id");
    var status = $(this).data("status");
    
    var token = $("meta[name='csrf-token']").attr("content");
    if(id){
    $.ajax({
      url: '/departure/user/disable/' + id,
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
  @endsection
