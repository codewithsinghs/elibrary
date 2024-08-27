@extends('layouts.app')

@push('styles')
 
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    
      <!-- Include DataTables Buttons CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"> --}}
@endpush

@push('scripts')


    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>
        <!-- Include DataTables Buttons JavaScript -->
{{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script> --}}
@endpush

@section('headerTitle', 'User Activities')

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
                        <div class="card-body">
                            <!-- Add standard buttons -->

                            <div class="table-responsive">
                                <table id="example14" class="display" style="min-width: 845px">

                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Unic_ID</th>
                                            <th>Dept.</th>
                                            <th>Page</th>
                                            <th>Url</th>
                                            {{-- <th>Incident Date</th>
                                            <th>From</th> --}}
                                            <th>To</th>
                                            <th>Time Spent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activities as $activity)
                                            <tr>
                                                <td><img class="rounded-circle" width="35"
                                                        src="{{ asset('build/assets/images/profile/small/pic10.jpg') }}"
                                                        alt=""></td>
                                                <td>{{ $activity->profile->name }}</td>
                                                <td>
                                                    @if ($activity->profile)
                                                        {{ $activity->profile->unic_id ?? Null }}
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($activity->profile)
                                                        {{ $activity->profile->department ?? Null }}
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <td>{{ $activity->page_name ?? Null }}</td>
                                                <td>{{ $activity->url ?? Null }}</td>
                                                
                                                {{-- <td>{{ $activity->start_time->format('Y-m-d') ?? Null }}</td>
                                                <td>{{ $activity->start_time->format('H:i:s') ?? Null }}</td> --}}
                                                <td>{{ $activity->end_time->format('H:i:s') ?? Null }}</td>
                                                <td>{{ $activity->time_spent ?? Null }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
    // $(document).ready(function() {
    //     $('#example14').DataTable({
    //         dom: 'lBfrtip',
    //         buttons: [
    //             'csv', 'excel', 'pdf', 'copy', 'print'
    //         ],
    //         lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    //         paging: true,
    //         searching: true
    //     });
    // });
    $(document).ready(function() {
        $('#example14').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'copy', 'print'
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            paging: true,
            searching: true
        });
    });
</script>
@endsection 
