$("#day").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which != 43)  && e.which != 107 && (e.which < 48 || e.which > 57)) {
          //display error message
          $("#day_error").html("Digits Only").
          show().fadeOut(3000);
          return false;
        }
    });

     $('.destinations').select2({
      placeholder: 'Select Destination(s)',
     });
     $('.edit_destinations').select2();
        //{
    //         placeholder: 'Select Destination(s)',
    //         ajax: {
    //             url: "/get-itinerary_destination-ajax",
    //             dataType: 'json',
    //             delay: 250,
    //             processResults: function (data) {
    //                 return {
    //                     results: $.map(data, function (item) {
    //                         return {
    //                             text: item.dest_name,
    //                             id: item.id
    //                         }
    //                     })
    //                 };
    //             },
    //             cache: true
    //         }
    //     });
    $('.pois').select2();
    $('.edit_pois').select2();
// itinerary ckeditor
    $(document).ready(function() {
      $('#inclusion').summernote({
          height: 100,
          focus: true
        });
      $('#exclusion').summernote({
          height: 100,
          focus: true
        });
      $('#edit_inclusion').summernote({
          height: 100,
          focus: true
        });
      $('#edit_exclusion').summernote({
          height: 100,
          focus: true
        });
      $('#description').summernote({
          height: 100,
          focus: true
        });
      $('#edit_description').summernote({
          height: 100,
          focus: true
        });
    });
