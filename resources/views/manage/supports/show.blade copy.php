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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Amil</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Read</a></li>
                </ol>
            </div>

            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4">
                                    <div class="email-left-box generic-width px-0 mb-5">
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
                                        <div class="row">
                                            @include('layouts.sessions');
                                            <div class="col-12">
                                                <div class="right-box-padding">
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
                                                            <button type="button"
                                                                class="btn btn-primary light dropdown-toggle px-3"
                                                                data-bs-toggle="dropdown">
                                                                <i class="fa fa-folder"></i> <b class="caret m-l-5"></b>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Social</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Promotions</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Updates</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Forums</a>
                                                            </div>
                                                        </div>
                                                        <div class="btn-group mb-1">
                                                            <button type="button"
                                                                class="btn btn-primary light dropdown-toggle px-3"
                                                                data-bs-toggle="dropdown">
                                                                <i class="fa fa-tag"></i> <b class="caret m-l-5"></b>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="javascript: void(0);">Updates</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript: void(0);">Social</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript: void(0);">Promotions</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript: void(0);">Forums</a>
                                                            </div>
                                                        </div>
                                                        <div class="btn-group mb-1">
                                                            <button type="button"
                                                                class="btn btn-primary light dropdown-toggle v"
                                                                data-bs-toggle="dropdown">More <span
                                                                    class="caret m-l-5"></span>
                                                            </button>
                                                            <div class="dropdown-menu"> <a class="dropdown-item"
                                                                    href="javascript: void(0);">Mark as Unread</a> <a
                                                                    class="dropdown-item" href="javascript: void(0);">Add
                                                                    to Tasks</a>
                                                                <a class="dropdown-item" href="javascript: void(0);">Add
                                                                    Star</a> <a class="dropdown-item"
                                                                    href="javascript: void(0);">Mute</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="read-content">
                                                        <div class="media pt-3 d-sm-flex d-block justify-content-between">
                                                            <div class="clearfix mb-3 d-flex align-items-center">
                                                                <!-- User Avatar -->
                                                                <img class="me-3 rounded-circle" width="70"
                                                                    height="70" alt="User Avatar"
                                                                    src="{{ asset('build/assets/') }}/images/avatar/1.jpg">
                                                                <div class="media-body me-2">
                                                                    <!-- User Name -->
                                                                    <h5 class="text-primary mb-0 mt-1">{{ $user->name }}
                                                                    </h5>
                                                                    <!-- Ticket Creation Date -->
                                                                    <p class="mb-0">
                                                                        {{ $supportTicket->created_at->format('d M Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix mb-3">
                                                                <!-- Buttons (Reply, Forward, Delete) -->
                                                                <!-- Replace href with appropriate routes or JavaScript actions -->
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-primary px-3 my-1 light me-2"><i
                                                                        class="fa fa-reply"></i> </a>
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-primary px-3 my-1 light me-2"><i
                                                                        class="fas fa-arrow-right"></i> </a>
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-primary px-3 my-1 light me-2"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <!-- Ticket Subject and Message -->
                                                        <div class="media mb-2 mt-3">
                                                            <div class="media-body">
                                                                <span
                                                                    class="pull-end">{{ $supportTicket->created_at->format('h:i A') }}</span>
                                                                <!-- Ticket Subject -->
                                                                <h5 class="my-1 text-primary">{{ $supportTicket->subject }}
                                                                </h5>
                                                                <!-- Additional Information (e.g., recipients) -->
                                                                <p class="read-content-email">To:
                                                                    {{ $supportTicket->category }}</p>
                                                            </div>
                                                        </div>
                                                        <!-- Ticket Message -->
                                                        <div class="read-content-body">
                                                            <h5 class="mb-4">Hi, {{ $supportTicket->category }} care,
                                                            </h5>
                                                            <!-- Ticket Message Content -->
                                                            <p class="mb-2">{{ $supportTicket->message }}</p>

                                                            @if ($attachments->count() > 0)
                                                                <!-- Attachments -->
                                                                <div class="read-content-attachment">
                                                                    <h6><i class="fa fa-download mb-2"></i> Attachments
                                                                        <span>({{ $attachments->count() }})</span>
                                                                    </h6>
                                                                    <div class="row attachment">
                                                                        <!-- Display Attachments -->
                                                                        @foreach ($attachments as $attachment)
                                                                            <div class="col-auto">
                                                                                <a href="{{ asset($attachment->file_path) }}"
                                                                                    class="text-muted"
                                                                                    target="_blank">{{ $attachment->file_name }}</a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <!-- Reply Textarea -->
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
                                                    <form
                                                        action="{{ route('support-tickets.reply',  $supportTicket->ticket_id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <textarea name="reply" id="reply" cols="30" rows="3" class="form-control"
                                                            placeholder="It's really amazing. I want to know more about it...!"></textarea>

                                                        <div class="mb-3">
                                                            <h5 class="mb-4"><i class="fa fa-paperclip me-2"></i>
                                                                Attatchment
                                                            </h5>
                                                            <label class="dropzone dlab-clickable w-100" id="dropzone">
                                                                <div class="dlab-message ">Click here to upload files</div>
                                                                <input type="file" name="attachments[]"
                                                                    class="dlab-file-input" multiple
                                                                    onchange="displaySelectedFiles(this)"
                                                                    style="display: none;">
                                                                <div id="selectedFiles" class="selected-files"></div>
                                                            </label>
                                                        </div>

                                                        <div class="text-end">
                                                            <button class="btn btn-primary " type="submit">Send</button>
                                                        </div>
                                                    </form>
                                                    {{-- <button type="submit">Reply</button> --}}

                                                    {{-- <div class="mb-3 pt-3">
                                                            <textarea name="write-email" id="write-email" cols="30" rows="5" class="form-control"
                                                                placeholder="It's really amazing. I want to know more about it...!"></textarea>
                                                        </div> --}}


                                                    {{-- <div class="read-content">
                                                        <div class="media pt-3 d-sm-flex d-block justify-content-between">
                                                            <div class="clearfix mb-3 d-flex align-items-center">
                                                                <img class="me-3 rounded-circle" width="70"
                                                                    height="70" alt="image"
                                                                    src="{{ asset('build/assets/') }}/images/avatar/1.jpg">
                                                                <div class="media-body me-2">
                                                                    <h5 class="text-primary mb-0 mt-1">Ingredia Nutrisha
                                                                    </h5>
                                                                    <p class="mb-0">20 May 2020</p>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix mb-3">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-primary px-3 my-1 light me-2"><i
                                                                        class="fa fa-reply"></i> </a>
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-primary px-3 my-1 light me-2"><i
                                                                        class="fas fa-arrow-right"></i> </a>
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-primary px-3 my-1 light me-2"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="media mb-2 mt-3">
                                                            <div class="media-body"><span class="pull-end">07:23 AM</span>
                                                                <h5 class="my-1 text-primary">A collection of textile
                                                                    samples lay spread</h5>
                                                                <p class="read-content-email">
                                                                    To: Me, info@example.com</p>
                                                            </div>
                                                        </div>
                                                        <div class="read-content-body">
                                                            <h5 class="mb-4">Hi,Ingredia,</h5>
                                                            <p class="mb-2"><strong>Ingredia Nutrisha,</strong> A
                                                                collection of textile samples lay spread out on the table -
                                                                Samsa was a travelling salesman - and above it there hung a
                                                                picture</p>
                                                            <p class="mb-2">Even the all-powerful Pointing has no control
                                                                about the blind texts it is an almost unorthographic life
                                                                One day however a small line of blind text by the name of
                                                                Lorem Ipsum decided to leave for
                                                                the far World of Grammar. Aenean vulputate eleifend tellus.
                                                                Aenean leo ligula, porttitor eu, consequat vitae, eleifend
                                                                ac, enim. Aliquam lorem ante, dapibus in, viverra quis,
                                                                feugiat a, tellus.
                                                            </p>
                                                            <p class="mb-2">Aenean vulputate eleifend tellus. Aenean leo
                                                                ligula, porttitor eu, consequat vitae, eleifend ac, enim.
                                                                Aliquam lorem ante, dapibus in, viverra quis, feugiat a,
                                                                tellus. Phasellus viverra nulla ut
                                                                metus varius laoreet. Quisque rutrum. Aenean imperdiet.
                                                                Etiam ultricies nisi vel augue. Curabitur ullamcorper
                                                                ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas
                                                                tempus, tellus eget condimentum
                                                                rhoncus, sem quam semper libero, sit amet adipiscing sem
                                                                neque sed ipsum. Nam quam nunc, blandit vel, luctus
                                                                pulvinar,</p>
                                                            <h5 class="pt-3">Kind Regards</h5>
                                                            <p>Mr Smith</p>
                                                            <hr>
                                                        </div>
                                                        <div class="read-content-attachment">
                                                            <h6><i class="fa fa-download mb-2"></i> Attachments
                                                                <span>(3)</span>
                                                            </h6>
                                                            <div class="row attachment">
                                                                <div class="col-auto">
                                                                    <a href="javascript:void(0);"
                                                                        class="text-muted">My-Photo.png</a>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="javascript:void(0);"
                                                                        class="text-muted">My-File.docx</a>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a href="javascript:void(0);"
                                                                        class="text-muted">My-Resume.pdf</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="mb-3 pt-3">
                                                            <textarea name="write-email" id="write-email" cols="30" rows="5" class="form-control"
                                                                placeholder="It's really an amazing.I want to know more about it..!"></textarea>
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="text-end">
                                                        <button class="btn btn-primary " type="button">Send</button>
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
@endpush
