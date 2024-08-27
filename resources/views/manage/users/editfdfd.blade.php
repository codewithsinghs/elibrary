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
    /* .existing-value {
        color: #FF6A59;
    } */

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
                            <h4 class="card-title">Edit User - {{ $user->name }}</h4>
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
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel">

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
                                        <!-- Step 1 content -->
                                        <h4 class="card-title mb-3">Primary Details</h4>
                                        <div class="row">
                                            <!--First Name -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="fname" class="form-control"
                                                        placeholder="Full Name"
                                                        value="{{ old('fname', $user->profile->fname) }}" required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('fname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Last Name -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="lname" class="form-control"
                                                        placeholder="Full Name"
                                                        value="{{ old('lname', $user->profile->lname) }}" required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('lname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Email -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Email Address <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                        <input type="email" class="form-control" name="email"
                                                            id="inputGroupPrepend2" aria-describedby="inputGroupPrepend2"
                                                            placeholder="example@example.com"
                                                            value="{{ old('email', $user->email) }}" required>
                                                    </div>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Date Of Birth -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Date of Birth <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="dob"
                                                        placeholder="YYYY-MM-DD"
                                                        value="{{ old('dob', $user->profile->dob) }}" required>
                                                    @error('dob')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!--  Password* -->
                                            <div class="col-lg-6 mb-2" id="password_fields" style="display: none;">
                                                <div class="mb-3">
                                                    <label class=" text-label form-label">Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <!-- <span class="input-group-text"> <i class="fa fa-lock"></i> </span>  -->
                                                        <input type="password" name="password"
                                                            class="form-control validated-input password-input"
                                                            id="passwordInput" data-validation-type="password"
                                                            data-error-field="password_error" placeholder="********"
                                                            value="{{ old('password') }}" required>
                                                        <span class="input-group-text show-pass" id="togglePasswordView">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                    <div class="error-message text-danger" id="password_error"></div>

                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Confirm Password* -->
                                            <div class="col-lg-6 mb-2" id="password_confirmation_fields"
                                                style="display: none;">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Confirm Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <!-- <span class="input-group-text"> <i class="fa fa-lock"></i> </span>  -->
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control validated-input confirm-password-input"
                                                            id="cnfPasswordInput" placeholder="*********"
                                                            data-error-field="confirm_password_error"
                                                            value="{{ old('password_confirmation') }}" required>
                                                        <span class="input-group-text show-pass" id="togglePasswordView2">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                    <div class="error-message text-danger" id="confirm_password_error">
                                                    </div>
                                                    @error('password_confirmation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Gender -->
                                            <div class="col-lg-4 mb-2">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    @php
                                                        $profileGender = optional($user->profile)->gender;
                                                    @endphp
                                                    @foreach (['male', 'female', 'other'] as $value)
                                                        <option value="{{ $value }}"
                                                            class="{{ $profileGender === $value ? 'text-primary' : '' }}"
                                                            {{ old('gender') == $value || $profileGender === $value ? 'selected' : '' }}>
                                                            {{ ucfirst($value) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Member Type -->
                                            <div class="col-lg-4 mb-2">
                                                <label for="member_type">Member Type <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="member_type" name="member_type">
                                                    <option value="" selected disabled>Member Type</option>
                                                    @php
                                                        $profileMemberType = optional($user->profile)->member_type;
                                                    @endphp
                                                    @foreach (['student', 'faculty', 'research scholar', 'staff', 'administrator', 'librarian', 'manager', 'guest'] as $value)
                                                        <option value="{{ $value }}"
                                                            class="{{ $profileMemberType === $value ? 'text-primary' : '' }}"
                                                            {{ old('member_type') == $value || $profileMemberType === $value ? 'selected' : '' }}>
                                                            {{ ucfirst($value) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('member_type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Assign Role -->
                                            {{-- <div class="col-lg-6 mb-2">
                                                <label for="assign_role">Assign Role</label>
                                                <select class="form-control " id="assign_role" name="assign_role">
                                                    <option value="" selected disabled>Select Role Position</option>
                                                    <option value="student"
                                                        {{ old('assign_role') == 'student' ? 'selected' : '' }}>Student
                                                    </option>
                                                    <option value="member"
                                                        {{ old('assign_role') == 'member' ? 'selected' : '' }}>Member
                                                    </option>
                                                    <option value="research scholar"
                                                        {{ old('assign_role') == 'research scholar' ? 'selected' : '' }}>
                                                        Research Scholar</option>
                                                    <option value="staff"
                                                        {{ old('assign_role') == 'staff' ? 'selected' : '' }}>Staff
                                                    </option>

                                                    <option value="librarian"
                                                        {{ old('assign_role') == 'librarian' ? 'selected' : '' }}>
                                                        Librarian</option>
                                                    <option value="Manager"
                                                        {{ old('assign_role') == 'Manager' ? 'selected' : '' }}>Manager
                                                    </option>
                                                </select>
                                                @error('role_position')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            {{-- <div class="col-lg-4 mb-2">
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
                                            </div> --}}
                                            <div class="col-lg-4 mb-2">
                                                <label for="assign_role">Assign Role</label>
                                                <select class="form-control border-success" id="assign_role"
                                                    name="assign_role">
                                                    <option value="" selected disabled>Select Role Position</option>
                                                    @foreach ($roles as $role)
                                                        @php
                                                            $existingRole = optional($user->roles->first())->name;
                                                            $isSelected =
                                                                old('assign_role', $existingRole) === $role->name;
                                                            $isExistingValue = $existingRole === $role->name;
                                                        @endphp
                                                        <option value="{{ $role->name }}"
                                                            class="{{ $isExistingValue ? 'text-primary' : '' }}"
                                                            {{ $isSelected ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('assign_role')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                        </div>

                                    </div>
                                    <div id="wizard_Time" class="tab-pane" role="tabpanel">
                                        <!-- Step 2 content -->
                                        <h4 class="card-title mb-3">Official Information</h4>
                                        <div class="row">
                                            <!-- Category -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Category <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="category" class="form-control"
                                                        placeholder="......" value="{{ old('category') }}">
                                                    @error('category')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Institute -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Institute <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="institute" class="form-control"
                                                        placeholder="......" value="{{ old('institute') }}">
                                                    @error('institute')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Faculty -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Faculty <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="faculty" class="form-control"
                                                        placeholder="......" value="{{ old('faculty') }}">
                                                    @error('faculty')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Department -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Department <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="department" class="form-control"
                                                        placeholder="....." value="{{ old('department') }}">
                                                    @error('department')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!--  Student Scholar -->

                                            <!-- Course -->
                                            <div class="col-lg-4 mb-2 studentgrouop" id="course_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Course <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="course" class="form-control"
                                                        placeholder="....." value="{{ old('course') }}">
                                                    @error('course')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Year of Admission -->
                                            <div class="col-lg-4 mb-2 studentgrouop" id="year_of_admission_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Year of Admission <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="year_of_admission" class="form-control"
                                                        placeholder="....." value="{{ old('year_of_admission') }}">
                                                    @error('year_of_admission')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Enrollment No -->
                                            <div class="col-lg-4 mb-2 studentgrouop" id="enrollmentNo_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Enrollment No <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="enrollment_no" class="form-control"
                                                        placeholder="....." value="{{ old('enrollment_no') }}">
                                                    @error('enrollment_no')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!--  Empployee Staff -->

                                            <!-- Designation -->
                                            <div class="col-lg-4 mb-2 employeegroup" id="designation_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Designation <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="designation" class="form-control"
                                                        placeholder="....." value="{{ old('designation') }}">
                                                    @error('designation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Year of Joining -->
                                            <div class="col-lg-4 mb-2 employeegroup" id="year_of_joining_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Year of Joining <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="year_of_joining" class="form-control"
                                                        placeholder="....." value="{{ old('year_of_joining') }}">
                                                    @error('year_of_joining')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Employee Id -->
                                            <div class="col-lg-4 mb-2 employeegroup" id="employeeId_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Employee Id <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="employee_id" class="form-control"
                                                        placeholder="....." value="{{ old('employee_id') }}">
                                                    @error('employee_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Favorite Resource</label>
                                                    <input type="text" name="favorite_resources" class="form-control"
                                                        placeholder="....." value="{{ old('favorite_resources') }}">
                                                    @error('favorite_resources')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <!-- Library Privileges -->
                                            {{-- <div class="col-lg-6 mb-2">
                                                <label for="library_privileges">Library Privileges</label>
                                                <select class="form-control " id="library_privileges"
                                                    name="library_privileges">
                                                    <option value="" selected disabled>Select Role Position</option>
                                                    <option value="student"
                                                        {{ old('library_privileges') == 'student' ? 'selected' : '' }}>
                                                        Student</option>
                                                    <option value="regular_member"
                                                        {{ old('library_privileges') == 'regular_member' ? 'selected' : '' }}>
                                                        Regular Member</option>
                                                    <option value="faculty"
                                                        {{ old('library_privileges') == 'faculty' ? 'selected' : '' }}>
                                                        Faculty</option>
                                                    <option value="guest"
                                                        {{ old('library_privileges') == 'guest' ? 'selected' : '' }}>Guest
                                                        Member</option>
                                                    <option
                                                        value="librarian"{{ old('library_privileges') == 'librarian' ? 'selected' : '' }}>
                                                        Librarian</option>
                                                    <option
                                                        value="administrator"{{ old('library_privileges') == 'administrator' ? 'selected' : '' }}>
                                                        Manager</option>
                                                </select>
                                                @error('library_privileges')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            {{-- <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Library Privileges</label>
                                                    <input type="text" name="library_privileges" class="form-control"
                                                        placeholder="student, Regular Member"
                                                        value="{{ old('library_privileges') }}">
                                                    @error('library_privileges')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Preferred Genres</label>
                                                    <input type="text" name="preferred_genres" class="form-control"
                                                        placeholder="......" value="{{ old('preferred_genres') }}">
                                                    @error('preferred_genres')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Research Interests</label>
                                                    <input type="text" name="research_interests" class="form-control"
                                                        placeholder="__________" value="{{ old('research_interests') }}">
                                                    @error('research_interests')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Access Levels</label>
                                                    <input type="text" name="access_levels" class="form-control"
                                                        value="{{ old('access_levels') }}">
                                                    @error('access_levels')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}

                                        </div>

                                    </div>
                                    <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                        <!-- Step 3 content -->
                                        <h4 class="card-title mb-3">Personal Information</h4>

                                        <div class="row">

                                            <!-- Phone Number Fields -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Phone Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="phone"
                                                        class="form-control validated-input phone-input"
                                                        data-validation-type="phone" data-error-field="phone_error"
                                                        placeholder="(+91) 9999999999" value="{{ old('phone') }}">
                                                    <div class="error-message text-danger" id="phone_error"></div>
                                                    @error('phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Alternative Email -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Alternative Email</label>
                                                    <input type="text" name="alternate_email" class="form-control"
                                                        placeholder="alias@domain.ext"
                                                        value="{{ old('alternate_email') }}">
                                                    @error('alternate_email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Present Address -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Present Address <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="present_address" id="present_address"
                                                        class="form-control" placeholder="........"
                                                        value="{{ old('present_address') }}">
                                                    @error('present_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Present City -->
                                            <div class="col-lg-3 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Present City <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="present_city" id="present_city"
                                                        class="form-control" placeholder="........"
                                                        value="{{ old('present_city') }}">
                                                    @error('present_city')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Present Pincode -->
                                            <div class="col-lg-3 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Present Pincode <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="present_pincode" id="present_pin"
                                                        class="form-control pincode-input"
                                                        placeholder="Enter Present Pincode" data-validation-type="pincode"
                                                        data-error-field="pincode_error"
                                                        value="{{ old('present_pincode') }}">
                                                    <div class="error-message text-danger" id="pincode_error"></div>
                                                </div>
                                            </div>

                                            <!-- Checkbox for Same as Present Address -->
                                            <div class="col-lg-12">
                                                <input type ="checkbox" id="same_as_present">
                                                <label for="same_as_present"><strong>Same as Present
                                                        Address</strong></label>
                                            </div>

                                            <!-- permanent Address -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Permanent Address</label>
                                                    <input type="text" name="permanent_address" id="permanent_address"
                                                        class="form-control" placeholder="........"
                                                        value="{{ old('permanent_address') }}">
                                                    @error('permanent_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Permanent City -->
                                            <div class="col-lg-3 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Permanent City</label>
                                                    <input type="text" name="permanent_city" id="permanent_city"
                                                        class="form-control" placeholder="........"
                                                        value="{{ old('permanent_city') }}">
                                                    @error('permanent_city')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Permanent Pincode -->
                                            <div class="col-lg-3 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Permanent Pincode</label>
                                                    <input type="text" name="permanent_pincode" id="permanent_pin"
                                                        class="form-control" placeholder="........"
                                                        value="{{ old('permanent_pincode') }}">
                                                    <div id="permanent_pincode_error" class="text-danger"></div>
                                                    @error('permanent_pincode')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Permanent Phone -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Permanent Address Contact
                                                        Number</label>
                                                    <input type="text" name="permanent_phone"
                                                        data-validation-type="phone" data-error-field="phone_error2"
                                                        class="form-control  validated-input phone-input"
                                                        placeholder="(+91) 9999999999"
                                                        value="{{ old('permanent_phone') }}">

                                                    <div class="error-message text-danger" id="phone_error2"></div>
                                                    @error('permanent_phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <!-- Communication Preferences -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Communication Preferences</label>
                                                    <input type="text" name="communication_preferences"
                                                        class="form-control" placeholder="......."
                                                        value="{{ old('communication_preferences') }}">
                                                    @error('communication_preferences')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                             <!-- Residencial Address -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Residencial Address</label>
                                                    <input type="text" name="residential_address" class="form-control"
                                                        value="{{ old('residential_address') }}">
                                                    @error('residential_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Social Integration -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Social Integration</label>
                                                    <input type="text" name="social_integration" class="form-control"
                                                        placeholder="__________" value="{{ old('social_integration') }}">
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-6 mb-2">

                                                <label for="image" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" id="image"
                                                    name="image">
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
                                            <!-- First Name -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Gauranter First Name*</label>
                                                    <input type="text" name="gr_fname" class="form-control"
                                                        placeholder="Gauranter First Name" value="{{ old('gr_fname') }}"
                                                        required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('gr_fname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Last  Name -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Gauranter Last Name*</label>
                                                    <input type="text" name="gr_lname" class="form-control"
                                                        placeholder="Gauranter Last Name" value="{{ old('gr_lname') }}"
                                                        required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('gr_lname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Form Number -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Form Number</label>
                                                    <input type="text" name="form_number" class="form-control"
                                                        placeholder="Form Number" value="{{ old('form_number') }}"
                                                        required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('form_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Library Member -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Library Member</label>
                                                    <input type="text" name="library_member" class="form-control"
                                                        placeholder="Library Member" value="{{ old('library_member') }}"
                                                        required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('library_member')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Address -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Present Address</label>
                                                    <input type="text" name="gr_address" class="form-control"
                                                        placeholder="Present Address" value="{{ old('gr_address') }}"
                                                        required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('gr_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- GR City -->
                                            <div class="col-lg-3 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Guarantor City</label>
                                                    <input type="text" name="gr_city" class="form-control"
                                                        placeholder="Guarantor City" value="{{ old('gr_city') }}"
                                                        required>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('gr_city')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- GR Pincode -->
                                            <div class="col-lg-3 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Guarantor pincode</label>
                                                    <input type="text" name="gr_pincode"
                                                        class="form-control pincode-input" data-validation-type="pincode"
                                                        data-error-field="pincode_error3"
                                                        placeholder="Enter Guarantor Pincode"
                                                        value="{{ old('gr_pincode') }}" required>
                                                    <div class="error-message text-danger" id="pincode_error3"></div>

                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('gr_pincode')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- GR phone -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Guarantor phone</label>
                                                    <input type="text" name="gr_phone"
                                                        class="form-control validated-input phone-input"
                                                        data-validation-type="phone" data-error-field="phone_error3"
                                                        placeholder="Guarantor Phone No." value="{{ old('gr_phone') }}">
                                                    <div class="error-message text-danger" id="phone_error3"></div>
                                                    @error('gr_phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- GR email -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Guarantor email</label>
                                                    <input type="text" name="gr_email"
                                                        class="form-control validated-input email-input"
                                                        data-validation-type="phone" data-error-field="email_error3"
                                                        placeholder="Guarantor email" value="{{ old('gr_email') }}">
                                                    <div class="error-message text-danger" id="email_error3"></div>
                                                    <!-- <div id="nameError" class="error"></div> -->
                                                    @error('gr_email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
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
        // $(document).ready(function() {
        //     // Initialize SmartWizard
        //     $('#smartwizard').smartWizard({
        //         // Set options including disabling URL updating
        //         enableURLhash: false
        //     });

        //     // Manually advance to the next step on button click
        //     // $('#btn-next-step-1').click(function() {
        //     //     $('#smartwizard').smartWizard('next');
        //     // });

        //     // $('#btn-next-step-2').click(function() {
        //     //     $('#smartwizard').smartWizard('next');
        //     // });

        //     // $('#btn-next-step-3').click(function() {
        //     //     $('#smartwizard').smartWizard('next');
        //     // });


        //     // $('#submit-button').on('click', function() {
        //     //     // Ensure all wizard steps are visible and active
        //     //     $('.nav-wizard li').removeClass('disabled');
        //     //     $('.tab-pane').removeClass('active');
        //     //     $('.tab-pane').addClass('active show');

        //     //     // Create a form element dynamically
        //     //     var form = $('<form></form>');
        //     //     form.attr('method', 'POST');
        //     //     form.attr('action', "{{ route('users.store') }}");

        //     //     // Add CSRF token if your application requires it
        //     //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     //     if (csrfToken) {
        //     //         var csrfInput = $('<input>')
        //     //             .attr('type', 'hidden')
        //     //             .attr('name', '_token')
        //     //             .val(csrfToken);
        //     //         form.append(csrfInput);
        //     //     }

        //     //     // Collect data from each step and append them to the form
        //     //     $('.tab-pane.active').find('input[type="text"], input[type="email"]').each(function() {
        //     //         var input = $(this);
        //     //         form.append('<input type="hidden" name="' + input.attr('name') + '" value="' +
        //     //             input.val() + '">');
        //     //     });

        //     //     // Append the form to the body and submit it
        //     //     $(document.body).append(form);
        //     //     form.submit();
        //     // });

        //     // Well Working
        //     // $('#submit-button').on('click', function() {
        //     //     // Create a form element dynamically
        //     //     var form = $('<form></form>');
        //     //     form.attr('method', 'POST');
        //     //     form.attr('enctype', 'multipart/form-data'); // Set enctype for file uploads
        //     //     form.attr('action', "{{ route('users.store') }}");

        //     //     // Add CSRF token if your application requires it
        //     //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     //     if (csrfToken) {
        //     //         var csrfInput = $('<input>')
        //     //             .attr('type', 'hidden')
        //     //             .attr('name', '_token')
        //     //             .val(csrfToken);
        //     //         form.append(csrfInput);
        //     //     }


        //     //     // Handle image file upload
        //     //     var imageInput = $('#image')[0].files[
        //     //         0]; // Assuming your image input field has the id "image"
        //     //     if (imageInput) {
        //     //         // Validate file type
        //     //         var validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        //     //         if (validImageTypes.includes(imageInput.type)) {
        //     //             form.append('image', imageInput);
        //     //         } else {
        //     //             alert('Please upload a valid image file (JPEG, PNG, JPG, GIF).');
        //     //             return; // Stop form submission if the image type is invalid
        //     //         }
        //     //     }

        //     //     // Collect data from all steps and append them to the form
        //     //     // $('.tab-pane').each(function() {
        //     //     //     $(this).find(
        //     //     //         'input[type="text"], input[type="email"], input[type="number"], input[type="password"], input[type="file"]'
        //     //     //     ).each(function() {
        //     //     //         var input = $(this);
        //     //     //         form.append('<input type="hidden" name="' + input.attr('name') +
        //     //     //             '" value="' +
        //     //     //             input.val() + '">');
        //     //     //     });
        //     //     // });

        //     //     //Working
        //     //     // $('.tab-pane').each(function() {
        //     //     //     $(this).find('input, select, textarea').each(function() {
        //     //     //         var input = $(this);
        //     //     //         var value = '';
        //     //     //         // Check if it's a select element
        //     //     //         if (input.is('select')) {
        //     //     //             // Get the selected option value
        //     //     //             value = input.val();
        //     //     //         } else {
        //     //     //             // For other elements, get the value directly
        //     //     //             value = input.val();
        //     //     //         }
        //     //     //         // Append a hidden input field with the element's name and value
        //     //     //         form.append('<input type="hidden" name="' + input.attr('name') +
        //     //     //             '" value="' + value + '">');
        //     //     //     });
        //     //     // });

        //     //     $('.tab-pane').each(function() {
        //     //         $(this).find('input, select, textarea').each(function() {
        //     //             var input = $(this);
        //     //             var value = '';

        //     //             // Check if it's a file input
        //     //             if (input.attr('type') === 'file') {
        //     //                 // Get the selected file
        //     //                 var file = input[0].files[0];
        //     //                 if (file) {
        //     //                     // Append the file to the form data
        //     //                     form.append(input.attr('name'), file);
        //     //                     // Append the file input to the form data
        //     //                     form.append('image', file);
        //     //                 }
        //     //             } else {
        //     //                 // For other elements, get the value directly
        //     //                 value = input.val();
        //     //                 // Append a hidden input field with the element's name and value
        //     //                 form.append('<input type="hidden" name="' + input.attr('name') +
        //     //                     '" value="' + value + '">');
        //     //             }
        //     //         });
        //     //     });

        //     //     // Append the form to the body and submit it
        //     //     $(document.body).append(form);

        //     //     form.submit();
        //     // });


        //     $('#submit-button').on('click', function() {
        //         // Create a form element dynamically
        //         var form = $('<form></form>');
        //         form.attr('method', 'POST');
        //         form.attr('enctype', 'multipart/form-data'); // Set enctype for file uploads
        //         form.attr('action', "{{ route('users.store') }}");

        //         // Add CSRF token if your application requires it
        //         var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //         if (csrfToken) {
        //             var csrfInput = $('<input>')
        //                 .attr('type', 'hidden')
        //                 .attr('name', '_token')
        //                 .val(csrfToken);
        //             form.append(csrfInput);
        //         }

        //         // Handle all form elements
        //         $('.tab-pane').each(function() {
        //             $(this).find('input, select, textarea').each(function() {
        //                 var input = $(this);
        //                 var value = '';

        //                 // Check if it's a file input
        //                 if (input.attr('type') === 'file') {
        //                     // Get the selected file
        //                     //var file = input[0].files[0];
        //                     var file = $('#image')[0].files[0];
        //                     if (file) {
        //                         // Append the file to the form data
        //                         form.append(input.attr('name'), file);
        //                     }
        //                 } else {
        //                     // For other elements, get the value directly
        //                     value = input.val();
        //                     // Append a hidden input field with the element's name and value
        //                     form.append('<input type="hidden" name="' + input.attr('name') +
        //                         '" value="' + value + '">');
        //                 }
        //             });
        //         });

        //         // Append the form to the body and submit it
        //         $(document.body).append(form);
        //         form.submit();
        //     });

        // });

        $(document).ready(function() {
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
                form.attr('action', "{{ route('users.store') }}");

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

                        // Check if it's a file input
                        if (input.attr('type') === 'file') {
                            // Get the selected file
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

            // var designationGroup = $('#designation_group');
            // var yearOfJoiningGroup = $('#year_of_joining_group');
            // var employeeIdGroup = $('#employeeId_group');

            // var courseGroup = $('#course_group');
            // var yearOfAdmissionGroup = $('#year_of_admission_group');
            // var enrollmentGroup = $('#enrollmentNo_group');

            var studentGroup = $('.studentgrouop');
            var employeeGroup = $('.employeegroup');

            // Initially hide specific groups

            // designationGroup.hide();
            // yearOfJoiningGroup.hide();
            // employeeIdGroup.hide();

            // courseGroup.hide();
            // yearOfAdmissionGroup.hide();
            // enrollmentGroup.hide();
            studentGroup.hide();
            employeeGroup.hide();

            // Show/hide fields based on selected member type
            $('#member_type').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'student' || selectedValue === 'research scholar') {

                    // designationGroup.hide();
                    // yearOfJoiningGroup.hide();
                    employeeGroup.hide();
                    studentGroup.show();
                    // yearOfAdmissionGroup.show();
                    // courseGroup.show();
                    // enrollmentGroup.show();

                } else if (selectedValue === 'faculty' || selectedValue === 'staff' || selectedValue ===
                    'administrator' || selectedValue === 'manager' || selectedValue === 'librarian') {

                    // designationGroup.show();
                    // yearOfJoiningGroup.show();
                    employeeGroup.show();
                    studentGroup.hide();
                    // courseGroup.hide();
                    // yearOfAdmissionGroup.hide();
                    // enrollmentGroup.hide();
                } else {

                    // designationGroup.hide();
                    // yearOfJoiningGroup.hide();
                    // employeeIdGroup.hide();

                    // courseGroup.hide();
                    // yearOfAdmissionGroup.hide();
                    // enrollmentGroup.hide();
                    studentGroup.hide();
                    employeeGroup.hide();
                }
            });

            // Copy present address to permanent address when checkbox is checked
            $('#same_as_present').change(function() {
                if (this.checked) {
                    $('#permanent_address').val($('#present_address').val());
                    $('#permanent_city').val($('#present_city').val());
                    $('#permanent_pin').val($('#present_pin').val());

                } else {
                    // Clear the permanent address fields if checkbox is unchecked
                    $('#permanent_address').val('');
                    $('#permanent_city').val('');
                    $('#permanent_pin').val('');

                }
            });
        });
    </script>

    <!-- JavaScript code in the Blade template -->
    {{-- <script>
        // Function to validate input field
        function validateInput(inputField, errorField, regex, errorMessage) {
            var inputValue = inputField.value;
            var errorElement = document.getElementById(errorField);

            if (!regex.test(inputValue)) {
                errorElement.textContent = errorMessage;
                return false;
            } else {
                errorElement.textContent = "";
                return true;
            }
        }

        // Function to set up validation for input fields
        function setUpValidation(inputClassName) {
            var inputs = document.querySelectorAll('.' + inputClassName);

            inputs.forEach(function(input) {
                input.addEventListener('input', function(event) {
                    var dataType = input.dataset.validationType;
                    var errorField = input.dataset.errorField;
                    var regex, errorMessage;

                    switch (dataType) {
                        case 'phone':
                            regex = /^(\+?\d{1,3}\s?)?(\d{10})$/;
                            errorMessage =
                                'Phone number must be 10 digits long and may start with "+91", or without any prefix.';
                            break;

                        case 'password':
                            regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
                            errorMessage =
                                'Password must be at least 8 characters long and contain at least one digit, one lowercase letter, one uppercase letter, and one special character.';
                            break;
                        case 'pincode':
                            regex = /^\d{6}$/;
                            errorMessage = 'Pincode must be 6 digits long.';
                            break;
                            // Add more cases for additional data types as needed
                    }

                    validateInput(input, errorField, regex, errorMessage);
                });
            });
        }

        // Set up validation for all input fields on DOM content load
        document.addEventListener('DOMContentLoaded', function() {
            setUpValidation('phone-input');
            setUpValidation('password-input');
            setUpValidation('pincode-input');
        });
    </script> --}}

    <script>
        // Function to validate phone number
        function validatePhoneNumber(phoneNumber) {
            const regex = /^(\+?\d{1,3}\s?)?(\d{10})$/;
            if (!regex.test(phoneNumber)) {
                if (phoneNumber === '') {
                    return 'Phone number is required.';
                }
                if (!/^\d+$/.test(phoneNumber)) {
                    return 'Phone number should contain digits only.';
                }
                if (phoneNumber.length < 10) {
                    return 'Phone number should be at least 10 digits long.';
                }
                return 'Please enter a valid phone number.';
            }
            return '';
        }

        // Function to validate password
        function validatePassword(password) {
            const rules = [{
                    regex: /(?=.*\d)/,
                    message: 'Password must contain at least one digit.'
                },
                {
                    regex: /(?=.*[a-z])/,
                    message: 'Password must contain at least one lowercase letter.'
                },
                {
                    regex: /(?=.*[A-Z])/,
                    message: 'Password must contain at least one uppercase letter.'
                },
                {
                    regex: /(?=.*[!@#$%^&*])/,
                    message: 'Password must contain at least one special character.'
                },
                {
                    regex: /^.{8,}$/,
                    message: 'Password must be at least 8 characters long.'
                }
            ];

            for (const rule of rules) {
                if (!rule.regex.test(password)) {
                    return rule.message;
                }
            }

            return '';
        }

        // Function to validate password confirmation
        function validatePasswordConfirmation(password, confirmPassword) {
            if (password !== confirmPassword) {
                return 'Passwords do not match.';
            }
            return '';
        }

        // Function to validate pin code
        function validatePinCode(pinCode) {
            const regex = /^\d{6}$/;
            if (!regex.test(pinCode)) {
                if (pinCode === '') {
                    return 'Pincode is required.';
                }
                if (!/^\d+$/.test(pinCode)) {
                    return 'Pincode should contain digits only.';
                }
                if (pinCode.length !== 6) {
                    return 'Pincode must be exactly 6 digits long.';
                }
                return 'Please enter a valid pincode.';
            }
            return '';
        }

        // Function to validate email
        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regex.test(email)) {
                return 'Please enter a valid email address.';
            }
            return '';
        }

        // Function to display error message
        function displayErrorMessage(errorField, errorMessage) {
            const errorElement = document.getElementById(errorField);
            errorElement.textContent = errorMessage;
        }

        // Function to set up validation for input fields
        function setUpValidation(inputClassName, validationFunction) {
            const inputs = document.querySelectorAll('.' + inputClassName);

            inputs.forEach(function(input) {
                input.addEventListener('input', function(event) {
                    const inputValue = input.value.trim();
                    const errorField = input.dataset.errorField;
                    const errorMessage = validationFunction(inputValue);
                    displayErrorMessage(errorField, errorMessage);
                });
            });
        }

        // Set up validation for all input fields on DOM content load
        document.addEventListener('DOMContentLoaded', function() {
            setUpValidation('phone-input', validatePhoneNumber);
            setUpValidation('password-input', validatePassword);

            setUpValidation('pincode-input', validatePinCode);
            setUpValidation('email-input', validateEmail);


            const passwordInput = document.querySelector('.password-input');
            const confirmInput = document.querySelector('.confirm-password-input');

            confirmInput.addEventListener('input', function() {
                const password = passwordInput.value.trim();
                const confirmPassword = confirmInput.value.trim();
                const errorMessage = validatePasswordConfirmation(password, confirmPassword);
                displayErrorMessage(confirmInput.dataset.errorField, errorMessage);
            });
        });
    </script>

    <script>
        const passwordInput = document.querySelector('.password-input');
        const cnfPasswordInput = document.querySelector('.confirm-password-input');
        const togglePasswordView = document.getElementById('togglePasswordView');
        const togglePasswordView2 = document.getElementById('togglePasswordView2');

        togglePasswordView.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        togglePasswordView2.addEventListener('click', function() {
            const type = cnfPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            cnfPasswordInput.setAttribute('type', type);
        });
    </script>


@endsection
