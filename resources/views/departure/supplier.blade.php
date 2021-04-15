@extends('layouts.app')

@section('content')
@section('headnav') 

<link href="{{('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
@include('layouts.topnav')
@endsection
  <div class="layout-px-spacing">
    <div class="chat-section layout-top-spacing">
      <div class="widget-content widget-content-area br-6">
        <div class="table-responsive mb-4 mt-4">
          <h1>Supplier List
          <span class="btn btn-info btn-sm pull-right">Total Supplier <span style="color:#ffeb00">{{count($userlist)}}</span></span>
          </h1>
                <table class="table" id="supplier">
                  <thead>
                    <tr>
                     <th>Sl</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>Company</td>
                     <th>Company Id</th>
                     <th>Status</th>
                     <th>User Type</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($userlist as $key => $row)
                   <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->email}}</td>
                      <td>{{$row->mobile}}</td>
                      <td>{{$row->company_name}}</td>
                      <td>{{$row->tenant_id}}</td>
                      <td>@if($row->verified==0)
                           <span class="badge badge-danger status" data-id="{{ $row->id }}" data-status="{{ $row->varified }}">Not Varifiyed</span>
                          @else
                          <span class="badge badge-success status" data-id="{{ $row->id }}" data-status="{{ $row->varified }}">Varifiyed</span>
                          @endif
                      </td>
                      <td>@if($row->main_user_type == 1)
                      <span class="badge badge-danger user-change" data-id="{{ $row->id }}" data-status="{{ $row->main_user_type }}"> Suplier</span>
                      @endif
                      </td>
                   </tr>
                   @endforeach
                   
                  </tbody>
                </table>
               {{$userlist->links()}}
               </div>
               </div>
               </div>
             </div>
@endsection

@section('footerSection')

<script type="text/javascript">
  $(".user-change").click(function () {
    if (confirm("Are you sure you provide Buyer this user?"))
    var id = $(this).data("id");
    var status = $(this).data("status");
    var flag = (status == 0)?'Buyer':'Buyer & Supplier';
    var token = $("meta[name='csrf-token']").attr("content");
    if(id){
    $.ajax({
      url: '/user-type-change/' + id,
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
<script type="text/javascript">
  $(".status").click(function () {
    if (confirm("Are you sure you want "+flag+" this user?"))
    var id = $(this).data("id");
    var status = $(this).data("status");
    
    var flag = (status == 0)?'Varified':'Unvarified';
    
    var token = $("meta[name='csrf-token']").attr("content");
    if(id){
    $.ajax({
      url: '/user-status-change/' + id,
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
        $('#supplier').DataTable({
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