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
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" media="print">
               
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

        /* CSS for printing */
        @media print {
            .col-12,
            .col-lg-10,
            .col-lg-2 {
                width: 100% !important;
                float: none !important;
            }

            .col-md-3,
            .col-sm-6 {
                width: auto !important;
                float: none !important;
            }
        }
    </style>
              
                <div class="row bg-white mt-3 px-5">
            
                    <div class="col-12">
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
                            <div class="col-lg-10 order-2 order-md-1">
                                <div class="row">
            
                                    <div class="col-md-3 col-sm-6 left"><strong>First Name</strong></div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->fname ?? '' }}</div>
                                    <div class="col-md-3 col-sm-6 left"><strong>Last Name</strong></div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->lname ?? '' }}</div>
            
            
                                    <div class="col-md-3 col-sm-6 left"><strong>Email Address</strong></div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->email ?? '' }}</div>
                                    <div class="col-md-3 col-sm-6 left"><strong>Date of Birth</strong></div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->dob ?? '' }}</div>
            
                                    <div class="col-md-3 col-sm-6 left"><strong>Category</strong></div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->category ?? '' }}</div>
                                    <div class="col-md-3 col-sm-6 left"><strong>Gender</strong></div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->gender ?? '' }}</div>
            
                                    <div class="col-md-3 col-sm-6 left"><strong>Member Type</strong></div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->member_type ?? '' }}</div>
                                    <div class="col-md-3 col-sm-6 left"><strong>Enrollment/Emp. ID </strong> </div>
                                    <div class="col-md-3 col-sm-6 right">{{ $user->profile->member_id ?? '' }}</div>
            
                                    <div class="col-md-6 col-12 left"><strong>Father's Name</strong></div>
                                    <div class="col-md-6 col-12 left"><strong>Local Gurdian's Name</strong></div>
                                    <div class="col-md-6 col-12 left"><strong>Mobile Number</strong></div>
                                </div>
                            </div>
            
                            <div class="col-lg-2 order-1 order-md-2">
                                <img class="bordered" src="{{ asset('build/assets/img/uploaded/resources/abhishek_20240220.jpeg') }}" width="100">
                            </div>
                        </div>
            
                        <h4 class="bg-semi">Academic Information</h4>
                        <div class="row">
            
                            <div class="col-md-3 col-sm-6 left"><strong>Institute</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->institute ?? '' }}</div>
                            <div class="col-md-3 col-sm-6 left"><strong>Faculty</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->faculty ?? '' }}</div>
                            <div class="col-md-3 col-sm-6 left"><strong>Depart ment</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->department ?? '' }}</div>
            
                            <div class="col-md-3 col-sm-6 left"><strong>Course/ Designation</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->course ?? ($user->profile->designition ?? '') }}</div>
                            <div class="col-md-3 col-sm-6 left"><strong>Enrollment Number</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->enrollment_number ?? '' }}</div>
                            <div class="col-md-3 col-sm-6 left"><strong>Year Of Admission</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->year_of_admission ?? '' }}</div>
            
                        </div>
            
                        <h4 class="bg-semi">Conatct Information</h4>
            
                        <div class="row">
                            <div class="col-md-3 col-sm-6 left"><strong>Present Address</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->present_address ?? '' }}</div>
                            <div class="col-md-3 col-sm-6 left"><strong>City</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->present_city ?? '' }}</div>
            
                            <div class="col-md-2 col-sm-6 left"><strong>Pincode</strong></div>
                            <div class="col-md-2 col-sm-6 right">{{ $user->profile->present_pincode ?? '' }}</div>
                            <div class="col-md-2 col-sm-6 left"><strong>Phone Number</strong></div>
                            <div class="col-md-2 col-sm-6 right">{{ $user->profile->phone_number ?? '' }}</div>
                            <div class="col-md-2 col-sm-6 left"><strong>Alternate Email</strong></div>
                            <div class="col-md-2 col-sm-6 right">{{ $user->profile->alternate_email ?? '' }}</div>
            
                            <div class="col-md-3 col-sm-6 left"><strong>Permanent Address</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->permanent_address ?? '' }}</div>
                            <div class="col-md-3 col-sm-6 left"><strong>City</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->permanent_city ?? '' }}</div>
            
                            <div class="col-md-3 col-sm-6 left"><strong>Pincode</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->permanent_pincode ?? '' }}</div>
                            <div class="col-md-3 col-sm-6 left"><strong>Phone Number</strong></div>
                            <div class="col-md-3 col-sm-6 right">{{ $user->profile->permanent_phone ?? '' }}</div>
            
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
            </div>
            

            {{-- <button onclick="printSection('printable-content')">Print Section</button> --}}
            <button id="print-button" onclick="printSection('printable-content')">Print Section</button>
            {{-- <button onclick="printContent()">Print</button> --}}
        </div>
    </div>
    <!-- Content body end -->
@endsection


@section('scripts')
   

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
