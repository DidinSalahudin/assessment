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
        <script src='{{ asset('assets/custom/js/form/assessment/assessment.js') }}'></script>
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
                    @if (count($question_details) == 0)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary" onclick="alertAddAssessment(this, {{ Auth::user()->id }}, '{{ route('assessment.store') }}')">Add Assessment</button>                                   
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($question_details as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><b>{{ $item->type }}</b></h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <h3>{{ $item->title }}</h3>
                                        <p>{{ gmdate("H:i:s", $item->time) }}</p>
                                    </div>
                                    <div class="card-footer">
                                        @if ($item->status == 'registration')
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-instruction">Start Assessment</button>
                                        @else
                                            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-instruction">Continue Assessment</button>    
                                        @endif
                                        <div class="modal fade" id="modal-instruction">
                                            <div class="modal-dialog modal-instruction">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ $item->title }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= $item->instruction ?>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a href="{{ route('assessment.exam', $item->id) }}" class="btn btn-primary">Start</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach                     
                    @endif
                </div>
            </div>
        </section>
    </div>
</x-app>
