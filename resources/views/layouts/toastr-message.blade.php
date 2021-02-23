<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if(Session::has('success'))
    <script>
        const stringMessage = `{{ Session::get('success') }}`
        toastr.success(stringMessage)
    </script>
@endif

@if(Session::has('error'))
    <script>
        const stringMessage = `{{ Session::get('error') }}`
        toastr.error(stringMessage)
    </script>
@endif