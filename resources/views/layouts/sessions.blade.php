<!-- Check if success flash message exists -->
@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<!-- Check if error flash message exists -->
{{-- @if (Session::has('errors'))
    <div class="alert alert-danger">
        {{ Session::get('errors') }}
    </div>
@endif --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<!-- Check if warning flash message exists -->
@if (Session::has('warning'))
    <div class="alert alert-warning">
        {{ Session::get('warning') }}
    </div>
@endif

<!-- Check if info flash message exists -->
@if (Session::has('info'))
    <div class="alert alert-info">
        {{ Session::get('info') }}
    </div>
@endif