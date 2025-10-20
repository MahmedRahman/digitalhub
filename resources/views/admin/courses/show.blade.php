<x-app-layout>
    <div class="container-fluid p-4">
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

        <!-- Course Header -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="{{ Storage::disk('public')->url($course->image) }}" 
                             alt="{{ $course->title }}" 
                             class="rounded-3"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h2 class="mb-1">{{ $course->title }}</h2>
                                <p class="text-muted mb-2">{{ optional($course->category)->name }}</p>
                                <div class="d-flex gap-3 text-muted small">
                                    <span>
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $course->duration_in_weeks }} أسابيع
                                    </span>
                                    <span>
                                        <i class="fas fa-book me-1"></i>
                                        {{ $course->lectures_count }} محاضرة
                                    </span>
                                    <span>
                                        <i class="fas fa-money-bill me-1"></i>
                                        {{ round($course->price) }} ج.م
                                    </span>
                                    <span>
                                        <i class="fas fa-tag me-1"></i>
                                        {{ $course->status === 'published' ? 'منشور' : 'مسودة' }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.courses.edit', $course) }}" 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                    تعديل الدورة
                                </a>
                                <a href="{{ route('admin.courses.index') }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-right"></i>
                                    عودة للقائمة
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Content -->
        <div class="row">
            <!-- Course Info -->
            <div class="col-lg-4 order-lg-2">
                <!-- Instructors Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-chalkboard-teacher me-2 text-primary"></i>
                            المدربين
                        </h5>
                    </div>
                    <div class="card-body">
                        @forelse($course->instructors as $instructor)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $instructor->profile_photo_url }}" 
                                     alt="{{ $instructor->name }}"
                                     class="rounded-circle me-3"
                                     width="48">
                                <div>
                                    <h6 class="mb-1">{{ $instructor->name }}</h6>
                                    <p class="text-muted small mb-0">{{ $instructor->email }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">لم يتم تعيين مدربين لهذه الدورة</p>
                        @endforelse
                    </div>
                </div>

                <!-- Course Details Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            تفاصيل الدورة
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">المتطلبات</h6>
                            <p class="text-muted mb-0">{{ $course->requirements ?: 'لا توجد متطلبات محددة' }}</p>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">ماذا ستتعلم</h6>
                            <p class="text-muted mb-0">{{ $course->what_you_will_learn ?: 'لم يتم تحديد مخرجات التعلم' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lessons List -->
            <div class="col-lg-8 order-lg-1">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-book-open me-2 text-primary"></i>
                                دروس الدورة
                            </h5>
                            <a href="{{ route('admin.lessons.create', ['course_id' => $course->id]) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i>
                                إضافة درس جديد
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($course->lessons->isEmpty())
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-book fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">لا توجد دروس بعد</h5>
                                <p class="text-muted mb-3">قم بإضافة أول درس للدورة</p>
                                <a href="{{ route('admin.lessons.create', ['course_id' => $course->id]) }}" 
                                   class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-1"></i>
                                    إضافة درس جديد
                                </a>
                            </div>
                        @else
                            <div class="list-group list-group-flush">
                                @foreach($course->lessons as $lesson)
                                    <div class="list-group-item p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">{{ $lesson->title }}</h6>
                                                <p class="text-muted small mb-0">{{ $lesson->description }}</p>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.lessons.edit', $lesson) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.lessons.destroy', $lesson) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('هل أنت متأكد من حذف هذا الدرس؟')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
