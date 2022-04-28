<x-app 
    title="{{ $title }}"
    style="
        <link rel='stylesheet' href='{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}'>
        <link rel='stylesheet' href='{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}'>
        <link rel='stylesheet' href='{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}'>
    "
    script="
        <script src='{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/jszip/jszip.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}'></script>
        <script src='{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}'></script>
        <script src='{{ asset('assets/custom/js/master/question/question.js') }}'></script>
    "
    >

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Master</li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Correct Answer</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assessments as $key => $assessment)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $assessment->fullname }}</td>
                                                <td>{{ $assessment->type }}</td>
                                                <td>{{ $assessment->title }}</td>
                                                <td>{{ $assessment->correct_answer }}</td>
                                                <td>{{ $assessment->status }}</td>
                                            </tr>
                                        @endforeach
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</x-app>
