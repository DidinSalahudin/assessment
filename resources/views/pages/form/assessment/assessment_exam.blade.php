<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assessment | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

    <style>
        #clockdiv{
            font-family: sans-serif;
            color: #fff;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 32px;
        }

        #clockdiv > div{
            padding: 2px;
            display: inline-block;
        }

        #clockdiv div > span{
            padding: 5px;
            border-radius: 3px;
            background: #00816A;
            display: inline-block;
        }

        .smalltext{
            padding-top: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-sm btn-info" href="{{ route('assessment.index') }}" id="btn-back" role="button">
                        Back
                    </button>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                
                <p class="brand-link text-center">
                    <span class="brand-text font-weight-bold">Assessment</span>
                </a>
                    
                <nav class="mt-2">
                    <div class="row text-center mt-5 mb-5">
                        <div class="col-12">
                            <div id="clockdiv">
                                <div>
                                    <span class="hours"></span>
                                    <div class="smalltext">Hours</div>
                                </div>
                                <div>
                                    <span class="minutes"></span>
                                    <div class="smalltext">Minutes</div>
                                </div>
                                <div>
                                    <span class="seconds"></span>
                                    <div class="smalltext">Seconds</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center mb-2">
                        <div class="col-12">
                            <button class="btn btn-default btn-block" id="btn-preview">Preview</button>
                        </div>
                    </div>
                    <div class="row text-center mb-2">
                        <div class="col-12">
                            <button class="btn btn-success btn-block" id="btn-finish">Finish</button>
                        </div>
                    </div>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 text-center">
                        <div class="col-sm-12">
                            <h1><b>{{ $title }}<b></h1>
                            <input type="hidden" name="assessment_id" id="assessment_id" value="{{ $assessment_id }}">
                            <input type="hidden" id="time_start" name="time_start" value="{{ $time_start }}">
                            <input type="hidden" id="time" name="time" value="{{ $time }}">
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="content">
                <div class="container-fluid" id="container-question">
                    @foreach ($detail as $key => $item)
                        <input type="hidden" class="answerid" name="answerid_[{{ $key+1 }}]" id="answerid_{{ $key+1 }}" value="{{ $item['id'] }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $key+1 }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="img-question text-center">
                                            <img src="{{ asset('upload/master/question/'.$item['question_image']) }}" height="100" alt="">
                                        </div>
                                        <hr>
                                        <div class="img-answer text-center">
                                            <img src="{{ asset('upload/master/question/'.$item['answer_image']) }}" height="100" alt="">
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <h5>A</h5>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline" style="padding-left: 8px;">                                                        
                                                        <input type="radio" id="answer_A_{{ $key+1 }}" name="answer[{{ $key+1 }}]" value="A" {{ $item['answer'] == 'A' ? 'checked' : ''}}>
                                                        <label for="answer_A_{{ $key+1 }}"></label>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5>B</h5>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline" style="padding-left: 8px;">
                                                        <input type="radio" id="answer_B_{{ $key+1 }}" name="answer[{{ $key+1 }}]" value="B" {{ $item['answer'] == 'B' ? 'checked' : ''}}>
                                                        <label for="answer_B_{{ $key+1 }}"></label>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5>C</h5>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline" style="padding-left: 8px;">
                                                        <input type="radio" id="answer_C_{{ $key+1 }}" name="answer[{{ $key+1 }}]" value="C" {{ $item['answer'] == 'C' ? 'checked' : ''}}>
                                                        <label for="answer_C_{{ $key+1 }}"></label>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5>D</h5>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline" style="padding-left: 8px;">
                                                        <input type="radio" id="answer_D_{{ $key+1 }}" name="answer[{{ $key+1 }}]" value="D" {{ $item['answer'] == 'D' ? 'checked' : ''}}>
                                                        <label for="answer_D_{{ $key+1 }}"></label>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5>E</h5>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline" style="padding-left: 8px;">
                                                        <input type="radio" id="answer_E_{{ $key+1 }}" name="answer[{{ $key+1 }}]" value="E" {{ $item['answer'] == 'E' ? 'checked' : ''}}>
                                                        <label for="answer_E_{{ $key+1 }}"></label>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5>F</h5>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline" style="padding-left: 8px;">
                                                        <input type="radio" id="answer_F_{{ $key+1 }}" name="answer[{{ $key+1 }}]" value="F" {{ $item['answer'] == 'F' ? 'checked' : ''}}>
                                                        <label for="answer_F_{{ $key+1 }}"></label>
                                                    </div>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="modal-preview">
        <div class="modal-dialog modal-preview">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Preview</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-preview">
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>183</td>
                            <td>John Doe</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {
            var timeinterval;
            var totalQuestion = '{{ count($detail) }}';
            // console.log(totalQuestion);
            const time_start = $('#time_start').val();
            const time       = $('#time').val();
            // const time       = 2600;
            console.log(time_start);
            if (typeof time_start === 'undefined' || time_start == '') {
                // alert('test');
                updateStartTime();
            } else {
                var now   = new Date();
                var start = new Date(time_start);
                var diff  = time - Math.ceil((now.getTime() - start.getTime())/1000);
                if (diff > 0) {
                    initializeClock('clockdiv', diff);
                } else {
                    console.log('habis');
                }
            }
    
            function getTimeRemaining(endtime) {
                const total = endtime;
                const seconds = Math.floor(total % 60);
                const minutes = Math.floor((total / 60) % 60);
                const hours = Math.floor(total / 3600);
                
                return {
                    total,
                    hours,
                    minutes,
                    seconds
                };
            }
    
            function initializeClock(id, endtime) {
                const clock       = document.getElementById(id);
                const hoursSpan   = clock.querySelector('.hours');
                const minutesSpan = clock.querySelector('.minutes');
                const secondsSpan = clock.querySelector('.seconds');
    
                function updateClock() {
                    const t = getTimeRemaining(endtime);
                    // console.log(t);
                    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
    
                    if (t.total <= 0) {
                        clearInterval(timeinterval);
                        save_store('time_out');
                    }
                    if (t.total%2 === 0) {
                        save_store('autosave');
                    }
                    endtime--;
                }
    
                updateClock();
                timeinterval = setInterval(updateClock, 1000);
            }

            function updateStartTime() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('assessment.update_start_time') }}",
                    data: {id: $('#assessment_id').val()},
                    dataType: 'json',
                    method: 'POST',
                    success: function(response){
                        if(response.success){
                            initializeClock('clockdiv', time);
                        } else {
                            
                        }
                    }
                });
            }

            function save_store(flag) {
                console.log(flag);
                var answerResult   = $("input:radio").serializeArray();
                var answerResultId = $(".answerid").serializeArray();
                // console.log(answerResultId);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('assessment.autosave') }}",
                    data: {
                        assessment_id: $('#assessment_id').val(),
                        answer_result: answerResult,
                        answer_result_id: answerResultId,
                        flag: flag
                    },
                    dataType: 'json',
                    method: 'POST',
                    success: function(response){
                        console.log(response);
                        if (response.success) {
                            if (flag == 'finish') {
                                Swal.fire({
                                    title: 'Success',
                                    text: "Your test results have been saved!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Back!',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('assessment.index') }}";
                                    }
                                });
                            } else if (flag == 'time_out') {
                                Swal.fire({
                                    title: 'Oops',
                                    text: "Your exam time is up!",
                                    icon: 'warning',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Back!',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('assessment.index') }}";
                                    }
                                });
                            } else {

                            }
                        }
                    }
                });
            }

            $('#btn-preview').on('click', function() {
                $('#tbody-preview').html('');
                var addRow = '';
                var no = 1;
                for (let i = 1; i <= totalQuestion; i++) {
                    var answerResult = $('input[name="answer\\['+i+'\\]"]:checked').val();
                    console.log(answerResult);
                    addRow += '<tr>';
                    addRow += '<td>'+(no++)+'</td>';
                    if (typeof answerResult == 'undefined') {
                        addRow += '<td></td>';
                    } else {
                        addRow += '<td>'+answerResult+'</td>';
                    }
                    addRow += '<tr>';
                }
                $('#tbody-preview').html(addRow);                
                $('#modal-preview').modal('show');
            });
            
            $('#btn-back').on('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Will leave the exam page!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, finish it!',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('assessment.index') }}";
                    }
                });
            });

            $('#btn-finish').on('click', function() {
                var status = 0;
                for (let i = 1; i < parseInt(totalQuestion)+1; i++) {
                    var answerResult = $('input[name="answer\\['+i+'\\]"]:checked').length;
                    if (answerResult == null || answerResult == '') {
                        status = 1;
                        Swal.fire(
                            "Failed!", 
                            "You have not filled in the answer to the question number "+ i, 
                            "error"
                        );
                        break;
                    }
                }
                if (status == 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Will finish this exam!",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, finish it!',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('finish');
                            save_store('finish');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
