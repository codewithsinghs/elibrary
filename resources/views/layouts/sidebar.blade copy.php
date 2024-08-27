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
                    {{-- <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-people"></i>
                            <span class="nav-text">Students</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('students.index') }}">All Students</a></li>
                            <li><a href="{{ route('students.create') }}">Add User</a></li>
                            <li><a href="{{ route('students.edit', $user->id) }}">Edit User</a></li>
                            <li><a href="{{ route('students.show', $user->id) }}">Student Details</a></li>
                        </ul>
                    </li> --}}
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-heart"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('activities.index') }}">All Users Activity</a></li>
                            <li><a href="{{ route('activities.index2') }}">Student Activity</a></li>
                            <li><a href="{{ route('activities.index3') }}">Non Student Activity</a></li>
                        </ul>
                    </li>
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
                    <!-- <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                                                                                                                                                    <i class="bi bi-gear-wide"></i>
                                                                                                                                                                    <span class="nav-text">Setting</span>
                                                                                                                                                                </a>
                                                                                                                                                                <ul aria-expanded="false">
                                                                                                                                                                    <li><a href="Studentlist.html">General System Settings</a></li>
                                                                                                                                                                    <li><a href="Studentlist.html">Email Notifications</a></li>
                                                                                                                                                                </ul>
                                                                                                                                                            </li>
                                                                                                                                                            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                                                                                                                                                    <i class="bi bi-files"></i>
                                                                                                                                                                    <span class="nav-text">Audit Trail</span>
                                                                                                                                                                </a>
                                                                                                                                                                <ul aria-expanded="false">
                                                                                                                                                                    <li><a href="Studentlist.html">User Activity Logs</a></li>
                                                                                                                                                                    <li><a href="Studentlist.html">System Changes History</a></li>
                                                                                                                                                                </ul>
                                                                                                                                                            </li>

                                                                                                                                                            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                                                                                                                                                    <i class="bi bi-hdd-network"></i>
                                                                                                                                                                    <span class="nav-text">Communications</span>
                                                                                                                                                                </a>
                                                                                                                                                                <ul aria-expanded="false">
                                                                                                                                                                    <li><a href="Studentlist.html">Send Announcements</a></li>
                                                                                                                                                                    <li><a href="Studentlist.html">Manage Notifications</a></li>
                                                                                                                                                                </ul>
                                                                                                                                                            </li>
                                                                                                                                                            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                                                                                                                                                    <i class="bi bi-cloud-upload"></i>
                                                                                                                                                                    <span class="nav-text">Integration</span>
                                                                                                                                                                </a>
                                                                                                                                                                <ul aria-expanded="false">
                                                                                                                                                                    <li><a href="Studentlist.html">External Systems</a></li>
                                                                                                                                                                    <li><a href="Studentlist.html">Data Synchronization Options</a></li>
                                                                                                                                                                </ul>
                                                                                                                                                            </li> -->

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
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-book"></i>

                            <span class="nav-text">Manage Courses</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('courses.index') }}">All Courses</a></li>
                            <li><a href="{{ route('courses.create') }}">All Courses</a></li>
                            @if (request()->routeIs('courses.edit'))
                                <li><a href="{{ route('courses.edit', $course->id) }}">Edit Course</a></li>
                            @endif
                            @if (request()->routeIs('courses.show'))
                                <li><a href="{{ route('courses.show', $course->id) }}">Course Details</a></li>
                            @endif
                        </ul>

                    </li>

                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-people"></i>
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

                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-info-circle"></i>
                            <span class="nav-text">Apps</span>
                        </a>
                        <ul aria-expanded="false">
                            {{-- <li><a href="app-profile.html">Profile</a></li> --}}
                            {{-- <li><a href="post-details.html">Post Details</a></li> --}}
                            {{-- <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Courses</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('resources') }}">All Resources</a></li>

                                    @if (request()->routeIs('resources.view'))
                                        <li><a href="{{ route('resources.view', $resource->id) }}">Resource details</a></li>
                                    @endif
                                </ul>
                            </li> --}}
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
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-link"></i>
                            <span class="nav-text">Supports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('support-tickets.index') }}">All Supports</a></li>

                            @if (request()->routeIs('resources.view'))
                                <li><a href="{{ route('support-tickets.view', $supportTicket->id) }}">Resource details</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endrole
            @endauth

            @auth
                @unlessrole('admin|manager|librarian')
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
                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <span class="nav-text">Notifications</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="Studentlist.html">Customizable System Alerts</a></li>
                    </ul>
                </li>



                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="bi bi-patch-question"></i>
                        <span class="nav-text">Help and Support</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="Studentlist.html">Knowledge Base</a></li>
                        <li><a href="{{ route('support.index') }}">Contact Support</a></li>
                    </ul>
                </li>
            @endauth

            {{-- <li class="d-xl-none d-lg-none d-md-none"><a href="{{ url('contact-us') }}"><i
                        class="bi bi-chat-square"></i>Contact</a></li> --}}
            {{-- <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-info-circle"></i>
                    <span class="nav-text">Apps</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="app-profile.html">Profile</a></li>
                    <li><a href="post-details.html">Post Details</a></li>
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="email-compose.html">Compose</a></li>
                            <li><a href="email-inbox.html">Inbox</a></li>
                            <li><a href="email-read.html">Read</a></li>
                        </ul>
                    </li>
                    <li><a href="app-calender.html">Calendar</a></li>
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Shop</a>
                        <ul aria-expanded="false">
                            <li><a href="ecom-product-grid.html">Product Grid</a></li>
                            <li><a href="ecom-product-list.html">Product List</a></li>
                            <li><a href="ecom-product-detail.html">Product Details</a></li>
                            <li><a href="ecom-product-order.html">Order</a></li>
                            <li><a href="ecom-checkout.html">Checkout</a></li>
                            <li><a href="ecom-invoice.html">Invoice</a></li>
                            <li><a href="ecom-customers.html">Customers</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-pie-chart"></i>
                    <span class="nav-text">Charts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="chart-flot.html">Flot</a></li>
                    <li><a href="chart-morris.html">Morris</a></li>
                    <li><a href="chart-chartjs.html">Chartjs</a></li>
                    <li><a href="chart-chartist.html">Chartist</a></li>
                    <li><a href="chart-sparkline.html">Sparkline</a></li>
                    <li><a href="chart-peity.html">Peity</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-star"></i>
                    <span class="nav-text">Bootstrap</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="ui-accordion.html">Accordion</a></li>
                    <li><a href="ui-alert.html">Alert</a></li>
                    <li><a href="ui-badge.html">Badge</a></li>
                    <li><a href="ui-button.html">Button</a></li>
                    <li><a href="ui-modal.html">Modal</a></li>
                    <li><a href="ui-button-group.html">Button Group</a></li>
                    <li><a href="ui-list-group.html">List Group</a></li>
                    <li><a href="ui-card.html">Cards</a></li>
                    <li><a href="ui-carousel.html">Carousel</a></li>
                    <li><a href="ui-dropdown.html">Dropdown</a></li>
                    <li><a href="ui-popover.html">Popover</a></li>
                    <li><a href="ui-progressbar.html">Progressbar</a></li>
                    <li><a href="ui-tab.html">Tab</a></li>
                    <li><a href="ui-typography.html">Typography</a></li>
                    <li><a href="ui-pagination.html">Pagination</a></li>
                    <li><a href="ui-grid.html">Grid</a></li>

                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-heart"></i>
                    <span class="nav-text">Plugins</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="uc-select2.html">Select 2</a></li>
                    <li><a href="uc-nestable.html">Nestedable</a></li>
                    <li><a href="uc-noui-slider.html">Noui Slider</a></li>
                    <li><a href="uc-sweetalert.html">Sweet Alert</a></li>
                    <li><a href="uc-toastr.html">Toastr</a></li>
                    <li><a href="map-jqvmap.html">Jqv Map</a></li>
                    <li><a href="uc-lightgallery.html">Light Gallery</a></li>
                </ul>
            </li>
            <li><a href="widget-basic.html" class="" aria-expanded="false">
                    <i class="bi bi-gear-wide"></i>
                    <span class="nav-text">Widget</span>
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-file-earmark-check"></i>
                    <span class="nav-text">Forms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="form-element.html">Form Elements</a></li>
                    <li><a href="form-wizard.html">Wizard</a></li>
                    <li><a href="form-ckeditor.html">CkEditor</a></li>
                    <li><a href="form-pickers.html">Pickers</a></li>
                    <li><a href="form-validation.html">Form Validate</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                    <span class="nav-text">Table</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                    <li><a href="table-datatable-basic.html">Datatable</a></li>
                </ul>
            </li> 

            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-file-earmark-break"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="page-login.html">Login</a></li>
                    <li><a href="page-register.html">Register</a></li>
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="page-error-400.html">Error 400</a></li>
                            <li><a href="page-error-403.html">Error 403</a></li>
                            <li><a href="page-error-404.html">Error 404</a></li>
                            <li><a href="page-error-500.html">Error 500</a></li>
                            <li><a href="page-error-503.html">Error 503</a></li>
                        </ul>
                    </li>
                    <li><a href="page-lock-screen.html">Lock Screen</a></li>
                    <li><a href="empty-page.html">Empty Page</a></li>
                </ul>
            </li> --}}
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
        {{-- <div class="copyright">
            <p><strong>GetSkills Online Learning Admin</strong> © 2022 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by HugeBinarys</p>
        </div> --}}
    </div>
</div>

<!-- sidebar -->
