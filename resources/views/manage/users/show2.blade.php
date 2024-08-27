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

            <style>
                /* Add a print-specific style block */
                @media print {

                    /* Ensure columns appear in desktop layout */
                    .row {
                        display: flex !important;
                        flex-wrap: wrap !important;
                    }

                    .col-print {
                        flex: 0 0 auto !important;
                        max-width: none !important;
                    }

                    /* Force each row to break onto a new line */
                    .row.printable-row {
                        display: block !important;
                    }

                    .col-print {
                        flex: 0 0 auto !important;
                        max-width: none !important;
                    }

                    /* Add more overrides as needed */
                }
            </style>

            <div id="printable-content">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
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

                    .bg-semi {
                        background: var(--rgba-primary-1);
                    }

                    .table td {
                        padding: 8px 0px;
                    }

                    .row div {
                        margin-bottom: 15px;
                    }
                </style>
                <div class="bg-white mt-3 px-5">


                    <div class="row">
                        <div class="col-6">
                            <img src="{{ url('build/assets/img/logo/rntu.png') }}" width="250" alt="">
                        </div>
                        <div class="col-6 text-right">
                            <img src="{{ asset('build/assets/img/logo/elibrary.png') }}" width="200" alt="">
                        </div>
                    </div>

                    <h2 class="text-center"> CENTRAL LIBRARY </h2>
                    <h3 class="text-center"> STUDENT REGISTRATION FORM</h3>

                    <h4 class="bg-semi">Personal Information:</h4>

                    <div class="row">
                        <div class="col-12 col-md-10">
                            <div class="printable-row">
                                <div class="row">
                                    <div class="col-md-3 col-print"><strong>First Name</strong></div>
                                    <div class="col-md-3">{{ $user->profile->fname ?? '' }}</div>
                                    <div class="col-md-3 col-print"><strong>Last Name</strong></div>
                                    <div class="col-md-3">{{ $user->profile->lname ?? '' }}</div>
                
                                    <div class="col-md-3 col-print"><strong>Email Address</strong></div>
                                    <div class="col-md-3">{{ $user->profile->email ?? '' }}</div>
                                    <div class="col-md-3 col-print"><strong>Date of Birth</strong></div>
                                    <div class="col-md-3">{{ $user->profile->dob ?? '' }}</div>
                
                                    <div class="col-md-3 col-print"><strong>Category</strong></div>
                                    <div class="col-md-3">{{ $user->profile->category ?? '' }}</div>
                                    <div class="col-md-3 col-print"><strong>Gender</strong></div>
                                    <div class="col-md-3">{{ $user->profile->gender ?? '' }}</div>
                
                                    <div class="col-md-3 col-print"><strong>Member Type</strong></div>
                                    <div class="col-md-3">{{ $user->profile->member_type ?? '' }}</div>
                                    <div class="col-md-3 col-print"><strong>Enrollment/Emp. ID </strong></div>
                                    <div class="col-md-3">{{ $user->profile->member_id ?? '' }}</div>
                
                                    <div class="col-md-6 col-print"><strong>Father's Name</strong></div>
                                    <div class="col-md-6 col-print"><strong>Local Guardian's Name</strong></div>
                                    <div class="col-md-6 col-print"><strong>Mobile Number</strong></div>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-12 col-md-2">
                            <img class="bordered"
                                src="{{ asset('build/assets/img/uploaded/resources/abhishek_20240220.jpeg') }}"
                                width="100">
                        </div>
                    </div>

                    <h4 class="bg-semi">Academic Information</h4>
                    <div class="row">

                        <div class="col-sm-3 left"><strong>Institute</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->institute ?? '' }}</div>
                        <div class="col-sm-3 left"><strong>Faculty</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->faculty ?? '' }}</div>
                        <div class="col-sm-3 left"><strong>Depart ment</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->department ?? '' }}</div>

                        <div class="col-sm-3 left"><strong>Course/ Designation</strong></div>
                        <div class="col-sm-3 right">
                            {{ $user->profile->course ?? ($user->profile->designition ?? '') }}</div>
                        <div class="col-sm-3 left"><strong>Enrollment Number</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->enrollment_number ?? '' }}</div>
                        <div class="col-sm-3 left"><strong>Year Of Admission</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->year_of_admission ?? '' }}</div>

                    </div>

                    <h4 class="bg-semi">Conatct Information</h4>

                    <div class="row">
                        <div class="col-sm-3 left"><strong>Present Address</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->present_address ?? '' }}</div>
                        <div class="col-sm-3 left"><strong>City</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->present_city ?? '' }}</div>

                        <div class="col-md-2 col-sm-6 left"><strong>Pincode</strong></div>
                        <div class="col-md-2 col-sm-6 right">{{ $user->profile->present_pincode ?? '' }}</div>
                        <div class="col-md-2 col-sm-6 left"><strong>Phone Number</strong></div>
                        <div class="col-md-2 col-sm-6 right">{{ $user->profile->phone_number ?? '' }}</div>
                        <div class="col-md-2 col-sm-6 left"><strong>Alternate Email</strong></div>
                        <div class="col-md-2 col-sm-6 right">{{ $user->profile->alternate_email ?? '' }}</div>

                        <div class="col-sm-3 left"><strong>Permanent Address</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->permanent_address ?? '' }}</div>
                        <div class="col-sm-3 left"><strong>City</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->permanent_city ?? '' }}</div>

                        <div class="col-sm-3 left"><strong>Pincode</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->permanent_pincode ?? '' }}</div>
                        <div class="col-sm-3 left"><strong>Phone Number</strong></div>
                        <div class="col-sm-3 right">{{ $user->profile->permanent_phone ?? '' }}</div>

                    </div>


                    <h4 class="bg-semi">Gurantor Information</h4>

                    <div class="row">

                        <div class="col-md-3 col-sm-6 left"><strong>Library Member</strong></div>
                        <div class="col-md-3 col-sm-6 right">{{ $user->guarantor->library_member ?? '' }}</div>
                        <div class="col-md-3 col-sm-6 left"><strong>Form Number</strong></div>
                        <div class="col-md-3 col-sm-6 right">{{ $user->guarantor->form_number ?? '' }}</div>

                        <div class="col-md-2 col-sm-6 left"><strong>First Name</strong></div>
                        <div class="col-md-2 col-sm-6 right">{{ $user->guarantor->fname ?? '' }}</div>
                        <div class="col-md-2 col-sm-6 left"><strong>Last Name</strong></div>
                        <div class="col-md-2 col-sm-6 right">{{ $user->guarantor->lname ?? '' }}</div>
                        <div class="col-md-2 col-sm-6 left"><strong>Email</strong></div>
                        <div class="col-md-2 col-sm-6 right">{{ $user->guarantor->email ?? '' }}</div>




                        <div class="col-md-3 col-sm-6 left"><strong>Present Address</strong></div>
                        <div class="col-md-3 col-sm-6 right">{{ $user->guarantor->gr_address ?? '' }}</div>


                        <div class="col-md-3 col-sm-6 left"><strong>City</strong></div>
                        <div class="col-md-3 col-sm-6 right">{{ $user->guarantor->gr_city ?? '' }}</div>
                        <div class="col-md-3 col-sm-6 left"><strong>Pincode</strong></div>
                        <div class="col-md-3 col-sm-6 right">{{ $user->guarantor->gr_pincode ?? '' }}</div>
                        <div class="col-md-3 col-sm-6 left"><strong>Phone Number</strong></div>
                        <div class="col-md-3 col-sm-6 right">{{ $user->guarantor->gr_phone ?? '' }}</div>

                    </div>
                </div>

            </div>

            {{-- <button onclick="printSection('printable-content')">Print Section</button> --}}
            <button id="print-button" onclick="printSection('printable-content')">Print Section</button>
            {{-- <button onclick="printContent()">Print</button> --}}
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

                        // Close the print window after printing is done
                        printWindow.close();
                    }
                };
            }

            // If there are no images, print immediately
            if (images.length === 0) {
                // Close the document
                printWindow.document.close();

                // Print the document
                printWindow.print();

                // Show the print button again after printing
                document.getElementById('print-button').style.display = 'block';

                // Close the print window after printing is done
                printWindow.close();
            }
        }
    </script>
@endsection
