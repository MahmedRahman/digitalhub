<x-main-layout>
    <!-- Course Header -->

    <div class="bg-primary text-white py-5">
        <div class="container">
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
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-white text-decoration-none">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('courses.index') }}" class="text-white text-decoration-none">الدورات</a>
                            </li>
                            <li class="breadcrumb-item active text-white" aria-current="page">
                                {{ $course->title }}
                            </li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3">{{ $course->title }}</h1>
                    <p class="lead mb-4">{{ $course->description }}</p>
                    <div class="d-flex flex-wrap gap-4 mb-4">
                        <div>
                            <i class="fas fa-clock me-2"></i>
                            {{ $course->duration }} ساعة
                        </div>
                        <div>
                            <i class="fas fa-book me-2"></i>
                            {{ $course->lessons->count() }} درس
                        </div>
                        <div>
                            <i class="fas fa-signal me-2"></i>
                            {{ $course->level }}
                        </div>
                        <div>
                            <i class="fas fa-language me-2"></i>
                            {{ $course->language }}
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        @auth
                            @php
                                $enrollment = $course->enrollment;
                            @endphp

                            @if(!$enrollment)
                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-light btn-lg">
                                        <i class="fas fa-graduation-cap me-2"></i>
                                        التسجيل في الدورة
                                    </button>
                                </form>
                            @elseif($enrollment->status === 'approved')
                                <!-- متابعة التعلم button hidden -->
                            @elseif($enrollment->status === 'pending')
                                <button class="btn btn-warning btn-lg" disabled>
                                    <i class="fas fa-clock me-2"></i>
                                    في انتظار الموافقة
                                </button>
                            @else
                                <button class="btn btn-danger btn-lg" disabled>
                                    <i class="fas fa-times-circle me-2"></i>
                                    تم رفض التسجيل
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                سجل دخول للتسجيل في الدورة
                            </a>
                        @endauth
                        
                        <!-- WhatsApp Registration Button -->
                        <x-whatsapp-button 
                            :course-title="$course->title" 
                            :price="$course->price" 
                            button-text="إكمال التسجيل عبر الواتساب"
                            button-class="btn btn-success"
                            button-size="lg" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h3 class="text-primary mb-0">{{ round($course->price) }} ج.م</h3>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    إمكانية الوصول مدى الحياة
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    شهادة إتمام معتمدة
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    مشاريع عملية
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    دعم فني على مدار الساعة
                                </li>
                            </ul>
                            @auth
                                @php
                                    $enrollment = $course->enrollment;
                                @endphp

                                @if(!$enrollment)
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            اشترك الآن
                                        </button>
                                    </form>
                                @elseif($enrollment->status === 'approved')
                                    <!-- متابعة التعلم button hidden -->
                                @elseif($enrollment->status === 'pending')
                                    <button class="btn btn-warning btn-lg w-100" disabled>
                                        <i class="fas fa-clock me-2"></i>
                                        في انتظار الموافقة
                                    </button>
                                @else
                                    <button class="btn btn-danger btn-lg w-100" disabled>
                                        <i class="fas fa-times-circle me-2"></i>
                                        تم رفض التسجيل
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    سجل دخول للاشتراك
                                </a>
                            @endauth
                            
                            <!-- WhatsApp Registration Button -->
                            <div class="mt-3">
                                <x-whatsapp-button 
                                    :course-title="$course->title" 
                                    :price="$course->price" 
                                    button-text="إكمال التسجيل عبر الواتساب"
                                    button-class="btn btn-success w-100"
                                    button-size="lg" />
                                <p class="text-muted small mt-2 text-center">
                                    <i class="fas fa-info-circle me-1"></i>
                                    يمكنك إكمال عملية التسجيل والدفع عبر الواتساب
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Content -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Promotional Video Section -->
                    @if($course->promotional_video)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">تعرف على الكورس
                            </h5>
                            <div class="ratio ratio-16x9">
                                <iframe 
                                    src="{{ $course->promotional_video }}" 
                                    title="فيديو ترويجي للدورة"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Course Lessons -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-4">محتوى الدورة</h3>
                            <div class="list-group list-group-flush">
                            {!! $course->what_you_will_learn !!}
                            </div>
                        </div>
                    </div>

                    <!-- Course Requirements -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-4">متطلبات الدورة</h3>
                            <div class="list-group list-group-flush">
                            {!! $course->requirements !!}
                            </div>
                        </div>
                    </div>

                    <!-- Course Testimonials -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="card-title mb-0">آراء المتعلمين</h3>
                                <!-- <a href="{{ route('testimonials.show-form', $course->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-comment me-1"></i>شارك برأيك
                                </a> -->
                            </div>
                            
                            @if($testimonials->count() > 0)
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
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted mb-0">لا توجد آراء حول هذه الدورة حتى الآن. كن أول من يشارك برأيه!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Share Course -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">شارك الدورة</h5>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-primary flex-grow-1" 
                                   title="شارك على فيسبوك">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($course->title) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-info flex-grow-1" 
                                   title="شارك على تويتر">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($course->title . ' - ' . request()->url()) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-success flex-grow-1" 
                                   title="شارك على واتساب">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="mailto:?subject={{ urlencode($course->title) }}&body={{ urlencode('أدعوك للاطلاع على هذه الدورة: ' . $course->title . ' - ' . request()->url()) }}" 
                                   class="btn btn-outline-secondary flex-grow-1" 
                                   title="شارك عبر البريد الإلكتروني">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Related Courses -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">دورات ذات صلة</h5>
                            @foreach($course->category->courses->where('id', '!=', $course->id)->take(3) as $relatedCourse)
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="{{ Storage::url($relatedCourse->image) }}" 
                                                 class="img-fluid rounded-start h-100" 
                                                 style="object-fit: cover;"
                                                 alt="{{ $relatedCourse->title }}">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <a href="{{ route('courses.show', $relatedCourse) }}" 
                                                       class="text-decoration-none text-dark">
                                                        {{ $relatedCourse->title }}
                                                    </a>
                                                </h6>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        {{ round($relatedCourse->price) }} ج.م
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Instructor Info -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title mb-4">المدربون</h3>
                            @foreach($course->instructors as $instructor)
                                <div class="d-flex mb-4 position-relative">
                                    <a href="{{ route('instructors.show', $instructor) }}" class="text-decoration-none text-dark d-flex stretched-link">
                                        <img src="{{ $instructor->profile_photo_url }}" 
                                             class="rounded-circle me-3" 
                                             width="64" 
                                             height="64"
                                             alt="{{ $instructor->name }}">
                                        <div>
                                            <h5 class="mb-1">{{ $instructor->name }}</h5>
                                            <p class="text-muted mb-2">{{ $instructor->title }}</p>
                                            <p class="mb-0">{{ Str::limit($instructor->bio, 150) }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">طرق الدفع</h5>
                            <p class="text-muted mb-3">يمكنك الدفع بعدة طرق مختلفة بما في ذلك فودافون كاش، انستا باي، والتحويل البنكي</p>
                            <div class="d-grid">
                                <a href="{{ route('payment') }}" class="btn btn-primary">
                                    <i class="fas fa-credit-card me-2"></i>عرض طرق الدفع
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
