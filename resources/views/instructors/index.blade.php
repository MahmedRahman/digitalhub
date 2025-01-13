<x-main-layout>
    <!-- Header -->
    <div class="bg-primary text-white py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">المدربون المتميزون</h1>
            <div class="row">
                <div class="col-md-8">
                    <p class="lead">تعلم على يد نخبة من أفضل المدربين المتخصصين في مجالاتهم</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructors Grid -->
    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                @foreach($instructors as $instructor)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <img src="{{ $instructor->profile_photo_url }}" 
                                     class="rounded-circle mb-3" 
                                     width="120" 
                                     height="120"
                                     alt="{{ $instructor->name }}">
                                <h4 class="card-title mb-1">
                                    <a href="{{ route('instructors.show', $instructor) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ $instructor->name }}
                                    </a>
                                </h4>
                                <p class="text-primary mb-3">{{ $instructor->title }}</p>
                                <p class="text-muted mb-4">{{ Str::limit($instructor->bio, 100) }}</p>
                                <div class="d-flex justify-content-center gap-4 mb-4">
                                    <div class="text-center">
                                        <h5 class="mb-1">{{ $instructor->courses_count }}</h5>
                                        <small class="text-muted">دورة تدريبية</small>
                                    </div>
                                    @if($instructor->specializations)
                                        <div class="text-center">
                                            <h5 class="mb-1">{{ $instructor->specializations->count() }}</h5>
                                            <small class="text-muted">تخصص</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-center gap-2">
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
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="{{ route('instructors.show', $instructor) }}" 
                                   class="btn btn-primary w-100">
                                    عرض الملف الشخصي
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $instructors->links() }}
            </div>
        </div>
    </div>
</x-main-layout>
