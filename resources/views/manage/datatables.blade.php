@extends('layouts.app')

@push('styles')
    <!-- Datatable -->
    {{-- <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}

    <!-- Daterange picker -->
    {{-- <link href="{{ asset('build/assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"> --}}

    <!-- Pick date -->
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/vendor/pickadate/themes/default.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/vendor/pickadate/themes/default.date.css') }}"> --}}
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}

    <!-- Custom Stylesheet -->
    {{-- <link href="{{ asset('build/assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"> --}}
@endpush
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
        width: 100px !important;
    }

    .dataTables_wrapper .dataTables_info {

        padding-top: 2em !important;
    }
</style>
@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script> --}}

    {{-- <!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Include DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}

    <!-- Include DataTables Buttons JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}

    <!-- momment js is must -->
    {{-- <script src="{{ asset('build/assets/vendor/moment/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('build/assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}

    <!-- pickdate -->
    {{-- <script src="{{ asset('build/assets/vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/pickadate/picker.date.js') }}"></script> --}}

    <!-- Daterangepicker -->
    {{-- <script src="{{ asset('build/assets/js/plugins-init/bs-daterange-picker-init.js') }}"></script> --}}

    <!-- Pickdate -->
    {{-- <script src="{{ asset('build/assets/js/plugins-init/pickadate-init.js') }}"></script> --}}

    {{-- <script src="{{ asset('build/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script> --}}
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
@endpush

@section('headerTitle', 'User List')

@section('main-content')
    <!-- Your users list content goes here -->
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>
            <!-- row -->


            <div class="row">
              
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profile Datatable</h4>
                        </div>
                        @if (count($activities) > 0)
                            <div class="card-body">                         
                                <div class="table-responsive">
                                    <table id="example14" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>U_ID</th>
                                                <th>Fact</th>
                                                <th>Dept.</th>
                                                <th>Page</th>
                                                <th> Date &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Spent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activities as $activity)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $activity->profile->fname ?? null }}</td>
                                                    <td>
                                                        @if ($activity->profile)
                                                            {{ $activity->profile->unic_id ?? null }}
                                                        @else
                                                            Not Available
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($activity->profile)
                                                            {{ $activity->profile->faculty ?? null }}
                                                        @else
                                                            Not Available
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($activity->profile)
                                                            {{ $activity->profile->department ?? null }}
                                                        @else
                                                            Not Available
                                                        @endif
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="{{ $activity->url ?? null }}">{{ $activity->page_name ?? null }}</a>
                                                    </td>
                                                    <td>{{ $activity->start_time->format('d-m-Y') ?? null }}</td>
                                                    <td>{{ $activity->start_time->format('H:i:s') ?? null }}</td>
                                                    <td>{{ $activity->end_time->format('H:i:s') ?? null }}</td>
                                                    <td>
                                                        {{-- {{ \Carbon\CarbonInterval::seconds($activity->time_spent)->cascade()->forHumans();}} --}}
                                                        {{ \Carbon\CarbonInterval::seconds($activity->time_spent)->cascade()->forHumans(['short' => true]);}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>U_ID</th>
                                                <th>Fact</th>
                                                <th>Dept.</th>
                                                <th>Page</th>
                                                <th> Date &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Spent</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                            
                                </div>
                            </div>
                        @else
                            <div class="text-center">No data available</div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Your other content here -->
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {



            $('#example14').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'copy', 'print',
                    'colvis'
                ],
                columnDefs: [
        {
            targets: -1,
            visible: false
        }
    ]
          
                lengthMenu: [
                    [10, 25, 50, 100, 200, 500, 1000, -1],
                    [10, 25, 50, 100, 200, 500, 1000, "All"]
                ],
                pagingType: 'full_numbers', // Use full pagination controls
                paging: true,
                searching: true,


                drawCallback: function() {
                    // Remove unnecessary pagination links
                    $('.paginate_button').addClass('d-none');
                    $('.paginate_button.previous, .paginate_button.next').removeClass('d-none');

                    // Show only the desired number of page links
                    var numPages = $('.paginate_button').length -
                        2; // Excluding 'Previous' and 'Next' buttons
                    var showPages = 5; // Number of pages to show
                    var currentPage = parseInt($('.paginate_button.current').text());

                    var startPage = Math.max(currentPage - 2, 1);
                    var endPage = Math.min(currentPage + 2, numPages);

                    // Show the pages within the range [startPage, endPage]
                    for (var i = startPage; i <= endPage; i++) {
                        $('.paginate_button').eq(i).removeClass('d-none');
                    }

                    // Add ellipses if necessary
                    if (startPage > 3) {
                        $('.paginate_button').eq(2).removeClass('d-none').text('...');
                    }
                    if (endPage < numPages - 2) {
                        $('.paginate_button').eq(numPages - 1).removeClass('d-none').text('...');
                    }
                }

            });
        });
    </script>

@endsection
