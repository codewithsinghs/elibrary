@extends('layouts.app')

@section('main-content')
    <!-- Content body start -->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Layout</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Blank</a></li>
                </ol>
            </div>



            <div id="printable-content">

                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
                    media="print">
                <style>
                    .pl-3 {
                        padding-left: 2em;
                    }

                    .px-5 {
                        padding-left: 5em;
                        padding-right: 5em;
                    }

                    .table td .right {
                        font-weight: 500;
                    }

                    .bg-semi {
                        background: var(--rgba-primary-1);
                    }

                    .responsive-table>table {
                        width: 100%;
                        max-width: 100%;
                        border-collapse: collapse;
                        -webkit-overflow-scrolling: touch;
                    }

                    .responsive-table {
                        overflow-x: auto;
                    }

                    .table td {
                        padding: 7px 0px;
                        color: Black;
                        font-size: 16px;

                    }

                    @media print {
                        .slider {
                            display: none !important;
                        }
                    }
                </style>
                <div class="row bg-white mt-3 px-5">

                    <div class="table-responsive">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td style="border: none">
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="{{ url('build/assets/img/logo/rntu.png') }}" width="250"
                                                    alt="">
                                            </div>
                                            <div class="col-6 text-right">
                                                <img src="{{ asset('build/assets/img/logo/elibrary.png') }}" width="200"
                                                    alt="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="border: none">
                                        <h2 class=" mt-5 text-center"> CENTRAL LIBRARY </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center " style="border: none">
                                        <h3 class="text-center"> STUDENT REGISTRATION FORM</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none">
                                        <h4 class="bg-semi">Personal Information:</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: none">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-10 ">
                                                <table class="table table-clear">
                                                    <tbody>
                                                        <tr>
                                                            <td class="left">First Name</td>
                                                            <td class="right">{{ $user->profile->fname ?? '' }}</td>
                                                            <td class="left">Last Name</td>
                                                            <td class="right">{{ $user->profile->lname ?? '' }}</td>
                                                            {{-- <td class="right">$8.497,00</td> --}}
                                                        </tr>
                                                        <tr>
                                                            <td class="left">Email Address</td>
                                                            <td class="right">{{ $user->profile->email ?? '' }}</td>
                                                            <td class="left">Date of Birth</td>
                                                            <td class="right">
                                                                @if ($user->profile->dob ?? '')
                                                                    {{ \Carbon\Carbon::parse($user->profile->dob)->format('d-M-Y') ?? '' }}
                                                                @endif
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td class="left">Category</td>
                                                            <td class="right">{{ $user->profile->category ?? '' }}
                                                            </td>
                                                            <td class="left">Gender</td>
                                                            <td class="right">{{ $user->profile->gender ?? '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="left">Member Type</td>
                                                            <td class="right">{{ $user->profile->member_type ?? '' }}
                                                            </td>
                                                            <td class="left">
                                                                @if (!empty($user->profile->member_type))
                                                                    {{ $user->profile->member_type === 'student' || $user->profile->member_type === 'research scholar' ? 'Enrollment Number' : 'Employee ID' ?? '' }}
                                                                @else
                                                                    Enrollment/Employee ID
                                                                @endif
                                                            </td>
                                                            <td class="right">{{ $user->profile->member_id ?? '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="left">Local Gurdian's Name</td>
                                                            <td class="right">
                                                                {{ $user->profile->local_gurdian_name ?? '' }}
                                                            </td>
                                                            <td class="left">Mobile Number
                                                            </td>
                                                            <td class="right">
                                                                {{ $user->profile->local_gurdian_phone ?? '' }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-2 ">
                                                @php
                                                    $profileImage = $user->profile->image ?? null;
                                                    $imageExists =
                                                        $profileImage &&
                                                        Storage::disk('public')->exists('users/' . $profileImage);
                                                    $thumbnailExists =
                                                        $profileImage &&
                                                        Storage::disk('public')->exists(
                                                            'users/thumbnails/' . $profileImage,
                                                        );
                                                @endphp
                                                <img class="bordered"
                                                    src="{{ $thumbnailExists ? Storage::url('users/thumbnails/' . $profileImage) : ($imageExists ? Storage::url('users/' . $profileImage) : ($profileImage ? asset('storage/common/imge-container.png') : asset('storage/common/imge-container.png'))) }}"
                                                    width="100%" alt="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none">
                                        <h4 class="bg-semi">Academic Information</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: none;">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left">Institute</td>
                                                    <td class="right">{{ $user->profile->institute ?? '' }}</td>
                                                    <td class="left">Faculty</td>
                                                    <td class="right">{{ $user->profile->faculty ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left">Depart ment</td>
                                                    <td class="right">{{ $user->profile->department ?? '' }}</td>
                                                    <td class="left">Course/ Designation</td>
                                                    <td class="right">
                                                        {{ $user->profile->course ?? ($user->profile->designition ?? '') }}
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td class="left">Branch & Sem.</td>
                                                    <td class="right">{{ $user->profile->enrollment_number ?? '' }}
                                                    </td>
                                                    <td class="left">Year Of Admission</td>
                                                    <td class="right">{{ $user->profile->year_of_admission ?? '' }}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none">
                                        <h4 class="bg-semi">Conatct Information</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none;">
                                        <div class="col-md-12">
                                            <table class="table table-clear table-stipped">
                                                <tbody>
                                                    <tr>
                                                        <td  class="left">Present Address</td>
                                                        <td colspan="3" class="right">{{ $user->profile->present_address ?? '' }}  </td>
                                                        <td class="left">City</td>
                                                        <td class="right">{{ $user->profile->present_city ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">Pincode</td>
                                                        <td class="right">{{ $user->profile->present_pincode ?? '' }} </td>
                                                        <td class="left">Phone Number</td>
                                                        <td class="right">{{ $user->profile->phone_number ?? '' }}</td>
                                                        <td class="left">Alternate Email</td>
                                                        <td class="right">{{ $user->profile->alternate_email ?? '' }} </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="left">Permanent Address</td>
                                                        <td colspan="3" class="right">{{ $user->profile->permanent_address ?? '' }}  </td>
                                                        <td class="left">City</td>
                                                        <td class="right">{{ $user->profile->permanent_city ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">Pincode</td>
                                                        <td class="right">{{ $user->profile->permanent_pincode ?? '' }} </td>
                                                        <td class="left">Phone Number</td>
                                                        <td class="right">{{ $user->profile->permanent_phone ?? '' }} </td>
                                                        <td class="left">Alternate Email</td>
                                                        <td class="right">{{ $user->profile->alternate_email ?? '' }}  </td>
                                                    </tr>
                                                    <tr>


                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none">
                                        <h4 class="bg-semi">Gurantor Information</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left">Library Member</td>
                                                    <td class="right">{{ $user->guarantor->library_member ?? '' }}
                                                    </td>
                                                    <td class="left">Form Number</td>
                                                    <td class="right">{{ $user->guarantor->form_number ?? '' }}</td>
                                                    <td class="left">Email</td>
                                                    <td class="right">{{ $user->guarantor->email ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left">First Name</td>
                                                    <td class="right">{{ $user->guarantor->fname ?? '' }}</td>
                                                    <td class="left">Last Name</td>
                                                    <td class="right">{{ $user->guarantor->lname ?? '' }}</td>
                                                    
                                                    <td class="left">Phone Number</td>
                                                    <td class="right">{{ $user->guarantor->gr_phone ?? '' }}</td>
                                                </tr>


                                                <tr>
                                                    <td class="left">Present  Address</td>
                                                    <td class="right">{{ $user->guarantor->gr_address ?? '' }}</td>
                                                    <td class="left">City</td>
                                                    <td class="right">{{ $user->guarantor->gr_city ?? '' }}</td>
                                                    <td class="left">Pincode</td>
                                                    <td class="right">{{ $user->guarantor->gr_pincode ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    
                                                   
                                                   

                                                  
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: none">
                                        <h4 class="bg-semi"></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none">
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                DATE : {{ date('d-m-Y') }}

                                            </div>
                                            <div class="col-6 text-right ml-auto">
                                                @php
                                                    $memberType = optional($user->profile)->member_type;
                                                @endphp

                                                @if ($memberType === 'student' || $memberType === 'research scholar')
                                                    SIGNATURE OF STUDENT
                                                @elseif ($memberType === 'research scholar')
                                                    SIGNATURE OF SCHOLAR
                                                @elseif ($memberType === 'faculty' || $memberType === 'instructor')
                                                    SIGNATURE OF FACULTY
                                                @else
                                                    SIGNATURE OF EMPLOYEE
                                                @endif
                                                {{-- SIGNATURE OF {{ $user->profile->member_type === 'student' || $user->profile->member_type === 'research scholar' ? 'STUDENT/SCHOLAR' : 'EMPLOYEE/STAFF' }} --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @if (
                                    !empty($user->profile->member_type) &&
                                        ($user->profile->member_type === 'student' || $user->profile->member_type === 'research scholar'))
                                    <tr>
                                        <td style="border: none">
                                            <div class="row mt-5">
                                                <div class="col-6">
                                                    SIGNATURE of ADMISSION CELL
                                                </div>
                                                <div class="col-6 text-right ml-auto">
                                                    SIGNATURE OF HOD
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="border: none">
                                        <h4 class="mt-5 text-center">FOR LIBRARY USE ONLY</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: none">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td style="border: none">
                                                        1. MEMBERSHIP ID :
                                                        <strong>{{ $user->profile->member_id ?? '' }}</strong>
                                                    </td>
                                                    <td style="border: none">
                                                        2. DATE OF REGISTRATION : <strong>
                                                            @if ($user->created_at ?? '')
                                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') ?? '' }}
                                                            @endif
                                                        </strong>
                                                    </td>
                                                    <td style="border: none">
                                                        3. DETAILS IF ANY……………………
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        {{-- <div class="col-lg-12">
                                            <div class="row mt-2">
                                                <div class="col-4">
                                                    1. MEMBERSHIP ID :
                                                    <strong>{{ $user->profile->member_id ?? '' }}</strong>
                                                </div>
                                                <div class="col-4">
                                                    2. DATE OF REGISTRATION : <strong>
                                                        @if ($user->created_at ?? '')
                                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') ?? '' }}
                                                        @endif
                                                    </strong>
                                                </div>

                                                <div class="col-4">
                                                    3. DETAILS IF ANY……………………
                                                </div>
                                            </div>
                                        </div> --}}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: none">
                                        <div class="col-12 mt-5 mb-4 text-right ml-auto">
                                            SIGNATURE OF LIBRARIAN
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <button id="print-button" onclick="printSection('printable-content')">Print Section</button>
            </div>

            {{-- <button onclick="printSection('printable-content')">Print Section</button> --}}

        </div>
    </div>
    <!-- Content body end -->
@endsection

{{-- <script>
    function printSection(sectionId) {
        var section = document.getElementById(sectionId).outerHTML;
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title>');

        // Include CSS stylesheets
        var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
        stylesheets.forEach(function(stylesheet) {
            printWindow.document.write(stylesheet.outerHTML);
        });

        printWindow.document.write('</head><body>');
        printWindow.document.write(section);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script> --}}
@section('scripts')
    {{-- <script>
    function printSection(sectionId) {
        // Open a new window with about:blank
        var printWindow = window.open('about:blank', '_blank');
        
        // Write the initial HTML structure
        printWindow.document.write('<html><head><title>Print</title>');

        // Function to check if all images are loaded
        function checkAllImagesLoaded(images, callback) {
            var allLoaded = true;
            images.forEach(function(image) {
                if (!image.complete || typeof image.naturalWidth === "undefined" || image.naturalWidth === 0) {
                    allLoaded = false;
                }
            });
            if (allLoaded) {
                callback();
            } else {
                setTimeout(function() {
                    checkAllImagesLoaded(images, callback);
                }, 100);
            }
        }

        // Include CSS stylesheets
        var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
        var stylesheetPromises = Array.from(stylesheets).map(function(stylesheet) {
            return new Promise(function(resolve, reject) {
                var link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = stylesheet.href;
                link.onload = resolve;
                link.onerror = reject;
                printWindow.document.head.appendChild(link);
            });
        });

        // Wait for all stylesheets to load
        Promise.all(stylesheetPromises).then(function() {
            // Close the head tag and start the body
            printWindow.document.write('</head><body>');

            // Get the printable section and clone it
            var section = document.getElementById(sectionId).cloneNode(true);

            // Append the section to the body of the print window
            printWindow.document.body.appendChild(section);

            // Get all images in the section
            var images = section.querySelectorAll('img');

            // Check if all images are loaded
            checkAllImagesLoaded(images, function() {
                // Close the body and HTML tags
                printWindow.document.write('</body></html>');

                // Close the document
                printWindow.document.close();

                // Print the document
                printWindow.print();

                // Add an event listener for the afterprint event
                window.addEventListener('afterprint', function() {
                    // After print, close the print window and open about:blank
                    printWindow.close();
                    window.open('about:blank', '_blank').document.write(document.getElementById(sectionId).outerHTML);
                }, { once: true });
            });
        });
    }
</script> --}}

    {{-- <script>
        function printSection(sectionId) {
            // Hide the print button before printing
            document.getElementById('print-button').style.display = 'none';

            // Clone the section element and its contents
            var section = document.getElementById(sectionId).cloneNode(true);

            // Create a new window with the section content
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title>');

            // Include CSS stylesheets
            var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
            stylesheets.forEach(function(stylesheet) {
                printWindow.document.write('<link rel="stylesheet" href="' + stylesheet.href + '">');
            });

            printWindow.document.write('</head><body>');

            // Append the section content to the new window's body
            printWindow.document.body.appendChild(section);

            // Ensure all images are loaded before printing
            var images = printWindow.document.getElementsByTagName('img');
            var imagesLoaded = 0;
            for (var i = 0; i < images.length; i++) {
                images[i].onload = function() {
                    imagesLoaded++;
                    if (imagesLoaded === images.length) {
                        // All images are loaded, trigger printing
                        printWindow.document.close();
                        printWindow.print();

                        // Show the print button again after printing
                        document.getElementById('print-button').style.display = 'block';
                    }
                };
            }
            printWindow.document.write('</body></html>');

            // Store a reference to the about:blank window
            var aboutBlankWindow = window.open('about:blank', '_blank');

            // Add event listener to close print window
            printWindow.addEventListener('beforeunload', function() {
                if (aboutBlankWindow) {
                    aboutBlankWindow.close(); // Close about:blank window
                }
            });


        }
    </script> --}}


    {{-- <script>
        function printSection(sectionId) {
            // Hide the print button before printing
            document.getElementById('print-button').style.display = 'none';
    
            // Clone the section element and its contents
            var section = document.getElementById(sectionId).cloneNode(true);
    
            // Create a new window with the section content
            var printableWindow = window.open('', '_blank');
    
            // Write the printable content to the new window
            printableWindow.document.write('<html><head><title>Print</title>');
    
            // Include CSS stylesheets
            var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
            stylesheets.forEach(function(stylesheet) {
                printableWindow.document.write('<link rel="stylesheet" href="' + stylesheet.href + '">');
            });
    
            // Additional print styles
            printableWindow.document.write('<style>@media print { body { background-color: white !important; }}</style>');
    
            printableWindow.document.write('</head><body>');
            printableWindow.document.body.appendChild(section);
    
            // Close the document
            printableWindow.document.close();
    
            // Open print preview after a short delay to ensure the content is loaded
            setTimeout(function() {
                printableWindow.print();
            }, 1000);
    
            // Show the print button again after printing
            document.getElementById('print-button').style.display = 'block';
    
            // Add event listener to close printable window when print preview is closed
            printableWindow.onbeforeunload = function() {
                printableWindow.close();
            };
        }
    </script> --}}
    {{-- <script>
        function printSection(sectionId) {
            // Hide the print button before printing
            document.getElementById('print-button').style.display = 'none';
    
            // Clone the section element and its contents
            var section = document.getElementById(sectionId).cloneNode(true);
    
            // Create a new window with the section content
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title>');
    
            // Include CSS stylesheets
            var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
            stylesheets.forEach(function(stylesheet) {
                printWindow.document.write('<link rel="stylesheet" href="' + stylesheet.href + '">');
            });
    
            printWindow.document.write('<style>@media print {.slider {display: none !important;}}</style>'); // Hide slider when printing
    
            printWindow.document.write('</head><body>');
    
            // Append the section content to the new window's body
            printWindow.document.body.appendChild(section);
    
            // Ensure all images are loaded before printing
            var images = printWindow.document.getElementsByTagName('img');
            var imagesLoaded = 0;
            for (var i = 0; i < images.length; i++) {
                images[i].onload = function() {
                    imagesLoaded++;
                    if (imagesLoaded === images.length) {
                        // All images are loaded, trigger printing
                        printWindow.document.close();
                        printWindow.print();
    
                        // Close the print window after printing
                        setTimeout(function() {
                            printWindow.close();
    
                            // Show the print button again after printing
                            document.getElementById('print-button').style.display = 'block';
                        }, 2000); // Adjust the delay as needed
                    }
                };
            }
    
            // Store a reference to the about:blank window
            var aboutBlankWindow = window.open('about:blank', '_blank');
    
            // Add event listener to close print window
            printWindow.addEventListener('beforeunload', function() {
                if (aboutBlankWindow) {
                    aboutBlankWindow.close(); // Close about:blank window
                }
            });
        }
    </script> --}}

    <script>
        function printSection(sectionId) {
            // Hide the print button before printing
            document.getElementById('print-button').style.display = 'none';

            // Clone the section element and its contents
            var section = document.getElementById(sectionId).cloneNode(true);

            // Create a new window with the section content
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title>');

            // Include CSS stylesheets
            var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
            stylesheets.forEach(function(stylesheet) {
                printWindow.document.write('<link rel="stylesheet" href="' + stylesheet.href + '">');
            });

            // Add CSS for printing one page only and adjusting content height
            printWindow.document.write(
                '<style>@media print { @page { size: auto; margin: 0mm; } body { margin: 0; height: auto; min-height: 100%; } }</style>'
            );

            // Hide slider when printing
            printWindow.document.write('<style>.slider { display: none !important; }</style>');

            printWindow.document.write('</head><body>');

            // Append the section content to the new window's body
            printWindow.document.body.appendChild(section);

            // Ensure all images are loaded before printing
            var images = printWindow.document.getElementsByTagName('img');
            var imagesLoaded = 0;
            for (var i = 0; i < images.length; i++) {
                images[i].onload = function() {
                    imagesLoaded++;
                    if (imagesLoaded === images.length) {
                        // All images are loaded, open print preview
                        printWindow.document.close();
                        printWindow.focus(); // Focus the print window

                        // Show the print button again after printing
                        document.getElementById('print-button').style.display = 'block';

                        // Open print preview after a short delay to ensure content is loaded
                        setTimeout(function() {
                            printWindow.print();
                        }, 1000); // Adjust the delay as needed
                    }
                };
            }

            // Listen for the afterprint event in the print window
            printWindow.onafterprint = function() {
                // Close the print window after printing
                printWindow.close();
            };
        }
    </script>
@endsection
