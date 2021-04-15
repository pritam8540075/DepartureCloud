<div class="box-body">
  <table class="table table-bordered">
    <tbody>
      
        <tr>
          <th>#</th>
          <th>Day</th>
          <th>Heading</th>
          <th>Destinations</th>
          <th>POIs</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      @if(count($itineraries) > 0)
        @foreach($itineraries as $itinerary)
          <tr>
            <td>{{$loop->index +1}}</td>
            <td>{{$itinerary->day_number}}</td>
            <td>{{$itinerary->day_heading}}</td>
            <td>@if(count($data_dest) > 0 )
                  @foreach($data_dest as $dest)
                    @if($itinerary->id == $dest->itinerary_id)
                      {{$dest->dest_name}} ,
                    @endif
                  @endforeach
                @endif 
            </td>
            <td>
              @if(count($data_poi) > 0 )
                @foreach($data_poi as $poi)
                  @if($itinerary->id == $poi->itinerary_id)
                    {{$poi->poi_name}} ,
                  @endif
                @endforeach
              @endif 
            </td>
            <td>
              @if($itinerary->status == '1')
                <a class="disableItinerary" data-id="{{ $itinerary->id }}" data-status="{{ $itinerary->status }}" style="cursor: pointer; color: #2f8263;">
                  Active
                </a>
              @else
                <a class="disableItinerary" data-id="{{ $itinerary->id }}" data-status="{{ $itinerary->status }}" style="cursor: pointer; color: #F9423C;">
                  Inactive
                </a>
              @endif
              
            </td>
            <td>
              <span class="dropdown">
                  <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-ellipsis-h" aria-hidden="true" style="color:red"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item edit edit-item"  data-toggle="modal" data-id="{{ $itinerary->id }}" data-daynumber="{{ $itinerary->day_number }}" data-dayheading="{{ $itinerary->day_heading }}" data-description="{{ $itinerary->description }}"data-inclusionID="{{ JSON_encode($itinerary->inclusion) }}"  data-inclusionName="{{ JSON_encode($itinerary->inclusion_name) }}" data-destinationid="{{JSON_encode($itinerary->destination_id) }}" data-destinationname="{{JSON_encode($itinerary->destination_name) }}" data-poiid="{{JSON_encode($itinerary->poi_id) }}" data-poiname="{{JSON_encode($itinerary->poi_name) }}"  title="Edit details" style="cursor: pointer;">
                      <i class="fa fa-edit"></i> 
                        Edit Itinerary
                    </a>
                    
                  </div>
              </span>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>
<div class="box-footer clearfix">
  <ul class="pagination pagination-sm no-margin pull-right">
  </ul>
</div>