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
                            <div class="card-header">
                                <a href="{{ route('question.create') }}" class="btn btn-primary">Add Question</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($questions as $key => $question)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $question->title }}</td>
                                                <td>{{ $question->type }}</td>
                                                <td>{{ $question->time }}</td>
                                                <td>
                                                    <a href="{{ route('question.edit', $question->id) }}" class="btn btn-success">Edit</a>
                                                    <button type="button" class="btn btn-danger" id="btn-delete" data-id="{{ $question->id }}" data-route="{{ route('question.destroy', $question->id) }}">Delete</button>
                                                    {{-- <span class="action-icon text-danger" title="Hapus" id="btn-hapus" role="button" data-id="{{ $questionCategory->id }}" data-route="{{ route('kategori_soal.destroy', $questionCategory->id) }}"> <i class="mdi mdi-delete"></i></span> --}}
                                                </td>
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
