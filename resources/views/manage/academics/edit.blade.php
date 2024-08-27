@extends('layouts.app')
@section('headerTitle', 'Create Course')
<style>
    /* select.form-control.custom-select option[selected] {
        background-color: lightblue;
    } */

    select.form-control option:checked {
        background-color: #FFC8C1;
        /* Change this to your desired highlight color */
        font-weight: bold;
        /* Optionally, you can bold the text */
    }
</style>
@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Acadamic Details</h4>
                            <a class="btn btn-primary text-right" href="{{ route('academics.index') }}">Academic record
                                List</a>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @include('layouts.sessions')
                                <form action="{{ route('academics.update', $academicEntity->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        {{-- @foreach ($predefinedValues as $field => $values)
                                            <div class="col-lg-6 mb-2">
                                                <label class="form-label">{{ ucfirst($field) }}</label>
                                                <div class="input-group">
                                                    <select class="form-control custom-select" name="{{ $field }}"
                                                        onchange="toggleCustomInput(this)">
                                                        <option value="" selected disabled>Select
                                                            {{ ucfirst($field) }}</option>
                                                        @foreach ($values as $value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                        <option value="custom">Enter Custom</option>
                                                    </select>
                                                    <input type="text" class="form-control custom-input"
                                                        name="custom_{{ $field }}"
                                                        placeholder="Custom {{ ucfirst($field) }}" style="display: none;">
                                                </div>
                                                <div class="text-danger custom-error-message" style="display: none;">Custom
                                                    {{ $field }} is required.</div>
                                            </div>
                                        @endforeach --}}
                                        @foreach ($predefinedValues as $field => $values)
                                            <div class="col-lg-6 mb-2">
                                                <label class="form-label">{{ ucfirst($field) }}</label>
                                                <div class="input-group">
                                                    <select
                                                        class="form-control custom-select @error($field) is-invalid @enderror"
                                                        name="{{ $field }}" onchange="toggleCustomInput(this)">
                                                        <option value="" disabled>Select {{ ucfirst($field) }}
                                                        </option>
                                                        {{-- Add predefined values --}}
                                                        @foreach ($values as $value)
                                                            <option value="{{ $value }}"
                                                                @if ((old($field) == $value || $academicEntity->$field == $value) && old($field) != null) selected
                        @elseif($academicEntity->$field == $value)
                            selected style="background-color: #e2e8f0;" @endif>
                                                                {{ $value }}</option>
                                                        @endforeach
                                                        {{-- Add distinct values if available --}}
                                                        @if (isset($distinctValues[$field]) && is_array($distinctValues[$field]))
                                                            @foreach ($distinctValues[$field] as $distinctValue)
                                                                <option value="{{ $distinctValue }}"
                                                                    @if ((old($field) == $distinctValue || $academicEntity->$field == $distinctValue) && old($field) != null) selected
                            @elseif($academicEntity->$field == $distinctValue)
                                selected style="background-color: #e2e8f0;" @endif>
                                                                    {{ $distinctValue }}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="custom"
                                                            {{ old($field) && !in_array(old($field), $values) && !in_array(old($field), $distinctValues[$field] ?? []) ? 'selected' : '' }}>
                                                            Enter Custom</option>
                                                    </select>
                                                    <input type="text" class="form-control custom-input"
                                                        name="custom_{{ $field }}"
                                                        placeholder="Custom {{ ucfirst($field) }}" style="display: none;"
                                                        {{ old($field) && !in_array(old($field), $values) && !in_array(old($field), $distinctValues[$field] ?? []) ? 'value=' . old($field) : '' }}>
                                                    @error($field)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- <div class="col-lg-6 mb-2">
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
                                        </div> --}}
                                        {{-- <div class="col-lg-6 mb-2">
                                            <label class="form-label">User Category</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select" name="category"
                                                    onchange="toggleCustomInput(this)">
                                                    <option value="" selected disabled>Select User Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category }}"
                                                            {{ old('category', $academicEntity->category) == $category ? 'selected' : '' }}>
                                                            {{ $category }}
                                                        </option>
                                                    @endforeach
                                                    <option value="custom"
                                                        {{ old('category', $academicEntity->category) == 'custom' ? 'selected' : '' }}>
                                                        Enter Custom
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control custom-input"
                                                    name="custom_category" placeholder="Custom Category"
                                                    style="{{ old('category', $academicEntity->category) == 'custom' ? '' : 'display: none;' }}"
                                                    value="{{ old('custom_category') }}">
                                            </div>
                                            @error('category')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="text-danger custom-error-message" style="display: none;">Custom
                                                category is required.</div>
                                        </div> --}}

                                        {{-- <div class="col-lg-6 mb-2">
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
                                                <select class="form-control custom-select" name="course"
                                                    onchange="toggleCustomInput(this)">
                                                    <option value="" selected disabled>Select course
                                                    </option>
                                                    <option value="student"
                                                        {{ old('course') == 'student' ? 'selected' : '' }}>
                                                        Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('course') == 'faculty' ? 'selected' : '' }}>
                                                        Faculty Member
                                                    </option>
                                                    <!-- Add other options -->
                                                    <option value="custom"
                                                        {{ old('course') == 'custom' ? 'selected' : '' }}>Enter
                                                        Custom
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control custom-input"
                                                    name="custom_course" placeholder="Custom course"
                                                    style="{{ old('course') == 'custom' ? '' : 'display: none;' }}"
                                                    value="{{ old('course') == 'custom' ? old('custom_course') : '' }}">
                                            </div>
                                            @error('course')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="text-danger custom-error-message" style="display: none;">Custom
                                                category is required.</div>
                                        </div> --}}

                                        <div class="mb-3 col-md-6">
                                         
                                            <label for="image" class="form-label">image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @if ($academicEntity->image)
                                            <img src="{{ asset('storage/academics/' . (Storage::disk('public')->exists('academics/thumbnails/' . $academicEntity->image) ? 'thumbnails/' . $academicEntity->image : $academicEntity->image)) }}" alt="Thumbnail">
                                            <input type="checkbox" name="remove_image" id="remove_image">
                                            <label for="remove_image">Remove image</label>
                                            @endif

                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    <button type="submit" class="btn btn-primary">Update Academic Data</button>
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
