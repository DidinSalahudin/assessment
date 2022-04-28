<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assessment | {{ $title }} </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

    <?= $style; ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <x-navbar></x-navbar>

        <x-sidebar :title="$title"></x-sidebar>
        
        {{ $slot }}        
        
        <x-footer></x-footer>
        
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>


    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var statusError = '{{ session('error') }}';
            if (statusError != '') {
                // setTimeout(() => {
                //     $('#alert_success').slideUp();;
                // }, 3000);
                Toast.fire({
                    icon: 'error',
                    title: '{{ session('error') }}'
                });
            }

            var statusSuccess = '{{ session('success') }}';
            if (statusSuccess != '') {
                // setTimeout(() => {
                //     $('#alert_success').slideUp();;
                // }, 3000);
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            }
        });
    </script>

    <?= $script; ?>
</body>

</html>
