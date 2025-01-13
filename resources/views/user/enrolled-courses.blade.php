<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0">دوراتي المسجلة</h2>
                    <div class="d-flex gap-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                ترتيب حسب
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ request('sort') == 'latest' ? 'active' : '' }}" href="?sort=latest">الأحدث</a></li>
                                <li><a class="dropdown-item {{ request('sort') == 'oldest' ? 'active' : '' }}" href="?sort=oldest">الأقدم</a></li>
                                <li><a class="dropdown-item {{ request('sort') == 'title' ? 'active' : '' }}" href="?sort=title">العنوان</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                التصفية
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ !request('filter') ? 'active' : '' }}" href="{{ request()->url() }}">الكل</a></li>
                                <li><a class="dropdown-item {{ request('filter') == 'in-progress' ? 'active' : '' }}" href="?filter=in-progress">قيد التقدم</a></li>
                                <li><a class="dropdown-item {{ request('filter') == 'completed' ? 'active' : '' }}" href="?filter=completed">مكتملة</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if($enrolledCourses->isEmpty())
                    <div class="text-center py-5">
                        <img src="{{ asset('images/empty-courses.svg') }}" alt="لا توجد دورات" class="img-fluid mb-4" style="max-width: 200px;">
                        <h3 class="h4 mb-3">لم تسجل في أي دورة بعد</h3>
                        <p class="text-muted mb-4">اكتشف دوراتنا المتنوعة وابدأ رحلة التعلم الخاصة بك</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>استكشف الدورات
                        </a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($enrolledCourses as $enrollment)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <img src="{{ Storage::url($enrollment->course->image) }}" 
                                             class="card-img-top" 
                                             alt="{{ $enrollment->course->title }}"
                                             style="height: 200px; object-fit: cover;">
                                        
                                        @if($enrollment->completed_at)
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>مكتمل
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">
                                            <a href="{{ route('courses.learn', $enrollment->course) }}" class="text-decoration-none text-dark">
                                                {{ $enrollment->course->title }}
                                            </a>
                                        </h5>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ Storage::url($enrollment->course->instructor->avatar) }}" 
                                                 class="rounded-circle me-2" 
                                                 alt="{{ $enrollment->course->instructor->name }}"
                                                 width="30" height="30">
                                            <span class="text-muted">{{ $enrollment->course->instructor->name }}</span>
                                        </div>

                                        <div class="progress mb-3" style="height: 8px;">
                                            @php
                                                $progress = $enrollment->progress ?? 0;
                                            @endphp
                                            <div class="progress-bar bg-primary" 
                                                 role="progressbar" 
                                                 style="width: {{ $progress }}%"
                                                 aria-valuenow="{{ $progress }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">{{ $progress }}% مكتمل</span>
                                            <a href="{{ route('courses.learn', $enrollment->course) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-play me-1"></i>متابعة التعلم
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $enrolledCourses->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
