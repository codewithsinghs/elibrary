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
                                            
                                            <th>User Name</th>
                                            <th>Fact</th>
                                            <th>Dept.</th>
                                            <th>Date</th>
                                            
                                            <th>From Time</th>
                                            <th>To Time</th>
                                            <th>Total Time Spent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activitySummary as $activity)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                          
                                            <td>{{ $activity->profile->name ?? $activity->user->name }}</td>
                                            <th>{{ $activity->profile->faculty }}</th>
                                            <th>{{ $activity->profile->department }}</th>
                                            <td>{{ $activity->date }}</td>
                                            {{--     --}}
                                            {{-- <td>{{ $activity->unic_id ?? null }}</td> --}}
                                           
                                            <td>{{ $activity->from_time->format('H:i A') }}</td>
                                            <td>{{ $activity->to_time->format('H:i A') }}</td>
                                            <td>{{ \Carbon\CarbonInterval::seconds($activity->total_time_spent)->cascade()->forHumans(['short' => true, 'parts' => 3]) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Name</th>
                                            {{-- <th>U_ID</th> --}}
                                            <th>Fact</th>
                                            <th>Dept.</th>
                                        
                                            <th>Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Spent</th>
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

    {{-- Working Perfectly with Multi input search
    <script>
        $(document).ready(function() {
            var table = $('#example14').DataTable({
                "ajax": "/get-activity-data", // Endpoint to fetch activity data
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "u_id"
                    },
                    {
                        "data": "faculty"
                    },
                    {
                        "data": "department"
                    },
                    {
                        "data": "role"
                    }
                    // Add more columns as needed
                ]
            });

            // Custom search function
            $('#facultySearch, #departmentSearch, #roleSearch').on('keyup', function() {
                table.column(1).search($('#facultySearch').val()).draw(); // Faculty search
                table.column(2).search($('#departmentSearch').val()).draw(); // Department search
                table.column(4).search($('#roleSearch').val()).draw(); // Role search
                // Add more search criteria as needed
            });
        });
    </script> --}}

    {{-- <script>
        // Define a variable to track whether DataTable is initialized
        var isDataTableInitialized = false;

        $(document).ready(function() {
            // Check if DataTable is already initialized
            if (!isDataTableInitialized) {
                // DataTable initialization
                var table = $('#example14').DataTable({
                    // DataTable configuration
                });

                // Function to populate dropdown options from unique values in a column
                function populateDropdown(columnIndex, dropdownId) {
                    var uniqueValues = {};
                    table.rows().every(function() {
                        var data = this.data();
                        if (data[columnIndex]) {
                            uniqueValues[data[columnIndex]] = true;
                        }
                    });

                    var optionsHtml = '<option value="">All</option>'; // Add an "All" option
                    Object.keys(uniqueValues).sort().forEach(function(value) {
                        optionsHtml += '<option value="' + value + '">' + value + '</option>';
                    });
                    $('#' + dropdownId).html(optionsHtml);
                }

                // Populate dropdowns for Name, U_ID, and Dept. columns
                populateDropdown(1, 'filterName');
                populateDropdown(2, 'filterUID');
                populateDropdown(3, 'filterDept');

                // Event listener for dropdown menu selection - Name
                $('#filterName').on('change', function() {
                    var selectedValue = $(this).val();
                    table.column(1).search(selectedValue).draw(); // Adjust the column index as needed
                });

                // Event listener for dropdown menu selection - U_ID
                $('#filterUID').on('change', function() {
                    var selectedValue = $(this).val();
                    table.column(2).search(selectedValue).draw(); // Adjust the column index as needed
                });

                // Event listener for dropdown menu selection - Dept.
                $('#filterDept').on('change', function() {
                    var selectedValue = $(this).val();
                    table.column(3).search(selectedValue).draw(); // Adjust the column index as needed
                });
            }
        });
    </script> --}}

    {{-- Multi Menu Filtering --}}
    {{-- <script>
        $(document).ready(function() {
            // Function to populate dropdown options from unique values in a column
            function populateDropdown(columnIndex, dropdownId) {
                var uniqueValues = {};
                $('#example14').DataTable().rows().every(function() {
                    var data = this.data();
                    if (data[columnIndex]) {
                        uniqueValues[data[columnIndex]] = true;
                    }
                });

                var optionsHtml = '<option value="">All</option>'; // Add an "All" option
                Object.keys(uniqueValues).sort().forEach(function(value) {
                    optionsHtml += '<option value="' + value + '">' + value + '</option>';
                });
                $('#' + dropdownId).html(optionsHtml);
            }

            // Populate dropdowns for Name, U_ID, and Dept. columns Index value
            populateDropdown(4, 'filterFact');
            populateDropdown(3, 'filterDept');
            populateDropdown(1, 'filterName');
            populateDropdown(2, 'filterUID');

            // Event listener for dropdown menu selection - Dept.
            $('#filterFact').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(4).search(selectedValue)
                    .draw(); // Adjust the column index as needed
            });

            // Event listener for dropdown menu selection - Name
            $('#filterName').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(1).search(selectedValue)
                    .draw(); // Adjust the column index as needed
            });

            // Event listener for dropdown menu selection - U_ID
            $('#filterUID').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(2).search(selectedValue)
                    .draw(); // Adjust the column index as needed
            });

            // Event listener for dropdown menu selection - Dept.
            $('#filterDept').on('change', function() {
                var selectedValue = $(this).val();
                $('#example14').DataTable().column(3).search(selectedValue)
                    .draw(); // Adjust the column index as needed
            });
        });
    </script> --}}

    <!-- Date Range Manual Filtering -->
    {{-- <script>
        $(document).ready(function() {
            var table = $('#example14').DataTable();

            // Store the original state of the DataTable
            var originalState = table.state();

            // Add event listener to the search button
            $('#search_button').click(function() {
                // console.log("Search button clicked");
                // Convert input dates to 'dd-mm-yy' format
                // var tmstartDate = $('#start_date').val();
                // var tmendDate = $('#end_date').val();
                // var startDate = formatDate(tmstartDate);
                // var endDate = formatDate(tmendDate);
                // // Your filtering logic here
                // console.log("Filtered with dates:", startDate, endDate);
                table.draw();
            });

            // Add custom filtering function
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    // Get Input dates
                    var tmstartDate = $('#start_date').val();
                    var tmendDate = $('#end_date').val();
                    var startDate = formatDate(tmstartDate);
                    var endDate = formatDate(tmendDate);

                    // var startDate = $('#start_date').val();
                    // var endDate = $('#end_date').val();
                    var date = data[6]; // Assuming the 7th column holds the date

                    //  console.log("Filtering:", startDate, endDate, date);

                    // Parse dates without moment.js Can use 'moment' at 'parseDate' below
                    // var startDateObj = moment(startDate, 'YYYY-MM-DD');    //moment based
                    var startDateObj = parseDate(startDate);
                    var endDateObj = parseDate(endDate);
                    var dataDateObj = parseDate(date);

                    //  console.log("Parsed dates:", startDateObj, endDateObj, dataDateObj);

                    // If start date is after end date, swap them
                    if (startDateObj > endDateObj) {
                        //   console.log("Swapping start and end dates");
                        var temp = startDate;
                        startDate = endDate;
                        endDate = temp;
                        startDateObj = parseDate(startDate);
                        endDateObj = parseDate(endDate);
                    }

                    if ((startDate === "" || endDate === "") ||
                        (startDateObj <= dataDateObj && endDateObj >= dataDateObj)) {
                        return true;
                    }
                    return false;
                }
            );

            // Function to parse date in various formats
            function parseDate(dateString) {
                let formatsToTry = ['YYYY-MM-DD', 'DD-MM-YYYY', 'MM-DD-YYYY'];

                for (let format of formatsToTry) {
                    let parsedDate = moment(dateString, format, true);
                    if (parsedDate.isValid()) {
                        return parsedDate.toDate();
                    }
                }

                return null; // Return null if the date string is not in any of the expected formats
            }

            // Function to format date as 'dd-mm-yy'
            function formatDate(dateString) {
                var parts = dateString.split(' ');
                // console.log(parts); // Debugging: Print out the parts array to inspect its contents
                var day = ("0" + parts[0].replace(',', '')).slice(-
                    2); // Remove comma and add leading zero if needed

                // Dictionary to map month names to their numerical representations
                var monthMap = {
                    "January": "01",
                    "February": "02",
                    "March": "03",
                    "April": "04",
                    "May": "05",
                    "June": "06",
                    "July": "07",
                    "August": "08",
                    "September": "09",
                    "October": "10",
                    "November": "11",
                    "December": "12"
                };

                // Remove any non-numeric characters from the month string
                var monthName = parts[1].replace(/\W/g, '');

                var month = monthMap[monthName];
                var year = parts[2];
                return day + '-' + month + '-' + year;
            }

            // Add event listener to the clear filters button
            $('#clear_filters_button').click(function() {
                $('#start_date, #end_date').val('');
                table.state.clear(); // Clear the stored state
                table.search('').columns().search('').draw(); // Clear search filters and redraw the table
            });

        });
    </script> --}}
    {{-- Well Code for working with input date --}}
    {{-- <script>
        $(document).ready(function() {
            var table = $('#example14').DataTable();

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
                // return !rowDate.isSameOrAfter(startDate) || !rowDate.isSameOrBefore(endDate);
            });

            // Event listener for the clear filters button
            $('#clear_filters_button').click(function() {
                $('#start_date, #end_date').val('');
                table.search('').columns().search('').draw();
            });
        });
    </script> --}}

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
