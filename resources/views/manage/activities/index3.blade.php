@extends('layouts.app')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- Daterange picker -->
    {{-- <link href="{{ asset('build/assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"> --}}

    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/pickadate/themes/default.date.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom Stylesheet -->
    {{-- <link href="{{ asset('build/assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet"> --}}
@endpush
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
        width: 100px !important;
    }
</style>
@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- momment js is must -->
    {{-- <script src="{{ asset('build/assets/vendor/moment/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('build/assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}

    <!-- pickdate -->
    <script src="{{ asset('build/assets/vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/pickadate/picker.date.js') }}"></script>

    <!-- Daterangepicker -->
    {{-- <script src="{{ asset('build/assets/js/plugins-init/bs-daterange-picker-init.js') }}"></script> --}}

    <!-- Pickdate -->
    <script src="{{ asset('build/assets/js/plugins-init/pickadate-init.js') }}"></script>

    {{-- <script src="{{ asset('build/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script> --}}
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
                {{-- <div class="col-xl-3">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-1">Default picker</p>
                            <input type="date" id="start_date" name="start_date" name="datepicker"
                                class="datepicker-default form-control">
                        </div>
                    </div>
                    <!-- Card -->
                </div> --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profile Datatable</h4>
                        </div>
                        <div class="card-body">
                            {{-- <input type="text" id="facultySearch" placeholder="Faculty">
                            <input type="text" id="departmentSearch" placeholder="Department">
                            <input type="text" id="roleSearch" placeholder="Role"> --}}
                            <div class="row flex">
                                <div class="col-md-4">

                                    {{-- <label class="text-label form-label" for="start_date">Username</label> --}}

                                    <div class="input-group">
                                        <span class="input-group-text"> From Date </span>
                                        <input type="date" id="start_date" name="start_date"
                                            class="datepicker-default form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    {{-- <label class="text-label form-label" for="end_date">Username</label> --}}
                                    <div class="input-group">
                                        <span class="input-group-text"> To Date </span>
                                        <input type="date" id="end_date" name="end_date"
                                            class="datepicker-default form-control">
                                        <div class="invalid-feedback">
                                            Please select date
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <!-- Search button -->
                                    <button class="btn btn-primary" id="search_button">Search</button>
                                    <button id="clear_filters_button">Clear Filters</button>
                                </div>
                                {{-- <div class="col-md-3">
                                    <label for="fromDate">From:</label>
                                    <input type="date" id="fromDate" name="fromDate">
                                </div>
                                <div class="col-md-3">
                                    <label for="toDate">To:</label>
                                    <input type="date" id="toDate" name="toDate">
                                </div>
                                <div class="col-md-3">
                                    <button id="searchBtn">Search</button>
                                </div> --}}
                                {{-- <form class="text-right">
                                    <label for="from_date">From Date:</label>
                                    <input type="date" id="from_date" name="from_date" required>
                                
                                    <label for="to_date">To Date:</label>
                                    <input type="date" id="to_date" name="to_date" required>
                                
                                    <button type="button" onclick="applyDateRange()">Apply Date Range</button>
                                </form> --}}
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <label class="form-label">Faculty</label>
                                    <select id="filterFact" class=" default-select form-control"><span
                                            class="current">Choose...</span>

                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Departmrnt</label>
                                    <select id="filterDept" class=" default-select form-control"><span
                                            class="current">Choose...</span>

                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Resource</label>
                                    <select id="filterSrc" class=" default-select form-control"><span
                                            class="current">Choose...</span>

                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Role/Position/Name</label>
                                    <select id="filterName" class=" default-select form-control"><span
                                            class="current">Choose...</span>

                                    </select>
                                </div>

                                <div class="col">
                                    <label class="form-label">UID</label>
                                    <select id="filterUID" class=" default-select form-control"><span
                                            class="current">Choose...</span>

                                    </select>
                                </div>
                            </div>
                            <!-- Dropdown Menu for Selecting Unique Values - Name -->
                            {{-- <select id="filterName">
                                <option value="">All</option> <!-- Option for showing all data -->
                                <!-- Options for unique names will be added dynamically -->
                            </select> --}}


                            <br> <br>
                            <div class="table-responsive">
                                <table id="example14" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Sr N.</th>
                                            <th>Date</th>
                                            <th>User Name</th>
                                            {{-- <th>User ID</th> --}}
                                            {{-- <th>Unique ID</th> --}}
                                            <th>Total Time Spent</th>
                                            <th>Total Sessions</th>
                                            <th>From Time</th>
                                            <th>To Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activitySummary as $activity)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $activity->date }}</td>
                                            <td>{{ $activity->profile->name ?? $activity->user->name }}</td>
                                            {{-- <td>{{ $activity->local_user_id }}</td>
                                            <td>{{ $activity->unic_id }}</td> --}}
                                            <td>{{ \Carbon\CarbonInterval::seconds($activity->total_time_spent)->cascade()->forHumans(['short' => true, 'parts' => 3]) }}</td>
                                            <td>{{ $activity->total_sessions }} </td>
                                            <td> 
                                                {{ $activity->from_time->format('H:i:s') }}
                                          </td>
                                            <td>
                                                {{-- @if ($activity->to_time instanceof \Carbon\Carbon) --}}
                                                {{ $activity->to_time->format('H:i:s') }}
                                         
                                           </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. N.</th>
                                            <th>Date</th>
                                            <th>User Name</th>
                                            {{-- <th>User ID</th>
                                            <th>Unique ID</th> --}}
                                            <th>Total Time Spent</th>
                                            <th>Total Sessions</th>
                                            <th>From Time</th>
                                            <th>To Time</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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
                    'csv', 'excel', 'pdf', 'copy', 'print'
                ],
                lengthMenu: [
                    [10, 25, 50, 100, 200, 500, 1000, -1],
                    [10, 25, 50, 100, 200, 500, 1000, "All"]
                ],
                paging: true,
                searching: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#example14').DataTable();

            // Function to populate dropdown options from unique values in a column
            function populateDropdown(columnIndex, dropdownId) {
                var uniqueValues = {};
                $('#example14').DataTable().rows().every(function() {
                    var data = this.data();
                    // if (data[columnIndex]) {
                    //     uniqueValues[data[columnIndex]] = true;
                    // }
                  // remove html from filter, remain unchanged in url
                    if (data[columnIndex] && !isUrl(data[columnIndex])) {
                        var valueWithoutTags = data[columnIndex].replace(/(<([^>]+)>)/gi,
                        ""); // Remove HTML tags
                        uniqueValues[valueWithoutTags] = data[columnIndex];
                    }
                });

                var optionsHtml = '<option value="">All</option>'; // Add an "All" option
                Object.keys(uniqueValues).sort().forEach(function(value) {
                    optionsHtml += '<option value="' + value + '">' + value + '</option>';
                });
                $('#' + dropdownId).html(optionsHtml);

                // Set dropdown to "All" by default
                // $('#' + dropdownId).val('').prop('selected', true);
            }

            // Function to check if a string is an anchor (URL)
            // Function to check if a string is a URL
            function isUrl(str) {
                return /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/.test(str);
            }

            // Populate dropdowns for Name, U_ID, and Dept. columns Index value
            populateDropdown(5, 'filterSrc');
            populateDropdown(4, 'filterDept');
            populateDropdown(3, 'filterFact');
            populateDropdown(2, 'filterUID');
            populateDropdown(1, 'filterName');

            // Event listener for dropdown menu selection - Dept.
            $('#filterSrc').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(5).search(selectedValue).draw();
            });

            // Event listener for dropdown menu selection - Dept.
            $('#filterFact').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(3).search(selectedValue).draw();
            });
            // Event listener for dropdown menu selection - Dept.


            // Event listener for dropdown menu selection - Name
            $('#filterName').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(1).search(selectedValue).draw();
            });

            // Event listener for dropdown menu selection - U_ID
            $('#filterUID').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(2).search(selectedValue).draw();
            });

            // Event listener for dropdown menu selection - Dept.
            $('#filterDept').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(4).search(selectedValue).draw();
            });

            // Add event listener to the search button
            $('#search_button').click(function() {
                table.draw();
            });

            // Add custom filtering function
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var startDateInput = $('#start_date').val().trim();
                var endDateInput = $('#end_date').val().trim();

                // If either start date or end date is not provided, treat it as an unbounded filter
                if (!startDateInput || !endDateInput) {
                    return true;
                }

                var startDate = moment(startDateInput, 'D MMMM, YYYY');
                var endDate = moment(endDateInput, 'D MMMM, YYYY');
                var rowDate = moment(data[6], 'DD-MM-YYYY');

                // Check if the provided range is reverse
                if (startDate.isAfter(endDate)) {
                    var temp = startDate;
                    startDate = endDate;
                    endDate = temp;
                }

                return rowDate.isSameOrAfter(startDate) && rowDate.isSameOrBefore(endDate);
            });

            // Event listener for the clear filters button
            $('#clear_filters_button').click(function() {
                // $('#filterFact, #filterDept, #filterName, #filterUID').val('').trigger('change');
                // Reset dropdown menus to "All" option if no value is selected
                $('#filterFact, #filterDept, #filterName, #filterUID').val('').prop('selected', false)
                    .trigger('change');
                $('#start_date, #end_date').val('');
                table.search('').columns().search('').draw();
            });
        });
    </script>

@endsection
