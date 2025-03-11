<x-main-layout>
    <!-- Hero Section -->
    @foreach($heroSections as $heroSection)
        @if($heroSection->is_active)
            <div class="bg-primary text-white py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h1 class="display-4 fw-bold mb-3">{{ $heroSection->title }}</h1>
                            <p class="lead mb-4">{{ $heroSection->description }}</p>
                            <a href="{{ $heroSection->button_link }}" class="btn btn-light btn-lg">{{ $heroSection->button_text }}</a>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ $heroSection->image_url }}" alt="Hero" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach



    <!-- Categories Section -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="mb-3">تصفح حسب التصنيف</h2>
                    <p class="text-muted">اكتشف مجموعة متنوعة من التصنيفات التعليمية المتخصصة</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                                <div class="card-body text-center p-4">
                                    <div class="icon-box mb-3">
                                        <i class="fas fa-{{ $category->icon ?? 'book' }} fa-2x text-primary"></i>
                                    </div>
                                    <h5 class="card-title text-dark mb-2">{{ $category->name }}</h5>
                                    <p class="card-text text-muted small mb-2">{{ Str::limit($category->description, 80) }}</p>
                                    <div class="mt-3">
                                        <span class="badge bg-primary">{{ $category->courses_count }} دورة</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">
                    عرض جميع التصنيفات
                    <i class="fas fa-arrow-left me-2"></i>
                </a>
            </div>
        </div>
    </div>


    <!-- Featured Courses -->
    <div class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">الدورات المميزة</h2>
            <div class="row g-4">
                @foreach($latestCourses as $course)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ $course->image_url }}" 
                                 class="card-img-top"
                                 style="height: 200px; object-fit: cover;"
                                 alt="{{ $course->title }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">{{ $course->category->name }}</span>
                                    <span class="text-primary fw-bold">{{ $course->price }} ج.م</span>
                                </div>
                                <h5 class="card-title">
                                    <a href="{{ route('courses.show', $course) }}" class="text-decoration-none text-dark">
                                        {{ $course->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="d-flex align-items-center">
                                            @if($course->instructor)
                                                <img src="{{ $course->instructor->profile_photo_url }}" 
                                                     class="rounded-circle me-2" 
                                                     width="30" 
                                                     alt="{{ $course->instructor->name }}">
                                                <small class="text-muted">{{ $course->instructor->name }}</small>
                                            @elseif($course->instructors->isNotEmpty())
                                                <img src="{{ $course->instructors->first()->profile_photo_url }}" 
                                                     class="rounded-circle me-2" 
                                                     width="30" 
                                                     alt="{{ $course->instructors->first()->name }}">
                                                <small class="text-muted">{{ $course->instructors->first()->name }}</small>
                                            @else
                                                <img src="https://ui-avatars.com/api/?name=Unknown&color=7F9CF5&background=EBF4FF" 
                                                     class="rounded-circle me-2" 
                                                     width="30" 
                                                     alt="Unknown Instructor">
                                                <small class="text-muted">مدرب غير معروف</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center text-muted small">
                                            <span class="me-3">
                                                <i class="fas fa-book-reader me-1"></i>
                                                {{ $course->lectures_count }} درس
                                            </span>
                                            <span>
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $course->duration_in_weeks }} أسابيع
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">عرض جميع الدورات</a>
            </div>
        </div>
    </div>

    <!-- Featured Instructors -->
    <div class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">نخبة من المدربين</h2>
            <div class="row g-4">
                @foreach($featuredInstructors as $instructor)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm text-center">
                            <div class="card-body">
                                <img src="{{ $instructor->profile_photo_url ?? 'https://ui-avatars.com/api/?name=Unknown&color=7F9CF5&background=EBF4FF' }}" 
                                     class="rounded-circle mb-3" 
                                     width="120" 
                                     height="120"
                                     alt="{{ $instructor->name ?? 'Unknown Instructor' }}">
                                <h5 class="card-title">{{ $instructor->name ?? 'مدرب غير معروف' }}</h5>
                                <p class="text-primary mb-2">{{ $instructor->title ?? '' }}</p>
                                <p class="text-muted small mb-3">{{ Str::limit($instructor->bio ?? '', 100) }}</p>
                                <a href="{{ route('instructors.show', $instructor) }}" 
                                   class="btn btn-outline-primary">
                                    عرض الملف الشخصي
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('instructors.index') }}" class="btn btn-primary btn-lg">عرض جميع المدربين</a>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="display-4 text-primary mb-3">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>دورات عالية الجودة</h4>
                        <p class="text-muted">تعلم من نخبة من المدربين المحترفين في مجالاتهم</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="display-4 text-primary mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>تعلم في أي وقت</h4>
                        <p class="text-muted">ادرس بالسرعة التي تناسبك وفي الوقت المناسب لك</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="display-4 text-primary mb-3">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4>شهادات معتمدة</h4>
                        <p class="text-muted">احصل على شهادات معتمدة تؤهلك لسوق العمل</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="mb-4">ابدأ رحلة التعلم اليوم</h2>
            <p class="lead mb-4">سجل الآن واحصل على خصم 20% على جميع الدورات</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">سجل الآن</a>
        </div>
    </div>
</x-guest-layout>
