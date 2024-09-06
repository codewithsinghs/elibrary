@extends('layouts.app')
@section('headerTitle', 'User List')

@include('components.datatable-responsive')

@section('main-content')

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

                                <div class="row flex">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"> From Date </span>
                                            <input type="date" id="start_date" name="start_date"
                                                class="datepicker-default form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

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
                                        <button class="btn btn-secondary" id="clear_filters_button">Clear Filters</button>
                                    </div>

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

                                <br> <br>
                                <div class="table-responsive">
                                    <table id="example14" class="display table table-striped nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                {{-- <th>U_ID</th> --}}
                                                <th>Fact</th>
                                                <th>Dept.</th>
                                                <th>Page</th>
                                                <th>Date</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Spent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activities as $activity)
                                                <tr>
                                                    <td class="text-left">{{ $loop->iteration }}</td>
                                                    <td>{{ $activity->profile->fname ?? null }}</td>
                                                    {{-- <td>
                                                        @if ($activity->profile)
                                                            {{ $activity->profile->unic_id ?? null }}
                                                        @else
                                                            Not Available
                                                        @endif
                                                    </td> --}}
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
                                                    <td><a class="text-decoration-none text-secondary" target="_blank"
                                                            href="{{ $activity->url ?? null }}">{{ $activity->page_name ?? null }}</a>
                                                    </td>
                                                    <td>{{ $activity->start_time->format('d-m-Y') ?? null }}</td>
                                                    <td>{{ $activity->start_time->format('H:i:s') ?? null }}</td>
                                                    <td>{{ $activity->end_time->format('H:i:s') ?? null }}</td>
                                                    <td>
                                                        {{-- {{ Carbon\CarbonInterval::seconds($activity->time_spent)->cascade()->forHumans()  ?? '' }} --}}
                                                        {{ \Carbon\CarbonInterval::seconds($activity->time_spent)->cascade()->forHumans(['short' => true]) }}
                                                    </td>
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
                                                <th>Page</th>
                                                <th>Date</th>
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
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    <!-- Include any additional scripts -->

    <script>
        // Call the function with the desired table ID
        initializeDataTable('#example14');
    </script>

    {{-- <script>
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

            // // Add custom filtering function
            // $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            //     var startDateInput = $('#start_date').val().trim();
            //     var endDateInput = $('#end_date').val().trim();

            //     // If either start date or end date is not provided, treat it as an unbounded filter
            //     if (!startDateInput || !endDateInput) {
            //         return true;
            //     }

            //     var startDate = moment(startDateInput, 'D MMMM, YYYY');
            //     var endDate = moment(endDateInput, 'D MMMM, YYYY');
            //     var rowDate = moment(data[6], 'DD-MM-YYYY');

            //     // Check if the provided range is reverse
            //     if (startDate.isAfter(endDate)) {
            //         var temp = startDate;
            //         startDate = endDate;
            //         endDate = temp;
            //     }

            //     return rowDate.isSameOrAfter(startDate) && rowDate.isSameOrBefore(endDate);
            // });

            // Add custom filtering function
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var startDateInput = $('#start_date').val().trim();
                var endDateInput = $('#end_date').val().trim();

                // If either start date or end date is not provided, treat it as an unbounded filter
                if (!startDateInput || !endDateInput) {
                    return true;
                }

                var startDate = moment(startDateInput,
                    'YYYY-MM-DD'); // Assuming your HTML date inputs have format 'YYYY-MM-DD'
                var endDate = moment(endDateInput, 'YYYY-MM-DD');
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
    </script> --}}




    <script>
        $(document).ready(function() {
            $('#example14').DataTable({
                responsive: true,
                paging: true,
                // dom: 'Bfrtip',
                // buttons: [
                //     'excel', 'print', 'pdf'
                // ]
                buttons: ['excel', 'print', 'pdf'],
                // "dom": 'T<"clear">lfrtip',
                // "tableTools": {
                //     "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
                // },
            });
        });
    </script>

@endsection
