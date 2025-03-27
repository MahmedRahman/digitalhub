<x-main-layout>
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card border-0 bg-primary text-white shadow-lg overflow-hidden">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h1 class="display-4 fw-bold mb-3">استكشف التصنيفات</h1>
                                <p class="lead mb-0">اكتشف مجموعة واسعة من الدورات المصنفة حسب المجالات المختلفة</p>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <i class="fas fa-th-large fa-5x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="row g-4">
            @forelse($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-card position-relative" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <a href="{{ route('categories.show', $category) }}" class="text-decoration-none text-dark stretched-link">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="category-icon-wrapper me-3">
                                        <i class="fas fa-{{ $category->icon ?? 'folder' }} fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-1">{{ $category->name }}</h3>
                                        <p class="text-muted small mb-0">{{ $category->courses_count ?? 0 }} دورة</p>
                                    </div>
                                </div>
                                <p class="text-muted mb-3">{{ Str::limit($category->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="btn btn-outline-primary rounded-pill px-4 disabled">
                                        عرض الدورات
                                        <i class="fas fa-arrow-left ms-2"></i>
                                    </span>
                                    @if($category->courses_count > 0)
                                        <span class="badge bg-success-subtle text-success rounded-pill">
                                            {{ $category->courses_count }} دورة متاحة
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-folder-open fa-4x text-muted mb-4"></i>
                        <h3 class="h4 text-muted">لا توجد تصنيفات متاحة حالياً</h3>
                        <p class="text-muted">سيتم إضافة تصنيفات جديدة قريباً</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

    <style>
        .category-icon-wrapper {
            width: 60px;
            height: 60px;
            background-color: var(--bs-primary-bg-subtle);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
        }

        .hover-card:hover .category-icon-wrapper {
            background-color: var(--bs-primary);
        }

        .hover-card:hover .category-icon-wrapper i {
            color: white !important;
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .display-4 {
                font-size: 2rem;
            }
            
            .lead {
                font-size: 1rem;
            }
        }
    </style>
</x-main-layout>
