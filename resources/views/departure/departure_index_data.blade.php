<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
input[type="text"]::placeholder {
  font-size: 10px;
}
</style>
<div class="box-body">
            <table id="booking" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Dep. ID</th>
                    <th>Dep. Name</th>
                    <th>Dep. From</th>
                    <th>Dep. To</th>
                    <th>Dep. Date</th>
                    <th>No of N/D</th>
                    <th>Total Units</th>
                    <th>Booked Units</th>
                    <!-- <th>Booked Date</th> -->
                    <th>Price(Per PAX)</th>
                    <!-- <th style="width: 5%">Update Price</th> -->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                </tbody>
                @if(count($departures)> 0 )
                  @foreach( $departures as $key => $departure )
                    <tr>
                      <td>{{ $departure->dep_id }}</td>
                      <td>
                        <a href="{{route('departure_details',$departure->id)}}" style="text-decoration:none">{{$departure->title}}</a>
                      </td>
                      <td>{{$departure->from}}</td>
                      <td>{{$departure->ending_at}}</td>
                      <td>{{date('d-M-Y', strtotime($departure->start_from))}}</td>
                      <td>{{$departure->no_of_nights}}N/{{$departure->no_of_days}}D</td>
                      <td>{{$departure->total_seat}}</td>
                      <td>{{$departure->book_sum + $departure->single_book_sum}}</td>
                      @if(ucfirst(auth::user()->country) == 'India')
                      <td>₹ {{$departure->price_inr}}</td>
                        @else 
                      <td>{{$departure->price_usd}} $</td>
                        @endif
                      <!-- <td><a data-toggle="modal" data-target="#edit-price" data-id="{{ $departure->id }}" class="edit-item" title="Update Price" style="margin-left: 5px;cursor: pointer;">Update Price</a></td> -->
                      <!-- <div class="col-md-3 col-sm-3 col-3 mb-5">
                         <div class="dropdown  custom-dropdown-icon">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="btnDropLeftOutline">
                            
                            </div>
                          </div>
                      </div>  -->
                       <td>
                              @if($departure->status == 1 )
                                <a class="badge badge-success text-light badge-lg mb-2 text-uppercase font-weight-bold disableDepartue" style="cursor: pointer; color: #2f8263;" data-id="{{ $departure->id }}" data-status="{{ $departure->status }}">Published
                                </a>
                              @else
                              <a class="badge badge-danger text-light badge-lg  mb-2 text-uppercase font-weight-bold" style="cursor: pointer; color: #F9423C;">
                                Unpublished
                              </a>
                              @endif
                              @if($departure->approve == 1)
                              <a class="badge badge-success text-light badge-lg mb-2 text-uppercase font-weight-bold" style="cursor: pointer; color: #2f8263;">Approve
                              </a>
                              @else
                              <a class="badge badge-danger text-light badge-lg  mb-2 text-uppercase font-weight-bold" style="cursor: pointer; color: #F9423C;">
                                Under the Review
                              </a>
                              @endif
                              @if($departure->total_seat-($departure->single_book_sum+$departure->book_sum+$departure->hold_sum) > 0 )
                                <a class="badge badge-success text-light badge-lg mb-2 text-uppercase font-weight-bold" style="cursor: pointer; color: #2f8263;">Open
                                </a>
                              @else
                              <a class="badge badge-danger text-light badge-lg mb-2 text-uppercase font-weight-bold" style="cursor: pointer; color: #F9423C;">
                                Sold Out
                              </a>
                              @endif
                        </td>
                      <td>
                      
                      <div class="col-md-3 col-sm-3 col-3 mb-5">
                         <div class="dropdown  custom-dropdown-icon">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="btnDropLeftOutline">
                              <a href="{{route('departure_details',$departure->id)}}" class="dropdown-item">View Departure</a> 
                              <a href="{{route('departure_edit',$departure->id)}}" class="dropdown-item">Edit Departure</a>
                              <a href="" class="dropdown-item"  data-toggle="modal" data-target="@if(($hold < $date) && ($departure->available_seat > 0))#modal{{$departure->id}}@endif">Hold Departure</a>
                              <a href="" class="dropdown-item"   data-toggle="modal" data-target="@if((($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)) != 0) .bd-example-modal-sm{{$departure->id}}b @endif">Book Departure</a>
                              <a href="{{url('/departure/booking/history/'.$departure->id)}}" class="dropdown-item">Booking History</a>  
                            </div>
                          </div>
                      </div> 

                          <!----Modal-->
                          <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="modal{{$departure->id}}" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mySmallModalLabel">Hold Departure</h5>
                                                <button type="button" class="close" data-dismiss="modal" id="" aria-label="Close">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                               </button>
                                          </div>
                                          
                                          <form action="{{route('departure_holdduration')}}" method="post">
                                          @csrf
                                          <div class="modal-body">
                                          <div class="row">
                                              <div class="col-md-3 col-lg-3 col-sm-12">
                                                  <div class="form-group">
                                                    <label for="exampleFormControlInput1">Avl Units</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="available" value="{{($departure->total_seat)-($departure->hold_sum + $departure->book_sum + $departure->single_book_sum)}}" readonly>
                                                  </div> 
                                              </div>
                                              <div class="col-md-5 col-lg-5 col-sm-12">
                                                  <div class="form-group">
                                                        <input type="hidden" name="id" value="{{$departure->id}}">
                                                        <input type="hidden" name="current_hours" value="{{date('H')}}">
                                                        <input type="hidden" name="current_minutes" value="{{date('i')}}">
                                                        <label for="formGroupExampleInput">Hold Duration</label>
                                                        <input type="text" class="form-control" id="exampleFormControlSelect2"  value="{{date('d-M-Y H:i', strtotime("+{$departure->hold_duration} hours"))}}" readonly>
                                                        <input type="hidden" class="form-control" name="hours" value="{{$departure->hold_duration}}" readolny>
                                                    </div>
                                            </div>
                                              <div class="col-md-4 col-lg-4 col-sm-12">
                                                  <div class="form-group">
                                                    <label for="exampleFormControlInput1">Required Units</option></label>
                                                    <input type="number" class="form-control" id="check{{$departure->id}}" name="hold" placeholder="" required>
                                                  </div> 
                                              </div>
                                            
                                           <span class="text-danger" id="message{{$departure->id}}"></span>
                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <div class="form-group">
                                                      <label for="exampleFormControlInput1"><br>Note</option></label>
                                                      <textarea name="note" class="form-control" required></textarea>
                                                  </div>
                                            </div>
                                          <div class="modal-footer">
                                              <button class="btn btn-md" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                              <button type="submit" class="btn btn-primary btn-md">Hold Departure</button>
                                          </div>
                                          </form>
                                       </div>
                                  </div>
                            </div>
                             <!----End Modal-->

                              <!----Modal-->
                              <!-- <div class="modal fade bd-example-modal-sm" id="AA{{$departure->id}}b" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mySmallModalLabel">Book Departure</h5>
                                                <button type="button" class="close" data-dismiss="modal"  id="3{{$departure->id}}" aria-label="Close">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                               </button>
                                          </div>
                                          
                                          <form action="{{route('departure_book')}}" method="post">
                                          @csrf
                                          <div class="modal-body"> 
                                           <div class="form-group">
                                           <label for="exampleFormControlInput1">Available Units</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{($departure->total_seat)-($departure->hold_sum + $departure->book_sum)}}" readonly>
                                           </div> 
                                           <div class="form-group">
                                           <input type="hidden" name="id" value="{{$departure->id}}">
                                            <label for="exampleFormControlInput1">Required Units</label>
                                            <input type="number" class="form-control" id="book{{$departure->id}}" name="book" placeholder="" required>
                                           </div> 
                                           <div class="form-group">
                                            <label for="exampleFormControlInput1"><br>Note</option></label>
                                            <textarea name="note" class="form-control" required>note...</textarea>
                                           </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" id="4{{$departure->id}}"><i class="flaticon-cancel-12"></i> Discard</button>
                                            <button type="submit" class="btn btn-primary">Book</button>
                                            </div>
                                            </form>
                                      </div>
                               </div>
                            </div> -->
                             <!----End Modal-->
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
          </table>   
