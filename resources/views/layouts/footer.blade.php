
    <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    
    <!-- <script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script> -->
    
    <script src="{{asset('js/select2.full.min.js')}}"></script>
    
    <!-- <script src="{{asset('morris.min.js')}}"></script> -->
    
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
    
    <script src="https://momentjs.com/downloads/moment.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- <script src="{{asset('assets/js/apps/mailbox-chat.js')}}"></script> -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('plugins/editors/markdown/simplemde.min.js')}}"></script>
    <script src="{{asset('plugins/editors/markdown/custom-markdown.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    
@section('footerSection')
@show