@extends('layouts.app')
@section('headSection')
@section('title', 'Departure List')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection

@section('content')
@section('headnav') 
@include('layouts.topnav')
@endsection
<div class="layout-px-spacing">
   <div class="chat-section layout-top-spacing">
    <div class="widget-content widget-content-area br-6">
    <section class="content-header">
      <h1>Edit Itinerary</h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-md-12">
                <div class="box box-primary">
                  <div class="steps clearfix text-center">
                    @include('layouts/itinerary_menu')
                  </div>
                </div>
           </div>
        </div>
          <form role="form" id="AgentItineraryForm" enctype="multipart/form-data">
            @csrf
              <div class="box-body">
                <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <div class="form-group">
                    <label>Itinerary Finder Link</label> <span class="validationError" id="title_error"></span>
                    <input type="text" class="form-control" name="title" id="title" value="{{$pdf_itinerary->title}}">
                  </div>
                </div>
               </div>
               <div class="row">
                <!--                 
                <div class="col-md-8 col-lg-8 col-xl-8">
                  <div class="form-group">
                    <label>Terms & Conditions</label> <span class="validationError" id="description_error"></span>
                    <textarea class="form-control" name="description" id="description">{!! $pdf_itinerary->description !!}</textarea>
                  </div>
                </div> -->
                <div class="col-md-4 col-lg-4">
	                <div class="form-group">
	                  <label for="exampleInputFile">Attachment</label> <span class="validationError" id="image_error"></span> 
	                  <input type="file" id="pdf_name" name="pdf_name" accept="application/pdf" onchange="readURL(this);">
	                </div>
	             </div>
              
               <div class="col-md-6 col-lg-6">
                 <br>
                <a href="{{asset($s3url_cloud.$pdf_itinerary->pdf_file)}}"><i class="fa fa-file-pdf-o" style="font-size:30px;color:red"></i> {{$pdf_itinerary->pdf_file}}</a>
               </div>
              
                <div class="col-md-12 col-lg-12 col-sm-12 button-submit">
                  <button class="btn btn-primary active" type="button" id="store_form"><i class="fa fa-save"></i> Next</button>
                  <img src="{{ asset('images/loader.gif') }}" id="gif" style="width: 3%; visibility: hidden;">
                  <span class="text-success" id="mesegese" style="margin-left: 10px"></span>
                </div> 
              </div>
             </div>
             </div>
          </form>
      </div>
      
    </section>
  </div>
  </div>   
                    </div>
              
  <!-- Edit Itinearay Modal-->
    <style type="text/css">
    .steps.clearfix{margin-top:10px}span.step-icon{padding-top:10px}.steps.clearfix>ul>li{display:inline-flex;margin-right:20px}.box.box-primary{border-top-color:#3c8dbc;background:0 0}.radio{display:inline}.radio>label{margin-right:30px}.validationError {color: #ff0c0c;}.button-submit{margin-top: 20px;margin-bottom: 20px}.ck.ck-content.ck-editor__editable {height: 150px;}span.ck-file-dialog-button {display: none;}.steps.clearfix.text-center{margin-top: 20px;padding-bottom: 20px;}.sss{padding: 8}.pwa-editor-bar-panel {display: none !important;}
  </style>
  @endsection
  @section('footerSection')

  <script type="text/javascript">
    $(document).ready(function () {
        $('#store_form').click(function (e) {
            e.preventDefault();
            $('#gif').show();
            $('#gif').css('visibility', 'visible');
            var formDatas = new FormData(document.getElementById('AgentItineraryForm'));
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: "{{ route('pdf_itinerary_update', $pdf_itinerary->id) }}",
                data: formDatas,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#gif').hide();
                    $('#mesegese').html("<span class='sussecmsg'>Success!</span>");
                    //location.reload();
                    //window.location = data.url;
                    window.location.href = "{{ route('terms_payment',request()->route('id')) }}}";
                },
                errors: function () {

                }
            });
        });
    });   
  </script>
  <script>
    $(document).ready(function() {
      $('#description').summernote({
        toolbar: [
            ['style', ['style']],
            ['style', ['bold', 'italic', 'underline']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ],
        callbacks: {
            onPaste: function (e) {
              var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');
              var bufferText1 = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
              e.preventDefault();
              var div = $('<div />');
              div.append(bufferText);
              div.find('*').removeAttr('style');
              setTimeout(function () {
              if(bufferText){
                document.execCommand('insertHtml', false, div.html());
              }else{
                document.execCommand('insertText', false, bufferText1);
              }
              }, 10);
            }
          },
        styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
        height:150,
        focus: true
      });
    });
  </script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
  @endsection
