@extends('layouts.app')
@section('main-content')

    <style>
        .list {
           
            padding: inherit!important;
           
        }

        .list li{
            list-style: circle!important;
            padding: unset;
            margin: unset;
        }
    </style>

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
             <!----------- Breachcrumb------------>
             <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">About Us</a></li>
                </ol>
            </div>
            
            <!-- Row starts -->
            <div class="row">
                <!-- Column starts -->
                <div class="col-xl-6">
                    <div class="card">
                        {{-- <div class="card-header d-block">
                            <h4 class="card-title">Default Accordion</h4>
                            <p class="m-0 subtitle">Default accordion. Add <code>accordion</code> class in root</p>
                        </div> --}}
                        <div class="card-body">
                            <!-- Default accordion -->
                            <img src="{{ asset('build/assets/img/about/about.jpg')}}" alt="About Us" width="100%">
                           
                        </div>
                    </div>
                </div>
                <!-- Column ends -->
                <!-- Column starts -->
                <div class="col-xl-6">
                    <div class="card">
                        {{-- <div class="card-header d-block">
                            <h4 class="card-title">Accordion bordered</h4>
                            <p class="m-0 subtitle">Accordion with border. Add class <code>accordion-bordered</code> with the class <code> accordion</code></p>
                        </div> --}}
                        <div class="card-body">
                            
                            <h3>About RNTU E-Library</h3>

                            <p>
                                Welcome to the Rabindranath Tagore University (RNTU) E-Library, your gateway to a vast collection of academic and research resources available online. Our digital library is designed to support students, faculty, and researchers with seamless access to high-quality resources, fostering learning, innovation, and knowledge sharing.
                            </p>

                            <h4>Our Vision</h4>

                            <p>
                                At RNTU E-Library, we strive to build a knowledge-driven academic ecosystem, offering a comprehensive digital platform that caters to the diverse needs of our academic community. We aim to transform education by integrating the latest digital resources, empowering learners with easy access to information and research materials from anywhere at any time.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Column ends -->
             
            </div>
            <!-- Row ends -->

            <!-- Row starts -->
            <div class="row">

                <!-- Column starts -->
                <div class="col-xl-12">
                    <div class="card">
                        {{-- <div class="card-header d-block">
                            <h4 class="card-title">Accordion bordered</h4>
                            <p class="m-0 subtitle">Accordion with border. Add class <code>accordion-bordered</code> with the class <code> accordion</code></p>
                        </div> --}}
                        <div class="card-body">
                            
                            <h3>Key Features:</h3>

                            <ul class="list">
                                <li>Extensive Collection: Access thousands of e-books, journals, research papers, theses, and multimedia resources across various disciplines, including arts, science, commerce, technology, and humanities.</li>
                                <li>User-Friendly Interface: A modern, intuitive platform that makes searching, browsing, and accessing materials effortless.</li>
                                <li>Remote Access: All RNTU students and staff can access the e-library's content from any location using their university credentials.</li>
                                <li>Multiformat Content: Our resources include PDFs, e-books, videos, and interactive materials to enhance the learning experience.</li>
                                <li>Research Support: Offering tools and resources to aid research, including citation management, academic databases, and more.</li>
                                <li>Regular Updates: Our library is continually updated with the latest publications and research materials to ensure you stay informed about the latest academic developments.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Column ends -->
             
            </div>
            <!-- Row ends -->
            
        </div>
    </div>
@endsection
