<ul role="tablist" class="tabclass">
  @if(request()->route('id'))
    <li class="tab-departure">
      <a class="btn btn-primary not-active0" href="{{route('departure_edit',request()->route('id'))}}">
        <span class="Dep_basic_details step">Basic Detail</span>
      </a>
    </li>
    <li class="tab-departure">
      <a class="btn btn-primary not-active1" href="{{route('inclusion',request()->route('id'))}}">
        <span class="inclusions step">Inclusions</span>
      </a>
    </li>
    <li class="tab-departure">
      <a class="btn btn-primary not-active2" href="{{route('pdf_itinerary',request()->route('id'))}}">
        <span class="inclusions step">Itinerary</span>
      </a>
    </li>
    <li class="tab-departure not-active2">
      <a class="btn btn-primary rrmenu" href="{{route('terms_payment',request()->route('id'))}}">
        <span class="itinerarymenu step">Terms of Payment</span>
      </a>
    </li>
  @else
    <li class="tab-departure active">
      <a class="btn btn-primary not-active0" href="{{route('departure_create')}}">
        <span class="Dep_basic_details step">Dep basic details</span>
      </a>
    </li>
    <li class="tab-departure not-active1">
      <a class="btn btn-primary rrmenu" href="#">
        <span class="inclusions step">Inclusions</span>
      </a>
    </li>
    <li class="tab-departure not-active2">
      <a class="btn btn-primary rrmenu" href="#">
        <span class="itinerarymenu step">Itinerary</span>
      </a>
    </li>
    <li class="tab-departure not-active2">
      <a class="btn btn-primary rrmenu" href="#">
        <span class="itinerarymenu step">Terms of Payment</span>
      </a>
    </li>
  @endif
</ul>
<style type="text/css">
  .rrmenu {
      cursor: no-drop !important;
  }
</style>