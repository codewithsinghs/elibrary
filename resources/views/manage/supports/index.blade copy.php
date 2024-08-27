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
                                    @include('manage.supports.email_sidebar')
                                </div>
                                <h2>All Support Tickets</h2>
                                <p>Total Tickets: {{ $openCount + $closedCount + $draftCount }}</p>
                            
                                <h3>Status Wise Counts:</h3>
                                <ul>
                                    <li>Open Tickets: {{ $openCount }}</li>
                                    <li>Closed Tickets: {{ $closedCount }}</li>
                                    <li>Draft Tickets: {{ $draftCount }}</li>
                                </ul>
                            
                                <h3>Category Wise Counts:</h3>
                                <ul>
                                    @foreach($categoryCounts as $category => $count)
                                        <li>{{ $category }}: {{ $count }}</li>
                                    @endforeach
                                </ul>
                            
                                <h3>Filter</h3>
                                <form action="{{ route('support.index') }}" method="GET">
                                    <select name="status">
                                        <option value="">All Statuses</option>
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                    <select name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit">Apply Filters</button>
                                </form>
                            
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

                                            @if ($filteredTickets->count() > 0)

                                                @foreach ($filteredTickets as $supportTicket)
                                                    <div class="message">
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
                                                            <a href="{{ route('support-tickets.show', $supportTicket->ticket_id) }}"
                                                                class="col-mail col-mail-2">
                                                                <div class="subject">#{{ $supportTicket->ticket_id }} &nbsp;
                                                                    - {{ $supportTicket->category }} &nbsp; -
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
                                                <div class="row mt-4">
                                                    <div class="col-12 ps-3">
                                                        <nav>
                                                            <ul
                                                                class="pagination pagination-gutter pagination-primary pagination-sm no-bg">
                                                                <li class="page-item page-indicator">
                                                                    <a class="page-link"
                                                                        href="{{ $filteredTickets->previousPageUrl() }}">
                                                                        <i class="la la-angle-left"></i>
                                                                    </a>
                                                                </li>
                                                                @for ($i = 1; $i <= $filteredTickets->lastPage(); $i++)
                                                                    <li
                                                                        class="page-item {{ $filteredTickets->currentPage() == $i ? 'active' : '' }}">
                                                                        <a class="page-link"
                                                                            href="{{ $filteredTickets->url($i) }}">{{ $i }}</a>
                                                                    </li>
                                                                @endfor
                                                                <li class="page-item page-indicator">
                                                                    <a class="page-link"
                                                                        href="{{ $filteredTickets->nextPageUrl() }}">
                                                                        <i class="la la-angle-right"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            @else
                                                <p>No support tickets found.</p>

                                            @endif
                                            {{-- <div class="message">
                                                <div>
                                                    <div class="d-flex message-single">
                                                        <div class="ps-1 align-self-center">
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="starcheckbox1">
                                                                <label class="form-check-label"
                                                                    for="starcheckbox1"></label>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3">
                                                            <label class="bookmark-btn"><input type="checkbox"><span
                                                                    class="checkmark"></span></label>
                                                        </div>
                                                    </div>
                                                    <a href="email-read.html" class="col-mail col-mail-2">
                                                        <div class="subject">Ingredia Nutrisha, A collection of textile
                                                            samples lay spread out on the table - Samsa was a travelling
                                                            salesman - and above it there hung a picture</div>
                                                        <div class="date">11:49 am</div>
                                                    </a>
                                                </div>
                                            </div> --}}

                                        </div>
                                        <!-- panel -->
                                        {{-- <div class="row mt-4">
                                            <div class="col-12 ps-3">
                                                <nav>
                                                    <ul
                                                        class="pagination pagination-gutter pagination-primary pagination-sm no-bg">
                                                        <li class="page-item page-indicator"><a class="page-link"
                                                                href="javascript:void()"><i
                                                                    class="la la-angle-left"></i></a></li>
                                                        <li class="page-item "><a class="page-link"
                                                                href="javascript:void()">1</a></li>
                                                        <li class="page-item active"><a class="page-link"
                                                                href="javascript:void()">2</a></li>
                                                        <li class="page-item"><a class="page-link"
                                                                href="javascript:void()">3</a></li>
                                                        <li class="page-item"><a class="page-link"
                                                                href="javascript:void()">4</a></li>
                                                        <li class="page-item page-indicator"><a class="page-link"
                                                                href="javascript:void()"><i
                                                                    class="la la-angle-right"></i></a></li>
                                                    </ul>
                                                </nav>
                                            </div>
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
    {{-- <script src="{{ asset('build/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }} "></script> --}}
    <script src="{{ asset('build/assets/vendor/dropzone/dist/dropzone.js') }} "></script>
@endpush
