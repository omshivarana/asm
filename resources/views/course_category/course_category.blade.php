@extends('frontend_new.extendmaster');
{{-- /var/www/html/omshiva.asmbeta.in/@core/resources/views/frontend_new/extendmaster.blade.php --}}

@section('content')
    <!-- Page Banner Start -->
    <div class="section page-banner-section"
        style="background-image: url(http://omshiva.asmbeta.in/@core/public/assets/images/bg/page-banner.jpg);">
        <div class="shape-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="944px" height="894px">
                <defs>
                    <linearGradient id="PSgrad_0" x1="88.295%" x2="0%" y1="0%" y2="46.947%">
                        <stop offset="0%" stop-color="rgb(67,186,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(113,65,177)" stop-opacity="1" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="rgb(43, 142, 254)"
                    d="M39.612,410.76 L467.344,29.824 C516.51,-13.476 590.638,-9.93 633.938,39.613 L914.192,317.344 C957.492,366.50 953.109,440.637 904.402,483.938 L476.671,864.191 C427.964,907.492 353.376,903.109 310.76,854.402 L29.823,576.670 C-13.477,527.963 -9.94,453.376 39.612,410.76 Z" />
                <path fill="url(#PSgrad_0)"
                    d="M39.612,410.76 L467.344,29.824 C516.51,-13.476 590.638,-9.93 633.938,39.613 L914.192,317.344 C957.492,366.50 953.109,440.637 904.402,483.938 L476.671,864.191 C427.964,907.492 353.376,903.109 310.76,854.402 L29.823,576.670 C-13.477,527.963 -9.94,453.376 39.612,410.76 Z" />
            </svg>
        </div>
        <div class="shape-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="726.5px" height="726.5px">
                <path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt"
                    stroke-linejoin="miter" opacity="0.302" fill="none"
                    d="M28.14,285.269 L325.37,21.217 C358.860,-8.851 410.655,-5.808 440.723,28.14 L704.777,325.36 C734.846,358.859 731.802,410.654 697.979,440.722 L400.955,704.776 C367.132,734.844 315.338,731.802 285.269,697.978 L21.216,400.954 C-8.852,367.132 -5.808,315.337 28.14,285.269 Z" />
            </svg>
        </div>
        <div class="shape-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="515px" height="515px">
                <defs>
                    <linearGradient id="PSgrad_0" x1="0%" x2="89.879%" y1="0%" y2="43.837%">
                        <stop offset="0%" stop-color="rgb(67,186,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(113,65,177)" stop-opacity="1" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="rgb(43, 142, 254)"
                    d="M19.529,202.280 L230.531,14.698 C254.559,-6.661 291.353,-4.498 312.714,19.528 L500.295,230.531 C521.656,254.558 519.493,291.353 495.466,312.713 L284.463,500.295 C260.436,521.655 223.641,519.492 202.281,495.465 L14.699,284.462 C-6.660,260.435 -4.498,223.640 19.529,202.280 Z" />
                <path fill="url(#PSgrad_0)"
                    d="M19.529,202.280 L230.531,14.698 C254.559,-6.661 291.353,-4.498 312.714,19.528 L500.295,230.531 C521.656,254.558 519.493,291.353 495.466,312.713 L284.463,500.295 C260.436,521.655 223.641,519.492 202.281,495.465 L14.699,284.462 C-6.660,260.435 -4.498,223.640 19.529,202.280 Z" />
            </svg>
        </div>
        <div class="shape-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="972.5px" height="970.5px">
                <path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt"
                    stroke-linejoin="miter" fill="none"
                    d="M38.245,381.102 L435.258,28.158 C480.467,-12.32 549.697,-7.964 589.888,37.244 L942.832,434.257 C983.23,479.466 978.955,548.697 933.746,588.888 L536.733,941.832 C491.524,982.23 422.293,977.955 382.103,932.745 L29.158,535.732 C-11.32,490.523 -6.963,421.293 38.245,381.102 Z" />
            </svg>
        </div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Banner Content Start -->
                        <div class="page-banner text-center">
                            <h2 class="title">Course Filter</h2>
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{ route('course_all_filter.course_all_filter') }}">Course Filter</a></li>
                            </ul>
                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Blog Start -->
    <div class="section techwix-blog-grid-section section-padding">
        <div class="container-fluid">
            {{-- BEGIN:GRID OPTION --}}
            <div class="row">
                <div class="col-lg-9"></div>
                <div class="col-lg-3 menu-grid pb-5 d-flex justify-content-center">
                    <div class="filter-way">
                        <select name="filter-way" id="filter-way" class="form-control">

                            <option value="">Select a option</option>
                            <option value="high to low">High to Low</option>
                            <option value="low to high">Low to high</option>
                            <option value="latest">Latest</option>
                        </select>
                    </div>&emsp;
                    <div class="filter-menu">
                        <button id="change-grid-btn-phone" class="btn-grid-style">
                            <span class="form-control">
                                <i class="fa fa-th-list" aria-hidden="true"></i>
                            </span>
                        </button>
                        <button id="change-grid-btn-tab" class="btn-grid-style">
                            <span class="form-control">
                                <i class="fa fa-th-large" aria-hidden="true"></i>
                            </span>
                        </button>
                        <button id="change-grid-btn" class="btn-grid-style">
                            <span class="form-control">
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            {{-- END:GRID OPTION --}}
            <div class="techwix-blog-grid-wrap">
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        <!-- Blog Sidebar Start -->
                        <div class="blog-sidebar">
                            {{-- banner:BEGIN --}}
                            <div class="sidebar-widget">
                                <div class="widget-banner"
                                    style="background-image: url(http://omshiva.asmbeta.in/@core/public/assets/images/blog/sidebar-img.jpg);">
                                    <div class="banner-content">
                                        <h4 class="title">The leading platform</h4>
                                        <a class="btn" href="contact.html">Get Started</a>
                                    </div>
                                </div>
                            </div>
                            {{-- banner:END --}}
                            <!-- Sidebar Widget Start -->
                            <div class="sidebar-widget">
                                <!-- Widget Title Start -->
                                <div class="widget-title">
                                    <h3 class="title">Categories</h3>
                                </div>
                                <!-- Widget Title End -->
                                <!-- Widget Category Start -->
                                <ul class="category">
                                    <li class="cate-item"><a
                                            href="{{ route('course_all_filter.course_all_filter', 'technology') }}"><i
                                                class="flaticon-next"></i> Technology <span
                                                class="post-count">3</span></a></li>
                                    <li class="cate-item"><a
                                            href="{{ route('course_all_filter.course_all_filter', 'innovation') }}"><i
                                                class="flaticon-next"></i> Innovation <span
                                                class="post-count">5</span></a></li>
                                    <li class="cate-item"><a
                                            href="{{ route('course_all_filter.course_all_filter', 'learning') }}"><i
                                                class="flaticon-next"></i> Learning <span class="post-count">3</span></a>
                                    </li>
                                    <li class="cate-item"><a
                                            href="{{ route('course_all_filter.course_all_filter', 'information') }}"><i
                                                class="flaticon-next"></i> Information
                                            <span class="post-count">3</span></a></li>
                                </ul>
                                <!-- Widget Category End -->
                            </div>
                            <!-- Sidebar Widget End -->

                        </div>
                        <!-- Blog Sidebar End -->
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="row">
                            @foreach ($course_all_filter as $course_filter)
                                <div class="col-lg-4 col-md-6 course-grid">
                                    <!-- Single Blog Start -->
                                    <div class="single-blog">
                                        <div class="blog-image">
                                            <a
                                                href="{{ route('course_all_filter.course_all_detail', $course_filter->id) }}">
                                                <img src="{{ asset('@core/storage/app/public/' . $course_filter->course_thumbnail) }}"
                                                    alt="image" class="img-fluid">
                                            </a>
                                            <div class="top-meta">
                                                <span
                                                    class="date"><span>{{ date('d M', strtotime($course_filter->created_at)) }}</span></span>
                                            </div>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <span><i class="fas fa-user"></i> <a
                                                        href="#">{{ $course_filter->topic_title }}</a></span>
                                                <span><i class="far fa-comments"></i> 0 Comments</span>
                                            </div>
                                            <h3 class="title"><a
                                                    href="blog-details.html">{{ $course_filter->course_description }}</a>
                                            </h3>
                                            <div class="blog-btn">
                                                <a class="blog-btn-link" href="blog-details.html">Read Full <i
                                                        class="fas fa-long-arrow-alt-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Blog End -->
                                </div>
                            @endforeach
                        </div>
                        {{-- {{ $course_all_filter->links() }} --}}

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Blog End -->

    <script>
        // JavaScript to handle select change event
        document.getElementById("filter-way").addEventListener("change", function() {
            var selectedOption = this.value;
            if (selectedOption === "high to low") {
                // Redirect to the desired route when "Sort by Price (High to Low)" is selected
                window.location.href = "{{ route('course_all_filter.latest.sort.desc') }}";
            }
            // Redirect to the desired route when "Sort by Price (Low to High)" is selected
            if (selectedOption === "low to high") {
                // Redirect to the desired route when "Sort by Price (Low to High)" is selected
                window.location.href = "{{ route('course_all_filter.latest.sort.asc') }}";
            }
            // Add more conditions for other options if needed
            if (selectedOption === "latest") {
                // Redirect to the desired route when "Sort by Latest" is selected
                window.location.href = "{{ route('course_all_filter.latest.sort.latest') }}";
            }
        });


        //for grid change        
        document.addEventListener("DOMContentLoaded", function() {
            // Initial grid layout (assuming it's a 3-column grid)
            var currentGridClass = "col-lg-6";
            var currentGridClass = "col-lg-12";

            // Get the change grid button
            var changeGridButton = document.getElementById("change-grid-btn");

            // Attach click event listener to the change grid button
            changeGridButton.addEventListener("click", function() {
                // Get all elements with the class name "course-grid"
                var courseGrids = document.getElementsByClassName("course-grid");

                // Toggle between different grid classes for each course grid
                for (var i = 0; i < courseGrids.length; i++) {
                    if (currentGridClass === "col-lg-6", "col-lg-12") {
                        // Change to 4-column grid
                        courseGrids[i].classList.remove("col-lg-6", "col-lg-12");
                        courseGrids[i].classList.add("col-lg-4");
                    } 
                }

                // Update the current grid class based on the change
                if (currentGridClass === "col-lg-6", "col-lg-12") {
                    currentGridClass = "col-lg-4";
                }
            });
        });

        //tab
        document.addEventListener("DOMContentLoaded", function() {
            // Initial grid layout (assuming it's a 3-column grid)
            var currentGridClass = "col-lg-4";
            var currentGridClass = "col-lg-12";

            // Get the change grid button
            var changeGridButton = document.getElementById("change-grid-btn-tab");

            // Attach click event listener to the change grid button
            changeGridButton.addEventListener("click", function() {
                // Get all elements with the class name "course-grid"
                var courseGrids = document.getElementsByClassName("course-grid");

                // Toggle between different grid classes for each course grid
                for (var i = 0; i < courseGrids.length; i++) {
                    if (currentGridClass === "col-lg-4", "col-lg-12") {
                        // Change to 4-column grid
                        courseGrids[i].classList.remove("col-lg-4", "col-lg-12");
                        courseGrids[i].classList.add("col-lg-6");
                    }
                }

                // Update the current grid class based on the change
                if (currentGridClass === "col-lg-4", "col-lg-12") {
                    currentGridClass = "col-lg-6";
                } 
            });
        });
        //phone
        document.addEventListener("DOMContentLoaded", function() {
            // Initial grid layout (assuming it's a 3-column grid)
            var currentGridClass = "col-lg-4";
            var currentGridClass = "col-lg-6";

            // Get the change grid button
            var changeGridButton = document.getElementById("change-grid-btn-phone");

            // Attach click event listener to the change grid button
            changeGridButton.addEventListener("click", function() {
                // Get all elements with the class name "course-grid"
                var courseGrids = document.getElementsByClassName("course-grid");

                // Toggle between different grid classes for each course grid
                for (var i = 0; i < courseGrids.length; i++) {
                    if (currentGridClass === "col-lg-4", "col-lg-6") {
                        // Change to 4-column grid
                        courseGrids[i].classList.remove("col-lg-4", "col-lg-6");
                        courseGrids[i].classList.add("col-lg-12");                        
                    } 
                }

                // Update the current grid class based on the change
                if (currentGridClass === "col-lg-4", "col-lg-6") {
                    currentGridClass = "col-lg-12";
                } 
            });
        });
    </script>
@endsection
