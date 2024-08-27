<!-- Sidebar -->

<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="d-xl-none d-lg-none d-md-none"><a href="{{ url('/') }}"><i class="bi bi-house"></i>
                    <span class="nav-text"> Home</span></a>
            </li>
            <li class="d-xl-none d-lg-none d-md-none"><a href="{{ url('about') }}"><i
                        class="bi bi-info-circle"></i>About</a></li>
            @auth


                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="bi bi-grid"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <ul aria-expanded="false">
                        @role('admin')
                            <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                        @endrole
                        @role('manager')
                            <li><a href="{{ route('manager.dashboard') }}">Manager Dashboard</a></li>
                        @endrole
                        @role('librarian')
                            <li><a href="{{ route('librarian.dashboard') }}">Librarian Dashboard</a></li>
                        @endrole
                        @role('student')
                            <li><a href="{{ route('student.dashboard') }}">Student Dashboard</a></li>
                        @endrole
                        @role('member')
                            <li><a href="{{ route('member.dashboard') }}">Member Dashboard</a></li>
                        @endrole
                        @if (!Auth::user()->hasAnyRole(['admin', 'manager', 'librarian', 'student', 'member']))
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif

                    </ul>

                </li>
                @role(['admin', 'manager', 'librarian'])
                    <!-- Users  -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-people"></i>
                            <span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('users.index') }}">All Users</a></li>
                            <li><a href="{{ route('users.create') }}">Add User</a></li>
                            @if (request()->routeIs('users.edit'))
                                <li><a href="{{ route('users.edit', $user->id) }}">Edit User</a></li>
                            @elseif (request()->routeIs('users.roles.edit'))
                                <li><a href="{{ route('users.roles.edit', $user->id) }}">Edit User Roles</a></li>
                            @elseif (request()->routeIs('users.show'))
                                <li><a href="{{ route('users.show', $user->id) }}">User Detailes</a></li>
                            @endif

                        </ul>
                    </li>
                    <!-- Users Activity -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-heart"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('activities.index') }}">All  Activity</a></li>
                            <li><a href="{{ route('activities.index2') }}">Student Wise Activity</a></li>
                            <li><a href="{{ route('activities.index3') }}">Session Activity</a></li>
                            <li><a href="{{ route('activities.index4') }}">Member Activity</a></li>
                            <li><a href="{{ route('activities.index5') }}">Responsive User Activity</a></li>
                        </ul>
                    </li>
                    <!-- Roles -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-people"></i>
                            <span class="nav-text">Manage Roles</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('roles.index') }}">All Roles</a></li>
                            <li><a href="{{ route('roles.create') }}">Add Role</a></li>
                            @if (request()->routeIs('roles.edit'))
                                <li><a href="{{ route('roles.edit', $role->id) }}">Edit Role</a></li>
                            @elseif (request()->routeIs('roles.show'))
                                <li><a href="{{ route('roles.show', $role->id) }}">Role Details</a></li>
                            @endif

                        </ul>
                    </li>
                    <!-- Resources -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-link"></i>
                            <span class="nav-text">Manage Resources</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('resources.index') }}">All Resources</a></li>
                            <li><a href="{{ route('resources.create') }}">Add Resources</a></li>
                            @if (request()->routeIs('resources.edit'))
                                <li><a href="{{ route('resources.edit', $resource->id) }}">Edit Resource</a></li>
                            @endif
                            @if (request()->routeIs('resources.show'))
                                <li><a href="{{ route('resources.show', $resource->id) }}">Resource details</a></li>
                            @endif

                        </ul>
                    </li>
                    <!-- Courses -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-book"></i>

                            <span class="nav-text">Manage Courses</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('courses.index') }}">All Courses</a></li>
                            <li><a href="{{ route('courses.create') }}">Add Courses</a></li>
                            @if (request()->routeIs('courses.edit'))
                                <li><a href="{{ route('courses.edit', $course->id) }}">Edit Course</a></li>
                            @endif
                            @if (request()->routeIs('courses.show'))
                                <li><a href="{{ route('courses.show', $course->id) }}">Course Details</a></li>
                            @endif
                        </ul>

                    </li>
                    <!-- Academics -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-globe"></i>
                            <span class="nav-text">Academics</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('academics.index') }}">Academics</a></li>
                            <li><a href="{{ route('academics.create') }}">Add Academics</a></li>
                            @if (request()->routeIs('academic.edit'))
                                <li><a href="{{ route('academic.edit', $role->id) }}">Edit Academics</a></li>
                            @elseif (request()->routeIs('academic.show'))
                                <li><a href="{{ route('academic.show', $role->id) }}">Academics Details</a></li>
                            @endif

                        </ul>
                    </li>
                    <!-- APPS -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-info-circle"></i>
                            <span class="nav-text">Apps</span>
                        </a>
                        <ul aria-expanded="false">
                            <!-- Cources -->
                            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                    <i class="bi bi-book"></i>

                                    <span class="nav-text">Courses</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('courses') }}">All Courses</a></li>

                                    @if (request()->routeIs('courses.view'))
                                        <li><a href="{{ route('courses.view', $course->slug) }}">Course Details</a></li>
                                    @endif
                                </ul>

                            </li>
                            <!-- Resources -->
                            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                    <i class="bi bi-link"></i>
                                    <span class="nav-text">Resources</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('resources') }}">All Resources</a></li>

                                    @if (request()->routeIs('resources.view'))
                                        <li><a href="{{ route('resources.view', $resource->slug) }}">Resource details</a></li>
                                    @endif

                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Support -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-link"></i>
                            <span class="nav-text">Supports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('support-tickets.index') }}">All Support Tickets</a></li>
                            @if (request()->routeIs('support-tickets.show'))
                                <li><a href="{{ route('support-tickets.show', $supportTicket->ticket_id) }}">Ticket
                                        Details</a></li>
                            @endif


                        </ul>
                    </li>
                @endrole
            @endauth

            @auth
                @unlessrole('admin|manager|librarian')
                    <!-- Courses -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-book"></i>

                            <span class="nav-text">Courses</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('courses') }}">All Courses</a></li>

                            @if (request()->routeIs('courses.view'))
                                <li><a href="{{ route('courses.view', $course->slug) }}">Course Details</a></li>
                            @endif
                        </ul>


                    </li>
                    <!-- Resources -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-link"></i>
                            <span class="nav-text">Resources</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('resources') }}">All Resources</a></li>

                            @if (request()->routeIs('resources.view'))
                                <li><a href="{{ route('resources.view', $resource->id) }}">Resource details</a></li>
                            @endif

                        </ul>
                    </li>
                @endunlessrole

                <!-- Notification -->
                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <span class="nav-text">Notifications</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Customizable System Alerts</a></li>
                    </ul>
                </li>

                <!-- Help & Support -->
                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="bi bi-patch-question"></i>
                        <span class="nav-text">Help and Support</span>
                    </a>
                    <ul aria-expanded="false">
                        {{-- <li><a href="#">Knowledge Base</a></li> --}}
                        <li><a href="{{ route('support.index') }}">Contact Support</a></li>
                    </ul>
                </li>
            @endauth

            <li class="d-xl-none d-lg-none d-md-none"><a href="{{ url('about') }}"><i
                        class="bi bi-telephone"></i>Contact</a></li>
        </ul>
        <div class="plus-box">
            <div class="d-flex align-items-center">
                <h5>Upgrade your Account to Pro</h5>
                <img src="{{ asset('build/assets/') }}/images/medal.png" alt="">
            </div>
            <p>Upgrade to premium to get premium features</p>
            <a href="javascript:void(0);" class="btn btn-primary btn-sm">Upgrade</a>
        </div>

    </div>
</div>

<!-- sidebar -->
