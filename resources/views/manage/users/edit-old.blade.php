@extends('layouts.app')
@section('headerTitle', 'Create Course')

@push('styles')
    <!-- Form step -->
    <link href="{{ asset('build/assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Form Steps -->
    <script src="{{ asset('build/assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
@endpush

<style>
    select.form-control option:checked {
        background-color: #e2e8f0;
        /* Change this to your desired highlight color */
        font-weight: bold;
        /* Optionally, you can bold the text */
    }
</style>
@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Components</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form step</h4>
                        </div>
                        <div class="card-body">
                            <div id="smartwizard" class="form-wizard order-create">
                                <ul class="nav nav-wizard">
                                    <li><a class="nav-link" href="#wizard_Service" onclick="showStep(1)">
                                            <span>1</span>
                                        </a></li>
                                    <li><a class="nav-link" href="#wizard_Time" onclick="showStep(2)">
                                            <span>2</span>
                                        </a></li>
                                    <li><a class="nav-link" href="#wizard_Details" onclick="showStep(3)">
                                            <span>3</span>
                                        </a></li>
                                    <li><a class="nav-link" href="#wizard_Payment" onclick="showStep(4)">
                                            <span>4</span>
                                        </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="row">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                       
                                        <!-- Step 1 content -->
                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <input type="hidden" id="user_id" name="user_id"
                                                    value="{{ $user->id }}">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Name*</label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Full Name" value="{{ old('name', $user->name) }}"
                                                        required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Email Address*</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="inputGroupPrepend2" aria-describedby="inputGroupPrepend2"
                                                        placeholder="example@example.com"
                                                        value="{{ old('email', $user->email) }}" required>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label for="role_position">Role Position</label>
                                                <select class="form-control " id="role_position" name="role_position">
                                                    <option value="" selected disabled>Select Role Position</option>
                                                    <option value="student"
                                                        {{ old('role_position', $user->profile->role_position) == 'student' ? 'selected, text-primary' : '' }}>
                                                        Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('role_position', $user->profile->role_position) == 'faculty' ? 'selected' : '' }}>
                                                        Faculty
                                                    </option>
                                                    <option value="research scholar"
                                                        {{ old('role_position', $user->profile->role_position) == 'research scholar' ? 'selected' : '' }}>
                                                        Research Scholar</option>
                                                    <option value="staff"
                                                        {{ old('role_position', $user->profile->role_position) == 'staff' ? 'selected' : '' }}>
                                                        Staff
                                                    </option>
                                                    <option value="administrator"
                                                        {{ old('role_position', $user->profile->role_position) == 'administrator' ? 'selected' : '' }}>
                                                        Administrator</option>
                                                    <option value="librarian"
                                                        {{ old('role_position', $user->profile->role_position) == 'librarian' ? 'selected' : '' }}>
                                                        Librarian</option>
                                                    <option value="Manager"
                                                        {{ old('role_position', $user->profile->role_position) == 'Manager' ? 'selected' : '' }}>
                                                        Manager
                                                    </option>
                                                </select>
                                                @error('role_position')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- <div class="col-lg-6 mb-2">
                                                <label for="assign_role">Assign Role</label>
                                                <select class="form-control border border-success" id="assign_role" name="assign_role">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" {{ old('assign_role', optional($user->roles->first())->name ?? '') == $role->name ? 'selected, bg-green' : '' }}
                                                            class="{{ old('assign_role', optional($user->roles->first())->name ?? '') == $role->name ? 'bg-success' : '' }}">
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_position')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            <div class="col-lg-6 mb-2">
                                                <label for="assign_role">Assign Role</label>
                                                <select class="form-control border-success" id="assign_role"
                                                    name="assign_role">
                                                    <option value="" selected disabled>Select Role Position</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ old('assign_role', optional($user->roles->first())->name ?? '') == $role->name ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('assign_role')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 mt-4 mb-2">
                                                <div class="mb-3">
                                                    <input type="checkbox" id="change_password" name="change_password">
                                                    <label class="text-label form-label" for="change_password">Change
                                                        Password</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2" id="password_fields" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="********">
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2" id="password_confirmation_fields"
                                                style="display: none;">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Confirm Password</label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control" placeholder="*********">
                                                    @error('password_confirmation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-2">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="male" class="{{ isset($user) && $user->profile && $user->profile->gender === 'male' ? 'existing-value' : '' }}" {{ old('gender') == 'male' || (isset($user) && $user->profile && $user->profile->gender === 'male') ? 'selected' : '' }}>
                                                        Male
                                                    </option>
                                                    <option value="female" class="{{ isset($user) && $user->profile && $user->profile->gender === 'female' ? 'existing-value' : '' }}" {{ old('gender') == 'female' || (isset($user) && $user->profile && $user->profile->gender === 'female') ? 'selected' : '' }}>
                                                        Female
                                                    </option>
                                                    <option value="other" class="{{ isset($user) && $user->profile && $user->profile->gender === 'other' ? 'existing-value' : '' }}" {{ old('gender') == 'other' || (isset($user) && $user->profile && $user->profile->gender === 'other') ? 'selected' : '' }}>
                                                        Other
                                                    </option>
                                                </select>
                                                @error('gender')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- <div class="col-lg-6 mb-2">
                                                <label for="assign_role">Assign Role</label>
                                                <select class="form-control " id="assign_role" name="assign_role">
                                                    <option value="" selected disabled>Select Role Position</option>
                                                    <option value="student"
                                                        {{ old('assign_role', $user->assign_role) == 'student' ? 'selected' : '' }}>Student
                                                    </option>
                                                    <option value="faculty"
                                                        {{ old('assign_role', $user->assign_role) == 'member' ? 'selected' : '' }}>Member
                                                    </option>
                                                    <option value="research scholar"
                                                        {{ old('assign_role', $user->assign_role) == 'research scholar' ? 'selected' : '' }}>
                                                        Research Scholar</option>
                                                    <option value="staff"
                                                        {{ old('assign_role', $user->assign_role) == 'staff' ? 'selected' : '' }}>Staff
                                                    </option>

                                                    <option value="librarian"
                                                        {{ old('assign_role', $user->assign_role) == 'librarian' ? 'selected' : '' }}>
                                                        Librarian</option>
                                                    <option value="Manager"
                                                        {{ old('assign_role', $user->assign_role) == 'Manager' ? 'selected' : '' }}>Manager
                                                    </option>
                                                </select>
                                                @error('role_position')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}



                                        </div>

                                    </div>
                                    <div id="wizard_Time" class="tab-pane" role="tabpanel">
                                        <!-- Step 2 content -->
                                        <h4>Personal Info</h4>
                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Faculty</label>
                                                    <input type="text" name="faculty" class="form-control"
                                                        placeholder="......"
                                                        value="{{ old('faculty', $user->profile->faculty) }}">
                                                    @error('faculty')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Department</label>
                                                    <input type="text" name="department" class="form-control"
                                                        placeholder="....."
                                                        value="{{ old('department', $user->profile->department) }}">
                                                    @error('department')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Favorite Resource</label>
                                                    <input type="text" name="favorite_resources" class="form-control"
                                                        placeholder="....."
                                                        value="{{ old('favorite_resources', $user->profile->favorite_resources) }}">
                                                    @error('favorite_resources')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Library Privileges</label>
                                                    <input type="text" name="library_privileges" class="form-control"
                                                        placeholder="student, Regular Member"
                                                        value="{{ old('library_privileges', $user->profile->library_privileges) }}">
                                                    @error('library_privileges')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-6 mb-2">
                                                <label for="library_privileges">Library Privileges</label>
                                                <select class="form-control" id="library_privileges"
                                                    name="library_privileges">
                                                    <option value="" selected disabled>Select Library Privileges
                                                    </option>
                                                    <option value="student"
                                                        {{ old('library_privileges', $user->profile->library_privileges) == 'student' ? 'selected' : '' }}>
                                                        Student</option>
                                                    <option value="regular_member"
                                                        {{ old('library_privileges', $user->profile->library_privileges) == 'regular_member' ? 'selected' : '' }}>
                                                        Regular Member</option>
                                                    <option value="faculty"
                                                        {{ old('library_privileges', $user->profile->library_privileges) == 'faculty' ? 'selected' : '' }}>
                                                        Faculty</option>
                                                    <option value="guest"
                                                        {{ old('library_privileges', $user->profile->library_privileges) == 'guest' ? 'selected' : '' }}>
                                                        Guest Member</option>
                                                    <option value="librarian"
                                                        {{ old('library_privileges', $user->profile->library_privileges) == 'librarian' ? 'selected' : '' }}>
                                                        Librarian</option>
                                                    <option value="administrator"
                                                        {{ old('library_privileges', $user->profile->library_privileges) == 'administrator' ? 'selected' : '' }}>
                                                        Manager</option>
                                                </select>
                                                @error('library_privileges')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Research Interests</label>
                                                    <input type="text" name="research_interests" class="form-control"
                                                        placeholder="__________"
                                                        value="{{ old('research_interests', $user->profile->research_interests) }}">
                                                    @error('research_interests')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Access Levels</label>
                                                    <input type="text" name="access_levels" class="form-control"
                                                        value="{{ old('access_levels', $user->profile->access_levels) }}">
                                                    @error('access_levels')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                        <!-- Step 3 content -->
                                        {{-- <h4>Personal Info</h4> --}}

                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Phone Number</label>
                                                    <input type="text" name="phone_number" class="form-control"
                                                        placeholder="(+91) 9999999999"
                                                        value="{{ old('phone_number', $user->profile->phone_number) }}">
                                                    @error('phone_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Alternative Email</label>
                                                    <input type="text" name="alternate_email" class="form-control"
                                                        placeholder="alias@domain.ext"
                                                        value="{{ old('alternate_email', $user->profile->alternate_email) }}">
                                                    @error('alternate_email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Preferred Genres</label>
                                                    <input type="text" name="preferred_genres" class="form-control"
                                                        placeholder="......"
                                                        value="{{ old('preferred_genres', $user->profile->preferred_genres) }}">
                                                    @error('preferred_genres')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Preferred Language</label>
                                                    <input type="text" name="preferred_language" class="form-control"
                                                        placeholder="........"
                                                        value="{{ old('preferred_language', $user->profile->preferred_language) }}">
                                                    @error('preferred_language')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Communication Preferences</label>
                                                    <input type="text" name="communication_preferences"
                                                        class="form-control" placeholder="......."
                                                        value="{{ old('communication_preferences', $user->profile->communication_preferences) }}">
                                                    @error('communication_preferences')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Residencial Address</label>
                                                    <input type="text" name="residential_address" class="form-control"
                                                        value="{{ old('residential_address', $user->profile->residential_address) }}">
                                                    @error('residential_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Social Integration</label>
                                                    <input type="text" name="social_integration" class="form-control"
                                                        placeholder="__________"
                                                        value="{{ old('social_integration', $user->profile->social_integration) }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-2">

                                                <label for="image" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" id="image"
                                                    name="image">
                                                @if ($user->profile->image)
                                                    <img src="{{ asset('storage/users/' . (Storage::disk('public')->exists('users/thumbnails/' . $user->profile->image) ? 'thumbnails/' . $user->profile->image : $user->profile->image)) }}"
                                                        alt="Thumbnail" width="100">
                                                    <input type="checkbox" name="remove_image" id="remove_image">
                                                    <label for="remove_image">Remove image</label>
                                                @endif
                                                <!-- Hidden input field to store the old profile picture value -->

                                                {{-- @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @php
                                                    // Get the old value of the profile picture input
                                                    $oldProfilePicture = old('image');
                                                @endphp

                                                @if ($oldProfilePicture)
                                                    <input type="hidden" name="old_image"
                                                        value="{{ $oldProfilePicture }}">
                                                @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div id="wizard_Payment" class="tab-pane" role="tabpanel">
                                        <!-- Step 4 content -->
                                        <div class="row emial-setup">
                                            <div class="col-lg-3 col-sm-6 col-6">
                                                <div class="mb-3">
                                                    <label for="mailclient11" class="mailclinet mailclinet-gmail">
                                                        <input type="radio" name="emailclient" id="mailclient11">
                                                        <span class="mail-icon">
                                                            <i class="mdi mdi-google-plus" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="mail-text">I'm using Gmail</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-6">
                                                <div class="mb-3">
                                                    <label for="mailclient12" class="mailclinet mailclinet-office">
                                                        <input type="radio" name="emailclient" id="mailclient12">
                                                        <span class="mail-icon">
                                                            <i class="mdi mdi-office" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="mail-text">I'm using Office</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-6">
                                                <div class="mb-3">
                                                    <label for="mailclient13" class="mailclinet mailclinet-drive">
                                                        <input type="radio" name="emailclient" id="mailclient13">
                                                        <span class="mail-icon">
                                                            <i class="mdi mdi-google-drive" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="mail-text">I'm using Drive</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-6">
                                                <div class="mb-3">
                                                    <label for="mailclient14" class="mailclinet mailclinet-another">
                                                        <input type="radio" name="emailclient" id="mailclient14">
                                                        <span class="mail-icon">
                                                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="mail-text">Another Service</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="skip-email text-center">
                                                    <p>Or if want skip this step entirely and setup it later</p>
                                                    <a href="javascript:void(0)">Skip step</a>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <a href="{{ route('users.store') }}" class="btn btn-primary sw-btn-submit" style="display: none;">Submit</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            // Show password fields by default
            $('#password_fields').show();
            $('#password_confirmation_fields').show();

            // Handle change event of the checkbox
            $('#change_password').change(function() {
                if (this.checked) {
                    // If checkbox is checked, show password fields
                    $('#password_fields').show();
                    $('#password_confirmation_fields').show();
                } else {
                    // If checkbox is unchecked, hide password fields
                    $('#password_fields').hide();
                    $('#password_confirmation_fields').hide();
                }
            });



            // Initialize password fields visibility after a slight delay
            setTimeout(function() {
                $('#change_password').change();
            }, 100);

            // Initialize SmartWizard
            $('#smartwizard').smartWizard({
                // Set options including disabling URL updating
                enableURLhash: false
            });

            $('#submit-button').on('click', function() {
                // Create a form element dynamically
                var form = $('<form></form>');
                form.attr('method', 'POST');
                form.attr('enctype', 'multipart/form-data'); // Set enctype for file uploads

                // Action for update method needs to include user ID
                var userId = $('#user_id').val(); // Get the user ID from the input field
                form.attr('action', "{{ route('users.update', ['user' => 'USER_ID']) }}".replace('USER_ID',
                    userId));

                // Add hidden field for PUT method override
                var methodInput = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', '_method')
                    .val('PUT');
                form.append(methodInput);

                // Add CSRF token if your application requires it
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                if (csrfToken) {
                    var csrfInput = $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', '_token')
                        .val(csrfToken);
                    form.append(csrfInput);
                }

                // Handle all form elements
                $('.tab-pane').each(function() {
                    $(this).find('input, select, textarea').each(function() {
                        var input = $(this);
                        var value = '';

                        // Handle checkbox inputs separately
                        if (input.attr('type') === 'checkbox') {
                            // Check if the checkbox is checked
                            if (input.is(':checked')) {
                                // Append a hidden input field with the checkbox's name and value
                                form.append('<input type="hidden" name="' + input.attr(
                                    'name') + '" value="1">');
                            }
                        } else if (input.attr('type') === 'file') {
                            // Handle file inputs
                            var file = input[0].files[0];
                            if (file) {
                                // Append the file input element to the form
                                form.append(input);
                            }
                        } else {
                            // For other elements, get the value directly
                            value = input.val();
                            // Append a hidden input field with the element's name and value
                            form.append('<input type="hidden" name="' + input.attr('name') +
                                '" value="' + value + '">');
                        }
                    });
                });

                // Append the form to the body and submit it
                $(document.body).append(form);
                form.submit();
            });

        });
    </script>
@endsection
