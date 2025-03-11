<x-main-layout>
    <style>
        .pagination {
            gap: 5px;
        }
        .page-link {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .page-link:hover {
            color: #fff;
            background-color: var(--bs-primary);
        }
        .page-item.active .page-link {
            color: #fff;
            background-color: var(--bs-primary);
        }
        .page-item.disabled .page-link {
            background-color: #e9ecef;
            color: #adb5bd;
        }
    </style>
    <!-- Header -->
    <div class="bg-primary text-white py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">استكشف الدورات</h1>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('courses.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" 
                               name="search" 
                               class="form-control form-control-lg" 
                               placeholder="ابحث عن دورة..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-light btn-lg px-4">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">تصفية النتائج</h5>
                            <form action="{{ route('courses.index') }}" method="GET">
                                <!-- Categories -->
                                <div class="mb-4">
                                    <h6 class="mb-3">الأقسام</h6>
                                    @foreach($categories as $category)
                                        <div class="form-check mb-2">
                                            <input type="checkbox" 
                                                   name="categories[]" 
                                                   value="{{ $category->id }}"
                                                   class="form-check-input"
                                                   id="category{{ $category->id }}"
                                                   {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Level -->
                                <div class="mb-4">
                                    <h6 class="mb-3">المستوى</h6>
                                    @foreach(['مبتدئ', 'متوسط', 'متقدم'] as $level)
                                        <div class="form-check mb-2">
                                            <input type="checkbox" 
                                                   name="levels[]" 
                                                   value="{{ $level }}"
                                                   class="form-check-input"
                                                   id="level{{ $loop->index }}"
                                                   {{ in_array($level, request('levels', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="level{{ $loop->index }}">
                                                {{ $level }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Price Range -->
                                <div class="mb-4">
                                    <h6 class="mb-3">السعر</h6>
                                    <div class="form-check mb-2">
                                        <input type="radio" 
                                               name="price" 
                                               value="free"
                                               class="form-check-input"
                                               id="priceFree"
                                               {{ request('price') === 'free' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="priceFree">
                                            مجاني
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" 
                                               name="price" 
                                               value="paid"
                                               class="form-check-input"
                                               id="pricePaid"
                                               {{ request('price') === 'paid' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pricePaid">
                                            مدفوع
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    تطبيق الفلتر
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="col-lg-9">
                    <!-- Sort Options -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="mb-0">{{ $courses->total() }} دورة</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="me-2">ترتيب حسب:</label>
                            <select class="form-select" onchange="window.location.href=this.value">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}"
                                        {{ request('sort') === 'latest' ? 'selected' : '' }}>
                                    الأحدث
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}"
                                        {{ request('sort') === 'price_low' ? 'selected' : '' }}>
                                    السعر: من الأقل للأعلى
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}"
                                        {{ request('sort') === 'price_high' ? 'selected' : '' }}>
                                    السعر: من الأعلى للأقل
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Courses -->
                    <div class="row g-4">
                        @forelse($courses as $course)
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
                                                    @if($course->instructors->isNotEmpty())
                                                        <img src="{{ $course->instructors->first()->profile_photo_url }}" 
                                                             class="rounded-circle me-2" 
                                                             width="30" 
                                                             height="30"
                                                             alt="{{ $course->instructors->first()->name }}">
                                                        <span class="small text-muted">
                                                            {{ $course->instructors->first()->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="d-flex align-items-center text-muted small">
                                                    <div class="me-3">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ $course->duration }} ساعة
                                                    </div>
                                                    <div>
                                                        <i class="fas fa-book me-1"></i>
                                                        {{ $course->lessons->count() }} درس
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <img src="{{ asset('images/no-results.svg') }}" 
                                         alt="No Results" 
                                         class="img-fluid mb-4" 
                                         style="max-width: 200px;">
                                    <h3>لم يتم العثور على دورات</h3>
                                    <p class="text-muted">جرب تغيير معايير البحث</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $courses->withQueryString()->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
