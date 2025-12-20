<x-main-layout>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Course Section -->
    <div class="course-page-wrapper" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); min-height: 100vh;">
        <div class="container py-5">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">الرئيسية</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('courses.index') }}" class="text-decoration-none">الدورات</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($course->title, 30) }}</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Left Side - Course Content -->
                <div class="col-lg-8">
                    <!-- Course Header with Illustration -->
                    <div class="course-header-card mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <!-- Illustration Placeholder -->
                            <div class="course-illustration me-4">
                                <div class="illustration-box">
                                    <div class="illustration-icon-box" style="background: #ff5252;">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                    <div class="illustration-icon-box" style="background: #ffc107; margin-top: 10px;">
                                        <i class="fas fa-mountain text-white"></i>
                                    </div>
                                    <div class="illustration-icon-box" style="background: #03a9f4; margin-top: 10px;">
                                        <i class="fas fa-chart-line text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Course Title -->
                            <div class="course-title-section">
                                <h1 class="course-main-title mb-0">{{ $course->title }}</h1>
                            </div>
                        </div>

                        <!-- Course Info Bar -->
                        <div class="course-info-bar">
                            <div class="info-item">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <span>{{ $course->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-book me-2"></i>
                                <span>{{ $course->lessons->count() }} درس</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock me-2"></i>
                                <span>{{ $course->duration_in_weeks * 10 }} ساعة</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-signal me-2"></i>
                                <span>مستوى الكورس {{ $course->level }}</span>
                            </div>
                        </div>

                        <!-- Price Display -->
                        <div class="course-price-display mt-3">
                            <span class="price-amount">{{ round($course->price) }} ج.م</span>
                        </div>
                    </div>

                    <!-- Overview Section -->
                    <div class="course-content-card mb-4">
                        <h3 class="section-title mb-3">نبذة</h3>
                        <p class="course-description-text">{{ $course->description }}</p>
                    </div>

                    <!-- What You'll Learn Section -->
                    @if($course->what_you_will_learn)
                    <div class="course-content-card mb-4">
                        <h3 class="section-title mb-3">ماذا ستتعلّم؟</h3>
                        <div class="learn-list">
                            @php
                                $learnItems = explode("\n", strip_tags($course->what_you_will_learn));
                                $learnItems = array_filter($learnItems, function($item) {
                                    return trim($item) !== '';
                                });
                                $learnItems = array_slice($learnItems, 0, 4);
                            @endphp
                            @foreach($learnItems as $index => $item)
                                <div class="learn-item">
                                    <span class="learn-number">{{ $index + 1 }}.</span>
                                    <span class="learn-text">{{ trim($item) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Course Content -->
                    @if($course->lessons->count() > 0 || $course->what_you_will_learn)
                    <div class="course-content-card mb-4">
                        <h3 class="section-title mb-4">محتوى الكورس</h3>
                        <div class="course-content">
                            @if($course->lessons->count() > 0)
                                @foreach($course->lessons as $index => $lesson)
                                    <div class="lesson-item mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="lesson-number-badge me-3">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                            </div>
                                            <div class="lesson-content">
                                                <h5 class="lesson-title mb-1">{{ $lesson->title }}</h5>
                                                @if($lesson->description)
                                                    <p class="lesson-description mb-0 text-muted">{{ $lesson->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="course-content-html">
                                    {!! $course->what_you_will_learn !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Requirements -->
                    @if($course->requirements)
                    <div class="course-content-card mb-4">
                        <h3 class="section-title mb-3">متطلبات الدورة</h3>
                        <div class="requirements-content">
                            {!! $course->requirements !!}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Side - Enrollment Card -->
                <div class="col-lg-4">
                    <div class="enrollment-sidebar sticky-top" style="top: 20px;">
                        <div class="enrollment-card">
                            <!-- Price Header -->
                            <div class="price-header">
                                <h4 class="price-title">السعر</h4>
                                <div class="price-display">
                                    <span class="price-value">{{ round($course->price) }} ج.م</span>
                                </div>
                            </div>

                            <!-- Price Includes -->
                            <div class="price-includes">
                                <h5 class="includes-title">السعر يتضمن:</h5>
                                <ul class="includes-list">
                                    <li class="include-item">
                                        <i class="fas fa-hourglass-half me-2"></i>
                                        <span>+ {{ $course->duration_in_weeks * 10 }} ساعة من المحتوي التفاعلي.</span>
                                    </li>
                                    <li class="include-item">
                                        <i class="fas fa-play-circle me-2"></i>
                                        <span>{{ $course->lessons->count() }} محاضرة مباشرة عملية بالكامل.</span>
                                    </li>
                                    <li class="include-item">
                                        <i class="fas fa-file-alt me-2"></i>
                                        <span>مواد دراسية قابلة للتحميل.</span>
                                    </li>
                                    <li class="include-item">
                                        <i class="fas fa-comments me-2"></i>
                                        <span>مهام عملية والاستماع للتعليقات.</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Enrollment Button -->
                            <div class="enrollment-action">
                                @auth
                                    @php
                                        $enrollment = $course->enrollment;
                                    @endphp

                                    @if(!$enrollment)
                                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-enroll w-100">
                                                إشترك
                                            </button>
                                        </form>
                                    @elseif($enrollment->status === 'approved')
                                        <a href="{{ route('courses.learn', $course) }}" class="btn-enroll w-100 d-block text-center text-decoration-none">
                                            متابعة التعلم
                                        </a>
                                    @elseif($enrollment->status === 'pending')
                                        <button class="btn-enroll w-100" disabled>
                                            في انتظار الموافقة
                                        </button>
                                    @else
                                        <button class="btn-enroll w-100" disabled>
                                            تم رفض التسجيل
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-enroll w-100 d-block text-center text-decoration-none">
                                        إشترك
                                    </a>
                                @endauth
                            </div>

                            <!-- Countdown -->
                            <div class="countdown-section mt-3">
                                <div class="countdown-text">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <span>باقي 4 يوم على البداية</span>
                                </div>
                                <div class="countdown-date">
                                    {{ $course->created_at->format('d M Y') }}
                                </div>
                            </div>

                            <!-- WhatsApp Button -->
                            <div class="mt-3">
                                <x-whatsapp-button 
                                    :course-title="$course->title" 
                                    :price="$course->price" 
                                    button-text="إكمال التسجيل عبر الواتساب"
                                    button-class="btn btn-success w-100"
                                    button-size="lg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
    <div class="py-5 bg-white">
        <div class="container">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="section-heading mb-4">آراء المتعلمين</h3>
                    <div class="testimonials-list">
                        @foreach($testimonials as $testimonial)
                            <div class="card mb-3 border-0 bg-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-placeholder bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-size: 16px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $testimonial->client_name }}</h6>
                                            </div>
                                        </div>
                                        <div>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimonial->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-0">{{ $testimonial->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-main-layout>
