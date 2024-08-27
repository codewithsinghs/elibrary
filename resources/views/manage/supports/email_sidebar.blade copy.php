<div class="email-left-box mb-md-5 mb-4">
    <div class="p-0">
        <a href="{{route('support-tickets.create')}}" class="btn btn-primary btn-block">Compose</a>
    </div>
    <div class="mail-list rounded mt-4">
        <a href="{{ route('support-tickets.index') }}" class="list-group-item active">
            <i class="fa fa-inbox font-18 align-middle me-2"></i> Inbox
            <span class="badge badge-primary badge-sm float-end">@isset($supportTickets) {{ $supportTickets->count() }} @endisset</span>
        </a>
        <a href="{{ route('support-tickets.index-open')}}" class="list-group-item">
            <i class="fa fa-paper-plane font-18 align-middle me-2"></i> Open
            <span class="badge badge-primary badge-sm float-end">@isset($supportTickets) {{ $supportTickets->count() }} @endisset</span>
        </a>
        <a href="javascript:void(0);" class="list-group-item">
            <i class="fa fa-star font-18 align-middle me-2"></i>Important
            <span class="badge badge-circle badge-danger badge-sm text-white float-end">7</span>
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

{{-- <div class="email-left-box mb-md-5 mb-4">
    <div class="p-0">
        <a href="{{ route('support-tickets.create') }}" class="btn btn-primary btn-block">Compose</a>
    </div>
    <div class="mail-list rounded mt-4">
        <a href="{{ route('support-tickets.index') }}" class="list-group-item active">
            <i class="fa fa-inbox font-18 align-middle me-2"></i> Inbox
            <span class="badge badge-primary badge-sm float-end">198</span>
        </a>
        <a href="{{ route('support-tickets.sent') }}" class="list-group-item">
            <i class="fa fa-paper-plane font-18 align-middle me-2"></i> Sent
        </a>
        <a href="{{ route('support-tickets.important') }}" class="list-group-item">
            <i class="fa fa-star font-18 align-middle me-2"></i>Important
            <span class="badge badge-circle badge-danger badge-sm text-white float-end">7</span>
        </a>
        <a href="{{ route('support-tickets.draft') }}" class="list-group-item">
            <i class="mdi mdi-file-document-box font-18 align-middle me-2"></i>Draft
        </a>
        <a href="{{ route('support-tickets.trash') }}" class="list-group-item">
            <i class="fa fa-trash font-18 align-middle me-2"></i>Trash
        </a>
    </div>
    <div class="mail-list rounded overflow-hidden mt-4">
        <div class="intro-title d-flex my-0 justify-content-between">
            <h5>Categories</h5>
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </div>
        
        <a href="{{ route('category.work') }}" class="list-group-item">
            <span class="icon-warning">
                <i class="fa fa-circle" aria-hidden="true"></i>
            </span>
            Work
        </a>
        <a href="{{ route('category.private') }}" class="list-group-item">
            <span class="icon-primary">
                <i class="fa fa-circle" aria-hidden="true"></i>
            </span>
            Private
        </a>
        <a href="{{ route('category.support') }}" class="list-group-item">
            <span class="icon-success">
                <i class="fa fa-circle" aria-hidden="true"></i>
            </span>
            Support
        </a>
        <a href="{{ route('category.social') }}" class="list-group-item">
            <span class="icon-dpink">
                <i class="fa fa-circle" aria-hidden="true"></i>
            </span>
            Social
        </a>
    </div>
</div> --}}

