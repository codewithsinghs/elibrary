@extends('layouts.app')
@section('headerTitle', 'User List')

@include('components.datatable')
<style>
    .dt-button {
  position: relative;
}
th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }
</style>
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
                                        <button id="clear_filters_button">Clear Filters</button>
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
                                    <table id="example14" class="display table table-striped" style="width:100%">
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
                                                        {{-- {{ Carbon\CarbonInterval::seconds($activity->time_spent)->cascade()->forHumans()  ?? '' }} --}}
                                                        {{ \Carbon\CarbonInterval::seconds($activity->time_spent)->cascade()->forHumans() }}
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
    @parent
    <!-- Include any additional scripts -->
    <script>
        new DataTable('#example14', {
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                }
            }
        });
    </script>
@endsection