</div>
            
@section('footerSection')
<script>
        $('#booking').DataTable({
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
<script>
  $('.widget-content .custom-width-padding-background').on('click', function () {
  swal({
    title: 'Custom width, padding, background.',
    width: 600,
    padding: "7em",
    customClass: "background-modal",
    background: '#fff url(assets/img/sweet-bg.jpg) no-repeat 100% 100%',
  })
}) 
</script>
<script type="text/javascript">
  $(".disableDepartue").click(function () {
    if (confirm("Are you sure you want to "+flag+" this departure?"))
    var id = $(this).data("id");
    var status = $(this).data("status");
    var flag = (status == 2)?'inactive':'active';
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
        window.location.reload();
      }
    });
    }
  });
</script>


@foreach( $departures as $row )


<?php         
    if(ucfirst(auth::user()->country) == 'India'){
      $value = intval($row->price_inr);
      $single_value=intval($row->single_supplyment_price_inr);
    }else{
      $value= intval($row->price_usd);
      $single_value=intval($row->single_supplyment_price_usd);
    }
                  
?>

<!----Modal-->
<div class="modal fade bd-example-modal-sm{{$row->id}}b" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-mb" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="mySmallModalLabel">Book Departure</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="">
                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                      </button>
                </div>
                
                <form action="{{route('departure_book')}}" method="post">
                @csrf
                <div class="modal-body"> 
                <div class="form-group">
                  <label for="exampleFormControlInput1">Available Units<span style="position:absolute; right:10%">Price(PAX)</span></label>
                  <input type="text" class="form-control" id="" style="width:60%" name="available" value="{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}" readonly>
                  <span style="position:absolute; right:10%; top:15%">
                    @if(ucfirst(auth::user()->country) == 'India')
                    ₹ {{intval($row->price_inr)}}
                    @else
                      {{intval($row->price_usd)}} $
                    @endif
                    </span>
                  </div> 
                  <div class="form-group">
                  <input type="hidden" name="id" value="{{$row->id}}">
                  <label for="exampleFormControlInput1">Required Units</label>
                  <input type="number" class="form-control" style="width:60%" id="book{{$row->id}}" name="book" placeholder="" required>
                  <span style="position:absolute; right:10%; top:35%" id="required_pricebook{{$row->id}}"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Single Supplement 
                    @if(ucfirst(auth::user()->country) == 'India')
                    (INR {{intval($row->single_supplyment_price_inr)}})
                    @else
                    (USD {{intval($row->single_supplyment_price_usd)}})
                    @endif
                    </label>
                    <input type="checkbox" id="isAgeSelected{{$row->id}}"/>
                    <div id="txtAge{{$row->id}}" style="display:none">
                    <input type="number" style="width:60%" class="form-control" id="single_bookbook{{$row->id}}" name="single_book" placeholder="Required Units">
                    <span style="position:absolute; right:10%; top:55%" id="single_pricebook{{$row->id}}">
                    </span>
                   
                    </div>
                    </div>
                    <span style="position:absolute; right:22%; bottom:25%" id="msg">Total Price</span>
                    <span style="position:absolute; right:10%; bottom:25%" id="total_pricebook{{$row->id}}">
                    </span>
                  <div class="form-group">
                  <label for="exampleFormControlInput1">Note</label>
                  <textarea name="note" class="form-control" required>note...</textarea>
                  </div> 
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" id=""><i class="flaticon-cancel-12"></i> Close</button>
                  <button type="submit" class="btn btn-primary">Book Departure</button>
                  </div>
                  </form>
            </div>
      </div>
  </div>
    <!----End Modal-->

