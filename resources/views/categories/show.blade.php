<x-main-layout>
    <div class="container py-5">
        <!-- Category Header -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card border-0 bg-primary text-white shadow-lg">
                    <div class="card-body p-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('categories.index') }}" class="text-white-50">التصنيفات</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">
                                    {{ $category->name }}
                                </li>
                            </ol>
                        </nav>
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h1 class="display-4 fw-bold mb-3">{{ $category->name }}</h1>
                                <p class="lead mb-4">{{ $category->description }}</p>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                        <i class="fas fa-graduation-cap me-2"></i>
                                        {{ $courses->total() }} دورة متاحة
                                    </span>
                                    <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                        <i class="fas fa-users me-2"></i>
                                        {{ $courses->sum('students_count') }} طالب مسجل
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <i class="fas fa-{{ $category->icon ?? 'folder' }} fa-5x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="row g-4">
            @forelse($courses as $course)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-card">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                 class="card-img-top" 
                                 alt="{{ $course->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-graduation-cap fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ $course->level }}
                                </span>
                                <span class="text-muted small">
                                    <i class="fas fa-users me-1"></i>
                                    {{ $course->students_count }} طالب
                                </span>
                            </div>
                            <h3 class="h5 mb-3">{{ $course->title }}</h3>
                            <p class="text-muted small mb-3">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            <div class="d-flex align-items-center mb-3">
                                @if($course->instructor)
                                    <img src="{{ $course->instructor->profile_photo_url }}" 
                                         class="rounded-circle me-2" 
                                         width="30" 
                                         alt="{{ $course->instructor->name }}">
                                    <span class="small text-muted">
                                        {{ $course->instructor->name }}
                                    </span>
                                @elseif($course->instructors->isNotEmpty())
                                    <img src="{{ $course->instructors->first()->profile_photo_url }}" 
                                         class="rounded-circle me-2" 
                                         width="30" 
                                         alt="{{ $course->instructors->first()->name }}">
                                    <span class="small text-muted">
                                        {{ $course->instructors->first()->name }}
                                    </span>
                                @else
                                    <span class="small text-muted">
                                        <i class="fas fa-user-circle me-2"></i>
                                        مدرس غير محدد
                                    </span>
                                @endif
                            </div>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses.show', $course) }}" 
                                   class="btn btn-outline-primary rounded-pill px-4">
                                    عرض التفاصيل
                                    <i class="fas fa-arrow-left ms-2"></i>
                                </a>
                                @if($course->price > 0)
                                    <span class="text-primary fw-bold">
                                        {{ $course->price }} جنيه
                                    </span>
                                @else
                                    <span class="badge bg-success">مجاني</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-graduation-cap fa-4x text-muted mb-4"></i>
                        <h3 class="h4 text-muted">لا توجد دورات في هذا التصنيف</h3>
                        <p class="text-muted">سيتم إضافة دورات جديدة قريباً</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $courses->links() }}
            </div>
        @endif
    </div>

    <style>
        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
        }

        .badge {
            font-weight: 500;
        }

        /* Custom Pagination Styles */
        .pagination {
            gap: 0.5rem;
        }

        .page-link {
            border-radius: 50%;
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bs-primary);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .page-item.active .page-link {
            background-color: var(--bs-primary);
        }

        .page-link:hover {
            background-color: var(--bs-primary-bg-subtle);
            color: var(--bs-primary);
            transform: scale(1.1);
        }
    </style>
</x-main-layout>
