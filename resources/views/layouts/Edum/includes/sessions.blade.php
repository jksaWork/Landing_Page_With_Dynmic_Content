<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
                <h1>
                    {{session()->get('success')}}
                </h1>
        </div>
        {{-- <script>
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("Are you the six fingered man?");
        </script> --}}
        {{ session()->forget('success') }}
        @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{-- <div class="h1"> --}}
                <h1 class="mb-1 text-dark">{{ session()->get('error')}}</h1>
            {{-- </div> --}}
        </div>
        {{ session()->forget('error') }}
        {{-- <script>
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.error("New order has been placed!");
        </script> --}}
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error )
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endforeach
@endif
</div>
