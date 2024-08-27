@extends('layouts.app')

@section('headerTitle', 'Resources')
<style>
    iframe {
        height :100vh!important;
    }
</style>
@section('main-content')

    <!--**********************************
                            Content body start
                        ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card w-100">
                       
                        <iframe src="{{ $resource->url }}" frameborder="0" allowfullscreen sandbox="allow-same-origin allow-scripts"></iframe>

                        
                    </div>
                </div>
                {{-- <div class="col-xl-4 col-xxl-5">
                    <div class="card h-auto">
                        <div class="card-header border-0 pb-0">
                            <h4>Progress</h4>
                         
                        </div>
                       
                    </div>
                    
                </div> --}}
            </div>
        </div>
    </div>
    <!--**********************************
                            Content body end
                        ***********************************-->


@endsection

