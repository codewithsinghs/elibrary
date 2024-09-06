@extends('layouts.app')

@section('headerTitle', 'Courses')
@section('main-content')


    <div class="content-body">

        <div class="container-fluid">

            <!----------- Breachcrumb------------>
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Bootstrap</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>
                </ol>
            </div>

            <!-- Section All Categories End -->

            <div class="widget-heading d-flex justify-content-between align-items-center">
                <h3 class="m-0">Popular Categories</h3>
                <a href="{{ route('courses') }}" class="btn btn-primary btn-sm">View all</a>
            </div>
            <div class="row">
                <!-- Slider main container -->
                <div class="swiper course-slider">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($categories as $category)
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="widget-courses align-items-center d-flex justify-content-between flex-wrap">
                                            <a href="{{ route('courses', ['category' => $category]) }}">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <img src="{{ asset('build/assets/images/svg/color-palette.svg') }}"
                                                    alt="">
                                                <div class="flex-1 ms-3">
                                                    <h4>{{ $category }}</h4>
                                                    <span>Course</span>
                                                </div>
                                            </div>
                                        </a>
                                            <a class="bg-primary p-2 rounded" href="{{ route('courses', ['category' => $category]) }}"><i
                                                    class="las la-angle-right text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Section All Categories End -->

            <!-- Section All Resources -->
            <div class="widget-heading d-flex justify-content-between align-items-center">
                <h3 class="m-0">All Courses</h3>
                <a href="#" class="btn btn-primary btn-sm">View all</a>
            </div>


            <div class="row">
                @php $displayCount = 0; @endphp
                @foreach ($courses as $course)
                    <!-- Display course details -->
                    <div class="col-xl-4 col-md-6">
                        <!-- Display course details -->
                        <div class="course" style="display: {{ $displayCount < 6 ? 'block' : 'none' }};">
                            @php
                            $imageExists =
                                $course->image &&
                                Storage::disk('public')->exists(
                                    'courses/' . $course->image,
                                );
                            $thumbnailExists =
                                $course->image &&
                                Storage::disk('public')->exists(
                                    // 'courses/thumbnails/' . $course->image,
                                    'courses/thumbnail/' . $course->image,
                                );
                        @endphp

                            <div class="card all-crs-wid">
                                <div class="card-body">
                                    <div class="courses-bx">
                                        <div class="dlab-media">
                                            {{-- <img src="{{ asset('build/assets/images/courses/course1.jpg') }}"
                                                alt=""> --}}
                                                <img class=""
                                                            src="{{ $thumbnailExists ? Storage::url('courses/thumbnails/' . $course->image) : ($imageExists ? Storage::url('courses/' . $course->image) : ($course->image ? asset('storage/common/loading.gif') : asset('storage/common/no_image.png'))) }}"
                                                            >
                                        </div>
                                        <div class="dlab-info">
                                            <div class="dlab-title d-flex justify-content-between">
                                                <div>
                                                    <h4><a href="{{ route('courses.view', $course->slug) }}">{{ $course->name }}</a></h4>
                                                    <p class="m-0">{{ $course->level }}
                                                        <svg class="ms-1" width="4" height="5" viewBox="0 0 4 5"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="2" cy="2.5" r="2" fill="#DBDBDB" />
                                                        </svg>
                                                        <span>5.0<svg width="16" height="15" viewBox="0 0 16 15"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8 0.5L9.79611 6.02786H15.6085L10.9062 9.44427L12.7023 14.9721L8 11.5557L3.29772 14.9721L5.09383 9.44427L0.391548 6.02786H6.20389L8 0.5Z"
                                                                    fill="#FEC64F" />
                                                            </svg>
                                                        </span>
                                                    </p>
                                                </div>
                                                <h4 class="text-primary"> &#8377; <span> {{ $course->price }} </span></h4>
                                            </div>
                                            <div class="d-flex justify-content-between content align-items-center">
                                                <span>
                                                    <svg class="me-1" width="24" height="25" viewBox="0 0 24 25"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M21.2 18.6C20.5 18.5 19.8 18.4 19 18.4C16.5 18.4 14.1 19.1 12 20.5C9.90004 19.2 7.50005 18.4 5.00005 18.4C4.30005 18.4 3.50005 18.5 2.80005 18.6C2.30005 18.7 1.90005 19.2 2.00005 19.8C2.10005 20.4 2.60005 20.7 3.20005 20.6C3.80005 20.5 4.40005 20.4 5.00005 20.4C7.30005 20.4 9.50004 21.1 11.4 22.5C11.7 22.8 12.2 22.8 12.6 22.5C15 20.8 18 20.1 20.8 20.6C21.3 20.7 21.9 20.3 22 19.8C22.1 19.2 21.7 18.7 21.2 18.6ZM21.2 2.59999C20.5 2.49999 19.8 2.39999 19 2.39999C16.5 2.39999 14.1 3.09999 12 4.49999C9.90004 3.09999 7.50005 2.39999 5.00005 2.39999C4.30005 2.39999 3.50005 2.49999 2.80005 2.59999C2.40005 2.59999 2.00005 3.09999 2.00005 3.49999V15.5C2.00005 16.1 2.40005 16.5 3.00005 16.5C3.10005 16.5 3.10005 16.5 3.20005 16.5C3.80005 16.4 4.40005 16.3 5.00005 16.3C7.30005 16.3 9.50004 17 11.4 18.4C11.7 18.7 12.2 18.7 12.6 18.4C15 16.7 18 16 20.8 16.5C21.3 16.6 21.9 16.2 22 15.7C22 15.6 22 15.6 22 15.5V3.49999C22 3.09999 21.6 2.59999 21.2 2.59999Z"
                                                            fill="#c7c7c7" />
                                                    </svg>
                                                    110+ Content
                                                </span>
                                                <a href="{{ route('courses.view', $course->slug) }}" class="btn btn-primary btn-sm">View all</a>
                                                    {{-- <a href="{{ route('courses.viewByName', ['courseName' => Str::slug($course->name, '-')]) }}"
                                                        class="btn btn-primary btn-sm">View all</a> --}}
                                                       


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @php $displayCount++; @endphp
                @endforeach


                <div class="d-flex align-items-center ">

                    <button id="load-more" class="mx-auto btn btn-primary btn-sm"
                        @if ($displayCount < 6) style="display: none;" @endif>Load More</button>
                    <div id="load-more-feedback" class="mx-auto text-primary" style="display: none;">All courses loaded
                    </div>
                </div>

                <style>
                    /* Add CSS animation for fadeInUp */
                    @keyframes fadeInUp {
                        0% {
                            opacity: 0;
                            transform: translateY(20px);
                        }

                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var visibleCourses = 6;

                        // Function to load more courses
                        function loadMoreCourses() {
                            $('.course:hidden').slice(0, 6).slideDown('slow').addClass('animated');

                            visibleCourses += 6;

                            // Hide the "Load More" button and show feedback when there are no more hidden courses left
                            if ($('.course:hidden').length === 0) {
                                $('#load-more').hide();
                                $('#load-more-feedback').show();
                            }
                        }

                        // Click event handler for the "Load More" button
                        $('#load-more').click(function() {
                            loadMoreCourses();
                        });
                    });
                </script>




            </div>

        </div>
    </div>
@endsection

