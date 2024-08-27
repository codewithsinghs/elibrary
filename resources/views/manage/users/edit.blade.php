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
                            <h4 class="card-title">User Registration</h4>
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
                                            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                                        </div>
                                        <!-- Step 1 content -->
                                        <h4 class="card-title mb-3">Primary Details</h4>
                                        <div class="row">

                                            <!--First Name -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="fname" class="text-label form-label">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="fname" id="fname" class="form-control"
                                                        placeholder="Full Name"
                                                        value="{{ old('fname', $user->profile->fname ?? '') }}" required>
                                                    @error('fname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Last Name -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="lname" class="text-label form-label">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="lname" id="lname" class="form-control"
                                                        placeholder="Full Name"
                                                        value="{{ old('lname', $user->profile->lname ?? '') }}" required>
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
                                                            value="{{ old('email', $user->email ?? '') }}"
                                                            autocomplete="email" readonly required>
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
                                                        value="{{ old('dob', $user->profile->dob ?? '') }}" required>
                                                    @error('dob')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-4 mb-2">
                                                <div class="mb-3">
                                                    <input type="checkbox" id="change_password" name="change_password">
                                                    <label class="text-label form-label" for="change_password">Change
                                                        Password</label>
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
                                            <div class="col-lg-4 mb-2">
                                                <label for="assign_role">Assign Role</label>
                                                <select class="form-control border-success" id="assign_role"
                                                    name="assign_role">
                                                    <option value="" selected disabled>Assigne Role </option>
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
                                                    <label for="category">Category / Level <span
                                                            class="text-danger">*</span></label>
                                                    <select id="category" class="form-control" name="category">
                                                        <option value="" selected disabled>Select Category</option>
                                                        @foreach ($academics->unique('category') as $academic)
                                                            <option value="{{ $academic->category }}"
                                                                {{ old('category', $user->profile->category ?? '') == $academic->category ? 'selected' : '' }}>
                                                                {{ ucfirst($academic->category) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                {{-- <div class="mb-3">
                                                    <label class="text-label form-label">Category <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="category" class="form-control"
                                                        placeholder="......" value="{{ old('category') }}">
                                                    @error('category')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div> --}}
                                            </div>
                                            <!-- Institute -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="institute">Institute <span
                                                            class="text-danger">*</span></label>
                                                    <select id="institute" class="form-control" name="institute"
                                                        disabled>
                                                        <option value="" selected disabled>Select institute</option>
                                                        <!-- Options for institute dropdown will be populated dynamically using JavaScript -->
                                                    </select>
                                                    <div id="instituteError" class="text-danger"></div>
                                                    @error('institute')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror


                                                    {{-- <label class="text-label form-label">Institute <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="institute" class="form-control"
                                                        placeholder="......" value="{{ old('institute') }}">
                                                    @error('institute')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror --}}
                                                </div>
                                            </div>
                                            <!-- Faculty -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="faculty">Faculty <span
                                                            class="text-danger">*</span></label>
                                                    <select id="faculty" class="form-control" name="faculty" disabled>
                                                        <option value="" selected disabled>Select Faculty</option>
                                                        <!-- Options for faculty dropdown will be populated dynamically using JavaScript -->
                                                    </select>
                                                    @error('faculty')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Department -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="department">Department <span
                                                            class="text-danger">*</span></label>
                                                    <select id="department" class="form-control" name="department"
                                                        disabled>
                                                        <option value="" selected disabled>Select Department</option>
                                                        <!-- Options for department dropdown will be populated dynamically using JavaScript -->
                                                    </select>
                                                    @error('department')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!--  Student Scholar -->
                                            <!-- Course -->
                                            <div class="col-lg-4 mb-2 studentgroup" id="course_group">
                                                <div class="mb-3">
                                                    <label for="course">Course <span
                                                            class="text-danger">*</span></label>
                                                    <select id="course" class="form-control" name="course" disabled>
                                                        <option value="" selected disabled>Select Course</option>
                                                        <!-- Options for course dropdown will be populated dynamically using JavaScript -->
                                                    </select>
                                                    @error('course')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Year of Admission -->
                                            <div class="col-lg-4 mb-2 studentgroup" id="year_of_admission_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Year of Admission <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="year_of_admission" class="form-control"
                                                        placeholder="....."
                                                        value="{{ old('year_of_admission', $user->profile->year_of_admission ?? '') }}">
                                                    @error('year_of_admission')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Enrollment No -->
                                            <div class="col-lg-4 mb-2 studentgroup" id="enrollmentNo_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Enrollment No <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="enrollment_no" class="form-control"
                                                        placeholder="....."
                                                        value="{{ old('enrollment_no', $user->profile->member_id ?? '') }}">
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
                                                        placeholder="....."
                                                        value="{{ old('designation', $user->profile->designation ?? '') }}">
                                                    @error('designation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Year of Joining -->
                                            <div class="col-lg-4 mb-2 employeegroup" id="year_of_joining_group">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Date Of Joining<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" name="joining_date" class="form-control"
                                                        placeholder="....."
                                                        value="{{ old('joining_date', $user->profile->joining_date ?? '') }}">
                                                    @error('joining_date')
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
                                                        placeholder="....."
                                                        value="{{ old('employee_id', $user->profile->member_id ?? '') }}">
                                                    @error('employee_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Preferred Genres -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Preferred Genres</label>
                                                    <input type="text" name="preferred_genres" class="form-control"
                                                        placeholder="......"
                                                        value="{{ old('preferred_genres', $user->profile->preferred_genres ?? '') }}">
                                                    @error('preferred_genres')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Research Interests -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Research Interests</label>
                                                    <input type="text" name="research_interests" class="form-control"
                                                        placeholder="__________"
                                                        value="{{ old('research_interests', $user->profile->research_interests ?? '') }}">
                                                    @error('research_interests')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                        <!-- Step 3 content -->
                                        <h4 class="card-title mb-3">Personal Information</h4>

                                        <div class="row">
                                            <!-- Phone Number Fields -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="phone" class="text-label form-label">Phone Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="phone" id="phone"
                                                        class="form-control validated-input phone-input"
                                                        data-validation-type="phone" data-error-field="phone_error"
                                                        placeholder="(+91) 9999999999"
                                                        value="{{ old('phone', $user->profile->phone ?? '') }}">
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
                                                        value="{{ old('alternate_email', $user->profile->alternate_email ?? '') }}">
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
                                                        value="{{ old('present_address', $user->profile->present_address ?? '') }}">
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
                                                        value="{{ old('present_city', $user->profile->present_city ?? '') }}">
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
                                                        value="{{ old('present_pincode', $user->profile->present_pincode ?? '') }}">
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
                                                        value="{{ old('permanent_address', $user->profile->permanent_address ?? '') }}">
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
                                                        value="{{ old('permanent_city', $user->profile->permanent_city ?? '') }}">
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
                                                        value="{{ old('permanent_pincode', $user->profile->permanent_pincode ?? '') }}">
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
                                                        value="{{ old('permanent_phone', $user->profile->permanent_phone ?? '') }}">

                                                    <div class="error-message text-danger" id="phone_error2"></div>
                                                    @error('permanent_phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-2">

                                                {{-- <label for="image" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" id="image"
                                                    name="image"> --}}

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
                                            <!-- First Name -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Gauranter First Name*</label>
                                                    <input type="text" name="gr_fname" class="form-control"
                                                        placeholder="Gauranter First Name"
                                                        value="{{ old('gr_fname', $user->guarantor->gr_fname ?? '') }}"
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
                                                        placeholder="Gauranter Last Name"
                                                        value="{{ old('gr_lname', $user->guarantor->gr_lname ?? '') }}"
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
                                                        placeholder="Form Number"
                                                        value="{{ old('form_number', $user->guarantor->form_number ?? '') }}"
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
                                                        placeholder="Library Member"
                                                        value="{{ old('library_member', $user->guarantor->library_member ?? '') }}"
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
                                                        placeholder="Present Address"
                                                        value="{{ old('gr_address', $user->guarantor->gr_address ?? '') }}"
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
                                                        placeholder="Guarantor City"
                                                        value="{{ old('gr_city', $user->guarantor->gr_city ?? '') }}"
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
                                                        value="{{ old('gr_pincode', $user->guarantor->gr_pincode ?? '') }}"
                                                        required>
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
                                                        placeholder="Guarantor Phone No."
                                                        value="{{ old('gr_phone', $user->guarantor->gr_phone ?? '') }}">
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
                                                        placeholder="Guarantor email"
                                                        value="{{ old('gr_email', $user->guarantor->gr_email ?? '') }}">
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
        $(document).ready(function() {
            // Initialize SmartWizard
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

            // Show studentgrouop /  employeegroup fields by default
            var studentGroup = $(".studentgroup"); // Corrected the class name
            var employeeGroup = $(".employeegroup");

            // Function to show/hide groups based on the selected member type
            function toggleGroups(selectedValue) {
                if (selectedValue === "student" || selectedValue === "research scholar") {
                    employeeGroup.hide();
                    studentGroup.show();
                } else if (
                    selectedValue === "faculty" ||
                    selectedValue === "staff" ||
                    selectedValue === "administrator" ||
                    selectedValue === "manager" ||
                    selectedValue === "librarian"
                ) {
                    employeeGroup.show();
                    studentGroup.hide();
                } else {
                    studentGroup.hide();
                    employeeGroup.hide();
                }
            }

            // Set the initial visibility based on the current selected value
            toggleGroups($("#member_type").val());

            // Show/hide fields based on selected member type
            $("#member_type").change(function() {
                toggleGroups($(this).val());
            });

            // Save initial permanent address values
            var initialPermanentAddress = $('#permanent_address').val();
            var initialPermanentCity = $('#permanent_city').val();
            var initialPermanentPin = $('#permanent_pin').val();

            // Check initial state of the checkbox
            if ($('#same_as_present').is(':checked')) {
                // Copy present address to permanent address
                $('#permanent_address').val($('#present_address').val());
                $('#permanent_city').val($('#present_city').val());
                $('#permanent_pin').val($('#present_pin').val());
            }

            // Update permanent address when checkbox is checked/unchecked
            $('#same_as_present').change(function() {
                if (this.checked) {
                    // Copy present address to permanent address
                    $('#permanent_address').val($('#present_address').val());
                    $('#permanent_city').val($('#present_city').val());
                    $('#permanent_pin').val($('#present_pin').val());
                } else {
                    // Restore initial permanent address values
                    $('#permanent_address').val(initialPermanentAddress);
                    $('#permanent_city').val(initialPermanentCity);
                    $('#permanent_pin').val(initialPermanentPin);
                }
            });
        });
    </script>

    <!-- JavaScript code in the Blade template -->


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

    <!-- Selct Academic Info From Drop Down -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryDropdown = document.getElementById('category');
            const instituteDropdown = document.getElementById('institute');
            const facultyDropdown = document.getElementById('faculty');
            const departmentDropdown = document.getElementById('department');
            const courseDropdown = document.getElementById('course');
            const academics = @json($academics->groupBy('category')->toArray());

            categoryDropdown.addEventListener('change', function() {
                const selectedCategory = this.value;
                const institutes = academics[selectedCategory].map(academic => academic.institute);

                // Clear previous options
                instituteDropdown.innerHTML =
                    '<option value="" selected disabled>Select Institute</option>';
                facultyDropdown.innerHTML = '<option value="" selected disabled>Select Faculty</option>';
                departmentDropdown.innerHTML =
                    '<option value="" selected disabled>Select Department</option>';
                courseDropdown.innerHTML = '<option value="" selected disabled>Select Course</option>';

                // Populate institute dropdown with unique values
                [...new Set(institutes)].forEach(institute => {
                    const option = document.createElement('option');
                    option.text = institute;
                    option.value = institute;
                    instituteDropdown.appendChild(option);
                });

                instituteDropdown.disabled = false;
            });

            instituteDropdown.addEventListener('change', function() {
                const selectedInstitute = this.value;
                const selectedCategory = categoryDropdown.value;
                const faculties = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute)
                    .map(academic => academic.faculty);

                // Clear previous options
                facultyDropdown.innerHTML = '<option value="" selected disabled>Select Faculty</option>';
                departmentDropdown.innerHTML =
                    '<option value="" selected disabled>Select Department</option>';
                courseDropdown.innerHTML = '<option value="" selected disabled>Select Course</option>';

                // Populate faculty dropdown with unique values
                [...new Set(faculties)].forEach(faculty => {
                    const option = document.createElement('option');
                    option.text = faculty;
                    option.value = faculty;
                    facultyDropdown.appendChild(option);
                });

                facultyDropdown.disabled = false;
            });

            facultyDropdown.addEventListener('change', function() {
                const selectedFaculty = this.value;
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                const departments = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute && academic.faculty ===
                        selectedFaculty)
                    .map(academic => academic.department);

                // Clear previous options
                departmentDropdown.innerHTML =
                    '<option value="" selected disabled>Select Department</option>';
                courseDropdown.innerHTML = '<option value="" selected disabled>Select Course</option>';

                // Populate department dropdown with unique values
                [...new Set(departments)].forEach(department => {
                    const option = document.createElement('option');
                    option.text = department;
                    option.value = department;
                    departmentDropdown.appendChild(option);
                });

                departmentDropdown.disabled = false;
            });

            departmentDropdown.addEventListener('change', function() {
                const selectedDepartment = this.value;
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                const selectedFaculty = facultyDropdown.value;
                const courses = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute && academic.faculty ===
                        selectedFaculty && academic.department === selectedDepartment)
                    .map(academic => academic.course);

                // Clear previous options
                courseDropdown.innerHTML = '<option value="" selected disabled>Select Course</option>';

                // Populate course dropdown with unique values
                [...new Set(courses)].forEach(course => {
                    const option = document.createElement('option');
                    option.text = course;
                    option.value = course;
                    courseDropdown.appendChild(option);
                });

                courseDropdown.disabled = false;
            });
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Previous script here...

            // Pre-select all options based on existing data
            const category = '{{ $user->profile->category ?? '' }}';
            const institute = '{{ $user->profile->institute ?? '' }}';
            const faculty = '{{ $user->profile->faculty ?? '' }}';
            const department = '{{ $user->profile->department ?? '' }}';
            const course = '{{ $user->profile->course ?? '' }}';

            if (category) {
                document.getElementById('category').value = category;
                categoryDropdown.dispatchEvent(new Event('change'));
            }

            if (institute) {
                document.getElementById('institute').value = institute;
                instituteDropdown.dispatchEvent(new Event('change'));
            }

            if (faculty) {
                document.getElementById('faculty').value = faculty;
                facultyDropdown.dispatchEvent(new Event('change'));
            }

            if (department) {
                document.getElementById('department').value = department;
                departmentDropdown.dispatchEvent(new Event('change'));
            }

            if (course) {
                document.getElementById('course').value = course;
            }
        });
    </script> --}}


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryDropdown = document.getElementById('category');
            const instituteDropdown = document.getElementById('institute');
            const facultyDropdown = document.getElementById('faculty');
            const departmentDropdown = document.getElementById('department');
            const courseDropdown = document.getElementById('course');
            const academics = @json($academics->groupBy('category')->toArray());
            const selectedCategory = '{{ $user->category ?? '' }}';
            const selectedInstitute = '{{ $user->institute ?? '' }}';
            const selectedFaculty = '{{ $user->faculty ?? '' }}';
            const selectedDepartment = '{{ $user->department ?? '' }}';
            const selectedCourse = '{{ $user->course ?? '' }}';

            // Populate category dropdown
            Object.keys(academics).forEach(category => {
                const option = document.createElement('option');
                option.text = category;
                option.value = category;
                if (category === selectedCategory) {
                    option.selected = true;
                }
                categoryDropdown.appendChild(option);
            });

            // Function to populate institute dropdown
            const populateInstituteDropdown = () => {
                const selectedCategory = categoryDropdown.value;
                const institutes = academics[selectedCategory].map(academic => academic.institute);

                // Clear previous options
                instituteDropdown.innerHTML = '';
                instituteDropdown.appendChild(new Option('Select Institute', ''));

                // Populate institute dropdown with unique values
                [...new Set(institutes)].forEach(institute => {
                    const option = document.createElement('option');
                    option.text = institute;
                    option.value = institute;
                    if (institute === selectedInstitute) {
                        option.selected = true;
                    }
                    instituteDropdown.appendChild(option);
                });

                instituteDropdown.disabled = false;
            };

            // Function to populate faculty dropdown
            const populateFacultyDropdown = () => {
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                const faculties = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute)
                    .map(academic => academic.faculty);

                // Clear previous options
                facultyDropdown.innerHTML = '';
                facultyDropdown.appendChild(new Option('Select Faculty', ''));

                // Populate faculty dropdown with unique values
                [...new Set(faculties)].forEach(faculty => {
                    const option = document.createElement('option');
                    option.text = faculty;
                    option.value = faculty;
                    if (faculty === selectedFaculty) {
                        option.selected = true;
                    }
                    facultyDropdown.appendChild(option);
                });

                facultyDropdown.disabled = false;
            };

            // Function to populate department dropdown
            const populateDepartmentDropdown = () => {
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                const selectedFaculty = facultyDropdown.value;
                const departments = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute && academic.faculty ===
                        selectedFaculty)
                    .map(academic => academic.department);

                // Clear previous options
                departmentDropdown.innerHTML = '';
                departmentDropdown.appendChild(new Option('Select Department', ''));

                // Populate department dropdown with unique values
                [...new Set(departments)].forEach(department => {
                    const option = document.createElement('option');
                    option.text = department;
                    option.value = department;
                    if (department === selectedDepartment) {
                        option.selected = true;
                    }
                    departmentDropdown.appendChild(option);
                });

                departmentDropdown.disabled = false;
            };

            // Function to populate course dropdown
            const populateCourseDropdown = () => {
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                const selectedFaculty = facultyDropdown.value;
                const selectedDepartment = departmentDropdown.value;
                const courses = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute && academic.faculty ===
                        selectedFaculty && academic.department === selectedDepartment)
                    .map(academic => academic.course);

                // Clear previous options
                courseDropdown.innerHTML = '';
                courseDropdown.appendChild(new Option('Select Course', ''));

                // Populate course dropdown with unique values
                [...new Set(courses)].forEach(course => {
                    const option = document.createElement('option');
                    option.text = course;
                    option.value = course;
                    if (course === selectedCourse) {
                        option.selected = true;
                    }
                    courseDropdown.appendChild(option);
                });

                courseDropdown.disabled = false;
            };

            // Event listeners
            categoryDropdown.addEventListener('change', populateInstituteDropdown);
            instituteDropdown.addEventListener('change', populateFacultyDropdown);
            facultyDropdown.addEventListener('change', populateDepartmentDropdown);
            departmentDropdown.addEventListener('change', populateCourseDropdown);

            // Populate dropdowns on initial load
            populateInstituteDropdown();
            populateFacultyDropdown();
            populateDepartmentDropdown();
            populateCourseDropdown();
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryDropdown = document.getElementById('category');
            const instituteDropdown = document.getElementById('institute');
            const facultyDropdown = document.getElementById('faculty');
            const departmentDropdown = document.getElementById('department');
            const courseDropdown = document.getElementById('course');
            const academics = @json($academics->groupBy('category')->toArray());
            const userCategory = '{{ $user->profile->category ?? '' }}';
            const userInstitute = '{{ $user->profile->institute ?? '' }}';
            const userFaculty = '{{ $user->profile->faculty ?? '' }}';
            const userDepartment = '{{ $user->profile->department ?? '' }}';
            const userCourse = '{{ $user->profile->course ?? '' }}';

            // Error messages
            // const errors = {
            //     institute: 'Please select a category first',
            //     faculty: 'Please select an institute first',
            //     department: 'Please select a faculty first',
            //     course: 'Please select a department first'
            // };

            // Function to populate institute dropdown based on selected category
            const populateInstituteDropdown = () => {
                const selectedCategory = categoryDropdown.value;
                // if (!selectedCategory) {
                //     alert(errors.institute);
                //     return;
                // }

                const institutes = academics[selectedCategory].map(academic => academic.institute);

                // Clear previous options
                instituteDropdown.innerHTML = '<option value="" selected disabled>Select Institute</option>';

                // Populate institute dropdown with unique values
                [...new Set(institutes)].forEach(institute => {
                    const option = document.createElement('option');
                    option.text = institute;
                    option.value = institute;
                    instituteDropdown.appendChild(option);
                });

                // Pre-select the institute if it matches user's data
                if (userInstitute && institutes.includes(userInstitute)) {
                    instituteDropdown.value = userInstitute;
                }

                instituteDropdown.disabled = false;
            };

            // Function to populate faculty dropdown based on selected category and institute
            const populateFacultyDropdown = () => {
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                // if (!selectedInstitute) {
                //     alert(errors.faculty);
                //     return;
                // }
                const faculties = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute)
                    .map(academic => academic.faculty);

                // Clear previous options
                facultyDropdown.innerHTML = '<option value="" selected disabled>Select Faculty</option>';

                // Populate faculty dropdown with unique values
                [...new Set(faculties)].forEach(faculty => {
                    const option = document.createElement('option');
                    option.text = faculty;
                    option.value = faculty;
                    facultyDropdown.appendChild(option);
                });

                // Pre-select the faculty if it matches user's data
                if (userFaculty && faculties.includes(userFaculty)) {
                    facultyDropdown.value = userFaculty;
                }

                facultyDropdown.disabled = false;
            };

            // Function to populate department dropdown based on selected category, institute, and faculty
            const populateDepartmentDropdown = () => {
                // Add code to populate department dropdown similar to institute and faculty dropdowns
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                const selectedFaculty = facultyDropdown.value;
                const departments = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute && academic.faculty ===
                        selectedFaculty)
                    .map(academic => academic.department);

                // Clear previous options
                departmentDropdown.innerHTML = '<option value="" selected disabled>Select Department</option>';

                // Populate department dropdown with unique values
                [...new Set(departments)].forEach(department => {
                    const option = document.createElement('option');
                    option.text = department;
                    option.value = department;
                    departmentDropdown.appendChild(option);
                });

                // Pre-select the department if it matches user's data
                if (userDepartment && departments.includes(userDepartment)) {
                    departmentDropdown.value = userDepartment;
                }

                departmentDropdown.disabled = false;
            };

            // Function to populate course dropdown based on selected category, institute, faculty, and department
            const populateCourseDropdown = () => {
                // Add code to populate department dropdown similar to institute and faculty dropdowns
                const selectedCategory = categoryDropdown.value;
                const selectedInstitute = instituteDropdown.value;
                const selectedFaculty = facultyDropdown.value;
                const selectedDepartment = departmentDropdown.value;
                const courses = academics[selectedCategory]
                    .filter(academic => academic.institute === selectedInstitute && academic.faculty ===
                        selectedFaculty && academic.department === selectedDepartment)
                    .map(academic => academic.course);

                // Clear previous options
                courseDropdown.innerHTML = '<option value="" selected disabled>Select Course</option>';

                // Populate department dropdown with unique values
                [...new Set(courses)].forEach(course => {
                    const option = document.createElement('option');
                    option.text = course;
                    option.value = course;
                    courseDropdown.appendChild(option);
                });

                // Pre-select the department if it matches user's data
                if (userCourse && courses.includes(userCourse)) {
                    courseDropdown.value = userCourse;
                }

                courseDropdown.disabled = false;

            };

            // Event listeners
            categoryDropdown.addEventListener('change', populateInstituteDropdown);
            instituteDropdown.addEventListener('change', populateFacultyDropdown);
            facultyDropdown.addEventListener('change', populateDepartmentDropdown);
            departmentDropdown.addEventListener('change', populateCourseDropdown);

            // Populate dropdowns on initial load
            populateInstituteDropdown();
            populateFacultyDropdown();
            populateDepartmentDropdown();
            populateCourseDropdown();
        });
    </script>



@endsection