<script>
$('#check{{$row->id}}').keyup(function(){
  var value = $(this).val();
  var total = '{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}';
  var subtotal = value-total;
  if($(this).val()>{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}){
    //alert('Your are Request ' +subtotal + ' Extra Departure');
    $("#message{{$row->id}}").text('Your are Request ' +subtotal+" Extra Departure");
   //$(this).val('')
  }
});

</script>
   
<script>
$('#book{{$row->id}}').keyup(function(){
  if($(this).val()>{{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}){
    alert('Value can not be greater than {{($row->total_seat)-($row->hold_sum + $row->book_sum + $row->single_book_sum)}}');
    $(this).val('')
  }
});
$("#book{{$row->id}}").keyup(function () {
    var required = $("#book{{$row->id}}").val();
    var price = '{{$value}}'
    var sum = parseInt(required) * parseInt(price);

    var required1 = $("#single_bookbook{{$row->id}}").val();
    var price1 = '{{$single_value}}'
    var sum1 = parseInt(required1) * parseInt(price1);
    var total = sum+sum1;

    //alert(sum);
    $("#required_pricebook{{$row->id}}").html(sum);

    $("#total_pricebook{{$row->id}}").html(sum);
})
$("#single_bookbook{{$row->id}}").keyup(function () {
    var required = $("#single_bookbook{{$row->id}}").val();
    var price = '{{$single_value}}'
    var sum = parseInt(required) * parseInt(price);
    //alert(sum);
    $("#single_pricebook{{$row->id}}").html(sum);

    var required1 = $("#book{{$row->id}}").val();
    var price1 = '{{$value}}'
    var sum1 = parseInt(required1) * parseInt(price1);
    var total = sum+sum1;
    $("#total_pricebook{{$row->id}}").html(total);
})
</script>

<!-- <script>
  $(document).ready(function(){
    $("#1{{$row->id}}").click(function(){
      location.reload(true);
    });
  });
  $(document).ready(function(){
    $("#2{{$row->id}}").click(function(){
      location.reload(true);
    });
  });
  $(document).ready(function(){
    $("#3{{$row->id}}").click(function(){
      location.reload(true);
    });
  });
  $(document).ready(function(){
    $("#1{{$row->id}}").click(function(){
      location.reload(true);
    });
  });
</script> -->







<script>
 $('.edit-item').click(function(){
   $("#pricingModule").html('');
   var id = $(this).data("id");
   $('#editModal').modal('show');
   if(id){
     $('#edit_id').val(id);
       $.ajax({
          type:"GET",
          url:"{{url('/get_pricing_ajax')}}?departure_id="+id,
          success:function(res){
           if(res && res.length > 0){  
             var html = '';
                 for(data of res){
                   if(data.pricing && data.pricing.price_inr){
                     var priceInr = data.pricing.price_inr?data.pricing.price_inr:'';
                     var priceUsd = data.pricing.price_usd?data.pricing.price_usd:'';
                   }else{
                     var priceInr = '';
                     var priceUsd = '';
                   }
                   html+='<div class="row"><div class="col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 20px;"></div></div>';
                 }  
                 $("#pricingModule").html(html);

           }else{
              $("#pricingModule").empty();
           }
          }
       });
   }else{
       $("#pricingModule").empty();
   }
 })    
</script>
<script>
$('#isAgeSelected{{$row->id}}').click(function() {
    $("#txtAge{{$row->id}}").toggle(this.checked);
});
</script>
@endforeach


@endsection