@extends('frontend_new.extendmaster');
{{-- /var/www/html/omshiva.asmbeta.in/@core/resources/views/frontend_new/extendmaster.blade.php --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <!-- Page Banner Start -->
    <div class="section page-banner-section page-banner-filter-detail "
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
                            <h2 class="title">Course Details</h2>
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{ route('course_all_filter.course_all_detail', $course_all_filter->id) }}">Course
                                        Details</a></li>
                            </ul>
                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Blog Details Start -->
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content-area-wrapper">
                        <div class="thumb">
                            <img src="{{ asset('@core/storage/app/public/'.$course_all_filter->course_thumbnail) }}"
                                alt="image" class="img-fluid" width="100%">
                        </div>
                        <div class="content-tab-wrapper">
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-link" data-toggle="tab" href="#nav-overview" role="tab"
                                        aria-selected="true">Overview</a>
                                    <a class="nav-link active" data-toggle="tab" href="#nav-curriculum" role="tab"
                                        aria-selected="false">Curriculum</a>
                                    <a class="nav-link" data-toggle="tab" href="#nav-instructor" role="tab"
                                        aria-selected="false">Instructor</a>
                                    <a class="nav-link" data-toggle="tab" href="#nav-reviews" role="tab"
                                        aria-selected="false">Reviews</a>
                                </div>
                            </nav>
                            <div class="tab-content">
                                <div class="tab-pane fade" id="nav-overview" role="tabpanel">
                                    <div class="tab-inner-area">
                                        <div>Do commanded an shameless we disposing do. Indulgence ten remarkably nor are
                                            impression out. Power is lived means oh every in we quiet. Remainder provision
                                            an in intention. Saw supported too joy promotion engrossed propriety. Me till
                                            like it sure no sons.&nbsp;</div>
                                        <div><br></div>
                                        <div>Man request adapted spirits set pressed. Up to denoting subjects sensible
                                            feelings it indulged directly. We dwelling elegance do shutters appetite
                                            yourself diverted. Our next drew much you with rank. Tore many held age hold
                                            rose than our. She literature sentiments any contrasted. Set aware joy sense
                                            young now tears china shy.&nbsp;</div>
                                        <div><br></div>
                                        <div>Any delicate you how kindness horrible outlived servants. You high bed wish
                                            help call draw side. Girl quit if case mr sing as no have. At none neat am do
                                            over will. Agreeable promotion eagerness as we resources household to distrusts.
                                            Polite do object at passed it is. Small for ask shade water manor think men
                                            begin.&nbsp;</div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="nav-curriculum" role="tabpanel">
                                    <div class="tab-inner-area">
                                        <div class="curriculum-item-wrapper">
                                            <div class="single-curriculum-item">
                                                <div id="accordion_78">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div data-toggle="collapse" data-target="#collapseOne_78"
                                                                aria-expanded="true" aria-controls="collapseOne"
                                                                class="">
                                                                <h3 class="title">Course overview</h3>
                                                                <p class="description">Unpleasing impression themselves to
                                                                    at assistance acceptance my or. On consider laughter
                                                                    civility offended oh.</p>
                                                                <span class="lesson-count">5 Lessons</span>
                                                            </div>

                                                        </div>
                                                        <div id="collapseOne_78" class="collapse show"
                                                            data-parent="#accordion_78" style="">
                                                            <div class="card-body">
                                                                <ul class="lesson-list">

                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/75">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Why
                                                                                Python?</div>
                                                                            <div class="right">
                                                                                <span class="duration">50:00 hr</span>
                                                                                <i class="fas fa-eye"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/78">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Running
                                                                                Python Code</div>
                                                                            <div class="right">
                                                                                <span class="duration">3.05 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/79">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Git and
                                                                                Github Overview (Optional)</div>
                                                                            <div class="right">
                                                                                <span class="duration">2.00 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/81">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Numbers:
                                                                                Simple Arithmetic</div>
                                                                            <div class="right">
                                                                                <span class="duration">5.00 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/83">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Variable
                                                                                Assignments</div>
                                                                            <div class="right">
                                                                                <span class="duration">15.00 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-curriculum-item">
                                                <div id="accordion_79">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div data-toggle="collapse" data-target="#collapseOne_79"
                                                                aria-expanded="false" aria-controls="collapseOne">
                                                                <h3 class="title">Course overview</h3>
                                                                <p class="description">Unpleasing impression themselves to
                                                                    at assistance acceptance my or. On consider laughter
                                                                    civility offended oh.</p>
                                                                <span class="lesson-count">3 Lessons</span>
                                                            </div>

                                                        </div>
                                                        <div id="collapseOne_79" class="collapse "
                                                            data-parent="#accordion_79">
                                                            <div class="card-body">
                                                                <ul class="lesson-list">

                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/73">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Course
                                                                                Introduction</div>
                                                                            <div class="right">
                                                                                <span class="duration">1.05 min</span>
                                                                                <i class="fas fa-eye"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/74">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Course
                                                                                Curriculum Overview</div>
                                                                            <div class="right">
                                                                                <span class="duration">2:00 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/84">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i>
                                                                                Introduction to Strings</div>
                                                                            <div class="right">
                                                                                <span class="duration">5.00 min</span>
                                                                                <i class="fas fa-eye"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-curriculum-item">
                                                <div id="accordion_80">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div data-toggle="collapse" data-target="#collapseOne_80"
                                                                aria-expanded="false" aria-controls="collapseOne">
                                                                <h3 class="title">Course overview</h3>
                                                                <p class="description">Unpleasing impression themselves to
                                                                    at assistance acceptance my or. On consider laughter
                                                                    civility offended oh.</p>
                                                                <span class="lesson-count">4 Lessons</span>
                                                            </div>

                                                        </div>
                                                        <div id="collapseOne_80" class="collapse "
                                                            data-parent="#accordion_80">
                                                            <div class="card-body">
                                                                <ul class="lesson-list">

                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/76">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Course
                                                                                FAQs</div>
                                                                            <div class="right">
                                                                                <span class="duration">3:00 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/77">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Command
                                                                                Line Basics</div>
                                                                            <div class="right">
                                                                                <span class="duration">3.00 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/80">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i>
                                                                                Introduction to Python Data Types</div>
                                                                            <div class="right">
                                                                                <span class="duration">6.00 min</span>
                                                                                <i class="fas fa-eye"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="http://omshiva.asmbeta.in/course-25-lesson/82">
                                                                            <div class="lession-title"><i
                                                                                    class="fas fa-file-alt"></i> Numbers -
                                                                                FAQ</div>
                                                                            <div class="right">
                                                                                <span class="duration">10.60 min</span>
                                                                                <i class="fas fa-lock"></i>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-instructor" role="tabpanel">
                                    <div class="tab-inner-area">
                                        <div class="instructor-wrap">
                                            <div class="thumb">
                                                <img src="{{ asset('@core/storage/app/public/'.$course_all_filter->image_url) }}"
                                                    alt="image" class="img-fluid" width="200" height="300">
                                            </div>
                                            <div class="content-wrap">
                                                <span class="designation">CEO Ir-Tech</span>
                                                <a href="http://omshiva.asmbeta.in/course-instructor/ruth-j-tobin/10">
                                                    <h3 class="title">Ruth J. Tobin</h3>
                                                </a>
                                                <div class="description">Can curiosity may end shameless explained. True
                                                    high on said mr on come. An do mr design at little myself wholly entire
                                                    though. Attended of on stronger or mr pleasure. Rich four like real yet
                                                    west get. Felicity in dwelling to drawings. His pleasure new steepest
                                                    for reserved formerly disposed jennings.</div>
                                                <ul class="social-wrap">
                                                    <li><a href="https:fb.com"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                                    <div class="tab-inner-area">
                                        <div class="feedback-wrapper">
                                            <div class="login-form">
                                                <p>Login To Leave Review</p>

                                                <div class="login-form">
                                                    <form action="http://omshiva.asmbeta.in/login" method="post"
                                                        enctype="multipart/form-data" class="account-form"
                                                        id="login_form_order_page">
                                                        <input type="hidden" name="_token"
                                                            value="dyLsAcRlKMwi10lHZJLeShr4tIwVQp1v5RSZeuO9">
                                                        <div class="error-wrap"></div>
                                                        <div class="form-group">
                                                            <input type="text" name="username" class="form-control"
                                                                placeholder="Username">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="password" class="form-control"
                                                                placeholder="Password">
                                                        </div>
                                                        <div class="form-group btn-wrapper">
                                                            <button type="submit" id="login_btn"
                                                                class="submit-btn">Login</button>
                                                        </div>
                                                        <div class="row mb-4 rmber-area">
                                                            <div class="col-6">
                                                                <div class="custom-control custom-checkbox mr-sm-2 d-flex">
                                                                    <input type="checkbox" name="remember"
                                                                        class="custom-control-input" id="remember">&nbsp;
                                                                    <label class="custom-control-label pt-3"
                                                                        for="remember">Remember Me</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <a class="d-block"
                                                                    href="http://omshiva.asmbeta.in/register">Create New
                                                                    account?</a>
                                                                <a href="http://omshiva.asmbeta.in/login/forget-password">Forgot
                                                                    Password?</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="feedback-comment-list-wrap margin-top-40">
                                                <h3 class="title">Students Feedback</h3>
                                                <ul class="feedback-list">
                                                    <li class="single-feedback-item">
                                                        <div class="content">
                                                            <h4 class="title">Anonymous</h4>
                                                            <div class="rating-wrap single">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <div class="description">Unpleasing impression themselves to at
                                                                assistance acceptance my or. On consider laughter civility
                                                                offended oh.</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-sidebar">
                        <div class="course-details-list-wrap">
                            <ul>
                                <li><strong><i class="fas fa-money"></i> Price</strong> <span class="right">
                                        <span class="price-wrap">
                                            {{$course_all_filter->price}} <del>₹999</del></span>
                                    </span>
                                </li>
                                <li><strong><i class="fas fa-user-graduate"></i> Instructor</strong> <span class="right">
                                        <a href="http://omshiva.asmbeta.in/course-instructor/ruth-j-tobin/10">Ruth J. Tobin</a></span></li>
                                <li><strong><i class="fa fa-clock-o" aria-hidden="true"></i> Duration</strong> <span
                                        class="right"> {{$course_all_filter->duration}}</span></li>
                                <li><strong><i class="fas fa-tags "></i> Category</strong> <span class="right"><a
                                            href="http://omshiva.asmbeta.in/course-category/web-design/42">{{$course_all_filter->category}}</a></span></li>
                                <li><strong><i class="fas fa-folder-open"></i> Curriculum</strong> <span
                                        class="right">3</span></li>
                                <li><strong><i class="fas fa-file-alt"></i> Lectures</strong> <span
                                        class="right">24</span></li>
                                <li><strong><i class="fas fa-users"></i> Enrolled</strong> <span class="right">1</span>
                                </li>
                            </ul>
                            <div class="btn-wrapper">
                                <a href="{{route('course_all_filter.course_all_login', $course_all_filter->id)}}" class="boxed-btn  ">Enroll Now <i
                                        class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Blog Details End -->


    <!-- Cta Start -->
    <div class="section techwix-cta-section-02 section-padding-02">
        <div class="container">
            <!-- Cta Wrap Start -->
            <div class="cta-wrap"
                style="background-image: url(http://omshiva.asmbeta.in/@core/public/assets/images/bg/cta-bg.jpg);">
                <div class="row align-items-center">
                    <div class="col-xl-9 col-lg-8">
                        <!-- Cta Content Start -->
                        <div class="cta-content">
                            <div class="cta-icon pt-4">
                                <img src="http://omshiva.asmbeta.in/@core/public/assets/images/cta-icon2.png"
                                    alt="">
                            </div>
                            <p>We’re Delivering the best customer Experience</p>
                        </div>
                        <!-- Cta Content End -->
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <!-- Cta Button Start -->
                        <div class="cta-btn">
                            <a class="btn btn-white" href="#">+44 920 090 505</a>
                        </div>
                        <!-- Cta Button End -->
                    </div>
                </div>
            </div>
            <!-- Cta Wrap End -->
        </div>
    </div>
    <!-- Cta End -->



    {{-- js --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@endsection
