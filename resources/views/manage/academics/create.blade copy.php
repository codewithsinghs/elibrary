@extends('layouts.app')
@section('headerTitle', 'Create Course')
@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @include('layouts.sessions')
                                <form action="{{ route('academics.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-6 mb-2">
                                            <label class="form-label">User Category</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select" name="category"
                                                    onchange="toggleCustomInput(this)">
                                                    <option value="" selected disabled>Select User Category</option>
                                                    <option value="student"
                                                        {{ old('category') == 'student' ? 'selected' : '' }}>Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('category') == 'faculty' ? 'selected' : '' }}>Faculty Member
                                                    </option>
                                                    <!-- Add other options -->
                                                    <option value="custom"
                                                        {{ old('category') == 'custom' ? 'selected' : '' }}>Enter Custom
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control custom-input"
                                                    name="custom_category" placeholder="Custom Category"
                                                    style="{{ old('category') == 'custom' ? '' : 'display: none;' }}"
                                                    value="{{ old('category') == 'custom' ? old('custom_category') : '' }}">
                                            </div>
                                            @error('category')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="text-danger custom-error-message" style="display: none;">Custom
                                                category is required.</div>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="form-label">Institute</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select" name="institute"
                                                    onchange="toggleCustomInput(this)">
                                                    <option value="" selected disabled>Select Institute</option>
                                                    <option value="student"
                                                        {{ old('institute') == 'student' ? 'selected' : '' }}>Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('institute') == 'faculty' ? 'selected' : '' }}>Faculty Member
                                                    </option>
                                                    <!-- Add other options -->
                                                    <option value="custom"
                                                        {{ old('institute') == 'custom' ? 'selected' : '' }}>Enter Custom
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control custom-input"
                                                    name="custom_institute" placeholder="Custom institute"
                                                    style="{{ old('institute') == 'custom' ? '' : 'display: none;' }}"
                                                    value="{{ old('institute') == 'custom' ? old('custom_institute') : '' }}">
                                            </div>
                                            @error('institute')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="form-label">Faculty</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select" name="faculty"
                                                    onchange="toggleCustomInput(this)">
                                                    <option value="" selected disabled>Select Faculty</option>
                                                    <option value="student"
                                                        {{ old('faculty') == 'student' ? 'selected' : '' }}>Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('faculty') == 'faculty' ? 'selected' : '' }}>Faculty Member
                                                    </option>
                                                    <!-- Add other options -->
                                                    <option value="custom"
                                                        {{ old('faculty') == 'custom' ? 'selected' : '' }}>Enter Custom
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control custom-input"
                                                    name="custom_faculty" placeholder="Custom faculty"
                                                    style="{{ old('faculty') == 'custom' ? '' : 'display: none;' }}"
                                                    value="{{ old('faculty') == 'custom' ? old('custom_faculty') : '' }}">
                                            </div>
                                            @error('faculty')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="form-label">Department</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select" name="department"
                                                    onchange="toggleCustomInput(this)">
                                                    <option value="" selected disabled>Select Department</option>
                                                    <option value="student"
                                                        {{ old('department') == 'student' ? 'selected' : '' }}>Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('department') == 'faculty' ? 'selected' : '' }}>Faculty
                                                        Member
                                                    </option>
                                                    <!-- Add other options -->
                                                    <option value="custom"
                                                        {{ old('department') == 'custom' ? 'selected' : '' }}>Enter Custom
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control custom-input"
                                                    name="custom_department" placeholder="Custom department"
                                                    style="{{ old('department') == 'custom' ? '' : 'display: none;' }}"
                                                    value="{{ old('department') == 'custom' ? old('custom_department') : '' }}">
                                            </div>
                                            @error('department')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="form-label">Course / Designition</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select" name="course_designation"
                                                    onchange="toggleCustomInput(this)">
                                                    <option value="" selected disabled>Select course_designation
                                                    </option>
                                                    <option value="student"
                                                        {{ old('course_designation') == 'student' ? 'selected' : '' }}>
                                                        Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('course_designation') == 'faculty' ? 'selected' : '' }}>
                                                        Faculty Member
                                                    </option>
                                                    <!-- Add other options -->
                                                    <option value="custom"
                                                        {{ old('course_designation') == 'custom' ? 'selected' : '' }}>Enter
                                                        Custom
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control custom-input"
                                                    name="custom_course_designation" placeholder="Custom course_designation"
                                                    style="{{ old('course_designation') == 'custom' ? '' : 'display: none;' }}"
                                                    value="{{ old('course_designation') == 'custom' ? old('custom_course_designation') : '' }}">
                                            </div>
                                            @error('course_designation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="text-danger custom-error-message" style="display: none;">Custom
                                                category is required.</div>
                                        </div>
                                        {{-- <div class="mb-3 col-md-6">
                                            <label class="form-label">Institute Name</label>
                                            <input type="text" name="institute"
                                                class="form-control  @error('institute') is-invalid @enderror"
                                                placeholder="Institute Name" value="{{ old('institute') }}">
                                            @error('institute')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        {{-- <div class="mb-3 col-md-6">
                                            <label class="form-label">department</label>
                                            <input type="text" name="faculty"
                                                class="form-control @error('faculty') is-invalid @enderror"
                                                placeholder="Faculty " value="{{ old('faculty') }}">
                                            @error('faculty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Department</label>
                                            <input type="text" name="department"
                                                class="form-control @error('department') is-invalid @enderror"
                                                placeholder="Department " value="{{ old('department') }}">
                                            @error('department')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Course / Designation</label>
                                            <input type="text" name="course_designation"
                                                class="form-control @error('course_designation') is-invalid @enderror"
                                                placeholder="Course / Designation Name"
                                                value="{{ old('course_designation') }}">
                                            @error('course_designation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}


                                        <div class="mb-3 col-md-6">

                                            <label for="image" class="form-label">image</label>
                                            <input type="file" class="form-control" id="image" name="image">

                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    <button type="submit" class="btn btn-primary">Add Resource</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    {{-- <script>
    document.getElementById('category').addEventListener('change', function() {
        var customInput = document.querySelector('.custom-input');
        if (this.value === 'custom') {
            customInput.style.display = 'block';
        } else {
            customInput.style.display = 'none';
        }
    });
</script> --}}

    <script>
        // function toggleCustomInput(select) {
        //     var customInput = select.parentElement.querySelector('.custom-input');
        //     if (select.value === 'custom') {
        //         customInput.style.display = 'block';
        //         customInput.focus(); // Set focus to the input field
        //     } else {
        //         customInput.style.display = 'none';
        //     }
        // }
        function toggleCustomInput(select) {
            var customInput = select.parentElement.querySelector('.custom-input');
            if (select.value === 'custom') {
                customInput.style.display = 'block';
                customInput.focus(); // Set focus to the input field
                customInput.setAttribute('required', ''); // Make the input required
            } else {
                customInput.style.display = 'none';
                customInput.removeAttribute('required'); // Remove the required attribute
            }
        }
        // Show error message if custom input is empty and 'custom' is selected
        if (select.value === 'custom' && customInput.value.trim() === '') {
            customErrorMessage.style.display = 'block';
        } else {
            customErrorMessage.style.display = 'none';
        }

        // Call toggleCustomInput onload
        window.onload = function() {
            var select = document.getElementById('mySelect');
            toggleCustomInput(select);
        };
    </script>

@endsection
