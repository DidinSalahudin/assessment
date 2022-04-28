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
                            
                            <form method="POST" action="{{ route('question.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="input-title">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="input-title" placeholder="Enter Title">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="input-type">Type</label>
                                        <input type="text" class="form-control  @error('type') is-invalid @enderror" name="type" id="input-type" placeholder="Enter Type">
                                        @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="input-time">Time</label>
                                        <input type="text" class="form-control  @error('time') is-invalid @enderror" name="time" id="input-time" placeholder="Enter Time">
                                        <p>In seconds</p>
                                        @error('time')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="input-instruction">Instruction</label>
                                        <textarea id="summernote" name="instruction"></textarea>
                                        @error('instruction')
                                            <code style="font-size: 80%;">{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
    </div>
</x-app>
