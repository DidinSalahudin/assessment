<x-app 
    title="{{ $title }}" 
    style="
        <link rel='stylesheet' href={{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}>
    "
    script="
        <script src='{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}'></script>
        <script src='{{ asset('assets/custom/js/master/question/question_create.js') }}'></script>
    ">

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
                            <li class="breadcrumb-item"><a href="{{ route('question.index') }}">Question</a></li>
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
                    <div class="col-md-12">

                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Question</h3>
                            </div>

                            <form method="POST" action="{{ route('question.update', $questions->id) }}">
                                @method('put')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="input-title">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="input-title" value="{{ $questions->title }}" placeholder="Enter Title">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="input-type">Type</label>
                                        <input type="text" class="form-control  @error('type') is-invalid @enderror" name="type" id="input-type" value="{{ $questions->type }}" placeholder="Enter Type">
                                        @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="input-time">Time</label>
                                        <input type="text" class="form-control  @error('time') is-invalid @enderror" name="time" id="input-time" value="{{ $questions->time }}" placeholder="Enter Time">
                                        <p>In seconds</p>
                                        @error('time')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="input-instruction">Instruction</label>
                                        <textarea id="summernote" name="instruction">{{ $questions->instruction }}</textarea>
                                        @error('instruction')
                                            <code style="font-size: 80%;">{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                </div>
                            </form>                            
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Question Detail</h3>

                                <div class="card-tools">
                                    <button class="btn btn-sm btn-default" id="add-question-detail">Add</button>
                                </div>
                            </div>
                            <form action="{{ route('question_detail') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $questions->id }}">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered" id="table-question-detail" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Question Image</th>
                                                <th>Answer Image</th>
                                                <th>Answer</th>
                                                <th style="width: 40px"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-question-detail">
                                            @foreach ($question_details as $key => $question_detail)
                                                <input type="hidden" name="questiondetail[{{ $key }}][id]" value="{{ $question_detail->id }}">
                                                <tr data-index="{{ $key }}">
                                                    <td>
                                                        <div class="col-12 text-center mb-2">
                                                            <img src="{{ asset('upload/master/question/'.$question_detail->question_image) }}" height="100" alt="">
                                                        </div>
                                                        <div class="col-12">
                                                            <input type="file" name="questiondetail[{{ $key }}][question_image]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-12 text-center mb-2">
                                                            <img src="{{ asset('upload/master/question/'.$question_detail->answer_image) }}" height="100" alt="">
                                                        </div>
                                                        <div class="col-12">
                                                            <input type="file" name="questiondetail[{{ $key }}][answer_image]">
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle; ">
                                                        <div class="col-12">
                                                            <select class="custom-select rounded-0" name="questiondetail[{{ $key }}][answer]" style="width: 60px;">
                                                                <option value="A" {{ $question_detail->answer == 'A' ? 'selected' : '' }}>A</option>
                                                                <option value="B" {{ $question_detail->answer == 'B' ? 'selected' : '' }}>B</option>
                                                                <option value="C" {{ $question_detail->answer == 'C' ? 'selected' : '' }}>C</option>
                                                                <option value="D" {{ $question_detail->answer == 'D' ? 'selected' : '' }}>D</option>
                                                                <option value="E" {{ $question_detail->answer == 'E' ? 'selected' : '' }}>E</option>
                                                                <option value="F" {{ $question_detail->answer == 'F' ? 'selected' : '' }}>F</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td style="width: 40px; vertical-align: middle;">
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteupdateForm(this, {{ $question_detail->id }}, '{{ route('update_detail_delete_question') }}' )">X</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
    </div>
</x-app>
