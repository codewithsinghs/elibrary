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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Inbox</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4">
                                    @include('common.support.email_sidebar')

                                    {{-- <div class="filters">
                                        <label for="category">Category:</label>
                                        <select id="category" onchange="filterTickets()">
                                            <option value="">All</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category }}">{{ $category }}</option>
                                            @endforeach
                                        </select>

                                        <label for="status">Status:</label>
                                        <select id="status" onchange="filterTickets()">
                                            <option value="">All</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <form id="filterForm" action="{{ route('support.index') }}" method="GET">
    <!-- Filter Controls -->
    <select name="category">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category }}">{{ $category }}</option>
        @endforeach
    </select>
    <select name="status">
        <option value="">All Statuses</option>
        @foreach ($statuses as $status)
            <option value="{{ $status }}">{{ $status }}</option>
        @endforeach
    </select>
    <button type="submit">Apply Filters</button>
</form>

                                    <!-- Add more status buttons as needed -->
                                </div>
                                <div class="col-xl-9 col-lg-8">
                                    <div class="email-right-box">
                                        <div role="toolbar" class="toolbar ms-1 ms-sm-0">
                                            <div class="btn-group mb-1 me-3 ps-sm-1">
                                                <div class="form-check custom-checkbox">
                                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </div>
                                            <div class="btn-group mb-1 me-2">
                                                <button class="btn btn-primary light px-3" type="button"><i
                                                        class="ti-reload"></i>
                                                </button>
                                            </div>
                                            <div class="btn-group mb-1">
                                                <button aria-expanded="false" data-bs-toggle="dropdown"
                                                    class="btn btn-primary px-3 light dropdown-toggle" type="button">More
                                                    <span class="caret"></span>
                                                </button>
                                                <div class="dropdown-menu"> <a href="javascript: void(0);"
                                                        class="dropdown-item">Mark as Unread</a> <a
                                                        href="javascript: void(0);" class="dropdown-item">Add to Tasks</a>
                                                    <a href="javascript: void(0);" class="dropdown-item">Add Star</a> <a
                                                        href="javascript: void(0);" class="dropdown-item">Mute</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-list mt-3">

                                         

                                                @if ($supportTickets->count() > 0)

                                                    @foreach ($supportTickets as $supportTicket)
                                                        <div class="message" data-category="{{ $supportTicket->category }}"
                                                            data-status="{{ $supportTicket->status }}">
                                                            <div>
                                                                <div class="d-flex message-single">
                                                                    <div class="ps-1 align-self-center">
                                                                        <div class="form-check custom-checkbox">
                                                                            <input type="checkbox" class="form-check-input"
                                                                                id="ticket{{ $supportTicket->ticket_id }}">
                                                                            <label class="form-check-label"
                                                                                for="ticket{{ $supportTicket->ticket_id }}"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3">
                                                                        <label class="bookmark-btn">
                                                                            <input type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <a href="{{ route('tickets.show', $supportTicket->ticket_id) }}"
                                                                    class="col-mail col-mail-2">
                                                                    <div class="subject">#{{ $supportTicket->ticket_id }}
                                                                        &nbsp;
                                                                        - {{ $supportTicket->category }}
                                                                        &nbsp;
                                                                        -
                                                                        &nbsp;&nbsp; {{ $supportTicket->subject }} -
                                                                        {{ $supportTicket->message }}</div>
                                                                    <div class="date">11:49 am</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    {{-- Include your custom pagination layout --}}
                                                    {{-- {!! $supportTickets->links('partials.pagination') !!} --}}
                                                    {{-- @include('partials.pagination', ['paginator' => $supportTickets]) --}}
                                                    {{-- <div class="row mt-4">
                                                    <div class="col-12 ps-3">
                                                        <nav>
                                                            {{ $supportTickets->links('pagination::bootstrap-5') }}
                                                        </nav>
                                                    </div>
                                                </div> --}}
                                                    <div class="pagination">
                                                        <div class="row mt-4">
                                                            <div class="col-12 ps-3">
                                                                <nav>
                                                                    <ul
                                                                        class="pagination pagination-gutter pagination-primary pagination-sm no-bg">
                                                                        <li class="page-item page-indicator">
                                                                            <a class="page-link"
                                                                                href="{{ $supportTickets->previousPageUrl() }}">
                                                                                <i class="la la-angle-left"></i>
                                                                            </a>
                                                                        </li>
                                                                        @for ($i = 1; $i <= $supportTickets->lastPage(); $i++)
                                                                            <li
                                                                                class="page-item {{ $supportTickets->currentPage() == $i ? 'active' : '' }}">
                                                                                <a class="page-link"
                                                                                    href="{{ $supportTickets->url($i) }}">{{ $i }}</a>
                                                                            </li>
                                                                        @endfor
                                                                        <li class="page-item page-indicator">
                                                                            <a class="page-link"
                                                                                href="{{ $supportTickets->nextPageUrl() }}">
                                                                                <i class="la la-angle-right"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p>No support tickets found.</p>

                                                @endif

                                          

                                        </div>
                                        <!-- panel -->

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
    <script src="{{ asset('build/assets/vendor/dropzone/dist/dropzone.js') }} "></script>
    {{-- <script>
        function filterTickets() {
            var category = document.getElementById('category').value;
            var status = document.getElementById('status').value;
            var messages = document.querySelectorAll('.message');

            messages.forEach(function(message) {
                var messageCategory = message.getAttribute('data-category');
                var messageStatus = message.getAttribute('data-status');

                var categoryMatch = category === '' || messageCategory === category;
                var statusMatch = status === '' || messageStatus === status;

                if (categoryMatch && statusMatch) {
                    message.style.display = 'block';
                } else {
                    message.style.display = 'none';
                }
            });
        }
    </script> --}}
    <script>
        function filterTickets() {
            var category = document.getElementById('category').value;
            var status = document.getElementById('status').value;
            var form = document.getElementById('filterForm');
            form.elements['category'].value = category;
            form.elements['status'].value = status;
            form.submit();
        }
    </script>
@endpush
