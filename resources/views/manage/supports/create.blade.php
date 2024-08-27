@extends('layouts.app')
@section('headerTitle', 'Create Course')

@push('styles')
    {{-- <link href="{{ asset('build/assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('build/assets/vendor/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css"> --}}
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
                                   @include('manage.supports.email_sidebar')
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
                                                        rows="3" placeholder="Enter your message..."></textarea>
                                                </div>
                                                {{-- <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div> --}}

                                                <!-- Dropzone section within the form -->
                                                <style>
                                                    /* .dlab-clickable {
                                                                                                        position: fixed;
                                                                                                        overflow: hidden;
                                                                                                    } */

                                                    .selected-files {
                                                        display: flex;
                                                        flex-wrap: wrap;
                                                    }


                                                    .file-preview img {
                                                        max-width: 100px;
                                                        max-height: 100px;
                                                        display: block;
                                                        margin: auto;
                                                    }

                                                    .file-icon {
                                                        font-size: 48px;
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        width: 100px;
                                                        height: 100px;
                                                    }
                                                </style>
                                                {{-- <label class="dropzone dlab-clickable" id="dropzone">
                                                    <div class="dlab-message">Click here to upload files</div>
                                                    <input type="file" name="attachments[]" class="dlab-file-input"
                                                        multiple>
                                                </label> --}}
                                                <div class="mb-3">
                                                    <h5 class="mb-4"><i class="fa fa-paperclip me-2"></i> Attatchment
                                                    </h5>
                                                    <label class="dropzone dlab-clickable w-100" id="dropzone">
                                                        <div class="dlab-message ">Click here to upload files</div>
                                                        <input type="file" name="attachments[]"
                                                            class="dlab-file-input" multiple
                                                            onchange="displaySelectedFiles(this)" style="display: none;">
                                                        <div id="selectedFiles" class="selected-files"></div>
                                                    </label>
                                                </div>
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

                                        </form>
                                        {{-- <h5 class="mb-4"><i class="fa fa-paperclip me-2"></i> Attatchment</h5>
                                    <form action="#" class="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </form>
                                    </div> --}}
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
        {{-- <script src="{{ asset('build/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }} "></script> --}}
        {{-- <script src="{{ asset('build/assets/vendor/dropzone/dist/dropzone.js') }} "></script> --}}
    @endpush

    @section('scripts')
        <!-- Dropzone JavaScript -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script> --}}

        {{-- <script>
        function displaySelectedFiles(input) {
            var files = input.files;
            var selectedFilesDiv = document.getElementById('selectedFiles');
            selectedFilesDiv.innerHTML = '';

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var fileDiv = document.createElement('div');
                fileDiv.className = 'file-preview';
                if (file.type.startsWith('image/')) {
                    var img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    fileDiv.appendChild(img);
                } else {
                    var fileTypeIcon = document.createElement('i');
                    fileTypeIcon.className = 'file-icon';
                    fileTypeIcon.textContent = getFileTypeIcon(file.type);
                    fileDiv.appendChild(fileTypeIcon);
                }
                selectedFilesDiv.appendChild(fileDiv);
            }
             // Hide the message after files have been selected
        var messageDiv = document.querySelector('.dlab-message');
        messageDiv.style.display = 'none';
        }

        function getFileTypeIcon(fileType) {
            // Define mappings for file types to icons here
            switch (fileType) {
                case 'application/pdf':
                    return 'PDF';
                case 'application/msword':
                case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    return 'DOC';
                case 'application/vnd.ms-excel':
                case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                    return 'XLS';
                default:
                    return 'File';
            }
        }
    </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add event listener to the parent container of file previews
                document.getElementById('selectedFiles').addEventListener('click', function(event) {
                    // Check if the clicked element is a remove button
                    if (event.target && event.target.classList.contains('remove-btn')) {
                        // Call removeFile function passing the parent of the remove button (file preview element)
                        removeFile(event.target.parentNode);
                        // Prevent the default behavior of the click event
                        event.preventDefault();
                    }
                });
            });

            function displaySelectedFiles(input) {
                var files = input.files;
                var selectedFilesDiv = document.getElementById('selectedFiles');
                selectedFilesDiv.innerHTML = '';

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var fileDiv = document.createElement('div');
                    fileDiv.className = 'file-preview';
                    if (file.type.startsWith('image/')) {
                        var img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        fileDiv.appendChild(img);
                    } else {
                        var fileTypeIcon = document.createElement('i');
                        fileTypeIcon.className = 'file-icon';
                        fileTypeIcon.textContent = getFileTypeIcon(file.type);
                        fileDiv.appendChild(fileTypeIcon);
                    }

                    // Create a remove button
                    var removeBtn = document.createElement('button');
                    removeBtn.textContent = 'Remove';
                    removeBtn.className = 'remove-btn';
                    removeBtn.setAttribute('type', 'button');
                    fileDiv.appendChild(removeBtn);

                    selectedFilesDiv.appendChild(fileDiv);
                }

                // Hide the message after files have been selected
                var messageDiv = document.querySelector('.dlab-message');
                messageDiv.style.display = 'none';
            }

            function getFileTypeIcon(fileType) {
                // Define mappings for file types to icons here
                switch (fileType) {
                    case 'application/pdf':
                        return 'PDF';
                    case 'application/msword':
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                        return 'DOC';
                    case 'application/vnd.ms-excel':
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                        return 'XLS';
                    default:
                        return 'File';
                }
            }

            function removeFile(element) {
                element.classList.add('file-removed');
                element.parentNode.removeChild(element);
                // If there are no files left, display the message
                if (document.getElementById('selectedFiles').childElementCount === 0) {
                    var messageDiv = document.querySelector('.dlab-message');
                    messageDiv.style.display = 'block';
                }
            }
        </script>
        {{-- <script>
        // Array to store selected files
        var selectedFiles = [];
    
        document.addEventListener('DOMContentLoaded', function () {
            // Add event listener to the parent container of file previews
            document.getElementById('selectedFiles').addEventListener('click', function (event) {
                // Check if the clicked element is a remove button
                if (event.target && event.target.classList.contains('remove-btn')) {
                    // Call removeFile function passing the parent of the remove button (file preview element)
                    removeFile(event.target.parentNode);
                    // Prevent the default behavior of the click event
                    event.preventDefault();
                }
            });
        });
    
        function displaySelectedFiles(input) {
            var files = input.files;
            var selectedFilesDiv = document.getElementById('selectedFiles');
            selectedFilesDiv.innerHTML = '';
    
            // Clear the selected files array
            selectedFiles = [];
    
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                selectedFiles.push(file);
    
                var fileDiv = document.createElement('div');
                fileDiv.className = 'file-preview';
                if (file.type.startsWith('image/')) {
                    var img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    fileDiv.appendChild(img);
                } else {
                    var fileTypeIcon = document.createElement('i');
                    fileTypeIcon.className = 'file-icon';
                    fileTypeIcon.textContent = getFileTypeIcon(file.type);
                    fileDiv.appendChild(fileTypeIcon);
                }
    
                // Create a remove button
                var removeBtn = document.createElement('button');
                removeBtn.textContent = 'Remove';
                removeBtn.className = 'remove-btn';
                removeBtn.setAttribute('type', 'button');
                fileDiv.appendChild(removeBtn);
    
                selectedFilesDiv.appendChild(fileDiv);
            }
    
            // Hide the message after files have been selected
            var messageDiv = document.querySelector('.dlab-message');
            messageDiv.style.display = 'none';
        }
    
        function getFileTypeIcon(fileType) {
            // Define mappings for file types to icons here
            switch (fileType) {
                case 'application/pdf':
                    return 'PDF';
                case 'application/msword':
                case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    return 'DOC';
                case 'application/vnd.ms-excel':
                case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                    return 'XLS';
                default:
                    return 'File';
            }
        }
    
        function removeFile(element) {
            // Find the index of the file in the selectedFiles array
            var fileName = element.querySelector('span').textContent;
            var index = selectedFiles.findIndex(function(file) {
                return file.name === fileName;
            });
    
            // Remove the file from the selectedFiles array
            if (index !== -1) {
                selectedFiles.splice(index, 1);
            }
    
            // Remove the file preview element from the DOM
            element.parentNode.removeChild(element);
    
            // If there are no files left, display the message
            if (document.getElementById('selectedFiles').childElementCount === 0) {
                var messageDiv = document.querySelector('.dlab-message');
                messageDiv.style.display = 'block';
            }
        }
    </script> --}}

        <!-- Include Dropzone.js library -->


    @endsection
