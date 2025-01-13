<x-main-layout>
    <!-- Instructor Header -->
    <div class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 text-center">
                    <img src="{{ $instructor->profile_photo_url }}" 
                         class="rounded-circle mb-3" 
                         width="180" 
                         height="180"
                         alt="{{ $instructor->name }}">
                </div>
                <div class="col-lg-9">
                    <h1 class="display-4 fw-bold mb-3">{{ $instructor->name }}</h1>
                    <p class="lead mb-3">{{ $instructor->title }}</p>
                    <div class="d-flex gap-3 mb-4">
                        <div>
                            <h4 class="mb-1">{{ $instructor->courses->count() }}</h4>
                            <small>دورة تدريبية</small>
                        </div>
                        <div>
                            <h4 class="mb-1">{{ $instructor->students_count ?? 0 }}</h4>
                            <small>متدرب</small>
                        </div>
                        <div>
                            <h4 class="mb-1">{{ $instructor->rating ?? '4.5' }}</h4>
                            <small>تقييم</small>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        @if($instructor->facebook)
                            <a href="{{ $instructor->facebook }}" class="btn btn-light" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($instructor->twitter)
                            <a href="{{ $instructor->twitter }}" class="btn btn-light" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($instructor->linkedin)
                            <a href="{{ $instructor->linkedin }}" class="btn btn-light" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                        @if($instructor->website)
                            <a href="{{ $instructor->website }}" class="btn btn-light" target="_blank">
                                <i class="fas fa-globe"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <!-- Instructor Info -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">نبذة عن المدرب</h4>
                            <div class="mb-4">
                                {{ $instructor->bio }}
                            </div>
                            
                            @if($instructor->specializations)
                                <h5 class="mb-3">التخصصات</h5>
                                <div class="mb-4">
                                    @foreach($instructor->specializations as $specialization)
                                        <span class="badge bg-light text-dark me-2 mb-2">
                                            {{ $specialization->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            @if($instructor->certificates)
                                <h5 class="mb-3">الشهادات</h5>
                                <div class="mb-4">
                                    @foreach($instructor->certificates as $certificate)
                                        <div class="mb-2">
                                            <i class="fas fa-certificate text-primary me-2"></i>
                                            {{ $certificate }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($instructor->experience)
                                <h5 class="mb-3">الخبرات</h5>
                                <div>
                                    {{ $instructor->experience }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Instructor Courses -->
                <div class="col-lg-8">
                    <h4 class="mb-4">الدورات التدريبية ({{ $instructor->courses->count() }})</h4>
                    <div class="row g-4">
                        @foreach($instructor->courses as $course)
                            <div class="col-md-6">
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
