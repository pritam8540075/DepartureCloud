@extends('layouts.app')

@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection

            <div class="layout-px-spacing">
            @if(session()->has('msg'))
            <div class="alert alert-success">
            {{ session()->get('msg') }}
           </div>
            @endif
            
              <div class="widget-content widget-content-area br-6">
               <div class="table-responsive mb-4 mt-4">
               <h1>Hold History</h1>
                <table class="table" id="departureTable">
                  <thead>
                    <tr>
                     <th>Sl.</th>
                     <th>Holded</th>
                     <th>H-Email</th>
                     <th>Dep Name</th>
                     <th>Dep Owner</th>
                     <th>H-Seat</th>
                     <th>H-Duration</th>
                     <th>Auto-Release</th>
                     <th>Price</th>
                     <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   @foreach($hold as $key => $row)
                   <tr>
                      <td>{{$key+1}}</td>
                      @foreach($row->hold as $value)
                      <td>{{$value->company_name}}</td>
                      <td>{{$value->email}}</td>
                      @endforeach
                      <td>{{$row->title}}</td>
                      <td>{{$row->company_name}}
                      <td>{{$row->hold_seat}} Unit</td>
                      <td>{{$row->hold_duration}} hours</td>
                      <td> {{date('d-M-Y', strtotime($row->date))}}</td>
                      <td>Rs.{{$row->price_inr}}<br>{{$row->price_usd}} $</td>
                      <td><a class="btn btn-danger btn-sm disableDepartue" data-id="{{ $row->hold_id }}" data-status="{{ $row->status }}">Force Release</a></td>
                   </tr>
                   @endforeach
                   
                  </tbody>
                </table>
               {{$hold->links()}}
               </div>
               </div>
               </div>
@endsection
@section('footerSection')
  <script type="text/javascript">
    $(".disableDepartue").click(function () {
      if (confirm("Are you sure you want to release this Departure?"))
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      if(id){
      $.ajax({
        url: '/forcehold/departure/release/' + id,
        type: 'GET',
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
        $('#departureTable').DataTable({
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