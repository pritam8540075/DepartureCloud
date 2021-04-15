<style>
    .top{top:10px;}
    .top:hover{
        background:#A9A9A9;
        padding:3px;
        border-radius:5px;
    }
    .dep-cloud{padding: 6px 12px;color: #000;} 
    .dep-cloud:hover{background: #bfc9d4;
    box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
    border-radius: 6px;color:#000;text-decoration:none;}
</style>
@if(Auth::user()->main_user_type == 2)

<div class="d-flex justify-content-end pr-5 w-100">
    <div class="ml-1"><a href="{{route('all_departure')}}" class="dep-cloud">Active Departures</a></div>
    <div class="ml-1"><a href="{{route('unapproved_departure')}}" class="dep-cloud" >Pending For Approval</a></div>
    <div class="ml-1"><a href="{{route('inactive_depature')}}" class="dep-cloud" >Inactive Departures</a></div>
    <div class="ml-1"><a href="{{route('suplier_list')}}" class="dep-cloud" >Supplier List</a></div>
    <div class="ml-1"><a href="{{route('user_list')}}" class="dep-cloud" >Buyer List</a></div>
</div>
@elseif(Auth::user()->main_user_type == 1)

<div class="d-flex justify-content-end pr-5 w-100">
    <div class="ml-1"><a href="{{route('all_departure')}}" class="dep-cloud">All Departures</a></div>
    <div class="ml-1"><a href="{{route('departure')}}" class="dep-cloud" >My Departures</a></div>
    <div class="ml-1"><a href="{{route('my_booking')}}" class="dep-cloud" >My Booking</a></div>
    <div class="ml-1"><a href="{{route('profile')}}" class="dep-cloud" >Company Profile</a></div>
</div>
@else 
<div class="d-flex justify-content-end pr-5 w-100">
    <div class="ml-1"><a href="{{route('all_departure')}}" class="dep-cloud">All Departures</a></div>
    <div class="ml-1"><a href="{{route('my_booking')}}" class="dep-cloud" >My Booking</a></div>
    <div class="ml-1"><a href="{{route('profile')}}" class="dep-cloud" >Company Profile</a></div>
</div>
@endif