@extends('layouts.app')
@section('headerTitle', 'Create Course')

@push('styles')
    {{-- <link href="{{ asset('build/assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('build/assets/vendor/dropzone/dist/dropzone.css') }}" rel="stylesheet">
@endpush
@section('main-content')
    <!--**********************************
                                    Content body start
                                ***********************************-->
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Email</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Compose</a></li>
                </ol>
            </div>

            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4">
                                    <div class="email-left-box mb-md-5 mb-4">
                                        <div class="p-0">
                                            <a href="email-compose.html" class="btn btn-primary btn-block">Compose</a>
                                        </div>
                                        <div class="mail-list rounded mt-4">
                                            <a href="email-inbox.html" class="list-group-item active">
                                                <i class="fa fa-inbox font-18 align-middle me-2"></i> Inbox
                                                <span class="badge badge-primary badge-sm float-end">198</span>
                                            </a>
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <i class="fa fa-paper-plane font-18 align-middle me-2"></i> Sent
                                            </a>
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <i class="fa fa-star font-18 align-middle me-2"></i>Important
                                                <span
                                                    class="badge badge-circle badge-danger badge-sm text-white float-end">7</span>
                                            </a>
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <i class="mdi mdi-file-document-box font-18 align-middle me-2"></i>Draft
                                            </a>
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <i class="fa fa-trash font-18 align-middle me-2"></i>Trash
                                            </a>
                                        </div>
                                        <div class="mail-list rounded overflow-hidden mt-4">
                                            <div class="intro-title d-flex my-0 justify-content-between">
                                                <h5>Categories</h5>
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </div>
                                            <a href="email-inbox.html" class="list-group-item">
                                                <span class="icon-warning">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Work
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item">
                                                <span class="icon-primary">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Private
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item">
                                                <span class="icon-success">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Support
                                            </a>
                                            <a href="email-inbox.html" class="list-group-item">
                                                <span class="icon-dpink">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Social
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-lg-8">
                                    <div class="email-right-box">
                                        <div class="toolbar mb-4" role="toolbar">
                                            <div class="btn-group mb-1">
                                                <button type="button" class="btn btn-primary light px-3"><i
                                                        class="fa fa-archive"></i></button>
                                                <button type="button" class="btn btn-primary light px-3"><i
                                                        class="fa fa-exclamation-circle"></i></button>
                                                <button type="button" class="btn btn-primary light px-3"><i
                                                        class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="btn-group mb-1">
                                                <button type="button" class="btn btn-primary light dropdown-toggle px-3"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fa fa-folder"></i> <b class="caret m-l-5"></b>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                                    <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                                    <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                                    <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                                </div>
                                            </div>
                                            <div class="btn-group mb-1">
                                                <button type="button" class="btn btn-primary light dropdown-toggle px-3"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fa fa-tag"></i> <b class="caret m-l-5"></b>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                                    <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                                    <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                                    <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                                </div>
                                            </div>
                                            <div class="btn-group mb-1">
                                                <button type="button" class="btn btn-primary light dropdown-toggle v"
                                                    data-bs-toggle="dropdown">More <span class="caret m-l-5"></span>
                                                </button>
                                                <div class="dropdown-menu"> <a class="dropdown-item"
                                                        href="javascript: void(0);">Mark as Unread</a> <a
                                                        class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>
                                                    <a class="dropdown-item" href="javascript: void(0);">Add Star</a> <a
                                                        class="dropdown-item" href="javascript: void(0);">Mute</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="compose-content">
                                            <form action="{{ route('support.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <select name="category" class="form-control bg-transparent">
                                                        <option value="">Select Category</option>
                                                        <option value="General Inquiry">General Inquiry</option>
                                                        <option value="Account Assistance">Account Assistance</option>
                                                        <option value="Technical Support">Technical Support</option>
                                                        <option value="Content Inquiry">Content Inquiry</option>
                                                        <option value="Feedback & Suggestions">Feedback & Suggestions
                                                        </option>
                                                        <option value="Report a Problem">Report a Problem</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" name="subject"
                                                        class="form-control bg-transparent" placeholder="Subject">
                                                </div>
                                                <div class="mb-3">
                                                    <textarea name="message" id="email-compose-editor" class="textarea_editor form-control bg-transparent"
                                                        rows="8" placeholder="Enter your message..."></textarea>
                                                </div>
                                                {{-- <div class="mb-3">
                                                    <input type="file" name="attachments[]" multiple>
                                                </div> --}}

                                                <h5 class="mb-4"><i class="fa fa-paperclip me-2"></i> Attachment</h5>
                                                <!-- Dropzone section within the form -->
                                                <label class="dropzone dlab-clickable">
                                                    <div class="dlab-message">Click here to upload files</div>
                                                    <input type="file" name="attachments[]" class="dlab-file-input"
                                                        multiple>
                                                </label>
                                                <div class="text-start mt-4 mb-3">
                                                    <button class="btn btn-primary btn-sl-sm" type="submit"><span
                                                            class="me-2"><i
                                                                class="fa fa-paper-plane"></i></span>Send</button>
                                                    <button class="btn btn-danger light btn-sl-sm" type="button"><span
                                                            class="me-2"><i
                                                                class="fa fa-times"></i></span>Discard</button>
                                                </div>
                                            </form>
                                        </div>

                                        {{-- <div class="compose-content">

                                            <form action="{{ route('support.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <input type="text" class="form-control bg-transparent"
                                                        placeholder=" To:">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control bg-transparent"
                                                        placeholder=" Subject:">
                                                </div>
                                                <div class="mb-3">
                                                    <textarea id="email-compose-editor" class="textarea_editor form-control bg-transparent" rows="8"
                                                        placeholder="Enter text ..."></textarea>
                                                </div>
                                            </form>
                                            <h5 class="mb-4"><i class="fa fa-paperclip me-2"></i> Attatchment</h5>
                                            <form action="#" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="text-start mt-4 mb-3">
                                            <button class="btn btn-primary btn-sl-sm me-2" type="button"><span
                                                    class="me-2"><i class="fa fa-paper-plane"></i></span>Send</button>
                                            <button class="btn btn-danger light btn-sl-sm" type="button"><span
                                                    class="me-2"><i class="fa fa-times"></i></span>Discard</button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--**********************************
                                    Content body end
                                ***********************************-->
@endsection

@push('scripts')
    <script src="{{ asset('build/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }} "></script>
    <script src="{{ asset('build/assets/vendor/dropzone/dist/dropzone.js') }} "></script>
@endpush

@section('scripts')
   
    {{-- <script>
        // This script is just to make the Dropzone styling work
        // Dropzone functionality is not needed since you're not handling file uploads with Dropzone

        // Hide the default file input
        document.querySelectorAll('.dlab-file-input').forEach(function(input) {
            input.style.display = 'none';
        });

        // Show the file name(s) when files are selected
        document.querySelectorAll('.dlab-file-input').forEach(function(input) {
            input.addEventListener('change', function() {
                var files = this.files;
                var fileNames = '';
                for (var i = 0; i < files.length; i++) {
                    fileNames += files[i].name + ', ';
                }
                // Update the message with the selected file name(s)
                this.parentElement.querySelector('.dlab-message').textContent = fileNames.slice(0, -2);
            });
        });
    </script> --}}
    <script>
        // This script is just to make the Dropzone styling work
        // Dropzone functionality is not needed since you're not handling file uploads with Dropzone
    
        // Hide the default file input
        document.querySelectorAll('.dlab-file-input').forEach(function(input) {
            input.style.display = 'none';
        });
    
        // Show the file name(s) as images when files are selected
        document.querySelectorAll('.dlab-file-input').forEach(function(input) {
            input.addEventListener('change', function() {
                var files = this.files;
                var dropzoneContainer = this.parentElement;
    
                // Clear existing content
                dropzoneContainer.innerHTML = '';
    
                // Loop through selected files
                for (var i = 0; i < files.length; i++) {
                    // Create an image element for each file
                    var image = document.createElement('img');
                    image.src = URL.createObjectURL(files[i]);
                    image.alt = files[i].name;
                    image.style.maxWidth = '100px'; // Adjust image size if needed
    
                    // Append the image to the Dropzone container
                    dropzoneContainer.appendChild(image);
                }
            });
        });
    </script>
    
    
    
    
@endsection
